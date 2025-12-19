	<link href='<?php echo base_url();?>public/js/jquery.autocomplete.css' rel='stylesheet' />
	<script type='text/javascript' src='<?php echo base_url();?>public/js/jquery.autocomplete.js'></script>

	<script type='text/javascript'>
		var site = "<?php echo site_url();?>";
		$(function(){
			$('.autocomplete').autocomplete({
				serviceUrl: site+'/master/ambil_rekanan',
				onSelect: function (suggestion) {
				}
			});	
		});
	</script>

<script src="<?php echo base_url(); ?>lib/sweet-alert.min.js"></script>
<link   rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>lib/sweet-alert.css">
<script type="text/javascript">
    var kdkel= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
    var lcskpd = '';
    var lpdok = '';
    var no_urut=0;
      //this view has modify by demansyah msm biak              
     $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
            height: 930,
            width: 1000,
            modal: true,
            autoOpen:false,
        });
        $( "#dialog-modal_gambar" ).dialog({
            height: 520,
            width: 500,
            modal: true,
            autoOpen:false
        });
        $( "#dialog-modal-aaa" ).dialog({
            height: 500,
            width: 500,
            modal: true,
            autoOpen:false
        });
        });    
       
       $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-riwayat" ).dialog({
            height: 350,
            width: 1000,
            modal: true,
            autoOpen:false,
        });
        }); 
     $(function(){
      
      $('#tanggal').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            },
			onSelect:function(){
			var tgl_reg= $('#tanggal').datebox('getValue');
      var thn = tgl_reg.substr(0,4); 
      //$('#tgl_oleh').datebox('setValue',tgl_reg);
      
      $("#th_oleh").attr("value",thn); 
			var bts_tgl= '2007-01-01';
			if (Date.parse(tgl_reg) <= Date.parse(bts_tgl)){swal({title: "Error!",text: "MOHON TANGGAL REGISTER TIDAK MELEBIHI ATAU SAMA TANGGAL 31 Desember 2014.!!, Karena Akan mempengaruhi Neraca Aset Per 2014.!, Silahkan Catat Tanggal Berlanjut dgn tdk merubah Tahun dan tgl Perolehan",type: "error",confirmButtonText: "OK"});
				exit();
			}}
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
        
       $('#tglstnk').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });
      
      $('#tglbpkb').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });
      
		$('#tgl_oleh').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });
		
		$('#tgl_riwayat').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });
		
      $('#nodok').combogrid({  
       panelWidth:550,  
       idField:'no_dokumen',  
       textField:'no_dokumen',
       loadMsg:"Sedang mengambil Data...!!",  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/transaksi/ambil_dok_b',  
       columns:[[  
           {field:'no_dokumen',title:'NOMOR DOKUMEN',width:150},
           {field:'nm_brg',title:'NAMA BARANG',width:200},  
           {field:'total2',title:'NILAI KONTRAK',width:150,align:"right"}    
       ]],  
       onSelect:function(rowIndex,rowData){
			no_dokumen	= rowData.no_dokumen;
			kd_brg		  = rowData.kd_brg;
			kd_unit		  = rowData.kd_unit;
			kd_uskpd	  = rowData.kd_uskpd;
			nm_brg		  = rowData.nm_brg;
			jumlah		  = rowData.jumlah;
			harga		    = rowData.harga;
			total		    = rowData.total;
			keterangan	= rowData.keterangan;
			s_dana		  = rowData.s_dana;
			kd_milik	  = rowData.kd_milik;
			kd_wilayah	= rowData.kd_wilayah;
			b_dasar		  = rowData.b_dasar;
			b_nomor		  = rowData.b_nomor;
			tahun		    = rowData.tahun;
			b_tanggal	  = rowData.b_tanggal;
			kd_cr_oleh	= rowData.kd_cr_oleh;
      jns_barang  = rowData.jns_barang;
      kd_bidang   = rowData.kd_bidang;
      no_bukti    = rowData.no_bukti;
      cad         = rowData.cad;
         get(no_bukti,cad,no_dokumen,kd_brg,kd_unit,kd_uskpd,nm_brg,jumlah,harga,total,keterangan,s_dana,kd_milik,kd_wilayah,b_dasar,b_nomor,tahun,b_tanggal,kd_cr_oleh,jns_barang,kd_bidang);
           //lutji();
           cek_status(no_dokumen,kd_uskpd,no_bukti,cad);         
       }  
     });
        
	
	$('#bida').combogrid({  
            panelWidth:600, 
            width:160, 
			url:'<?php echo base_url(); ?>index.php/master/ambil_bidang',queryParams:({gol:'02'}),
            idField:'bidang',  
            textField:'bidang',              
            mode:'remote',            
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'bidang',title:'Kode Barang',width:100},  
               {field:'nm_bidang',title:'Nama Barang',width:500}    
            ]],  
             onSelect:function(rowIndex,rowData){
				cbidang=rowData.bidang;
				$('#kelo').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_kelompok',queryParams:({bidang:cbidang}) });            
        }  
    });

  $('#bida2').combogrid({  
            panelWidth:600, 
            width:160, 
      url:'<?php echo base_url(); ?>index.php/master/ambil_bidang',queryParams:({gol:'02'}),
            idField:'bidang',  
            textField:'nm_bidang',              
            mode:'remote',            
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'bidang',title:'Kode Barang',width:100},  
               {field:'nm_bidang',title:'Nama Barang',width:500}    
            ]],  
             onSelect:function(rowIndex,rowData){
        cbidang=rowData.bidang;
        cari();            
        }  
    });
  $('#skpd2').combogrid({  
           panelWidth:500,  
           idField:'kd_skpd',  
           textField:'nm_skpd',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/master/ambil_skpd_dh',  
           columns:[[  
               {field:'kd_skpd',title:'KODE OPD',width:100},  
               {field:'nm_skpd',title:'NAMA OPD',width:400}    
           ]],  
           onSelect:function(rowIndex,rowData){
               cari();
                                
           }  
         });

  $('#tahun').combogrid({  
           panelWidth:50,  
           idField:'tahun',  
           textField:'tahun',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/master/tahun',  
           columns:[[  
               {field:'tahun',title:'TAHUN',width:50}    
           ]],  
           onSelect:function(rowIndex,rowData){
               cari();
                                
           }  
         });
        
		$('#kelo').combogrid({  
           panelWidth:600, 
            width:160, 
            idField:'kelompok',  
            textField:'kelompok',              
            mode:'remote',            
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kelompok',title:'Kode Barang',width:100},  
               {field:'nm_kelompok',title:'Nama Barang',width:500}    
            ]],  
             onSelect:function(rowIndex,rowData){
				ckelompok=rowData.kelompok;
				$('#kelo1').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_kelompok1', queryParams:({kelompok:ckelompok}) });            
        }  
    });
		
		 $('#kelo1').combogrid({    
            panelWidth:600, 
            width:160, 
            idField:'kd_kelompok',  
            textField:'kd_kelompok',              
            mode:'remote',            
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kd_kelompok',title:'Kode Barang',width:100},  
               {field:'nm_kelompok',title:'Nama Barang',width:500}    
            ]],  
             onSelect:function(rowIndex,rowData){
				csubkel=rowData.kd_kelompok; 
				//$('#kdbrg').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_brg_kib',queryParams:({subkel:csubkel,sts:'mrek5'})});             
        }  
    }); 	
		
