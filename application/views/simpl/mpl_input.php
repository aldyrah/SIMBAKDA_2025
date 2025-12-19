<script src="<?php echo base_url(); ?>lib/sweet-alert.min.js"></script>
<link   rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>lib/sweet-alert.css">
<script type="text/javascript" src="<?php echo base_url(); ?>easyui/autoCurrency.js"></script>
<script type="text/javascript">
    
    var updt = 'f';
    var idx2 = '';
    var total2 = 0;
	var lcidx = 0;
    var lcstatus = '';
	var no_lengkap = '';
	
     $(document).ready(function() {
		  $("#accordion").accordion({
			height: 500,
            width: 850,
            modal: true, 
            background:'#2da305',           
            autoOpen:false 
		  }); 
          $("#dialog-modal").dialog({
            height: 690,
            width: 1000,
            modal: true, 
            background:'#2da305',           
            autoOpen:false                
          }); 		  
		  $("#dialog-faiz").dialog({
            height: 370,
            width: 1250,
            modal: true, 
            background:'#2da305',           
            autoOpen:false                
          }); 
		  $("#dialog-zainol").dialog({
            height: 600,
            width: 1000,
            modal: true, 
            background:'#2da305',           
            autoOpen:false                
          });   
     });    
     //;;;;;;;;;;;;;;load HEADER;;;;;;;;;;;;;
    $(function(){         
         $('#trh').edatagrid({
    		url: "<?php echo base_url(); ?>index.php/simpl/ambil_plh_form_isian",
            idField:"no_transaksi",            
            rownumbers:"true", 
            fitColumns:"true",
            singleSelect:"true",
            //pagination:"true",
            autoRowHeight:"false",
            loadMsg:"Tunggu Sebentar....!!",
            nowrap:"true",                       
            columns:[[
        	    {field:'no_transaksi',title:'No. Trans',width:20,align:"center"},
                {field:'kegiatan',title:'Kode Kegiatan',width:30,align:"center"},
                {field:'nm_kegiatan',title:'Nama Kegiatan',width:80,align:"left"}, 
                {field:'nm_rekanan',title:'Rekanan',width:50,align:"left"},
				{field:'nm_pptk',title:'PPTK',width:30,align:"left"},
				{field:'jml_akhir',title:'Jml Akhir',width:30,align:"right"}, //"<img src='<?php echo base_url(); ?>/public/images/print.png' />//cetak() //<?php echo base_url(); ?>index.php/simpl/laporan_satu
				{field:'edit',width:10,align:'center',formatter:function(value,rec){ return "<img  src='<?php echo base_url(); ?>/public/images/edit.png' onclick='javascript:edit();'' />";}},
				///{field:'print',width:18,align:'center',formatter:function(value,rec){ return "<button window.open(<?php echo base_url(); ?>index.php/simpl/laporan_satu,'_blank');>PRINT</button>";}},
				{field:'hapuss',width:10,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapuss();'' />";}}
            ]],
            onSelect:function(rowIndex,rowData){ 
                no_transaksi   = rowData.no_transaksi; 
				kd_skpd   	   = rowData.kd_skpd;
                kegiatan       = rowData.kegiatan;
                nm_kegiatan    = rowData.nm_kegiatan;
				keterangan	   = rowData.keterangan;
				pptk	       = rowData.pptk;
                rekanan	       = rowData.rekanan;
                staf_penerima  = rowData.staf_penerima;
				ketua	       = rowData.ketua;
				anggota_satu   = rowData.anggota_satu;
				anggota_dua	   = rowData.anggota_dua;
                total          = rowData.total;
				jml_hps        = rowData.jml_hps;
				jml_tawar      = rowData.jml_tawar;
				jml_akhir      = rowData.jml_akhir;
				ppn   		   = rowData.ppn;
				pph1	   	   = rowData.pph1;
                pph2           = rowData.pph2;
				jml_ppn        = rowData.jml_ppn;
				jml_pph1       = rowData.jml_pph1;
				jml_pph2       = rowData.jml_pph2;
            get(no_transaksi,kd_skpd,kegiatan,nm_kegiatan,keterangan,pptk,rekanan,staf_penerima,ketua,anggota_satu,anggota_dua,total,jml_hps,jml_tawar,jml_akhir,ppn,pph1,pph2,jml_ppn,jml_pph1,jml_pph2); 
			load_detail(no_transaksi,kd_skpd);
            },onDblClickRow:function(rowIndex,rowData){
				lcidx 			= rowIndex;
                no_transaksi   = rowData.no_transaksi; 
				kd_skpd   	   = rowData.kd_skpd;
                kegiatan       = rowData.kegiatan;
                nm_kegiatan    = rowData.nm_kegiatan;
				keterangan	   = rowData.keterangan;
				pptk	       = rowData.pptk;
                rekanan	       = rowData.rekanan;
                staf_penerima  = rowData.staf_penerima;
				ketua	       = rowData.ketua;
				anggota_satu   = rowData.anggota_satu;
				anggota_dua	   = rowData.anggota_dua;
                total          = rowData.total;
				jml_hps        = rowData.jml_hps;
				jml_tawar      = rowData.jml_tawar;
				jml_akhir      = rowData.jml_akhir;
				ppn   		   = rowData.ppn;
				pph1	   	   = rowData.pph1;
                pph2           = rowData.pph2;
				jml_ppn        = rowData.jml_ppn;
				jml_pph1       = rowData.jml_pph1;
				jml_pph2       = rowData.jml_pph2;
                get(no_transaksi,kd_skpd,kegiatan,nm_kegiatan,keterangan,pptk,rekanan,staf_penerima,ketua,anggota_satu,anggota_dua,total,jml_hps,jml_tawar,jml_akhir,ppn,pph1,pph2,jml_ppn,jml_pph1,jml_pph2);
				
				judul 			= 'Edit Data Bagian'; 
				lcstatus 		= 'edit';
				section2();         
				load_detail(no_transaksi,kd_skpd); 
        }
        });
		
	   // ;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;; MENU TANGGAL 
        $('#tgl_rab').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();  					
           	return y+'-'+m+'-'+d;
            }
         });
		
		 $('#tgl_hps').datebox({  
            required:true ,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate(); 	
           	return y+'-'+m+'-'+d; 	
            },
			onSelect:function(){
			var rab= $('#tgl_rab').datebox('getValue'); 
			var hps= $('#tgl_hps').datebox('getValue');
			if (Date.parse(rab) < Date.parse(hps)){swal({title: "Error!",text: "MOHON TIDAK MELEBIHI TANGGAL RAB.!!",type: "error",confirmButtonText: "OK"});
				exit();
			}
			}
         });
		 
      $('#tgl_upl').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            },
			onSelect:function(){
			var upl= $('#tgl_upl').datebox('getValue'); 
			var hps= $('#tgl_hps').datebox('getValue');
			if (Date.parse(hps) < Date.parse(upl)){swal({title: "Error!",text: "MOHON TIDAK MELEBIHI TANGGAL Harga Perkiraan Sendiri.!!",type: "error",confirmButtonText: "OK"});
				exit();
			}
			}
         });
	 $('#tgl_spr').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            },
			onSelect:function(){
			var upl= $('#tgl_upl').datebox('getValue'); 
			var spr= $('#tgl_spr').datebox('getValue');
			if (Date.parse(upl) < Date.parse(spr)){swal({title: "Error!",text: "MOHON TIDAK MELEBIHI TANGGAL Undangan Penunjukan Langsung.!!",type: "error",confirmButtonText: "OK"});
				exit();
			}
			}
         });
		 $('#tgl_pi').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            },
			onSelect:function(){
			var pi = $('#tgl_pi').datebox('getValue'); 
			var spr= $('#tgl_spr').datebox('getValue');
			if (Date.parse(spr) < Date.parse(pi)){swal({title: "Error!",text: "MOHON TIDAK MELEBIHI TANGGAL Surat Penawaran Rekanan.!!",type: "error",confirmButtonText: "OK"});
				exit();
			}}
         });
		 
		 $('#tgl_bappd').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            },
			onSelect:function(){
			var pi = $('#tgl_pi').datebox('getValue'); 
			var bappd= $('#tgl_bappd').datebox('getValue');
			if (Date.parse(pi) < Date.parse(bappd)){swal({title: "Error!",text: "MOHON TIDAK MELEBIHI TANGGAL Pakta Integritas.!!",type: "error",confirmButtonText: "OK"});
				exit();
			}}
         });
		  $('#tgl_baek').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            },
			onSelect:function(){
			var baek = $('#tgl_baek').datebox('getValue'); 
			var bappd= $('#tgl_bappd').datebox('getValue');
			if (Date.parse(bappd) < Date.parse(baek)){swal({title: "Error!",text: "MOHON TIDAK MELEBIHI TANGGAL Penerimaan Dan Pembukaan Dok.!!",type: "error",confirmButtonText: "OK"});
				exit();
			}}
         });
		 	 $('#tgl_bahp').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            },
			onSelect:function(){
			var baek = $('#tgl_baek').datebox('getValue'); 
			var bahp = $('#tgl_bahp').datebox('getValue');
			if (Date.parse(baek) < Date.parse(bahp)){swal({title: "Error!",text: "MOHON TIDAK MELEBIHI TANGGAL B.A Hasil Evaluasi, Klarifikasi & Negoisasi.!!",type: "error",confirmButtonText: "OK"});
				exit();
			}}
         });
		 	 $('#tgl_nodi').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            },
			onSelect:function(){
			var nodi = $('#tgl_nodi').datebox('getValue'); 
			var bahp = $('#tgl_bahp').datebox('getValue');
			if (Date.parse(bahp) < Date.parse(nodi)){swal({title: "Error!",text: "MOHON TIDAK MELEBIHI TANGGAL B.A HASIL PENGADAAN LANGSUNG.!!",type: "error",confirmButtonText: "OK"});
				exit();
			}}
         });
		 	 $('#tgl_sppjb').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            }
         });

		 	 $('#tgl_spk').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            }
         });
		 	 $('#tgl_sp').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            }
         });
		 	 $('#tgl_spbj').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            }
         });
		 
		 	 $('#tgl_bapb1').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            }
         });
		 	 $('#tgl_bapb2').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            }
         });
		 	 $('#tgl_bast').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            }
         });
		 
		 	 $('#tgl_bapp').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            }
         });
		 	 $('#tgl_sk').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            }
         });
		 	 $('#tgl_kuitansi').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            }
         });
		 	 $('#tgl_ssp').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            }
         });
		 	 $('#tgl_faktur').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            }
         });
		 	 $('#tgl_spt').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            }
         });
		 
		  $('#tgl_rngks_kntrk').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            }
         });
		 
		 $('#tgl_terbit').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return d+'-'+m+'-'+y;
            }
         });
		  $('#tahun').combobox({           
            valueField:'tahun',  
            textField:'tahun',
            url:'<?php echo base_url(); ?>index.php/master/tahun'   
        });
		
		// ;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
		// ;;;;;;;;;;;;;;;;;;;; COMBO BOX ;;;;;;;;
       $('#uskpd').combogrid({  
            panelWidth:600,  
			width:160, 
            idField:'kd_skpd',  
            textField:'kd_skpd',  
            mode:'remote',                      
            url:'<?php echo base_url(); ?>index.php/simpl/load_skpd',  
            columns:[[  
               {field:'kd_skpd',title:'KODE SKPD',width:100},  
               {field:'nm_skpd',title:'NAMA SKPD',width:700}    
            ]],  
            onSelect:function(rowIndex,rowData){
               cuskpd = rowData.kd_skpd;  
               cnmuskpd = rowData.nm_skpd;  
				$('#kd').combogrid({url:'<?php echo base_url(); ?>index.php/simpl/load_kegiatan',queryParams:({skpd:cuskpd}) });
				$('#pptk').combogrid({url:'<?php echo base_url(); ?>index.php/simpl/load_pptk',queryParams:({skpd:cuskpd}) });
				$('#rekanan').combogrid({url:'<?php echo base_url(); ?>index.php/simpl/load_rekanan',queryParams:({skpd:cuskpd}) });
				$('#staf_penerima').combogrid({url:'<?php echo base_url(); ?>index.php/simpl/load_staf_terima',queryParams:({skpd:cuskpd}) });
				$('#ketua').combogrid({url:'<?php echo base_url(); ?>index.php/simpl/load_ketua',queryParams:({skpd:cuskpd}) });
				$('#anggota').combogrid({url:'<?php echo base_url(); ?>index.php/simpl/load_pengadaan',queryParams:({skpd:cuskpd}) });
				$('#anggota2').combogrid({url:'<?php echo base_url(); ?>index.php/simpl/load_penerima',queryParams:({skpd:cuskpd}) });
				$('#nmuskpd').attr('value',rowData.nm_skpd);   
				
            } 	   
         });  
		 
       $('#kd').combogrid({  
            panelWidth:600, 
            width:160, 
            idField:'kd_kegiatan',  
            textField:'kd_kegiatan',              
            mode:'remote',
            url:'<?php echo base_url(); ?>index.php/simpl/load_kegiatan',queryParams:({skpd:''}),
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kd_kegiatan',title:'Kode Kegiatan',width:100},  
               {field:'nm_kegiatan',title:'Nama Kegiatan',width:500}    
            ]],  
            onSelect:function(rowIndex,rowData){                                                             
                kd_kegiatan = rowData.kd_kegiatan;
				nm_kegiatan 	= rowData.nm_kegiatan;
				$('#namagiat').attr('value',nm_kegiatan);
            } 
        });
		
	$('#pptk').combogrid({  
            panelWidth:500, 
            width:300, 
            idField:'kode',  
            textField:'nama',              
            mode:'remote',
            url:'<?php echo base_url(); ?>index.php/simpl/load_pptk',
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kode',title:'Kode',width:100},  
               {field:'nama',title:'Nama',width:400}    
            ]],  
            onSelect:function(rowIndex,rowData){                                                             
                kode = rowData.kode;
				nama 	= rowData.nama;
            } 
        });
	
	$('#rekanan').combogrid({  
            panelWidth:500, 
            width:300, 
            idField:'kode',  
            textField:'nama',              
            mode:'remote',
            url:'<?php echo base_url(); ?>index.php/simpl/load_rekanan',
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kode',title:'Kode',width:100},  
               {field:'nama',title:'Nama',width:400}    
            ]],  
            onSelect:function(rowIndex,rowData){                                                             
                kode = rowData.kode;
				nama = rowData.nama;
            } 
        });
	$('#staf_penerima').combogrid({  
            panelWidth:500, 
            width:300, 
            idField:'kode',  
            textField:'nama',              
            mode:'remote',
            url:'<?php echo base_url(); ?>index.php/simpl/load_staf_terima',
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kode',title:'Kode',width:100},  
               {field:'nama',title:'Nama',width:400}    
            ]],  
            onSelect:function(rowIndex,rowData){                                                             
                kode = rowData.kode;
				nama 	= rowData.nama;
            } 
        });
		
		$('#ketua').combogrid({  
            panelWidth:500, 
            width:300, 
            idField:'kode',  
            textField:'nama',              
            mode:'remote',
            url:'<?php echo base_url(); ?>index.php/simpl/load_ketua',
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kode',title:'Kode',width:100},  
               {field:'nama',title:'Nama',width:400}    
            ]],  
            onSelect:function(rowIndex,rowData){                                                             
                kode = rowData.kode;
				nama 	= rowData.nama;
            } 
        });
	
	$('#anggota').combogrid({  
            panelWidth:500, 
            width:300, 
            idField:'kode',  
            textField:'nama',              
            mode:'remote',
            url:'<?php echo base_url(); ?>index.php/simpl/load_pengadaan',
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kode',title:'Kode',width:100},  
               {field:'nama',title:'Nama',width:400}    
            ]],  
            onSelect:function(rowIndex,rowData){                                                             
                kode = rowData.kode;
				nama 	= rowData.nama;
            } 
        });
		
		
		$('#anggota2').combogrid({  
            panelWidth:500, 
            width:300, 
            idField:'kode',  
            textField:'nama',              
            mode:'remote',
            url:'<?php echo base_url(); ?>index.php/simpl/load_penerima',
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kode',title:'Kode',width:100},  
               {field:'nama',title:'Nama',width:400}    
            ]],  
            onSelect:function(rowIndex,rowData){                                                             
                kode = rowData.kode;
				nama 	= rowData.nama;
            } 
        });
		
		$('#pajak').combogrid({  
            panelWidth:200, 
            width:100, 
			panelHeight:150,
            idField:'kode',  
            textField:'kode',              
            mode:'remote',
            url:'<?php echo base_url(); ?>index.php/simpl/load_pajak',
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kode',title:'Kode',width:50},  
               {field:'nama',title:'Nama',width:150}    
            ]],  
            onSelect:function(rowIndex,rowData){                                                             
                kode = rowData.kode;
				nama = rowData.nama;
				besar = rowData.besar;
				$('#nama_pajak').attr('value',nama);
				if(kode=='00'){
				$('#jml_ppn').attr('value','');
				$('#besar_pajak').attr('value','');
				}else{
				var harga_akhir = angka(document.getElementById('harga_akhir').value);
				var jml_ppn     = harga_akhir/11;
				$('#jml_ppn').attr('value',number_format(Math.round(jml_ppn)));
				$('#besar_pajak').attr('value',besar);
            } }
        });
		
		$('#pajak1').combogrid({  
            panelWidth:200, 
            width:100, 
			panelHeight:150,
            idField:'kode',  
            textField:'kode',              
            mode:'remote',
            url:'<?php echo base_url(); ?>index.php/simpl/load_pajak',
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kode',title:'Kode',width:50},  
               {field:'nama',title:'Nama',width:150}    
            ]],  
            onSelect:function(rowIndex,rowData){                                                             
                kode = rowData.kode;
				nama = rowData.nama;
				besar = rowData.besar;
				$('#nama_pajak1').attr('value',nama);
				var cpajak  = $('#pajak').combogrid('getValue');
				if(cpajak=='00'){
					var harga_akhir = angka(document.getElementById('harga_akhir').value); 
					var jml_ppn1    = (harga_akhir*(besar/100));
					$('#jml_ppn1').attr('value',number_format(Math.round(jml_ppn1)));
					$('#besar_pajak1').attr('value',besar);
				
				}else{
					if(kode=='00'){
					$('#jml_ppn1').attr('value','');
					$('#besar_pajak1').attr('value','');
					}else{
					var harga_akhir = angka(document.getElementById('harga_akhir').value); 
					var jml_ppn1    = (harga_akhir-(harga_akhir/11))*(besar/100);
					$('#jml_ppn1').attr('value',number_format(Math.round(jml_ppn1)));
					$('#besar_pajak1').attr('value',besar);
					}
					
			}
			}
        });
		
		$('#pajak2').combogrid({  
            panelWidth:200, 
            width:100, 
			panelHeight:150,
            idField:'kode',  
            textField:'kode',              
            mode:'remote',
            url:'<?php echo base_url(); ?>index.php/simpl/load_pajak',
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kode',title:'Kode',width:50},  
               {field:'nama',title:'Nama',width:150}    
            ]],  
            onSelect:function(rowIndex,rowData){                                                             
                kode = rowData.kode;
				nama = rowData.nama;
				besar = rowData.besar;
				$('#nama_pajak2').attr('value',nama);
				var cpajak  = $('#pajak').combogrid('getValue');
				if(cpajak=='00'){
					var harga_akhir = angka(document.getElementById('harga_akhir').value); 
					var jml_ppn1    = (harga_akhir*(besar/100));
					$('#jml_ppn2').attr('value',number_format(Math.round(jml_ppn1)));
					$('#besar_pajak2').attr('value',besar);
				
				}else{
				if(kode=='00'){
				$('#jml_ppn2').attr('value','');
				$('#besar_pajak2').attr('value','');
				}else{
				var harga_akhir = angka(document.getElementById('harga_akhir').value);
				var jml_ppn2     = (harga_akhir-(harga_akhir/11))*(besar/100); 
				$('#jml_ppn2').attr('value',number_format(Math.round(jml_ppn2))); 
				$('#besar_pajak2').attr('value',besar);
            }} 
			}
        });
		
		 $('#splh_prsen').combobox({           
				valueField:'nama',  
				textField:'nama',
				width:50,
				height:20,
				data:[{kode:'1',nama:'10%',height:20}],
				onSelect:function(){
					var jumlah  	 = angka(document.getElementById('jumlah').value); 
					var harga_hps  	 = angka(document.getElementById('harga_hps').value);
					var harga_tawar  = angka(document.getElementById('harga_tawar').value);
					var harga_akhir  = angka(document.getElementById('harga_akhir').value);
					var f = (10*jumlah)/100;
					var a = (10*harga_hps)/100;
					var i = (10*harga_tawar)/100;
					var z = (10*harga_akhir)/100;
					
					var v = Math.round(f+jumlah);
					var e = Math.round(a+harga_hps);
					var r = Math.round(i+harga_tawar);
					var o = Math.round(z+harga_akhir);
					$('#jumlah').attr('value',number_format(v,2,'.',','));
					$('#harga_hps').attr('value',number_format(e,2,'.',','));
					$('#harga_tawar').attr('value',number_format(r,2,'.',','));
					$('#harga_akhir').attr('value',number_format(o,2,'.',','));
					}
				});
		
     $('#warna').combogrid({  
       panelWidth:300,  
       idField:'nm_warna',  
       textField:'nm_warna',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_warna',  
       columns:[[  
           {field:'kd_warna',title:'KODE WARNA',width:100},  
           {field:'nm_warna',title:'WARNA',width:170}    
       ]] 
     });
     
     $('#bahan').combogrid({  
       panelWidth:300,  
       idField:'nm_bahan',  
       textField:'nm_bahan',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_bahan',  
       columns:[[  
           {field:'kd_bahan',title:'KODE BAHAN',width:100},  
           {field:'nm_bahan',title:'BAHAN',width:170}    
       ]] 
     });
     
     $('#satuan_detail').combogrid({  
       panelWidth:300,  
       idField:'nm_satuan',  
       textField:'nm_satuan',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_satuan',  
       columns:[[  
           {field:'kd_satuan',title:'KODE SATUAN',width:100},  
           {field:'nm_satuan',title:'SATUAN',width:170}    
       ]] 
     });
     
     $('#kondisi').combogrid({  
       panelWidth:200,  
       idField:'kondisi',  
       textField:'kondisi',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/mkondisi',
       loadMsg:"Tunggu Sebentar....!!",  
       columns:[[  
           {field:'kode',title:'Kode',width:40},
           {field:'kondisi',title:'Kondisi',width:150}
       ]],
        onSelect:function(rowIndex,rowData){
           lckondisi = rowData.kode;
           $("#kon").attr("value",rowData.kondisi.toUpperCase());
       }  
     });
		/*****AUTO HIDE RINCIAN BARANG*****/
		$("#rincian_barang").hide();
		$("#tutup").hide();
		$("#buka").show();
		$("#tutup_dpa").hide();
		$("#buka_dpa").show();
		$("#tambah_dpa").hide();
		/*********END RINCIAN*************/
	 
    });
		/*****AUTO HIDE RINCIAN BARANG*****/
	function detail(){
		$("#rincian_barang").show();
		$("#tambah_dpa").show();
		$("#tutup").show();
		$("#buka").hide();
		$("#tutup_dpa").show();
		$("#buka_dpa").hide();
		}
	function detail_tutup(){
		$("#rincian_barang").hide();
		$("#tambah_dpa").hide();
		$("#buka").show();
		$("#tutup").hide();
		$("#buka_dpa").show();
		$("#tutup_dpa").hide();
		}
		/*********END RINCIAN*************/
	function load_detail3(){
        var i = 0; 
		//document.getElementById('no_transaksi').value;
		var kd_skpd 	  = $('#uskpd').combogrid('getValue');
		var kd_giat 	  = $('#kd').combogrid('getValue'); 
		var no_transaksi  = document.getElementById('no_transaksi').value;
         $.ajax({
		    type: "POST",
                url: '<?php echo base_url(); ?>index.php/simpl/load_rinci_skpd',
                data: ({kd_skpd:kd_skpd,kd_giat:kd_giat,no_transaksi:no_transaksi}),
				loadMsg:"sedang mengambil rincian ...",
                dataType:"json",/*  
                rowStyler: function(index,row){
                    if (row.no>1){
                        return 'background-color:#6293BB;color:#fff;font-weight:bold;';
                    }
                }, */
                success:function(data){  			
                    $.each(data.rows,function(i,n){ 
						kodegiat     = n['kodegiat'];
						koderek     = n['koderek'];
						no		    = n['no'];
                        uraian      = n['uraian'];                                                                                     
                        c4     		= n['c4'];
                        n4      	= n['n4'];
                        satuan      = n['satuan'];                        
                        jumlah      = n['jumlah'];      
						$('#trd2').edatagrid('appendRow',{kodegiat:kodegiat,koderek:koderek,no:no,uraian:uraian,c4:c4,n4:n4,satuan:satuan,jumlah:jumlah});
						$('#kode').attr('value',koderek);
						$('#no').attr('value',no);
                     }); 
					}
         });         
          set_grid2();
    }
	
	
	 $('#kd_giat').combogrid({  
            panelWidth:600, 
            width:160, 
            idField:'kd_kegiatan',  
            textField:'kd_kegiatan',              
            mode:'remote',
            url:'<?php echo base_url(); ?>index.php/simpl/load_giat',
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kd_kegiatan',title:'Kode Kegiatan',width:100},  
               {field:'nm_kegiatan',title:'Nama Kegiatan',width:500}    
            ]],  
            onSelect:function(rowIndex,rowData){                                                             
                kd_kegiatan 	= rowData.kd_kegiatan;
				nm_kegiatan 	= rowData.nm_kegiatan;
				$('#namagiat').attr('value',nm_kegiatan);
            } 
        }); 
    // ;;;;;;;;;;;;;;;;;;; LINK PANGGILAN DITOMBOL
    function section1(){   
        $('#sec1').click(); 
        //set_grid(); 
        $('#trh').datagrid('reload');
    }
    function section2(){           
        $('#sec2').click();
		//$('#dgd').edatagrid('open'); 
        //load_detail();
        //set_grid();                                                        
    }

	function section3(){
	  $('#sec3').click();
	  ambil_pl_lengkap();
      //load_lengkap();
        //set_grid();  
	}
	
	function keluar_barang(){		
	simpan();
	var no_transaksi = document.getElementById('no_transaksi').value;
	var kd_skpd		 = $('#uskpd').combogrid('getValue'); 
	simpan_trd();
	load_detail(no_transaksi,kd_skpd);
	$('#dgd').edatagrid('reload'); 
	$("#dialog-modal").dialog('close');
	}
	
	function ambil_barang(){
	if (cuskpd != '' && kd_kegiatan != '' ){
	$("#dialog-modal").dialog('open');
	load_detail3()
	set_grid2()
	} else {
	alert('SKPD dan Kegiatan diisi terlebuh dahulu');
		}
	}

	// ;;;;;;;; AMBIL PADA SAAT DOBLEKLIK TRH ;;;;;;;;;;;
	// -----ini get header dan detail--
    function get(no_transaksi,kd_skpd,kd_kegiatan,nm_kegiatan,keterangan,pptk,rekanan,staf_penerima,ketua,anggota_satu,anggota_dua,total,jml_hps,jml_tawar,jml_akhir,ppn,pph1,pph2,jml_ppn,jml_pph1,jml_pph2){     
		$('#no_transaksi').attr('value',no_transaksi);
		$('#uskpd').combogrid('setValue',kd_skpd);
		$('#kd').combogrid('setValue',kd_kegiatan);
		$('#namagiat').attr('value',nm_kegiatan);
		$('#keterangan').attr('value',keterangan);
		$('#pptk').combogrid('setValue',pptk);
		$('#rekanan').combogrid('setValue',rekanan);
		$('#staf_penerima').combogrid('setValue',staf_penerima);
		$('#ketua').combogrid('setValue',ketua);
		$('#anggota').combogrid('setValue',anggota_satu);
		$('#anggota2').combogrid('setValue',anggota_dua);
		$('#jumlah').attr('value',number_format(total,2,'.',','));
		$('#harga_hps').attr('value',number_format(jml_hps,2,'.',','));
		$('#harga_tawar').attr('value',number_format(jml_tawar,2,'.',','));
		$('#harga_akhir').attr('value',number_format(jml_akhir,2,'.',','));
		$('#pajak').combogrid('setValue',ppn);
		$('#pajak1').combogrid('setValue',pph1);
		$('#pajak2').combogrid('setValue',pph2);
		$('#jml_ppn').attr('value',number_format(jml_ppn,2,'.',','));
		$('#jml_ppn1').attr('value',number_format(jml_pph1,2,'.',','));
		$('#jml_ppn2').attr('value',number_format(jml_pph2,2,'.',','));
        $('#no_transaksi').attr('disabled',false);
    }
	
	//-----ini get detail dibawah header----
    function  get4(no_transaksi,kode,no,uraian,satuan,vol,harga,harga_hps,harga_tawar,harga_akhir,jumlah){
		$("#no_transaksi2").attr("value",no_transaksi);
        $("#kode").attr("value",kode); 
        $("#no").attr("value",no);
        $("#uraian").attr("value",uraian); 
        $("#satuan").attr("value",satuan);
        $("#vol").attr("value",vol);
        $("#harga").attr("value",harga); 
		/* $("#harga_hps").attr("value",harga_hps); 
		$("#harga_tawar").attr("value",harga_tawar); 
		$("#harga_akhir").attr("value",harga_akhir); 	 */	
        $("#jumlah").attr("value",jumlah); 
		//$('#no_transaksi').attr('disabled',true);	
		hitung(no_transaksi);		
    }
	//;;;;;;;;;;;;;;;;;;;;;;;;;;;;; END GET ;;;;;;;;;;;;;;;;;
	//;;;;;;;;;;;;;;;;;;;;;;;;;;; INI FUNGSI KOSONG SAAT MENGAMBIL/MENAMBAH BARU ;;;;;;;  
    function kosong(){  
		var skpd  = '<?php echo ($this->session->userdata('skpd')); ?>';
        cdate = '<?php echo date("Y-m-d"); ?>';
        //cthn = '<?php echo date("Y"); ?>';    
        //$('#no_transaksi').attr('value','');
		$('#uskpd').combogrid('setValue',skpd);
		$('#kd').combogrid('setValue','');
		$('#namagiat').attr('value','');
		$('#keterangan').attr('value','');
		$('#pptk').combogrid('setValue','');
		$('#rekanan').combogrid('setValue','');
		$('#staf_penerima').combogrid('setValue','');
		$('#ketua').combogrid('setValue','');
		$('#anggota_satu').combogrid('setValue','');
		$('#anggota_dua').combogrid('setValue','');
		$('#pajak').combogrid('setValue','');
		$('#pajak1').combogrid('setValue','');
		$('#pajak2').combogrid('setValue','');
		$('#splh_prsen').combobox('setValue','');
		$('#nama_pajak').attr('value','');
		$('#besar_pajak').attr('value','');
		$('#nama_pajak1').attr('value','');
		$('#besar_pajak1').attr('value','');
		$('#nama_pajak2').attr('value','');
		$('#besar_pajak2').attr('value','');
		$('#jumlah').attr('value','');
		$('#harga_hps').attr('value','');
		$('#harga_tawar').attr('value','');
		$('#harga_akhir').attr('value','');
		$('#jml_ppn').attr('value','');
		$('#jml_ppn1').attr('value','');
		$('#jml_ppn2').attr('value','');
        $('#no_transaksi').attr('disabled',false);
    }
    	function kosong2(){
				$("#rinci_jenis").attr("value",'');
				$("#rinci_satuan").attr("value",'');
				$("#rinci_kuantitas").attr("value",'');
				$("#rinci_harga").attr("value",'');
				$("#rinci_hps").attr("value",'');
				$("#rinci_tawar").attr("value",'');
				$("#rinci_akhir").attr("value",''); 
	}
	
		function kosong3(){ 
		$('#no_transaksi').attr('value','');
		$('#tgl_rab').datebox('setValue','');
		$('#tgl_hps').datebox('setValue','');
		$('#tgl_upl').datebox('setValue','');
		$('#tgl_spr').datebox('setValue','');
		$('#tgl_pi').datebox('setValue','');
		$('#tgl_bappd').datebox('setValue','');
		$('#tgl_baek').datebox('setValue','');
		$('#tgl_bahp').datebox('setValue','');
		$('#tgl_nodi').datebox('setValue','');
		$('#tgl_sppjb').datebox('setValue','');
		$('#tgl_spk').datebox('setValue','');
		$('#tgl_sp').datebox('setValue','');
		$('#tgl_spbj').datebox('setValue','');
		$('#spbj').attr('value','');
		$('#tgl_bapb1').datebox('setValue','');
		$('#tgl_bapb2').datebox('setValue','');
		$('#tgl_bast').datebox('setValue','');
		$('#tgl_bapp').datebox('setValue','');
		$('#tgl_sk').datebox('setValue','');
		$('#tgl_kuitansi').datebox('setValue','');
		$('#tgl_ssp').datebox('setValue','');
		$('#tgl_faktur').datebox('setValue','');
		$('#tgl_spt').datebox('setValue','');
		$('#tgl_rngks_kntrk').datebox('setValue','');
		$('#no_upl').attr('value','');
		$('#no_spr').attr('value','');
		$('#no_bappd').attr('value','');
		$('#no_baek').attr('value','');
		$('#no_bahp').attr('value','');
		$('#no_nodi').attr('value','');
		$('#no_sppjb').attr('value','');
		$('#no_spk').attr('value','');
		$('#no_sp').attr('value','');
		$('#ket_spbj').attr('value','');
		$('#no_bapb1').attr('value','');
		$('#no_bapb2').attr('value','');
		$('#no_bast').attr('value','');
		$('#no_bapp').attr('value','');
		$('#no_spt').attr('value','');
		$('#wkt_pel').attr('value','');
		$('#jns_pem').attr('value','');
        //$('#no_transaksi').attr('disabled',false);
	}  
	
	 function kosong4(){
        $('#pekerjaan').attr('value','');
		$('#kd_giat').attr('value','');
		$('#kodereg').attr('value','');
		$('#tahun').combobox('setValue','');
		$('#sumber').attr('value','');
		$('#tgl_terbit').datebox('setValue','');
		$('#staf1').attr('value','');
		$('#nip1').attr('value','');
		$('#staf2').attr('value','');
		$('#nip2').attr('value','');
		$('#staf3').attr('value','');
		$('#nip3').attr('value','');
    }
	 function kosong_dpa(){
		$('#jns_brg_dpa').attr('value','');
		$('#satuan_dpa').attr('value','');
		$('#kuantitas_dpa').attr('value','');
		$('#harga_dpa').attr('value','');
		$('#jumlah_dpa').attr('value','');
    }
