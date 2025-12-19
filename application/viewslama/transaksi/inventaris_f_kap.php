
  	
    <script type="text/javascript">
    
    var kdkel= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
    var lcskpd = '';
    var lpdok = '';
    var no_urut=0;
                    
     $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
            height: 550,
            width: 1000,
            modal: true,
            autoOpen:false,
        });
        $( "#dialog-modal_gambar" ).dialog({
            height: 550,
            width: 400,
            modal: true,
            autoOpen:false
        });
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
        
      $('#tgl_mulai').datebox({  
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
       url:'<?php echo base_url(); ?>index.php/transaksi/ambil_dok_f',  
       columns:[[  
           {field:'no_dokumen',title:'NOMOR DOKUMEN',width:400},  
           {field:'nilai_kontrak',title:'NILAI KONTRAK',width:100}    
       ]],  
       onSelect:function(rowIndex,rowData){
          // if (lcstatus == 'tambah'){
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
           get(tanggal,milik,wilayah,skpd,dsr_peroleh,no_oleh,tgl_oleh,th_oleh,jns_dana,bkt_bayar,thn_anggar);

            disable();
           $('#kdbrg').combogrid({url:'<?php echo base_url(); ?>index.php/transaksi/brg_kont',queryParams:({nodok:nodok}) });
          // }                 
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
               $("#no_urut").attr("value",rowData.no_urut);
               //$("#keterangan").attr("value",rowData.keterangan); 
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
       idField:'cara_perolehan',  
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
     
     $('#kontruksi').combogrid({  
       panelWidth:150,  
       idField:'kode',  
       textField:'nm_konstruksi',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/mkonstruksi',
       loadMsg:"Tunggu Sebentar....!!",  
       columns:[[  
           {field:'kode',title:'Kode',width:40},
           {field:'nm_konstruksi',title:'Konstruksi',width:110}
       ]],
        onSelect:function(rowIndex,rowData){
          // if (lcstatus == 'tambah'){
           lckonstruksi = rowData.kode;
           //$("#sta").attr("value",rowData.status.toUpperCase());
                         
       }  
     });
     
     $('#jenis').combogrid({  
       panelWidth:150,  
       idField:'kode',  
       textField:'jns_bangunan',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/mjenis',
       loadMsg:"Tunggu Sebentar....!!",  
       columns:[[  
           {field:'kode',title:'Kode',width:40},
           {field:'jns_bangunan',title:'Jenis Bangunan',width:110}
       ]],
        onSelect:function(rowIndex,rowData){
          // if (lcstatus == 'tambah'){
           lckonstruksi = rowData.kode;
           //$("#sta").attr("value",rowData.status.toUpperCase());
                         
       }  
     });
        
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/transaksi/ambil_kib_f_kap',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'no_reg',
    		title:'No Register',
    		width:15,
            align:"left"},
            {field:'no_dokumen',
    		title:'No Dokumen',
    		width:15,
            align:"left"},
            {field:'nm_brg',
    		title:'Nama Barang',
    		width:25,
            align:"left"},
            {field:'hrg_perolehan',
    		title:'Harga Peroleh',
    		width:30,
            align:"left"},
            {field:'keterangan',
    		title:'Keterangan',
    		width:40,
            align:"left"},
			{field:'hapus',width:5,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus();'' />";}}

        ]],
        onSelect:function(rowIndex,rowData){
          lcidx = rowIndex;
          noreg = rowData.no_reg;
          no = rowData.no;
          nodok = rowData.no_dokumen;
          kdbrg  = rowData.kd_brg;
          //get1(noreg,nodok,kdbrg);   
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
          lcidx = rowIndex;
          judul = 'Edit Data Lokasi'; 
          lcstatus = 'edit';
          noreg = rowData.no_reg;
          no = rowData.no;
          tgl_reg = rowData.tgl_reg;
          nodok = rowData.no_dokumen;
          kdbrg  = rowData.kd_brg;
          kd_tnh=rowData.kd_tanah;
          kondi=rowData.kondisi;
          kontr=rowData.kontruksi;
          jenis=rowData.jenis;
          ls=rowData.luas;
          tgl_awal=rowData.tgl_awal_kerja;
          sta_thn=rowData.status_tanah;
          nilai_kontrak=rowData.nilai_kontrak;
          ket=rowData.keterangan;
          alamat1=rowData.alamat1;
          alamat2=rowData.alamat2;
          alamat3=rowData.alamat3;
          lokasi=rowData.kd_lokasi;
          kd_unit=rowData.kd_unit;
          foto=rowData.foto;
          get1(noreg,no,tgl_reg,nodok,kdbrg,kd_tnh,kondi,kontr,jenis,ls,tgl_awal,sta_thn,nilai_kontrak,ket,alamat1,alamat2,alamat3,lokasi,kd_unit,foto);
          edit_data();  
        }
        
        });
		
	$('#kib').combogrid({  
            panelWidth:800,  
            panelHeight:400, 
            //width:160, 
            idField:'no_dokumen',  
            textField:'no_dokumen',              
            mode:'remote',            
			url:'<?php echo base_url(); ?>index.php/transaksi/ambil_kib_f',
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kd_brg',title:'Kode Aset',width:80,align:"center"}, 
               {field:'no_reg',title:'No Register',width:100,align:"center"}, 
               {field:'tgl_reg',title:'Tgl Register',width:80,align:"left"},  
               {field:'nm_brg',title:'Nama Aset',width:200,align:"left"},
               {field:'nilai',title:'Harga',width:80,align:"right"},   
               {field:'kondisi_barang',title:'Kondisi',width:70,align:"center"},  
               {field:'tahun',title:'Tahun',width:50,align:"right",align:"center"},
               {field:'keterangan',title:'Keterangan',width:150}     
            ]],  
           onSelect:function(rowIndex,rowData){
						$('#no_reg').attr('value',rowData.no_reg);
						$('#id_barang').attr('value',rowData.id_barang);
						$('#kd_unit').attr('value',rowData.kd_unit);
                        $('#no').attr('value',rowData.no);
                        $('#tgl_reg').attr('value',rowData.tgl_reg);    
                        $('#no_dokumen').attr('value',rowData.no_dokumen);
                        $('#kd_brg').attr('value',rowData.kd_brg);
                        $('#nilai').attr('value',rowData.nilai);
                        $('#total').attr('value',rowData.total);
                        $('#no_dok').attr('value',rowData.no_dok);
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
                        $('#lat').attr('value',rowData.lat);
                        $('#lon').attr('value',rowData.lon);
                        $('#foto1').attr('value',rowData.foto1);
                        $('#foto2').attr('value',rowData.foto2);
                        $('#foto3').attr('value',rowData.foto3);
                        $('#foto4').attr('value',rowData.foto4);
                        $('#metode').attr('value',rowData.metode);
                        $('#masa_manfaat').attr('value',rowData.masa_manfaat);
                        $('#nilai_sisa').attr('value',rowData.nilai_sisa);
				}  
		});
       
    });     
    
    function  get1(noreg,no,tgl_reg,nodok,kdbrg,kd_tnh,kondi,kontr,jenis,ls,tgl_awal,sta_thn,nilai_kontrak,ket,alamat1,alamat2,alamat3,lokasi,kd_unit,foto){
           $("#noreg").attr("value",noreg);
           $("#no").attr("value",no);
           $("#tanggal").datebox("setValue",tgl_reg);
           $("#nodok").combogrid("setValue",nodok);
           $("#kdbrg").combogrid("setValue",kdbrg);
           $('#kdtnh').combogrid("setValue",kd_tnh);
           $('#kondisi').combogrid("setValue",kondi);
           $("#kontruksi").combogrid("setValue",kontr);
           $('#jenis').combogrid("setValue",jenis);
           $("#luas").attr("value",ls);
           $("#tgl_awal").datebox("setValue",tgl_awal);
           $('#st_tanah').combogrid("setValue",sta_thn);
           $("#nilai_k").attr("value",nilai_kontrak);
           $("#keterangan").attr("value",ket);
           $("#alamat1").attr("value",alamat1);
           $("#alamat2").attr("value",alamat2);
           $("#alamat3").attr("value",alamat3);
           $("#lokasi").combogrid("setValue",lokasi);
           $("#uker").combogrid("setValue",kd_unit);
           $("#gambar").attr("value",foto);
           $("#foto").attr("src","<?php echo base_url(); ?>"+foto);
                              
    }
    
     function  get(tanggal,milik,wilayah,skpd,dsr_peroleh,no_oleh,tgl_oleh,th_oleh,jns_dana,bkt_bayar,thn_anggar){
           //$("#tanggal").datebox("setValue",tanggal);
           $("#milik").combogrid("setValue",milik);
           $("#wilayah").combogrid("setValue",wilayah);
           $("#skpd").combogrid("setValue",skpd);
           $("#dsr_peroleh").combogrid("setValue",dsr_peroleh);
           $("#no_oleh").attr("value",no_oleh);
           $("#tgl_oleh").attr("value",tgl_oleh);
           $("#th_oleh").attr("value",th_oleh);
           $("#jns_dana").combogrid("setValue",jns_dana);
           $("#bkt_bayar").combogrid("setValue",bkt_bayar);
           $("#thn_anggar").attr("value",thn_anggar);
           //$(".milik").combogrid.({disabled:true});
           //document.getElementById("#milik").disabled=true;
                       
    }
    
    function kosong(){
        $("#kib").combogrid("setValue",'');
        $("#nm_brg").attr("value",'');
        $("#dok").attr("value",'');
        $("#tanggal").datebox("setValue",'');
        $("#peroleh").attr("value",'');
        $("#tmbh_manfaat").attr("value",'');
        /*$("#milik").combogrid("setValue",'');
        $("#wilayah").combogrid("setValue",'');
        $("#skpd").combogrid("setValue",'');
        $("#dsr_peroleh").combogrid("setValue",'');
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
       $("#panjang").attr("value",'');
       $("#luas").attr("value",'');
       $("#lebar").attr("value",'');
       $("#guna").attr("value",'');
       $("#dsr_guna").attr("value",'');
       $("#no_sk").attr("value",'');
       $("#tgl_sk").datebox("setValue",'');
       $("#keterangan").attr("value",'');
       $("#alamat1").attr("value",'');
       $("#alamat2").attr("value",'');
       $("#alamat3").attr("value",'');
       $("#nmbrg").attr("value",'');
       $("#nmtanah").attr("value",'');
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
       $("#no_urut").attr("value",'');*/
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
    
    function simpan(){
        var no_dokumen 		= document.getElementById('dok').value;
		var tgl_perolehan	= $('#tanggal').datebox('getValue');
		var peroleh			= document.getElementById('peroleh').value;
		var tmbh_manfaat	= document.getElementById('tmbh_manfaat').value;
        var no_reg 			= document.getElementById('no_reg').value;
        var id_barang 		= document.getElementById('id_barang').value;
        var no 				= document.getElementById('no').value;
        var tgl_reg 		= document.getElementById('tgl_reg').value;
        var kd_brg 			= document.getElementById('kd_brg').value;
        var nilai 			= document.getElementById('nilai').value;
        var kd_unit 		= document.getElementById('kd_unit').value;
        var keterangan 		= document.getElementById('keterangan').value;
        var foto 		= document.getElementById('gambar1').value;
    	
        lcinsert = '(no_reg,id_barang,no,tgl_reg,no_dokumen,kd_brg,nilai,keterangan,kd_unit,foto,tgl_perolehan,hrg_perolehan,tmbh_manfaat)';

        if (no_dokumen==''){
            alert('Nomor Dokumen Tidak Boleh Kosong');
            exit();
        } 
        
        if (peroleh==''){
            alert('Biaya Perolehan Tidak Boleh Kosong');
            exit();
        } 

        if (lcstatus=='tambah'){ 

		lcvalues = "('"+no_reg+"','"+id_barang+"','"+no+"','"+tgl_reg+"','"+no_dokumen+"','"+kd_brg+"','"+nilai+"','"+keterangan+"','"+kd_unit+"','"+foto+"','"+tgl_perolehan+"','"+peroleh+"','"+tmbh_manfaat+"')";
		
           $(document).ready(function(){
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>index.php/transaksi/simpan_trkib_f',
                    data: ({tabel:'trkib_f_kap',no:no_dokumen,lkd_brg:kd_brg,kolom:lcinsert,lcvalues:lcvalues}),
                    dataType:"json"
                });
            });    
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
                url: '<?php echo base_url(); ?>index.php/transaksi/update_trkib_f',
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
        judul = 'Edit Data ';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        document.getElementById("noreg").disabled=true;
        }    
        
    
     function tambah(){
        lcstatus = 'tambah';
        judul = 'Input Data ';
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
        var urll = '<?php echo base_url(); ?>index.php/transaksi/hapus_trkib_f_kap';
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
        var tabel ='trkib_f'
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
    if(lcstatus=='tambah'){ 
        if (st=='1'){    
        document.getElementById("p1").innerHTML="Sudah di INVENTARISASI!!";
         } else {     
        document.getElementById("p1").innerHTML="";
         }
        }
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

	   function gambar(lf){
        
        lcfoto = 'foto'+lf;
        document.getElementById("fotoZ").src =  document.getElementById(lcfoto).src;
        $("#dialog-modal_gambar").dialog('open');             
    }
	
	function  cokot(foto,lc){
         var lcfoto = 'foto'+lc;
         document.getElementById(lcfoto).src = "<?php echo base_url(); ?>data/"+foto;
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
	    function getkey(e){
	if (window.event)
		return window.event.keyCode;
	else if (e)
		return e.which;
	else
	return null;}
	
	
   </script>



<div id="content1"> 
<h3 align="center"><u><b><a>INPUTAN INVENTARIS KONTRUKSI DALAM PEKERJAAN</a></b></u></h3>
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
        <table id="dg" align="center" title="LISTING INVENTARIS KONTRUKSI DALAM PEKERJAAN" style="width:900px;height:365px;" >  
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
                            <td>: <input id="kib" name="kib" style="width: 200px;" /> <input id="nm_brg" name="nm_brg" style="width: 300px;" style="border:0;width: 400px;"/></td>
                            <td width="10%"></td>
                       </tr>
                       <tr>
                            <td>No Dokumen</td>
                            <td>: <input id="dok" name="dok" style="width: 200px;" /></td>
                            <td></td>
                       </tr>
                       <tr width="10%">
                            <td>Tanggal Perolehan</td>
                            <td>: <input type="text" id="tanggal" style="width: 140px;" /></td>
                            <td></td>
                       </tr>
                       <tr>
                            <td>Harga Perolehan</td>
                            <td>: <input id="peroleh" name="peroleh" style="width: 200px;" style="text-align: right;"/></td>
                            <td></td>
                       </tr>
                       <tr>
                            <td>Tambahan Masa Manfaat</td>
                            <td>: <input id="tmbh_manfaat" name="tmbh_manfaat" style="width: 200px;" style="text-align: right;" onKeyPress="return goodchars(event,'1234567890',this)"/></td>
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
                <td colspan="2">&nbsp;</td>
           </tr>
           <tr>
                <td colspan="2" align="center"><a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:simpan();">Simpan</a>
		        <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Kembali</a>
                </td>                
            </tr>
        </table>  
            
    </fieldset> 
</div>