/*	function lutji(){
		var doku    = $('#nodok').combogrid('getValue');
		if(doku== ''){
		 $('#kdbrg').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_brg_kib' }); 
		 }else{
		 $('#kdbrg').combogrid({url:'<?php echo base_url(); ?>index.php/transaksi/brg_msn',queryParams:({nodok:doku}) });     
		}
	} */

  function cek_status(no_dokumen,kd_uskpd,no_bukti,cad){
    var no_dokumen    = $('#nodok').combogrid('getValue');
    var kdbrg   = document.getElementById('kdbrg').value;
    var kd_uskpd = $('#skpd').combogrid('getValue');
    var no_bukti  = document.getElementById('nomor_bukti').value;
    var cad     = document.getElementById('cad').value;
    $(document).ready(function(){
    $.ajax({
      type:'post',
      data:({nodok:no_dokumen,kdbrg:kdbrg,skpd:kd_uskpd,no_bukti:no_bukti,cad:cad}),
      url :"<?php echo base_url(); ?>/index.php/transaksi/brg_msn_dh",
      dataType:"json",
      success:function(data){
        $.each(data,function(i,n){
            var st = n['invent'];
            //if(st==1){
              tombol(st);
            //}
        });
      }
    });
    });
  }
		
     /*$('#kdbrg').combogrid({  
           panelWidth:500,  
           panelHeight:400,  
           idField:'kd_brg',  
		   loadMsg:"Sedang Mencari Barang....",   
           textField:'kd_brg',  
           mode:'remote',             
		   url:'<?php echo base_url(); ?>index.php/master/ambil_brg_kib',          
           columns:[[
               {field:'kd_brg',title:'Kode Barang',width:100},  
               {field:'nm_brg',title:'Nama Barang',width:370}               
           ]],  
           onSelect:function(rowIndex,rowData){
               idxGiat 	= rowIndex;               
               brg 		= rowData.kd_brg;
               invent	= rowData.invent; 
               $("#nmbrg").attr("value",rowData.nm_brg);
               //$("#hrg_oleh").attr("value",number_format(rowData.total,2,',','.'));
               //$("#hrg_oleh").attr("value",number_format(rowData.total));
               $("#hrg").attr("value",rowData.total);
               $("#jml").attr("value",rowData.jml);
                tombol(invent); 
			  // masa_manfaat(brg);
			   //$('#masa_mafaat').combogrid({url:'<?php echo base_url(); ?>index.php/master/masa_manfaat',queryParams:({kd_brg:brg}) });
           }  
        }); */  
     
	    function masa_manfaat(brg){
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>index.php/transaksi/umur_brg',
            data: ({tabel:'mbarang_umur',id:'kd_barang',kd_brg:brg}),
            dataType:"json",
            success:function(data){                                          
                $.each(data,function(i,n){                                    
                    umur      = n['umur'];          
                    $("#masa_manfaat").attr("value",umur);                              
                });

            }
        });         
    } 
	 
     $('#kdtnh').combogrid({  
       panelWidth:500,  
       idField:'kd_brg',  
       textField:'kd_brg',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/transaksi/mtanah',  
       columns:[[ 
           {field:'kd_brg',title:'Kode Tanah',width:100},  
           {field:'nm_brg',title:'Nama Tanah',width:390}    
       ]],  
       onSelect:function(rowIndex,rowData){
           kd_tanah = rowData.kd_brg;
           $("#nmtanah").attr("value",rowData.nm_brg); 
       }  
     });
     
      $('#gambar').combogrid({  
       panelWidth:200,  
       idField:'nm',  
       textField:'nm',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/transaksi/scan',  
       columns:[[  
           {field:'nm',title:'Nama Foto',width:190}   
       ]],  
       onSelect:function(rowIndex,rowData){
           fot = rowData.nm;
           cokot(fot);
       }  
     });
     
     
     $('#milik').combogrid({  
       panelWidth:500,  
       idField:'kd_milik',  
       textField:'nm_milik',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_milik',  
       columns:[[  
           {field:'kd_milik',title:'KODE MILIK',width:100},  
           {field:'nm_milik',title:'KEPEMILIKAN',width:390}    
       ]] 
     });
     
     $('#wilayah').combogrid({  
       panelWidth:500,  
       idField:'kd_wilayah',  
       textField:'nm_wilayah',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_wilayah',  
       columns:[[  
           {field:'kd_wilayah',title:'KODE WILAYAH',width:100},  
           {field:'nm_wilayah',title:'WILAYAH',width:390}    
       ]] 
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
     
     $('#satuan').combogrid({  
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
       textField:'nmkondisi',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/mkondisi',
       loadMsg:"Tunggu Sebentar....!!",  
       columns:[[  
           {field:'kode',title:'Kode',width:40},
           {field:'kondisi',title:'Kondisi',width:40},
           {field:'nmkondisi',title:'Nama Kondisi',width:120}
       ]],
        onSelect:function(rowIndex,rowData){
           lckondisi = rowData.kode;
           $("#kon").attr("value",rowData.kondisi.toUpperCase());
       }  
     });
	 
      $('#lokasi').combogrid({  
       panelWidth:500,  
       idField:'nm_lokasi',  
       textField:'nm_lokasi',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_lokasi',  
       columns:[[  
           {field:'kd_lokasi',title:'KODE LOKASI',width:100},  
           {field:'nm_lokasi',title:'LOKASI',width:390}    
       ]] 
     });
     
   /*   $('#ruang').combogrid({  
       panelWidth:500,  
       idField:'nm_ruang',  
       textField:'nm_ruang',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_ruang',  
       columns:[[  
           {field:'kd_ruang',title:'KODE RUANGAN',width:100},  
           {field:'nm_ruang',title:'RUANGAN',width:390}    
       ]] 
     }); */
     
     
	$('#skp').combogrid({  
           panelWidth:500,  
           idField:'kd_skpd',  
           textField:'kd_skpd',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/master/ambil_msskpd2',  
           columns:[[  
               {field:'kd_skpd',title:'KODE OPD',width:100},  
               {field:'nm_skpd',title:'NAMA OPD',width:400}    
           ]],  
           onSelect:function(rowIndex,rowData){
               lcskpdx 	= rowData.kd_lokasi; 
               lcskpd 	= rowData.kd_skpd; 
               $('#skpd').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_uskpd',queryParams:({kduskpd:lcskpdx,skpd:lcskpd}) });
               $("#nmskp").attr("value",rowData.nm_skpd.toUpperCase());
                                
           }  
         });
     $('#skpd').combogrid({  
       panelWidth:500,  
       idField:'kd_uskpd',  
       textField:'kd_uskpd',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_ubidskpd',
       columns:[[  
           {field:'kd_uskpd',title:'KODE OPD',width:100},  
           {field:'nm_uskpd',title:'Nama OPD',width:390}    
       ]],  
       onSelect:function(rowIndex,rowData){
           lcskpd = rowData.kd_uskpd; 
           lcskpdx = rowData.kd_skpd;
           $("#kd_skpdx").attr("value",lcskpdx);
           $("#nmskpd").attr("value",rowData.nm_uskpd.toUpperCase());
		   $('#kdruang').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_ruang',queryParams:({kdlokasi:lcskpd}) });
           $('#uker').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_uker2',queryParams:({kduskpd:lcskpd}) });   
				nomer_akhir();		   
       }  
     });
     
     $('#uker').combogrid({  
       panelWidth:500,  
       idField:'kd_uker',  
       textField:'kd_uker',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_uker2',
       queryParams:({kduskpd:''}),
       loadMsg:"Tunggu Sebentar....!!",  
       columns:[[  
           {field:'kd_uker',title:'KODE UNIT KERJA',width:100},  
           {field:'nm_uker',title:'NAMA UNIT KERJA',width:390}    
       ]]
     });
     
     $('#perolehan').combogrid({  
       panelWidth:250,  
       idField:'cara_perolehan',  
       textField:'cara_perolehan',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/perolehan',
       loadMsg:"Tunggu Sebentar....!!",  
       columns:[[  
           {field:'cara_perolehan',title:'Cara Perolehan',width:220}
       ]]
     });
     
     $('#dsr_peroleh').combogrid({  
       panelWidth:200,  
       idField:'dasar_perolehan',  
       textField:'dasar_perolehan',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/dasar_perolehan',
       loadMsg:"Tunggu Sebentar....!!",  
       columns:[[  
           {field:'kode',title:'Kode',width:40},
           {field:'dasar_perolehan',title:'Dasar Perolehan',width:150}
       ]],
        onSelect:function(rowIndex,rowData){
           lckd = rowData.kode;
           $("#das").attr("value",rowData.dasar_perolehan.toUpperCase());
       }  
     });
     
     $('#jns_dana').combogrid({  
       panelWidth:100,  
       idField:'sumber_dana',  
       textField:'sumber_dana',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/mdana',
       loadMsg:"Tunggu Sebentar....!!",  
       columns:[[  
           {field:'kode',title:'Kode',width:10},
           {field:'sumber_dana',title:'Jenis Dana',width:90}
       ]],
        onSelect:function(rowIndex,rowData){
           lcsumber = rowData.kode;
           $("#sum").attr("value",rowData.sumber_dana.toUpperCase());
                         
       }  
     });
     
     $('#bkt_bayar').combogrid({  
       panelWidth:200,  
       idField:'bukti',  
       textField:'bukti',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/mbukti',
       loadMsg:"Tunggu Sebentar....!!",  
       columns:[[  
           {field:'kode',title:'Kode',width:40},
           {field:'Bukti',title:'Bukti Pembayaran',width:150}
       ]],
        onSelect:function(rowIndex,rowData){
           lcbukti = rowData.kode;
           $("#buk").attr("value",rowData.Bukti.toUpperCase());
       }  
     });
     
	 
	  $('#metode').combogrid({  
       panelWidth:250,
	   panelHeight:200,
       idField:'metode',  
       textField:'metode',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/mmetode',
       loadMsg:"Tunggu Sebentar....!!",  
       columns:[[  
           {field:'kode',title:'Kode',width:40},
           {field:'metode',title:'Metode',width:200}
       ]],
        onSelect:function(rowIndex,rowData){
           lckondisi = rowData.kode;
           $("#metode").attr("value",rowData.metode.toUpperCase());
                         
       }  
     });
	 
     $('#st_tanah').combogrid({  
       panelWidth:200,  
       idField:'status',  
       textField:'status',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/mstatus',
       loadMsg:"Tunggu Sebentar....!!",  
       columns:[[  
           {field:'kode',title:'Kode',width:40},
           {field:'status',title:'Status',width:150}
       ]],
        onSelect:function(rowIndex,rowData){
           lckondisi = rowData.kode;
           $("#sta").attr("value",rowData.status.toUpperCase());
                         
       }  
     });
        
	$('#kdruang').combogrid({  
           panelWidth:500,  
           idField:'kd_ruang',  
           textField:'kd_ruang',  
           mode:'remote',
           //url:'<?php echo base_url(); ?>index.php/master/ambil_ubidskpd',  
           columns:[[  
               {field:'kd_ruang',title:'KODE RUANGAN',width:100},  
               {field:'nm_ruang',title:'NAMA RUANGAN',width:400}    
           ]],  
           onSelect:function(rowIndex,rowData){
               nm_ruang = rowData.nm_ruang; 
               $("#nama_ruang").attr("value",rowData.nm_ruang.toUpperCase());
           }  
         });	
	$('#kd_riwayat').combogrid({  
       panelWidth:220,  
       idField:'kode',  
       textField:'riwayat',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/mriwayat',
       loadMsg:"Tunggu Sebentar....!!",  
       columns:[[  
           {field:'kode',title:'Kode',width:40},
           {field:'riwayat',title:'Riwayat',width:150}
       ]],
        onSelect:function(rowIndex,rowData){
           lckondisi = rowData.kode;
           $("#kon").attr("value",rowData.riwayat.toUpperCase());
       }  
     });
	 
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/transaksi/ambil_kib_b',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Sedang mengambil Barang...!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
            {field:'no_bukti',title:'bukti',width:30,align:"left",hidden:true},
            {field:'cad',title:'cad',width:30,align:"left",hidden:true},
            {field:'kd_skpd',title:'KODE OPD',width:25,align:"left"},
    	      {field:'kd_brg',title:'KODE BARANG',width:25,align:"left"},
            {field:'nm_brg',title:'NAMA BARANG',width:30,align:"left"},
            {field:'no_reg',title:'NO REGISTER',width:20,align:"left"},
            {field:'merek',title:'MEREK',width:40,align:"left"},
            {field:'tahun',title:'TAHUN',width:15,align:"left"},
            {field:'nilai1',title:'HARGA',width:20,align:"right"},
            {field:'keterangan',title:'KETERANGAN',width:35,align:"left"},
            {field:'id_barang',title:'id_barang',width:35,align:"left",hidden:true},
			{field:'history',title:'HIS',width:10,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/document.png' onclick='javascript:riwayat();'' />";}},
			{field:'del',title:'DEL',width:10,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus();'' />";}},

        ]],
        onSelect:function(rowIndex,rowData){
          lcidx 			= rowIndex;
          noreg 			= rowData.no_reg;
          no 				  = rowData.no;
          nodok 			= rowData.no_dokumen;
          kdbrg  			= rowData.kd_brg;
          id_barang		= rowData.id_barang;
		      no_furut		= rowData.no_urut; 
		      kd_skpd			= rowData.kd_skpd;
		      kd_unit			= rowData.kd_unit;
		      nm_brg			= rowData.nm_brg;
		      nilai				= rowData.nilai;
		      tahun				= rowData.tahun;
		      tgl_riwayat		= rowData.tgl_riwayat;
		      kd_riwayat		= rowData.kd_riwayat;
		      detail_riwayat	= rowData.detail_riwayat;
          nmskp       = rowData.nm_skpd;
          no_bukti    = rowData.no_bukti;
          cad         = rowData.cad;
		      get_riwayat(kd_skpd,nmskp,kd_unit,kdbrg,nm_brg,id_barang,nilai,tahun,no_furut,tgl_riwayat,kd_riwayat,detail_riwayat,no_bukti,cad);
        },
        onDblClickRow:function(rowIndex,rowData){
          lcidx 			 = rowIndex;
          judul 			 = 'Edit '; 
          lcstatus 		 = 'edit';
          id_barang		 = rowData.id_barang;
          noreg 			 = rowData.no_reg;
          no 				   = rowData.no;
          tglreg 			  = rowData.tgl_reg;
          tgloleh 			= rowData.tgl_oleh;
          nooleh 			  = rowData.no_oleh;
          nodok 			  = rowData.no_dokumen;
          milik 			  = rowData.milik;
          wilayah 			= rowData.wilayah;
          asal 				  = rowData.asal
          dsr_peroleh		= rowData.dsr_peroleh;
          kdbrg  			  = rowData.kd_brg;
          nm_brg        = rowData.nm_brg;
          detail_brg		= rowData.detail_brg;
          nilai1 			  = rowData.nilai; 
          nilai_baru		= rowData.total;
          tahun 			  = rowData.tahun;
          jumlah1 			= rowData.jumlah;
          total1 			  = rowData.total
          merek				  = rowData.merek;
          tipe				  = rowData.tipe;
          pabrik			  = rowData.pabrik;
          kd_warna			= rowData.kd_warna;
          kd_bahan 			= rowData.kd_bahan;
          kd_satuan			= rowData.kd_satuan;
          no_rangka			= rowData.no_rangka;
          no_mesin			= rowData.no_mesin;
          no_polisi			= rowData.no_polisi;
          silinder			= rowData.silinder;
          no_stnk			  = rowData.no_stnk;
          tgl_stnk			= rowData.tgl_stnk;
          no_bpkb			  = rowData.no_bpkb;
          tgl_bpkb			= rowData.tgl_bpkb;
          kondisi			  = rowData.kondisi;
          thn_produksi	= rowData.tahun_produksi;
          pengguna			= rowData.nip;
          dsr				    = rowData.dasar;
          sk				    = rowData.no_sk;
          tgl_sk			  = rowData.tgl_sk;
          ket				    = rowData.keterangan;
          kd_ruang			= rowData.kd_ruang;
          kd_lokasi			= rowData.kd_lokasi;
          kd_skpd			  = rowData.kd_skpd;
          kd_unit			  = rowData.kd_unit; 
		      no_furut			= rowData.no_urut;
          no_bukti      = rowData.no_bukti;
          cad           = rowData.cad;
          foto				  = rowData.foto;
          cokot(foto,'1');
          foto2				  = rowData.foto2;
          cokot(foto2,'2');
          foto3				  = rowData.foto3;
          cokot(foto3,'3');
          foto4				  = rowData.foto4;
          cokot(foto4,'4');
		      metode			  = rowData.metode;
          masa_manfaat	= rowData.masa_manfaat;
          nilai_sisa		= rowData.nilai_sisa;
          jns_barang    = rowData.jns_barang;
          kd_bidang     = rowData.kd_bidang;
          
		get1(no_bukti,cad,id_barang,noreg,no,tglreg,tgloleh,nooleh,nodok,milik,wilayah,asal,dsr_peroleh,kdbrg,detail_brg,nilai1,nilai_baru,tahun,jumlah1,merek,kd_ruang,kd_lokasi,kd_skpd,kd_unit,tipe,pabrik,kd_warna,kd_bahan,kd_satuan,no_rangka,no_mesin,no_polisi,silinder,no_stnk,tgl_stnk,no_bpkb,tgl_bpkb,kondisi,thn_produksi,pengguna,dsr,sk,tgl_sk,ket,masa_manfaat,nilai_sisa,no_furut,foto,foto2,foto3,foto4,jns_barang,kd_bidang,nm_brg);
		edit_data(); cek_status(); 
        }

        });
       
    });        

    
    function ajaxFileUpload(lc)
	{
        var lcno = 'gambar'+lc;
        var lcupload = 'fileToUpload'+lc;
		var cfile = document.getElementById(lcupload).files[0];
		//$("#gambar").attr("value",cfile.name);
		document.getElementById(lcno).value = cfile.name;
        
        
        cokot(cfile.name,lc);
		$("#loading")
		/*.ajaxStart(function(){
			$(this).show();
		})
		.ajaxComplete(function(){
			$(this).hide();
		});*/

		$.ajaxFileUpload
		(
			{
				url:'<?php echo base_url();?>index.php/transaksi/uploadfile',
				secureuri:false,
				fileElementId:lcupload,
				dataType: 'json',
				data:{name:'logan', id:'id'},
				success: function (data, status)
				{
					$("#loading").hide();
					if(typeof(data.error) != 'undefined')
					{
						if(data.error != '')
						{
							alert(data.error);
						}else
						{
							alert(data.msg);
						}
					}
				},
				error: function (data, status, e)
				{
					//alert(e);
				}
			}
		)
		return false;
	}
      
    function get(no_bukti,cad,no_dokumen,kd_brg,kd_unit,kd_uskpd,nm_brg,jumlah,harga,total,keterangan,s_dana,kd_milik,kd_wilayah,b_dasar,b_nomor,tahun,b_tanggal,kd_cr_oleh,jns_barang,kd_bidang){
           $('#nomor_bukti').attr('value',no_bukti);
           $('#cad').attr('value',cad);
           $("#nodok").attr("value",no_dokumen);
           $("#kdbrg").attr("value",kd_brg);
           $("#nmbrg").attr("value",nm_brg);
           $("#detail_brg").attr("value",nm_brg);
           $("#milik").combogrid("setValue",kd_milik);
           $("#wilayah").combogrid("setValue",kd_wilayah);
           $("#skp").combogrid("setValue",kd_uskpd);
           $("#skpd").combogrid("setValue",kd_unit);
           $("#perolehan").combogrid("setValue",kd_cr_oleh);
           $("#dsr_peroleh").combogrid("setValue",b_dasar);
           $("#no_oleh").attr("value",b_nomor);
           $("#tgl_oleh").datebox("setValue",b_tanggal);
           $("#th_oleh").attr("value",tahun);
           $("#hrg_oleh").attr("value",number_format(harga,2,'.',','));
           $("#jml").attr("value",jumlah);
           $("#jns_dana").combogrid("setValue",s_dana);
           $("#keterangan").attr("value",keterangan);
           $("#jns_barang").attr("value",jns_barang);
           $("#kd_bidang").attr("value",kd_bidang);
           
                       
    }
	
    function  get1(no_bukti,cad,id_barang,noreg,no,tglreg,tgloleh,nooleh,nodok,milik,wilayah,asal,dsr_peroleh,kdbrg,detail_brg,nilai1,nilai_baru,tahun,jumlah1,merek,kd_ruang,kd_lokasi,kd_skpd,kd_unit,tipe,pabrik,kd_warna,kd_bahan,kd_satuan,no_rangka,no_mesin,no_polisi,silinder,no_stnk,tgl_stnk,no_bpkb,tgl_bpkb,kondisi,thn_produksi,pengguna,dsr,sk,tgl_sk,ket,masa_manfaat,nilai_sisa,no_furut,foto,foto2,foto3,foto4,jns_barang,kd_bidang,nm_brg){
		       $("#noreg").attr("value",noreg);
           $("#mm").attr("value",masa_manfaat);
           $('#nomor_bukti').attr('value',no_bukti);
           $('#cad').attr('value',cad);
           $("#no").attr("value",no);
           $("#id_barang").attr("value",id_barang);
           $("#tanggal").datebox("setValue",tglreg);
           $("#tgl_oleh").datebox("setValue",tgloleh);
           $("#no_oleh").attr("value",nooleh);
           $("#nodok").combogrid("setValue",nodok);
           $("#lokasi").combogrid("setValue",kd_lokasi);
           $("#kdruang").combogrid("setValue",kd_ruang);
           $("#skp").combogrid("setValue",kd_skpd);
           $("#skpd").combogrid("setValue",kd_unit);
           $("#kdbrg").attr("value",kdbrg);
           $("#detail_brg").attr("value",detail_brg);
           $("#milik").combogrid("setValue",milik);
           $("#wilayah").combogrid("setValue",wilayah);
           $("#perolehan").combogrid("setValue",asal);
           $("#dsr_peroleh").combogrid("setValue",dsr_peroleh);
           $("#nmbrg").attr("value",nm_brg);
           $("#hrg_oleh").attr("value",number_format(nilai1,2,'.',','));
           $("#jml").attr("value",jumlah1);
           $("#th_oleh").attr("value",tahun);
           $("#merek").attr("value",merek);
           $("#tipe").attr("value",tipe);
           $("#pabrik").attr("value",pabrik);
           $("#warna").combogrid("setValue",kd_warna);
           $("#bahan").combogrid("setValue",kd_bahan);
           $("#satuan").combogrid("setValue",kd_satuan);
           $("#norangka").attr("value",no_rangka);
           $("#nomesin").attr("value",no_mesin);
           $("#nopolisi").attr("value",no_polisi);
           $("#silinder").attr("value",silinder);
           $("#nostnk").attr("value",no_stnk);
           $("#tglstnk").datebox("setValue",tgl_stnk);
           $("#nobpkb").attr("value",no_bpkb);
           $("#tglbpkb").datebox("setValue",tgl_bpkb);
           $("#kondisi").combogrid("setValue",kondisi);
           $("#thnbuat").attr("value",thn_produksi);
           $("#guna").attr("value",pengguna);
           $("#dsr_guna").attr("value",dsr);
           $("#no_sk").attr("value",sk);
           $("#tgl_sk").datebox("setValue",tgl_sk);
           $("#keterangan").attr("value",ket);
           $("#gambar").combogrid("setValue",foto);
	         $("#metode").combogrid("setValue",metode);
		       $("#masa_manfaat").attr("value",masa_manfaat);
           $("#nilai_sisa").attr("value",nilai_sisa);
           $("#nilai_baru").attr("value",number_format(nilai_baru,2,'.',','));
           $("#no_urut").attr("value",no_furut);
           $("#gambar1").attr("value",foto);
           $("#gambar2").attr("value",foto2);
           $("#gambar3").attr("value",foto3);
           $("#gambar4").attr("value",foto4);
           $("#jns_barang").attr("value",jns_barang);
           $("#kd_bidang").attr("value",kd_bidang);
		   if(tglreg<='2014-12-31'){
			document.getElementById("hrg_oleh").disabled=true;
		   }else{
			document.getElementById("hrg_oleh").disabled=false;
			}
                
    }
		function get_riwayat(kd_skpd,nmskp,kd_unit,kdbrg,nm_brg,id_barang,nilai,tahun,no_furut,tgl_riwayat,kd_riwayat,detail_riwayat,no_bukti,cad){
		       $("#kd_brg").attr("value",kdbrg);
		       $("#nm_brg").attr("value",nm_brg);
           $("#kd_skpd").attr("value",kd_skpd);
           $('#nm_skpd').attr('value',nmskp);
           $("#kd_unit").attr("value",kd_unit);
           $("#no_urut").attr("value",no_furut);
           $("#id_barang").attr("value",id_barang);
           $('#nomor_bukti').attr('value',no_bukti);
           $('#cad').attr('value',cad);
           $("#nilai").attr("value",number_format(nilai,2,'.',','));
           $("#tahun").attr("value",tahun);
           $("#tgl_riwayat").datebox("setValue",tgl_riwayat);
           $("#kd_riwayat").combogrid("setValue",kd_riwayat);
           $("#detail_riwayat").attr("value",detail_riwayat);
	}
   function  cokot(foto,lc){
         var lcfoto = 'foto'+lc;
         document.getElementById(lcfoto).src = "<?php echo base_url(); ?>data/"+foto;
    }
	
    function kosong(){
		    var skpd  = '<?php echo ($this->session->userdata('unit_skpd')); ?>';
		    var thn	  = '<?php echo ($this->session->userdata('ta_simbakda')); ?>';
        $("#noreg").attr("value",'');
        $("#tanggal").datebox("setValue",'');
        $("#nodok").combogrid("clear");
        $("#nodok").combogrid("enable");
        $("#nodok").combogrid('grid').datagrid('reload');
        $("#kdbrg").attr("value",'');
        $("#detail_brg").attr("value",'');
        $("#nmbrg").attr("value",'');
        $("#milik").combogrid("setValue",'');
        $("#wilayah").combogrid("setValue",'');
        $('#cad').attr('value','');
        //$("#skpd").combogrid("setValue",skpd);
        $("#skp").combogrid("clear");
        $("#skpd").combogrid("clear");
        $("#skp").combogrid("disable");
        $("#skpd").combogrid("disable");
        $("#nmskpd").attr("value",'');
        $("#lokasi").combogrid("setValue",'');
        $("#ruang").combogrid("setValue",'');
        $("#uker").combogrid("setValue",'');
        $("#dsr_peroleh").combogrid("setValue",'');
        $("#perolehan").combogrid("clear");
        $("#no_oleh").attr("value",'');
        $("#tgl_oleh").datebox("setValue",'');
        $("#th_oleh").attr("value",thn);
        $("#thn_anggar").attr("value",'');
        $("#sum").attr("value",'');
        $("#jns_dana").combogrid("setValue",'');
        $("#bkt_bayar").combogrid("setValue",'');
        $("#merek").attr("value",'');
        $("#tipe").attr("value",'');
        $("#pabrik").attr("value",'');
        $("#warna").combogrid("clear");
        $("#bahan").combogrid("clear");
        $("#satuan").combogrid("clear");
        $("#norangka").attr("value",'');
        $("#nomesin").attr("value",'');
        $("#nopolisi").attr("value",'');
        $("#silinder").attr("value",'');
        $("#nostnk").attr("value",'');
        $("#tglstnk").datebox("setValue",'');
        $("#nobpkb").attr("value",'');
        $("#tglbpkb").datebox("setValue",'');
        $("#kondisi").combogrid("clear");
        $("#thnbuat").attr("value",'');
        $("#guna").attr("value",'');
        $("#das").attr("value",'');
        $("#dsrguna").attr("value",'');
        $("#no_sk").attr("value",'');
        $("#tgl_sk").datebox("setValue",'');
        $("#keterangan").attr("value",'');
        $("#das").attr("value",'');
        $("#hrg_oleh").attr("value",'');
	      $("#nilai_baru").attr("value",'');
        $("#hrg").attr("value",'');
        $("#hrg1").attr("value",'');
        $("#hrg2").attr("value",'');
        $("#buk").attr("value",'');
        $("#jml").attr("value",'');
        $("#jml1").attr("value",'');
        $("#dsr_guna").attr("value",'');
        $("#no_urut").attr("value",'');
        $("#kdruang").combogrid("setValue",'');
        $("#gambar").combogrid("setValue",'');
	      $("#metode").combogrid("setValue",'');
	      $("#masa_manfaat").attr("value",'');
        $("#nilai_sisa").attr("value",'');
        $("#no_urut").attr("value",'');
        $("#gambar1").attr("value",'');
        $("#gambar2").attr("value",'');
        $("#gambar3").attr("value",'');
        $("#gambar4").attr("value",'');
        $("#fileToUpload1").attr("value",'');
        $("#fileToUpload2").attr("value",'');
        $("#fileToUpload3").attr("value",'');
        $("#fileToUpload4").attr("value",'');
        cokot('','1');
        cokot('','2');
        cokot('','3');
        cokot('','4');
        document.getElementById("p1").innerHTML="";
        $("#save").linkbutton('enable');
        $('#jns_barang').attr("value",'');
        $('#kd_bidang').attr("value",'');
        $("#kd_skpd").attr("value",'');
        $("#nm_skpd").attr("value",'');
        nomer_akhir();
    }

    function cari(){
    var kriteria = document.getElementById("txtcari").value;
    var bidang   = $('#bida2').combogrid('getValue');
    var skpd     = $('#skpd2').combogrid('getValue');
    var tahun    = $('#tahun').combogrid('getValue');
    $(function(){
     $('#dg').edatagrid({
		url: '<?php echo base_url();?>index.php/transaksi/ambil_kib_b',
        queryParams:({cari:kriteria,cari2:bidang,cari3:skpd,cari4:tahun})
        });        
     });
    }
    
    
     function gambar(lf){
        
        lcfoto = 'foto'+lf;
        document.getElementById("fotoZ").src =  document.getElementById(lcfoto).src;
        $("#dialog-modal_gambar").dialog('open');             
    }
    
    function simpan(){
			var id_barang 	= document.getElementById('id_barang').value;
			var nmbrg		= document.getElementById('nmbrg').value;
			var no_urut 	= document.getElementById('no_reg').value;
      var no_urut1   = document.getElementById('noreg').value;
			var urutan	 	= document.getElementById('no_urut').value;
			var no_dokumen 	= $('#nodok').combogrid('getValue');
			var kd_brg 		= document.getElementById('kdbrg').value; //$('#kdbrg').combogrid('getValue');
			var detail 		= document.getElementById('detail_brg').value;
			var skpd 		= $('#skp').combogrid('getValue');
			var kd_unit 	= $('#skpd').combogrid('getValue');
			var dsr_peroleh	= $('#dsr_peroleh').combogrid('getValue');
			var no_oleh		= document.getElementById('no_oleh').value;
			var kd_ruang	= $('#kdruang').combogrid('getValue');
			var tgl_oleh	= $('#tgl_oleh').datebox('getValue');
			var tgl_reg		= $('#tanggal').datebox('getValue');
			var tahun 		= document.getElementById('th_oleh').value;
			var milik	 	= $('#milik').combogrid('getValue');
			var wilayah		= $('#wilayah').combogrid('getValue');
			var nilai 		= angka(document.getElementById('hrg_oleh').value);
			var nilai_baru	= angka(document.getElementById('nilai_baru').value);
			var perolehan 	= $('#perolehan').combogrid('getValue');
			var jml 		= angka(document.getElementById('jml').value);
			var bagi		= jml/jml;
			var total	 	= angka(document.getElementById('hrg_oleh').value);
			var merek 		= document.getElementById('merek').value;
      var mm     = document.getElementById('mm').value;
			var tipe 		= document.getElementById('tipe').value;
			var warna 		= $('#warna').combogrid('getValue');
			var bahan 		= $('#bahan').combogrid('getValue');
			var satuan 		= $('#satuan').combogrid('getValue');
			var norangka 	= document.getElementById('norangka').value;
			var nomesin 	= document.getElementById('nomesin').value;
			var nopolisi 	= document.getElementById('nopolisi').value;
			var silinder 	= document.getElementById('silinder').value;
			var nostnk 		= document.getElementById('nostnk').value;
			var tglstnk 	= $('#tglstnk').datebox('getValue');
			var nobpkb 		= document.getElementById('nobpkb').value;
			var tglbpkb 	= $('#tglbpkb').datebox('getValue');
			var kondisi 	= $('#kondisi').combogrid('getValue');
			var keterangan 	= document.getElementById('keterangan').value;
			var metode 		= $('#metode').combogrid('getValue');
			var masa_manfaat = document.getElementById('mm').value;
			var nilai_sisa 	= document.getElementById('nilai_sisa').value;
			var file_gbr	= document.getElementById('gambar1').value;
			var file_gbr2 	= document.getElementById('gambar2').value;
			var file_gbr3 	= document.getElementById('gambar3').value;
			var file_gbr4 	= document.getElementById('gambar4').value; 
      var username = '<?php echo $this->session->userdata('nmuser'); ?>';
      var tgl_update    = '<?php echo date('y-m-d H:i:s'); ?>';
      var kd_gol    = document.getElementById('jns_barang').value;
      var kd_bidang = document.getElementById('kd_bidang').value;
      var no_bukti  = document.getElementById('nomor_bukti').value;
      var cad       = document.getElementById('cad').value;
      
			lcinsert = '(no_reg,id_barang,no,no_oleh,tgl_reg,tgl_oleh,no_dokumen,kd_golongan,kd_bidang,kd_brg,nm_brg,detail_brg,nilai,asal,dsr_peroleh,jumlah,total,merek,tipe,kd_warna,kd_bahan,kd_satuan,no_rangka,no_mesin,no_polisi,silinder,no_stnk,tgl_stnk,no_bpkb,tgl_bpkb,kondisi,keterangan,kd_ruang,kd_skpd,kd_unit,milik,wilayah,username,tgl_update,tahun,foto,foto2,foto3,foto4,no_urut,metode,masa_manfaat,nilai_sisa,kd_pemilik,no_bukti,cad)';
		   
		       
       	if (kd_brg==''){
            alert('Kode Barang Tidak Boleh Kosong.!');
            exit();
        }if (tgl_reg==''){
            alert('Tanggal Register Tidak Boleh Kosong.!');
            exit();
        }if (milik==''){
            alert('Kepemilikan Tidak Boleh Kosong.!');
            exit();
        }if (wilayah==''){
            alert('Wilayah Tidak Boleh Kosong.!');
            exit();
        }  if (skpd==''){
            alert('Kode OPD Tidak Boleh Kosong.!');
            exit();
        }if (kd_unit==''){
            alert('Kode Unit OPD Tidak Boleh Kosong.!');
            exit();
        }   if (nilai==''){
            alert('Nilai Tidak Boleh Kosong.!');
            exit();
        }  if (kondisi==''){
            alert('Kondisi Tidak Boleh Kosong.!');
            exit();
        } if (tahun==''){
            alert('Tahun Perolehan Tidak Boleh Kosong.!');
            exit();
        } if (tgl_oleh==''){
            alert('Tanggal Perolehan Tidak Boleh Kosong.!');
            exit();
        }              
		if (jml==''){
            alert('Jumlah Tidak Boleh Kosong..!!');
           exit();
        }

      if (masa_manfaat=='' || masa_manfaat == '0'){
            alert('Masa Manfaat Tidak Boleh Kosong..!!');
           exit();
        }
      
    $('#save').linkbutton('disable');
		$("#dialog-modal-aaa").dialog('open');	    
		if(lcstatus=='tambah'){ 
        lcvalues = '';
        for(var i=0;i<jml;i++){
			creg   = i+1;
            no_urt = tambah_urut(no_urut,7);
            nomor  = no_urt;
            urutan = no_urt;
			id_barang = kd_unit+'.'+tahun+'.'+kd_brg+'.'+no_urt+'.'+urutan ;
            no_gabung = kd_brg+'/'+no_urt+'/'+kd_unit ;
            if(i>0){
				   lcvalues = lcvalues+",('"+nomor+"','"+id_barang+"','"+no_gabung+"','"+no_oleh+"','"+tgl_reg+"','"+tgl_oleh+"','"+no_dokumen+"','"+kd_gol+"','"+kd_bidang+"','"+kd_brg+"','"+nmbrg+"','"+detail+"','"+nilai+"','"+perolehan+"','"+dsr_peroleh+"','"+bagi+"','"+nilai_baru+"','"+merek+"','"+tipe+"','"+warna+"','"+bahan+"','"+satuan+"','"+norangka+"','"+nomesin+"','"+nopolisi+"','"+silinder+"','"+nostnk+"','"+tglstnk+"','"+nobpkb+"','"+tglbpkb+"','"+kondisi+"','"+keterangan+"','"+kd_ruang+"','"+skpd+"','"+kd_unit+"','"+milik+"','"+wilayah+"','"+username+"','"+tgl_update+"','"+tahun+"','"+file_gbr+"','"+file_gbr2+"','"+file_gbr3+"','"+file_gbr4+"','"+urutan+"','"+metode+"','"+mm+"','"+nilai_sisa+"','"+milik+"','"+no_bukti+"','"+cad+"')";
				}else{
					lcvalues = lcvalues+"('"+nomor+"','"+id_barang+"','"+no_gabung+"','"+no_oleh+"','"+tgl_reg+"','"+tgl_oleh+"','"+no_dokumen+"','"+kd_gol+"','"+kd_bidang+"','"+kd_brg+"','"+nmbrg+"','"+detail+"','"+nilai+"','"+perolehan+"','"+dsr_peroleh+"','"+bagi+"','"+nilai_baru+"','"+merek+"','"+tipe+"','"+warna+"','"+bahan+"','"+satuan+"','"+norangka+"','"+nomesin+"','"+nopolisi+"','"+silinder+"','"+nostnk+"','"+tglstnk+"','"+nobpkb+"','"+tglbpkb+"','"+kondisi+"','"+keterangan+"','"+kd_ruang+"','"+skpd+"','"+kd_unit+"','"+milik+"','"+wilayah+"','"+username+"','"+tgl_update+"','"+tahun+"','"+file_gbr+"','"+file_gbr2+"','"+file_gbr3+"','"+file_gbr4+"','"+urutan+"','"+metode+"','"+mm+"','"+nilai_sisa+"','"+milik+"','"+no_bukti+"','"+cad+"')";
				}         
			no_urut=no_urt;    
			}	  
			$(document).ready(function(){
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>index.php/transaksi/simpan_trkib_b',
                    data: ({tabel:'trkib_b',urut:urutan,reg:no_urt,unit:kd_unit,no:no_dokumen,kolom:lcinsert,lcvalues:lcvalues,kode:kd_unit,ruang:kd_ruang,skpd:skpd,kd_brg:kd_brg,nilai:nilai,no_bukti:no_bukti,cad:cad}),
                    dataType:"json",
                    success:function(data){                                          
                        $.each(data,function(i,n){                                    
                            pesan = n['pesan'];
                            if(pesan==1){
                              $("#dialog-modal-aaa").dialog('close');
                              $('#save').linkbutton('enable');
                              swal({
                              title: "Berhasil",
                              text: "Data telah disimpan.!!",
                              imageUrl:"<?php echo base_url();?>/lib/images/biak.jpg"
                              });
                              
                              $("#dialog-modal").dialog('close');
                              $('#dg').edatagrid('reload');
                              $('#dg').edatagrid('unselectAll');
                            }else{
                              $("#dialog-modal-aaa").dialog('close');
                              $('#save').linkbutton('enable');
                              swal({
                                title: "Oooopppppsssssssss!!!!!!!!!!",
                                text: "Data Gagal disimpan.!!",
                                imageUrl:"<?php echo base_url();?>/lib/images/er.jpg"
                                });
                              
                            }                              
                        });
                    }
                });
            });
        } else{ 
            lcquery = "UPDATE trkib_b SET no_oleh='"+no_oleh+"',tgl_reg='"+tgl_reg+"',tgl_oleh='"+tgl_oleh+"',no_dokumen='"+no_dokumen+"',kd_golongan='"+kd_gol+"',kd_bidang='"+kd_bidang+"',kd_brg='"+kd_brg+"',nm_brg='"+nmbrg+"',detail_brg='"+detail+"',nilai='"+nilai+"',asal='"+perolehan+"',dsr_peroleh='"+dsr_peroleh+"',jumlah='"+bagi+"',total='"+nilai_baru+"',merek='"+merek+"',tipe='"+tipe+"',kd_warna='"+warna+"',kd_bahan='"+bahan+"',kd_satuan='"+satuan+"',no_rangka='"+norangka+"',no_mesin='"+nomesin+"',no_polisi='"+nopolisi+"',silinder='"+silinder+"',no_stnk='"+nostnk+"',tgl_stnk='"+tglstnk+"',no_bpkb='"+nobpkb+"',tgl_bpkb='"+tglbpkb+"',kondisi='"+kondisi+"',keterangan='"+keterangan+"',kd_ruang='"+kd_ruang+"',kd_skpd='"+skpd+"',kd_unit='"+kd_unit+"',milik='"+milik+"',wilayah='"+wilayah+"',username='"+username+"',tgl_update='"+tgl_update+"',tahun='"+tahun+"',foto='"+file_gbr+"',foto2='"+file_gbr2+"',foto3='"+file_gbr3+"',foto4='"+file_gbr4+"',metode='"+metode+"',masa_manfaat='"+masa_manfaat+"',nilai_sisa='"+nilai_sisa+"',kd_pemilik='"+milik+"' WHERE id_barang='"+id_barang+"' and no_reg='"+no_urut1+"'";// and no_urut='"+urutan+"'
			
            $(document).ready(function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>index.php/transaksi/update_trkib_b',
                data: ({st_query:lcquery}),
                dataType:"json",
                    success:function(data){                                          
                        $.each(data,function(i,n){                                    
                            pesan = n['pesan'];
                            if(pesan==1){
                              $("#dialog-modal-aaa").dialog('close');
                              $('#save').linkbutton('enable');
                              swal({
                              title: "Berhasil",
                              text: "Data telah di-Update!!",
                              imageUrl:"<?php echo base_url();?>/lib/images/biak.jpg"
                              });
                              
                              $("#dialog-modal").dialog('close');
                              $('#dg').edatagrid('reload');
                              $('#dg').edatagrid('unselectAll');
                            }else{
                              $("#dialog-modal-aaa").dialog('close');
                              $('#save').linkbutton('enable');
                              swal({
                                title: "Oooopppppsssssssss!!!!!!!!!!",
                                text: "Data Gagal di-Update.!!",
                                imageUrl:"<?php echo base_url();?>/lib/images/er.jpg"
                                });
                              
                            }                              
                        });
                    }
            });
            });
			
        }              
		/*swal({
		title: "Berhasil",
		text: "Data telah disimpan.!!",
		imageUrl:"<?php echo base_url();?>/lib/images/biak.jpg"
		});
        $("#dialog-modal").dialog('close');
        $('#dg').edatagrid('reload');*/
        
    }
	
	function simpan_riwayat(){
        var id_barang 		= document.getElementById('id_barang').value;
		    var tgl_riwayat		= $('#tgl_riwayat').datebox('getValue');
        var kd_riwayat 		= $('#kd_riwayat').combogrid('getValue'); 
        var detail_riwayat	= document.getElementById('detail_riwayat').value;
		
        var tahun	= document.getElementById('tahun').value;
        var kd_unit	= document.getElementById('kd_unit').value;
        var no_urut	= document.getElementById('no_urut').value;
        var kd_brg	= document.getElementById('kd_brg').value;
        if (kd_riwayat==''){
            alert('Riwayat Barang Tidak Boleh Kosong');
            exit();
        } 
		
        lcinsert = "(kd_riwayat,tgl_riwayat,detail_riwayat)";
        
        if(lcstatus=='tambah'){ 
		        lcvalues = "('"+kd_riwayat+"','"+tgl_riwayat+"','"+detail_riwayat+"')";

            $(document).ready(function(){
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>index.php/transaksi/simpan_trkib_b',
                    data: ({tabel:'trkib_b',no:id_barang,kolom:lcinsert,lcvalues:lcvalues}),
                    dataType:"json"
                });
            });    
        } else {
            lcquery = "update trkib_b set kd_riwayat='"+kd_riwayat+"',tgl_riwayat='"+tgl_riwayat+"',detail_riwayat='"+detail_riwayat+"' where id_barang ='"+id_barang+"' and tahun ='"+tahun+"' and kd_unit ='"+kd_unit+"' and kd_brg ='"+kd_brg+"'";//and no_urut ='"+no_urut+"' 
			$(document).ready(function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>index.php/transaksi/update_trkib_b',
                data: ({st_query:lcquery}),
                dataType:"json"
            });
            });
        }                            
		swal({
		title: "Berhasil",
		text: "Data telah disimpan.!!",
		imageUrl:"<?php echo base_url();?>/lib/images/biak.jpg"
		});
        $("#dialog-riwayat").dialog('close');
        $('#dg').edatagrid('reload');       
    }	
    
      function edit_data(){
          lcstatus = 'edit';
          judul = 'Edit Data Kib B';
          $("#dialog-modal").dialog({ title: judul });
          $("#dialog-modal").dialog('open');
          document.getElementById("noreg").disabled=true;
          $('#save').linkbutton('enable');
          $('#nodok').combogrid('disable');
          $('#skp').combogrid('disable');
          $('#skpd').combogrid('disable');
        }    
        
    
     function tambah(){
        lcstatus = 'tambah';
        judul = 'Input Data Kib B';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
        $("#dialog-modal").dialog('open');
       // document.getElementById("noreg").disabled=true;
       // document.getElementById("noreg").focus();
        } 
     function keluar(){
        $("#dialog-modal").dialog('close');
		    $("#dialog-riwayat").dialog('close');
        $('#dg').edatagrid('unselectAll');
        $('#dg').edatagrid('reload');
        kosong();
     } 

     function keluar1(){
      $("#dialog-modal_gambar").dialog('close');
     }
	  function riwayat(){
        $("#dialog-riwayat").dialog('open');
		
     } 

     //has modify by demansyah
     function hapus(){
      var rows = $('#dg').datagrid('getSelected');
      id_brg   = rows.id_barang;
      kd_brg   = rows.kd_brg;
      kd_skpd  = rows.kd_skpd;
      no_bukti = rows.no_bukti;
      cad      = rows.cad;
    var del = confirm("Apakah Anda Yakin ingin menghapus data   "+id_brg+"?");
		if (del==true){     
        var urll = '<?php echo base_url(); ?>index.php/transaksi/hapus_trkib_b';
        $(document).ready(function(){
         $.post(urll,({no:id_barang,dok:nodok,no_urut:no_furut,kdbrg:kd_brg,kd_skpd:kd_skpd,no_bukti:no_bukti,cad:cad}),function(data){
            status = data;
            if (status=='0'){
                alert('Gagal Hapus..!!');
                exit();
            } else {
                $('#dg').edatagrid('reload');
                exit();
            }
         });
        });   
      }
    } 
        
  function nomer_akhir(){
        var i 		= 0; 
        var tabel 	='trkib_b'
        var urut 	='no_urut'
        var reg 	='no_reg'
        var kd_unit	= $('#skpd').combogrid('getValue'); 
		var brg		= document.getElementById('kdbrg').value; //$('#kdbrg').combogrid('getValue'); 
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>index.php/transaksi/mlokasi_urut',
            data: ({tabel:tabel,kd_unit:kd_unit,urut:urut,reg:reg,brg:brg}),
            dataType:"json",
            success:function(data){                                          
                $.each(data,function(i,n){                                    
                    nom      = n['urut'];                                     
                    no_reg   = n['no_reg']; 
                    $("#no_urut").attr("value",nom);
                    $("#no_reg").attr("value",no_reg);                           
                });
            }
        });         
    }
    
    function tambah_urut(angka,panjang){
        no=(angka*1)+1; 
        a=no.toString();
        jnol=panjang-a.length;
        nol='';
        for(i=1;i<=jnol;i++){
        nol=nol+'0'; 
        }
        b = nol+a; 
        return b;
    }
    
    function tombol(st){
     
        if (st=='1'){  
          if(lcstatus=='tambah'){  
            document.getElementById("p1").innerHTML="Sudah di INVENTARISASI!!";
            $('#save').linkbutton('disable');
          }else{
            document.getElementById("p1").innerHTML="Sudah di INVENTARISASI!!"; 
            $('#save').linkbutton('enable');
          }
        } else { 
          document.getElementById("p1").innerHTML="";
          $('#save').linkbutton('enable');
        }
        
   }
  