// ;;;;;;;;;;;;;;;;;;;;;; END KOSONG
 function tambah_urut(angka,panjang){
        no=((angka)*1);
        a=no.toString();
        jnol=panjang-a.length;
        nol='';
        for(i=1;i<=jnol;i++){
        nol=nol+'0';
        }
        b= nol+a;
        return b;
    }
	
	function nomer_akhir(){
        var i 	  = 0; 
		var skpd  = '<?php echo ($this->session->userdata('skpd')); ?>'; 
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>index.php/simpl/load_nomax',
            data: ({skpd:skpd}),
            dataType:"json",
            success:function(data){                                          
                $.each(data,function(i,n){                                    
                    no_trans      = n['no_trans'];
					nomorku		  = tambah_urut(no_trans,4); 
                    $("#no_transaksi").attr("value",nomorku);                              
                });
            }
        });         
    }
	 
	function max_rinci(){  
	var organisasi = $('#uskpd').combogrid('getValue');	
		$.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>index.php/simpl/load_idmax',
            data: ({skpd:organisasi,table:'pld_form_rincian',kolom:'no_urut'}),
            dataType:"json",
            success:function(data){                                          
                $.each(data,function(i,n){                                    
                    no_urut      = n['kode'];
					$("#no_urut").attr("value",no_urut);
                });
            }
        }); 
	 }
	 
	function load_detail(no_transaksi,kd_skpd){
		var kd_skpd   	    = kd_skpd;
		var no_transaksi    = no_transaksi; 
		$("#dgd").edatagrid({
        idField:'no_transaksi',
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        toolbar:'#toolbar',
        pagination:"true",
        nowrap:"true",
       	url: '<?php echo base_url(); ?>index.php/simpl/ambil_pld_form_isian',
        queryParams:({no:no_transaksi,kode:kd_skpd}),
              
        columns:[[
            	{field:'no_transaksi',title:'No. Trans',width:70,align:"center",hidden:true},
                {field:'kode',title:'Kode',width:100,align:"left",hidden:true},
                {field:'no',title:'No',width:100,align:"center",hidden:true},
				{field:'uraian',title:'Jenis Barang',width:230,align:"left"},
                {field:'satuan',title:'Satuan',width:100,align:"center"},
                {field:'vol',title:'Kuantitas',width:70,align:"center"},
				{field:'harga',title:'Harga',width:100,align:"right"},
				{field:'jumlah',title:'Jumlah',width:100,align:"right"},
                {field:'harga_hps',title:'H. HPS',width:100,align:"right"},
				{field:'harga_tawar',title:'H. Tawar',width:100,align:"right"},
				{field:'harga_akhir',title:'H. Akhir',width:100,align:"right"},
				{field:'add',width:35,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/document.png' onclick='javascript:tambah_rinci();'' />";}},
				{field:'hapus',width:35,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus();'' />";}}
				]],
		onSelect:function(rowIndex,rowData){
		  lcidx 		= rowIndex;
		  no_transaksi 	= rowData.no_transaksi;
		  kd_skpd		= rowData.kd_skpd;
		  tahun		 	= rowData.tahun;
		  kode 			= rowData.kode;
		  kodegiat		= rowData.kodegiat;
          no 			= rowData.no;
          uraian 		= rowData.uraian;
          satuan 		= rowData.satuan;
          vol 			= rowData.vol;
          harga 		= rowData.harga;
		  harga_hps 	= rowData.harga_hps;
		  harga_tawar 	= rowData.harga_tawar;
		  harga_akhir 	= rowData.harga_akhir;
          jumlah 		= rowData.jumlah; 
		  harga_hpsx 	= rowData.harga_hpsx;
		  harga_tawarx 	= rowData.harga_tawarx;
		  harga_akhirx 	= rowData.harga_akhirx;  
		  max_urut		= rowData.max_urut; 
		  $("#rinci_no_transaksi").attr("value",no_transaksi);
		  $("#rinci_kd_skpd").attr("value",kd_skpd);
		  $("#rinci_kode").attr("value",kode);
		  $("#rinci_kodegiat").attr("value",kodegiat);
		  $("#rinci_no").attr("value",no);
		  $("#rinci_uraian").attr("value",uraian.toUpperCase());
		  $("#no_urut").attr("value",max_urut);
		  load_rinci(no_transaksi,kd_skpd,kode,kodegiat,no,uraian,tahun); 
        }, 
		onDblClickRow:function(rowIndex,rowData){
				lcidx 	= rowIndex;
				no_transaksi   	= rowData.no_transaksi;                     
				kd_skpd    	 	= rowData.kd_skpd;                      
				kode       	 	= rowData.kode;                     
				kodegiat   	 	= rowData.kodegiat; 
				no     	     	= rowData.no;                      
				uraian    	 	= rowData.uraian;
				satuan     	 	= rowData.satuan;
				vol        	 	= rowData.vol;
				harga      	    = rowData.harga;
				jumlah     	    = rowData.jumlah;
				harga_hps       = rowData.harga_hps;
				harga_tawar     = rowData.harga_tawar;
				harga_akhir     = rowData.harga_akhir;
				harga_hpsx       = rowData.harga_hpsx;
				harga_tawarx     = rowData.harga_tawarx;
				harga_akhirx     = rowData.harga_akhirx;
		  merek		 	= rowData.merek;
		  tipe_detail 	= rowData.tipe_detail;
		  warna		 	= rowData.warna;
		  bahan		 	= rowData.bahan;
          satuan_detail	= rowData.satuan_detail; 
		  kondisi 		= rowData.kondisi;
		  keterangan 	= rowData.keterangan;  //satuan,hrg_total,tot_hps,tot_twr,tot_akhir
				$("#no_transaksix").attr("value",no_transaksi);
				$("#kd_skpdx").attr("value",kd_skpd);
				$("#kodex").attr("value",kode);
				$("#kodegiatx").attr("value",kodegiat);
				$("#nox").attr("value",no);
				$("#jns_brg").attr("value",uraian);
				$("#satuan").attr("value",satuan);
				$("#kuantitas").attr("value",vol);
				$("#harga").attr("value",harga);
				$("#hrg_total").attr("value",jumlah);
				$("#hrg_hps").attr("value",harga_hps);
				$("#hrg_twr").attr("value",harga_tawar);
				$("#hrg_akhir").attr("value",harga_akhir); 
				$("#tot_hps").attr("value",harga_hpsx);
				$("#tot_twr").attr("value",harga_tawarx);
				$("#tot_akhir").attr("value",harga_akhirx); 
				$("#jns_brgx").attr("value",uraian.toUpperCase());
				//merek,tipe,warna,bahan,satuan_detail,kondisi,ket_detail
			$("#merek").attr("value",merek);
			$("#tipe").attr("value",tipe_detail);
			$("#warna").combogrid("setValue",warna);
			$("#bahan").combogrid("setValue",bahan);
			$("#satuan_detail").combogrid("setValue",satuan_detail);
			$("#kondisi").combogrid("setValue",kondisi);
			$("#ket_detail").attr("value",keterangan);
				edit_data();
				}
           
    }); 
	
	}
	
	function load_rinci(no_transaksi,kd_skpd,kode,kodegiat,no,uraian,tahun){
		var nomor  		= no_transaksi;
        var skpd   		= kd_skpd; 
        var kode   		= kode; 
        var kodegiat   	= kodegiat; 
        var no   		= no; 
        var uraian   	= uraian; 
        var tahun   	= tahun;
		//alert(nomor+"--"+skpd+"--"+kode+"--"+kodegiat+"--"+no+"--"+uraian+"--"+tahun);
		$("#rinci").edatagrid({
        idField:'no_transaksi',
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        //toolbar:'#toolbar',
        pagination:"true",
        nowrap:"true",
       	url: '<?php echo base_url(); ?>index.php/simpl/load_rincian_rka',
        queryParams:({nomor:nomor,skpd:skpd,kode:kode,kodegiat:kodegiat,no:no,uraian:uraian,tahun:tahun}),
        columns:[[
            	{field:'hapus',width:35,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus_rinci();'' />";}},
            	{field:'no_transaksi',title:'No. Trans',width:70,align:"center",hidden:true},
                {field:'kode',title:'Kode',width:100,align:"left",hidden:true},
                {field:'kodegiat',title:'kodegiat',width:100,align:"center",hidden:true},
                {field:'no',title:'No',width:100,align:"center",hidden:true},
                {field:'kode_gabung',title:'gabung',width:100,align:"center",hidden:true},
				{field:'uraian',title:'Jenis Barang',width:130,align:"left"},
                {field:'satuan',title:'Satuan',width:100,align:"center"},
                {field:'vol',title:'Kuantitas',width:70,align:"center"},
				{field:'harga',title:'Harga',width:100,align:"right"},
				{field:'jumlah',title:'Jumlah',width:100,align:"right",hidden:true},
                {field:'harga_hps',title:'H. HPS',width:100,align:"right"}, 
				{field:'harga_tawar',title:'H. Tawar',width:100,align:"right"},
				{field:'harga_akhir',title:'H. Akhir',width:100,align:"right"},
            	{field:'harga_hpsx',title:'total hps',width:70,align:"center",hidden:true},
                {field:'harga_tawarx',title:'total twr',width:100,align:"left",hidden:true},
                {field:'harga_akhirx',title:'total akhir',width:100,align:"center",hidden:true}
			]],
		onSelect:function(rowIndex,rowData){
				lcidx 		= rowIndex;
				no_transaksi   	= rowData.no_transaksi;                     
				kd_skpd    	 	= rowData.kd_skpd;                      
				kode       	 	= rowData.kode;                     
				kodegiat   	 	= rowData.kodegiat; 
				no     	     	= rowData.no;    
				no_urut	    	= rowData.no_urut; 
				kode_gabung    	= rowData.kode_gabung;                        
				uraian    	 	= rowData.uraian;
				satuan     	 	= rowData.satuan;
				vol        	 	= rowData.vol;
				harga      	    = rowData.harga;
				jumlah     	    = rowData.jumlah;
				harga_hps       = rowData.harga_hps;
				harga_tawar     = rowData.harga_tawar;
				harga_akhir     = rowData.harga_akhir;
				$("#no_urut").attr("value",no_urut); 
				$("#rinci_no_transaksi").attr("value",no_transaksi);
				$("#rinci_kd_skpd").attr("value",kd_skpd);
				$("#rinci_kode").attr("value",kode);
				$("#rinci_kodegiat").attr("value",kodegiat);
				$("#rinci_no").attr("value",no);
				$("#rinci_jenis").attr("value",uraian);
				$("#rinci_satuan").attr("value",satuan);
				$("#rinci_kuantitas").attr("value",vol);
				$("#rinci_harga").attr("value",number_format(harga));
				$("#rinci_hps").attr("value",number_format(harga_hps));
				$("#rinci_tawar").attr("value",number_format(harga_tawar));
				$("#rinci_akhir").attr("value",number_format(harga_akhir)); 
				//$('#rinci').edatagrid('reload');
        }
           
    }); 
	
	
		/* var nomor  = no_transaksi; 
        var skpd   = kd_skpd; 
        var kode   = kode; 
        var kodegiat   = kodegiat; 
        var no   = no; 
        var uraian   = uraian; 
        var tahun   = tahun; //alert(nomor+"--"+skpd+"--"+kode+"--"+kodegiat+"--"+no+"--"+uraian+"--"+tahun);
         $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>index.php/simpl/load_rincian_rka',
                data: ({no:nomor,skpd:skpd,kode:kode,kodegiat:kodegiat,no:no,uraian:uraian,tahun:tahun}),
				singleSelect:"true",
				dataType:"json",
				fitColumns:"true",
				autoRowHeight:"false",
				pagination:"true",
                success:function(data){                                          
                    $.each(data,function(i,n){ 
                        no_transaksi   	= n['no_transaksi'];                     
                        kd_skpd    	 	= n['kd_skpd'];                      
                        kode       	 	= n['kode'];                      
                        kodegiat   	 	= n['kodegiat'];
                        no     	     	= n['no'];   
                        kode_gabung    	= n['kode_gabung'];                       
                        uraian    	 	= n['uraian'];
                        satuan     	 	= n['satuan'];
                        vol        	 	= n['vol'];
                        harga      	    = n['harga'];
                        jumlah     	    = n['jumlah'];
                        harga_hps       = n['harga_hps'];
                        harga_tawar     = n['harga_tawar'];
                        harga_akhir     = n['harga_akhir']; 
						harga_hpsx 		= n['harga_hpsx'];
						harga_tawarx 	= n['harga_tawarx'];
						harga_akhirx 	= n['harga_akhirx']; 
                    $('#rinci').edatagrid('appendRow',{no_transaksi:no_transaksi,kd_skpd:kd_skpd,kode:kode,kodegiat:kodegiat,no:no,kode_gabung:kode_gabung,uraian:uraian,satuan:satuan,vol:vol,harga:harga,jumlah:jumlah,harga_hps:harga_hps,harga_tawar:harga_tawar,harga_akhir:harga_akhir,harga_hpsx:harga_hpsx,harga_tawarx:harga_tawarx,harga_akhirx:harga_akhirx});                                
                    
					$('#rinci').edatagrid('reload'); 
                    });
                }
         });         
          rinci_grid();
    }
	
	   function rinci_grid(){
         $('#rinci').edatagrid({
        columns:[[
				{field:'hapus',width:35,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus_rinci();'' />";}},
            	{field:'no_transaksi',title:'No. Trans',width:70,align:"center",hidden:true},
                {field:'kode',title:'Kode',width:100,align:"left",hidden:true},
                {field:'kodegiat',title:'kodegiat',width:100,align:"center",hidden:true},
                {field:'no',title:'No',width:100,align:"center",hidden:true},
                {field:'kode_gabung',title:'gabung',width:100,align:"center"},
				{field:'uraian',title:'Jenis Barang',width:230,align:"left"},
                {field:'satuan',title:'Satuan',width:100,align:"center"},
                {field:'vol',title:'Kuantitas',width:70,align:"center"},
				{field:'harga',title:'Harga',width:100,align:"right"},
				{field:'jumlah',title:'Jumlah',width:100,align:"right",hidden:true},
                {field:'harga_hps',title:'H. HPS',width:100,align:"right"}, 
				{field:'harga_tawar',title:'H. Tawar',width:100,align:"right"},
				{field:'harga_akhir',title:'H. Akhir',width:100,align:"right"},
            	{field:'harga_hpsx',title:'total hps',width:70,align:"center",hidden:true},
                {field:'harga_tawarx',title:'total twr',width:100,align:"left",hidden:true},
                {field:'harga_akhirx',title:'total akhir',width:100,align:"center",hidden:true}
			]],
			onSelect:function(rowIndex,rowData){
				lcidx 	= rowIndex;
				no_transaksi   	= rowData.no_transaksi;                     
				kd_skpd    	 	= rowData.kd_skpd;                      
				kode       	 	= rowData.kode;                     
				kodegiat   	 	= rowData.kodegiat; 
				no     	     	= rowData.no;    
				kode_gabung    	= rowData.kode_gabung;                        
				uraian    	 	= rowData.uraian;
				satuan     	 	= rowData.satuan;
				vol        	 	= rowData.vol;
				harga      	    = rowData.harga;
				jumlah     	    = rowData.jumlah;
				harga_hps       = rowData.harga_hps;
				harga_tawar     = rowData.harga_tawar;
				harga_akhir     = rowData.harga_akhir; 
				$("#rinci_no_transaksi").attr("value",no_transaksi);
				$("#rinci_kd_skpd").attr("value",kd_skpd);
				$("#rinci_kode").attr("value",kode);
				$("#rinci_kodegiat").attr("value",kodegiat);
				$("#rinci_no").attr("value",no);
				$("#rinci_jenis").attr("value",uraian);
				$("#rinci_satuan").attr("value",satuan);
				$("#rinci_kuantitas").attr("value",vol);
				$("#rinci_harga").attr("value",number_format(harga));
				$("#rinci_hps").attr("value",number_format(harga_hps));
				$("#rinci_tawar").attr("value",number_format(harga_tawar));
				$("#rinci_akhir").attr("value",number_format(harga_akhir)); 
			}
        }); */       
    }
		  	
	function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Detail Barang';
        $("#dialog-faiz").dialog({ title: judul });
        $("#dialog-faiz").dialog('open');
        document.getElementById("hrg_hps").focus();
     } 
	 
	function tambah_rinci(){
        lcstatus = 'tambah';
        judul = 'Tambah Rincian';
        $("#dialog-zainol").dialog({ title: judul });
        $("#dialog-zainol").dialog('open');
        document.getElementById("rinci_jenis").focus();
     }
	
	
		function iz_append_save(){	
        var no_trans	= document.getElementById('no_transaksix').value; 
		var tahun  		= '<?php echo ($this->session->userdata('ta_simbakda')); ?>';
		var organisasi	= document.getElementById('kd_skpdx').value; 
		var kodegiat   	= document.getElementById('kodegiatx').value; 
		var koderek 	= document.getElementById('kodex').value;
		var no 		 	= document.getElementById('nox').value;
		var uraian 	 	= document.getElementById('jns_brg').value;
		var c4 		 	= document.getElementById('satuan').value;
		var n4 		 	= document.getElementById('kuantitas').value;
		var satuan 	 	= document.getElementById('harga').value; 
		var jumlah 	 	= document.getElementById('hrg_total').value;
		var hrg_hps		= document.getElementById('hrg_hps').value;
		var hrg_twr		= document.getElementById('hrg_twr').value;
		var hrg_akhir	= document.getElementById('hrg_akhir').value; //ALERT(hrg_hps+"--"+hrg_twr+"--"+hrg_akhir);
		var tot_hps		= document.getElementById('tot_hps').value;
		var tot_twr		= document.getElementById('tot_twr').value;
		var tot_akhir	= document.getElementById('tot_akhir').value;
			var merek 		= document.getElementById('merek').value;
			var tipe 		= document.getElementById('tipe').value;
			var warna 		= $('#warna').combogrid('getValue');
			var bahan 		= $('#bahan').combogrid('getValue');
			var satuan_det	= $('#satuan_detail').combogrid('getValue');
			var kondisi 	= $('#kondisi').combogrid('getValue');
			var keterangan 	= document.getElementById('ket_detail').value;
	//alert(no_trans+"','"+koderek+"','"+kodegiat+"','"+no+"','"+organisasi+"','"+tahun+"','"+uraian+"','"+c4+"','"+n4+"','"+satuan+"','"+hrg_hps+"','"+hrg_twr+"','"+hrg_akhir+"','"+jumlah+"','"+tot_hps+"','"+tot_twr+"','"+tot_akhir);
       /***************************** SIMPAN KE TRD PLBRG ********************************************************************/ 
      csql = "values('"+no_trans+"','"+koderek+"','"+kodegiat+"','"+no+"','"+organisasi+"','"+tahun+"','"+uraian+"','"+c4+"','"+n4+"','"+satuan+"','"+hrg_hps+"','"+hrg_twr+"','"+hrg_akhir+"','"+jumlah+"','"+tot_hps+"','"+tot_twr+"','"+tot_akhir+"','"+merek+"','"+tipe+"','"+warna+"','"+bahan+"','"+satuan_det+"','"+kondisi+"','"+keterangan+"')"; 
            
         $.ajax({
            type: 'POST',
            data: ({sql:csql,nodok:no_trans,unit_skpd:organisasi,kodegiat:kodegiat,koderek:koderek,no:no}),
            url:"<?php echo base_url(); ?>index.php/simpl/simpan_pld_rincian2",
			success:function(data){ 
             var lctot = data;
             //$('#total').attr('value',lctot);
             //$('#total2').attr('value',lctot);
			}
          });
		  var no_transaksi = no_trans;
		  var kd_skpd	   = organisasi;
		  load_detail(no_transaksi,kd_skpd);
        /********************************************** ********************************************************************/        
      
	   
	   /* if (organisasi != '' && kodegiat != '' && koderek != '' && no != ''){        
            if (updt == 'f') { 
                $('#trd').edatagrid('appendRow',{no_transaksi:no_trans,kd_skpd:organisasi,kode:koderek,no:no,uraian:uraian,satuan:c4,vol:n4,harga:satuan,jumlah:jumlah,harga_hps:hrg_hps,harga_twr:hrg_twr,harga_akhir:hrg_akhir});
                 *///$('#trd2').edatagrid('appendRow',{no_dokumen:no,kd_brg:kd,nm_brg:nm,merek:mrk,jumlah:jml,harga:hrg,total:tot,ket:ket});
                //a = total + angka(tot);                
          //  } else {
                //$('#trd').edatagrid('updateRow',{index:idx2,row:{no_transaksi:no_transaksi,kd_skpd:kd_skpd,kode:kode,no:no,uraian:uraian,satuan:satuan,vol:vol,harga:harga,jumlah:jumlah,harga_hps:harga_hps,harga_tawar:hrg_twr,harga_akhir:harga_akhir}});
                //$('#trd2').edatagrid('updateRow',{index:idx2,row:{no_dokumen:no,kd_brg:kd,nm_brg:nm,merek:mrk,jumlah:jml,harga:hrg,total:tot,ket:ket}});                        
                //s = total - angka(total2);
                //a = s + angka(tot);
           // }
          //  updt = 'f';
            //total = number_format(a,2,'.',',');
            //$('#total').attr('value',total);
            //$('#total2').attr('value',total);                                    
            //kosong2();
        /* }else {
                alert('Jenis, Bidang, Kelompok, Sub Kelompok, Kode, Jumlah dan Harga tidak boleh kosong');
                exit();
        } */
		hitung_footer()
    }
	
		function hitung_footer(){
		var no_transaksi = document.getElementById('no_transaksi').value;
		var kd_skpd		 = $('#uskpd').combogrid('getValue'); 
		 	$.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>index.php/simpl/load_hitung',
            data: ({skpd:kd_skpd,no_transaksi:no_transaksi}),
            dataType:"json",
            success:function(data){                                          
                $.each(data,function(i,n){                                    
                    jml     	 = n['jml'];                                 
                    hrg_hps      = n['hrg_hps'];                                 
                    hrg_twr      = n['hrg_twr'];                                 
                    hrg_akhir    = n['hrg_akhir'];// alert(jml+"--"+hrg_hps+"--"+hrg_twr+"--"+hrg_akhir);
					$('#jumlah').attr('value',number_format(jml));      
					$('#harga_hps').attr('value',number_format(hrg_hps));
					$('#harga_tawar').attr('value',number_format(hrg_twr));
					$('#harga_akhir').attr('value',number_format(hrg_akhir));                           
                });
            }
        });
		}
	
	function dpa_append_save(){	
	//koderek_dpa,jns_brg_dpa,satuan_dpa,kuantitas_dpa,harga_dpa,jumlah_dpa
		var no 		 	= document.getElementById('no_dpa').value;
        var no_trans	= document.getElementById('no_transaksi').value;	
		var kodegiat   	= document.getElementById('kodegiat_dpa').value; 
		var organisasi	= $('#uskpd').combogrid('getValue');
		var tahun  		= '<?php echo ($this->session->userdata('ta_simbakda')); ?>';
		var koderek 	= document.getElementById('koderek_dpa').value;
		var uraian 	 	= document.getElementById('jns_brg_dpa').value;
		var c4 		 	= document.getElementById('satuan_dpa').value;
		var n4 		 	= document.getElementById('kuantitas_dpa').value;
		var satuan 	 	= angka(document.getElementById('harga_dpa').value); 
		var jumlah 	 	= angka(document.getElementById('jumlah_dpa').value);
		var hrg_hps		= "";
		var hrg_twr		= "";
		var hrg_akhir	= "";
		var tot_hps		= "";
		var tot_twr		= "";
		var tot_akhir	= "";
			var merek 		= "";
			var tipe 		= "";
			var warna 		= "";
			var bahan 		= "";
			var satuan_det	= "";
			var kondisi 	= "";
			var keterangan 	= "";
	//alert(no_trans+"','"+koderek+"','"+kodegiat+"','"+no+"','"+organisasi+"','"+tahun+"','"+uraian+"','"+c4+"','"+n4+"','"+satuan+"','"+hrg_hps+"','"+hrg_twr+"','"+hrg_akhir+"','"+jumlah+"','"+tot_hps+"','"+tot_twr+"','"+tot_akhir);
       /***************************** SIMPAN KE TRD PLBRG ********************************************************************/ 
      csql = "values('"+no_trans+"','"+koderek+"','"+kodegiat+"','"+no+"','"+organisasi+"','"+tahun+"','"+uraian+"','"+c4+"','"+n4+"','"+satuan+"','"+hrg_hps+"','"+hrg_twr+"','"+hrg_akhir+"','"+jumlah+"','"+tot_hps+"','"+tot_twr+"','"+tot_akhir+"','"+merek+"','"+tipe+"','"+warna+"','"+bahan+"','"+satuan_det+"','"+kondisi+"','"+keterangan+"')"; 
            
         $.ajax({
            type: 'POST',
            data: ({sql:csql,nodok:no_trans,unit_skpd:organisasi,kodegiat:kodegiat,koderek:koderek,no:no}),
            url:"<?php echo base_url(); ?>index.php/simpl/simpan_pld_rincian2",
			success:function(data){ 
             var lctot = data;
			}
          });
		  var no_transaksi = no_trans;
		  var kd_skpd	   = organisasi;
		  load_detail(no_transaksi,kd_skpd);
    }
	function rinci_append_save(){	
        var no_trans	= document.getElementById('rinci_no_transaksi').value; 
		var tahun  		= '<?php echo ($this->session->userdata('ta_simbakda')); ?>';
		var organisasi	= document.getElementById('rinci_kd_skpd').value; 
		var kodegiat   	= document.getElementById('rinci_kodegiat').value; 
		var koderek 	= document.getElementById('rinci_kode').value;
		var no 		 	= document.getElementById('rinci_no').value;
		var uraian 	 	= document.getElementById('rinci_jenis').value;
		var c4 		 	= document.getElementById('rinci_satuan').value;
		var n4 		 	= document.getElementById('rinci_kuantitas').value;
		var satuan 	 	= angka(document.getElementById('rinci_harga').value); 
		var hrg_hps		= angka(document.getElementById('rinci_hps').value);
		var hrg_twr		= angka(document.getElementById('rinci_tawar').value);
		var hrg_akhir	= angka(document.getElementById('rinci_akhir').value);
		var rincian 	= document.getElementById('rinci_uraian').value; 
		var no_urut 	= document.getElementById('no_urut').value; 
		var jumlah		= n4*satuan;
		var tot_hps		= n4*hrg_hps;
		var tot_twr		= n4*hrg_twr;
		var tot_akhir	= n4*hrg_akhir;
		/* 
		var tot_hps		= angka(document.getElementById('tot_hps').value);
		var tot_twr		= angka(document.getElementById('tot_twr').value);
		var tot_akhir	= angka(document.getElementById('tot_akhir').value); */
       /***************************** SIMPAN KE TRD PLBRG ********************************************************************/ 
         
		var kode_gabung = (no_trans+"."+organisasi+"."+kodegiat+"."+koderek+"."+no+"."+no_urut);
		csql = "values('"+no_trans+"','"+koderek+"','"+kodegiat+"','"+no+"','"+no_urut+"','"+kode_gabung+"','"+organisasi+"','"+tahun+"','"+rincian+"','"+uraian+"','"+c4+"','"+n4+"','"+satuan+"','"+hrg_hps+"','"+hrg_twr+"','"+hrg_akhir+"','"+jumlah+"','"+tot_hps+"','"+tot_twr+"','"+tot_akhir+"')"; 
	
         $.ajax({
            type: 'POST',
            data: ({sql:csql,nodok:no_trans,kd_skpd:organisasi,kodegiat:kodegiat,koderek:koderek,no:no,no_urut:no_urut,kode_gabung:kode_gabung}),
            url:"<?php echo base_url(); ?>index.php/simpl/simpan_rinci_rka",
			success:function(data){ 
			
			}
          });
        /********************************************** ********************************************************************/        
        
		if (uraian !='' && rincian !=''){ 
            //$('#rinci').edatagrid('appendRow',{no_transaksi:no_transaksi,kd_skpd:kd_skpd,kode:kode,kodegiat:kodegiat,no:no,uraian:uraian,satuan:satuan,vol:vol,harga:harga,jumlah:jumlah,harga_hps:harga_hps,harga_tawar:harga_tawar,harga_akhir:harga_akhir,harga_hpsx:harga_hpsx,harga_tawarx:harga_tawarx,harga_akhirx:harga_akhirx});                                
            $('#rinci').edatagrid('appendRow',{no_transaksi:no_trans,kd_skpd:organisasi,kode:koderek,kodegiat:kodegiat,no:no,kode_gabung:kode_gabung,uraian:uraian,satuan:c4,vol:n4,harga:satuan,harga_hps:hrg_hps,harga_tawar:hrg_twr,harga_akhir:hrg_akhir});
        }else {
			alert('Silahkan cek kembali.!! Jenis Barang, Satuan, Kuantitas, Harga, Harga HPS, Harga Tawar dan Harga Akhir tidak boleh kosong');
			exit();
        } 
		hitung_footer();
    }	
		
      function ambil_pl_lengkap(){
        var i 	  = 0;
		var skpd  = '<?php echo ($this->session->userdata('skpd')); ?>';
		var ubah  = lcstatus; 
		var no_trans  = document.getElementById('no_transaksi').value; 
		$('#no_trans').attr('value',no_trans); 
		alert(no_trans);
		  $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>index.php/simpl/ambil_pl_lengkap',
            data: ({skpd:skpd,no:no_trans}),
            dataType:"json",
            success:function(data){                                          
                $.each(data,function(i,fa){                                  
						kd_skpd       = fa['kd_skpd'];  
						//no_trans	  = fa['no_transaksi'];
                        kd_skpd       = fa['kd_skpd']; 
                        tgl_rab       = fa['tgl_rab'];
                        tgl_hps       = fa['tgl_hps'];
                        tgl_upl       = fa['tgl_upl'];
                        tgl_spr       = fa['tgl_spr'];                    
                        tgl_pi        = fa['tgl_pi'];
                        tgl_bappd     = fa['tgl_bappd'];
                        tgl_baek      = fa['tgl_baek'];
                        tgl_bahp      = fa['tgl_bahp'];                   
                        tgl_nodi      = fa['tgl_nodi'];
                        tgl_sppjb     = fa['tgl_sppjb'];
                        tgl_spk       = fa['tgl_spk'];
                        tgl_sp        = fa['tgl_sp'];                    
                        tgl_spbj      = fa['tgl_spbj'];
						spbj      	  = fa['spbj'];
                        tgl_bapb1     = fa['tgl_bapb1'];
                        tgl_bapb2     = fa['tgl_bapb2'];
                        tgl_bast      = fa['tgl_bast'];                    
                        tgl_bapp      = fa['tgl_bapp'];
                        tgl_sk     	  = fa['tgl_sk'];
                        tgl_kuitansi  = fa['tgl_kuitansi'];
                        tgl_ssp       = fa['tgl_ssp'];
						tgl_faktur    = fa['tgl_faktur'];                      
                        tgl_spt       = fa['tgl_spt'];                     
                        tgl_rngks_kntrk       = fa['tgl_rngks_kntrk'];
                        no_upl     	  = fa['no_upl'];
                        no_spr        = fa['no_spr'];
                        no_bappd      = fa['no_bappd'];
						no_baek  	  = fa['no_baek'];                      
                        no_bahp       = fa['no_bahp'];
                        no_nodi    	  = fa['no_nodi'];
						no_sppjb      = fa['no_sppjb'];
                        no_spk        = fa['no_spk'];
						no_sp  		  = fa['no_sp'];               
                        ket_spbj      = fa['ket_spbj'];
                        no_bapb1      = fa['no_bapb1'];
                        no_bapb2      = fa['no_bapb2'];
                        no_bast       = fa['no_bast'];
						no_bapp  	  = fa['no_bapp'];                      
                        no_spt     	  = fa['no_spt'];                     
                        wkt_pel     	  = fa['wkt_pel'];                  
                        jns_pem     	  = fa['jns_pem']; 
						$('#uskpdx').attr('value',kd_skpd);
						$('#tgl_rab').datebox('setValue',tgl_rab);
						$('#tgl_hps').datebox('setValue',tgl_hps);
						$('#tgl_upl').datebox('setValue',tgl_upl);
						$('#tgl_spr').datebox('setValue',tgl_spr);
						$('#tgl_pi').datebox('setValue',tgl_pi);
						$('#tgl_bappd').datebox('setValue',tgl_bappd);
						$('#tgl_baek').datebox('setValue',tgl_baek);
						$('#tgl_bahp').datebox('setValue',tgl_bahp);
						$('#tgl_nodi').datebox('setValue',tgl_nodi);
						$('#tgl_sppjb').datebox('setValue',tgl_sppjb);
						$('#tgl_spk').datebox('setValue',tgl_spk);
						$('#tgl_sp').datebox('setValue',tgl_sp);
						$('#tgl_spbj').datebox('setValue',tgl_spbj);
						$("#spbj").attr("value",spbj); 
						$('#tgl_bapb1').datebox('setValue',tgl_bapb1);
						$('#tgl_bapb2').datebox('setValue',tgl_bapb2);
						$('#tgl_bast').datebox('setValue',tgl_bast);
						$('#tgl_bapp').datebox('setValue',tgl_bapp);
						$('#tgl_sk').datebox('setValue',tgl_sk);
						$('#tgl_kuitansi').datebox('setValue',tgl_kuitansi);
						$('#tgl_ssp').datebox('setValue',tgl_ssp);
						$('#tgl_faktur').datebox('setValue',tgl_faktur);
						$('#tgl_spt').datebox('setValue',tgl_spt);
						$('#tgl_rngks_kntrk').datebox('setValue',tgl_rngks_kntrk);
						$('#no_upl').attr('value',no_upl);
						$('#no_spr').attr('value',no_spr);
						$('#no_bappd').attr('value',no_bappd);
						$('#no_baek').attr('value',no_baek);
						$('#no_bahp').attr('value',no_bahp);
						$('#no_nodi').attr('value',no_nodi);
						$('#no_sppjb').attr('value',no_sppjb);
						$('#no_spk').attr('value',no_spk);
						$('#no_sp').attr('value',no_sp); 
						$('#ket_spbj').attr('value',ket_spbj);
						$('#no_bapb1').attr('value',no_bapb1);
						$('#no_bapb2').attr('value',no_bapb2);
						$('#no_bast').attr('value',no_bast);
						$('#no_bapp').attr('value',no_bapp);
						$('#no_spt').attr('value',no_spt);
						$('#wkt_pel').attr('value',wkt_pel);
						$('#jns_pem').attr('value',jns_pem);
		        });
            }
        });
    }

	function edit(){
        lcstatus = 'edit';
		$('#sec2').click();
        load_detail(no_transaksi,kd_skpd);
        //set_grid(); 
        document.getElementById("no_transaksi").disabled=false;
        } 
		
    function set_grid2(){
         $('#trd2').edatagrid({   
              columns:[[
					{field:'koderek',title:'Koderek',width:70},
					{field:'no',title:'NO',width:30},
					{field:'uraian',title:'J. Barang',width:380},
					{field:'c4',title:'Satuan',width:100,align:"center"},
					{field:'n4',title:'Kuantitas',width:70,align:"center"},
                    {field:'satuan',title:'Harga',width:150,align:"right"},
                    {field:'jumlah',title:'Jumlah',width:150,align:"right"}
                ]],
		onSelect:function(rowIndex,rowData){
		  lcidx 		= rowIndex;
		  koderek 		= rowData.koderek;
		  kodegiat 		= rowData.kodegiat;
		  uraian 		= rowData.uraian; 
		  $('#kodegiat_dpa').attr('value',kodegiat);
		  $('#koderek_dpa').attr('value',koderek);
		  $('#uraian_dpax').attr('value',uraian);
		  id_dpa();
		  }
        });          
    }
 function simpan_trd(){	
		var no_transaksi = document.getElementById('no_transaksi').value;
		var kd_skpd		 = $('#uskpd').combogrid('getValue'); 
		var kodegiat	 = $('#kd').combogrid('getValue');
		var thn  		 = '<?php echo ($this->session->userdata('ta_simbakda')); ?>';
		//var unit_skpd    = '<?php echo ($this->session->userdata('unit_skpd')); ?>';
		var data = $("#trd2").edatagrid('getSelections'); 
		 if(lcstatus!='edit'){		
				$.ajax({
				  type: "POST",
				  url: "<?php echo base_url(); ?>index.php/simpl/simpan_trd",
				  data: { no_transaksi: no_transaksi,kodegiat:kodegiat,tahun:thn,unit_skpd:kd_skpd,data: data }
				})
				  .done(function( msg ) {
					//alert( "Data Telah Tersimpan " + msg );
				  });
				}else{
				$.ajax({
				  type: "POST",
				  url: "<?php echo base_url(); ?>index.php/simpl/simpan_trd",
				  data: { no_transaksi: no_transaksi,kodegiat:kodegiat, tahun:thn,unit_skpd:kd_skpd, data: data }
				})
				  .done(function( msg ) {
					//alert( "Data Telah Tersimpan " + msg );
				  });
				}
			}		
	//**********	
    function tambah_detail(){
        $('#trd2').datagrid('reload');
            $("#dialog-modal").dialog('open');    
            set_grid2();
            ambil_rinciskpd();  
    }	
	/* 	
    function hitung(no_transaksi){
		var skpd  = '<?php echo ($this->session->userdata('skpd')); ?>';
		var no_transaksi = no_transaksi;
		
         $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>index.php/simpl/load_hitung',
            data: ({skpd:skpd,no_transaksi:no_transaksi}),
            dataType:"json",
            success:function(data){                                          
                $.each(data,function(i,n){                                    
                    jml     	 = number_format(n['jml']);                                 
                    hrg_hps      = number_format(n['hrg_hps']);                                 
                    hrg_twr      = number_format(n['hrg_twr']);                                 
                    hrg_akhir    = n['hrg_akhir']; 
					$('#jumlah').attr('value',jml);      
					$('#harga_hps').attr('value',hrg_hps);
					$('#harga_tawar').attr('value',hrg_twr);
					$('#harga_akhir').attr('value',hrg_akhir);                           
                });
            }
        });
    }
	 */
	 
	function hitung(){
		var skpd  		 = $('#uskpd').combogrid('getValue');
		var no_transaksi = document.getElementById('no_transaksi').value; 
		/* 
        var a = angka(document.getElementById('kuantitas').value);        
        var b = angka(document.getElementById('harga').value);         
        var c = angka(document.getElementById('hrg_hps').value);            
        var d = angka(document.getElementById('hrg_twr').value);            
        var e = angka(document.getElementById('hrg_akhir').value);     */ 
        var a = document.getElementById('kuantitas').value;        
        var b = document.getElementById('harga').value;         
        var c = document.getElementById('hrg_hps').value;            
        var d = document.getElementById('hrg_twr').value;            
        var e = document.getElementById('hrg_akhir').value;          
        var tot = Math.round(a*b);//Math.round(a*b,5);          
        var tot_hps   = Math.round(a*c);           
        var tot_twr   = Math.round(a*d);           
        var tot_akhir = Math.round(a*e);                           /* 
            tot = number_format(tot,2,'.',',');       
            tot_hps 	= number_format(tot_hps,2,'.',',');       
            tot_twr 	= number_format(tot_twr,2,'.',',');       
            tot_akhir 	= number_format(tot_akhir,2,'.',','); */
            $('#hrg_total').attr('value',tot); //alert(tot);
            $('#tot_hps').attr('value',tot_hps);
            $('#tot_twr').attr('value',tot_twr);
            $('#tot_akhir').attr('value',tot_akhir);
			//jumlah,harga_hps,harga_tawar,harga_akhir
			//DB jumlah,jml_hps,jml_tawar,jml_akhir       
        var fa = angka(document.getElementById('hrg_total').value);         
        var iz = angka(document.getElementById('tot_hps').value);            
        var za = angka(document.getElementById('tot_twr').value);            
        var ino = angka(document.getElementById('tot_akhir').value); 
			$.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>index.php/simpl/load_hitung',
            data: ({skpd:skpd,no_transaksi:no_transaksi}),
            dataType:"json",
            success:function(data){                                          
                $.each(data,function(i,n){                                    
                    jml     	 = n['jml'];                                 
                    hrg_hps      = n['hrg_hps'];                                 
                    hrg_twr      = n['hrg_twr'];                                 
                    hrg_akhir    = n['hrg_akhir']; 
					jmlx		 = jml;//+fa
					hrg_hpsx	 = hrg_hps;
					harga_tawarx = hrg_twr;
					harga_akhirx = hrg_akhir;
					//$('#jumlah').attr('value',number_format(jmlx));      
					//$('#harga_hps').attr('value',number_format(hrg_hpsx));
					//$('#harga_tawar').attr('value',number_format(harga_tawarx));
					//$('#harga_akhir').attr('value',number_format(harga_akhirx));                           
                });
            }
        });
    }
	
	function hitung_dpa(){
		var kuantitas_dpa =document.getElementById('kuantitas_dpa').value;
		var koderek_dpa  =document.getElementById('koderek_dpa').value;  
		var harga_dpa =document.getElementById('harga_dpa').value; 
		var jumlah_dpa= kuantitas_dpa*harga_dpa;
		$('#jumlah_dpa').attr('value',jumlah_dpa);
			if(koderek_dpa==''){
                   swal({
					title: "Error!",
					text: "MAAF PILIH TERLEBIH DAHULU REKENING HEADER..!!",
					type: "error",
					confirmButtonText: "OK"
					});
					exit();
			}
	}
	
	function id_dpa(){
		var organisasi = $('#uskpd').combogrid('getValue');	
		$.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>index.php/simpl/load_idmax_dpa',
            data: ({skpd:organisasi,table:'pld_form_isian',kolom:'no'}),
            dataType:"json",
            success:function(data){                                          
                $.each(data,function(i,n){                                    
                    no_urut      = n['kode']; 
					$("#no_dpa").attr("value",no_urut);
                });
            }
        }); 
		}
	function simpan_detail(no_transaksi,kode,no,uraian,satuan,vol,harga,harga_hps,harga_tawar,harga_akhir,jumlah){
			lcquery = "UPDATE pld_form_isian SET uraian='"+uraian+"',satuan='"+satuan+"',vol = '"+vol+"', harga='"+harga+"',jumlah='"+jumlah+"',harga_hps='"+harga_hps+"',harga_tawar='"+harga_tawar+"',harga_akhir='"+harga_akhir+"' where no_transaksi='"+no_transaksi+"' and kode='"+kode+"' and no='"+no+"'";
  
            $(document).ready(function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>index.php/simpl/update_pld',
                data: ({st_query:lcquery}),
                dataType:"json"
            });
            });
		//$('#dgd').edatagrid('reload');
	}
	
	function simpan_lengkap(){
		var no_trans	= document.getElementById('no_transaksi').value; 
		var ckd_skpd	= $('#uskpd').combogrid('getValue');
		var cnmskpd		= document.getElementById('nmuskpd').value;
		var thn  		= '<?php echo ($this->session->userdata('ta_simbakda')); ?>';
      	var ctgl_rab    = $('#tgl_rab').datebox('getValue');
		var ctgl_hps    = $('#tgl_hps').datebox('getValue');
		var ctgl_upl   	= $('#tgl_upl').datebox('getValue');
		var ctgl_spr    = $('#tgl_spr').datebox('getValue');
		var ctgl_pi    	= $('#tgl_pi').datebox('getValue');
		var ctgl_bappd  = $('#tgl_bappd').datebox('getValue');
		var ctgl_baek   = $('#tgl_baek').datebox('getValue');
		var ctgl_bahp   = $('#tgl_bahp').datebox('getValue');
		var ctgl_nodi   = $('#tgl_nodi').datebox('getValue');
		var ctgl_sppjb  = $('#tgl_sppjb').datebox('getValue');
		var ctgl_spk   	= $('#tgl_spk').datebox('getValue');
		var ctgl_sp  	= $('#tgl_sp').datebox('getValue');
		var ctgl_spbj   = $('#tgl_spbj').datebox('getValue');
		var cspbj		= document.getElementById('spbj').value;
		var ctgl_bapb1  = $('#tgl_bapb1').datebox('getValue');
		var ctgl_bapb2  = $('#tgl_bapb2').datebox('getValue');
		var ctgl_bast   = $('#tgl_bast').datebox('getValue');
		var ctgl_bapp   = $('#tgl_bapp').datebox('getValue');
		var ctgl_sk     = $('#tgl_sk').datebox('getValue');
		var ctgl_kuitansi   = $('#tgl_kuitansi').datebox('getValue');
		var ctgl_ssp    = $('#tgl_ssp').datebox('getValue');
		var ctgl_faktur = $('#tgl_faktur').datebox('getValue');
		var ctgl_spt    = $('#tgl_spt').datebox('getValue');
		var ctgl_rngks_kntrk    = $('#tgl_rngks_kntrk').datebox('getValue');
		var cno_upl		= document.getElementById('no_upl').value;
		var cno_spr		= document.getElementById('no_spr').value;
		var cno_bappd	= document.getElementById('no_bappd').value;
		var cno_baek	= document.getElementById('no_baek').value;
		var cno_bahp	= document.getElementById('no_bahp').value;
		var cno_nodi	= document.getElementById('no_nodi').value;
		var cno_sppjb	= document.getElementById('no_sppjb').value;
		var cno_spk		= document.getElementById('no_spk').value;
		var cno_sp		= document.getElementById('no_sp').value;
		var cket_spbj	= document.getElementById('ket_spbj').value;
		var cno_bapb1	= document.getElementById('no_bapb1').value;
		var cno_bapb2	= document.getElementById('no_bapb2').value;
		var cno_bast	= document.getElementById('no_bast').value;
		var cno_bapp	= document.getElementById('no_bapp').value;
		var cno_spt		= document.getElementById('no_spt').value;
		var cwkt_pel	= document.getElementById('wkt_pel').value; 
		var cjns_pem	= document.getElementById('jns_pem').value; 
		 /***************************** SIMPAN KE TRD PLBRG ********************************************************************/ 
       if(lcstatus!='edit'){
		csql = " values('"+no_trans+"','"+ckd_skpd+"','"+thn+"','"+ctgl_rab+"','"+ctgl_hps+"','"+ctgl_upl+"','"+ctgl_spr+"','"+ctgl_pi+"','"+ctgl_bappd+"','"+ctgl_baek+"','"+ctgl_bahp+"','"+ctgl_nodi+"','"+ctgl_sppjb+"','"+ctgl_spk+"','"+ctgl_sp+"','"+ctgl_spbj+"','"+cspbj+"','"+ctgl_bapb1+"','"+ctgl_bapb2+"','"+ctgl_bast+"','"+ctgl_bapp+"','"+ctgl_sk+"','"+ctgl_kuitansi+"','"+ctgl_ssp+"','"+ctgl_faktur+"','"+ctgl_spt+"','"+ctgl_rngks_kntrk+"','"+cno_upl+"','"+cno_spr+"','"+cno_bappd+"','"+cno_baek+"','"+cno_bahp+"','"+cno_nodi+"','"+cno_sppjb+"','"+cno_spk+"','"+cno_sp+"','"+cket_spbj+"','"+cno_bapb1+"','"+cno_bapb2+"','"+cno_bast+"','"+cno_bapp+"','"+cno_spt+"','"+cwkt_pel+"','"+cjns_pem+"')"; 
        csimakda = " update trhtagih set no_bukti='"+cno_sp+"',tgl_bukti='"+ctgl_sp+"',tgl_update='<?php echo date('y-m-d H:i:s'); ?>',no_tagih='"+cno_bast+"',sts_tagih='',status='1',tgl_tagih='"+ctgl_bast+"',jns_spp='6' where no_transaksi='"+no_trans+"' and kd_skpd='"+ckd_skpd+"'";           
		//csimakda2 = "INSERT INTO trdtagih SELECT a.no_transaksi,b.no_sp AS no_bukti,'' AS no_sp2d,a.kodegiat AS kd_kegiatan,c.namarek AS nm_kegiatan,a.kode AS kd_rek5,'' AS kd_rek,d.nm_rek5,SUM(a.jml_akhir) AS nilai FROM db_simbakda_baru2.pld_form_isian a LEFT JOIN db_simbakda_baru2.pl_lengkap b ON a.no_transaksi=b.no_transaksi AND b.`kd_skpd`=a.`unit_skpd`LEFT JOIN db_simbakda_baru2.rinci_rkaskpd c ON c.organisasi=a.unit_skpd AND a.kodegiat=c.kodegiat AND a.kode=c.koderek LEFT JOIN db_simbakda_baru2.mrek5 d ON a.kode=d.kd_rek5 WHERE a.unit_skpd='"+ckd_skpd+"' AND a.no_transaksi='"+no_trans+"' GROUP BY kode";
		csimakda2 = "INSERT INTO trdtagih SELECT a.no_transaksi,b.no_sp AS no_bukti,'' AS no_sp2d,a.kodegiat AS kd_kegiatan,'' AS nm_kegiatan,a.kode AS kd_rek5,'' AS kd_rek,'' AS nm_rek5,SUM(a.jml_akhir) AS nilai FROM db_simbakda_baru2.pld_form_isian a LEFT JOIN db_simbakda_baru2.pl_lengkap b ON a.no_transaksi=b.no_transaksi AND b.kd_skpd=a.unit_skpd WHERE a.unit_skpd='"+ckd_skpd+"' AND a.no_transaksi='"+no_trans+"' GROUP BY kode";
		$.ajax({
            type: 'POST',
            data: ({sql:csql,no_trans:no_trans,ckd_skpd:ckd_skpd,simakda:csimakda,simakda2:csimakda2}),
            url:"<?php echo base_url(); ?>index.php/simpl/pld_lengkapan"
          })
		  .done(function( msg ) {
					alert( "Data Telah Tersimpan...");
				  });
		}else if(lcstatus=='edit'){ 
		 csql 	  = " values('"+no_trans+"','"+ckd_skpd+"','"+thn+"','"+ctgl_rab+"','"+ctgl_hps+"','"+ctgl_upl+"','"+ctgl_spr+"','"+ctgl_pi+"','"+ctgl_bappd+"','"+ctgl_baek+"','"+ctgl_bahp+"','"+ctgl_nodi+"','"+ctgl_sppjb+"','"+ctgl_spk+"','"+ctgl_sp+"','"+ctgl_spbj+"','"+cspbj+"','"+ctgl_bapb1+"','"+ctgl_bapb2+"','"+ctgl_bast+"','"+ctgl_bapp+"','"+ctgl_sk+"','"+ctgl_kuitansi+"','"+ctgl_ssp+"','"+ctgl_faktur+"','"+ctgl_spt+"','"+ctgl_rngks_kntrk+"','"+cno_upl+"','"+cno_spr+"','"+cno_bappd+"','"+cno_baek+"','"+cno_bahp+"','"+cno_nodi+"','"+cno_sppjb+"','"+cno_spk+"','"+cno_sp+"','"+cket_spbj+"','"+cno_bapb1+"','"+cno_bapb2+"','"+cno_bast+"','"+cno_bapp+"','"+cno_spt+"','"+cwkt_pel+"','"+cjns_pem+"')"; 
         csimakda = " update trhtagih set no_bukti='"+cno_sp+"',tgl_bukti='"+ctgl_sp+"',tgl_update='<?php echo date('y-m-d H:i:s'); ?>',no_tagih='"+cno_bast+"',sts_tagih='',status='1',tgl_tagih='"+ctgl_bast+"',jns_spp='6' where no_transaksi='"+no_trans+"' and kd_skpd='"+ckd_skpd+"'";           
		 //csimakda2 = "INSERT INTO trdtagih SELECT a.no_transaksi,b.no_sp AS no_bukti,'' AS no_sp2d,a.kodegiat AS kd_kegiatan,c.namarek AS nm_kegiatan,a.kode AS kd_rek5,'' AS kd_rek,d.nm_rek5,SUM(a.jml_akhir) AS nilai FROM db_simbakda_baru2.pld_form_isian a LEFT JOIN db_simbakda_baru2.pl_lengkap b ON a.no_transaksi=b.no_transaksi AND b.`kd_skpd`=a.`unit_skpd`LEFT JOIN db_simbakda_baru2.rinci_rkaskpd c ON c.organisasi=a.unit_skpd AND a.kodegiat=c.kodegiat AND a.kode=c.koderek LEFT JOIN db_simbakda_baru2.mrek5 d ON a.kode=d.kd_rek5 WHERE a.unit_skpd='"+ckd_skpd+"' AND a.no_transaksi='"+no_trans+"' GROUP BY kode";
		 csimakda2 = "INSERT INTO trdtagih SELECT a.no_transaksi,b.no_sp AS no_bukti,'' AS no_sp2d,a.kodegiat AS kd_kegiatan,'' AS nm_kegiatan,a.kode AS kd_rek5,'' AS kd_rek,'' AS nm_rek5,SUM(a.jml_akhir) AS nilai FROM db_simbakda_baru2.pld_form_isian a LEFT JOIN db_simbakda_baru2.pl_lengkap b ON a.no_transaksi=b.no_transaksi AND b.kd_skpd=a.unit_skpd WHERE a.unit_skpd='"+ckd_skpd+"' AND a.no_transaksi='"+no_trans+"' GROUP BY kode";
		$.ajax({
            type: 'POST',
            data: ({sql:csql,no_trans:no_trans,ckd_skpd:ckd_skpd,simakda:csimakda,simakda2:csimakda2}),
            url:"<?php echo base_url(); ?>index.php/simpl/pld_lengkapan"
          })
		  .done(function( msg ) {
					alert( "Data Telah Tersimpan...");
				  });
			/* lcquery = "UPDATE pl_lengkap a,plh_form_isian b SET a.no_transaksi='"+no_trans+"',a.kd_skpd='"+ckd_skpd+"',a.tahun='"+thn+"',a.tgl_rab='"+ctgl_rab+"',a.tgl_hps='"+ctgl_hps+"',a.tgl_upl='"+ctgl_upl+"',a.tgl_spr='"+ctgl_spr+"',a.tgl_pi='"+ctgl_pi+"',a.tgl_bappd='"+ctgl_bappd+"',a.tgl_baek='"+ctgl_baek+"',a.tgl_bahp='"+ctgl_bahp+"',a.tgl_nodi='"+ctgl_nodi+"',a.tgl_sppjb='"+ctgl_sppjb+"',a.tgl_spk='"+ctgl_spk+"',a.tgl_sp='"+ctgl_sp+"',a.tgl_spbj='"+ctgl_spbj+"',a.spbj='"+cspbj+"',a.tgl_bapb1='"+ctgl_bapb1+"',a.tgl_bapb2='"+ctgl_bapb2+"',a.tgl_bast='"+ctgl_bast+"',a.tgl_bapp='"+ctgl_bapp+"',a.tgl_sk='"+ctgl_sk+"',a.tgl_kuitansi='"+ctgl_kuitansi+"',a.tgl_ssp='"+ctgl_ssp+"',a.tgl_faktur='"+ctgl_faktur+"',a.tgl_spt='"+ctgl_spt+"',a.no_upl='"+cno_upl+"',a.no_spr='"+cno_spr+"',a.no_bappd='"+cno_bappd+"',a.no_baek='"+cno_baek+"',a.no_bahp='"+cno_bahp+"',a.no_nodi='"+cno_nodi+"',a.no_sppjb='"+cno_sppjb+"',a.no_spk='"+cno_spk+"',a.no_sp='"+cno_sp+"',a.ket_spbj='"+cket_spbj+"',a.no_bapb1='"+cno_bapb1+"',a.no_bapb2='"+cno_bapb2+"',a.no_bast='"+cno_bast+"',a.no_bapp='"+cno_bapp+"',a.no_spt='"+cno_spt+"' where b.no_transaksi='"+no_trans+"' and b.kd_uskpd='"+ckd_skpd+"'";
                    $(document).ready(function(){
                    $.ajax({
                        type: "POST",
                        url: '<?php echo base_url(); ?>index.php/simpl/update_master',
                        data: ({st_query:lcquery}),
                        dataType:"json"
						})
						.done(function( msg ) {
						 alert( "Data Telah Tersimpan...");
						});
                    }); */
		}
	}
    
	
    function keluar(){
        $("#dialog-modal").dialog('close');
        $('#trd2').datagrid('reload');   
	}      
	function keluar_rinci(){
        $("#dialog-zainol").dialog('close');
	}

     function simpan(){ 
		var iduser 				= '<?php echo ($this->session->userdata('iduser')); ?>';
		var ubah				= lcstatus; 
        var cno_transaksi     	= document.getElementById('no_transaksi').value;
		var ckd_skpd 			= $('#uskpd').combogrid('getValue');
		var thn  				= '<?php echo ($this->session->userdata('ta_simbakda')); ?>';
		var ckegiatan			= $('#kd').combogrid('getValue');
		var cnm_kegiatan 		= document.getElementById('namagiat').value;
        var cketerangan			= document.getElementById('keterangan').value;
        var cpptk	 			= $('#pptk').combogrid('getValue');
        var crekanan			= $('#rekanan').combogrid('getValue');
		var cstaf_penerima    	= $('#staf_penerima').combogrid('getValue');
        var cketua  			= $('#ketua').combogrid('getValue');
        var canggota_satu 		= $('#anggota').combogrid('getValue');
        var canggota_dua		= $('#anggota2').combogrid('getValue');
        var ctotal  			= angka(document.getElementById('jumlah').value);
        var charga_hps  		= angka(document.getElementById('harga_hps').value);
        var charga_tawar		= angka(document.getElementById('harga_tawar').value);
        var charga_akhir		= angka(document.getElementById('harga_akhir').value); 
        var simakda_toal		= document.getElementById('harga_akhir').value; 
        var cjml_ppn	  		= angka(document.getElementById('jml_ppn').value);
        var cjml_pph1			= angka(document.getElementById('jml_ppn1').value);
        var cjml_pph2			= angka(document.getElementById('jml_ppn2').value);
		var cnmskpd		 		= document.getElementById('nmuskpd').value;
		
		var cpajak  			= $('#pajak').combogrid('getValue');
		var cpph1  				= $('#pajak1').combogrid('getValue');
		var cpph2	 			= $('#pajak2').combogrid('getValue'); 
        if (cno_transaksi==''){
            alert('Nomor Transaksi Tidak Boleh Kosong');
            exit();
        }
		if (ckd_skpd==''){
            alert('Kode SKPD Tidak Boleh Kosong');
            exit();
        } 
        if (ckegiatan==''){
            alert('Kegiatan Tidak Boleh Kosong');
            exit();
        }
        if (cpptk==''){
            alert('PPTK Tidak Boleh Kosong');
            exit();
        }       
       /*  if (crekanan==''){
            alert('Rekanan Tidak Boleh Kosong');
            exit();
        }  */   
		/* if (cstaf_penerima==''){
            alert('Staf Tidak Boleh Kosong');
            exit();
        } */  
		if (cketua==''){
            alert('Ketua Tidak Boleh Kosong');
            exit();
        }  
		/* if (canggota_satu==''){
            alert('Anggota Satu Tidak Boleh Kosong');
            exit();
        }  
		if (canggota_dua==''){
            alert('Anggota Dua Tidak Boleh Kosong');
            exit();
        } */  
        if(lcstatus!='edit'){
		$(document).ready(function(){
            $.ajax({
                type: "POST",       
                dataType : 'json', 
                data: ({tabel:'plh_form_isian',no_transaksi:cno_transaksi,kd_skpd:ckd_skpd,tahun:thn,kegiatan:ckegiatan,nm_kegiatan:cnm_kegiatan,keterangan:cketerangan,pptk:cpptk,rekanan:crekanan,staf_penerima:cstaf_penerima,ketua:cketua,anggota_satu:canggota_satu,anggota_dua:canggota_dua,total:ctotal,jml_hps:charga_hps,jml_tawar:charga_tawar,jml_akhir:charga_akhir,pajak:cpajak,pph1:cpph1,pph2:cpph2,jml_ppn:cjml_ppn,jml_pph1:cjml_pph1,jml_pph2:cjml_pph2,ubah:ubah,iduser:iduser}),
                url: '<?php echo base_url(); ?>/index.php/simpl/simpan_hpl',
                 success:function(data){
                   status = data.pesan;                    
                   if (status == '0'){
                   swal({
					title: "Error!",
					text: "MAAF NOMOR TRANSAKSI SUDAH ADA, MOHON DIGANTI.!!",
					type: "error",
					confirmButtonText: "OK"
					});
					exit();
                   } else {                                 
					swal({
					title: "Berhasil",
					text: "Data telah disimpan.!!",
					imageUrl:"<?php echo base_url();?>/lib/images/logo_makassar.png"
					});                               
                    }                                                                                                         
                }
            });
       });  
		}else{
		//alert("masuk");
		lcquery  = "UPDATE plh_form_isian SET kegiatan='"+ckegiatan+"',nm_kegiatan='"+cnm_kegiatan+"',keterangan='"+cketerangan+"',pptk='"+cpptk+"',rekanan='"+crekanan+"',staf_penerima='"+cstaf_penerima+"',ketua='"+cketua+"',anggota_satu='"+canggota_satu+"',anggota_dua='"+canggota_dua+"',total='"+ctotal+"',jml_hps='"+charga_hps+"',jml_tawar='"+charga_tawar+"',jml_akhir='"+charga_akhir+"',ppn='"+cpajak+"',pph1='"+cpph1+"',pph2='"+cpph2+"',jml_ppn='"+cjml_ppn+"',jml_pph1='"+cjml_pph1+"',jml_pph2='"+cjml_pph2+"' where no_transaksi='"+cno_transaksi+"' and kd_uskpd='"+ckd_skpd+"'";     
        csimakda = "update trhtagih set tgl_bukti='',no_sp2d='',ket='"+cketerangan+"',username='"+cnmskpd+"',tgl_update='',nm_skpd='"+cnmskpd+"',total='"+charga_akhir+"',no_tagih='',sts_tagih='',status='',tgl_tagih='',jns_spp='' where no_transaksi='"+cno_transaksi+"' and kd_skpd='"+ckd_skpd+"'";           
					$(document).ready(function(){
                    $.ajax({
                        type: "POST",
                        url: '<?php echo base_url(); ?>index.php/simpl/update_master',
                        data: ({st_query:lcquery,simakda:csimakda}),
                          success:function(data){
						   status = data.pesan;                    
						   if (status == '0'){
						   swal({
							title: "Error!",
							text: "DATA GAGAl DISIMPAN..!!",
							type: "error",
							confirmButtonText: "OK"
							});
							exit();
						   } else {                                 
							swal({
							title: "Berhasil",
							text: "Data telah disimpan.!!",
							imageUrl:"<?php echo base_url();?>/lib/images/logo_makassar.png"
							});                               
							}                                                                                                         
						}
                       
						});
                    });
		}
    }
    	
     function hapuss(){
        var cno_transaksi = document.getElementById('no_transaksi').value;
		var ckd_skpd 	  = $('#uskpd').combogrid('getValue'); 
        var urll = '<?php echo base_url(); ?>index.php/simpl/hapus_pl_isian';
        var tny = confirm('Yakin Ingin Menghapus Data, Nomor Dokumen ini : '+cno_transaksi);        
        if (tny==true){
        $(document).ready(function(){
        $.ajax({url:urll,
                 dataType:'json',
                 type: "POST",    
                 data:({no:cno_transaksi,kd_skpd:ckd_skpd}),
                 success:function(data){
                        status = data.pesan;
                        if (status=='1'){
                            //alert('Data Berhasil Terhapus'); 
							$('#trh').datagrid('reload');         
                        } else {
                            alert('Gagal Hapus');
                        }        
                 }
                 
                });           
        });
        }     
    } 
	
     function hapus_rinci(){
        var urll = '<?php echo base_url(); ?>index.php/simpl/hapus_master';
        var tny = confirm('Yakin Ingin Menghapus Data, Nomor Dokumen ini : '+kode_gabung);        
        if (tny==true){
        $(document).ready(function(){
        $.ajax({url:urll,
                 dataType:'json',
                 type: "POST",    
                 data:({tabel:'pld_form_rincian',cid:'kode_gabung',cnid:kode_gabung}),
                 success:function(data){
                        status = data.pesan;
                        if (status=='1'){
                            //alert('Data Berhasil Terhapus'); 
							$('#rinci').datagrid('reload');         
                        } else { 
							$('#rinci').datagrid('reload');  
                            //alert('Gagal Hapus');
                        }        
                 }
                 
                });           
        });
        }     
    }
	
   function hapus(){
        var cno_transaksi = document.getElementById('no_transaksi').value;
		var cno			  = no;
		var ckd_skpd 	  = kd_skpd;
        var rows   		  = $('#dgd').datagrid('getSelected');
        kode 	   	      = rows.kode;
		kodegiat   	      = rows.kodegiat;
		jumlah 		  	  = rows.jumlah;
		harga_hps 	      = rows.harga_hpsx;
		harga_tawar 	  = rows.harga_tawarx;
		harga_akhir 	  = rows.harga_akhirx;  
        var urll = '<?php echo base_url(); ?>index.php/simpl/hapus_pld_isian';
        var tny = confirm('Yakin Ingin Menghapus Data Barang ini??');        
        if (tny==true){ 
         hargaxx 		= angka(document.getElementById('jumlah').value) - jumlah;
         harga_hpsxx 	= angka(document.getElementById('harga_hps').value) - harga_hps;
         harga_tawarxx 	= angka(document.getElementById('harga_tawar').value) - harga_tawar;
         harga_akhirxx 	= angka(document.getElementById('harga_akhir').value) - harga_akhir;
        //alert(hargaxx+"--"+harga_hpsxx+"--"+harga_tawarxx+"--"+harga_akhirxx);
            $('#jumlah').attr('value',number_format(hargaxx,2,'.',','));
            $('#harga_hps').attr('value',number_format(harga_hpsxx,2,'.',','));
            $('#harga_tawar').attr('value',number_format(harga_tawarxx,2,'.',','));
            $('#harga_akhir').attr('value',number_format(harga_akhirxx,2,'.',','));
		$(document).ready(function(){
        $.ajax({url:urll,
                 dataType:'json',
                 type: "POST",    
                 data:({no_transaksi:cno_transaksi,no:cno,kd_skpd:ckd_skpd,kode:kode,kodegiat:kodegiat}),
                 success:function(data){
                        status = data.pesan;
                        if (status=='1'){  
							$('#dgd').edatagrid('reload'); 
                            alert('Data Berhasil Terhapus');
							
                        } else {
                            alert('Gagal Hapus');
                        }        
                 }
                 
                });           
        });
        }   
    }
   

