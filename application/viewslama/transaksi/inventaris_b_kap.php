<script src="<?php echo base_url(); ?>lib/sweet-alert.min.js"></script>
<link   rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>lib/sweet-alert.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/service.flatcheckbox.jquery-master/src/service.flatcheckbox.jquery.css"> 
<script src="<?php echo base_url(); ?>easyui/service.flatcheckbox.jquery-master/src/service.flatcheckbox.jquery.min.js"></script> 	
<script type="text/javascript">

    
    var kdkel		= '';
    var judul		= '';
    var cid 		= 0;
    var lcidx 		= 0;
    var lcstatus 	= '';
    var lcskpd 		= '';
    var lpdok 		= '';
    var no_urut		=0;
    var sts_inp =1;
    var nomor_bukti='';
    var updt = 'f';
    var jns_trans='';

    //Created by Demansyah 
                    
     $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
                height: 650,
                width: 1000,
                modal: true,
                autoOpen:false
        });
        $( "#dialog-modal_det" ).dialog({
            height: 720,
            width: 980,
            modal: true,
            autoOpen:false
        });
        }); 
    
     
     $(function(){

      $('#tgl_kap').datebox({  
            required:true,
            formatter :function(date){
              var y = date.getFullYear();
              var m = date.getMonth()+1;
              var d = date.getDate();
                
              return y+'-'+m+'-'+d;
            },
            onSelect: function(date){
    //alert(date.getFullYear()+":"+(date.getMonth()+1)+":"+date.getDate());
    //susut();
  }
            
        });
      
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

        
       $('#tglstnk').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
                //ctgl = y+'-'+m+'-'+d;
            	return y+'-'+m+'-'+d;
            }
        });
      
      $('#tglbpkb').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
                //ctgl = y+'-'+m+'-'+d;
            	return y+'-'+m+'-'+d;
            }
        });

      /*$('#pelihara').flatcheckbox({
        label: "Pemeliharaan / Bukan Pemeliharaan",
        onChecked: function () {
          susut();
          sts_inp=1;
          $('#pelihara').flatcheckbox('label', 'Bukan Pemeliharaan');
        },
        onUnChecked: function () {
          susut();
          sts_inp=0; 
          $('#pelihara').flatcheckbox('label', 'Pemeliharaan');
        }
      });*/
    
    $('#tahun_berjalan').combogrid({           
        idField:'tahun',  
        textField:'tahun',
        mode:'remote',
        panelWidth:100,
        url:'<?php echo base_url(); ?>index.php/master/tahun',
        columns:[[  
           {field:'tahun',title:'Tahun',width:400}
           ]]
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
               no_urut=rowData.no_urut;
               $("#nmbrg").attr("value",rowData.nm_brg);
               $("#hrg_oleh").attr("value",number_format(rowData.total,2,',','.'));
               $("#hrg").attr("value",rowData.total);
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
     
     $('#warna').combogrid({  
       panelWidth:300,  
       idField:'kd_warna',  
       textField:'nm_warna',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_warna',  
       columns:[[  
           {field:'kd_warna',title:'KODE WARNA',width:100},  
           {field:'nm_warna',title:'WARNA',width:200}    
       ]] 
     });
     
     $('#bahan').combogrid({  
       panelWidth:300,  
       idField:'kd_bahan',  
       textField:'nm_bahan',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_bahan',  
       columns:[[  
           {field:'kd_bahan',title:'KODE BAHAN',width:100},  
           {field:'nm_bahan',title:'BAHAN',width:200}    
       ]] 
     });
     
     $('#satuan').combogrid({  
       panelWidth:300,  
       idField:'kd_satuan',  
       textField:'nm_satuan',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_satuan',  
       columns:[[  
           {field:'kd_satuan',title:'KODE SATUAN',width:100},  
           {field:'nm_satuan',title:'SATUAN',width:200}    
       ]] 
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
     
     $('#ruang').combogrid({  
       panelWidth:500,  
       idField:'kd_ruang',  
       textField:'nm_ruang',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_ruang',  
       columns:[[  
           {field:'kd_ruang',title:'KODE RUANGAN',width:100},  
           {field:'nm_ruang',title:'RUANGAN',width:400}    
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
      panelWidth:700,  
      url: '<?php echo base_url(); ?>/index.php/master/ambil_msskpd2',  
        idField:'kd_skpd',                    
        textField:'kd_skpd',
        mode:'remote',  
        fitColumns:true,  
        columns:[[  
               {field:'kd_skpd',title:'Kode OPD',width:100},  
               {field:'nm_skpd',title:'Nama OPD',width:250},
               {field:'kd_lokasi',title:'Kode Unit',width:100},  
               {field:'nm_lokasi',title:'Nama Unit',width:250}    
            ]],  
       onSelect:function(rowIndex,rowData){
          // if (lcstatus == 'tambah'){
           lcskpd = rowData.kd_skpd;
           lcunit = rowData.kd_lokasi;
           $("#nmskpd").attr("value",rowData.nm_skpd.toUpperCase());
           $("#uskpd").attr("value",rowData.kd_lokasi);
           $("#nmunit").attr("value",rowData.nm_lokasi.toUpperCase());
           
           if(lcstatus=='tambah'){
            ambil_nomor();
            $('#bidang').combogrid('clear');
            $('#nm_bidang').attr('value','');
            $('#kib').combogrid('clear');
            $('#nm_brg').attr('value','');
            $('#tanggal').datebox('setValue','');
            $('#peroleh').attr('value','');
            $('#terpakai').attr('value','');
            $('#dok').attr('value','');
            $('#id_barang').attr('value','');
            $('#no_reg').attr('value','');
            $('#no').attr('value','');
            $('#tgl_reg').attr('value','');
            $('#kd_bahan').attr('value','');
            $('#kd_satuan').attr('value','');
            $('#no_dokumen').attr('value','');
            $('#kd_brg').attr('value','');
            $('#nilai').attr('value','');
            $('#jumlah').attr('value','');
            $('#total').attr('value','');
            $('#merek').attr('value','');
            $('#tipe').attr('value','');
            $('#pabrik').attr('value','');
            $('#kd_warna').attr('value','');
            $('#no_rangka').attr('value','');
            $('#no_mesin').attr('value','');
            $('#no_polisi').attr('value','');
            $('#silinder').attr('value','');
            $('#no_stnk').attr('value','');
            $('#tgl_stnk').attr('value','');
            $('#no_bpkb').attr('value','');
            $('#tgl_bpkb').attr('value','');
            $('#kondisi').attr('value','');
            $('#tahun_produksi').attr('value','');
            $('#nip').attr('value','');
            $('#dasar').attr('value','');
            $('#no_sk').attr('value','');
            $('#tgl_sk').attr('value','');
            $('#keterangan').attr('value','');
            $('#kd_ruang').attr('value','');
            $('#kd_lokasi2').attr('value','');
            $('#metode').attr('value','');
            $('#kd_unit').attr('value','');
            $('#tahun').attr('value','');
            $('#nilai_sisa').attr('value','');
            $('#tgl_sp2d').attr('value','');
            $('#foto').attr('value','');

           $('#bidang').combogrid({url:'<?php echo base_url(); ?>index.php//master/ambil_bidang',
            queryParams:({gol:'02'}) });
           }                 
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
	 
	  
        
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/transaksi/ambil_kib_b_kap',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",   
        rowStyler: function(index,row){
                        if (row.jns_trans=='1' && row.sts_reklas=='SR' ){
                            return 'background-color:#07adeb ;';
                        }else if (row.jns_trans=='1' && row.sts_reklas==null ){
                            return 'background-color:#FFFFFF ;';
                        }else if (row.jns_trans=='2'){
                            return 'background-color:#00ffb5 ;';
                        }else if (row.jns_trans=='3' ){
                            return 'background-color:#cfcfcf ;';
                        }
                    },                      
        columns:[[
    	  {field:'no_bukti',
    		title:'No Bukti',
    		width:8,
            align:"left"},
       {field:'nm_skpd',title:'OPD',width:22,align:"left"}, 
      {field:'id_barang',
        title:'id_barang',
        width:40,
            align:"left",hidden:true},
      
      {field:'masa_manfaat',
        title:'masa_manfaat',
        width:40,
            align:"left",hidden:true},
      {field:'kd_skpd',
        title:'kd_skpd',
        width:15,
            align:"left",hidden:true},
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
    		width:20,
            align:"right"},
            {field:'keterangan',
    		title:'Keterangan',
    		width:40,
            align:"left"},
        {field:'jns_trans',title:'Jns Trans',width:40,align:"left",hidden:true},
        {field:'sts_reklas',title:'sts_reklas',width:40,align:"left",hidden:true},
			{field:'hapus',width:3,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus();'' />";}}

        ]],
        onSelect:function(rowIndex,rowData){
          lcidx = rowIndex;
          lcstatus        = 'edit';
          noreg = rowData.no_reg;
          no = rowData.no;
          nodok = rowData.no_dokumen;
          kdbrg  = rowData.kd_brg;
          no_bukti        = rowData.no_bukti;
          kd_skpd         = rowData.kd_skpd;
          load_detail(no_bukti,kd_skpd);
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
          lcidx 			    = rowIndex;
          judul 			    = 'Edit '; 
          lcstatus 		    = 'edit';
          no_bukti        = rowData.no_bukti;
          tgl_kap         = rowData.tgl_kap;
          no_reg          = rowData.no_reg;
          id_barang       = rowData.id_barang;
          no              = rowData.no;
          tgl_reg         = rowData.tgl_reg;
          no_dokumen      = rowData.no_dokumen;
          kd_brg          = rowData.kd_brg;
          nm_brg          = rowData.nm_brg;
          nilai           = rowData.nilai;
          jumlah          = rowData.jumlah;
          total           = rowData.total;
          merek           = rowData.merek;
          tipe            = rowData.tipe;
          pabrik          = rowData.pabrik;
          kd_warna        = rowData.kd_warna;
          kd_bahan        = rowData.kd_bahan;
          kd_satuan       = rowData.kd_satuan;
          no_rangka       = rowData.no_rangka;
          no_mesin        = rowData.no_mesin;
          no_polisi       = rowData.no_polisi;
          silinder        = rowData.silinder;
          no_stnk         = rowData.no_stnk;
          tgl_stnk        = rowData.tgl_stnk;
          no_bpkb         = rowData.no_bpkb;
          tgl_bpkb        = rowData.tgl_bpkb;
          kondisi         = rowData.kondisi;
          tahun_produksi  = rowData.tahun_produksi;
          nip             = rowData.nip;
          dasar           = rowData.dasar;
          no_sk           = rowData.no_sk;
          tgl_sk          = rowData.tgl_sk;
          keterangan      = rowData.keterangan;
          kd_ruang        = rowData.kd_ruang;
          kd_lokasi2      = rowData.kd_lokasi2;
          kd_skpd         = rowData.kd_skpd;
          nm_skpd         = rowData.nm_skpd;
          kd_unit         = rowData.kd_unit;
          nm_unit         = rowData.nm_unit;
          tahun           = rowData.tahun;
          metode          = rowData.metode;
          masa_manfaat    = rowData.masa_manfaat;
          nilai_sisa      = rowData.nilai_sisa;
          tgl_perolehan   = rowData.tgl_perolehan;
          hrg_perolehan   = rowData.hrg_perolehan;
          tmbh_manfaat    = rowData.tmbh_manfaat;
          persen          = rowData.persen;
          ket_kap         = rowData.ket_kap;
          bidang          = rowData.bidang;
          nm_bidang       = rowData.nm_bidang;
          total_oleh_kap  = rowData.total_oleh_kap;
          jns_trans       = rowData.jns_trans;
          sts_reklas      = rowData.sts_reklas;
		  get1(no_bukti,tgl_kap,no_reg,id_barang,no,tgl_reg,no_dokumen,kd_brg,nm_brg,nilai,jumlah,total,merek,tipe,pabrik,kd_warna,kd_bahan,kd_satuan,no_rangka,no_mesin,no_polisi,silinder,no_stnk,tgl_stnk,no_bpkb,tgl_bpkb,kondisi,tahun_produksi,nip,dasar,no_sk,tgl_sk,keterangan,kd_ruang,kd_lokasi2,kd_skpd,nm_skpd,kd_unit,nm_unit,tahun,metode,masa_manfaat,nilai_sisa,tgl_perolehan,hrg_perolehan,tmbh_manfaat,persen,ket_kap,bidang,nm_bidang,total_oleh_kap,jns_trans);  
      load_detail(no_bukti,kd_skpd);
      if(jns_trans=='1' && sts_reklas=='SR'){
          $('#simpan').linkbutton('disable');
          $('#tambah').linkbutton('disable');
          $('#hapus').linkbutton('disable');
      }
      section2();
        }

        });

function load_detail(no_bukti,kd_skpd){
  var no_bukti = no_bukti;
  var kd_skpd  = kd_skpd;
  $(function(){
            $('#dg_detail').edatagrid({
                url: '<?php echo base_url(); ?>/index.php/transaksi/load_dkap_b',
                queryParams:({ no:no_bukti,skpd:kd_skpd }),
                 idField:'idx',
                 toolbar:"#toolbar",              
                 rownumbers:"true", 
                 fitColumns:false,
                 autoRowHeight:"false",
                 singleSelect:"true",
                 nowrap:"true",
                 onLoadSuccess:function(data){ 
                
                 },
                onSelect:function(rowIndex,rowData){
                kd  = rowIndex ;  
                idx =  rowData.idx; 
                                                         
                },
                onDblClickRow:function(rowIndex,rowData){
                    idx=rowIndex.idx;
                    nomor_bukti = rowData.nomor_bukti;
                    no_dokumen = rowData.no_dokumen;
                    kd_brg = rowData.kd_brg;
                    nm_brg = rowData.nm_brg;
                    no_sp2d = rowData.no_sp2d;
                    nilai_reke = rowData.nilai_reke;
                    kd_kegiatan = rowData.kd_kegiatan;
                    nm_kegiatan = rowData.nm_kegiatan;
                    kd_rek5 = rowData.kd_rek5;
                    nm_rek5 = rowData.nm_rek5;
                    nilkapi = rowData.nilai_kap;
                },
                 columns:[[
                     {field:'idx',title:'idx',width:100,align:'left',hidden:'true'},
                     {field:'nomor_bukti',title:'nomor_bukti',width:100,align:'left',hidden:'true'},                               
                     {field:'no_dokumen',title:'Nomor',width:200},
                     {field:'kd_brg',title:'Kode Barang',width:100},
                     {field:'nm_brg',title:'Nama Barang',width:250},
                     {field:'no_sp2d',title:'No SP2D',width:150,hidden:true},
                     {field:'nilai_reke',title:'Nilai Rekening',width:100,hidden:true},
                     {field:'kd_kegiatan',title:'Kode Kegiatan',width:100},
                     {field:'nm_kegiatan',title:'Nama Kegiatan',width:100,hidden:true},
                     {field:'kd_rek5',title:'Kode Rekening',width:100},
                     {field:'nm_rek5',title:'Nama Rekening',width:100,hidden:true},
                     {field:'nilkapi',title:'N.Kapitalisasi',width:100,align:'right'}
                     
                ]]  

            });
              
              $('#dg_detail2').edatagrid({
                //url: '<?php echo base_url(); ?>/index.php/transaksi/load_dkap_b',
                //queryParams:({ no:no_bukti,skpd:kd_skpd }),
                 idField:'idx',
                 //toolbar:"#toolbar",              
                 rownumbers:"true", 
                 fitColumns:false,
                 autoRowHeight:"false",
                 singleSelect:"true",
                 nowrap:"true",
                /* onLoadSuccess:function(data){ 
                
                 },
                onSelect:function(rowIndex,rowData){
                kd  = rowIndex ;  
                idx =  rowData.idx; 
                                                         
                },
                onDblClickRow:function(rowIndex,rowData){
                    idx=rowIndex.idx;
                    nomor_bukti = rowData.nomor_bukti;
                    no_dokumen = rowData.no_dokumen;
                    kd_brg = rowData.kd_brg;
                    nm_brg = rowData.nm_brg;
                    no_sp2d = rowData.no_sp2d;
                    nilai_reke = rowData.nilai_reke;
                    kd_kegiatan = rowData.kd_kegiatan;
                    nm_kegiatan = rowData.nm_kegiatan;
                    kd_rek5 = rowData.kd_rek5;
                    nm_rek5 = rowData.nm_rek5;
                    nilkapi = rowData.nilai_kap;
                },*/
                 columns:[[
                     {field:'idx',title:'idx',width:100,align:'left',hidden:'true'},
                     {field:'nomor_bukti',title:'nomor_bukti',width:100,align:'left',hidden:'true'},                               
                     {field:'no_dokumen',title:'Nomor',width:200},
                     {field:'kd_brg',title:'Kode Barang',width:100},
                     {field:'nm_brg',title:'Nama Barang',width:250},
                     {field:'no_sp2d',title:'No SP2D',width:150,hidden:true},
                     {field:'nilai_reke',title:'Nilai Rekening',width:100,hidden:true},
                     {field:'kd_kegiatan',title:'Kode Kegiatan',width:100},
                     {field:'nm_kegiatan',title:'Nama Kegiatan',width:100,hidden:true},
                     {field:'kd_rek5',title:'Kode Rekening',width:100},
                     {field:'nm_rek5',title:'Nama Rekening',width:100,hidden:true},
                     {field:'nilkapi',title:'N.Kapitalisasi',width:100,align:'right'},
                     {field:'hapus',width:30,align:'center',formatter:function(value,rec)
                     {return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus_detail_kap();''/>";}}
                     
                ]]  

            });

        });
    
    $('#dg_detail').edatagrid('unselectAll');
}
$('#bidang').combogrid({  
            panelWidth:550, 
            idField:'bidang',  
            textField:'bidang',              
            mode:'remote',            
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               
               {field:'bidang',title:'Kode Barang',width:100},  
               {field:'nm_bidang',title:'Nama Barang',width:500}
            ]],  
             onSelect:function(rowIndex,rowData){
                bidang=rowData.bidang;
                nmbidang=rowData.nm_bidang;
                if(sts_inp==1){
                  jns_trans='1';
                } else if(sts_inp==2){
                  jns_trans='2';
                }else{
                  jns_trans='3';
                }
                var skpd = $('#skpd').combogrid('getValue');
                var unit =document.getElementById('uskpd').value;
                $('#nm_bidang').attr('value',nmbidang);
                if(lcstatus =='tambah'){
                  $('#kib').combogrid("clear");
                  $('#nm_brg').attr('value',''); 
                  $('#peroleh').attr('value','');
                  $('#terpakai').attr('value','');
                  $('#tanggal').datebox('clear');

                  $('#id_barang').attr('value','');
                  $('#no_reg').attr('value','');
                  $('#no').attr('value','');
                  $('#tgl_reg').attr('value','');
                  $('#kd_bahan').attr('value','');
                  $('#kd_satuan').attr('value','');
                  $('#no_dokumen').attr('value','');
                  $('#kd_brg').attr('value','');
                  $('#nilai').attr('value','');
                  $('#jumlah').attr('value','');
                  $('#total').attr('value','');
                  $('#merek').attr('value','');
                  $('#tipe').attr('value','');
                  $('#pabrik').attr('value','');
                  $('#kd_warna').attr('value','');
                  $('#no_rangka').attr('value','');
                  $('#no_mesin').attr('value','');
                  $('#no_polisi').attr('value','');
                  $('#silinder').attr('value','');
                  $('#no_stnk').attr('value','');
                  $('#tgl_stnk').attr('value','');
                  $('#no_bpkb').attr('value','');
                  $('#tgl_bpkb').attr('value','');
                  $('#kondisi').attr('value','');
                  $('#tahun_produksi').attr('value','');
                  $('#nip').attr('value','');
                  $('#dasar').attr('value','');
                  $('#no_sk').attr('value','');
                  $('#tgl_sk').attr('value','');
                  $('#keterangan').attr('value','');
                  $('#kd_ruang').attr('value','');
                  $('#kd_lokasi2').attr('value','');
                  $('#metode').attr('value','');
                  $('#kd_unit').attr('value','');
                  $('#tahun').attr('value','');
                  $('#nilai_sisa').attr('value','');
                  $('#tgl_sp2d').attr('value','');
                  $('#foto').attr('value','');
                  $('#kib').combogrid({url:'<?php echo base_url(); ?>index.php/transaksi/kib_b_kap',
                queryParams:({bidang:bidang,skpd:skpd,unit:unit,jns_trans:jns_trans})});
                }
                
                //$('#kib').combogrid('grid').datagrid('reload');
                
                            
        }  
    });
       
	   $('#kib').combogrid({  
            panelWidth:870,  
            panelHeight:400, 
            //width:160, 
            idField:'kd_brg',  
            textField:'kd_brg',
            loadMsg:"Tunggu Sebentar....!!",              
            mode:'remote',            
			//url:'<?php echo base_url(); ?>index.php/transaksi/kib_b_kap',
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kd_brg',title:'Kode Aset',width:80,align:"center"}, 
               {field:'no_reg',title:'No Register',width:100,align:"center"}, 
               {field:'nm_brg',title:'Nama Aset',width:200,align:"left"},
               {field:'nilai1',title:'Harga',width:80,align:"right"},   
               {field:'merek',title:'Merek',width:80,align:"left"},  
               {field:'no_polisi',title:'No POL',width:80,align:"center"},  
               {field:'tahun',title:'Tahun',width:50,align:"right",align:"center"},
               {field:'keterangan',title:'Keterangan',width:240}     
            ]],  
           onSelect:function(rowIndex,rowData){
						            $('#no_reg').attr('value',rowData.no_reg);
						            $('#id_barang').attr('value',rowData.id_barang);
                        $('#no').attr('value',rowData.no); 
                        $('#tgl_reg').attr('value',rowData.tgl_reg);  
						            $('#nm_brg').attr('value',rowData.nm_brg);
                        $('#kd_brg').attr('value',rowData.kd_brg);
                        $('#nilai').attr('value',rowData.nilai);
                        $('#jumlah').attr('value',rowData.jumlah);
                        $('#total').attr('value',rowData.total);
                        $('#merek').attr('value',rowData.merek);
                        $('#tipe').attr('value',rowData.tipe);
                        $('#pabrik').attr('value',rowData.pabrik);
                        $('#kd_warna').attr('value',rowData.kd_warna);
                        $('#kd_bahan').attr('value',rowData.kd_bahan);
                        $('#kd_satuan').attr('value',rowData.kd_satuan);
                        $('#no_rangka').attr('value',rowData.no_rangka);
                        $('#no_mesin').attr('value',rowData.no_mesin);
                        $('#no_polisi').attr('value',rowData.no_polisi);
                        $('#silinder').attr('value',rowData.silinder);
                        $('#no_stnk').attr('value',rowData.no_stnk);
                        $('#tgl_stnk').attr('value',rowData.tgl_stnk);
                        $('#no_bpkb').attr('value',rowData.no_bpkb);
                        $('#tgl_bpkb').attr('value',rowData.tgl_bpkb);
                        $('#kondisi').attr('value',rowData.kondisi);
                        $('#tahun_produksi').attr('value',rowData.tahun_produksi);
                        $('#nip').attr('value',rowData.nip);
                        $('#dasar').attr('value',rowData.dasar);
                        $('#no_sk').attr('value',rowData.no_sk);
                        $('#tgl_sk').attr('value',rowData.tgl_sk);
                        $('#keterangan').attr('value',rowData.keterangan);
                        $('#tahun').attr('value',rowData.tahun); 
                        $('#tgl_sp2d').attr('value',rowData.tgl_sp2d);
                        $('#kd_ruang').attr('value',rowData.kd_ruang);
                        $('#kd_lokasi').attr('value',rowData.kd_lokasi2);
                        $('#kd_unit').attr('value',rowData.kd_unit);
                        $('#metode').attr('value',rowData.metode);
                        $('#masa_manfaat').attr('value',rowData.masa_manfaat);
                        $('#nilai_sisa').attr('value',rowData.nilai_sisa);
                        $('#foto').attr('value',rowData.foto);
                        $('#dok').attr('value',rowData.no_dokumen);
                        $('#tanggal').datebox('setValue',rowData.tgl_oleh);
                        
                        $('#peroleh').attr('value',rowData.nilai1);
                        $('#terpakai').attr('value',rowData.masa_manfaat); 
                        susut();
				}  
		});
	   
	   
    });   



  function susut(){
    var id_b = document.getElementById('id_barang').value;
    var t = $('#tgl_kap').datebox('getValue');
    var th = t.length;
    var tahun = t.substr(0,4);
    var inp = sts_inp;
    //alert('susut'+t+'     '+id_b+'     '+tahun);
    $(document).ready(function(){
              
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>/index.php/transaksi/cek_susut',
                data: ({id_b:id_b,tahun:tahun,table:'trkib_b',sts_inp:inp}),
                dataType:"json",
                success:function(data){
                  $.each(data, function(i,n){
                  var a = n['nilai'];
                  var c = n['nil_th_ini'];
                  var f = n['th_lalu'];
                  var b = n['penyusutan_pertahun'];
                  var g = n['umur'];
                  var d = a-c;
                  var e = a-b;//alert(e);
                  if(sts_inp==1 || sts_inp==3){
                    $('#peroleh').attr('value',number_format(a,2,'.',','));
                    $('#terpakai').attr('value',g);
                    $('#persen').attr('value','');
                    $('#tambah_umur').attr('value','');
                    //hitung();
                  }else{
                    $('#peroleh').attr('value',number_format(d,2,'.',','));
                    $('#terpakai').attr('value',f);
                    hitung();
                  }
                  
                
              }); 
              } 
              });
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
					alert(e);
				}
			}
		)
		return false;
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
	
    function get1(no_bukti,tgl_kap,no_reg,id_barang,no,tgl_reg,no_dokumen,kd_brg,nm_brg,nilai,jumlah,total,merek,tipe,pabrik,kd_warna,kd_bahan,kd_satuan,no_rangka,no_mesin,no_polisi,silinder,no_stnk,tgl_stnk,no_bpkb,tgl_bpkb,kondisi,tahun_produksi,nip,dasar,no_sk,tgl_sk,keterangan,kd_ruang,kd_lokasi2,kd_skpd,nm_skpd,kd_unit,nm_unit,tahun,metode,masa_manfaat,nilai_sisa,tgl_perolehan,hrg_perolehan,tmbh_manfaat,persen,ket_kap,bidang,nm_bidang,total_oleh_kap,jns_trans){
	         $('#nomor_bukti').attr('value',no_bukti);
           $('#skpd').combogrid('setValue',kd_skpd);
           $('#skpd').combogrid('disable');
           $('#nmskpd').attr('value',nm_skpd);
           $('#uskpd').attr('value',kd_unit);
           $('#nmunit').attr('value',nm_unit);
           $('#tgl_kap').datebox('setValue',tgl_kap);
           $('#tgl_kap').datebox('disable');
           $('#kib').combogrid('setValue',kd_brg);
           $('#kib').combogrid('disable');
           $('#nm_brg').attr('value',nm_brg);
           $('#dok').attr('value',no_dokumen);
           $('#tanggal').datebox('setValue',tgl_perolehan);
           $('#tanggal').datebox('disable');
           $('#peroleh').attr('value',hrg_perolehan);
           $('#terpakai').attr('value',masa_manfaat);
           $('#persen').attr('value',number_format(persen,2,'.',','));
           $('#tambah_umur').attr('value',tmbh_manfaat);
           $('#keterangan_kap').attr('value',ket_kap);
           $('#id_barang').attr('value',id_barang);
           $('#no_reg').attr('value',no_reg);
           $('#no').attr('value',no);
           $('#tgl_reg').attr('value',tgl_reg);
           $('#kd_bahan').attr('value',kd_bahan);
           $('#kd_satuan').attr('value',kd_satuan);
           $('#no_dokumen').attr('value',no_dokumen);
           $('#kd_brg').attr('value',kd_brg);
           $('#jumlah').attr('value',jumlah);
           $('#total').attr('value',total);
           $('#merek').attr('value',merek);
           $('#tipe').attr('value',tipe);
           $('#pabrik').attr('value',pabrik);
           $('#kd_warna').attr('value',kd_warna);
           $('#no_rangka').attr('value',no_rangka);
           $('#no_mesin').attr('value',no_mesin);
           $('#no_polisi').attr('value',no_polisi);
           $('#silinder').attr('value',silinder);
           $('#no_stnk').attr('value',no_stnk);
           $('#tgl_stnk').attr('value',tgl_stnk);
           $('#no_bpkb').attr('value',no_bpkb);
           $('#tgl_bpkb').attr('value',tgl_bpkb);
           $('#kondisi').attr('value',kondisi);
           $('#tahun_produksi').attr('value',tahun_produksi);
           $('#dasar').attr('value',dasar);
           $('#no_sk').attr('value',no_sk);
           $('#tgl_sk').datebox('setValue',tgl_sk);
           $('#keterangan').attr('value',keterangan);
           $('#kd_ruang').attr('value',kd_ruang);
           $('#kd_lokasi2').attr('value',kd_lokasi2);
           $('#metode').attr('value',metode);
           $('#kd_unit').attr('value',kd_unit);
           $('#tahun').attr('value',tahun);
           $('#nilai_sisa').attr('value',nilai_sisa);
           $('#bidang').combogrid('setValue',bidang);
           $('#bidang').combogrid('disable');
           $('#nm_bidang').attr('value',nm_bidang);
           $('#total_h').attr('value',total_oleh_kap);
           if(jns_trans=='1'){
              $('#pelihara1').prop('checked', true);
              $('#pelihara2').prop('checked', false);
              $('#pelihara3').prop('checked', false);
              $('#pelihara1').prop('disabled', true);
              $('#pelihara2').prop('disabled', true);
              $('#pelihara3').prop('disabled', true);
              sts_inp=jns_trans;
              //$('#pelihara').flatcheckbox('label','Kapitalisasi KIB (522,523)');
            }else if(jns_trans=='2'){
              $('#pelihara1').prop('checked', false);
              $('#pelihara2').prop('checked', true);
              $('#pelihara3').prop('checked', false);
              $('#pelihara1').prop('disabled', true);
              $('#pelihara2').prop('disabled', true);
              $('#pelihara3').prop('disabled', true);
              sts_inp=jns_trans;
              //$('#pelihara').flatcheckbox('label','Pemeliharaan');
              //$('#pelihara').prop('unCheck');
            }else{
              $('#pelihara1').prop('checked', false);
              $('#pelihara2').prop('checked', false);
              $('#pelihara3').prop('checked', true);
              $('#pelihara1').prop('disabled', true);
              $('#pelihara2').prop('disabled', true);
              $('#pelihara3').prop('disabled', true);
              sts_inp=jns_trans;
            }
                
    }
     function  cokot(foto){
           
         //  test ="<?php echo base_url(); ?>"+foto
//           alert(test);
           $("#foto").attr("src","<?php echo base_url(); ?>data/"+foto);
           $("#foto1").attr("src","<?php echo base_url(); ?>data/"+foto);
    }
    function kosong(){
        lcstatus = 'tambah';
	      cdate = '<?php echo date("Y-m-d"); ?>';
        $('#skpd').combogrid('enable');
           $('#tgl_kap').datebox('enable');
           $('#kib').combogrid('enable');
           $('#bidang').combogrid('enable');
           $('#tambah').linkbutton('enable');
           $('#hapus').linkbutton('enable');
           $('#nomor_bukti').attr('value','');
           $('#skpd').combogrid('clear');
           $('#skpd').combogrid('grid').datagrid('reload');
           $('#nmskpd').attr('value','');
           $('#uskpd').attr('value','');
           $('#nmunit').attr('value','');
           $('#tgl_kap').datebox('setValue',cdate);
           $('#kib').combogrid('clear');
           $('#nm_brg').attr('value','');
           $('#dok').attr('value','');
           $('#tanggal').datebox("disable",true);
           $('#tanggal').datebox("clear");
           $('#peroleh').attr('value','');
           $('#terpakai').attr('value','');
           $('#persen').attr('value','');
           $('#tambah_umur').attr('value','');
           $('#keterangan_kap').attr('value','');
           $('#id_barang').attr('value','');
           $('#no_reg').attr('value','');
           $('#no').attr('value','');
           $('#tgl_reg').attr('value','');
           $('#kd_bahan').attr('value','');
           $('#kd_satuan').attr('value','');
           $('#no_dokumen').attr('value','');
           $('#kd_brg').attr('value','');
           $('#jumlah').attr('value','');
           $('#total').attr('value','');
           $('#merek').attr('value','');
           $('#tipe').attr('value','');
           $('#pabrik').attr('value','');
           $('#kd_warna').attr('value','');
           $('#no_rangka').attr('value','');
           $('#no_mesin').attr('value','');
           $('#no_polisi').attr('value','');
           $('#silinder').attr('value','');
           $('#no_stnk').attr('value','');
           $('#tgl_stnk').attr('value','');
           $('#no_bpkb').attr('value','');
           $('#tgl_bpkb').attr('value','');
           $('#kondisi').attr('value','');
           $('#tahun_produksi').attr('value','');
           $('#dasar').attr('value','');
           $('#no_sk').attr('value','');
           $('#tgl_sk').datebox('setValue','');
           $('#keterangan').attr('value','');
           $('#kd_ruang').attr('value','');
           $('#kd_lokasi2').attr('value','');
           $('#metode').attr('value','');
           $('#kd_unit').attr('value','');
           $('#tahun').attr('value','');
           $('#nilai_sisa').attr('value','');
           $('#bidang').combogrid('clear');
           $('#nm_bidang').attr('value','');
           $('#total_h').attr('value','0.00');
           $('#pelihara1').prop('disabled', false);
           $('#pelihara2').prop('disabled', false);
           $('#pelihara3').prop('disabled', false);
           $('#pelihara1').prop('checked', true);
           $('#simpan').linkbutton('enable');
           $('#tambah').linkbutton('enable');
           $('#hapus').linkbutton('enable');
           //sts_inp=1;
           
        set_grid();
		
		document.getElementById("p1").innerHTML="";
    }

    function cari(zz){
    //var kriteria = document.getElementById("txtcari").value; 
    
    $(function(){
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/transaksi/ambil_kib_b_kap',
        queryParams:({cari:zz})
        });        
     });
    }
    

     function gambar(lf){
        
        lcfoto = 'foto'+lf;
        document.getElementById("fotoZ").src =  document.getElementById(lcfoto).src;
        $("#dialog-modal_gambar").dialog('open');             
    }
    
    function simpan(){
						var bukti       = document.getElementById('nomor_bukti').value; 
            var skpd        = $('#skpd').combogrid('getValue');
            var nm_skpd     = document.getElementById('nmskpd').value; 
            var unit        = document.getElementById('uskpd').value; 
            var nm_unit     = document.getElementById('nmunit').value; 
            var tgl_kap     = $('#tgl_kap').datebox('getValue');
            var bidang      = $('#bidang').combogrid('getValue');
            var nmbidang    = document.getElementById('nm_bidang').value; 
            var kd_brg      = $('#kib').combogrid('getValue');
            var nm_brg      = document.getElementById('nm_brg').value; 
            var dok_oleh    = document.getElementById('dok').value; 
            var tgl_oleh    = $('#tanggal').datebox('getValue');
            var nilai_oleh  = angka(document.getElementById('peroleh').value); 
            var terpakai    = document.getElementById('terpakai').value; 
            var persen      = angka(document.getElementById('persen').value); 
            var tambah_umur = document.getElementById('tambah_umur').value; 
            var ket_kap     = document.getElementById('keterangan_kap').value; 
            var id_b        = document.getElementById('id_barang').value; 
            var no_reg      = document.getElementById('no_reg').value; 
            var no          = document.getElementById('no').value; 
            var tgl_reg     = document.getElementById('tgl_reg').value;
            var bahan       = document.getElementById('kd_bahan').value; 
            var satuan      = document.getElementById('kd_satuan').value; 
            var juml        = document.getElementById('jumlah').value; 
            var total       = document.getElementById('total').value; 
            var merek       = document.getElementById('merek').value; 
            var tipe        = document.getElementById('tipe').value; 
            var pabrik      = document.getElementById('pabrik').value; 
            var warna       = document.getElementById('kd_warna').value; 
            var rangka      = document.getElementById('no_rangka').value; 
            var mesin       = document.getElementById('no_mesin').value; 
            var nopol       = document.getElementById('no_polisi').value; 
            var silinder    = document.getElementById('silinder').value; 
            var stnk        = document.getElementById('no_stnk').value; 
            var tgl_stnk    = document.getElementById('tgl_stnk').value; 
            var bpkb        = document.getElementById('no_bpkb').value; 
            var tgl_bpkb    = document.getElementById('tgl_bpkb').value;
            var kondisi     = document.getElementById('kondisi').value; 
            var t_produksi  = document.getElementById('tahun_produksi').value; 
            var nip         = document.getElementById('nip').value; 
            var dasar       = document.getElementById('dasar').value; 
            var sk          = document.getElementById('no_sk').value; 
            var tgl_sk      = $('#tgl_sk').datebox('getValue');
            var ket_oleh    = document.getElementById('keterangan').value; 
            var ruang       = document.getElementById('kd_ruang').value; 
            var lokasi      = document.getElementById('kd_lokasi2').value; 
            var metode      = document.getElementById('metode').value; 
            var tahun       = document.getElementById('tahun').value; 
            var nil_sisa    = document.getElementById('nilai_sisa').value;
            var total_kap   = angka(document.getElementById('total_h').value); 
            var total_sel   = total_kap+nilai_oleh;
            var tambah_masa = angka(terpakai)+angka(tambah_umur);
            $('#dg_detail').edatagrid('selectAll');
            var rows = $('#dg_detail').edatagrid('getSelections'); 

            if(rows.length==''){
              alert('Detail Tidak Boleh Kosong');
              $('#dg_detail').edatagrid('unselectAll');
              exit();
            }

            if(sts_inp==1){
              jns_trans='1';
            } else if(sts_inp==2){
              jns_trans='2';
            }else{
              jns_trans='3';
            }
				
			//lcinsert = '(no_reg,id_barang,no,tgl_reg,no_dokumen,kd_brg,nilai,jumlah,total,merek,tipe,pabrik,kd_warna,kd_bahan,kd_satuan,no_rangka,no_mesin,no_polisi,silinder,no_stnk,tgl_stnk,no_bpkb,tgl_bpkb,kondisi,tahun_produksi,nip,dasar,no_sk,tgl_sk,keterangan,kd_ruang,kd_lokasi2,kd_unit,tahun,tgl_sp2d,foto,tgl_perolehan,hrg_perolehan,tmbh_manfaat)';
   
			if (skpd==''){
				alert('Kode OPD Tidak Boleh Kosong');
				exit();
			} 
			
			if (kd_brg==''){
				alert('Kode Barang Tidak Boleh Kosong');
				exit();
			} 
			
		//if(lcstatus=='tambah'){ 
		//lcvalues = "('"+no_reg+"','"+id_barang+"','"+no+"','"+tgl_reg+"','"+no_dokumen+"','"+kd_brg+"','"+nilai+"','"+jumlah+"','"+total+"','"+merek+"','"+tipe+"','"+pabrik+"','"+kd_warna+"','"+kd_bahan+"','"+kd_satuan+"','"+no_rangka+"','"+no_mesin+"','"+no_polisi+"','"+silinder+"','"+no_stnk+"','"+tgl_stnk+"','"+no_bpkb+"','"+tgl_bpkb+"','"+kondisi+"','"+tahun_produksi+"','"+nip+"','"+dasar+"','"+no_sk+"','"+tgl_sk+"','"+keterangan+"','"+kd_ruang+"','"+kd_lokasi2+"','"+kd_unit+"','"+tahun+"','"+tgl_sp2d+"','"+foto+"','"+tgl_perolehan+"','"+peroleh+"','"+tmbh_manfaat+"')";
			
			$(document).ready(function(){
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>index.php/transaksi/simpan_trkib_b_kap',
                    data: ({tabel:'trkib_b_kap',

                      bukti       :bukti,
                      skpd        :skpd,
                      nm_skpd     :nm_skpd,
                      unit        :unit,
                      nm_unit     :nm_unit,
                      tgl_kap     :tgl_kap,
                      bidang      :bidang,
                      nmbidang    :nmbidang,
                      kd_brg      :kd_brg,
                      nm_brg      :nm_brg,
                      dok_oleh    :dok_oleh,
                      tgl_oleh    :tgl_oleh,
                      nilai_oleh  :nilai_oleh,
                      terpakai    :terpakai,
                      persen      :persen,
                      tambah_umur :tambah_umur,
                      ket_kap     :ket_kap,
                      id_b        :id_b,
                      no_reg      :no_reg,
                      no          :no,
                      tgl_reg     :tgl_reg,
                      bahan       :bahan,
                      satuan      :satuan,
                      juml        :juml,
                      total       :total,
                      merek       :merek,
                      tipe        :tipe,
                      pabrik      :pabrik,
                      warna       :warna,
                      rangka      :rangka,
                      mesin       :mesin,
                      nopol       :nopol,
                      silinder    :silinder,
                      stnk        :stnk,
                      tgl_stnk    :tgl_stnk,
                      bpkb        :bpkb,
                      tgl_bpkb    :tgl_bpkb,
                      kondisi     :kondisi,
                      t_produksi  :t_produksi,
                      nip         :nip,
                      dasar       :dasar,
                      sk          :sk,
                      tgl_sk      :tgl_sk,
                      ket_oleh    :ket_oleh,
                      ruang       :ruang,
                      lokasi      :lokasi,
                      metode      :metode,
                      tahun       :tahun,
                      nil_sisa    :nil_sisa,
                      total_kap   :total_kap,
                      total_sel   :total_sel,
                      tambah_masa :tambah_masa,
                      jns_trans   :jns_trans
                  }),
                    dataType:"json",
                    success:function(data){
                    status = data.pesan;     
                        if (status=='1'){  
                          simpan_trdkapb_dh();
                        }else{ 
                          swal("Oops...", "Something went wrong!", "error");
                        }        
                    }
                });
            });                

        /*}else{

            lcquery = " UPDATE trkib_b_kap SET merek='"+merek+"',tipe='"+tipe+"',pabrik='"+pabrik+"',kd_warna='"+warna+"',kd_bahan='"+bahan+"',kd_satuan='"+satuan+"',no_rangka='"+norangka+"',no_mesin='"+nomesin+"',no_polisi='"+nopolisi+"',silinder='"+silinder+"',no_stnk='"+nostnk+"',tgl_stnk='"+tglstnk+"',no_bpkb='"+nobpkb+"',tgl_bpkb='"+tglbpkb+"',kondisi='"+kondisi+"',tahun_produksi='"+thnbuat+"',nip='"+pengguna+"',dasar='"+dasar+"',no_sk='"+no_sk+"',tgl_sk='"+tgl_sk+"',keterangan='"+keterangan+"',nilai='"+hrg1+"',total='"+hrg1+"',foto='"+file_gbr+"',metode='"+metode+"',masa_manfaat='"+masa_manfaat+"',nilai_sisa='"+nilai_sisa+"' where no='"+no_key+"'";
			
            $(document).ready(function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>index.php/transaksi/update_trkib_b_kap',
                data: ({st_query:lcquery}),
                dataType:"json"
            });
            });
			
        }*/

        /*alert("Data Berhasil disimpan");
        $("#dialog-modal").dialog('close');
        $('#dg').edatagrid('reload');*/
        
    } 

    function simpan_trdkapb_dh(){
          if(sts_inp==1){
              jns_trans='1';
            } else if(sts_inp==2){
              jns_trans='2';
            }else{
              jns_trans='3';
            }
      var bukti       = document.getElementById('nomor_bukti').value;
      var skpd        = $('#skpd').combogrid('getValue');
      var unit        = document.getElementById('uskpd').value; 
      var id_b        = document.getElementById('id_barang').value; 
      var csql        = '';
      var gab         = '';
      var xdok        = '';
      var xsp2d       = '';
      var xgiat       = '';
      var xrek        = '';
      $('#dg_detail').edatagrid('selectAll');
      var rows = $('#dg_detail').edatagrid('getSelections');
        for(var p=0;p<rows.length;p++){
              nomor_bukti    = bukti;
              skpd           = skpd;
              unit           = unit;
              id_b           = id_b;
              no_dokumen     = rows[p].no_dokumen;
              kd_brg         = rows[p].kd_brg;
              nm_brg         = rows[p].nm_brg;
              no_sp2d        = rows[p].no_sp2d;
              nilai_reke     = angka(rows[p].nilai_reke);
              kd_kegiatan    = rows[p].kd_kegiatan;
              nm_kegiatan    = rows[p].nm_kegiatan;
              kd_rek5        = rows[p].kd_rek5;
              nm_rek5        = rows[p].nm_rek5;
              nilkapi        = angka(rows[p].nilkapi);

              xdok           = rows[p].no_dokumen;
              xsp2d          = rows[p].no_sp2d;
              xgiat          = rows[p].kd_kegiatan;
              xrek           = rows[p].kd_rek5;

                             
                if(p>0){ 
                    csql = csql+","+"('"+nomor_bukti+"','"+skpd+"','"+unit+"','"+id_b+"','"+no_dokumen+"','"+no_sp2d+"','"+kd_kegiatan+"','"+nm_kegiatan+"','"+kd_rek5+"','"+nm_rek5+"','"+kd_brg+"','"+nm_brg+"','"+nilai_reke+"','"+nilkapi+"')";
                } else {
                    csql = "values('"+nomor_bukti+"','"+skpd+"','"+unit+"','"+id_b+"','"+no_dokumen+"','"+no_sp2d+"','"+kd_kegiatan+"','"+nm_kegiatan+"','"+kd_rek5+"','"+nm_rek5+"','"+kd_brg+"','"+nm_brg+"','"+nilai_reke+"','"+nilkapi+"')";                                            
                } 

                if ( p > 0 ){   
                  gab = gab+','+"'"+xdok+"."+xsp2d+"."+xgiat+"."+xrek+"'";
              } else {
                  gab = "'"+xdok+"."+xsp2d+"."+xgiat+"."+xrek+"'";
              }
        }
                $(document).ready(function(){
                $.ajax({
                    type: "POST", 
                    dataType:'json', 
                    url: '<?php echo base_url(); ?>/index.php/transaksi/simpan_trkib_b_kap',   
                    data: ({tabel:'trdkibb_kap',bukti:nomor_bukti,skpd:skpd,unit:unit,id_b:id_b,sql:csql,gab:gab,jns_trans:jns_trans}),
                    
                    success:function(data){
                        status=data.pesan;
                        if(status=='1'){
                            //$("#dialog-modal-aaa").dialog('close');
                            $('#dg_detail').edatagrid('unselectAll');
                        swal({
                            title: "Berhasil",
                            text: "Data telah disimpan.!!",
                            imageUrl:"<?php echo base_url();?>/lib/images/biak.jpg"
                            });
                            keluar();
                            $("#dg").edatagrid("reload");
                        }else{
                            //$('#c_simpan').linkbutton("enable");
                            //$("#dialog-modal-aaa").dialog('close');
                            swal({
                                title: "Oooopppppsssssssss!!!!!!!!!!",
                                text: "Data Gagal disimpan.!!",
                                imageUrl:"<?php echo base_url();?>/lib/images/er.jpg"
                                });
                        }   
                    }                                        
                });
            });
    }
    
      function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data KIB B Kapitalisasi';
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
        document.getElementById("noreg").disabled=true;
        document.getElementById("noreg").focus();
        } 
     function keluar_det(){
        $("#dialog-modal_det").dialog('close');
        $('#dg_detail2').edatagrid('reload');
        kosong_det();
       
     } 
     
         
    
     function hapus(){
      var rows  = $('#dg').datagrid('getSelected');
      var skpd  = rows.kd_skpd;
      var bukti = rows.no_bukti;
      var id_b  = rows.id_barang;
      var manf  = rows.masa_manfaat;
      var nilai = angka(rows.hrg_perolehan);
      var jns_trans = rows.jns_trans;
      var sts_reklas=rows.sts_reklas;

      if(jns_trans=='1' && sts_reklas=='SR'){
        sweetAlert("Tidak Dapat Dihapus", "Data Telah Di-Reklas", "error");
        exit();        
      }else{
        var del=confirm('Apakah Anda yakin ingin Menhapus data '+bukti+', SKPD '+skpd+'?');
      }
      
		
		if (del==true){     
        var urll = '<?php echo base_url(); ?>index.php/transaksi/hapus_trkib_b_kap_dh';
        $(document).ready(function(){
         $.post(urll,({skpd:skpd,bukti:bukti,id_b:id_b,manf:manf,nilai:nilai,jns_trans:jns_trans}),function(data){
            status = data;
            if (status=='0'){
                alert('Gagal Hapus..!!');
                exit();
            } else {
                $('#dg').datagrid('reload');   
                alert('Data Berhasil Dihapus..!!');
                exit();
            }
         });
        });    }
    } 
	
    function nomer_akhir(){
        var i = 0;
        var tabel ='trkib_b_kap'
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

  function section2(){
         $(document).ready(function(){                
             $('#section2').click(); 
                
         });    
     }

 function keluar(){
     $(document).ready(function(){    
         $('#section1').click(); 
         $('#dg').datagrid('reload');
     });
 kosong();
}

$('#dg_detail').edatagrid({                
            toolbar:'#toolbar',       
            idField:"idx",            
            rownumbers:"true",            
            singleSelect:"true",
            autoRowHeight:"false",             
            loadMsg:"Tunggu Sebentar....!!",            
            nowrap:"true",
            onSelect:function(rowIndex,rowData){                    
                    idx = rowIndex;
                    //nilx = rowData.nilai;
            },
        columns:[[
             {field:'idx',title:'idx',width:100,align:'left',hidden:'true'},
             {field:'nomor_bukti',title:'nomor_bukti',width:100,align:'left',hidden:'true'},                               
             {field:'no_dokumen',title:'Nomor',width:200},
             {field:'kd_brg',title:'Kode Barang',width:100},
             {field:'nm_brg',title:'Nama Barang',width:250},
             {field:'no_sp2d',title:'No SP2D',width:150,hidden:true},
             {field:'nilai_reke',title:'Nilai Rekening',width:100,hidden:true},
             {field:'kd_kegiatan',title:'Kode Kegiatan',width:100},
             {field:'nm_kegiatan',title:'Nama Kegiatan',width:100,hidden:true},
             {field:'kd_rek5',title:'Kode Rekening',width:100},
             {field:'nm_rek5',title:'Nama Rekening',width:100,hidden:true},
             {field:'nilkapi',title:'N.Kapitalisasi',width:100,align:'right'}
            ]]
        
    });
function set_grid(){
    //$(function(){
    $('#dg_detail').edatagrid({                
            toolbar:'#toolbar',       
            idField:"idx",            
            rownumbers:"true",            
            singleSelect:"true",
            autoRowHeight:"false",             
            loadMsg:"Tunggu Sebentar....!!",            
            nowrap:"true",
            url: '<?php echo base_url(); ?>/index.php/transaksi/load_dkap_b',
            queryParams:({ no:'',skpd:'' }),
            onSelect:function(rowIndex,rowData){                    
                    idx = rowIndex;
                    //nilx = rowData.nilai;
            },
        columns:[[
             {field:'idx',title:'idx',width:100,align:'left',hidden:'true'},
             {field:'nomor_bukti',title:'nomor_bukti',width:100,align:'left',hidden:'true'},                               
             {field:'no_dokumen',title:'Nomor',width:200},
             {field:'kd_brg',title:'Kode Barang',width:100},
             {field:'nm_brg',title:'Nama Barang',width:250},
             {field:'no_sp2d',title:'No SP2D',width:150,hidden:true},
             
             {field:'nilai_reke',title:'Nilai Rekening',width:100,hidden:true},
             {field:'kd_kegiatan',title:'Kode Kegiatan',width:100},
             {field:'nm_kegiatan',title:'Nama Kegiatan',width:100,hidden:true},
             {field:'kd_rek5',title:'Kode Rekening',width:100},
             {field:'nm_rek5',title:'Nama Rekening',width:100,hidden:true},
             {field:'nilkapi',title:'N.Kapitalisasi',width:100,align:'right'}
            ]]
    });
   }

$('#dg_detail2').edatagrid({                
            
        columns:[[
             {field:'idx',title:'idx',width:100,align:'left',hidden:'true'},
             {field:'nomor_bukti',title:'nomor_bukti',width:100,align:'left',hidden:'true'},                               
             {field:'no_dokumen',title:'Nomor',width:200},
             {field:'kd_brg',title:'Kode Barang',width:100},
             {field:'nm_brg',title:'Nama Barang',width:250},
             {field:'no_sp2d',title:'No SP2D',width:150,hidden:true},
             
             {field:'nilai_reke',title:'Nilai Rekening',width:100,hidden:true},
             {field:'kd_kegiatan',title:'Kode Kegiatan',width:100},
             {field:'nm_kegiatan',title:'Nama Kegiatan',width:100,hidden:true},
             {field:'kd_rek5',title:'Kode Rekening',width:100},
             {field:'nm_rek5',title:'Nama Rekening',width:100,hidden:true},
             {field:'nilkapi',title:'N.Kapitalisasi',width:100,align:'right'},
             {field:'hapus',width:30,align:'center',formatter:function(value,rec)
             {return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus_detail_kap();''/>";}}
            ]]
        
    });
function set_grid2(){
    //$(function(){
    $('#dg_detail2').edatagrid({                
            
        columns:[[
             {field:'idx',title:'idx',width:100,align:'left',hidden:'true'},
             {field:'nomor_bukti',title:'nomor_bukti',width:100,align:'left',hidden:'true'},                               
             {field:'no_dokumen',title:'Nomor',width:200},
             {field:'kd_brg',title:'Kode Barang',width:100},
             {field:'nm_brg',title:'Nama Barang',width:250},
             {field:'no_sp2d',title:'No SP2D',width:150,hidden:true},
             
             {field:'nilai_reke',title:'Nilai Rekening',width:100,hidden:true},
             {field:'kd_kegiatan',title:'Kode Kegiatan',width:100},
             {field:'nm_kegiatan',title:'Nama Kegiatan',width:100,hidden:true},
             {field:'kd_rek5',title:'Kode Rekening',width:100},
             {field:'nm_rek5',title:'Nama Rekening',width:100,hidden:true},
             {field:'nilkapi',title:'N.Kapitalisasi',width:100,align:'right'},
             {field:'hapus',width:30,align:'center',formatter:function(value,rec)
             {return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus_detail_kap();''/>";}}
            ]]
    });
   }

   function tambah_dkap(){
    //kosong_det();
    var bukti   = document.getElementById('nomor_bukti').value;
    var bidang  = $('#bidang').combogrid('getValue');
    var kib     = $('#kib').combogrid('getValue');
    var tgl_kap = $('#tgl_kap').datebox('getValue');
    var total_h = document.getElementById('total_h').value;
    var skpd    = $('#skpd').combogrid('getValue');
    $('#total_d').attr('value',total_h);
    $('#nilkap').attr('value','0.00');
    //$('#dg_detail2').edatagrid('reload');
      if(skpd==''){
        swal({
          title: "Kode OPD Tidak Boleh Kosong.!!",
          type:"warning"
          });
        exit();
      }
      if(bukti==''){
        swal({
          title: "Nomor Bukti Tidak Boleh Kosong!!",
          type:"warning"
          });
        exit();
      }
      if(bidang==''){
        swal({
          title: "Kode Bidang Tidak Boleh Kosong!!",
          type:"warning"
          });
        exit();
      }
      if(kib==''){
        swal({
          title: "Kode Barang Tidak Boleh Kosong!!",
          type:"warning"
          });
        exit();
      }

      if(skpd!='' && bukti!='' && bidang!='' && kib!=''){
        no_dok(); 
        $("#dialog-modal_det").dialog('open');
        
        load_detail2();

      }

    
    
    //$('#dg_detail2').edatagrid('reload');
    

    
    
   }


   function load_detail2(){        
       $('#dg_detail').datagrid('selectAll');
      var rows = $('#dg_detail').datagrid('getSelections');
      var jgrid = rows.length; 
       if (jgrid==0){
            set_grid2();
            exit();
       }                     
    for(var p=0;p<rows.length;p++){
              idx1           = rows[p].idx; 
              nomor_bukti1   = rows[p].nomor_bukti;
              no_dokumen1    = rows[p].no_dokumen;
              kd_brg1        = rows[p].kd_brg;
              nm_brg1        = rows[p].nm_brg;
              no_sp2d1       = rows[p].no_sp2d;
              nilai_reke1    = rows[p].nilai_reke;
              kd_kegiatan1   = rows[p].kd_kegiatan;
              nm_kegiatan1   = rows[p].nm_kegiatan;
              kd_rek51       = rows[p].kd_rek5;
              nm_rek51       = rows[p].nm_rek5;
              nilkapi1       = rows[p].nilkapi;

            $('#dg_detail2').datagrid('appendRow',{idx:idx1,nomor_bukti:nomor_bukti1,no_dokumen:no_dokumen1,kd_brg:kd_brg1,nm_brg:nm_brg1,no_sp2d:no_sp2d1,nilai_reke:nilai_reke1,kd_kegiatan:kd_kegiatan1,nm_kegiatan:nm_kegiatan1,kd_rek5:kd_rek51,nm_rek5:nm_rek51,nilkapi:nilkapi1});            
        }
        $('#dg_detail').edatagrid('unselectAll');
    } 

   function no_dok(){
    
    $('#dg_detail').datagrid('selectAll');
           var rows = $('#dg_detail').datagrid('getSelections');     
           frek  = '' ;
           dok  = '' ;
           rek  = '';
           for ( var p=0; p < rows.length; p++ ) { 
           dok = rows[p].no_dokumen;
           rek = rows[p].kd_rek5;                                       
           if ( p > 0 ){   
                  frek = frek+','+"'"+dok+"."+rek+"'";
              } else {
                  frek = "'"+dok+"."+rek+"'";
              }
           }

           frek2  = '' ;
           dok2  = '' ;
           rek2  = '';
           nilai = '';
    for ( var p=0; p < rows.length; p++ ) { 
               dok2 = rows[p].no_dokumen;
               rek2 = rows[p].kd_rek5;
               nilai = rows[p].nilai_reke;
                                                     
               if ( p > 0 ){   
                      frek2 = frek2+','+"'"+dok2+"."+rek2+"."+nilai+"'";
                  } else {
                      frek2 = "'"+dok2+"."+rek2+"."+nilai+"'";
                  }
               }

//alert(frek);
  if(sts_inp==1){
      jns_trans='1';
    } else if(sts_inp==2){
      jns_trans='2';
    }else{
      jns_trans='3';
    }

    var skpd = $('#skpd').combogrid('getValue');
    $(function(){
    $('#nodok').combogrid({  
       panelWidth:850,  
       idField:'no_kontrak',  
       textField:'no_kontrak',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_nomor_kontrak_kap_b',
       queryParams: ({skpd:skpd,frek:frek,jns_trans:jns_trans,frek2:frek2}) , 
       columns:[[  
                {field:'no_kontrak',title:'No Kontrak',width:200},  
                {field:'nilai2',title:'Nilai Kontrak',width:100,align:'right'},
                {field:'nm_rek5',title:'Nm Rekening',width:150,align:'left'},
                {field:'keterangan',title:'Keterangan',width:400}    
            ]], 
       onSelect:function(rowIndex,rowData){
            $('#no_sp2d').attr('value',rowData.no_sp2d);
            $('#kd_kegiatan').attr('value',rowData.kd_kegiatan);
            $('#nm_kegiatan').attr('value',rowData.nm_kegiatan);
            $('#kd_rek').attr('value',rowData.kd_rek5);
            $('#nm_rek5').attr('value',rowData.nm_rek5);
            $('#nilaireke').attr('value',rowData.nilai2);
            $('#nilaireke_hide').attr('value',rowData.nilai);
            document.getElementById('nilkap').focus();
                          
       }  
     });
    });
      $('#dg_detail').datagrid('unselectAll');
   }
function ambil_nomor(){
        var tab = 'trkib_b_kap';
        var skpd = $('#skpd').combogrid('getValue');
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>/index.php/master/max_nomor2',
            data: ({tabel:tab,skpd:skpd}),
            dataType:"json",
                success: function(data){
                $("#nomor_bukti").attr("value",data.nomor)
            }
        });
    }

    function append_save(){
      $('#dg_detail').edatagrid('selectAll');
      var rows = $('#dg_detail').edatagrid('getSelections');
      jgrid = rows.length ;
      var bukti = document.getElementById('nomor_bukti').value;
      var skpd = $('#skpd').combogrid('getValue');
      var bidang = $('#bidang').combogrid('getValue');
      var kdbrng = $('#kib').combogrid('getValue');
      var nm_brg = document.getElementById('nm_brg').value;
      var nodok = $('#nodok').combogrid('getValue');
      var no_sp2d = document.getElementById('no_sp2d').value;
      var kd_kegiatan = document.getElementById('kd_kegiatan').value;
      var nm_kegiatan = document.getElementById('nm_kegiatan').value;
      var kd_rek = document.getElementById('kd_rek').value;
      var nm_rek5 = document.getElementById('nm_rek5').value;
      var nilaireke = document.getElementById('nilaireke_hide').value;
      var nilkap = document.getElementById('nilkap').value;
      var total_d = angka(document.getElementById('total_d').value);
      //var totalseluruh=0;
      if(nilkap=='0.00' || nilkap==''){
        alert('Nilai Kapitalisasi Tidak Boleh Kosong');
        exit();
      }
      if(nodok==''){
        alert('Nomor Dokumen Tidak Boleh Kosong');
        exit();
      }

          if(updt='t'){
            pidx = jgrid ;
            pidx = pidx + 1 ;
          }else if(updt='f'){
            pidx = pidx + 1 ;
          }

          $('#dg_detail2').edatagrid('appendRow',{idx:pidx,nomor_bukti:bukti,no_dokumen:nodok,kd_brg:kdbrng,nm_brg:nm_brg,no_sp2d:no_sp2d,nilai_reke:nilaireke,kd_kegiatan:kd_kegiatan,nm_kegiatan:nm_kegiatan,kd_rek5:kd_rek,nm_rek5:nm_rek5,nilkapi:nilkap});
          $('#dg_detail').edatagrid('appendRow',{idx:pidx,nomor_bukti:bukti,no_dokumen:nodok,kd_brg:kdbrng,nm_brg:nm_brg,no_sp2d:no_sp2d,nilai_reke:nilaireke,kd_kegiatan:kd_kegiatan,nm_kegiatan:nm_kegiatan,kd_rek5:kd_rek,nm_rek5:nm_rek5,nilkapi:nilkap});
          var totalseluruh = total_d + angka(nilkap);
          $('#total_h').attr('value',number_format(totalseluruh,'2','.',','));
          $('#total_d').attr('value',number_format(totalseluruh,'2','.',','));
          $('#dg_detail').edatagrid('unselectAll');
          if(jns_trans==2){
            hitung();
          }
          kosong_det();
          no_dok();

    }

    function kosong_det(){
      $('#nodok').combogrid('clear');
      $('#no_sp2d').attr('value','');
      $('#kd_kegiatan').attr('value','');
      $('#nm_kegiatan').attr('value','');
      $('#kd_rek').attr('value','');
      $('#nm_rek5').attr('value','');
      $('#nilaireke').attr('Value','');
      $('#nilkap').attr('value','0.00');
      /*$('#dg_detail').edatagrid('selectAll');
      var rows = $('#dg_detail').edatagrid('selectAll');
      var c = rows.length;
      if(c>0){
        $('#tambah').linkbutton('disable');
      }else{
        $('#tambah').linkbutton('enable');
      }
      $('#dg_detail').edatagrid('unselectAll');*/
    }

    function hitung(){
      
        var a = angka(document.getElementById('total_h').value);       
        var b = angka(document.getElementById('peroleh').value);       
         pers = (a / b)*100;        
            $('#persen').attr('value',number_format(pers,2,'.',','));
            ambil_masa();
    }

    function ambil_masa(){
        var kdbrg = $('#kib').combogrid('getValue');
        var pers  = angka(document.getElementById('persen').value); 
        
      $.ajax({
      type:'post',
      data:({kdbrg:kdbrg,pers:pers}),
      url :"<?php echo base_url(); ?>/index.php/transaksi/ambil_masa",
      dataType:"json",
      success:function(data){
             $.each(data,function(i,n){
            pers1 = n['pers1'];
            pers2 = n['pers2'];
            masa  = n['masa']; 
            
                if(pers=='0.00'){
                    $('#tambah_umur').attr('value','0');
                }else{
                    $('#tambah_umur').attr('value',masa);
                }
          });
        }
    });
    }


    function hapus_dkpa(){
      var rows  = $('#dg_detail').datagrid('getSelected');
      var cdk   =   rows.no_dokumen;
      var crk   =   rows.kd_rek5;
      var nrk   =   rows.nm_rek5;
      var cnil  =   rows.nilkapi;
      var total = document.getElementById('total_h').value; 
      var ts    = angka(total)-angka(cnil);       
      var idx   = $('#dg_detail').datagrid('getRowIndex',rows);
      var tny   = confirm('Yakin Ingin Menghapus Data, No.Dokumen : '+cdk+' Nama Rekening : '+nrk+' Nilai : '+cnil);
      if (tny==true){
          $('#dg_detail').datagrid('deleteRow',idx);  
          $('#total_h').attr('value',number_format(ts,2,'.',','));
          if(jns_trans==2){
            hitung();
          }
          no_dok();
          /*var rows = $('#dg_detail').datagrid('getSelected');
          var panjang=  rows.length;
          if(panjang>0){
            $("#tambah_dkap").linkbutton("disable");
          }else{
            $("#tambah_dkap").linkbutton("enable");
          } */
          
      }                     
}

  function hapus_detail_kap(){
        var rows  = $('#dg_detail2').edatagrid('getSelected');
        var cdk   =   rows.no_dokumen;
        var crk   =   rows.kd_rek5;
        var nrk   =   rows.nm_rek5;
        var cnil  =   rows.nilkapi;
        var total = document.getElementById('total_h').value; 
        var ts    = angka(total)-angka(cnil);
        var idx = $('#dg_detail2').edatagrid('getRowIndex',rows);
        var tny = confirm('Yakin Ingin Menghapus Data, No.Dokumen : '+cdk+' Nama Rekening : '+nrk+' Nilai : '+cnil);
        if (tny==true){
            $('#dg_detail2').edatagrid('deleteRow',idx);
            $('#dg_detail').edatagrid('deleteRow',idx);
            
            $('#total_d').attr('value',number_format(ts,2,'.',','));    
            $('#total_h').attr('value',number_format(ts,2,'.',','));
            kosong_det();
            if(jns_trans==2){
            hitung();
          }
            no_dok();
        } 
        
    }

    function hitung2(){
      var a = angka(document.getElementById('nilaireke').value);
      var b = angka(document.getElementById('nilkap').value);
      var c = a-b;
      if(c<0){
        alert('Nilai Kapitalisasi Tidak Boleh Lebih Besar Dari Nilai Rekening');
        $('#nilkap').attr('value','0.00');
        exit();
      }
    }

    function opt(val){        
        sts_inp = val; 
        if (sts_inp==1){
            sts_inp='1';
            susut();
        } else if(sts_inp==2){
            sts_inp='2';
            susut();
        } else{
            sts_inp='3';
            susut();
        }             
    }
   </script>

<body>



<div id="content">    
<div id="accordion">
 


<h3><a href="#" id="section1"><i>LIST KAPITALISASI KIB B</i></a></h3>
    <div>
      <p align="left">
                <input style="background-color:#07adeb ;width:20px;border:solid 1px #000000;" disabled/>
                <b>#Sudah di Reklas</b>&nbsp;
                <input style="background-color:#FFF;width:20px;border:solid 1px #000000;" disabled/>
                <b>#Belum di Reklas</b>&nbsp;
                <input style="background-color:#00ffb5;width:20px;border:solid 1px #000000;" disabled/>
                <b>#Pemeliharaan(Tambah Manfaat)</b>&nbsp;
                <input style="background-color:#cfcfcf;width:20px;border:solid 1px #000000;" disabled/>
                <b>#Pemeliharaan(Tidak Tambah Manfaat)</b>&nbsp;
                
            </p>
    <p align="right">         
        <a class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="javascript:kosong();section2();">Tambah</a>               
        <a plain="false">Cari</a>
        <input id="txtcari" class="easyui-searchbox" data-options="prompt:'Please Input Value', searcher:function(value,name){cari(value)}" style="width:190px"/>
                                  
    </p> 
    <p align="center">
      <table align="center" id="dg" title="LIST KAPITALISASI KIB B" style="width:940px;height:350px;" >  
        </table>
    </p>
    </div> 

<h3><a href="#" id="section2"><i>INPUT KAPITALISASI KIB B</i></a></h3>
<div >
    
    <fieldset>
    <p id="p1" style="font-size: x-large;color: red;"></p>
     <table align="center" style="width:100%;" border="0">
           <tr>
               <td width="50%" valign="top">
                    <table align="left" style="width:100%;" border="0">
                      <!-- aktifkan checkbox bila perlu -->
					              <tr >
                            <td width="20%">Jenis</td>
                            <td colspan="2">: <input type="radio" name="pelihara" id="pelihara1" value="1" onclick="opt(this.value)" CHECKED/>Kapitalisasi (522,523)</br>&nbsp;&nbsp;<input type="radio" name="pelihara" id="pelihara2" value="2" onclick="opt(this.value) "CHECKED/>Pemeliharaan (Menambah Masa Manfaat)</br>&nbsp;&nbsp;<input type="radio" name="pelihara" id="pelihara3" value="3" onclick="opt(this.value)"/>Pemeliharaan (Tidak Menambah Masa Manfaat)</td> 
                            <!-- <td width="10%"></td> -->
                       </tr> 
                       
                        <tr >
                            <td width="20%">No. Bukti</td>
                            <td colspan="2">: <input id="nomor_bukti" name="nomor_bukti" style="width: 130px;" placeholder="AutoNumber" disabled="true"/></td> 
                            <!-- <td width="10%"></td> -->
                       </tr> 
                      <tr>
                            <td width="15%">OPD</td>
                            <td colspan="2">: <input type="text" id="skpd" name="skpd" style="width: 150px;" /> <input id="nmskpd" name="nmskpd" style="border:0;width: 450px;" readonly="true"/></td>
                            <!-- <td width="10%"></td> -->
                      </tr>
                      <tr>
                            <td width="15%">Unit</td>
                            <td colspan="2">: <input type="text" id="uskpd" name="uskpd" style="width: 150px;border:0;" readonly="true" /> <input id="nmunit" name="nmunit" style="border:0;width: 450px;" readonly="true"/></td>
                            <!-- <td width="10%"></td> -->
                      </tr>

                      <tr>
                            <td width="15%">Tanggal Kapitalisasi</td>
                            <td colspan="2">: <input id="tgl_kap" name="tgl_kap" style="width: 150px;border:0;"/></td>
                            <!-- <td width="10%"></td> -->
                      </tr>
                      
                      <tr>
                            <td width="15%">Nama Bidang</td>
                            <td colspan="2">: <input type="text" id="bidang" name="bidang" style="width: 150px;" /> <input id="nm_bidang" name="nm_bidang" style="border:0;width: 450px;" readonly="true"/></td>
                            <!-- <td width="10%"></td> -->
                       </tr>
                       <tr>
                            <td width="15%">Nama Barang</td>
                            <td colspan="2">: <input type="text" id="kib" name="kib" style="width: 150px;" /> <input id="nm_brg" name="nm_brg" style="border:0;width: 450px;" readonly="true"/></td>
                            <!-- <td width="10%"></td> -->
                       </tr>
                       
                       <tr>
                            <td>No Dokumen</td>
                            <td>: <input id="dok" name="dok" style="width: 200px;" readonly /></td>
                            <td></td>
                       </tr>
                       <tr width="10%">
                            <td>Tanggal Perolehan</td>
                            <td>: <input type="text" id="tanggal" style="width: 140px;" disabled="true" /></td>
                            <td></td>
                       </tr>
                       <tr>
                            <td>Harga Perolehan</td>
                            <td>: <input id="peroleh" name="peroleh" style="width: 150px;text-align: right;" readonly/> </td>
                            <td>Masa Manfaat / Terpakai Selama : <input id="terpakai" name="terpakai" style="width: 30px;text-align: right;border:0;" readonly/> Tahun</td>
                       </tr>
                       <!-- <tr>
                            <td>Tambahan Masa Manfaat</td>
                            <td>: <input id="tmbh_manfaat" name="tmbh_manfaat" style="width: 200px;" style="text-align: right;" onKeyPress="return goodchars(event,'1234567890',this);"/></td>
                            <td></td>
                       </tr> -->
                       <td>Persentase</td>
                        <td>:<input style="width: 60px;text-align: right;border:0;" id="persen" name="persen" readonly="true"/>%</td>
                        <td>Tambahan Masa Manfaat &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                        <input style="width: 50px;text-align: right;border:0;" id="tambah_umur" name="tambah_umur" readonly="true"/></td>
                      </tr>
                      <tr>
                          <td>Keterangan</td>
                          <td colspan="4"><textarea id="keterangan_kap" style="width: 650px; height: 40px;"></textarea></td>
                     </tr>
					   <!--ini disengaja-->
                       <tr hidden="true">
                            <td>id_barang</td>
                            <td>: <input id="id_barang" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>no_reg</td>
                            <td>: <input id="no_reg" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>no</td>
                            <td>: <input id="no" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>tgl_reg</td>
                            <td>: <input id="tgl_reg" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>kd_bahan</td>
                            <td>: <input id="kd_bahan" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>kd_satuan</td>
                            <td>: <input id="kd_satuan" /></td>
                            <td></td>
                       </tr>
					   								
                       <tr hidden="true">
                            <td>no_dokumen</td>
                            <td>: <input id="no_dokumen" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>kd_brg</td>
                            <td>: <input id="kd_brg" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>nilai</td>
                            <td>: <input id="nilai" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>jumlah</td>
                            <td>: <input id="jumlah" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>total</td>
                            <td>: <input id="total" /></td>
                            <td></td>
                       </tr>				
                       <tr hidden="true">
                            <td>merek</td>
                            <td>: <input id="merek" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>tipe</td>
                            <td>: <input id="tipe" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>pabrik</td>
                            <td>: <input id="pabrik" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>kd_warna</td>
                            <td>: <input id="kd_warna" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>no_rangka</td>
                            <td>: <input id="no_rangka" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>no_mesin</td>
                            <td>: <input id="no_mesin" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>no_polisi</td>
                            <td>: <input id="no_polisi" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>silinder</td>
                            <td>: <input id="silinder" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>no_stnk</td>
                            <td>: <input id="no_stnk" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>tgl_stnk</td>
                            <td>: <input id="tgl_stnk" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>no_bpkb</td>
                            <td>: <input id="no_bpkb" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>tgl_bpkb</td>
                            <td>: <input id="tgl_bpkb" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>kondisi</td>
                            <td>: <input id="kondisi" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>tahun_produksi</td>
                            <td>: <input id="tahun_produksi" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>nip</td>
                            <td>: <input id="nip" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>dasar</td>
                            <td>: <input id="dasar" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>no_sk</td>
                            <td>: <input id="no_sk" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>tgl_sk</td>
                            <td>: <input id="tgl_sk" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>keterangan</td>
                            <td>: <input id="keterangan" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>kd_ruang</td>
                            <td>: <input id="kd_ruang" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>kd_lokasi2</td>
                            <td>: <input id="kd_lokasi2" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>metode</td>
                            <td>: <input id="metode" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>kd_unit</td>
                            <td>: <input id="kd_unit" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>tahun</td>
                            <td>: <input id="tahun" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>nilai_sisa</td>
                            <td>: <input id="nilai_sisa" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>tgl_sp2d</td>
                            <td>: <input id="tgl_sp2d" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>foto</td>
                            <td>: <input id="foto" /></td>
                            <td></td>
                       </tr>
                    </table> 
              </br></br>
               
           <tr>
                <td colspan="2" align="center"><a id="simpan" name="simpan" class="easyui-linkbutton" iconCls="icon-save" plain="false" onclick="javascript:simpan();">Simpan</a>                
		        <a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:keluar();">Kembali</a>
                
                </td>                    
            </tr>
            
        </table>  
            
    </fieldset> 
  </br>
  <div id="toolbar" align="right">
          <a id="tambah" name="tambah" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="javascript:tambah_dkap();">Tambah Detail</a>
          <a id="hapus" name="hapus" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="javascript:hapus_dkpa();">Hapus Detail</a>
        </div>
    <table  id="dg_detail" name="dg_detail" title="Detail Barang" style="width:910px;height:350px;" >  
        </table>
        
        <div align="right">Total : <input type="text" id="total_h" name="total_h" style="text-align: right;border:0;width: 200px;font-size: large;" readonly="true"/></div> 
</div>

<div id="dialog-modal" title="Input Kegiatan">

  
</div>
 

<div id="dialog-modal_det" title="Detail Kapitalisasi">
    <p class="validateTips"></p> 
   
					<HR />
    
  
   <BR /> 
    <fieldset>
    <table border="0">
        <td>Pilih No Dok</td>
            <td> :<input type="text" style="width: 240px;" id="nodok" name="nodok" /></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>SP2D</td>
            <td>:<input style="width: 240px;text-align: right;" id="no_sp2d" name="no_sp2d" readonly/></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Kode Kegiatan</td>
            <TD colspan='4'>:<INPUT style="width: 140px;" readonly="true" id="kd_kegiatan" name="kd_kegiatan" /> <input type="text" id="nm_kegiatan" name="nm_kegiatan" style="width: 450px;border:0;" readonly="true"/></TD>
            
        </tr><tr>
      <td>Kode Rekening</td>
      <TD colspan='4'>:<INPUT style="width: 140px;" id="kd_rek" name="kd_rek" readonly="true" /> <input type="text" id="nm_rek5" name="nm_rek5" style="width: 300px;border:0;" readonly="true"/></TD>
      
    </tr>
        <tr>
            <td>Nilai Rekening</td>
            <td>:<input style="width: 140px;text-align: right;" id="nilaireke" name="nilaireke" readonly/><input type="hidden" id="nilaireke_hide" name="nilaireke_hide" style="width: 150px;"/></td>
            <td>Nilai Kapitalisasi</td>
            <td>:<input style="width: 140px;text-align: right;" id="nilkap" name="nilkap" onkeypress="return(currencyFormat(this,',','.',event))" onkeyup="hitung2();"/></td>
            
        </tr>
    
      
    </table>  
    </br></br>
    <table align="center">
        <tr>
            <td><a class="easyui-linkbutton" iconCls="icon-save" plain="false" onclick="javascript:append_save();">Simpan</a>
                <a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:keluar_det();">Keluar</a>                               
            </td>
        </tr>
    </table>   
    </fieldset>
  </br>
  <fieldset>
    <table  id="dg_detail2" name="dg_detail2" title="Detail Barang" style="width:940px;height:300px;" ></table>
  </br>
    
        <table align="right" border="0">           
            <tr>
                <td>Total</td>
                <td>:</td>
                <td><input type="text" id="total_d" name="total_d" readonly="true" style="font-size: large;text-align: right;border:0;width: 200px;"/></td>
            </tr>
        </table>
        
    </fieldset>
</div>
</body>