function getkey(e){
	if (window.event)
		return window.event.keyCode;
	else if (e)
		return e.which;
	else
    return null;
	}
function angkadanhuruf(e, goods, field){
	var angka, karakterangka;
	angka = getkey(e);
	if (angka == null) return true;
	karakterangka = String.fromCharCode(angka);
	karakterangka = karakterangka.toLowerCase();
	goods = goods.toLowerCase();
	// check goodkeys
	if (goods.indexOf(karakterangka) != -1)
    return true;
	// control angka
	if ( angka==null || angka==0 || angka==8 || angka==9 || angka==27 )
   return true;
	if (angka == 13) {
    var i;
    for (i = 0; i < field.form.elements.length; i++)
        if (field == field.form.elements[i])
            break;
    i = (i + 1) % field.form.elements.length;
    field.form.elements[i].focus();
    return false;
    };
	// else return false
	return false;
	} 
 
 function isNumberKey(evt)
	{
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))

	return false;
	return true;
	}
  
   </script>

<div id="content1"> 
<h3 align="center"><u><b><a>.:INPUTAN INVENTARIS PERALATAN DAN MESIN:.</a></b></u></h3>
    <div align="center">
    <p>     
    <table style="width:400px;" border="0">
        <tr>
        <td width="10%">
        <a class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="javascript:tambah()">Tambah</a></td>               
        <!--td width="10%"><a class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:hapus();">Hapus</a></td-->
        <td width="5%"><a class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="javascript:cari();">Cari</a></td>
        <td>Cari &nbsp;<input type="text" value="" id="txtcari" style="width:150px;"/></td>
        <td>Tahun:&nbsp;<input type="text" value="" id="tahun" style="width:50px;"/>&nbsp;&nbsp;OPD:&nbsp;<input type="text" value="" id="skpd2" style="width:150px;"/>&nbsp;&nbsp;Bidang:&nbsp;<input type="text" value="" id="bida2" style="width:100px;"/></td>
        </tr>
        <tr>
        <td colspan="4">
        <table id="dg" align="center" title="LISTING INVENTARIS PERALATAN DAN MESIN" style="width:900px;height:365px;" >  
        </table>
        </td>
        </tr>
    </table>    
 
    </p> 
    </div>   