function cetak(){
	var no = document.getElementById('no_transaksi').value;
      url1 = "<?php echo base_url(); ?>index.php/simpl/ctk_bap1";
      lc1 = '?nomor='+no;
      var pariabel = url1+lc1;
      cetak_bap1(pariabel);
      window.open(url+lc,'_blank');
      window.focus();  
    } 
    
    function cetak_bap1(pariabel){
        window.open(pariabel,'_blank');
        window.focus();
    }
		
	function cari(){
	var kriteria = document.getElementById("txtcari").value; 
    $(function(){
     $('#trh').edatagrid({
		url: '<?php echo base_url(); ?>index.php/simpl/ambil_plh_form_isian',
        queryParams:({cari:kriteria})
        });        
     }); 
    }
	
function keluar2(){    
        $("#dialog-faiz").dialog('close');                      
    }
	
	function isNumberKey(evt)
		{
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))

		return false;
		return true;
		}
</script>

<div><h3 align="center" style="background-color:#fcbe02;"><b>SISTEM ADMINISTRASI PENUNJUKAN LANGSUNG</b></h3></div>
<div id="accordion" >
<h2 ><a align="center" id="sec1" ><B>List View</b></a></h2>
<div id="input1" >
        <div>
            <p align="right">
				<a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:nomer_akhir();kosong();kosong3();section2();">Tambah</a>
                <a class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="javascript:cari()" placeholder="*ketik nama kegiatan">Cari</a>
                <input type="text" value="" id="txtcari"/>           
                <table  id="trh" title="List Penunjukan Langsung" style="width:940px;height:700px;" >  
                </table>                
            </p>
        </div>
