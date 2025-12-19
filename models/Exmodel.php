<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Exmodel extends CI_Model {
    
    function __construct()
        {
            parent::__construct();
        }
        
	function save_kib($dataexcel) {
	   //date('d-m-y,H:i:s'),
        for($i=0;$i<count($dataexcel);$i++){
            $data = array(
				 'no_reg'=>$dataexcel[$i]['no_reg'],
				'id_barang'=>$dataexcel[$i]['id_barang'],
				'no'=>$dataexcel[$i]['no'],
				'no_oleh'=>$dataexcel[$i]['no_oleh'],
				'tgl_reg'=>$dataexcel[$i]['tgl_reg'],
				'tgl_oleh'=>$dataexcel[$i]['tgl_oleh'],
				'no_dokumen'=>$dataexcel[$i]['no_dokumen'],
				'kd_brg'=>$dataexcel[$i]['kd_brg'],
				'detail_brg'=>$dataexcel[$i]['detail_brg'],
				'kd_tanah'=>$dataexcel[$i]['kd_tanah'],
				'nilai'=>$dataexcel[$i]['nilai'],
				'asal'=>$dataexcel[$i]['asal'],
				'dsr_peroleh'=>$dataexcel[$i]['dsr_peroleh'],
				'total'=>$dataexcel[$i]['total'],
				'kondisi'=>$dataexcel[$i]['kondisi'],
				'konstruksi'=>$dataexcel[$i]['konstruksi'],
				'jenis'=>$dataexcel[$i]['jenis'],
				'bangunan'=>$dataexcel[$i]['bangunan'],
				'luas'=>$dataexcel[$i]['luas'],
				'jumlah'=>$dataexcel[$i]['jumlah'],
				'tgl_awal_kerja'=>$dataexcel[$i]['tgl_awal_kerja'],
				'status_tanah'=>$dataexcel[$i]['status_tanah'],
				'nilai_kontrak'=>$dataexcel[$i]['nilai_kontrak'],
				'alamat1'=>$dataexcel[$i]['alamat1'],
				'alamat2'=>$dataexcel[$i]['alamat2'],
				'alamat3'=>$dataexcel[$i]['alamat3'],
				'no_mutasi'=>$dataexcel[$i]['no_mutasi'],
				'no_pindah'=>$dataexcel[$i]['no_pindah'],
				'no_hapus'=>$dataexcel[$i]['no_hapus'],
				'keterangan'=>$dataexcel[$i]['keterangan'],
				'kd_skpd'=>$dataexcel[$i]['kd_skpd'],
				'kd_unit'=>$dataexcel[$i]['kd_unit'],
				'milik'=>$dataexcel[$i]['milik'],
				'wilayah'=>$dataexcel[$i]['wilayah'],
				'username'=>$dataexcel[$i]['username'],
				'tgl_update'=>$dataexcel[$i]['tgl_update'],
				'tahun'=>$dataexcel[$i]['tahun'],
				'foto'=>$dataexcel[$i]['foto'],
				'foto2'=>$dataexcel[$i]['foto2'],
				'no_urut'=>$dataexcel[$i]['no_urut'],
				'lat'=>$dataexcel[$i]['lat'],
				'lon'=>$dataexcel[$i]['lon'],
				'kd_riwayat'=>$dataexcel[$i]['kd_riwayat'],
				'tgl_riwayat'=>$dataexcel[$i]['tgl_riwayat'],
				'detail_riwayat'=>$dataexcel[$i]['detail_riwayat'] 
            );
            
            $this->db->insert('trkib_f', $data);
        }
	}
	
	
}
