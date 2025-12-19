<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_Sisa_Spj extends CI_Controller {

	function __construct()
	{	
		parent::__construct();
		 $this->load->model('sisa_spj/M_Sisa_Spj');
	}
	
	function index($offset=0,$lctabel,$field,$field1,$judul,$list,$lccari)
	{
		$data['page_title'] = " $judul";
        if(empty($lccari)){
            $total_rows = $this->tukd_model->get_count($lctabel);
            $lc = "/.$lccari";
        }else{
            $total_rows = $this->tukd_model->get_count_teang($lctabel,$field,$field1,$lccari);
            $lc = "";
        }
		// pagination        
        if(empty($lccari)){
		$config['base_url']		= site_url("tukd/".$list);
        }else{
        $config['base_url']		= site_url("tukd/cari_".$list);    
        }
		$config['total_rows'] 	= $total_rows;
		$config['per_page'] 	= '10';
		$config['uri_segment'] 	= 3;
		$config['num_links'] 	= 5;
		$config['full_tag_open'] = '<ul class="page-navi">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="current">';
		$config['cur_tag_close'] = '</li>';
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$limit            		= $config['per_page'];  
		$offset         		= $this->uri->segment(3);  
		$offset         		= ( ! is_numeric($offset) || $offset < 1) ? 0 : $offset;  
		  
		if(empty($offset))  
		{  
			$offset=0;  
		}


        if(empty($lccari)){     
		$data['list'] 		= $this->master_model->getAll($lctabel,$field,$limit, $offset);
        }else {
            $data['list'] 		= $this->master_model->getCari($lctabel,$field,$field1,$limit,$offset,$lccari);
        }
		$data['num']		= $offset;
		$data['total_rows'] = $total_rows;
		
				$this->pagination->initialize($config);
		$a=$judul;
		$this->template->set('title', 'PENATAUSAHAAN ');
		$this->template->load('template', "tukd/".$list."/list", $data);
	}
	
	
	function cetak_sisa_tu() {  
	   //$cetak = $this->uri->segment(3);
      //$kd_skpd  = $this->session->userdata('kdskpd');
        $thn_ang = $this->session->userdata('pcThang');
        $no_sp2d = $_REQUEST['bulan'];
         $lcskpd = $_REQUEST['kd_skpd'];
         $pilih = $_REQUEST['cpilih'];

         // echo "<script>alert($bulan)</script>";

         // echo "<script>alert($lcskpd)</script>";
         if ($pilih==2) {
          
         $csql3 = "SELECT DISTINCT a.no_sp2d,a.tgl_sp2d,a.nilai AS jum_sp2d,
b.no_bukti,d.kd_kegiatan,d.kd_rek5,b.total AS jum_spj, c.total  
           FROM trhsp2d a LEFT JOIN trhtransout b ON a.no_sp2d=b.no_sp2d
           LEFT JOIN trhkasin_pkd c ON c.tk = a.no_sp2d
           LEFT JOIN trdtransout d ON d.no_bukti = b.no_bukti
           LEFT JOIN trdspp e ON e.no_spp = a.no_spp
           WHERE a.jns_spp = '3' AND a.kd_skpd = '$lcskpd'
           AND a.no_sp2d = '$no_sp2d' ";
         }else{
           //     $csql3 = "SELECT a.no_sp2d,a.tgl_sp2d,a.nilai,a.keperluan,
           // (SELECT SUM(total) AS n_sp2d FROM trhtransout b WHERE b.no_sp2d = a.no_sp2d) AS n_sp2d
           // FROM trhsp2d a WHERE a.jns_spp = '3' AND a.kd_skpd = '$lcskpd' " ;  
          $csql3 = "SELECT a.no_sp2d,a.tgl_sp2d,a.nilai,a.keperluan,
          (SELECT SUM(nilai) AS n_sp2d FROM trdtransout b WHERE b.no_sp2d = a.no_sp2d) AS n_sp2d,
          (SELECT DISTINCT c.kd_kegiatan FROM trhspp c WHERE c.no_spp = a.no_spp) AS kode_kegiatan
          FROM trhsp2d a WHERE a.jns_spp = '3' AND a.kd_skpd = '$lcskpd'"; 
            //$csql3 = "SELECT no_sp2d, tgl_sp2d,nilai, keperluan FROM trhsp2d WHERE kd_skpd = '$lcskpd' AND jns_spp = '3' AND no_sp2d='$no_sp2d' ORDER BY no_sp2d ASC " ;
         }


         $csql="SELECT a.nm_skpd,a.kd_skpd,(SELECT jabatan FROM ms_ttd WHERE kode = 'PA' AND kd_skpd = a.kd_skpd) AS jab_pa,
                (SELECT nama FROM ms_ttd WHERE kode = 'PA' AND kd_skpd = a.kd_skpd) AS nm_pa,
                (SELECT nip FROM ms_ttd WHERE kode = 'PA' AND kd_skpd = a.kd_skpd) AS nip_pa,
                (SELECT jabatan FROM ms_ttd WHERE kode = 'BK' AND kd_skpd = a.kd_skpd) AS jab_bk,
                (SELECT nama FROM ms_ttd WHERE kode = 'BK' AND kd_skpd = a.kd_skpd) AS nm_bk,
                (SELECT nip FROM ms_ttd WHERE kode = 'BK' AND kd_skpd = a.kd_skpd) AS nip_bk
                 FROM ms_skpd a WHERE  a.kd_skpd = '$lcskpd'";
                
         $hasil = $this->db->query($csql);
         $trh2 = $hasil->row(); 

         $cRet = "";
         $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            <tr>
                <td align=\"center\" colspan=\"16\" style=\"font-size:14px;border: solid 1px white;border-bottom:none;\"><b>REKAPITULASI SISA TU</b></td>
            </tr>
         
            <tr>
                <td align=\"left\" style=\"font-size:12px;\">&nbsp;</td>
                <td align=\"left\" style=\"font-size:12px;\"></td>
            </tr></table>";
           $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\"> 
            <tr>
                <td  width=\"10%\" align=\"left\" style=\"font-size:12px;\">SKPD</td>
                <td  width=\"90%\" align=\"left\" style=\"font-size:12px;\">:&nbsp;$trh2->kd_skpd / $trh2->nm_skpd</td>
            </tr>
      
            <tr>
                <td align=\"left\" style=\"font-size:12px;\">&nbsp;</td>
                <td align=\"left\" style=\"font-size:12px;\"></td>
            </tr>            
            </table>";
           
            if ($pilih==2) {
              # code...
             $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
                <tr>
                    <td align=\"center\" colspan=\"4\" width=\"20%\" style=\"font-size:20px\">SP2D</td>
                    <td align=\"center\" colspan=\"4\" width=\"10%\" style=\"font-size:20px\">SPJ</td>
                 
                    <td align=\"center\" rowspan=\"2\"  width=\"30%\" style=\"font-size:20px\">SISA SP2D</td>                   
                    
                   
                </tr>
                <tr>
                     <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>NO SP2D<b></td>
                     <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>KODE KEGIATAN</b></td>
                     <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>KODE REK<b></td>
                     <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>JUMLAH SP2D<b></td>

                     <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>NO BUKTI<b></td>
                     <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>KODE KEGIATAN</b></td>
                     <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>KODE REK5<b></td>
                     <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>JUMLAH SPJ<b></td>
              
                </tr>
                <tr>
                     <td width=\"30%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>1<b></td>
                     <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>2</b></td>
                     <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>3<b></td>
                     <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>4<b></td>

                     <td width=\"20%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>5<b></td>
                     <td width=\"20%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>6</b></td>
                     <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>7<b></td>
                     <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>8<b></td>
                     <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>9<b></td>
              
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan=\"9\" valign=\"top\" align=\"center\" style=\"font-size:12px;border-bottom:none;border-top:solid 1px black;\"></td>
                 </tr>
            </tfoot>

           ";
           $sql_sp2d = "SELECT a.no_sp2d, '' AS kd_kegiatan, b.kd_rek5,b.nilai
FROM trhsp2d a  INNER JOIN trdspp b ON a.no_spp=b.no_spp 
WHERE a.no_sp2d = '$no_sp2d' AND a.jns_spp = '3'";
 $hasil_sp2d = $this->db->query($sql_sp2d);
  foreach ($hasil_sp2d->result() as $row){
      $nosp2d = $row->no_sp2d;
         $kd_rek5sp2d = $row->kd_rek5;
          $nilai_sp2d = $row->nilai;
            $j_nilai_sp2d = number_format($nilai_sp2d ,0,',','.');


    $cRet .= 
                  "<tr>
                    <td align=\"center\" width=\"10%\" style=\"font-size:16px\">$nosp2d</td>
                    <td align=\"center\" style=\"font-size:16px\"></td>
                    <td align=\"center\" style=\"font-size:16px\">$kd_rek5sp2d</td>
                    <td align=\"right\"  style=\"font-size:16px\">$j_nilai_sp2d</td>
                    <td align=\"right\" style=\"font-size:16px\"></td>
                    <td align=\"center\" style=\"font-size:16px\"></td>
                    <td align=\"right\" style=\"font-size:16px\"></td>
                  <td align=\"right\" style=\"font-size:16px\"></td>
                  <td align=\"right\" style=\"font-size:16px\"></td>
                         </tr>";
                       }
               $sql_spj = "SELECT a.no_bukti,b.kd_kegiatan,b.kd_rek5,a.total FROM trhtransout a 
INNER JOIN trdtransout b ON a.no_bukti=b.no_bukti WHERE a.no_sp2d = '$no_sp2d'
ORDER BY a.no_bukti ASC"    ;  
   $hasil_spj = $this->db->query($sql_spj);
         foreach ($hasil_spj->result() as $row){
 $no_bukti = $row->no_bukti;
         $kode_kegiatan = $row->kd_kegiatan;
         $kd_rek5 = $row->kd_rek5;
          $nilai_spj = $row->total;
          $j_nilai_spj = number_format($nilai_spj ,0,',','.');

  $cRet .= 
                  "<tr>
                    <td align=\"center\" width=\"10%\" style=\"font-size:16px\"></td>
                    <td align=\"center\" style=\"font-size:16px\"></td>
                    <td align=\"center\" style=\"font-size:16px\"></td>
                    <td align=\"right\"  style=\"font-size:16px\"></td>
                    <td align=\"right\" style=\"font-size:16px\">$no_bukti</td>
                    <td align=\"center\" style=\"font-size:16px\">$kode_kegiatan</td>
                    <td align=\"right\" style=\"font-size:16px\">$kd_rek5</td>
                  <td align=\"right\" style=\"font-size:16px\">$j_nilai_spj</td>
                  <td align=\"right\" style=\"font-size:16px\"></td>
                         </tr>";
            }
           $n_total_kas = 0;
          $n_jum_spj = 0;
          $hasil = $this->db->query($csql3);
         foreach ($hasil->result() as $row){
          $no_sp2d = $row->no_sp2d; 
         $nilai = $row->jum_sp2d;
         $n_nilai_sp2d = number_format($nilai ,0,',','.');
         $no_bukti = $row->no_bukti;
         $kode_kegiatan = $row->kd_kegiatan;
          $kd_reksp2d = $row->kode_rek;
         $kd_rek5 = $row->kd_rek5;
         // if ($nilai == $nilai) {
         //   $nilai = '';
         // }

         // if ($kd_reksp2d == $kd_reksp2d) {
         //  $kd_reksp2d = '';
         // }
         $nilai_spj = $row->jum_spj;
         $n_nilai_spj = number_format($nilai_spj ,0,',','.');
         $n_jum_spj =  $n_jum_spj + $nilai_spj;
          $n_kas = $row->total;
        
         $j_jum_spj = number_format($n_jum_spj ,0,',','.');
          $sisa_sp2d = $nilai - ($n_jum_spj+$n_kas);
          $n_sisa_sp2d = number_format($sisa_sp2d ,0,',','.');
          $n_total_kas = $n_total_kas + $n_kas;
          $j_total_kas = number_format($n_total_kas ,0,',','.');
        
           
        
              
             }  

        $cRet .= 
                  "<tr>
                     <td align=\"center\" width=\"10%\" style=\"font-size:16px\"></td>
                      <td align=\"center\" width=\"10%\" style=\"font-size:16px\"></td>
                       <td align=\"center\" width=\"10%\" style=\"font-size:16px\"></td>
                        <td align=\"center\" width=\"10%\" style=\"font-size:16px\"></td>
                         <td align=\"center\" width=\"10%\" style=\"font-size:16px\"></td>
                          <td align=\"center\" width=\"10%\" style=\"font-size:16px\"></td>
                           <td align=\"center\" width=\"10%\" style=\"font-size:16px\"></td>
                            <td align=\"center\" width=\"10%\" style=\"font-size:16px\"></td>
                             <td align=\"center\" width=\"10%\" style=\"font-size:16px\">$n_sisa_sp2d</td>
                         </tr>";     
     
         
            
         $cRet .="      
                  
                 </table>"; 
          $cRet .="<table  width=\"100%\" align=\"center\" cellspacing=\"1\" cellpadding=\"1\">
          
                  <tr>
                     <td align=\"left\" width=\"10%\" style=\"font-size:16px\">1. TOTAL SP2D : $n_nilai_sp2d</td>
                  </tr>";

          $cRet .= 
                  "<tr>
                      <td align=\"left\" width=\"10%\" style=\"font-size:16px\">2. TOTAL SPJ : $j_jum_spj</td>
                  </tr>";

          $cRet .=         
                  "<tr>
                       <td align=\"left\" width=\"10%\" style=\"font-size:16px\">3. PENGEMBALIAN KAS :$j_total_kas</td>
                  </tr>"; 
          $cRet .=         
                  "<tr>
                       <td align=\"left\" width=\"10%\" style=\"font-size:16px\">4. SISA SP2D (1 - (2+3)) :$n_sisa_sp2d</td>
                  </tr>"; 
           $cRet .="  
           </table>";      
            


         }

        if ($pilih==1) {
            
           $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
            <thead>
                <tr>
                    <td align=\"center\" width=\"20%\" style=\"font-size:12px\">No SP2D</td>
                    <td align=\"center\" width=\"10%\" style=\"font-size:12px\">KODE KEGIATAN</td>
                    <td align=\"center\" width=\"10%\" style=\"font-size:12px\">Tanggal SP2D</td>
                    <td align=\"center\" width=\"20%\" style=\"font-size:12px\">KEPERLUAN</td>
                    <td align=\"center\" colspan=\"10\" width=\"30%\" style=\"font-size:12px\">NILAI SP2D</td>                   
                    <td align=\"center\" width=\"10%\" style=\"font-size:12px\">NILAI SPJ</td>
                    <td align=\"center\" width=\"10%\" style=\"font-size:12px\">PENGEMBALIAN KAS</td>
                    <td align=\"center\" width=\"10%\" style=\"font-size:12px\">SISA TU</td>
                   
                </tr>
                <tr>
                    <td align=\"center\" style=\"font-size:12px\">1</td>
                    <td align=\"center\" style=\"font-size:12px\">2</td>
                    <td align=\"center\" style=\"font-size:12px\">3</td>
                    <td align=\"center\"  style=\"font-size:12px\">4</td>
                    <td align=\"center\" colspan=\"10\" style=\"font-size:12px\">5</td>
                    <td align=\"center\" style=\"font-size:12px\">6</td>
                    <td align=\"center\" style=\"font-size:12px\">7</td>
                     <td align=\"center\" style=\"font-size:12px\">8</td>
              
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan=\"16\" valign=\"top\" align=\"center\" style=\"font-size:12px;border-bottom:none;border-top:solid 1px black;\"></td>
                 </tr>
            </tfoot>

           ";
          $hasil = $this->db->query($csql3);
          //$n_sisa_tu = 0;
        foreach ($hasil->result() as $row){
          $no_sp2d = $row->no_sp2d;
          $kd_kegiatan = $row->kode_kegiatan;
          $tgl_sp2d = $row->tgl_sp2d;
          $keperluan = $row->keperluan;
          $nilai = $row->nilai;
          $n_nilai_sp2d = number_format($nilai ,0,',','.');
          $nilai_spj = $row->n_sp2d;
          $n_nilai_spj = number_format($nilai_spj ,0,',','.');
          $sisa_tu = $nilai - $nilai_spj;
          $n_sisa_tu = number_format($sisa_tu ,0,',','.');
        
           
            $cRet .= "<tr>
                           <td align=\"center\" style=\"font-size:12px\">$no_sp2d</td>
                            <td align=\"center\" style=\"font-size:12px\">$kd_kegiatan</td>
                    <td align=\"center\" style=\"font-size:12px\">$tgl_sp2d</td>
                    <td align=\"center\" style=\"font-size:12px\">$keperluan</td>
                    <td align=\"right\" colspan=\"10\" style=\"font-size:12px\">$n_nilai_sp2d</td>
                    <td align=\"right\" style=\"font-size:12px\">$n_nilai_spj</td>
                    <td align=\"center\" style=\"font-size:12px\"></td>
                    <td align=\"right\" style=\"font-size:12px\">$n_sisa_tu</td>
                
                         </tr>";
              
            }           
            
         $cRet .="      
     
                 </table>"; 


         }




                 

 
                 

    
          $data['prev']= $cRet;
                $this->tukd_model->_mpdf('',$cRet,5,5,5,1); 
               //  $this->_mpdf1('',$cRet,'5','5',5,'1');   

        // $data['prev']= $cRet;    
        // switch($cetak) {        
        // case 1;
        //      $this->tukd_model->_mpdf('',$cRet,'5','5',5,'0');
        // break;
        // case 2;        
        //     header("Cache-Control: no-cache, no-store, must-revalidate");
        //     header("Content-Type: application/vnd.ms-excel");
        //     header("Content-Disposition: attachment; filename= bku.xls");
        //     $this->load->view('anggaran/rka/perkadaII', $data);
        // break;
        // }
	}
	
  function load_sp2d() {
    $skpd     = $this->session->userdata('kdskpd');
   // $sql  = "SELECT id_p,rekanan,rekening,npwp FROM ms_rekanan $and group by id_p order by id_p";
    $sql = "SELECT no_sp2d, nilai FROM trhsp2d WHERE kd_skpd = '$skpd' AND jns_spp = '3' ";
    $query1 = $this->db->query($sql);  
    $result = array();
    $ii   = 0;
    foreach($query1->result_array() as $resulte){
      $result[] = array(
        'id'    => $ii,
        'no_sp2d'  => $resulte['no_sp2d'],
        'nilai'  => $resulte['nilai']
       
      );
      $ii++;
    }

    echo json_encode($result);

}
	  
	function delete(){
		$id			= $this->input->post('t_id');
		$proses		= $this->Mkontrak->delete($id);
		echo json_encode($proses);
	}
	
	function save(){ 
		$kode			= $this->input->post('kode');  
		$no_kontrak		= $this->input->post('no_kontrak');  
		$tgl_kontrak	= $this->input->post('tgl_kontrak');  
		$kegiatan		= $this->input->post('kegiatan');  
		$uraian			= $this->input->post('uraian');  
		$perusahaan		= $this->input->post('perusahaan');  
		$nilai			= $this->input->post('nilai'); 
		$skpd  			= $this->session->userdata('kdskpd');
		
		$values	= "('$kode','$no_kontrak','$tgl_kontrak','$kegiatan','$uraian','$perusahaan','$nilai', '$skpd')";
		$proses	= $this->Mkontrak->save($values);
		echo json_encode($proses);
	}
	
	function update(){  
		$kode			= $this->input->post('kode');   
		$no_kontrak		= $this->input->post('no_kontrak');   
		$tgl_kontrak	= $this->input->post('tgl_kontrak');   
		$kegiatan		= $this->input->post('kegiatan');   
		$uraian			= $this->input->post('uraian');   
		$perusahaan		= $this->input->post('perusahaan');   
		$nilai		 	= $this->input->post('nilai');     
		$proses			= $this->Mkontrak->update($kode,$no_kontrak,$tgl_kontrak,$kegiatan,$uraian,$perusahaan,$nilai);
		echo json_encode($proses);
	}
	
}

?>	