</div> 
<h2><a align="center" id="sec2" ><b>Form Input</b></a></h2>
<div id="input2">  
        <table>
            <tr>
                <td height="30px">No. Transaksi</td>
                <td>:</td>
                <td><input disabled="true" type="text" id="no_transaksi" name="no_transaksi" style="width: 150px;" maxlength="4;"/></td>
				<td colspan="3"></td>
            </tr>
			<tr>
                <td height="30px">SKPD</td>
                <td>:</td>
                <td><input disabled="true" type="text" id="uskpd" name="uskpd" style="width: 200px;" onclick="javascript:select();" /><input hidden="true" type="text" id="nmuskpd" name="nmuskpd" style="width:200px;  border:none;"  /> <b style="color:red">**</b></td>
                <td height="30px">Kegiatan</td>
                <td>:</td>
                <td><input type="text" id="kd" name="kd" style="width: 200px;" onclick="javascript:select();" /> <input type="text" id="namagiat" name="namagiat" style="width:200px;  border:none;"  />
				</td></tr>
			<tr>
                <td>Pekerjaan</td>
                <td>:</td>
                <td colspan="4"><textarea id="keterangan" style="width: 655px; height: 30px;"></textarea> <b style="color:red">**</b></td>           
			</tr>                       
        </table>  
			
		<table border="1" align="center">
			<tr>
				<td colspan="2" style="width: 400px;" onclick="javascript:select();" align="center" bgcolor="#fcbe02"><b>PPTK, Rekanan & Staf Penerima</b></td>
				<td colspan="2" style="width: 400px;" onclick="javascript:select();" align="center" bgcolor="#fcbe02"><b>Tim Penerima</b></td>
			</tr>
			<tr>
				<td>PPTK</td>
				<td><input type="text" id="pptk" style="width: 200px;" onclick="javascript:select();" /></td>
				<td>Ketua</td>
				<td><input type="text" id="ketua" style="width: 200px;" onclick="javascript:select();" /></td>
			</tr>
			<tr>
				<td>Rekanan</td>
				<td><input type="text" id="rekanan" style="width: 200px;" onclick="javascript:select();" /></td>
				<td>Pengadaan</td>
				<td><input type="text" id="anggota" style="width: 200px;" onclick="javascript:select();" /></td>
			</tr>
			<tr>
				<td>Staf Penerima</td>
				<td><input type="text" id="staf_penerima" style="width: 200px;" onclick="javascript:select();" /></td>
				<td></td>
				<td><input disabled="true" type="text" id="anggota2" style="width: 200px;" onclick="javascript:select();" /></td>
			</tr>
		</table>
		
        <br/> 
        <table  id="dgd" title="Detail Barang" style="width:940px;height:400px;" >  
            <div id="toolbar" align="center" >
    		  <a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:ambil_barang();"><b>Tambah Barang</b></a>   		                            		
            </div>
        </table> 
        <table border="1" align="center" style="width: 930px;">
			<tr>
				<td><b>Jumlah : </b><input type="text" id="jumlah" style="text-align: right;border:1;width: 200px;font-size: small;" readonly="true"/></td>
				<td><b>Jumlah Hps : </b><input type="text" id="harga_hps" style="text-align: right;border:1;width: 200px;font-size: small;" readonly="true"/></td>
				<td><b>Jumlah Penawaran : </b><input type="text" id="harga_tawar" style="text-align: right;border:1;width: 200px;font-size: small;" readonly="true"/></td>
				<td><b>Jumlah yang Disepakati : </b><input type="text" id="harga_akhir" style="text-align: right;border:1;width: 200px;font-size: small;" readonly="true"/>
				<input type="text" id="splh_prsen" name="splh_prsen" style="width:20px;" /></td>
			</tr>
		</table>
		<table border="0" align="center" style="width: 770px;">
			<tr>
				<td>PPN</td>
				<td ><input type="text" id="pajak" name="pajak" style="width: 40px;" onclick="javascript:select();" />
				<input disabled="true" type="text" id="nama_pajak" name="nama_pajak" style="width: 200px;" onclick="javascript:select();" />
				<input disabled="true" type="text" id="besar_pajak" name="besar_pajak" style="width: 40px;" onclick="javascript:select();" /></td>
				<td>Jumlah PPN</td>
				<td><input onkeypress="return(currencyFormat(this,',','.',event));" type="text" id="jml_ppn" style="width: 200px;" onclick="javascript:select();" /></td>
			</tr>
			<tr>
				<td>PPh 1</td>
				<td><input type="text" id="pajak1" style="width: 40px;" onclick="javascript:select();" />
				<input disabled="true" type="text" id="nama_pajak1" name="nama_pajak" style="width: 200px;" onclick="javascript:select();" />
				<input disabled="true" type="text" id="besar_pajak1" name="besar_pajak" style="width: 40px;" onclick="javascript:select();" /></td>
				<td>Jumlah PPh 1</td>
				<td><input onkeypress="return(currencyFormat(this,',','.',event));" type="text" id="jml_ppn1" style="width: 200px;" onclick="javascript:select();" /></td>
			</tr>
			<tr>
				<td>PPh 2</td>
				<td><input type="text" id="pajak2" style="width: 40px;" onclick="javascript:select();" />
				<input disabled="true" type="text" id="nama_pajak2" name="nama_pajak" style="width: 200px;" onclick="javascript:select();" />
				<input disabled="true" type="text" id="besar_pajak2" name="besar_pajak" style="width: 40px;" onclick="javascript:select();" /></td>
				<td>Jumlah PPh 2</td>
				<td><input onkeypress="return(currencyFormat(this,',','.',event));" type="text" id="jml_ppn2" style="width: 200px;" onclick="javascript:select();" /></td>
			</tr>
		</table>
        <div align="center">
			<fieldset>
			<INPUT TYPE="button" VALUE="SIMPAN" style="height:40px;width:100px" onclick="javascript:simpan();" >
			<INPUT TYPE="button" VALUE="TAMBAH PELENGKAP" style="height:40px;width:150px" onclick="javascript:section3();" >
			<INPUT TYPE="button" VALUE="KEMBALI" style="height:40px;width:100px" onclick="javascript:section1();" >
			</fieldset>
		</div> 
