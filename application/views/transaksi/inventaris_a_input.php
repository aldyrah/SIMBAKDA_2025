<script src="<?php echo base_url(); ?>lib/sweet-alert.min.js"></script>
<link   rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>lib/sweet-alert.css">
<script type="text/javascript">
    var kdkel		= '';
    var judul		= '';
    var cid 		= 0;
    var lcidx 		= 0;
    var lcstatus 	= '';
    var lcskpd 		= '';
    var lpdok 		= '';
    var no_urut		= 0;
   //this view has modify by demansyah msm biak
                    
     $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
            height: 800,
            width: 1000,
            modal: true,
            autoOpen:false,
        });
        $( "#dialog-modal_gambar" ).dialog({
            height: 600,
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
			var bts_tgl= '2014-12-31';
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
       panelWidth:500,  
       idField:'no_dokumen',  
       textField:'no_dokumen',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/transaksi/ambil_dok_a',  
       columns:[[  
           {field:'no_dokumen',title:'NOMOR DOKUMEN',width:90},
           {field:'nm_brg',title:'NAMA BARANG',width:200},  
           {field:'total',title:'NILAI KONTRAK',width:200,align:"right"}    
       ]],  
       onSelect:function(rowIndex,rowData){
			no_dokumen   = rowData.no_dokumen;
			kd_brg		   = rowData.kd_brg;
			kd_unit		   = rowData.kd_unit;
			kd_uskpd	   = rowData.kd_uskpd;
			nm_brg		   = rowData.nm_brg;
			jumlah		   = rowData.jumlah;
			harga		     = rowData.harga;
			total		     = rowData.total;
			keterangan	 = rowData.keterangan;
			s_dana		   = rowData.s_dana;
			kd_milik	   = rowData.kd_milik;
			kd_wilayah	 = rowData.kd_wilayah;
			b_dasar		   = rowData.b_dasar;
			b_nomor		   = rowData.b_nomor;
			tahun		     = rowData.tahun;
			b_tanggal	   = rowData.b_tanggal;
			kd_cr_oleh	 = rowData.kd_cr_oleh;
      kd_bidang    = rowData.kd_bidang;
      jns_barang   = rowData.jns_barang;

           get(no_dokumen,kd_brg,kd_unit,kd_uskpd,nm_brg,jumlah,harga,total,keterangan,s_dana,kd_milik,kd_wilayah,b_dasar,b_nomor,tahun,b_tanggal,kd_cr_oleh,kd_bidang,jns_barang);
        cek_status(no_dokumen);   
		   //lutji();
	   }  
     });
	 
	/*$('#bida').combogrid({  
            panelWidth:600, 
            width:160, 
			url:'<?php echo base_url(); ?>index.php/master/ambil_bidang',queryParams:({gol:'01'}),
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
    });*/
        
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
	   
	/*function lutji(){
		var doku    = $('#nodok').combogrid('getValue');
		if(doku== ''){
		 $('#kdbrg').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_brg_kib' }); 
		 }else{
		 $('#kdbrg').combogrid({url:'<?php echo base_url(); ?>index.php/transaksi/brg_tnh',queryParams:({nodok:doku}) });     
		}
	}*/
  function cek_status(no_dokumen){
    var no_dokumen    = $('#nodok').combogrid('getValue');
    var kdbrg   = $('#kdbrg').combogrid('getValue');//document.getElementById('kdbrg').value;
    $(document).ready(function(){
    $.ajax({
      type:'post',
      data:({nodok:no_dokumen,kdbrg:kdbrg}),
      url :"<?php echo base_url(); ?>/index.php/transaksi/brg_tnh_dh",
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
           textField:'kd_brg',  
           mode:'remote',        
		   loadMsg:"Sedang Mencari Barang....",               
		   url:'<?php echo base_url(); ?>index.php/master/ambil_brg_kib', 
           columns:[[
               {field:'kd_brg',title:'Kode Barang',width:90},  
               {field:'nm_brg',title:'Nama Barang',width:380}               
           ]],  
           onSelect:function(rowIndex,rowData){
               idxGiat 	= rowIndex;               
               brg 		= rowData.kd_brg;
               no_urut	= rowData.no_urut;
               invent	= rowData.invent;
               $("#nmbrg").attr("value",rowData.nm_brg);
              // $("#hrg_oleh").attr("value",number_format(rowData.harga));
               $("#hrg").attr("value",rowData.harga);
               $("#jml").attr("value",rowData.jml);
                tombol(invent);                                                                  
           }  
        });*/   
     
     $('#kdtnh').combogrid({  
       panelWidth:500,  
       idField:'kd_brg',  
       textField:'kd_brg',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/transaksi/mtanah',  
       columns:[[  
           {field:'kd_brg',title:'Kode Tanah',width:100},  
           {field:'nm_brg',title:'Nama Tanah',width:400}    
       ]],  
       onSelect:function(rowIndex,rowData){
           kd_tanah = rowData.kd_brg;
           $("#nmtanah").attr("value",rowData.nm_brg); 
          // }                 
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
     
	$('#skp').combogrid({  
           panelWidth:500,  
           idField:'kd_skpd',  
           textField:'kd_skpd',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/master/ambil_skpd_dh',  
           columns:[[  
               {field:'kd_skpd',title:'KODE SKPD',width:100},  
               {field:'nm_skpd',title:'NAMA SKPD',width:400}    
           ]],  
           onSelect:function(rowIndex,rowData){
               lcskpdx 	= rowData.kd_lokasi; 
               lcskpd 	= rowData.kd_skpd; 
               $('#skpd').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_ubidskpdh',queryParams:({kduskpd:lcskpdx,skpd:lcskpd}) });
               $("#nmskp").attr("value",rowData.nm_skpd.toUpperCase());
                                
           }  
         });
	 
     $('#skpd').combogrid({  
       panelWidth:500,  
       idField:'kd_uskpd',  
       textField:'kd_uskpd',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_ubidskpd',
       queryParams:({tabel:'trkib_a'}),  
       columns:[[  
           {field:'kd_uskpd',title:'KODE SKPD',width:100},  
           {field:'nm_uskpd',title:'NAMA SKPD',width:390}    
       ]],  
       onSelect:function(rowIndex,rowData){
           lcskpd = rowData.kd_uskpd; 
           lcskpdx = rowData.kd_skpd;
           $("#kd_skpdx").attr("value",lcskpdx);
           $("#nmskpd").attr("value",rowData.nm_uskpd.toUpperCase()); 
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
           {field:'nm_uker',title:'NAMA UNIT KERJA',width:400}    
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
       panelWidth:150,  
       idField:'dasar_perolehan',  
       textField:'dasar_perolehan',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/dasar_perolehan',
       loadMsg:"Tunggu Sebentar....!!",  
       columns:[[  
           {field:'kode',title:'Kode',width:50},
           {field:'dasar_perolehan',title:'Dasar Perolehan',width:95}
       ]],
        onSelect:function(rowIndex,rowData){
           lckd = rowData.kode;
           $("#das").attr("value",rowData.dasar_perolehan.toUpperCase());
                         
       }  
     });
     
     $('#jns_dana').combogrid({  
       panelWidth:100,  
       idField:'kode',  
       textField:'kode',  
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
       panelWidth:150,  
       idField:'kode',  
       textField:'kode',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/mbukti',
       loadMsg:"Tunggu Sebentar....!!",  
       columns:[[  
           {field:'kode',title:'Kode',width:40},
           {field:'Bukti',title:'Bukti Pembayaran',width:110}
       ]],
        onSelect:function(rowIndex,rowData){
           lcbukti = rowData.kode;
           $("#buk").attr("value",rowData.Bukti.toUpperCase());
                         
       }  
     });
     
     $('#kondisi').combogrid({  
       panelWidth:150,  
       idField:'kode',  
       textField:'kode',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/mkondisi',
       loadMsg:"Tunggu Sebentar....!!",  
       columns:[[  
           {field:'kode',title:'Kode',width:40},
           {field:'kondisi',title:'Kondisi',width:110}
       ]],
        onSelect:function(rowIndex,rowData){
           lckondisi = rowData.kode;
           $("#kon").attr("value",rowData.kondisi.toUpperCase());
                         
       }  
     });
     
      $('#lokasi').combogrid({  
       panelWidth:450,  
       idField:'kd_lokasi',  
       textField:'nm_lokasi',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_lokasi',  
       columns:[[  
           {field:'kd_lokasi',title:'KODE LOKASI',width:100},  
           {field:'nm_lokasi',title:'LOKASI',width:350}    
       ]] 
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
        
     $('#kondisi_tnh').combogrid({  
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

  $('#bida').combogrid({  
            panelWidth:550, 
            idField:'bidang',  
            textField:'bidang',              
            mode:'remote',            
            loadMsg:"Tunggu Sebentar....!!",
            url:'<?php echo base_url(); ?>index.php/master/ambil_bidang',
            queryParams:({gol:'01'}),                                                 
            columns:[[  
               
               {field:'bidang',title:'Kode Barang',width:100},  
               {field:'nm_bidang',title:'Nama Barang',width:500}
            ]],  
             onSelect:function(rowIndex,rowData){
                bidang=rowData.bidang;
                nmbidang=rowData.nm_bidang;
                 
                //$('#bidang').attr('value',bidang);
                $('#nmbidang').attr('value',nmbidang);

                $('#kdbrg').combogrid("clear");
                $('#nmkelompok').attr('value',''); 
                $('#kdbrg').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_brg_dh',
                queryParams:({bidang:bidang})});            
        }  
    });

  $('#kdbrg').combogrid({
        panelWidth:550, 
            idField:'kd_brg',  
            textField:'kd_brg',              
            mode:'remote',            
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kd_brg',title:'KODE BARANG',width:100}, 
               {field:'nm_brg',title:'NAMA BARANG',width:450}  
            ]],  
             onSelect:function(rowIndex,rowData){
                
                ckd_kelompok   = rowData.kd_brg;                                                        
                cnmkelompok   = rowData.nm_brg;
                $('#nmbrg').attr('value',cnmkelompok);
                $('#detail_brg').attr('value',cnmkelompok);
            }
        });
	 	
     $('#dg').edatagrid({
		url: '<?php echo base_url();?>index.php/transaksi/ambil_kib_a',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Sedang mengambil Barang...!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'kd_brg',title:'KD BARANG',width:30,align:"left"},
            {field:'nm_brg',title:'NAMA BARANG',width:50,align:"left"},
            {field:'no_reg',title:'NO REG',width:20,align:"center"},
            {field:'alamat1',title:'ALAMAT',width:50,align:"left"},
            {field:'tahun',title:'TAHUN',width:15,align:"center"},
            {field:'nilai',title:'HARGA',width:30,align:"right"},
            {field:'keterangan',title:'KETERANGAN',width:80,align:"left"},
            {field:'id_barang',title:'id_barang',width:35,align:"left",hidden:true},
			      {field:'history',title:'HIS',width:10,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/document.png' onclick='javascript:riwayat();'' />";}},
			      {field:'del',title:'DEL',width:10,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus();'' />";}},

        ]],
        onSelect:function(rowIndex,rowData){
          lcidx 			= rowIndex;
          noreg 			= rowData.no_reg;
          no 				  = rowData.no;
          nodok 			= rowData.no_dokumen;
          kdbrg 			= rowData.kd_brg;
          nm_brg 			= rowData.nm_brg;
          kd_skpd 		= rowData.kd_skpd;
          kd_unit 		= rowData.kd_unit;
          id_barang		= rowData.id_barang;
          no_furut		= rowData.no_urut;
          nilai				= rowData.nilai;
          tahun				= rowData.tahun;
          tgl_riwayat	= rowData.tgl_riwayat;
          kd_riwayat	= rowData.kd_riwayat;
          detail_riwayat	= rowData.detail_riwayat;
          nm_skpd     = rowData.nm_skpd;
		      get_riwayat(kd_skpd,kd_unit,kdbrg,nm_brg,id_barang,nilai,tahun,no_furut,tgl_riwayat,kd_riwayat,detail_riwayat,nm_skpd);
        },
        onDblClickRow:function(rowIndex,rowData){
          lcidx 		= rowIndex;
          judul 		= 'Edit Data Lokasi'; 
          lcstatus 	= 'edit';
          id_barang	= rowData.id_barang;
          noreg 		= rowData.no_reg;
          no 			  = rowData.no;
          tgl_reg 	= rowData.tgl_reg;
		      no_oleh		= rowData.no_oleh;
		      tgl_oleh	= rowData.tgl_oleh;
          nodok 		= rowData.no_dokumen;
          kdbrg  		= rowData.kd_brg;
          nmbrg     = rowData.nm_brg;
          detail_brg= rowData.detail_brg;
          sta_thn		= rowData.status_tanah;
          kondisi		= rowData.kondisi;
          ls			  = rowData.luas;
          lokasi		= rowData.kd_lokasi;
          penggunaan= rowData.penggunaan;
          sk			  = rowData.no_sertifikat;
          tgl_sk		= rowData.tgl_sertifikat;
          ket			  = rowData.keterangan;
          alamat1		= rowData.alamat1;
          alamat2		= rowData.alamat2;
          alamat3		= rowData.alamat3;
          lat 			= rowData.lat;
          lon 			= rowData.lon;
          milik			= rowData.milik;
          wilayah		= rowData.wilayah;
          kd_skpd		= rowData.kd_skpd;
          kd_unit		= rowData.kd_unit;
          asal			= rowData.asal;
          dsr_peroleh	= rowData.dsr_peroleh;
          nilai			= rowData.nilai;
          nilai_baru= rowData.total;
          tahun			= rowData.tahun;
          no_furut	= rowData.no_urut;
          gol     = rowData.kd_golongan;
          bida    = rowData.kd_bidang;
          foto1			= rowData.foto1;
          cokot(foto1,'1');
          foto2			= rowData.foto2;
          cokot(foto2,'2');
          foto3			= rowData.foto3;
          cokot(foto3,'3');
          foto4			= rowData.foto4;
          cokot(foto4,'4');
          
          get1(id_barang,noreg,no,tgl_reg,no_oleh,tgl_oleh,milik,wilayah,kd_skpd,kd_unit,asal,dsr_peroleh,nilai,nilai_baru,tahun,nodok,kdbrg,nmbrg,detail_brg,sta_thn,kondisi,ls,penggunaan,sk,tgl_sk,ket,alamat1,alamat2,alamat3,lokasi,lat,lon,gol,bida,foto1,foto2,foto3,foto4);
          edit_data(); 
          cek_status();  
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
		$("#loading").show();
		
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
							//alert(data.msg);
						}
					}
				},
				error: function (data, status, e)
				{
					alert(e);
				}
			}
		)
		return false;
	}
      
    function get(no_dokumen,kd_brg,kd_unit,kd_uskpd,nm_brg,jumlah,harga,total,keterangan,s_dana,kd_milik,kd_wilayah,b_dasar,b_nomor,tahun,b_tanggal,kd_cr_oleh,kd_bidang,jns_barang){
           $("#nodok").attr("value",no_dokumen);
           $("#kdbrg").combogrid("setValue",kd_brg);
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
           $("#hrg_oleh").attr("value",number_format(harga));
           $("#jml").attr("value",jumlah);
           $("#jns_dana").combogrid("setValue",s_dana);
           $("#keterangan").attr("value",keterangan);
           $("#bida").combogrid("setValue",kd_bidang);
           $('#gol').attr('value',jns_barang);
           //cek_status(); 
    }
    
    function get1(id_barang,noreg,no,tgl_reg,no_oleh,tgl_oleh,milik,wilayah,kd_skpd,kd_unit,asal,dsr_peroleh,nilai,nilai_baru,tahun,nodok,kdbrg,nmbrg,detail_brg,sta_thn,kondisi,ls,penggunaan,sk,tgl_sk,ket,alamat1,alamat2,alamat3,lokasi,lat,lon,gol,bida,foto1,foto2,foto3,foto4){ //get1(id_barang,noreg,no,tgl_reg,no_oleh,tgl_oleh,milik,wilayah,kd_skpd,kd_unit,asal,dsr_peroleh,nilai,nilai_baru,tahun,nodok,kdbrg,detail_brg,sta_thn,kondisi,ls,penggunaan,sk,tgl_sk,ket,alamat1,alamat2,alamat3,lokasi,foto,gol,bida){
		       $("#id_barang").attr("value",id_barang);
		       $("#noreg").attr("value",noreg);
           $("#no").attr("value",no);
           $("#tanggal").datebox("setValue",tgl_reg);
           $("#no_oleh").attr("value",no_oleh);
           $("#tgl_oleh").datebox("setValue",tgl_oleh);
           $("#milik").combogrid("setValue",milik);
           $("#wilayah").combogrid("setValue",wilayah);
           $("#skp").combogrid("setValue",kd_skpd);
           $("#skpd").combogrid("setValue",kd_unit);
           $("#perolehan").combogrid("setValue",asal);
           $('#dsr_peroleh').combogrid("setValue",dsr_peroleh);
           $('#nmbrg').attr('value',nmbrg);
           $("#hrg_oleh").attr("value",number_format(nilai));
           $("#th_oleh").attr("value",tahun);
           $("#nodok").combogrid("setValue",nodok);
           $("#kdbrg").combogrid("setValue",kdbrg);
           $("#detail_brg").attr("value",detail_brg);
           $('#st_tanah').combogrid("setValue",sta_thn);
           $('#kondisi_tnh').combogrid("setValue",kondisi);
           $("#luas").attr("value",ls);
           $("#guna").attr("value",penggunaan);
           $("#no_sk").attr("value",sk);
           $("#tgl_sk").datebox("setValue",tgl_sk);
           $("#lokasi").combogrid("setValue",lokasi);
           $("#keterangan").attr("value",ket);
           $("#lat").attr("value",lat);
           $("#lon").attr("value",lon);
           $("#nilai_baru").attr("value",number_format(nilai_baru));
           $("#alamat1").attr("value",alamat1);
           $("#alamat2").attr("value",alamat2);
           $("#alamat3").attr("value",alamat3);
           $('#gol').attr('value',gol);
           $('#bida').combogrid("setValue",bida);
           $("#gambar1").attr("value",foto1);
           $("#gambar2").attr("value",foto2);
           $("#gambar3").attr("value",foto3);
           $("#gambar4").attr("value",foto4);
           
		   if(tgl_reg<='2014-12-31'){
			document.getElementById("hrg_oleh").disabled=false;
		   }else{
			document.getElementById("hrg_oleh").disabled=false;
			}
    }
	
	function get_riwayat(kd_skpd,kd_unit,kdbrg,nm_brg,id_barang,nilai,tahun,no_furut,tgl_riwayat,kd_riwayat,detail_riwayat,nm_skpd){
		   $("#kd_brg").attr("value",kdbrg);
		   $("#nm_brg").attr("value",nm_brg);
       $("#kd_skpd").attr("value",kd_skpd);
       $("#nm_skpd").attr("value",nm_skpd);
       $("#kd_unit").attr("value",kd_unit);
       $("#no_urut").attr("value",no_furut);
       $("#id_barang").attr("value",id_barang);
       $("#nilai").attr("value",number_format(nilai));
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
  	   $("#no").attr("value",'');
  	   $("#tgl_oleh").datebox("setValue",'');
  	   $("#milik").combogrid("setValue",'');
  	   $("#wilayah").combogrid("setValue",'');
  	   $("#skpd").combogrid("setValue",skpd);
  	   $("#perolehan").combogrid("setValue",'');
  	   $('#dsr_peroleh').combogrid("setValue",'');
  	   $("#hrg_oleh").attr("value",'');
  	   $("#nilai_baru").attr("value",'');
  	   $("#nodok").combogrid('clear');
       $("#nodok").combogrid('grid').datagrid('reload');
  	   $("#kdbrg").combogrid("clear");
  	   $("#detail_brg").attr("value",'');
  	   $("#nmbrg").attr("value",'');
  	   $('#st_tanah').combogrid("setValue",'');
  	   $('#kondisi_tnh').combogrid("setValue",'');
  	   $("#luas").attr("value",'');
  	   $("#guna").attr("value",'');
  	   $("#no_sk").attr("value",'');
  	   $("#tgl_sk").datebox("setValue",'');
  	   $("#lokasi").combogrid("setValue",'');
  	   $("#keterangan").attr("value",'');
  	   $("#th_oleh").attr("value",thn);
  	   $("#no_oleh").attr("value",'');
  	   $("#lat").attr("value",'');
  	   $("#lon").attr("value",'');
  	   $("#alamat1").attr("value",'');
  	   $("#alamat2").attr("value",'');
  	   $("#alamat3").attr("value",'');
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
       $('#gol').attr("value",'01');
       $('#bida').combogrid("clear");
       $('#save').linkbutton('enable');
       $('#nodok').combogrid('disable');
       $("#nodok").combogrid('grid').datagrid('reload');
       $("#kd_skpd").attr("value",'');
       $("#nmskpd").attr("value",'');
       $("#skp").combogrid("clear");
        $("#skpd").combogrid("clear");
        $("#skp").combogrid("enable");
        $("#skpd").combogrid("enable");
    }
    
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    $(function(){
     $('#dg').edatagrid({
		    url: '<?php echo base_url();?>index.php/transaksi/ambil_kib_a',
        queryParams:({cari:kriteria})
        });        
     });
    }
    
    function gambar(lf){
        lcfoto = 'foto'+lf;
        document.getElementById("fotoZ").src =  document.getElementById(lcfoto).src;
        $("#dialog-modal_gambar").dialog('open');             
    }
    
    function simpan(){
        var id_barang 		= document.getElementById('id_barang').value;
		    var no_dokumen 		= $('#nodok').combogrid('getValue');
        var kd_brg 			= $('#kdbrg').combogrid('getValue');
        var nm_barang   = document.getElementById('nmbrg').value;
        var detail 			= document.getElementById('detail_brg').value;
		    var milik			  = $('#milik').combogrid('getValue');
		    var wilayah			= $('#wilayah').combogrid('getValue');
        var kd_skpd 		= $('#skp').combogrid('getValue');
        var kd_unit 		= $('#skpd').combogrid('getValue');
        var perolehan 	= $('#perolehan').combogrid('getValue');
		    var dsr_peroleh	= $('#dsr_peroleh').combogrid('getValue');
        var no_dok 			= document.getElementById('no_oleh').value;
        var tgl_oleh 		= $('#tgl_oleh').datebox('getValue');
        var tahun 			= document.getElementById('th_oleh').value;
        var nilai 			= angka(document.getElementById('hrg_oleh').value);
        var nilai_baru	= angka(document.getElementById('nilai_baru').value);
        var st_tanah 		= $('#st_tanah').combogrid('getValue');
        var kondisi 		= $('#kondisi_tnh').combogrid('getValue');
        var no_sertifikat 	= document.getElementById('no_sk').value;
        var tgl_sertifikat 	= $('#tgl_sk').datebox('getValue');
        var luas 			= document.getElementById('luas').value;
        var penguna 		= document.getElementById('guna').value;
        var alamat1 		= document.getElementById('alamat1').value;
        var alamat2 		= document.getElementById('alamat2').value;
        var alamat3 		= document.getElementById('alamat3').value;
        var clat 			= document.getElementById('lat').value;
        var clon 			= document.getElementById('lon').value;
        var keterangan 		= document.getElementById('keterangan').value;
        var file_gbr1 		= document.getElementById('gambar1').value;
        var file_gbr2 		= document.getElementById('gambar2').value;
        var file_gbr3 		= document.getElementById('gambar3').value;
        var file_gbr4 		= document.getElementById('gambar4').value;
		    var no_urut 		= document.getElementById('no_reg').value;
		    var urutan	 		= document.getElementById('no_urut').value;
        var tgl_reg 		= $('#tanggal').datebox('getValue');
        var username    = '<?php echo ($this->session->userdata('nmuser')); ?>';
		    var tgl_update		= '<?php echo date('y-m-d H:i:s'); ?>';
        var kd_gol      = document.getElementById('gol').value;
        var kd_bidang   = $('#bida').combogrid('getValue');//document.getElementById('bida').value;
        var jml 			= 1;
		
        lcinsert = "(no_reg,id_barang,no,no_oleh,tgl_reg,tgl_oleh,no_dokumen,kd_golongan,kd_bidang,kd_brg,nm_brg,detail_brg,status_tanah,kondisi,asal,dsr_peroleh,no_sertifikat,tgl_sertifikat,luas,nilai,jumlah,total,penggunaan,alamat1,alamat2,alamat3,keterangan,milik,wilayah,kd_skpd,kd_unit,username,tgl_update,tahun,foto1,foto2,foto3,foto4,no_urut,lat,lon)";
             
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
        }  if (kd_skpd==''){
            alert('Kode SKPD Tidak Boleh Kosong.!');
            exit();
        }if (kd_unit==''){
            alert('Kode Unit SKPD Tidak Boleh Kosong.!');
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
        $("#dialog-modal-aaa").dialog('open');
        if(lcstatus=='tambah'){ 
        lcvalues = '';
        for(var i=0;i<jml;i++){
			      creg   = i+1;
            no_urt = tambah_urut(no_urut,7); 
			      nomor  = no_urt; urutan = no_urt;
            no_gabung = kd_brg+'/'+no_urt+'/'+kd_unit ;
            id_barang = kd_unit+'.'+tahun+'.'+kd_brg+'.'+no_urt+'.'+urutan ;
            if(i>0){
				lcvalues = lcvalues+",('"+nomor+"','"+id_barang+"','"+no_gabung+"','"+no_dok+"','"+tgl_reg+"','"+tgl_oleh+"','"+no_dokumen+"','"+kd_gol+"','"+kd_bidang+"','"+kd_brg+"','"+nm_barang+"','"+detail+"','"+st_tanah+"','"+kondisi+"','"+perolehan+"','"+dsr_peroleh+"','"+no_sertifikat+"','"+tgl_sertifikat+"','"+luas+"','"+nilai+"','"+jml+"','"+nilai_baru+"','"+penguna+"','"+alamat1+"','"+alamat2+"','"+alamat3+"','"+keterangan+"','"+milik+"','"+wilayah+"','"+kd_skpd+"','"+kd_unit+"','"+username+"','"+tgl_update+"','"+tahun+"','"+file_gbr1+"','"+file_gbr2+"','"+file_gbr3+"','"+file_gbr4+"','"+urutan+"','"+clat+"','"+clon+"')";
			}else{
				lcvalues = lcvalues+"('"+nomor+"','"+id_barang+"','"+no_gabung+"','"+no_dok+"','"+tgl_reg+"','"+tgl_oleh+"','"+no_dokumen+"','"+kd_gol+"','"+kd_bidang+"','"+kd_brg+"','"+nm_barang+"','"+detail+"','"+st_tanah+"','"+kondisi+"','"+perolehan+"','"+dsr_peroleh+"','"+no_sertifikat+"','"+tgl_sertifikat+"','"+luas+"','"+nilai+"','"+jml+"','"+nilai_baru+"','"+penguna+"','"+alamat1+"','"+alamat2+"','"+alamat3+"','"+keterangan+"','"+milik+"','"+wilayah+"','"+kd_skpd+"','"+kd_unit+"','"+username+"','"+tgl_update+"','"+tahun+"','"+file_gbr1+"','"+file_gbr2+"','"+file_gbr3+"','"+file_gbr4+"','"+urutan+"','"+clat+"','"+clon+"')";
			}                 
		} 
            $(document).ready(function(){
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>index.php/transaksi/simpan_trkib_a',
                    data: ({tabel:'trkib_a',urut:urutan,reg:no_urt,unit:kd_unit,no:no_dokumen,lkd_brg:kd_brg,kolom:lcinsert,lcvalues:lcvalues}),
                    dataType:"json",
                    success:function(data){                                          
                        $.each(data,function(i,n){                                    
                            pesan = n['pesan'];
                            if(pesan==1){
                              $("#dialog-modal-aaa").dialog('close');
                              swal({
                              title: "Berhasil",
                              text: "Data telah disimpan.!!",
                              imageUrl:"<?php echo base_url();?>/lib/images/biak.jpg"
                              });
                              $("#dialog-modal").dialog('close');
                              $('#dg').edatagrid('reload');
                            }else{
                              $("#dialog-modal-aaa").dialog('close');
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
        } else {
            lcquery ="update trkib_a set no_oleh='"+no_dok+"',tgl_reg='"+tgl_reg+"',tgl_oleh='"+tgl_oleh+"',no_dokumen='"+no_dokumen+"',kd_golongan='"+kd_gol+"',kd_bidang='"+kd_bidang+"',kd_brg='"+kd_brg+"',nm_brg='"+nm_barang+"',detail_brg='"+detail+"',status_tanah='"+st_tanah+"',kondisi='"+kondisi+"',asal='"+perolehan+"',dsr_peroleh='"+dsr_peroleh+"',no_sertifikat='"+no_sertifikat+"',tgl_sertifikat='"+tgl_sertifikat+"',luas='"+luas+"',nilai='"+nilai+"',penggunaan='"+penguna+"',total='"+nilai_baru+"',alamat1='"+alamat1+"',alamat2='"+alamat2+"',alamat3='"+alamat3+"',keterangan='"+keterangan+"',milik='"+milik+"',wilayah='"+wilayah+"',kd_skpd='"+kd_skpd+"',kd_unit='"+kd_unit+"',username='"+username+"',tgl_update='<?php echo date('y-m-d H:i:s'); ?>',tahun='"+tahun+"',foto1='"+file_gbr1+"',foto2='"+file_gbr2+"',foto3='"+file_gbr3+"',foto4='"+file_gbr4+"',lat='"+clat+"',lon='"+clon+"' where id_barang ='"+id_barang+"'";
            
            $(document).ready(function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>index.php/transaksi/update_trkib_a',
                data: ({st_query:lcquery}),
                dataType:"json",
                    success:function(data){                                          
                        $.each(data,function(i,n){                                    
                            pesan = n['pesan'];
                            if(pesan==1){
                              $("#dialog-modal-aaa").dialog('close');
                              swal({
                              title: "Berhasil",
                              text: "Data telah di-Update!!",
                              imageUrl:"<?php echo base_url();?>/lib/images/biak.jpg"
                              });
                              $("#dialog-modal").dialog('close');
                              $('#dg').edatagrid('reload');
                            }else{
                              $("#dialog-modal-aaa").dialog('close');
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
                    url: '<?php echo base_url(); ?>index.php/transaksi/simpan_trkib_a',
                    data: ({tabel:'trkib_a',no:id_barang,kolom:lcinsert,lcvalues:lcvalues}),
                    dataType:"json"
                });
            });    
        } else {
            lcquery = "update trkib_a set kd_riwayat='"+kd_riwayat+"',tgl_riwayat='"+tgl_riwayat+"',detail_riwayat='"+detail_riwayat+"' where id_barang ='"+id_barang+"' and tahun ='"+tahun+"' and no_urut ='"+no_urut+"' and kd_unit ='"+kd_unit+"' and kd_brg ='"+kd_brg+"'";
			$(document).ready(function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>index.php/transaksi/update_trkib_a',
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
        $("#dialog-modal").dialog('close');
        $('#dg').edatagrid('reload');       
    } 
      function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data Kib A';
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
        judul = 'Input Data Kib A';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
        $("#dialog-modal").dialog('open');
        
        } 
		
     function keluar(){
        $("#dialog-modal").dialog('close');
        $("#dialog-modal_gambar").dialog('close');
        $("#dialog-riwayat").dialog('close');
        $('#dg').edatagrid('unselectAll');
        $('#dg').edatagrid('reload');
        kosong();
     }
 
	  function riwayat(){
        $("#dialog-riwayat").dialog('open');
     } 
     
    //has modify by demansyah
     function hapus(){
      var rows = $('#dg').datagrid('getSelected');
      id_brg = rows.id_barang;
    var del = confirm("Apakah Anda Yakin ingin menghapus data   "+id_brg+"?");
		if (del==true){
        var urll = '<?php echo base_url(); ?>index.php/transaksi/hapus_trkib_a';
        $(document).ready(function(){
         $.post(urll,({no:id_barang,dok:nodok,no_urut:no_furut}),function(data){
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
        var tabel 	='trkib_a'
        var urut 	='no_urut'
        var reg 	='no_reg'
        var kd_unit	= $('#skpd').combogrid('getValue'); 
		    var brg		= $('#kdbrg').combogrid('getValue'); 
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
    
    function upload(){     
        var urll = '<?php echo base_url(); ?>index.php/upload/do_upload';
        $(document).ready(function(){
         $.post(urll,function(data){
            status = data;            
         });
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
        b= nol+a;
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
<div><h3 align="center"><b>.:INPUTAN INVENTARIS TANAH:.</b></h3></div>
    <div align="center">
    <p>     
    <table style="width:400px;" border="0">
        <tr>
        <td width="10%">
        <a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:kosong();tambah();">Tambah</a></td>               
        <!--td width="10%"><a class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:hapus();">Hapus</a></td-->
        <td width="5%"><a class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="javascript:cari();">Cari</a></td>
        <td><input type="text" value="" id="txtcari" style="width:300px;"/></td>
        </tr>
        <tr>
        <td colspan="4">
        <table id="dg" align="center" title="LISTING INVENTARIS TANAH" style="width:900px;height:365px;">  
        </table>
        </td>
        </tr>
    </table>    
 
    </p> 
    </div>   
</div>

<div id="dialog-modal" title="">
    <p class="validateTips">.:Inventarisasi Tanah</p>
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
					   <tr>
                            <td width="25%">No Register</td>
                            <td width="5%">:</td>
                            <td width="70%"><input readonly="true" type="text" id="noreg" name="noreg"  readonly="true" style="width:150px;"  placeholder="AutoNumber"/>
                            <input type="hidden" id="no" name="no"  readonly="true" style="width:150px;"/><input type="text" id="tanggal" style="width: 140px;" /></td>
                       </tr>
                       <tr>
                            <td>No Dokumen</td>
                            <td>:</td>
                            <td><input type="text" id="nodok" name="nodok" style="width: 250px;" /></td>
                       </tr>
						<tr>
							<td>Golongan Barang</td>
							<td>:</td>
							<td><input id="gol" name="gol" type="text" disabled="true"/>  </td>                            
						</tr> 
						<!-- <tr>
							<td>Kelompok barang</td>
							<td>:</td>
							<td><input id="kelo" name="kelo" value=""/>  </td>                            
						</tr>  -->
						<tr>
							<td>Bidang Barang</td>
							<td>:</td>
							<td><input id="bida" name="bida" type="text" />  </td>                            
						</tr> 
                       <tr>
                            <td>Kode Barang </td>
                            <td>:</td>
                            <td><input id="kdbrg" name="kdbrg" style="width: 250px;"  />
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
                            <td><input type="text" id="wilayah" name="wilayah" style="width: 250px;"  /></td>
                       </tr>
                       <tr>
                            <td>SKPD</td>
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
                            <td style="font-size:12px;"><input type="text" id="nmskpd" style="width:300px; border:none;" disabled="true"/></td>
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
                            <input type="text" hidden="true" id="das" name="das" style="width:100px;  border:none;"  /></td>
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
                         <td><input id="hrg_oleh" name="hrg_oleh" onkeypress="return(currencyFormat(this,',','.',event));"  style="text-align: right;"  style="width:150px;" />
                         <input name="hrg" type="hidden" id="hrg" style="width:150px;" readonly="true"/></td>
                       </tr>
                       <tr>
                         <td>Harga Penilaian</td>
                         <td>:</td>
                         <td><input id="nilai_baru" name="nilai_baru" disabled="true" value="" style="text-align: right;" onkeypress="return(currencyFormat(this,',','.',event));"  style="width:150px;" />
                         </td>
                       </tr>
                       <tr hidden="true">
                         <td>Jumlah</td>
                         <td>:</td>
                         <td><input name="jml" type="text" id="jml" style="width:150px;" readonly="true"/></td>
                       </tr>
                    </table> 
               </td>
               <td width="50%" valign="top">
                    <table  align="left" style="width:100%;" border="0">
                       <tr hidden="true">
                            <td colspan="3" align="left"><u><b>Sumber Pembiayaan</b></u></td>
                       </tr>
                       <tr hidden="true">
                            <td width="30%">Jenis Dana</td>
                            <td width="5%">:</td>
                            <td width="65%"><input type="text" id="jns_dana" name="jns_dana" style="width:50px;"/>
                            <input type="text" id="sum" name="sum" style="width:100px;  border:none;" readonly="true" /></td>
                       </tr>
                       <tr hidden="true">
                            <td>Tahun Anggaran</td>
                            <td>:</td>
                            <td><input type="text" id="thn_anggar" name="thn_anggar" style="width:150px;" readonly="true"/></td>
                       </tr>
                       <tr hidden="true">
                            <td>Bukti Pembayaran</td>
                            <td>:</td>
                            <td><input type="text" id="bkt_bayar" name="bkt_bayar" style="width:50px;"/>
                            <input type="text" id="buk" name="buk" style="width:100px;  border:none;" readonly="true" /></td>
                       </tr>
                       <tr>
                            <td colspan="3" align="left"><u><b>Spesifikasi Barang</b></u></td>
                       </tr>
                       <tr hidden="true">
                            <td>Lokasi</td>
                            <td>:</td>
                            <td><input type="text" id="lokasi" name="lokasi" style="width:200px;"/>
                            </td>
                       </tr>
                       <tr>
                            <td>Status Tanah</td>
                            <td>:</td>
                            <td><input type="text" id="st_tanah" name="st_tanah" style="width:200px;"/>
                            <input hidden="true" type="text" id="sta" name="sta" style="width:200px;  border:none;"  /></td>
                       </tr>
                       <tr>
                            <td>Kondisi</td>
                            <td>:</td>
                            <td><input type="text" id="kondisi_tnh" name="kondisi_tnh" style="width:200px;"/>
                            </td>
                       </tr>
                       <tr>
                         <td>Nomor Sertifikat </td>
                         <td>&nbsp;</td>
                         <td><input name="no_sk" type="text" id="no_sk" style="width:150px;"/></td>
                       </tr>
                       <tr>
                         <td>Tgl Sertifikat </td>
                         <td>&nbsp;</td>
                         <td><input name="tgl_sk" type="text" id="tgl_sk" style="width:150px;"/></td>
                       </tr>
                       <tr>
                            <td>Luas Tanah </td>
                            <td>:</td>
                            <td><input type="text" id="luas" style="width:100px;" onkeypress="return isNumberKey(event)"/> M2</td>
                       </tr>
                       <tr>
                         <td>Penggunaan</td>
                         <td>&nbsp;</td>
                         <td><input name="guna" type="text" id="guna" style="width:150px;"/></td>
                       </tr>
                      
                       <tr>
                            <td rowspan="3" valign="top">Letak/Alamat</td>
                            <td>:</td>
							<td><input type="text" id="alamat1" style="width:300px;" onkeypress="javascript:enter(event.keyCode,'alamat2');" /></td>
					  </tr>
                       <tr>
                            <td></td>
                            <td><input type="text" id="alamat2" style="width:300px;" onkeypress="javascript:enter(event.keyCode,'alamat3');" /></td>
                       </tr>
                       <tr>
                            <td></td>
                            <td><input type="text" id="alamat3" style="width:300px;" /></td>
                       </tr>
                       <tr>
                            <td valign="top" width="12%">Apload Scan Sertifikat</td>
                            <td valign="top" width="3%">:</td>
							<td width="85%"><input type="text" id="gambar4" name="gambar" style="width:200px;" disabled="disabled" />
                                <img id="loading" src="<?php echo base_url();?>public/images/loading.gif" style="display:none;">
                            	<input type="file" id="fileToUpload4" name="fileToUpload"/>
                                <input type="button" id="btnupload" value="Upload" onclick="return ajaxFileUpload('4');"/>
								<input type="button" id="btnupload" value="Lihat" onclick="javascript:gambar('4');"/></td>
                       </tr>
                       <tr>
                            <td>Latitude</td>
                            <td>:</td>
                            <td><input type="lat" id="lat" style="width:100px;" placeholder="exp:-11.1111"/></td>
                       </tr>
                       <tr>
                            <td>Longtitude</td>
                            <td>:</td>
                            <td><input type="lon" id="lon" style="width:100px;" placeholder="exp:11.1111"/></td>
                       </tr>
                       <tr>
                            <td valign="top">Keterangan</td>
                            <td valign="top">:</td>
                            <td><textarea rows="2" cols="50" id="keterangan" name="keterangan" style="width: 300px;"></textarea></td>
                       </tr>
                        <!--tr>
                            <td valign="top">Upload Scan Sertifikat</td>
                            <td>:</td>
                            <td><input type="file" id="fileToUpload4" name="fileToUpload"/>
                                <input type="button" id="btnupload" value="Upload" onclick="return ajaxFileUpload('4');" />
								<input type="button" value="Lihat" valign="top" onclick="javascript:gambar('4');"></input></td>
                        </tr-->
						
					   <tr hidden="true">
							<td colspan="3">
                             <img style="width: 100px; height:100px;" id="foto4" alt="" onclick="javascript:gambar('4');"/>
							</td>
					   </tr>
                    </table>
               </td>
           </tr>
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
                       <tr border="1">
							<td colspan="3" align="center" >
                             <img style="width: 100px; height:100px;" id="foto1" alt="" onclick="javascript:gambar('1');"/>
                             <img style="width: 100px; height:100px;" id="foto2" alt="" onclick="javascript:gambar('2');"/>
                             <img style="width: 100px; height:100px;" id="foto3" alt="" onclick="javascript:gambar('3');"/>
							</td>
                       </tr>
                    </table>
                </td>
           </tr>
		   <tr>
                <td colspan="2" align="center">
				<a class="easyui-linkbutton" id="save" iconCls="icon-save" plain="true" onclick="javascript:simpan();">Simpan</a>                
		        <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Kembali</a>
				</td>                
           </tr>
        </table>  
    </fieldset> 
</div>

<div id="dialog-modal_gambar" title="">
     <table align="center" style="width:100%;" border="0">
           <tr>
            <td align="center">
            <img style="width: 400px; height:500px;" id="fotoZ" alt="some_text"/>
            </td>
           </tr>
           <tr>
            <td>&nbsp;</td>
           </tr> 
           <tr>
            <td align="center">
		    <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar1();">Kembali</a>
            </td>                
           </tr>
     </table>  
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
                            <td>SKPD</td>
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
