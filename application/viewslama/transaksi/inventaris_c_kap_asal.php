 <script type="text/javascript">
    var kdkel= '';var judul= '';var cid = 0;
    var lcidx = 0;var lcstatus = '';var lcskpd = '';
    var lpdok = '';var no_urut=0;
                    
     $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({height: 700,width: 1000,modal: true,autoOpen:false,});
			$( "#dialog-modal_gambar" ).dialog({height: 520,width: 500,modal: true,autoOpen:false});
        });    
     
     $(function(){
      
      $('#tanggal').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
                //ctgl = y+'-'+m+'-'+d;
            	return y+'-'+m+'-'+d;
            }
        });
        
      $('#tgl_sk').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
                //ctgl = y+'-'+m+'-'+d;
            	return y+'-'+m+'-'+d;
            }
        });
        
      $('#tgl_dok').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
                //ctgl = y+'-'+m+'-'+d;
            	return y+'-'+m+'-'+d;
            }
        });
		
		$('#tgl_kapital').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
                //ctgl = y+'-'+m+'-'+d;
            	return y+'-'+m+'-'+d;
            }
        });
        
      $('#nodok').combogrid({  
       panelWidth:500,  
       idField:'no_dokumen',  
       textField:'no_dokumen',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/transaksi/ambil_dok_c',  
       columns:[[  
           {field:'no_dokumen',title:'NOMOR DOKUMEN',width:400},  
           {field:'nilai_kontrak',title:'NILAI KONTRAK',width:100}    
       ]],  
       onSelect:function(rowIndex,rowData){
           nodok = rowData.no_dokumen;
           tanggal = rowData.tanggal;
           milik = rowData.kd_milik;
           wilayah= rowData.kd_wilayah;
           skpd =rowData.kd_unit;
           dsr_peroleh = rowData.b_dasar;
           no_oleh= rowData.b_nomor;
           tgl_oleh =rowData.b_tanggal;
           th_oleh =rowData.b_tahun;
           jns_dana =rowData.s_dana;
           bkt_bayar= rowData.s_ang;
           thn_anggar =rowData.tahun;
           lckd_cr = rowData.kd_cr_oleh;
           get(tanggal,milik,wilayah,skpd,dsr_peroleh,no_oleh,tgl_oleh,th_oleh,jns_dana,bkt_bayar,thn_anggar,lckd_cr);
            disable();
           $('#kdbrg').combogrid({url:'<?php echo base_url(); ?>index.php/transaksi/brg_gdg',queryParams:({nodok:nodok}) });
              
       }  
     });
        
     $('#kdbrg').combogrid({  
           panelWidth:600,  
           idField:'kd_brg',  
           textField:'kd_brg',  
           mode:'remote',                      
           columns:[[ 
                {field:'no_dokumen',title:'Dokumen',width:100}, 
               {field:'kd_brg',title:'Kode Barang',width:100},  
               {field:'nm_brg',title:'Nama Barang',width:400}               
           ]],  
           onSelect:function(rowIndex,rowData){
               idxGiat = rowIndex;               
               brg = rowData.kd_brg;
               invent=rowData.invent;
               $("#nmbrg").attr("value",rowData.nm_brg);
               $("#hrg_oleh").attr("value",number_format(rowData.harga,2,',','.'));
               $("#hrg").attr("value",rowData.harga);
               $("#jml").attr("value",rowData.jml);
               //$("#no_urut").attr("value",rowData.no_urut);
               //$("#keterangan").attr("value",rowData.keterangan);
               nomer_akhir(); 
               tombol(invent);                                                                 
           }  
        });   
     
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
          // if (lcstatus == 'tambah'){
           kd_tanah = rowData.kd_brg;
           $("#nmtanah").attr("value",rowData.nm_brg); 
          // }                 
       }  
     });
     
     $('#gambar').combogrid({  
       panelWidth:200,  
       idField:'nm',  
       textField:'nm',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/transaksi/scan',  
       columns:[[  
           {field:'nm',title:'Nama Foto',width:200}   
       ]],  
       onSelect:function(rowIndex,rowData){
          // if (lcstatus == 'tambah'){
           fot = rowData.nm;
           cokot(fot);
          
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
           {field:'nm_milik',title:'KEPEMILIKAN',width:400}    
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
           {field:'nm_wilayah',title:'WILAYAH',width:400}    
       ]] 
     });
     
     $('#skpd').combogrid({  
       panelWidth:500,  
       idField:'kd_uskpd',  
       textField:'kd_uskpd',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_ubidskpd',  
       columns:[[  
           {field:'kd_uskpd',title:'KODE SKPD',width:100},  
           {field:'nm_uskpd',title:'Nama SKPD',width:400}    
       ]],  
       onSelect:function(rowIndex,rowData){
          // if (lcstatus == 'tambah'){
           lcskpd = rowData.kd_uskpd;
           $("#nmskpd").attr("value",rowData.nm_uskpd.toUpperCase());
           $('#uker').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_uker2',queryParams:({kduskpd:lcskpd}) });
          // }                 
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
       panelWidth:150,  
       idField:'kd_cr_oleh',  
       textField:'cara_perolehan',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/perolehan',
       loadMsg:"Tunggu Sebentar....!!",  
       columns:[[  
           {field:'cara_perolehan',title:'Cara Perolehan',width:100}
       ]]
     });
     
     $('#dsr_peroleh').combogrid({  
       panelWidth:100,  
       idField:'kode',  
       textField:'kode',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/dasar_perolehan',
       loadMsg:"Tunggu Sebentar....!!",  
       columns:[[  
           {field:'kode',title:'Kode',width:10},
           {field:'dasar_perolehan',title:'Dasar Perolehan',width:90}
       ]],
        onSelect:function(rowIndex,rowData){
          // if (lcstatus == 'tambah'){
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
          // if (lcstatus == 'tambah'){
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
          // if (lcstatus == 'tambah'){
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
          // if (lcstatus == 'tambah'){
           lckondisi = rowData.kode;
           $("#kon").attr("value",rowData.kondisi.toUpperCase());
                         
       }  
     });
     
     $('#st_tanah').combogrid({  
       panelWidth:150,  
       idField:'kode',  
       textField:'kode',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/mstatus',
       loadMsg:"Tunggu Sebentar....!!",  
       columns:[[  
           {field:'kode',title:'Kode',width:40},
           {field:'status',title:'Status',width:110}
       ]],
        onSelect:function(rowIndex,rowData){
          // if (lcstatus == 'tambah'){
           lckondisi = rowData.kode;
           $("#sta").attr("value",rowData.status.toUpperCase());
                         
       }  
     });
     
       $('#lokasi').combogrid({  
       panelWidth:500,  
       idField:'kd_lokasi',  
       textField:'nm_lokasi',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_lokasi',  
       columns:[[  
           {field:'kd_lokasi',title:'KODE LOKASI',width:100},  
           {field:'nm_lokasi',title:'LOKASI',width:400}    
       ]] 
     });
	 
	  $('#metode').combogrid({  
       panelWidth:200,  
       idField:'kode',  
       textField:'kode',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/mmetode',
       loadMsg:"Tunggu Sebentar....!!",  
       columns:[[  
           {field:'kode',title:'Kode',width:40},
           {field:'metode',title:'Metode',width:200}
       ]],
        onSelect:function(rowIndex,rowData){
          // if (lcstatus == 'tambah'){
           lckondisi = rowData.kode;
           $("#metode").attr("value",rowData.metode.toUpperCase());
                         
       }  
     });
        
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/transaksi/ambil_kib_c_kap',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	  {field:'no_reg',title:'No Register',width:15,align:"center"},
          {field:'kd_brg',title:'Kode Barang',width:15,align:"center"},
          {field:'nm_brg',title:'Nama Barang',width:30,align:"left"},
          {field:'nilai',title:'Harga Peroleh',width:15,align:"right"},
          {field:'keterangan',title:'Keterangan',width:40,align:"left"},
		  {field:'hapus',width:5,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/document.png' onclick='javascript:edit_data();'' />";}}

        ]],
        onSelect:function(rowIndex,rowData){
          lcidx = rowIndex;
          noreg = rowData.no_reg;
          no 	= rowData.no;
          nodok = rowData.no_dokumen;
          kdbrg = rowData.kd_brg;
        },
        onDblClickRow:function(rowIndex,rowData){
          lcidx 		= rowIndex;
          judul 		= 'Edit Data Lokasi'; 
          lcstatus 		= 'edit';
          noreg 		= rowData.no_reg;
          no 			= rowData.no;
          tgl_reg 		= rowData.tgl_reg;
          nodok 		= rowData.no_dokumen;
          kdbrg  		= rowData.kd_brg;
          kondi			= rowData.kondisi;
          sta_thn		= rowData.status_tanah;
          ls_g			= rowData.luas_gedung;
          kontr 		= rowData.kontruksi;
          jns_bangunan	= rowData.jenis_gedung
          ls_t			= rowData.luas_tanah;
          ls_l			= rowData.luas_lantai;
          pengguna		= rowData.nip;
          dsr			= rowData.dasar;
          sk			= rowData.no_sk;
          tgl_sk		= rowData.tgl_sk;
          kd_lokasi		= rowData.kd_lokasi;
          ket			= rowData.keterangan;
          alamat1		= rowData.alamat1;
          alamat2		= rowData.alamat3;
          alamat3		= rowData.alamat3;
          kd_skpd		= rowData.kd_skpd;
          kd_unit		= rowData.kd_unit;
          lat 			= rowData.lat;
          lon 			= rowData.lon;
		  tgl_perolehan	= rowData.tgl_perolehan;
		  tmbh_manfaat	= rowData.tmbh_manfaat; 
          //foto=rowData.foto;
          foto1			= rowData.foto1;
          cokot(foto1,'1');
          foto2			= rowData.foto2;
          cokot(foto2,'2');
          foto3			= rowData.foto3;
          cokot(foto3,'3');
          foto4			= rowData.foto4;
          cokot(foto4,'4');
		  metode		= rowData.metode;
          masa_manfaat	= rowData.masa_manfaat;
          nilai_sisa	= rowData.nilai_sisa;
		 // metode,masa_manfaat,nilai_sisa 
          get1(noreg,no,tgl_reg,nodok,kdbrg,kondi,sta_thn,ls_g,kontr,jns_bangunan,ls_t,ls_l,pengguna,dsr,sk,tgl_sk,kd_lokasi,ket,alamat1,alamat2,alamat3,kd_skpd,kd_unit,lat,lon,foto1,foto2,foto3,foto4,metode,masa_manfaat,nilai_sisa,tgl_perolehan,tmbh_manfaat);
          edit_data();
        }
        
        });
		
        $('#kib').combogrid({  
            panelWidth:870,  
            panelHeight:400, 
            //width:160, 
            idField:'kd_brg',  
            textField:'kd_brg',              
            mode:'remote',            
			url:'<?php echo base_url(); ?>index.php/transaksi/ambil_kib_c',
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kd_brg',title:'Kode Aset',width:80,align:"center"},  
               {field:'no_reg',title:'No Register',width:100,align:"center"},
               {field:'nm_brg',title:'Nama Aset',width:200,align:"left"},
               {field:'nilai',title:'Harga',width:80,align:"right"},   
               {field:'luas_gedung',title:'Luas Gedung',width:80,align:"center"},
               {field:'alamat1',title:'Alamat',width:80,align:"left"},    
               {field:'tahun',title:'Tahun',width:50,align:"right",align:"center"},
               {field:'dasar',title:'Dasar',width:80,align:"left"},  
               {field:'keterangan',title:'Keterangan',width:150}     
            ]],  
           onSelect:function(rowIndex,rowData){
						id_brg	= rowData.id_barang;
						$('#no_reg').attr('value',rowData.no_reg);
						$('#id_barang').attr('value',rowData.id_barang);
                        $('#no').attr('value',rowData.no);
                        $('#tanggal').datebox('setValue',rowData.tgl_reg);    
                        $('#no_dokumen').attr('value',rowData.no_dokumen);
                        $('#kd_brg').attr('value',rowData.kd_brg);
                        $('#peroleh').attr('value',number_format(rowData.nilai));
                        $('#total').attr('value',rowData.total);
                        $('#dok').attr('value',rowData.no_dok);
                        $('#nm_brg').attr('value',rowData.nm_brg);
                        $('#tgl_dok').attr('value',rowData.tgl_dok);
                        $('#luas_gedung').attr('value',rowData.luas_gedung);
                        $('#jenis_gedung').attr('value',rowData.jenis_gedung);
                        $('#luas_tanah').attr('value',rowData.luas_tanah);
                        $('#status_tanah').attr('value',rowData.status_tanah);
                        $('#alamat1').attr('value',rowData.alamat1);
                        $('#alamat2').attr('value',rowData.alamat2);
                        $('#alamat3').attr('value',rowData.alamat3);
                        $('#kontruksi').attr('value',rowData.konstruksi);
                        $('#luas_lantai').attr('value',rowData.luas_lantai);
                        $('#kondisi').attr('value',rowData.kondisi);
                        $('#nip').attr('value',rowData.nip);
                        $('#dasar').attr('value',rowData.dasar);
                        $('#no_sk').attr('value',rowData.no_sk);
                        $('#tgl_sk').attr('value',rowData.tgl_sk);
                        $('#keterangan').attr('value',rowData.keterangan);
                        $('#kd_lokasi').attr('value',rowData.kd_lokasi2);
                        $('#no_mutasi').attr('value',rowData.no_mutasi);
                        $('#no_pindah').attr('value',rowData.no_pindah);
                        $('#no_hapus').attr('value',rowData.no_hapus);
                        $('#tahun').attr('value',rowData.tahun); 
                        $('#tgl_sp2d').attr('value',rowData.tgl_sp2d);
                        $('#lokasi').attr('value',rowData.kd_lokasi2);
                        $('#kd_unit').attr('value',rowData.kd_unit);
                        $('#lat').attr('value',rowData.lat);
                        $('#lon').attr('value',rowData.lon);
                        $('#foto1').attr('value',rowData.foto1);
                        $('#foto2').attr('value',rowData.foto2);
                        $('#foto3').attr('value',rowData.foto3);
                        $('#foto4').attr('value',rowData.foto4);
                        $('#metode').attr('value',rowData.metode);
                        $('#masa_manfaat').attr('value',rowData.masa_manfaat);
                        $('#nilai_sisa').attr('value',rowData.nilai_sisa);
						load_kib(id_brg);
				}  
		});
		
		$('#kib_kdp').combogrid({  
            panelWidth:870,  
            panelHeight:400, 
            //width:160, 
            idField:'kd_brg',  
            textField:'kd_brg',              
            mode:'remote',            
			url:'<?php echo base_url(); ?>index.php/transaksi/ambil_kib_f',
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kd_brg',title:'Kode Aset',width:80,align:"center"},  
               {field:'no_reg',title:'No Register',width:100,align:"center"},
               {field:'nm_brg',title:'Nama Aset',width:200,align:"left"},
               {field:'nilai',title:'Harga',width:80,align:"right"},   
               {field:'luas_gedung',title:'Luas Gedung',width:80,align:"center"},
               {field:'alamat1',title:'Alamat',width:80,align:"left"},    
               {field:'tahun',title:'Tahun',width:50,align:"right",align:"center"},
               {field:'dasar',title:'Dasar',width:80,align:"left"},  
               {field:'keterangan',title:'Keterangan',width:150}     
            ]],  
           onSelect:function(rowIndex,rowData){
			   kd_riwa= rowData.kd_riwayat;
                        $('#tmbh_manfaat').attr('value',number_format(rowData.nilai));
                        $('#nm_brg_kdp').attr('value',rowData.nm_brg);
                        $('#detail_kdp').attr('value',rowData.detail_brg);
                        $('#id_kdp').attr('value',rowData.id_barang);
						if(kd_riwa != null){
							document.getElementById("p1").innerHTML="Sudah diKAPITALISASI!!";
						}else{
							document.getElementById("p1").innerHTML="";
						}
				}  
		});
		   
        $('#trd').edatagrid({    		   
            rownumbers:"true",        
            height: 150,   
            toolbar:'#toolbar',
            loadMsg:"Load Barang....!!",            
            nowrap:"true"
        }); 
		
            $("#ambil_kpd").hide();
    });    
	
    //LOAD KDP
	function load_kib(id_brg){
		var i 		= 0;
        var ngol 	= id_brg;
        $('#trd').edatagrid({
            url: '<?php echo base_url(); ?>index.php/transaksi/ambil_kib_f_kap',
            queryParams:({tabel:'trkib_c_kap',gol:ngol}),
            rownumbers:true, 
            fitColumns:false,
            singleSelect:false,
			pagination:"true",
			columns:[[
            	    {field:'no_dokumen',title:'Nomor Dokumen',width:50,hidden:true},
                    {field:'no_reg',title:'NO REG ',width:60,align:"center"},
                    {field:'kd_brg',title:'KODE BARANG',width:110},
                    {field:'nm_brg',title:'NAMA BARANG',width:320},
                    {field:'tgl_riwayat',title:'TANGGAL',width:100,align:"center"},
                    {field:'kondisi',title:'KONDISI',width:100,align:"right",hidden:true},
                    {field:'thn',title:'TAHUN',width:70,align:"center"},
                    {field:'nil',title:'HARGA',width:180,align:"right"},  
                    {field:'no',title:'ck',width:30,checkbox:true}         
                ]],
                
                onSelect:function(rowIndex,rowData){ 
                    nomor   = rowData.no_dokumen;
                    no_reg  = rowData.no_reg;
                    id_brg  = rowData.id_brg;
                    kode    = rowData.kd_brg;
                    nama    = rowData.nm_brg;
                    tgl     = rowData.tgl_reg;
                    kondisi = rowData.kondisi;
                    tahun   = rowData.tahun;
                    nilai   = rowData.nilai;
                    get2(no_reg,id_brg,nomor,kode,nama,tgl,kondisi,tahun,harga);
                } 
		});
    }
	
    function ajaxFileUpload(lc)
	{
        var lcno = 'gambar'+lc;
        var lcupload = 'fileToUpload'+lc;
		var cfile = document.getElementById(lcupload).files[0];
		//$("#gambar").attr("value",cfile.name);
		document.getElementById(lcno).value = cfile.name;
        cokot(cfile.name,lc);
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
					alert(e);
				}
			}
		)
		
		return false;

	}
    
      
    function  get(tanggal,milik,wilayah,skpd,dsr_peroleh,no_oleh,tgl_oleh,th_oleh,jns_dana,bkt_bayar,thn_anggar,lckd_cr){
           //$("#tanggal").datebox("setValue",tanggal);
           //alert(lckd_cr);
           $("#milik").combogrid("setValue",milik);
           $("#wilayah").combogrid("setValue",wilayah);
           $("#skpd").combogrid("setValue",skpd);
           $("#dsr_peroleh").combogrid("setValue",dsr_peroleh);
           $("#no_oleh").attr("value",no_oleh);
           $("#tgl_oleh").attr("value",tgl_oleh);
           $("#th_oleh").attr("value",th_oleh);
           $("#jns_dana").combogrid("setValue",jns_dana);
           $("#bkt_bayar").combogrid("setValue",bkt_bayar);
           $("#perolehan").combogrid("setValue",lckd_cr);
           $("#thn_anggar").attr("value",thn_anggar);
                       
    }
    function  get1(noreg,no,tgl_reg,nodok,kdbrg,kondi,sta_thn,ls_g,kontr,jns_bangunan,ls_t,ls_l,pengguna,dsr,sk,tgl_sk,kd_lokasi,ket,alamat1,alamat2,alamat3,kd_skpd,kd_unit,lat,lon,foto1,foto2,foto3,foto4,metode,masa_manfaat,nilai_sisa,tgl_perolehan,tmbh_manfaat){
		   $("#kib").combogrid("setValue",kdbrg); 
           $("#tanggal").datebox("setValue",tgl_perolehan);
           $("#tgl_kapital").datebox("setValue",tgl_reg); 

		   $("#tmbh_manfaat").attr("value",tmbh_manfaat);
		   $("#noreg").attr("value",noreg);
           $("#no").attr("value",no);
           //$("#tanggal").datebox("setValue",tgl_reg);
           $("#nodok").combogrid("setValue",nodok);
           $("#kdbrg").combogrid("setValue",kdbrg);
           $('#kondisi').combogrid("setValue",kondi);
           $('#st_tanah').combogrid("setValue",sta_thn);
           $("#luas_gedung").attr("value",ls_g);
           $("#kontruksi").attr("value",kontr);
           $("#jns_bangunan").attr("value",jns_bangunan);
           $("#luas_tanah").attr("value",ls_t);
           $("#luas_lantai").attr("value",ls_l);
           $("#guna").attr("value",pengguna);
           $("#dsr_guna").attr("value",dsr);
           $("#no_sk").attr("value",sk);
           $("#tgl_sk").datebox("setValue",tgl_sk);
           $("#keterangan").attr("value",ket);
           $("#lokasi").combogrid("setValue",kd_lokasi);
           $("#alamat1").attr("value",alamat1);
           $("#alamat2").attr("value",alamat2);
           $("#alamat3").attr("value",alamat3);
           $("#uker").combogrid("setValue",kd_unit);
           $("#lat").attr("value",lat);
           $("#lon").attr("value",lon);
           $("#gambar1").attr("value",foto1);
           $("#gambar2").attr("value",foto2);
           $("#gambar3").attr("value",foto3);
           $("#gambar4").attr("value",foto4);
           $("#metode").combogrid("setValue",metode);
		   $("#masa_manfaat").attr("value",masa_manfaat);
           $("#nilai_sisa").attr("value",nilai_sisa);
           //$("#gambar").combogrid("setValue",foto);
           //$("#foto").attr("src","<?php echo base_url(); ?>"+foto);
                 
    }
	
    function  cokot(foto,lc){
         var lcfoto = 'foto'+lc;
         document.getElementById(lcfoto).src = "<?php echo base_url(); ?>data/"+foto;
    }
    
    function kosong(){
        $("#kib").combogrid("setValue",'');
        $("#nm_brg").attr("value",'');
        $("#dok").attr("value",'');
        $("#tanggal").datebox("setValue",'');
        $("#peroleh").attr("value",'');
        $("#tmbh_manfaat").attr("value",'');
		/*
        $("#noreg").attr("value",'');
        $("#tanggal").datebox("setValue",'');
        $("#milik").combogrid("setValue",'');
        $("#lokasi").combogrid("setValue",'');
        $("#wilayah").combogrid("setValue",'');
        $("#skpd").combogrid("setValue",'');
        $("#dsr_peroleh").combogrid("setValue",'');
        $("#no_oleh").attr("value",'');
        $("#tgl_oleh").attr("value",'');
        $("#th_oleh").attr("value",'');
        $("#jns_dana").combogrid("setValue",'');
        $("#bkt_bayar").combogrid("setValue",'');
        $("#thn_anggar").attr("value",'');
        $("#nodok").combogrid("setValue",'');
       $("#kdbrg").combogrid("setValue",'');
       $('#kdtnh').combogrid("setValue",'');
       $('#kondisi').combogrid("setValue",'');
       $('#st_tanah').combogrid("setValue",'');
       $("#kontruksi").attr("value",'');
       $("#luas_gedung").attr("value",'');
       $("#luas_tanah").attr("value",'');
       $("#luas_lantai").attr("value",'');
       $("#guna").attr("value",'');
       $("#dsr_guna").attr("value",'');
       $("#no_sk").attr("value",'');
       $("#tgl_sk").datebox("setValue",'');
       $("#keterangan").attr("value",'');
       $("#alamat1").attr("value",'');
       $("#alamat2").attr("value",'');
       $("#alamat3").attr("value",'');
       $("#nmbrg").attr("value",'');
       $("#jns_bangunan").attr("value",'');
       $("#nmskpd").attr("value",'');
       $("#das").attr("value",'');
       $("#hrg_oleh").attr("value",'');
       $("#hrg").attr("value",'');
       $("#buk").attr("value",'');
       $("#jml").attr("value",'');
       $("#sum").attr("value",'');
       $("#giat").attr("value",'');
       $("#kon").attr("value",'');
       $("#sta").attr("value",'');
       $("#skpd").combogrid("setValue",'');
       $("#no_urut").attr("value",'');
       $("#gambar1").attr("value",'');
       $("#gambar2").attr("value",'');
       $("#gambar3").attr("value",'');
       $("#gambar4").attr("value",'');
       $("#lat").attr("value",'');
       $("#lon").attr("value",'');
       $("#fileToUpload1").attr("value",'');
       $("#fileToUpload2").attr("value",'');
       $("#fileToUpload3").attr("value",'');
       $("#fileToUpload4").attr("value",'');
	   $("#metode").combogrid("setValue",'');   
	   $("#masa_manfaat").attr("value",'');
       $("#nilai_sisa").attr("value",'');
       cokot('','1');
       cokot('','2');
       cokot('','3');
       cokot('','4');*/
       document.getElementById("p1").innerHTML="";
    }
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    
    $(function(){
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/master/load_lokasi',
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
        var no_dokumen 		= document.getElementById('dok').value;
		var tgl_perolehan	= $('#tanggal').datebox('getValue');
		var peroleh			= angka(document.getElementById('peroleh').value);
		var tmbh_manfaat	= angka(document.getElementById('tmbh_manfaat').value);
        var no_reg 			= document.getElementById('no_reg').value;
        var id_barang 		= document.getElementById('id_barang').value;
        var no 				= document.getElementById('no').value;
        var tgl_reg 		= document.getElementById('tgl_reg').value;
        var kd_brg 			= document.getElementById('kd_brg').value;
        var nilai 			= document.getElementById('nilai').value;
		var skpd  			= '<?php echo ($this->session->userdata('skpd')); ?>';
        var kd_unit 		= document.getElementById('kd_unit').value;
        var keterangan 		= document.getElementById('keterangan').value;
		var kib_kdp			= $('#kib_kdp').combogrid('getValue');
        var id_kdp 			= document.getElementById('id_kdp').value;
		var tgl_kdp			= $('#tgl_kapital').datebox('getValue');
        lcinsert = '(no_reg,id_barang,no,tgl_reg,no_dokumen,kd_brg,nilai,keterangan,kd_skpd,kd_unit,tgl_perolehan,hrg_perolehan,tmbh_manfaat)';
		/* 
        if (no_dokumen==''){
            alert('Nomor Dokumen Tidak Boleh Kosong');
            exit();
        }  */
        
        if (peroleh==''){
            alert('Biaya Perolehan Tidak Boleh Kosong');
            exit();
        } 

        if (lcstatus=='tambah'){ 

		lcvalues = "('"+no_reg+"','"+id_barang+"','"+no+"','"+tgl_kdp+"','"+no_dokumen+"','"+kd_brg+"','"+peroleh+"','"+keterangan+"','"+skpd+"','"+kd_unit+"','"+tgl_perolehan+"','"+peroleh+"','"+tmbh_manfaat+"')";
		
           $(document).ready(function(){
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>index.php/transaksi/simpan_trkib_c',
                    data: ({tabel:'trkib_c_kap',tabel2:'trkib_c',no:no_dokumen,lkd_brg:kd_brg,kolom:lcinsert,lcvalues:lcvalues,id_barang:id_barang,kib_kdp:kib_kdp,tgl_kdp:tgl_kdp,id_kdp:id_kdp}),
                    dataType:"json"
                });
            });  
			load_kib(id_barang);	
        } else {
			lcquery = "UPDATE trkib_c SET luas_gedung='"+luas_gedung+"',jenis_gedung='"+jns_bangunan+
             "',luas_tanah='"+luas_tanah+"',status_tanah='"+st_tanah+"',alamat1='"+alamat1+"',alamat2='"+
             alamat2+"',alamat3='"+alamat3+"',konstruksi='"+kontruksi+"',luas_lantai='"+luas_lantai+
             "',kondisi='"+kondisi+"',nip='"+pengguna+"',dasar='"+dasar_pengguna+"',no_sk='"+no_sk+
             "',tgl_sk='"+tgl_sk+"',kd_lokasi2='"+lokasi+"',keterangan='"+keterangan+"',kd_unit='"+
             kd_unit+"',foto1='"+file_gbr1+"',foto2='"+file_gbr2+"',foto3='"+file_gbr3+"',foto4='"+file_gbr4+"',metode='"+metode+"',masa_manfaat='"+masa_manfaat+"',nilai_sisa='"+nilai_sisa+"',lat='"+clat+"',lon='"+clon+"' where no ='"+no+"'";
            
            $(document).ready(function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>index.php/transaksi/update_trkib_c',
                data: ({st_query:lcquery}),
                dataType:"json"
            });
            });
        }
        alert("Data Berhasil disimpan");
        $("#dialog-modal").dialog('close');
        $('#dg').edatagrid('reload');
		} 
    
      function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        document.getElementById("noreg").disabled=true;
        }    
        
    
     function tambah(){
        lcstatus = 'tambah';
        judul = 'Input Data';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
        $("#dialog-modal").dialog('open');
        document.getElementById("noreg").disabled=false;
        document.getElementById("noreg").focus();
        } 
     function keluar(){
        $("#dialog-modal").dialog('close');
     }    
        
      function keluar1(){
        //$("#dialog-modal").dialog('close');
        $("#dialog-modal_gambar").dialog('close');
     }  
     
     function hapus(){
		var del=confirm('Apakah Anda yakin ingin Menhapus data '+nodok+'?');
		if (del==true){         
        var urll = '<?php echo base_url(); ?>index.php/transaksi/hapus_trkib_c_kap';
        $(document).ready(function(){
         $.post(urll,({no:no,dok:nodok}),function(data){
            status = data;
            if (status=='0'){
                alert('Gagal Hapus..!!');
                exit();
            } else {
                $('#dg').datagrid('deleteRow',lcidx);   
                alert('Data Berhasil Dihapus..!!');
                exit();
            }
         });
        });    }
    } 
    
    function nomer_akhir(){
        var i = 0;
        var tabel ='trkib_c'
        var kd = brg;
        var unit = skpd;
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>index.php/transaksi/nomor',
            data: ({tabel:tabel,kd_brg:kd,kd_unit:unit}),
            dataType:"json",
            success:function(data){                                          
                $.each(data,function(i,n){                                    
                    nom      = n['urut'];  
                    $("#no_urut").attr("value",nom);                              
                });
            }
        });         
    } 
    
    function disable(){
         $('#milik').combogrid('disable');
         $("#wilayah").combogrid('disable');
           $("#skpd").combogrid('disable');
           $("#dsr_peroleh").combogrid('disable');
           $("#jns_dana").combogrid('disable');
           $("#bkt_bayar").combogrid('disable');
      }
      
    function tambah_urut(angka,panjang){
        no=((angka)*1)+1;
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
   /*  if(lcstatus=='tambah'){ 
        if (st=='1'){    
        document.getElementById("p1").innerHTML="Sudah di INVENTARISASI!!";
         } else {     
        document.getElementById("p1").innerHTML="";
         }
        } */
   }
  
    function getkey(e){
	if (window.event)
		return window.event.keyCode;
	else if (e)
		return e.which;
	else
	return null;}
  function goodchars(e, goods, field){
	var key, keychar;
	key = getkey(e);
	if (key == null) return true;
		keychar = String.fromCharCode(key);
		keychar = keychar.toLowerCase();
		goods = goods.toLowerCase();
	// check goodkeys
	if (goods.indexOf(keychar) != -1)
    return true;
	// control keys
	if ( key==null || key==0 || key==8 || key==9 || key==27 )
	return true;
	if (key == 13) {
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
	
		function buka_kdp(){
					$("#ambil_kpd").show();
					$('#tmbh_manfaat').attr("disabled",false);
		}
   </script>



<div id="content1"> 
<h3 align="center"><u><b><a>INPUTAN INVENTARIS GEDUNG BANGUNAN</a></b></u></h3>
    <div align="center">
    <p>     
    <table style="width:400px;" border="0">
        <tr>
        <td width="10%">
        <a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:kosong();tambah();">Tambah</a></td>               
        <td width="5%"><a class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="javascript:cari();">Cari</a></td>
        <td><input type="text" value="" id="txtcari" style="width:300px;"/></td>
        </tr>
        <tr>
        <td colspan="4">
        <table id="dg" align="center" title="LISTING INVENTARIS GEDUNG BANGUNAN" style="width:900px;height:365px;" >  
        </table>
        </td>
        </tr>
    </table>    
 
    </p> 
    </div>   
</div>

<div id="dialog-modal" title="">
    <p class="validateTips"></p> 
    <fieldset>
    <p id="p1" style="font-size: x-large;color: red;">.: Kapitalisasi KIB C. Gedung Bangunan</p>
     <table align="center" style="width:100%;" border="0">
           <tr>
               <td width="50%" valign="top">
                    <table align="left" style="width:100%;" border="0">
						<tr>
                            <td width="20%">Nama Barang</td>
                            <td>: <input id="kib" name="kib" style="width: 150px;" /> <input id="nm_brg" name="nm_brg" readonly="true" style="border:0;width: 400px;"/></td>
                            <td width="10%"></td>
                       </tr>
                       <tr hidden="true">
                            <td>No Dokumen</td>
                            <td>: <input id="dok" name="dok" style="width: 200px;" /></td>
                            <td></td>
                       </tr>
                       <tr width="10%">
                            <td>Tanggal Register</td>
                            <td>: <input type="text" id="tanggal" name="tanggal" style="width: 140px;" /></td>
                            <td></td>
                       </tr>
                       <tr>
                            <td>Harga Perolehan</td>
                            <td>: <input id="peroleh" name="peroleh" readonly="true" style="text-align: right;width: 150px;" onkeypress="return(currencyFormat(this,',','.',event));"/></td>
                            <td></td>
                       </tr>
                       <tr>
						<td colspan="3"><button onclick="javascript:buka_kdp();">POSTING KDP</button></td>
                       </tr>
                       <tr><td colspan="3">
						<div id="ambil_kpd">
							<table style="width:100%;" border="0">
							<tr>
								<td width="10%"><B>KODE</B></td>
								<td >: <input id="kib_kdp" name="kib_kdp" style="width: 150px;" /> 
								<input id="id_kdp" name="id_kdp" hidden="true" style="width: 150px;" /></td>
							</tr>
							<tr>
								<td width="10%"><B>KDP</B></td>
								<td >:<input id="nm_brg_kdp" name="nm_brg_kdp" readonly="true" style="border:0;width: 500px;font-size:18px;"/>/
										<input id="detail_kdp" name="detail_kdp" readonly="true" style="border:0;width: 500px;font-size:18px;"/></td>
							</tr>
							</table>
						</div></td>	
                       </tr>
                       <tr>
                            <td>Tanggal Kapitalisasi</td>
                            <td>: <input id="tgl_kapital" name="tgl_kapital"/></td>
                            <td></td>
                       </tr>
                       <tr>
                            <td>Nilai Kapitalisasi</td>
                            <td>: <input id="tmbh_manfaat" name="tmbh_manfaat" style="text-align: right;width: 150px;" onkeypress="return(currencyFormat(this,',','.',event));"/></td>
                            <td></td>
                       </tr>
					   
					<!--sengaja dihidden-->
                       <tr hidden="true">
                            <td>no_reg</td>
                            <td>: <input id="no_reg" name="no_reg" style="width: 200px;" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>kd_unit</td>
                            <td>: <input id="kd_unit" name="kd_unit" style="width: 200px;" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>id_barang</td>
                            <td>: <input id="id_barang" name="id_barang" style="width: 200px;" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>no</td>
                            <td>: <input id="no" name="no" style="width: 200px;" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>tgl_reg</td>
                            <td>: <input id="tgl_reg" name="tgl_reg" style="width: 200px;" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>no_dokumen</td>
                            <td>: <input id="no_dokumen" name="no_dokumen" style="width: 200px;" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>kd_brg</td>
                            <td>: <input id="kd_brg" name="kd_brg" style="width: 200px;" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>nilai</td>
                            <td>: <input id="nilai" name="nilai" style="width: 200px;" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>keterangan</td>
                            <td>: <input id="keterangan" name="keterangan" style="width: 200px;" /></td>
                            <td></td>
                       </tr>
					   
                    </table> 
               </td>
           </tr>
           <tr>
                <td colspan="2" align="center">
                    <table  align="left" style="width:100%;" border="0">
                        <tr>
                            <td valign="top" width="14%" height="12.5px">Gambar</td>
                            <td valign="top" width="3%">:</td>
                            <td valign="top" width="58%"><input type="text" id="gambar1" name="gambar" style="width:200px;" disabled="disabled" />
                                <img id="loading" src="<?php echo base_url();?>public/images/loading.gif" style="display:none;">
                            	<input type="file" id="fileToUpload1" name="fileToUpload"/>
                                <input type="button" id="btnupload" value="Upload" onclick="return ajaxFileUpload('1');"  /></td>
                            <td  width="25%" rowspan="5">
                                <table  align="left" style="width:100%;height: 100%;" border="0">
                                    <tr>
                                        <td width="50%" height="50px" align="center"><img style="width: 100px; height:100px;" id="foto1" alt="" onclick="javascript:gambar('1');"/>
                                        </td>                                        
                                        <td width="50%" align="center">
                                         <img style="width: 100px; height:100px;" id="foto2" alt="" onclick="javascript:gambar('2');"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="50px" align="center"><img style="width: 100px; height:100px;" id="foto3" alt="" onclick="javascript:gambar('3');"/></td>
                                        <td align="center"><img style="width: 100px; height:100px;" id="foto4" alt="" onclick="javascript:gambar('4');"/></td>
                                    </tr>
                                </table>
                            </td>   
                            
                           
                       </tr>
                       <tr>
                            <td valign="top" height="12.5px">&nbsp;</td>
                            <td valign="top">:</td>
                            <td valign="top"><input type="text" id="gambar2" name="gambar" style="width:200px;" disabled="disabled" />
                                <img id="loading" src="<?php echo base_url();?>public/images/loading.gif" style="display:none;">
                            	<input type="file" id="fileToUpload2" name="fileToUpload"/>
                                <input type="button" id="btnupload" value="Upload" onclick="return ajaxFileUpload('2');"  /></td>
                           
                       </tr>
                       <tr>
                            <td valign="top" height="12.5px">&nbsp;</td>
                            <td valign="top" >:</td>
                            <td valign="top"><input type="text" id="gambar3" name="gambar" style="width:200px;" disabled="disabled" />
                                <img id="loading" src="<?php echo base_url();?>public/images/loading.gif" style="display:none;">
                            	<input type="file" id="fileToUpload3" name="fileToUpload"/>
                                <input type="button" id="btnupload" value="Upload" onclick="return ajaxFileUpload('3');"  /></td>
                           
                       </tr>
                       <tr>
                            <td valign="top" height="12.5px">&nbsp;</td>
                            <td valign="top">:</td>
                            <td valign="top"><input type="text" id="gambar4" name="gambar" style="width:200px;" disabled="disabled" />
                                <img id="loading" src="<?php echo base_url();?>public/images/loading.gif" style="display:none;">
                            	<input type="file" id="fileToUpload4" name="fileToUpload"/>
                                <input type="button" id="btnupload" value="Upload" onclick="return ajaxFileUpload('4');"  /></td>
                       </tr>
                       
                    </table>
                </td>
           </tr>
           <tr>
                <td colspan="2" align="center"><a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:simpan();">Simpan</a>
		        <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Kembali</a>
                </td>                
            </tr>
		   <tr>        
		   <div>
				<table  id="trd" title="Detail Barang" style="width:940px;height:300px;" ></table>  
			</div>
		   </tr>
           <tr>
                <td colspan="2">&nbsp;</td>
           </tr>
        </table>  
            
    </fieldset> 
</div>