</div> 
<h2><a align="center" id="sec3" ><b>Kelengkapan</b></a></h2>
 <div id="input3" >
        <div>
         <table>
			<tr hidden="true">
				<td height="30px" >No. Transaksi</td>
                <td>:</td>
                <td colspan="3"><input type="text" id="no_trans" name="no_trans" style="width: 150px;" maxlength="4;"/></td>
                <!--td colspan="3"><input type="text" id="no_trans" style="width: 200px;" onclick="javascript:select();" /></td-->
			</tr>
			<tr hidden="true">
				<td height="30px" >skpd</td>
                <td>:</td>
                <td colspan="3"><input type="text" id="uskpdx" style="width: 200px;" onclick="javascript:select();" /></td>
			</tr>
		<p><b>.:Kelengkapan Dokumen</b></p>
			<tr>
				<td><b>Uraian</b><td>
				<td><b>Jml Hari</b></td>
				<td><b>Tanggal</b></td>
				<td><b>No. Document</b></td>
				<td><b>Keterangan</b></td>
			</tr>
			<tr>
				<td>Rancangan Anggaran Biaya<td>
				<td></td>
				<td><input type="text" id="tgl_rab" style="width: 140px;" /></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Harga Perkiraan Sendiri<td>
				<td></td>
				<td><input type="text" id="tgl_hps" style="width: 140px;" /></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Undangan Penunjukan Langsung<td>
				<td></td>
				<td><input type="text" id="tgl_upl" style="width: 140px;" /></td>
				<td><input type="text" id="no_upl" style="width: 200px;" onclick="javascript:select();" /></td>
				<td></td>
			</tr>
			<tr>
				<td>Surat Penawaran Rekanan<td>
				<td></td>
				<td><input type="text" id="tgl_spr" style="width: 140px;" /></td>
				<td><input type="text" id="no_spr" style="width: 200px;" onclick="javascript:select();" /></td>
				<td></td>
			</tr>
			<tr>
				<td>Pakta Integritas<td>
				<td></td>
				<td><input type="text" id="tgl_pi" style="width: 140px;" /></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Penerimaan Dan Pembukaan Dok<td>
				<td></td>
				<td><input type="text" id="tgl_bappd" style="width: 140px;" /></td>
				<td><input type="text" id="no_bappd" style="width: 200px;" onclick="javascript:select();" /></td>
				<td></td>
			</tr>
			<tr>
				<td>B.A Hasil Evaluasi, Klarifikasi & Negoisasi<td>
				<td></td>
				<td><input type="text" id="tgl_baek" style="width: 140px;" /></td>
				<td><input type="text" id="no_baek" style="width: 200px;" onclick="javascript:select();" /></td>
				<td></td>
			</tr>
			<tr>
				<td>B.A Hasil Pengadaan Langsung<td>
				<td></td>
				<td><input type="text" id="tgl_bahp" style="width: 140px;" /></td>
				<td><input type="text" id="no_bahp" style="width: 200px;" onclick="javascript:select();" /></td>
				<td></td>
			</tr>
			<tr>
				<td>Nota Dinas<td>
				<td></td>
				<td><input type="text" id="tgl_nodi" style="width: 140px;" /></td>
				<td><input type="text" id="no_nodi" style="width: 200px;" onclick="javascript:select();" /></td>
				<td></td>
			</tr>
			<tr>
				<td>SPPJB<td>
				<td></td>
				<td><input type="text" id="tgl_sppjb" style="width: 140px;" /></td>
				<td><input type="text" id="no_sppjb" style="width: 200px;" onclick="javascript:select();" /></td>
				<td></td>
			</tr>
			<tr>
				<td>Surat Perintah Kerja<td>
				<td></td>
				<td><input type="text" id="tgl_spk" style="width: 140px;" /></td>
				<td><input type="text" id="no_spk" style="width: 200px;" onclick="javascript:select();" /></td>
				<td></td>
			</tr>
			<tr>
				<td>Surat Pesanan<td>
				<td></td>
				<td><input type="text" id="tgl_sp" style="width: 140px;" /></td>
				<td><input type="text" id="no_sp" style="width: 200px;" onclick="javascript:select();" /></td>
				<td></td>
			</tr>
			<tr>
				<td>Tgl Ringkasan Kontrak<td>
				<td></td>
				<td><input type="text" id="tgl_rngks_kntrk" style="width: 140px;" /></td>
				<td><input type="text" id="jns_pem" style="width: 200px;" onclick="javascript:select();" placeholder="*isi cara pembayaran"/></td>
				<td></td>
			</tr>
			<tr>
				<td>SP Batas Jumlah Hari Pekerjaan<td>
				<td><input type="text" id="spbj" style="width: 20px;" onclick="javascript:select();" /></td>
				<td><input type="text" id="tgl_spbj" style="width: 140px;" /></td>
				<td></td>
				<td><input type="text" id="ket_spbj" style="width: 200px;" onclick="javascript:select();" /></td>
			</tr>
			<tr bgcolor="#E6E6FA">
				<td>Point 4 & 5 Surat Pesanan (tanggal dan alamat):<td>
				<td height="30px"></td>
				<td><input type="text" id="tgl_bapb2" style="width: 140px;" /></td>
				<td><input type="text" id="no_bapb2" style="width: 200px;" placeholder="*alamat" onclick="javascript:select();" /></td>
				<td></td>
			</tr>
			<tr>
				<td>B.A Pemeriksaan Barang/Jasa<td>
				<td></td>
				<td><input type="text" id="tgl_bapb1" style="width: 140px;" /></td>
				<td><input type="text" id="no_bapb1" style="width: 200px;" onclick="javascript:select();" /></td>
				<td></td>
			</tr>
			<!--tr>
				<td>B.A PEnerimaan Barang/Jasa<td>
				<td></td>
				<td><input type="text" id="tgl_bapb2" style="width: 140px;" /></td>
				<td><input type="text" id="no_bapb2" style="width: 200px;" onclick="javascript:select();" /></td>
				<td></td>
			</tr-->
			<tr>
				<td>B.A serah Terima Hasil. P<td>
				<td></td>
				<td><input type="text" id="tgl_bast" style="width: 140px;" /></td>
				<td><input type="text" id="no_bast" style="width: 200px;" onclick="javascript:select();" /></td>
				<td></td>
			</tr>
			<tr>
				<td>B.A Pembayaran Pekerjaan<td>
				<td></td>
				<td><input type="text" id="tgl_bapp" style="width: 140px;" /></td>
				<td><input type="text" id="no_bapp" style="width: 200px;" onclick="javascript:select();" /></td>
				<td></td>
			</tr>
			<tr>
				<td>Surat Kuasa<td>
				<td></td>
				<td><input type="text" id="tgl_sk" style="width: 140px;" /></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Kuitansi<td>
				<td></td>
				<td><input type="text" id="tgl_kuitansi" style="width: 140px;" /></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>SPP<td>
				<td></td>
				<td><input type="text" id="tgl_ssp" style="width: 140px;" /></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Faktur<td>
				<td></td>
				<td><input type="text" id="tgl_faktur" style="width: 140px;" /></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Surat P. Tanggung Jawaban Belanja LS<td>
				<td></td>
				<td><input type="text" id="tgl_spt" style="width: 140px;" /></td>
				<td><input type="text" id="no_spt" style="width: 200px;" onclick="javascript:select();" /></td>
				<td></td>
			</tr>
			<tr>
				<td>Waktu Pemeliharaan<td>
				<td><input type="text" id="wkt_pel" style="width: 20px;" onclick="javascript:select();" /></td>
				<td></td>
				<td>* Isi Angka Nol Jika Tidak Ada Pemeliharaan</td>
				<td></td>
			</tr>
		</table>
		<fieldset>
        <table align="center">
            <tr>
                <td>
					<a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:simpan_lengkap();">Simpan</a>
                    <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:section1();">Keluar</a>                               
                </td>
            </tr>
        </table>   
		</fieldset>
        </div>