</div>

<div id="dialog-modal" title="">
    <p class="validateTips">.:Inventarisasi Peralatan dan Mesin</p> 
    <fieldset>
    <p id="p1" style="font-size: x-large;color: red;"></p>
     <table align="center" style="width:100%;" border="0">
           <tr>
               <td width="50%" valign="top">
                    <table align="left" style="width:100%;" border="0">
                       <tr hidden="true">
                            <td>ID Barang</td>
                            <td>:</td>
                            <td><input type="text" id="id_barang" name="id_barang" style="width: 250px;" /><input type="text" id="nomor_bukti" name="nomor_bukti" style="width: 250px;" /><input type="text" id="cad" name="cad" style="width: 250px;" /></td>
                       </tr>
					   <tr>
                            <td width="25%">No Register</td>
                            <td width="5%">:</td>
                            <td width="70%"><input readonly="true" type="text" id="noreg" name="noreg"  readonly="true" style="width:150px;" placeholder="AutoNumber"/>
                            <input type="hidden" id="no" name="no"  readonly="true" style="width:150px;"/><input type="text" id="tanggal" style="width: 140px;" /></td>
                       </tr>
             <!-- <tr>
                            <td width="25%">No Register</td>
                            <td width="5%">:</td>
                            <td width="70%">
                            <input  id="no" name="no"   style="width:150px;"/><input type="text" id="tanggal" style="width: 140px;" /></td>
                       </tr> -->

					   <tr>
                            <td>No Dokumen</td>
                            <td>:</td>
                            <td><input id="nodok" name="nodok" style="width: 250px;" /></td>
                       </tr>
						<tr>
							<td>Golongan Barang</td>
							<td>:</td>
							<td><input id="jns_barang" name="jns_barang" disabled="true"/>  </td>                            
						</tr> 
						<tr>
							<td>Bidang Barang</td>
							<td>:</td>
							<td><input id="kd_bidang" name="kd_bidang" disabled="true"/>  </td>                            
						</tr> 
						<!-- <tr>
							<td>Sub Kelompok barang</td>
							<td>:</td>
							<td><input id="kelo1" name="kelo1" value=""/>  </td>                            
						</tr> --> 
                       <tr>
                            <td>Kode Barang </td>
                            <td>:</td>
                            <td><input id="kdbrg" name="kdbrg" style="width: 250px;" disabled="true"/>
                             <input  type="hidden" id="no_urut" name="no_urut" style="width: 50px;"/></td>
                       </tr>
                       <tr>
                         <td colspan="2">&nbsp;</td>
                         <td><span style="font-size:12px;">
                           <input name="nmbrg" type="text" id="nmbrg" style="width:300px; border:none;"  disabled="true"/>
                           <input type="hidden" id="no_reg" name="no_reg" style="width: 50px;"/>
							</span></td>
                       </tr>
                       <tr>
                            <td>Detail Barang</td>
                            <td>:</td>
                            <td><input id="detail_brg" name="detail_brg" style="width: 250px;" placeholder="*Diisi jika kib ada nama barang." /></td>
                       </tr>
                       <tr>
                            <td colspan="3" align="left"><u><b>Pengurus Barang</b></u></td>
                       </tr>
                       <tr>
                            <td>Kepemilikan</td>
                            <td>:</td>
                            <td><input id="milik" name="milik" style="width: 250px;" /></td>
                       </tr>
                       <tr>
                            <td>Wilayah</td>
                            <td>:</td>
                            <td><input id="wilayah" name="wilayah" style="width: 250px;"  /></td>
                       </tr>
                       <tr>
                            <td>OPD</td>
                            <td>:</td>
                            <td><input type="text" id="skp" name="skp" style="width:150px;"/></td>
                       </tr>
                       <tr>
                            <td>UNIT</td>
                            <td>:</td>
                            <td><input type="text" id="skpd" name="skpd" style="width:150px;"/></td>
                       </tr>
                       <tr>
                            <td colspan="2">&nbsp;<input type="text" id="kd_skpdx" style="border:none;" hidden="true"/></td>
                            <td style="font-size:12px;"><input type="text" id="nmskpd" style="width:300px; border:none;"  disabled="true"/></td>
                       </tr>
                       <tr>
                            <td colspan="3" align="left"><u><b>Asal Usul Barang</b></u></td>
                       </tr>
                       <tr>
                            <td>Cara Perolehan</td>
                            <td>:</td>
                            <td><input type="text" id="perolehan" name='perolehan' style="width:150px;"/></td>
                       </tr>
                       <tr>
                            <td>Dasar Perolehan</td>
                            <td>:</td>
                            <td><input type="text" id="dsr_peroleh" name="dsr_peroleh" style="width:150px;"/>
                            <input type="hidden" id="das" name="das" style="width:100px;  border:none;"  /></td>
                       </tr>
                       <tr>
                            <td>&ensp;&ensp;a)&nbsp;Nomor</td>
                            <td>:</td>
                            <td><input type="text" id="no_oleh" name="no_oleh" style="width:150px;" /></td>
                       </tr>
                       <tr>
                            <td>&ensp;&ensp;b)&nbsp;Tanggal</td>
                            <td>:</td>
                            <td><input type="text" id="tgl_oleh" name="tgl_oleh" style="width:150px;" /></td>
                       </tr>
                       <tr>
                            <td>Tahun Perolehan</td>
                            <td>:</td>
                            <td><input type="text" id="th_oleh" name="th_oleh" style="width:150px;"  onkeypress="return isNumberKey(event)"/></td>
                       </tr>
                       <tr>
                         <td>Harga Perolehan</td>
                         <td>:</td>
                         <td><input id="hrg_oleh" name="hrg_oleh" value="" style="text-align: right;" onkeypress="return(currencyFormat(this,',','.',event));" style="width:130px;" />
                         <input name="hrg" type="hidden" id="hrg" style="width:150px;" /></td>
                       </tr>
                       <tr>
                         <td>Harga Penilaian</td>
                         <td>:</td>
                         <td><input id="nilai_baru" name="nilai_baru" value="" style="text-align: right;" onkeypress="return(currencyFormat(this,',','.',event));"  style="width:150px;" />
                         </td>
                       </tr>
                       <tr>
                         <td>Jumlah</td>
                         <td>:</td>
                         <td><input name="jml" type="text" id="jml" disabled="true" style="width:150px;"  onkeypress="return isNumberKey(event)"/></td>
                       </tr>
                    </table> 
               </td>
               <td width="50%" valign="top">
                    <table  align="left" style="width:100%;" border="0">
                       <tr>
                            <td colspan="3" align="left"><u><b>Spesifikasi Barang</b></u></td>
                       </tr>
                       <tr>
                            <td>Merk</td>
                            <td>:</td>
                            <td><input type="text" id="merek" name="merek" style="width:100px;"/></td>
                       </tr>
                       <tr>
                            <td>type</td>
                            <td>:</td>
                            <td><input type="text" id="tipe" name="tipe" style="width:100px;"/></td>
                       </tr>
                       <tr>
                            <td>Warna </td>
                            <td>:</td>
                            <td><input type="text" id="warna" name="warna" style="width:100px;"/></td>
                       </tr>
                       <tr>
                            <td>Bahan </td>
                            <td>:</td>
                            <td><input type="text" id="bahan" name="bahan" style="width:100px;"/></td>
                       </tr>
                       <tr>
                            <td>Satuan</td>
                            <td>:</td>
                            <td><input type="text" id="satuan" name="satuan" style="width:100px;"/></td>
                       </tr>
                       <tr>
                         <td>No Rangka</td>
                         <td>:</td>
                         <td><input name="norangka" type="text" id="norangka" style="width:150px;"/></td>
                       </tr>
                       <tr>
                         <td>No Mesin </td>
                         <td>:</td>
                         <td><input name="nomesin" type="text" id="nomesin" style="width:150px;"/></td>
                       </tr>
                       <tr>
                         <td>No Polisi </td>
                         <td>:</td>
                         <td><input name="nopolisi" type="text" id="nopolisi" style="width:150px;"/></td>
                       </tr>
                       <tr>
                         <td>Ukuran/CC </td>
                         <td>:</td>
                         <td><input name="silinder" type="text" id="silinder" style="width:150px;"/></td>
                       </tr>
                       <tr>
                         <td>No STNK </td>
                         <td>:</td>
                         <td><input name="nostnk" type="text" id="nostnk" style="width:150px;"/></td>
                       </tr>
                       <tr>
                         <td>Tgl STNK </td>
                         <td>:</td>
                         <td><input name="tglstnk" type="text" id="tglstnk" style="width:150px;"/></td>
                       </tr>
                       <tr>
                         <td>No BPKB </td>
                         <td>:</td>
                         <td><input name="nobpkb" type="text" id="nobpkb" style="width:150px;"/></td>
                       </tr>
                       <tr>
                         <td>Tgl BPKB </td>
                         <td>:</td>
                         <td><input name="tglbpkb" type="text" id="tglbpkb" style="width:150px;"/></td>
                       </tr>
                       <tr>
                         <td>Kondisi </td>
                         <td>:</td>
                         <td><input name="kondisi" type="text" id="kondisi" style="width:150px;"/></td>
                       </tr>
					   <tr>
                            <td valign="top">Keterangan</td>
                            <td valign="top">:</td>
                            <td><textarea rows="2" cols="50" id="keterangan" name="keterangan" style="width: 300px;"></textarea></td>
                       </tr>
					   <tr>
                         <td>Ruangan</td>
                         <td>:</td>
                         <td><input name="kdruang" type="text" id="kdruang" style="width:150px;"/> </td>
					   </tr>
             <tr>
                            <td>Masa Manfaat</td>
                            <td>:</td>
                            <td><input type="text" id="mm" name="mm" style="width:100px;" onkeypress="return isNumberKey(event)"/></td>
                       </tr>
					   <tr hidden="true">
                            <td colspan="3" align="left"><u><b>Penyusutan Aset</b></u></td>
                       </tr>
					   <tr hidden="true">
                         <td>Metode </td>
                         <td>:</td>
                         <td><input name="metode" type="text" id="metode" style="width:150px;"/></td>
                      </tr>
					  <tr hidden="true">
                         <td>Masa Manfaat</td>
                         <td>:</td>
                         <td><input name="masa_manfaat" type="text" id="masa_manfaat" style="width:150px;" onkeypress="return isNumberKey(event)"/></td>
                      </tr>
                      <tr hidden="true">
                         <td>Nilai Sisa</td>
                         <td>:</td>
                         <td><input name="nilai_sisa" type="text" id="nilai_sisa" style="width:150px;" onkeypress="return isNumberKey(event)"/></td>
                      </tr>
					   
                    </table>
               </td>
           </tr>
           <tr>
            <td colspan="2" align="center">
              <table  align="left" style="width:100%;" border="1">
				<tr>
                <td colspan="2" align="center">
                    <table  align="left" style="width:100%;" border="1">
                       <tr>
                            <td valign="top" width="12%">Gambar</td>
                            <td valign="top" width="3%">:</td>
                            <td width="85%"><input type="text" id="gambar1" name="gambar" style="width:200px;" disabled="disabled" />
                                <img id="loading" src="<?php echo base_url();?>public/images/loading.gif" style="display:none;">
                            	<input type="file" id="fileToUpload1" name="fileToUpload"/>
                                <input type="button" id="btnupload" value="Upload" onclick="return ajaxFileUpload('1');"  /></td>
                           
                       </tr>
                       <tr>
                            <td valign="top" width="12%">&nbsp;</td>
                            <td valign="top" width="3%"></td>
                            <td width="85%"><input type="text" id="gambar2" name="gambar" style="width:200px;" disabled="disabled" />
                                <img id="loading" src="<?php echo base_url();?>public/images/loading.gif" style="display:none;">
                            	<input type="file" id="fileToUpload2" name="fileToUpload"/>
                                <input type="button" id="btnupload" value="Upload" onclick="return ajaxFileUpload('2');"  /></td>
                           
                       </tr>
                       <tr >
                            <td valign="top" width="12%">&nbsp;</td>
                            <td valign="top" width="3%"></td>
                                <td width="85%"><input type="text" id="gambar3" name="gambar" style="width:200px;" disabled="disabled" />
                                <img id="loading" src="<?php echo base_url();?>public/images/loading.gif" style="display:none;">
                            	<input type="file" id="fileToUpload3" name="fileToUpload"/>
                                <input type="button" id="btnupload" value="Upload" onclick="return ajaxFileUpload('3');"  /></td>
                           
                       </tr>
                       <tr >
                            <td valign="top" width="12%">&nbsp;</td>
                            <td valign="top" width="3%"></td>
                                <td width="85%"><input type="text" id="gambar4" name="gambar" style="width:200px;" disabled="disabled" />
                                <img id="loading" src="<?php echo base_url();?>public/images/loading.gif" style="display:none;">
                            	<input type="file" id="fileToUpload4" name="fileToUpload"/>
                                <input type="button" id="btnupload" value="Upload" onclick="return ajaxFileUpload('4');"  /></td>
                           
                       </tr>
                       <tr border="1">
							<td colspan="3" align="center" >
                             <img style="width: 100px; height:100px;" id="foto1" alt="" onclick="javascript:gambar('1');"/>
                             <img style="width: 100px; height:100px;" id="foto2" alt="" onclick="javascript:gambar('2');"/>
                             <img style="width: 100px; height:100px;" id="foto3" alt="" onclick="javascript:gambar('3');"/>
                             <img style="width: 100px; height:100px;" id="foto4" alt="" onclick="javascript:gambar('4');"/>
							</td>
                       </tr>
                    </table>
                </td>
				</tr>
				<tr>
                <td colspan="2" align="center"><a class="easyui-linkbutton" id="save" iconCls="icon-save" plain="false" onclick="javascript:simpan();">Simpan</a>                
		        <a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:keluar();">Kembali</a>
                
                </td>                    
				</tr>
			  </table> 
			</td>
           </tr> 
        </table>       
    </fieldset> 
