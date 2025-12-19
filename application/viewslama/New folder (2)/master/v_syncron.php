<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/demo/demo.css">
	<script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.edatagrid.js"></script>
    
    <link href="<?php echo base_url(); ?>easyui/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo base_url(); ?>easyui/jquery-ui.min.js"></script>
  <style>    
    #tagih {
        position: relative;
        width: 922px;
        height: 100px;
        padding: 0.4em;
    }  
    </style>
    <script type="text/javascript"> 
	var rec=0;
	var cek=0;
	var cek_tabel='';


	function AddItems(isi,pesan){
		var mySel = document.getElementById("isidata"); 
		var myOption; 

		myOption = document.createElement("Option"); 
		myOption.text = isi; 
		myOption.value = isi; 
		if(pesan =='0'){
			myOption.style = 'color:white;font-family:courier new;'; 
		}else if(pesan=='1'){
			myOption.style = 'color:red;font-family:courier new;'; 			
		}else if(pesan=='2'){
			myOption.style = 'color:#05E405;font-family:courier new;';
		}
		mySel.add(myOption);			
		bawah();
	}

	function bawah() {
		var objDiv = document.getElementById("isidata");
		objDiv.scrollTop = objDiv.scrollHeight;
		return false;
	}
	
	function record(ctabel){	
		
			$(document).ready(function(){
				$.ajax({
					type: "POST",
					url: '<?php echo base_url(); ?>/index.php/syncron/hitrecord',
					data: ({tabel:ctabel}),
					dataType:"json",
					success:function(data){
						rec=data.jumlah;
						isi_list(rec,ctabel);	
						//alert(rec);
					}
				});
			});  
		}

		function isi_list(rec,ctabel){
			if (rec>0){
				var a=0;
				for (var i=1;i<=rec ;i++ )
				{
					  setTimeout(function(){
							ambil_baris(a,ctabel,rec);
							a++;
					  },200*i);
				}
			}else if(rec=='out'){
				AddItems('Request Time Out...................................................................................................error 10060','1');
				lanjut('0',ctabel);
			}else{
				AddItems('Data tabel '+ctabel+' tidak ditemukan ','1');
				lanjut('0',ctabel);
			}
		}

	function ambil_baris(cbaris,ctabel,rec){
			var alamat='<?php echo base_url(); ?>/index.php/syncron/cek_syncron';
			$(document).ready(function(){
				$.ajax({
					type: "POST",
					url: alamat,
					data: ({baris:cbaris,tabel:ctabel}),
					dataType:"json",
					success:function(data){
							AddItems(data.isi,data.pesan);
							if (rec==data.baris){
								AddItems('Sinkronisasi tabel '+ctabel+' selesai ','2');
								lanjut(data.baris,ctabel);
							}
							 
					}
				});
			});        		
		
		}
    //tambahkan atau kurangi database yang akan ditransfer
	function lanjut(cek,cek_tabel){
		if(cek==rec)
		{
			if(cek_tabel=='d_hukum'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data d_hukum_ubah ke Server Pusat (simakda)','2');
				record('d_hukum_ubah');	
			}else if(cek_tabel=='d_hukum_ubah'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data dlpj_ppkd ke Server Pusat (simakda)','2');
				record('dlpj_ppkd');	
			}/*else if(cek_tabel=='dlpj_ppkd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data dyn_groups ke Server Pusat (simakda)','2');
				record('dyn_groups');	
			}else if(cek_tabel=='dyn_groups'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data dyn_menu ke Server Pusat (simakda)','2');
				record('dyn_menu');	
			}*/else if(cek_tabel=='dlpj_ppkd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data hlpj_ppkd ke Server Pusat (simakda)','2');
				record('hlpj_ppkd');	
			}else if(cek_tabel=='hlpj_ppkd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data levelid ke Server Pusat (simakda)','2');
				record('levelid');	
			}else if(cek_tabel=='levelid'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data login ke Server Pusat (simakda)','2');
				record('login');	
			}else if(cek_tabel=='login'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data m_giat ke Server Pusat (simakda)','2');
				record('m_giat');	
			}else if(cek_tabel=='m_giat'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data m_hukum ke Server Pusat (simakda)','2');
				record('m_hukum');	
			}else if(cek_tabel=='m_hukum'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data m_prog ke Server Pusat (simakda)','2');
				record('m_prog');	
			}else if(cek_tabel=='m_prog'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data map_lak ke Server Pusat (simakda)','2');
				record('map_lak');	
			}else if(cek_tabel=='map_lak'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data map_lak_kab ke Server Pusat (simakda)','2');
				record('map_lak_kab');	
			}else if(cek_tabel=='map_lak_kab'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data map_lak_prov ke Server Pusat (simakda)','2');
				record('map_lak_prov');	
			}else if(cek_tabel=='map_lak_prov'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data map_lo_kab ke Server Pusat (simakda)','2');
				record('map_lo_kab');	
			}else if(cek_tabel=='map_lo_kab'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data map_lo_ppkd_kab ke Server Pusat (simakda)','2');
				record('map_lo_ppkd_kab');	
			}else if(cek_tabel=='map_lo_ppkd_kab'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data map_lo_ppkd_prov ke Server Pusat (simakda)','2');
				record('map_lo_ppkd_prov');	
			}else if(cek_tabel=='map_lo_ppkd_prov'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data map_lo_prov ke Server Pusat (simakda)','2');
				record('map_lo_prov');	
			}else if(cek_tabel=='map_lo_prov'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data map_lo_skpd ke Server Pusat (simakda)','2');
				record('map_lo_skpd');	
			}else if(cek_tabel=='map_lo_skpd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data map_lpe_skpd ke Server Pusat (simakda)','2');
				record('map_lpe_skpd');	
			}else if(cek_tabel=='map_lpe_skpd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data map_lpsal ke Server Pusat (simakda)','2');
				record('map_lpsal');	
			}else if(cek_tabel=='map_lpsal'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data map_lra ke Server Pusat (simakda)','2');
				record('map_lra');	
			}else if(cek_tabel=='map_lra'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data map_lra_kab ke Server Pusat (simakda)','2');
				record('map_lra_kab');	
			}else if(cek_tabel=='map_lra_kab'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data map_lra_ppkd_kab ke Server Pusat (simakda)','2');
				record('map_lra_ppkd_kab');	
			}else if(cek_tabel=='map_lra_ppkd_kab'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data map_lra_ppkd_prov ke Server Pusat (simakda)','2');
				record('map_lra_ppkd_prov');	
			}else if(cek_tabel=='map_lra_ppkd_prov'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data map_lra_prov ke Server Pusat (simakda)','2');
				record('map_lra_prov');	
			}else if(cek_tabel=='map_lra_prov'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data map_lra_skpd ke Server Pusat (simakda)','2');
				record('map_lra_skpd');	
			}else if(cek_tabel=='map_lra_skpd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data map_neraca ke Server Pusat (simakda)','2');
				record('map_neraca');	
			}else if(cek_tabel=='map_neraca'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data map_neraca_ppkd ke Server Pusat (simakda)','2');
				record('map_neraca_ppkd');	
			}else if(cek_tabel=='map_neraca_ppkd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data map_neraca_skpd ke Server Pusat (simakda)','2');
				record('map_neraca_skpd');	
			}else if(cek_tabel=='map_neraca_skpd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data member ke Server Pusat (simakda)','2');
				record('member');	
			}else if(cek_tabel=='member'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data ms_bank ke Server Pusat (simakda)','2');
				record('ms_bank');	
			}else if(cek_tabel=='ms_bank'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data ms_bank_kasda ke Server Pusat (simakda)','2');
				record('ms_bank_kasda');	
			}else if(cek_tabel=='ms_bank_kasda'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data ms_bln ke Server Pusat (simakda)','2');
				record('ms_bln');	
			}else if(cek_tabel=='ms_bln'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data ms_dana ke Server Pusat (simakda)','2');
				record('ms_dana');	
			}else if(cek_tabel=='ms_dana'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data ms_fungsi ke Server Pusat (simakda)','2');
				record('ms_fungsi');	
			}else if(cek_tabel=='ms_fungsi'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data ms_harga ke Server Pusat (simakda)','2');
				record('ms_harga');	
			}else if(cek_tabel=='ms_harga'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data ms_kegiatan ke Server Pusat (simakda)','2');
				record('ms_kegiatan');	
			}else if(cek_tabel=='ms_kegiatan'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data ms_perusahaan ke Server Pusat (simakda)','2');
				record('ms_perusahaan');	
			}else if(cek_tabel=='ms_perusahaan'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data ms_program ke Server Pusat (simakda)','2');
				record('ms_program');	
			}else if(cek_tabel=='ms_program'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data ms_rek ke Server Pusat (simakda)','2');
				record('ms_rek');	
			}else if(cek_tabel=='ms_rek'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data ms_rek1 ke Server Pusat (simakda)','2');
				record('ms_rek1');	
			}else if(cek_tabel=='ms_rek1'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data ms_rek1_64 ke Server Pusat (simakda)','2');
				record('ms_rek1_64');	
			}else if(cek_tabel=='ms_rek1_64'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data ms_rek2 ke Server Pusat (simakda)','2');
				record('ms_rek2');	
			}else if(cek_tabel=='ms_rek2'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data ms_rek2_64 ke Server Pusat (simakda)','2');
				record('ms_rek2_64');	
			}else if(cek_tabel=='ms_rek2_64'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data ms_rek3 ke Server Pusat (simakda)','2');
				record('ms_rek3');	
			}else if(cek_tabel=='ms_rek3'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data ms_rek3_64 ke Server Pusat (simakda)','2');
				record('ms_rek3_64');	
			}else if(cek_tabel=='ms_rek3_64'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data ms_rek4 ke Server Pusat (simakda)','2');
				record('ms_rek4');	
			}else if(cek_tabel=='ms_rek4'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data ms_rek4_64 ke Server Pusat (simakda)','2');
				record('ms_rek4_64');	
			}else if(cek_tabel=='ms_rek4_64'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data ms_rek5 ke Server Pusat (simakda)','2');
				record('ms_rek5');	
			}else if(cek_tabel=='ms_rek5'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data ms_rek5_lama ke Server Pusat (simakda)','2');
				record('ms_rek5_lama');	
			}else if(cek_tabel=='ms_rek5_lama'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data ms_skpd ke Server Pusat (simakda)','2');
				record('ms_skpd');	
			}else if(cek_tabel=='ms_skpd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data ms_sumber ke Server Pusat (simakda)','2');
				record('ms_sumber');	
			}else if(cek_tabel=='ms_sumber'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data ms_ttd ke Server Pusat (simakda)','2');
				record('ms_ttd');	
			}else if(cek_tabel=='ms_ttd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data ms_unit ke Server Pusat (simakda)','2');
				record('ms_unit');	
			}else if(cek_tabel=='ms_unit'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data ms_urusan ke Server Pusat (simakda)','2');
				record('ms_urusan');	
			}else if(cek_tabel=='ms_urusan'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data ms_urusan1 ke Server Pusat','2');
				record('ms_urusan1');	
			}else if(cek_tabel=='ms_urusan1'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data otori ke Server Pusat (simakda)','2');
				record('otori');	
			}else if(cek_tabel=='otori'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data perkada ke Server Pusat (simakda)','2');
				record('perkada');	
			}else if(cek_tabel=='perkada'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data realisasi ke Server Pusat (simakda)','2');
				record('realisasi');	
			}else if(cek_tabel=='realisasi'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data realisasi_anggaran ke Server Pusat (simakda)','2');
				record('realisasi_anggaran');	
			}else if(cek_tabel=='realisasi_anggaran'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data realisasi_ppkd ke Server Pusat (simakda)','2');
				record('realisasi_ppkd');	
			}else if(cek_tabel=='realisasi_ppkd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data rek_lo ke Server Pusat (simakda)','2');
				record('rek_lo');	
			}else if(cek_tabel=='rek_lo'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data rg_lak ke Server Pusat (simakda)','2');
				record('rg_lak');	
			}else if(cek_tabel=='rg_lak'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data rg_neraca ke Server Pusat (simakda)','2');
				record('rg_neraca');	
			}else if(cek_tabel=='rg_neraca'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data saldo_bank ke Server Pusat (simakda)','2');
				record('saldo_bank');	
			}else if(cek_tabel=='saldo_bank'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data sclient ke Server Pusat (simakda)','2');
				record('sclient');	
			}else if(cek_tabel=='sclient'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data skpd_config ke Server Pusat (simakda)','2');
				record('skpd_config');	
			}else if(cek_tabel=='skpd_config'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data sumber_dana ke Server Pusat (simakda)','2');
				record('sumber_dana');	
			}else if(cek_tabel=='sumber_dana'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data tapd ke Server Pusat (simakda)','2');
				record('tapd');	
			}else if(cek_tabel=='tapd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data tr_ambilsimpanan ke Server Pusat (simakda)','2');
				record('tr_ambilsimpanan');	
			}else if(cek_tabel=='tr_ambilsimpanan'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data tr_ambilsimpanan_ppkd ke Server Pusat (simakda)','2');
				record('tr_ambilsimpanan_ppkd');	
			}else if(cek_tabel=='tr_ambilsimpanan_ppkd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data tr_jpanjar ke Server Pusat (simakda)','2');
				record('tr_jpanjar');	
			}else if(cek_tabel=='tr_jpanjar'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data tr_lepas ke Server Pusat (simakda)','2');
				record('tr_lepas');	
			}else if(cek_tabel=='tr_lepas'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data tr_pakai ke Server Pusat (simakda)','2');
				record('tr_pakai');	
			}else if(cek_tabel=='tr_pakai'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data tr_panjar ke Server Pusat (simakda)','2');
				record('tr_panjar');	
			}else if(cek_tabel=='tr_panjar'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data tr_setorsimpanan ke Server Pusat (simakda)','2');
				record('tr_setorsimpanan');	
			}else if(cek_tabel=='tr_setorsimpanan'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data tr_susut ke Server Pusat (simakda)','2');
				record('tr_susut');	
			}else if(cek_tabel=='tr_susut'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data tr_tagih ke Server Pusat (simakda)','2');
				record('tr_tagih');	
			}else if(cek_tabel=='tr_tagih'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data tr_terima ke Server Pusat (simakda)','2');
				record('tr_terima');	
			}else if(cek_tabel=='tr_terima'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data tr_terima_ppkd ke Server Pusat (simakda)','2');
				record('tr_terima_ppkd');	
			}else if(cek_tabel=='tr_terima_ppkd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data tr_tetap ke Server Pusat (simakda)','2');
				record('tr_tetap');	
			}else if(cek_tabel=='tr_tetap'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data tr_tetap_ppkd ke Server Pusat (simakda)','2');
				record('tr_tetap_ppkd');	
			}else if(cek_tabel=='tr_tetap_ppkd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data tr_utang ke Server Pusat (simakda)','2');
				record('tr_utang');	
			}else if(cek_tabel=='tr_utang'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trdharga ke Server Pusat (simakda)','2');
				record('trdharga');	
			}else if(cek_tabel=='trdharga'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trdju ke Server Pusat (simakda)','2');
				record('trdju');	
			}else if(cek_tabel=='trdju'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trdju_pkd ke Server Pusat (simakda)','2');
				record('trdju_pkd');	
			}else if(cek_tabel=='trdju_pkd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trdju_ppkd ke Server Pusat (simakda)','2');
				record('trdju_ppkd');	
			}else if(cek_tabel=='trdju_ppkd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trdkasin_pkd ke Server Pusat (simakda)','2');
				record('trdkasin_pkd');	
			}else if(cek_tabel=='trdkasin_pkd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trdkasin_ppkd ke Server Pusat (simakda)','2');
				record('trdkasin_ppkd');	
			}else if(cek_tabel=='trdkasin_ppkd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trdkasout_pkd ke Server Pusat (simakda)','2');
				record('trdkasout_pkd');	
			}else if(cek_tabel=='trdkasout_pkd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trdpo ke Server Pusat (simakda)','2');
				record('trdpo');	
			}else if(cek_tabel=='trdpo'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trdpo_ubah ke Server Pusat (simakda)','2');
				record('trdpo_ubah');	
			}else if(cek_tabel=='trdpo_ubah'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trdrekal ke Server Pusat (simakda)','2');
				record('trdrekal');	
			}else if(cek_tabel=='trdrekal'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trdrka ke Server Pusat (simakda)','2');
				record('trdrka');	
			}else if(cek_tabel=='trdrka'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trdskpd ke Server Pusat (simakda)','2');
				record('trdskpd');	
			}else if(cek_tabel=='trdskpd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trdspd ke Server Pusat (simakda)','2');
				record('trdspd');	
			}else if(cek_tabel=='trdspd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trdspp ke Server Pusat (simakda)','2');
				record('trdspp');	
			}else if(cek_tabel=='trdspp'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trdstrpot ke Server Pusat (simakda)','2');
				record('trdstrpot');	
			}else if(cek_tabel=='trdstrpot'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trdtagih ke Server Pusat (simakda)','2');
				record('trdtagih');	
			}else if(cek_tabel=='trdtagih'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trdtransout ke Server Pusat (simakda)','2');
				record('trdtransout');	
			}else if(cek_tabel=='trdtransout'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trdtransout_ppkd ke Server Pusat (simakda)','2');
				record('trdtransout_ppkd');	
			}else if(cek_tabel=='trdtransout_ppkd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trdtrmpot ke Server Pusat (simakda)','2');
				record('trdtrmpot');	
			}else if(cek_tabel=='trdtrmpot'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trhharga ke Server Pusat (simakda)','2');
				record('trhharga');	
			}else if(cek_tabel=='trhharga'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trhju ke Server Pusat (simakda)','2');
				record('trhju');	
			}else if(cek_tabel=='trhju'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trhju_pkd ke Server Pusat (simakda)','2');
				record('trhju_pkd');	
			}else if(cek_tabel=='trhju_pkd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trhju_ppkd ke Server Pusat (simakda)','2');
				record('trhju_ppkd');	
			}else if(cek_tabel=='trhju_ppkd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trhkasin_pkd ke Server Pusat (simakda)','2');
				record('trhkasin_pkd');	
			}else if(cek_tabel=='trhkasin_pkd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trhkasin_ppkd ke Server Pusat (simakda)','2');
				record('trhkasin_ppkd');	
			}else if(cek_tabel=='trhkasin_ppkd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trhkasout_pkd ke Server Pusat (simakda)','2');
				record('trhkasout_pkd');	
			}else if(cek_tabel=='trhkasout_pkd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trhrekal ke Server Pusat (simakda)','2');
				record('trhrekal');	
			}else if(cek_tabel=='trhrekal'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trhrka ke Server Pusat','2');
				record('trhrka');	
			}else if(cek_tabel=='trhrka'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trhsp2d ke Server Pusat (simakda)','2');
				record('trhsp2d');	
			}else if(cek_tabel=='trhsp2d'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trhspd ke Server Pusat (simakda)','2');
				record('trhspd');	
			}else if(cek_tabel=='trhspd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trhspm ke Server Pusat (simakda)','2');
				record('trhspm');	
			}else if(cek_tabel=='trhspm'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trhspp ke Server Pusat (simakda)','2');
				record('trhspp');	
			}else if(cek_tabel=='trhspp'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trhstrpot ke Server Pusat (simakda)','2');
				record('trhstrpot');	
			}else if(cek_tabel=='trhstrpot'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trhtagih ke Server Pusat (simakda)','2');
				record('trhtagih');	
			}else if(cek_tabel=='trhtagih'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trhtransout ke Server Pusat (simakda)','2');
				record('trhtransout');	
			}else if(cek_tabel=='trhtransout'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trhtransout_ppkd ke Server Pusat (simakda)','2');
				record('trhtransout_ppkd');	
			}else if(cek_tabel=='trhtransout_ppkd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trhtrmpot ke Server Pusat (simakda)','2');
				record('trhtrmpot');	
			}else if(cek_tabel=='trhtrmpot'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trlpj ke Server Pusat (simakda)','2');
				record('trlpj');	
			}else if(cek_tabel=='trlpj'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trskpd ke Server Pusat (simakda)','2');
				record('trskpd');	
			}else if(cek_tabel=='trskpd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trspmpot ke Server Pusat (simakda)','2');
				record('trspmpot');	
			}else if(cek_tabel=='trspmpot'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data user ke Server Pusat (simakda)','2');
				record('user');	
			}
		}
	}
	function apbd(){
			document.getElementById('isidata').innerHTML = "";
			AddItems('Sinkronisasi Data d_hukum ke Server Pusat (simakda)','2');
			record('d_hukum');
			
			
	}

    </script>

    <STYLE TYPE="text/css"> 
		 input.right{ 
         text-align:right; 
         } 
	</STYLE> 

</head>
<body>

<div id="content">

<h3 align="center">SYNCRONIZE DATA TO SERVER SIMAKDA</h3>
	<select name="isidata" id="isidata" multiple="multiple" style="width:100%;height:300px;background-color:#000000;border:0px" disabled>
	</select>
	<table width="100%">
		<tr align="center">
			<td  > 
			<INPUT TYPE="button" VALUE="PROSES" style="height:30px;width:80px" onclick="javascript:apbd();" >
			</td>
		</tr>
	</table>
</div>
</body>
</html>