</div>
	
</div>

<div id="dialog-modal" title="Input Barang">
    <fieldset>      
        <table  id="trd2" title="Detail Barang" style="width:965px;height:420px;" ></table> 
	</fieldset>  
    <fieldset>
        <table align="center">
            <tr>
                <td>
                    <a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:keluar_barang();">OK</a>
					<a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Keluar</a>                               
                </td>
            </tr>
			<tr>
                <td align="center">
				<div id="buka_dpa"><a class="easyui-linkbutton" iconCls="icon-add_pages" plain="true" onclick="javascript:detail();"></a>Rinci</div>
				<div id="tutup_dpa"><a class="easyui-linkbutton" iconCls="icon-add_pages" plain="true" onclick="javascript:detail_tutup();">Rinci</a></div>
                </td>
			</tr>
        </table>
    </fieldset>
    <fieldset>
		<div id="tambah_dpa">
					<b>Tambah dari Rekening: <input id="uraian_dpax" readonly="true" name="uraian_dpax" style="width: 400px; text-align: left; border:0;"/></b>
			<table border="1">
				<tr>
					<td width="10%" align="center" bgcolor="#fcbe02">KODEREK</td>
					<td hidden="true" width="5%" align="center" bgcolor="#fcbe02">NO</td>
					<td width="30%" align="center" bgcolor="#fcbe02">J.BARANG</td>
					<td width="10%" align="center" bgcolor="#fcbe02">SATUAN</td>
					<td width="10%" align="center" bgcolor="#fcbe02">KUANTITAS</td>
					<td width="15%" align="center" bgcolor="#fcbe02">HARGA</td>
					<td width="20%" align="center" bgcolor="#fcbe02">JUMLAH</td>
				</tr>
				<tr>
					<td hidden="true" align="center"><input id="no_dpa" name="no_dpa" style="text-align: left;"/></td>
					<!--td hidden="true" align="center"><input id="no_trans_dpa" name="no_trans_dpa" style="text-align: left;"/></td-->
					<td hidden="true" align="center"><input id="kodegiat_dpa" name="kodegiat_dpa" style="text-align: left;"/></td>
					<!--td hidden="true" align="center"><input id="kd_skpd_dpa" name="kd_skpd_dpa" style="text-align: left;"/></td-->
					<td align="center"><input  id="koderek_dpa" name="koderek_dpa" style="text-align: center;" readonly="true"/></td>
					<td align="center"><input  id="jns_brg_dpa" name="jns_brg_dpa" style="text-align: left;" onkeyup="javascript:hitung_dpa();"/></td>
					<td align="center"><input  id="satuan_dpa" name="satuan_dpa" style="text-align: center;"/></td>
					<td align="center"><input  id="kuantitas_dpa" name="kuantitas_dpa" type="number" style="text-align: center;"/></td>
					<td align="center"><input  id="harga_dpa" name="harga_dpa" style="text-align: right;" onkeyup="javascript:hitung_dpa();"/></td>
					<td align="center"><input  id="jumlah_dpa" name="jumlah_dpa" style="text-align: right;" readonly="true"/></td>
				</tr>
		<fieldset>
        <table align="center">
            <tr>
                <td>
					<a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:id_dpa(); kosong_dpa();">Tambah</a>
                    <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:dpa_append_save();">Tampung</a>                               
                </td>
            </tr>
        </table>   
		</fieldset>
			</table>
		</div>
    </fieldset>