</div> 

<div id="dialog-modal_gambar" title="">
    <p class="validateTips">GAMBAR/FOTO</p> 
     <table align="center" style="width:100%;" border="0">
        <tr>
			<td>
			 <img style="width: 400px; height:390px;" id="fotoZ" alt="some_text"/>
			</td>
		</tr>       
     </table>
           <tr>
                <td  align="center">
		        <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar1();">Kembali</a>
                </td>                
           </tr>
</div>
<div id="dialog-modal-aaa" title="MOHON TUNGGU SEBENTAR">
    <p class="validateTips"></p>  
    <fieldset>
    <table>
    <tr height="70%" >
      <td colspan="3" align="center"  > 
      <DIV id="load" > <b>Sedang Proses harap tunggu</b><IMG src="<?php echo base_url(); ?>lib/images/load.gif"  BORDER="0" ALT=""></DIV></td>
    </tr>
    </table>
    
    </fieldset>
  
</div>

<div id="dialog-riwayat" title="">
    <fieldset>
		<p id="p1" style="font-size: x-large;color: red;"></p>
     <table align="center" style="width:100%;" border="0">
               <td width="50%" valign="top">
                    <table align="left" style="width:100%;" border="0">
                       <tr hidden="true">
                            <td>ID Barang</td>
                            <td>:</td>
                            <td><input type="text" id="id_barang" name="id_barang" style="width: 250px;" /></td>
                       </tr>
					   <tr hidden="true">
                            <td>ID tahun</td>
                            <td>:</td>
                            <td><input type="text" id="tahun" name="tahun" style="width: 250px;" /></td>
                       </tr> <tr hidden="true">
                            <td>ID kd_unit</td>
                            <td>:</td>
                            <td><input type="text" id="kd_unit" name="kd_unit" style="width: 250px;" /></td>
                       </tr> <tr hidden="true">
                            <td>ID no_urut</td>
                            <td>:</td>
                            <td><input type="text" id="no_urut" name="no_urut" style="width: 250px;" /></td>
                       </tr>
					    <tr hidden="true">
                            <td>ID kd_brg</td>
                            <td>:</td>
                            <td><input readonly="true" border="0" type="text" id="kd_brg" name="kd_brg" style="width: 350px;" /><input type="text" id="kd_brg" name="kd_brg" style="width: 250px;" /></td>
                       </tr>
                       <tr>
                            <td>.:TAMBAH RIWAYAT</td>
                            <td>:</td>
                            <td><b>
							<input readonly="true" type="text" id="nm_brg" name="nm_brg" style="width:400px;  border:none;"  />
							</b></td>
                       </tr>
                       <tr disabled="true">
                            <td>OPD</td>
                            <td>:</td>
                            <td><input readonly="true" type="text" id="kd_skpd" name="kd_skpd" style="width: 100px;" />
							<input readonly="true" type="text" id="nm_skpd" name="nm_skpd" style="width: 350px;" /></td>
                       </tr>
                       <tr disabled="true">
                            <td>Nilai</td>
                            <td>:</td>
                            <td><input disabled="true" type="text" id="nilai" name="nilai" style="width: 150px;" /></td>
                       </tr>
                       <tr>
                            <td>Tanggal Riwayat</td>
                            <td>:</td>
                            <td><input type="text" id="tgl_riwayat" name="tgl_riwayat" style="width: 100px;" /></td>
                       </tr>
                       <tr>
                            <td>Riwayat</td>
                            <td>:</td>
                            <td><input type="text" id="kd_riwayat" name="kd_riwayat" style="width: 250px;" /></td>
                       </tr>
                       <tr>
                            <td>Detail Riwayat</td>
                            <td>:</td>
                            <td><textarea placeholder="*silahkan input detail riwayat barang" type="text" id="detail_riwayat" name="detail_riwayat" style="width: 500px; height:70px;"></textarea></td>
                       </tr>
                    </table> 
               </td>
		   <tr>
                <td colspan="2" align="center">
				<a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:simpan_riwayat();">Simpan</a>                
		        <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Kembali</a>
				</td>                
           </tr>
        </table>  
    </fieldset> 
</div>