</div>
<div id="dialog-faiz" title="">
    <p class="validateTips">Semua Inputan Harus Di Isi.</p> 
    <fieldset>
     <table align="center" style="width:100%;" border="1">
	 				<tr><td colspan="7"><font size="12" color="red"><i>*untuk Kuantitas dgn angka pecahan silahkan menggunakan titik(.) cth: 3.45</i></font></td></tr>
           <tr>
                <td align="center" bgcolor="#fcbe02">JENIS BARANG</td>
				<td width="10%" align="center" bgcolor="#fcbe02">KUANTITAS</td>
                <td align="center" bgcolor="#fcbe02">HARGA</td>
                <td hidden="true" align="center" bgcolor="#fcbe02">JUMLAH</td>
                <td align="center" bgcolor="#fcbe02">H. HPS</td>
                <td align="center" bgcolor="#fcbe02">H. TAWAR</td>
                <td align="center" bgcolor="#fcbe02">H. AKHIR</td>
           </tr>
           <tr>
                <td hidden="true"><input id="no_transaksix" name="no_transaksix" style="text-align: left;" disabled="true"/></td>
                <td hidden="true"><input id="kd_skpdx" name="kd_skpdx" style="text-align: left;" disabled="true"/></td>
                <td hidden="true"><input id="kodex" name="kodex" style="text-align: left;" disabled="true"/></td>
                <td hidden="true"><input id="kodegiatx" name="kodegiatx" style="text-align: left;" disabled="true"/></td>
                <td hidden="true"><input id="nox" name="nox" style="text-align: left;" disabled="true"/></td>
                <td><input id="jns_brg" name="jns_brg" style="text-align: left;"/></td>
				<td hidden="true"><input id="" name="" style="text-align: center;" /></td>
				<td><input id="kuantitas" name="kuantitas" style="text-align: center;" onkeyup="hitung();"/></td>
                <td><input id="harga" name="harga" style="text-align: right;" onkeyup="hitung();" /></td>
                <td hidden="true"><input id="" name="" style="text-align: right;" onkeypress="return(currencyFormat(this,',','.',event));" disabled="true"/></td>
                <td><input id="hrg_hps" name="hrg_hps" style="text-align: right;" onkeyup="hitung();"/></td>
				<td hidden="true"><input id="" name="" style="text-align: center;"  disabled="true"/></td>
                <td><input id="hrg_twr" name="hrg_twr" style="text-align: right;" onkeyup="hitung();"/></td>
				<td hidden="true"><input id="" name="" style="text-align: center;"  disabled="true"/></td>
                <td><input id="hrg_akhir" name="hrg_akhir" style="text-align: right;" onkeyup="hitung();"/></td>
				<td hidden="true"><input id="" name="" style="text-align: center;"  disabled="true"/></td>
           </tr>  
           <tr>
                <td hidden="true"><input id="" name="" style="text-align: left;" disabled="true"/></td>
                <td hidden="true"><input id="" name="" style="text-align: left;" disabled="true"/></td>
                <td hidden="true"><input id="" name="" style="text-align: left;" disabled="true"/></td>
                <td hidden="true"><input id="" name="" style="text-align: left;" disabled="true"/></td>
                <td hidden="true"><input id="" name="" style="text-align: left;" disabled="true"/></td>
                <td><input id="" name="" style="text-align: left;" disabled="true" disabled="true"/></td>
				<td><input id="satuan" name="satuan" style="text-align: center;" /></td>
				<td hidden="true"><input id="" name="" style="text-align: right;" onkeyup="hitung();"/></td>
                <td hidden="true"><input id="" name="" style="text-align: right;" onkeyup="hitung();" /></td>
                <td><input id="hrg_total" name="hrg_total" style="text-align: right;" onkeypress="return(currencyFormat(this,',','.',event));" disabled="true"/></td>
                <td hidden="true"><input id="" name="" style="text-align: right;" onkeyup="hitung();"/></td>
				<td><input id="tot_hps" name="tot_hps" style="text-align: right;"  disabled="true"/></td>
                <td hidden="true"><input id="" name="" style="text-align: right;" onkeyup="hitung();"/></td>
				<td><input id="tot_twr" name="tot_twr" style="text-align: right;"  disabled="true"/></td>
                <td hidden="true"><input id="" name="" style="text-align: right;" onkeyup="hitung();"/></td>
				<td><input id="tot_akhir" name="tot_akhir" style="text-align: right;"  disabled="true"/></td>
           </tr>            
            <tr>
                <td colspan="8" align="center">
				<a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:iz_append_save();">Simpan</a>
		        <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar2();">Kembali</a>
				<div id="buka"><a class="easyui-linkbutton" iconCls="icon-add_pages" plain="true" onclick="javascript:detail();">Detail</a></div>
				<div id="tutup"><a class="easyui-linkbutton" iconCls="icon-add_pages" plain="true" onclick="javascript:detail_tutup();">Detail</a></div>
				</td>                
            </tr>
        </table>  
        <div id="rincian_barang">
			<table style="width:100%;" border="0">
				<tr>
					<td colspan="9" width="100%"><b>Tambah Spesifikasi dari <input id="jns_brgx" name="jns_brgx" style="text-align: left; width: 450px; border:0;" readonly="true"/></b></td>
				</tr>
				<tr>
					<td width="10%"><b>Merek</b></td>
					<td width="1%">:</td>
					<td width="20%"><input id="merek" name="merek" style="width: 250px;" /></td>
					<td width="5%"><b>Type</b></td>
					<td width="1%">:</td>
					<td width="20%"><input id="tipe" name="tipe" style="width: 250px;" /></td>
					<td width="5%"><b>Warna</b></td>
					<td width="1%">:</td>
					<td width="10%"><input id="warna" name="warna" style="width: 100px;" /></td>
				</tr>
				<tr>
					<td width="10%"><b>Bahan</b></td>
					<td width="1%">:</td>
					<td width="10%"><input id="bahan" name="bahan" style="width: 100px;" /></td>
					<td width="5%"><b>Satuan</b></td>
					<td width="1%">:</td>
					<td width="10%"><input id="satuan_detail" name="satuan_detail" style="width: 100px;" /></td>
					<td width="5%"><b>Kondisi</b></td>
					<td width="1%">:</td>
					<td width="10%"><input id="kondisi" name="kondisi" style="width: 100px;" /></td>
				</tr>
				<tr>
					<td width="10%"><b>Keterangan</b></td>
					<td width="1%">:</td>
					<td width="70%" colspan="6"><textarea id="ket_detail" name="ket_detail" style="width: 450px;"></textarea></td>
				</tr>
			</table>
		</div>
    </fieldset> 
</div>
<div id="dialog-zainol" title="Input Barang" >
    <p class="validateTips" >Semua Inputan Harus Diisi.</p> 
    <fieldset>  	
			<tr>
                <td colspan="2"><marquee><h2>Tambah Detail <input id="rinci_uraian" name="rinci_uraian" style="border:0; width:400px;" readonly="true"/></h2></marquee></td>   
                <td colspan="2"><b>Rincian :</b></td>
            </tr>     
        <table> 
			<tr hidden='true'>
                <td>rinci_no_transaksi</td>
                <td>:</td>
                <td><input id="rinci_no_transaksi" name="rinci_no_transaksi" value=""/>  </td>                            
            </tr>
			<tr hidden='true'>
                <td>rinci_kd_skpd</td>
                <td>:</td>
                <td><input id="rinci_kd_skpd" name="rinci_kd_skpd" value=""/>  </td>                            
            </tr> 	                   
			<tr hidden='true'>
                <td>rinci_kode</td>
                <td>:</td>
                <td><input id="rinci_kode" name="rinci_kode" value=""/>  </td>                            
            </tr> 
			<tr hidden='true'>
                <td>rinci_kodegiat</td>
                <td>:</td>
                <td><input id="rinci_kodegiat" name="rinci_kodegiat" value=""/>  </td>                            
            </tr> 	
			<tr hidden='true'>
                <td>rinci_no</td>
                <td>:</td>
                <td><input id="rinci_no" name="rinci_no" value=""/>  </td>                            
            </tr> 			
			<tr hidden="true">
                <td>no_urut</td>
                <td>:</td>
                <td><input id="no_urut" name="no_urut" value="" disabled="true"/>  </td>                            
            </tr> 	
            <tr>
                <td>Jenis Barang</td>
                <td>:</td>
                <td width="150"><input id="rinci_jenis" name="rinci_jenis" value=""/> </td>
                <td rowspan="9"></td>   
                <td rowspan="9" width="660"  >
                    <table  id="rinci" title="Detail Rincian Barang" style="width:665px;height:270px;" ></table>           
                    <!--div align="right">Total : <input type="text" id="total2" style="text-align: right;border:0;width: 200px;font-size: large;" readonly="true"/></div-->     
                </td>         
            </tr>  
			<tr> 
                <td>Satuan</td>
                <td>:</td>
                <td><input id="rinci_satuan" name="rinci_satuan" value=""/>  </td>                            
            </tr> 
			<tr>
                <td>Kuantitas</td>
                <td>:</td>
                <td><input id="rinci_kuantitas" name="rinci_kuantitas" style="text-align: left;"/>  </td>                            
            </tr> 
			<tr>
                <td>Harga</td>
                <td>:</td>
                <td><input align="right" id="rinci_harga" name="rinci_harga" onkeypress="return(currencyFormat(this,',','.',event));"/>  </td>                            
            </tr> 
            <tr>
                <td>Harga HPS</td>
                <td>:</td>
                <td><input id="rinci_hps" name="rinci_hps" onkeypress="return(currencyFormat(this,',','.',event));"/>  </td>                            
            </tr>    
            <tr>
                <td>Harga Tawar</td>
                <td>:</td>
                <td><input id="rinci_tawar" name="rinci_tawar" onkeypress="return(currencyFormat(this,',','.',event));" style="border:1;"/>  </td>            
            </tr>  
            <tr>
                <td>Harga Akhir</td>
                <td>:</td>
                <td><input id="rinci_akhir" name="rinci_akhir" onkeypress="return(currencyFormat(this,',','.',event));" style="border:1;"/>  </td>            
            </tr>  
        </table>     
    </fieldset>  
    <fieldset>
        <table align="center">
            <tr>
                <td><a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:kosong2();max_rinci();">Tambah</a>
                    <a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:rinci_append_save();">Tampung</a>
                    <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar_rinci();">Keluar</a>                               
                </td>
            </tr>
        </table>   
    </fieldset>
</div>