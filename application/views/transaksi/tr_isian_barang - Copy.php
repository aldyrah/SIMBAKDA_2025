<script src="<?php echo base_url(); ?>lib/sweet-alert.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>lib/numberFormat.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>lib/jquery.maskMoney.min.js"></script>
<link   rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>lib/sweet-alert.css">
<script type="text/javascript">
var cgol ='';
var lpnodok1 = '';
var nomor_bukti='';
updt = '';
total_updt=0;
$(document).ready(function() {
    $("#tabs").tabs();
    $("#dialog-modal").dialog({
        height: 650,
        width: 800,
        modal: true, 
        background:'#2da305',           
        autoOpen:false                
    });
    $("#dialog-modal-update").dialog({
        height: 650,
        width: 800,
        modal: true, 
        background:'#2da305',           
        autoOpen:false                
    });
    $("#dialog-modal_bap").dialog({
        height: 650,
        width: 800,
        modal: true, 
        background:'#2da305',           
        autoOpen:false                
    });
    $( "#dialog-modal-aaa" ).dialog({
            height: 500,
            width: 500,
            modal: true,
            autoOpen:false
        });              
    //set_grid();
});
//this view has been modified by demansyah msm biak 
//demansyah
$(document).ready(function(){
      $('#jumlah').maskMoney({thousands:',', decimal:'.', precision:0});
      $('#jumlah_u').maskMoney({thousands:',', decimal:'.', precision:0});
    });    

$(function(){ 
    $('#trh').edatagrid({
        url: '<?php echo base_url(); ?>index.php/transaksi/trh_isianbrg',
        idField:'no_dokumen',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true", 
        rowStyler: function(index,row){
                        if (row.invent=='1' && row.sts_kdp=='K' ){
                            return 'background-color:#07adeb ;';
                        }else if (row.invent=='1' && row.sts_kdp=='B' ){
                            return 'background-color:#07adeb ;';
                        }else if (row.sts_kdp=='K' && row.invent==''){
                            return 'background-color:#00ffb5 ;';
                        }else if (row.sts_kdp=='L' ){
                            return 'background-color:#cfcfcf ;';
                        }else if (row.sts_kdp=='B' && row.invent==''){
                            return 'background-color:#dffd8b ;';
                        }else if (row.sts_kdp=='B' && row.invent=='2'){
                            return 'background-color:#FFFFFF ;';
                        }else if (row.sts_kdp=='K' && row.invent=='2'){
                            return 'background-color:#FFFFFF ;';
                        }else if(row.tes>0){
                            return 'background-color:#FFFF00;';
                        }
                    },                      
        columns:[[
            {field:'sts_kdp',title:'KDP',width:30,hidden:true},
            {field:'no_bukti',title:'Nomor Bukti',width:30},
    	    {field:'no_dokumen',title:'Nomor Dokumen',width:50},
            {field:'tgl_dokumen',title:'Tanggal',width:30},
            {field:'nm_comp',title:'Perusahaan/Rekanan',width:100},
            {field:'nm_skpd',title:'SKPD',width:100} ,
			{field:'hapus',width:10,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus();'' />";}}
			
        ]],
        onSelect:function(rowIndex,rowData){
            idx 		= rowIndex;
            lpnodok1 	= rowData.no_dokumen;
            no 			= rowData.no_dokumen;
            no_bukti    = rowData.no_bukti;
            tgl 		= rowData.tgl_dokumen;
            nilkon 		= number_format(rowData.nilai_kontrak,2,'.',',');
            nilapbd 	= number_format(rowData.nilai_apbd,2,'.',',');
            nilkon1     = rowData.nilai_kontrak;
            kdcomp  	= rowData.kd_comp;
            kdmilik  	= rowData.kd_milik;
            kdwilayah 	= rowData.kd_wilayah;
            kduskpd  	= rowData.kd_uskpd;
            kd_unit  	= rowData.kd_unit;
            jnsdana  	= rowData.jns_dana;
            tahunang  	= rowData.tahun_ang;
            buktibyr  	= rowData.bukti_byr;
            dasaroleh  	= rowData.dasar_oleh;
            nooleh  	= rowData.no_oleh;
            tgloleh 	= rowData.tgl_oleh;
            tahunoleh 	= rowData.tahun_oleh;            
            tot 		= rowData.tothead;
            cr_oleh 	= rowData.kd_cr_oleh;
            no_renc     = rowData.no_rencana;
            no_awas     = rowData.no_awas; 
            nrek5       = rowData.nrek5;
            sts_kdp     = rowData.sts_kdp;     
            getData(no_bukti,no,tgl,nilkon,nilapbd,kdcomp,kdmilik,kdwilayah,kduskpd,kd_unit,jnsdana,tahunang,buktibyr,dasaroleh,nooleh,tgloleh,tahunoleh,tot,cr_oleh,no_renc,no_awas,nrek5,sts_kdp);            
            updt = 't';       
        },
        onDblClickRow:function(rowIndex,rowData){  
		    idx 		= rowIndex;
            lpnodok1 	= rowData.no_dokumen;
            no 		 	= rowData.no_dokumen;
            no_bukti    = rowData.no_bukti;
            tgl 	 	= rowData.tgl_dokumen;
            nilkon  	= number_format(rowData.nilai_kontrak,2,'.',',');
            nilapbd 	= number_format(rowData.nilai_apbd,2,'.',',');
            nilkon1     = rowData.nilai_kontrak;
            kdcomp  	= rowData.kd_comp;
            kdmilik  	= rowData.kd_milik;
            kdwilayah 	= rowData.kd_wilayah;
            kduskpd  	= rowData.kd_uskpd;
            kd_unit  	= rowData.kd_unit;
            jnsdana  	= rowData.jns_dana; 
            tahunang  	= rowData.tahun_ang;
            buktibyr  	= rowData.bukti_byr;
            dasaroleh  	= rowData.dasar_oleh;
            nooleh  	= rowData.no_oleh;
            tgloleh 	= rowData.tgl_oleh;
            tahunoleh 	= rowData.tahun_oleh;            
            tot 		= rowData.tothead;
            cr_oleh 	= rowData.kd_cr_oleh;
            nrek5       = rowData.nrek5;
            no_renc     = rowData.no_rencana;
            no_awas     = rowData.no_awas;
            invent      = rowData.invent;  
            sts_kdp     = rowData.sts_kdp; 
            getData(no_bukti,no,tgl,nilkon,nilapbd,kdcomp,kdmilik,kdwilayah,kduskpd,kd_unit,jnsdana,tahunang,buktibyr,dasaroleh,nooleh,tgloleh,tahunoleh,tot,cr_oleh,no_renc,no_awas,nrek5,sts_kdp);            
              updt = 't';
              $('#nomor').combogrid('disable');
              //$('#nomor_rencana').combogrid('disable');
              //$('#nomor_awas').combogrid('disable');
              $('#tambah_det').linkbutton("disable");
              if(invent==1){
                $('#c_simpan').linkbutton("disable");
                $("#sts_kdp").attr("disabled",true);
                $('#tambah_det').linkbutton("disable");
              }else{
                $('#c_simpan').linkbutton("enable");
                $("#sts_kdp").attr("disabled",false);
                $('#tambah_det').linkbutton("enable");
              } 
              
            loadDetail(no_bukti,no,nilkon1,tot); 
            //load_sum_trd_isianbrg();    
            tab2();                              
        }
    });    
       
    $('#trd').edatagrid({                
            //toolbar:'#toolbar',   		
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
        {field:'no_dokumen',title:'Nomor',width:100,hidden:true},
        {field:'jns',title:'Jenis',width:100,hidden:true }  ,
        {field:'nm_jenis',title:'Nama Jenis',width:100,hidden:true }  ,
        {field:'kd_bidang',title:'Kode Bidang',width:100,hidden:true},
        {field:'nm_bidang',title:'Nama Bidang',width:100,hidden:true},
        {field:'kd_brg',title:'Kode Barang',width:150 }  ,
        {field:'nm_brg',title:'Nama Barang',width:250 }  ,
        {field:'kd_unit',title:'Unit',width:100,hidden:true }  ,
        {field:'kd_uskpd',title:'SKPD',width:100,hidden:true }  ,
        {field:'s_dana',title:'Sumber Dana',width:100,hidden:true }  ,
        {field:'no_sp2d',title:'No SP2D',width:150 }  ,
        {field:'tgl_sp2d',title:'TGL SP2D',width:100,hidden:true }  ,
        {field:'nilai_sp2d',title:'Nilai SP2D',width:100,align:'right' }  ,
        {field:'nilai_kontrak',title:'Nilai Kontrak',width:100,hidden:true }  ,
        {field:'kd_kegiatan',title:'Kode Kegiatan',width:100,hidden:true }  ,
        {field:'nm_kegiatan',title:'Nama Kegiatan',width:100,hidden:true }  ,
        {field:'kd_rek5',title:'Kode Rekening',width:100,hidden:true }  ,
        {field:'nm_rek5',title:'Nama Rekening',width:100,hidden:true }  ,
        {field:'jumlah',title:'Jumlah',width:100,hidden:true }  ,
        {field:'harga',title:'Harga/Unit',width:100,align:'right' }  ,
        {field:'ppn',title:'PPN',width:100,hidden:true }  ,
        {field:'total',title:'Total',width:100,align:'right' }  ,
        {field:'keterangan',title:'Keterangan',width:100,hidden:true }  ,
        {field:'invent',title:'Inventaris',width:100,hidden:true } , 
        {field:'hapus',width:30,align:'center',formatter:function(value,rec)
        {return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus_detail();''/>";}}

        ]]
        
    });     
    
    $('#tanggal').datebox({  
        required:true,
        formatter :function(date){
      	var y = date.getFullYear();
       	var m = date.getMonth()+1;
       	var d = date.getDate();    
       	return y+'-'+m+'-'+d;
        }
    });
    $('#dstgl').datebox({  
        required:true,
        formatter :function(date){
      	var y = date.getFullYear();
       	var m = date.getMonth()+1;
       	var d = date.getDate();    
       	return y+'-'+m+'-'+d;
        }
    });
    
     $('#tgl_kontrak_bap').datebox({  
        required:true,
        formatter :function(date){
      	var y = date.getFullYear();
       	var m = date.getMonth()+1;
       	var d = date.getDate();    
       	return d+'-'+m+'-'+y;
        }
    });
    
     $('#tgl_kep').datebox({  
        required:true,
        formatter :function(date){
      	var y = date.getFullYear();
       	var m = date.getMonth()+1;
       	var d = date.getDate();    
       	return d+'-'+m+'-'+y;
        }
    });
    
     $('#tgl_bap').datebox({  
        required:true,
        formatter :function(date){
      	var y = date.getFullYear();
       	var m = date.getMonth()+1;
       	var d = date.getDate();    
       	return d+'-'+m+'-'+y;
        }
    });
    
     $('#tgl_ctk_bap').datebox({  
        required:true,
        formatter :function(date){
      	var y = date.getFullYear();
       	var m = date.getMonth()+1;
       	var d = date.getDate();    
       	return d+'-'+m+'-'+y;
        }
    });
    
    
    $('#compy').combobox({           
        valueField:'kd_comp',  
        textField:'nm_comp',
        mode:'remote',
        width:300,
        url:'<?php echo base_url(); ?>index.php/master/ambil_compy'
    });        
    /*$('#milik').combobox({           
        valueField:'kd_milik',  
        textField:'nm_milik',
        mode:'remote',
        width:300,
        url:'<?php echo base_url(); ?>index.php/master/ambil_milik'
    });*/
    /*$('#wilayah').combobox({           
        valueField:'nm_wilayah',  
        textField:'nm_wilayah',
        mode:'remote',
        width:300,
        url:'<?php echo base_url(); ?>index.php/master/ambil_wilayah'
    });*/
	
	 $('#unit').combogrid({  
            panelWidth:700,  
			width:300,
            idField:'kd_skpd',  
            textField:'kd_skpd',  
            mode:'remote',                      
            url:'<?php echo base_url(); ?>index.php/master/ambil_msskpd2',  
            columns:[[  
               {field:'kd_skpd',title:'Kode SKPD',width:100},  
               {field:'nm_skpd',title:'Nama SKPD',width:250},
               {field:'kd_lokasi',title:'Kode Unit',width:100},  
               {field:'nm_lokasi',title:'Nama Unit',width:250}    
            ]],  
            onSelect:function(rowIndex,rowData){
               cuskpd = rowData.kd_skpd;   
               ckd_lokasi = rowData.kd_lokasi;  
               cnm_lokasi = rowData.nm_lokasi;          
               $('#nmunit').attr('value',rowData.nm_skpd);        
               $('#mlokasi').attr('value',ckd_lokasi);        
               $('#nmlokasi').attr('value',cnm_lokasi);

            } 
         });  
		 
    $('#dana').combobox({           
        valueField:'nama',  
        textField:'nama',
        width:150,
        data:[{kode:'1',nama:'APBN'},{kode:'2',nama:'APBD'},{kode:'3',nama:'APBD 1'},{kode:'4',nama:'ADD'},
        {kode:'5',nama:'APBDESA'}]
    });
	
    $('#tahun').combobox({           
        valueField:'tahun',  
        textField:'tahun',
        mode:'remote',
        width:70,
        url:'<?php echo base_url(); ?>index.php/master/tahun'
    });
    $('#thn2').combobox({           
        valueField:'tahun',  
        textField:'tahun',
        mode:'remote',
        width:70,
        url:'<?php echo base_url(); ?>index.php/master/tahun'
    });
    $('#bukti').combobox({           
        valueField:'nama',  
        textField:'nama',
        width:150,
        data:[{kode:'1',nama:'SPMU'},{kode:'2',nama:'SPM'},{kode:'3',nama:'BUKTI SETORAN'},{kode:'4',nama:'SP2D'}]
    });
    
    $('#jabat_awas1').combobox({           
        valueField:'nama',  
        textField:'nama',
        width:150,
        data:[{kode:'1',nama:'Ketua'},{kode:'2',nama:'Sekretaris'},{kode:'3',nama:'Bendahara'},{kode:'4',nama:'Anggota'}]
    });
    
    $('#jabat_awas2').combobox({           
        valueField:'nama',  
        textField:'nama',
        width:150,
        data:[{kode:'1',nama:'Ketua'},{kode:'2',nama:'Sekretaris'},{kode:'3',nama:'Bendahara'},{kode:'4',nama:'Anggota'}]
    });
    $('#jabat_awas3').combobox({           
        valueField:'nama',  
        textField:'nama',
        width:150,
        data:[{kode:'1',nama:'Ketua'},{kode:'2',nama:'Sekretaris'},{kode:'3',nama:'Bendahara'},{kode:'4',nama:'Anggota'}]
    });
    $('#jabat_awas4').combobox({           
        valueField:'nama',  
        textField:'nama',
        width:150,
        data:[{kode:'1',nama:'Ketua'},{kode:'2',nama:'Sekretaris'},{kode:'3',nama:'Bendahara'},{kode:'4',nama:'Anggota'}]
    });
    $('#jabat_awas5').combobox({           
        valueField:'nama',  
        textField:'nama',
        width:150,
        data:[{kode:'1',nama:'Ketua'},{kode:'2',nama:'Sekretaris'},{kode:'3',nama:'Bendahara'},{kode:'4',nama:'Anggota'}]
    });
    $('#jabat_awas6').combobox({           
        valueField:'nama',  
        textField:'nama',
        width:150,
        data:[{kode:'1',nama:'Ketua'},{kode:'2',nama:'Sekretaris'},{kode:'3',nama:'Bendahara'},{kode:'4',nama:'Anggota'}]
    });
    $('#jabat_awas7').combobox({           
        valueField:'nama',  
        textField:'nama',
        width:150,
        data:[{kode:'1',nama:'Ketua'},{kode:'2',nama:'Sekretaris'},{kode:'3',nama:'Bendahara'},{kode:'4',nama:'Anggota'}]
    });
    
    $('#hari').combobox({           
        valueField:'nama',  
        textField:'nama',
        width:75,
        data:[{kode:'1',nama:'Minggu'},{kode:'2',nama:'Senin'},{kode:'3',nama:'Selasa'},
        {kode:'4',nama:'Rabu'},{kode:'5',nama:'Kamis'},{kode:'6',nama:'Jumat'},{kode:'7',nama:'Sabtu'}]
    });
    
    $('#bln_bap').combobox({           
        valueField:'nama',  
        textField:'nama',
        width:100,
        data:[{kode:'1',nama:'Januari'},{kode:'2',nama:'Februari'},{kode:'3',nama:'Maret'},
        {kode:'4',nama:'April'},{kode:'5',nama:'Mei'},{kode:'6',nama:'Juni'},
        {kode:'7',nama:'Juli'},{kode:'8',nama:'Agustus'},{kode:'9',nama:'September'},{kode:'10',nama:'Oktober'},
        {kode:'11',nama:'November'},{kode:'12',nama:'Desember'}]
    });
    
    $('#perolehan').combobox({           
        valueField:'cara_perolehan',  
        textField:'cara_perolehan',
        mode:'remote',
        width:150,
        url:'<?php echo base_url(); ?>index.php/master/perolehan'                    
    });
    
     $('#pengawas1').combobox({           
        valueField:'nama',  
        textField:'nama',
        mode:'remote',
        width:220,
        url:'<?php echo base_url(); ?>index.php/master/pengawas'                    
    });
     $('#pengawas7').combobox({           
        valueField:'nama',  
        textField:'nama',
        mode:'remote',
        width:220,
        url:'<?php echo base_url(); ?>index.php/master/pengawas'                    
    });
     $('#pengawas2').combobox({           
        valueField:'nama',  
        textField:'nama',
        mode:'remote',
        width:220,
        url:'<?php echo base_url(); ?>index.php/master/pengawas'                    
    });
     $('#pengawas3').combobox({           
        valueField:'nama',  
        textField:'nama',
        mode:'remote',
        width:220,
        url:'<?php echo base_url(); ?>index.php/master/pengawas'                    
    });
     $('#pengawas4').combobox({           
        valueField:'nama',  
        textField:'nama',
        mode:'remote',
        width:220,
        url:'<?php echo base_url(); ?>index.php/master/pengawas'                    
    });
     $('#pengawas5').combobox({           
        valueField:'nama',  
        textField:'nama',
        mode:'remote',
        width:220,
        url:'<?php echo base_url(); ?>index.php/master/pengawas'                    
    });
     $('#pengawas6').combobox({           
        valueField:'nama',  
        textField:'nama',
        mode:'remote',
        width:220,
        url:'<?php echo base_url(); ?>index.php/master/pengawas'                    
    });
     
    
    $('#dasar').combobox({           
        valueField:'nama',  
        textField:'nama',        
        width:150,
        data:[{kode:'1',nama:'BERITA ACARA'},{kode:'2',nama:'SERTIFIKAT'}]
    });    
	

	
	 $('#cmkel').combogrid({  
            panelWidth:600, 
            width:400, 
            idField:'kelompok',  
            textField:'nm_kelompok',              
            mode:'remote',            
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kelompok',title:'Kode Barang',width:100},  
               {field:'nm_kelompok',title:'Nama Barang',width:500}    
            ]],  
             onSelect:function(rowIndex,rowData){
				ckelompok=rowData.kelompok;
				$('#cmsubkel').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_kelompok1',
				queryParams:({kelompok:ckelompok})});            
        }  
    });
	
    $('#cmsubkel').combogrid({  
            panelWidth:600, 
            width:400, 
            idField:'kd_kelompok',  
            textField:'nm_kelompok',              
            mode:'remote',            
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kd_kelompok',title:'Kode Barang',width:100},  
               {field:'nm_kelompok',title:'Nama Barang',width:500}    
            ]],  
             onSelect:function(rowIndex,rowData){
				csubkel=rowData.kd_kelompok;
				$('#kdbrg').combogrid({url:'<?php echo base_url(); ?>index.php/master/load_brg',
				queryParams:({subkel:csubkel})});             
        }  
    });
	
    $('#kdbrg').combogrid({  
            panelWidth:600, 
            width:400, 
            idField:'kd_brg',  
            textField:'nm_brg',              
            mode:'remote',            
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kd_brg',title:'Kode Barang',width:100},  
               {field:'nm_brg',title:'Nama Barang',width:500}    
            ]],  
            onSelect:function(rowIndex,rowData){                                                             
                cnm = rowData.nm_brg;              
                $('#nmbrg').attr('value',cnm);                
            } 
    }); 
	
     $('#sbrdana').combobox({           
        valueField:'nama',  
        textField:'nama',
        width:150,
        data:[{kode:'1',nama:'APBN'},{kode:'2',nama:'APBD'},{kode:'3',nama:'APBD 1'},{kode:'4',nama:'ADD'},
        {kode:'5',nama:'APBDESA'}]
    });
    $('#sbrdana_u').combobox({           
        valueField:'nama',  
        textField:'nama',
        width:150,
        data:[{kode:'1',nama:'APBN'},{kode:'2',nama:'APBD'},{kode:'3',nama:'APBD 1'},{kode:'4',nama:'ADD'},
        {kode:'5',nama:'APBDESA'}]
    });
	
    $('#tglsp2d').datebox({  
        required:true,
        formatter :function(date){
      	var y = date.getFullYear();
       	var m = date.getMonth()+1;
       	var d = date.getDate();    
       	return y+'-'+m+'-'+d;
        }
    });
    $('#tglsp2d_u').datebox({  
        required:true,
        formatter :function(date){
        var y = date.getFullYear();
        var m = date.getMonth()+1;
        var d = date.getDate();    
        return y+'-'+m+'-'+d;
        }
    }); 
    $('#nosp2d').combogrid({  
                   panelWidth : 700,  
                   idField    : 'no_sp2d',  
                   textField  : 'no_sp2d',  
                   //multiple   : true,  
                   columns:[[  
                       {field:'no_sp2d',title:'No SP2D',width:200},  
                       {field:'tgl_sp2d',title:'Tanggal',width:80},
                       {field:'nilai2',title:'Nilai',width:100,align:'right'},
                       {field:'keperluan',title:'Keterangan',width:320}    
                   ]],  
                   onSelect:function(rowIndex,rowData){
                    nil=rowData.nilai;
                    $('#tglsp2d').datebox("setValue",rowData.tgl_sp2d);
                    $('#nilsp2d').attr('value',rowData.nilai2);
                    $('#nilsp2d_hide').attr('value',number_format(nil,2,'.',''));
                       
                   } 
            }); 
    $('#nosp2d_u').combogrid({  
                   panelWidth : 700,  
                   idField    : 'no_sp2d',  
                   textField  : 'no_sp2d',  
                     
                   columns:[[  
                       {field:'no_sp2d',title:'No SP2D',width:200},  
                       {field:'tgl_sp2d',title:'Tanggal',width:80},
                       {field:'nilai2',title:'Nilai',width:100,align:'right'},
                       {field:'keperluan',title:'Keterangan',width:320}    
                   ]],  
                   onSelect:function(rowIndex,rowData){
                    nil=rowData.nilai;
                    $('#tglsp2d_u').datebox("setValue",rowData.tgl_sp2d);
                    $('#nilsp2d_u').attr('value',rowData.nilai2);
                    $('#nilsp2d_hide_u').attr('value',number_format(nil,2,'.',''));
                       
                   } 
            });  
});

$(function(){
    $('#cmbjenis').combogrid({           
        idField:'golongan',  
        textField:'golongan',
        mode:'remote',
        panelWidth:400,
        url:'<?php echo base_url(); ?>index.php/master/ambil_gol',
        columns:[[  
               
               {field:'golongan',title:'Kode Golongan',width:100},  
               {field:'nm_golongan',title:'Nama Golongan',width:500}
            ]], 
        onSelect:function(rowIndex,rowData){
            cgol=rowData.golongan;
            ngol=rowData.nm_golongan;
            
            $('#nmgolongan').attr('value',ngol);
            $('#bidang').combogrid('clear');
            $('#kdbarang').combogrid('clear');
            $('#nmbidang').attr('value','');
            $('#nmkelompok').attr('value','');
            
            $('#nmbrg').attr('value','');
            $('#harga').attr('value','');
            $('#total1').attr('value','');
            $('#total2').attr('value','');
            if(cgol=='01' || cgol=='03' || cgol=='04'){
                $('#jumlah').attr('value','1');
            }
            //$('#ket').attr('value','');
            $('#bidang').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_bidang',
            queryParams:({gol:cgol})
        });            
        }                    
    });
$('#cmbjenis_u').combogrid({           
        idField:'golongan',  
        textField:'golongan',
        mode:'remote',
        panelWidth:400,
        url:'<?php echo base_url(); ?>index.php/master/ambil_gol',
        columns:[[  
               
               {field:'golongan',title:'Kode Golongan',width:100},  
               {field:'nm_golongan',title:'Nama Golongan',width:500}
            ]], 
        onSelect:function(rowIndex,rowData){
            cgol=rowData.golongan;
            ngol=rowData.nm_golongan;
            
            $('#nmgolongan_u').attr('value',ngol);
            $('#bidang_u').combogrid('clear');
            //$('#kdbarang_u').combogrid('clear');
            //$('#kdbarang_u').combogrid('disable');
            $('#nmbidang_u').attr('value','');
            $('#nmkelompok_u').attr('value','');
            
            $('#nmbrg_u').attr('value','');
           
            $('#bidang_u').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_bidang',
            queryParams:({gol:cgol})
        });            
        }                    
    });

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
                 
                //$('#bidang').attr('value',bidang);
                $('#nmbidang').attr('value',nmbidang);

                $('#kdbarang').combogrid("clear");
                $('#nmkelompok').attr('value',''); 
                $('#kdbarang').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_brg_dh',
                queryParams:({bidang:bidang})});            
        }  
    });

    $('#bidang_u').combogrid({  
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
                $('#nmbidang_u').attr('value',nmbidang);
                //$('#kdbarang_u').combogrid('disable');
                $('#kdbarang_u').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_brg_dh',
                queryParams:({bidang:bidang})});            
        }  
    });
    
    $('#kdbarang').combogrid({
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
                $('#nmkelompok').attr('value',cnmkelompok);
            }                                                          
                
    });


    $('#kdbarang_u').combogrid({
        panelWidth:550, 
            idField:'kd_brg',  
            textField:'kd_brg',              
            //mode:'remote',            
            //loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kd_brg',title:'KODE BARANG',width:100}, 
               {field:'nm_brg',title:'NAMA BARANG',width:450}  
            ]],
            onSelect:function(rowIndex,rowData){
                $('#nmkelompok_u').attr('value',rowData.nm_brg);
            }                                                      
                
    });

    /*$('#rekening').combogrid({
        panelWidth:500, 
            idField:'kd_rek5',  
            textField:'kd_rek5',              
            mode:'remote',            
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kd_rek5',title:'Kode Rekening',width:150}, 
               {field:'nm_rek5',title:'Nama Rekening',width:350}  
            ]],  
             onSelect:function(rowIndex,rowData){
                $('#nm_rekening').attr('value',rowData.nm_rek5);
            }                                                          
                
    });*/

   $('#nomor').combogrid({  
            panelWidth:900,  
            idField:'no_kontrak',  
            textField:'no_kontrak', 
            loadMsg:"Tunggu Sebentar....!!", 
            mode:'remote',
            url:'<?php echo base_url(); ?>index.php/master/ambil_nomor_kontrak',  
            columns:[[  
                {field:'no_kontrak',title:'No Kontrak',width:200},  
                {field:'nilai2',title:'Nilai Kontrak',width:100,align:'right'},
                {field:'nm_rek5',title:'Nm Rek',width:150},
                {field:'keterangan',title:'Keterangan',width:450}    
            ]],
            onSelect:function(rowIndex,rowData){
                nospp=rowData.no_spp;
                rek5 =rowData.kd_rek5;
                $('#nilkont').attr('value',rowData.nkontrak2);
                $('#nkon').attr('value',rowData.nilai2);
                $('#nkon_hide').attr('value',rowData.nilai);
                $('#nilkont_hide').attr('value',rowData.nkontrak);
                $('#unit').combogrid('setValue',rowData.kd_skpd);
                $('#sp2d').attr('value',rowData.no_sp2d);
                //$('#sp2d_dh_update').attr('value',rowData.no_sp2d);
                $('#nilapbd').attr('value',rowData.nilai_ubah);
                $('#kegiatan').attr('value',rowData.kd_kegiatan);
                $('#kegiatan_u').attr('value',rowData.kd_kegiatan);
                $('#rekening').attr('value',rowData.kd_rek5);
                $('#rekening_u').attr('value',rowData.kd_rek5);
                $('#nm_kegiatan').attr('value',rowData.nm_kegiatan);
                $('#nm_kegiatan_u').attr('value',rowData.nm_kegiatan);
                $('#nm_rekening').attr('value',rowData.nm_rek5);
                $('#nm_rekening_u').attr('value',rowData.nm_rek5);
                $('#ket').attr('value',rowData.keterangan);
                $('#tanggal').datebox('setValue',rowData.tgl_bukti);
                //$("#nomor_rencana").combogrid('clear');
                //$("#nomor_awas").combogrid('clear');
                //$("#nomor_rencana").combogrid('grid').datagrid('reload');
                //$("#nomor_awas").combogrid('grid').datagrid('reload');
                //$("#nomor_rencana").combogrid('disable');
                //$("#nomor_awas").combogrid('disable');
                $('#jns_spp').attr('value',rowData.jns_spp);
                if(updt=='f'){
                    cek_kdp();
                }
                kdr5 = rek5.substr(0,5);
                if( kdr5=='52321' || kdr5=='52324' || kdr5=='52326'){
                    if(updt=='f'){
                        //$("#nomor_rencana").combogrid('enable');
                        //$("#nomor_awas").combogrid('enable');
                        //no_rencana();
                        //no_pengawas(); 
                    }else{
                        //$("#nomor_rencana").combogrid('disable');
                        //$("#nomor_awas").combogrid('disable');
                    }
                     
                }
                 
                
                
            }  
            });

    /*$('#nomor_rencana').combogrid({  
                panelWidth:1000,  
                idField:'no_rencana',  
                textField:'no_rencana',  
                mode:'remote',            
                loadMsg:"Tunggu Sebentar....!!",   
                columns:[[  
                    {field:'no_rencana',title:'No Kontrak',width:225},  
                    {field:'nilai',title:'Nilai Kontrak',width:100,align:'right'},
                    {field:'jasa',title:'Jenis Jasa',width:200},
                    {field:'keterangan',title:'Keterangan',width:475}    
                ]]*//*,
                onSelect:function(rowIndex,rowData){
                    
                }*/  
         //       });
    /*$('#nomor_awas').combogrid({  
                panelWidth:1000,  
                idField:'no_awas',  
                textField:'no_awas',  
                mode:'remote',            
                loadMsg:"Tunggu Sebentar....!!",   
                columns:[[  
                    {field:'no_awas',title:'No Kontrak',width:225},  
                    {field:'nilai',title:'Nilai Kontrak',width:100,align:'right'},
                    {field:'jasa',title:'Jenis Jasa',width:200},
                    {field:'keterangan',title:'Keterangan',width:475}    
                ]]*//*,
                onSelect:function(rowIndex,rowData){
                    
                }*/  
          //      });
    
        $('#trd').edatagrid({
            toolbar:'#toolbar',
            rownumbers:"true",            
            //singleSelect:"true",
            autoRowHeight:"false",
            nowrap:"true",
            onSelect:function(rowIndex,rowData){                    
                    idx = rowIndex;
                    //nilx = rowData.nilai;
            },
        columns:[[ 
        {field:'idx',title:'idx',width:100,align:'left',hidden:'true'},
        {field:'nomor_bukti',title:'nomor_bukti',width:100,align:'left',hidden:'true'},
        {field:'no_dokumen',title:'Nomor',width:100,hidden:true},
        {field:'jns',title:'Jenis',width:100,hidden:true }  ,
        {field:'nm_jenis',title:'Nama Jenis',width:100,hidden:true }  ,
        {field:'kd_bidang',title:'Kode Bidang',width:100,hidden:true},
        {field:'nm_bidang',title:'Nama Bidang',width:100,hidden:true},
        {field:'kd_brg',title:'Kode Barang',width:150 }  ,
        {field:'nm_brg',title:'Nama Barang',width:250 }  ,
        {field:'kd_unit',title:'Unit',width:100,hidden:true }  ,
        {field:'kd_uskpd',title:'SKPD',width:100,hidden:true }  ,
        {field:'s_dana',title:'Sumber Dana',width:100,hidden:true }  ,
        {field:'no_sp2d',title:'No SP2D',width:150 }  ,
        {field:'tgl_sp2d',title:'TGL SP2D',width:100,hidden:true }  ,
        {field:'nilai_sp2d',title:'Nilai SP2D',width:100,align:'right' }  ,
        {field:'nilai_kontrak',title:'Nilai Kontrak',width:100,hidden:true }  ,
        {field:'kd_kegiatan',title:'Kode Kegiatan',width:100,hidden:true }  ,
        {field:'nm_kegiatan',title:'Nama Kegiatan',width:100,hidden:true }  ,
        {field:'kd_rek5',title:'Kode Rekening',width:100,hidden:true }  ,
        {field:'nm_rek5',title:'Nama Rekening',width:100,hidden:true }  ,
        {field:'jumlah',title:'Jumlah',width:100,hidden:true }  ,
        {field:'harga',title:'Harga/Unit',width:100,align:'right' }  ,
        {field:'ppn',title:'PPN',width:100,hidden:true }  ,
        {field:'total',title:'Total',width:100,align:'right' }  ,
        {field:'keterangan',title:'Keterangan',width:100,hidden:true }  ,
        {field:'invent',title:'Inventaris',width:100,hidden:true } , 
        {field:'hapus',width:30,align:'center',formatter:function(value,rec)
        {return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus_detail();''/>";}}

        ]]
    });

    
}); 

function load_detail_kosong_dh(){
    var nomor = $('#nomor').combogrid('getValue');
     $(function(){
            $('#trd').edatagrid({
                url: '<?php echo base_url(); ?>/index.php/transaksi/trd_isianbrg',
                queryParams:({ no:nomor }),
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
                idx =  rowData.idx ;  
                                                        
                },
                 columns:[[
                     {field:'idx',title:'idx',width:100,align:'left',hidden:'true'},
                     {field:'nomor_bukti',title:'nomor_bukti',width:100,align:'left',hidden:'true'},               
                     {field:'no_dokumen',title:'Nomor',width:100,hidden:'true'},
                    {field:'jns',title:'Jenis',width:100,hidden:'true'},
             {field:'nm_jenis',title:'Nama Jenis',width:100,hidden:'true'},
             {field:'kd_bidang',title:'Kode Bidang',width:100,hidden:'true'},
             {field:'nm_bidang',title:'Nama Bidang',width:100,hidden:'true'},
             {field:'kd_brg',title:'Kode Barang',width:150},
             {field:'nm_brg',title:'Nama Barang',width:250},
             {field:'kd_unit',title:'Unit',width:100,hidden:'true'},
             {field:'kd_uskpd',title:'SKPD',width:100,hidden:'true'},
             {field:'s_dana',title:'Sumber Dana',width:100,hidden:'true'},
             {field:'no_sp2d',title:'No SP2D',width:150},
             {field:'tgl_sp2d',title:'TGL SP2D',width:100,hidden:'true'},
             {field:'nilai_sp2d',title:'Nilai SP2D',width:100,align:'right'},
             {field:'nilai_kontrak',title:'Nilai Kontrak',width:100,hidden:'true'},
             {field:'kd_kegiatan',title:'Kode Kegiatan',width:100,hidden:'true'},
             {field:'nm_kegiatan',title:'Nama Kegiatan',width:100,hidden:'true'},
             {field:'kd_rek5',title:'Kode Rekening',width:100,hidden:'true'},
             {field:'nm_rek5',title:'Nama Rekening',width:100,hidden:'true'},
             {field:'jumlah',title:'Jumlah',width:100,hidden:'true'},
             {field:'harga',title:'Harga/Unit',width:100,align:'right'},
             {field:'ppn',title:'PPN',width:100,hidden:'true'},
             {field:'total',title:'Total',width:100,align:'right'},
             {field:'keterangan',title:'Keterangan',width:100,hidden:'true'},
             {field:'invent',title:'Inventaris',width:100,hidden:'true'}, 
             {field:'hapus',width:30,align:'center',formatter:function(value,rec)
             {return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus_detail();''/>";}}
                     
                ]]  
            });
        });
}

function getRowIndex(target){  
            var tr = $(target).closest('tr.datagrid-row');  
            return parseInt(tr.attr('datagrid-row-index'));  
        } 

function sp2d_dh(){
    var kduskpd     = $('#unit').combogrid('getValue');
    var sp2d = document.getElementById('sp2d').value;
    var giat = document.getElementById('kegiatan').value;
    var rek = document.getElementById('rekening').value;
    var jns = document.getElementById('jns_spp').value;
    var nom = $('#nomor').combogrid('getValue');
    $(function(){
    $('#nosp2d').combogrid({  
                   panelWidth : 700,
                   //multiple   : true,  
                   idField    : 'no_sp2d',  
                   textField  : 'no_sp2d',  
                   mode       : 'remote',
                   url        : '<?php echo base_url(); ?>index.php/master/ambil_sp2d',
                   queryParams :({kdskpd:kduskpd,sp2d:sp2d,giat:giat,rek:rek,jns:jns,nom:nom}),  
                   columns:[[  
                       {field:'no_sp2d',title:'No SP2D',width:200},  
                       {field:'tgl_sp2d',title:'Tanggal',width:80},
                       {field:'nilai2',title:'Nilai',width:100,align:'right'},
                       {field:'keperluan',title:'Keterangan',width:320}    
                   ]],  
                   onSelect:function(rowIndex,rowData){
                    nil=rowData.nilai;
                    $('#tglsp2d').datebox("setValue",rowData.tgl_sp2d);
                    $('#nilsp2d').attr('value',rowData.nilai2);
                    $('#nilsp2d_hide').attr('value',number_format(nil,2,'.',''));
                       
                   } 
            });
    
    });
}
/*function no_rencana(){
    var kduskpd     = $('#unit').combogrid('getValue');
    
    $(function(){
    $('#nomor_rencana').combogrid({  
                panelWidth:1000,  
                idField:'no_rencana',  
                textField:'no_rencana',  
                mode:'remote',
                url:'<?php echo base_url(); ?>index.php/master/ambil_nomor_kontrak_rencana',
                queryParams :({kdskpd:kduskpd}),   
                columns:[[  
                    {field:'no_rencana',title:'No Kontrak',width:225},  
                    {field:'nilai',title:'Nilai Kontrak',width:100,align:'right'},
                    {field:'jasa',title:'Jenis Jasa',width:200},
                    {field:'keterangan',title:'Keterangan',width:475}    
                ]],
                onSelect:function(rowIndex,rowData){
                    
                }  
                });
    });
}*/
/*function no_pengawas(){
    var kduskpd     = $('#unit').combogrid('getValue');
    
    $(function(){
    $('#nomor_awas').combogrid({  
                panelWidth:1000,  
                idField:'no_awas',  
                textField:'no_awas',  
                mode:'remote',
                url:'<?php echo base_url(); ?>index.php/master/ambil_nomor_kontrak_awas',
                queryParams :({kdskpd:kduskpd}),   
                columns:[[  
                    {field:'no_awas',title:'No Kontrak',width:225},  
                    {field:'nilai',title:'Nilai Kontrak',width:100,align:'right'},
                    {field:'jasa',title:'Jenis Jasa',width:200},
                    {field:'keterangan',title:'Keterangan',width:475}    
                ]],
                onSelect:function(rowIndex,rowData){
                    
                }  
                });
    });
}*/

function sp2d_dh_update(){
    var kduskpd     = $('#unit').combogrid('getValue');
   
    /*var sp2d = document.getElementById('sp2d_u').value;
    alert('sp2d update   '+sp2d);*/
    $(function(){
    $('#nosp2d_u').combogrid({  
                   panelWidth : 700,  
                   idField    : 'no_sp2d',  
                   textField  : 'no_sp2d',  
                   mode       : 'remote',
                   url        : '<?php echo base_url(); ?>index.php/master/ambil_sp2d',
                   queryParams :({kdskpd:kduskpd}),  
                   columns:[[  
                       {field:'no_sp2d',title:'No SP2D',width:200},  
                       {field:'tgl_sp2d',title:'Tanggal',width:80},
                       {field:'nilai2',title:'Nilai',width:100,align:'right'},
                       {field:'keperluan',title:'Keterangan',width:320}    
                   ]],  
                   onSelect:function(rowIndex,rowData){
                    nil=rowData.nilai;
                    $('#tglsp2d_u').datebox("setValue",rowData.tgl_sp2d);
                    $('#nilsp2d_u').attr('value',rowData.nilai2);
                    $('#nilsp2d_hide_u').attr('value',number_format(nil,2,'.',''));
                       
                   } 
            });
    
    });
} 

/*function rekening(){
    var kegiatan = document.getElementById('kegiatan').value;
    $(function(){
        $('#rekening').combogrid({
            panelWidth  : 500,
            idField     : 'kd_rek5',
            textField   : 'kd_rek5',
            mode        : 'remote',
            url         : '<?php echo base_url(); ?>index.php/master/ambil_rekening',
            queryParams : ({keg:kegiatan}),
            columns     :[[
                {field:'kd_rek5',title:'Kode Rekening',width:150},
                {field:'nm_rek5',title:'Nama Rekening',width:350}
            ]],
            onSelect:function(rowIndex,rowData){
                $('#nm_rekening').attr('value',rowData.nm_rek5);
            }
        });
    });
}*/

  

function tab1(){
    $('#tabs1').click();
    $('#trh').edatagrid('reload');      
}
function tab2(){
   $('#tabs2').click()
  }

function kosong(){
	var cthn = '<?php echo ($this->session->userdata('ta_simbakda')); ?>';
	var skpd = '<?php echo ($this->session->userdata('skpd'));?>';
	//var unit_skpd = '<?php echo ($this->session->userdata('unit_skpd'));?>';
    var cdate 	= '<?php echo date("Y-m-d"); ?>';
    $('#unit').combogrid('setValue',skpd);
    $('#unit').combogrid("clear");
    $('#mlokasi').attr('value','');
    $('#tahun').combobox('setValue',cthn);
    $('#txtnodok_h').attr('value','');
    $('#sp2d').attr('value','');
    $('#tanggal').datebox('setValue',cdate);
    $('#nilkont').attr('value','');
    $('#nilapbd').attr('value','');
    $('#compy').combobox('setValue','');
    //$('#milik').combobox('setValue','');
    //$('#wilayah').combobox('setValue','');
    $('#dana').combobox('setValue','');
    $('#bukti').combobox('setValue','');
    $('#dasar').combobox('setValue','');
    $('#dsno').attr('value','');
    $('#dstgl').datebox('setValue',cdate);
    $('#thn2').combobox('setValue','');    
    $('#perolehan').combobox('setValue','');
    $('#krg').attr('value','');
    $('#nmunit').attr('value',''); 
    $('#nmlokasi').attr('value','');
    $('#total').attr('value','0');
    $("#total2").attr('value','');   
    $('#nomor').combogrid('clear'); 
    $("#nomor").combogrid('grid').datagrid('reload');
    $('#nilkont_hide').attr('value','');
    $('#nkon').attr('value','0');
    $('#nkon_hide').attr('value','');
    $('#totbel').attr('value','0');
    $('#totbel_hide').attr('value','');
    $('#nomor').combogrid('enable');
    //$("#nomor_rencana").combogrid('disable');
    //$("#nomor_awas").combogrid('disable');
    //$("#nomor_rencana").combogrid('clear');
    //$("#nomor_awas").combogrid('clear');
    $('#c_simpan').linkbutton("enable");
    $('#tambah_det').linkbutton("enable");
    $('#sts_kdp').attr('value','');
    $("#sts_kdp").attr("disabled",false);
    var pidx  = 0   ;
    updt = 'f';
    load_detail_kosong_dh();
    ambil_nomor();
	//max_rinci();
}
function kosong2(){  
    
    $("#dialog-modal :checkbox").attr("checked",false);
	//$('#cmbjenis').combobox('setValue','');
    $('#cmbjenis').combogrid('clear');
	$('#bidang').combogrid('setValue','');
	$('#sbrdana').combobox('setValue','');
    $('#nmbrg').attr('value','');
    //$('#kegiatan').attr('value','');
    $('#nosp2d').combogrid('clear');
    //$('#rekening').combogrid('clear');
    //$('#rekening').attr('value','');
    $('#jumlah').attr('value','');
    $('#harga').attr('value','');
    $('#total1').attr('value','');
    $('#nilppn').attr('value','');
    $('#total2').attr('value','');
    //$('#ket').attr('value','');
    $('#nmgolongan').attr('value','');
    $('#nmbidang').attr('value','');
    $('#nmkelompok').attr('value','');
    $('#kdbarang').combogrid('clear');
    //$('#nm_kegiatan').attr('value','');
    //$('#nm_rekening').attr('value','');
    //cdate 		= '<?php echo date("Y-m-d"); ?>';
    //$('#dstgl').datebox('setValue',cdate);
    updt = 't'; 
}
function getData(no_bukti,no,tgl,nilkon,nilapbd,kdcomp,kdmilik,kdwilayah,kduskpd,kd_unit,jnsdana,tahunang,buktibyr,dasaroleh,nooleh,tgloleh,tahunoleh,tot,cr_oleh,no_renc,no_awas,nrek5,sts_kdp)
	{
    //kosong();
    $('#txtnodok_h').attr('value',no);
    $('#nomor_bukti').attr('value',no_bukti);
    $('#nomor').combogrid('setValue',no);
    //$('#nomor_rencana').combogrid('setValue',no_renc);
    //$('#nomor_awas').combogrid('setValue',no_awas); 
    $('#tanggal').datebox('setValue',tgl);
    $('#nilkont').attr('value',nilkon);
    $('#nkon_hide').attr('value',nrek5);
    $('#nkon').attr('value',number_format(nrek5,2,'.',','));
    $('#nilapbd').attr('value',nilapbd);
    $('#compy').combobox('setValue',kdcomp);
    //$('#milik').combobox('setValue',kdmilik);
    //$('#wilayah').combobox('setValue',kdwilayah);
    $('#mlokasi').attr('value',kd_unit); 
    $('#unit').combogrid('setValue',kduskpd);
    $('#dana').combobox('setValue',jnsdana);
    $('#tahun').combobox('setValue',tahunang);
    $('#bukti').combobox('setValue',buktibyr);
    $('#dasar').combobox('setValue',dasaroleh);
    $('#dsno').attr('value',nooleh);
    $('#dstgl').datebox('setValue',tgloleh);
    $('#thn2').combobox('setValue',tahunoleh);    
    $('#total').attr('value',number_format(tot,2,'.',','));
    $('#totbel').attr('value',number_format(tot,2,'.',','));
    $('#totbel_hide').attr('value',tot);
    $('#perolehan').combobox('setValue',cr_oleh);
    $('#sts_kdp').attr('value',sts_kdp);
    updt = 't';
     
      
}


function getDetail(no,cjns,cnmjns,kdbrg,nmbrg,sdana,nosp2d,tglsp2d,nilsp2d,nilkont,kdgiat,kdrek5,jml,hrg,cppn,tot,ket,invt)
{
    kosong2();
    updt = 't';
    $("#cmbjenis").combobox("setValue",cjns);
    $("#bidang").combobox("setValue",cbdg);
	$("#cmkel").combobox("setValue",ckel);
    $("#cmsubkel").combobox("setValue",csubkel);
    $("#kdbrg").combogrid("setValue",kdbrg);
    $("#nmbrg").attr("value",nmbrg);
    $("#sbrdana").combobox("setValue",sdana);
    $("#nosp2d").combogrid("setValue",nosp2d);
    $("#tglsp2d").datebox("setValue",tglsp2d);
    $("#nilsp2d").attr("value",nilsp2d);
    $("#nilkon1").attr("value",nilkont);
    $("#kegiatan").attr("value",kdgiat);
    $("#rekening").attr("value",kdrek5);
    $("#jumlah").attr("value",jml);
    $("#harga").attr("value",hrg);
    $("#nilppn").attr("value",cppn);
    if (angka(cppn)==0){
        $("#ppn").attr("checked",false);
    }else{
        $("#ppn").attr("checked",true);
    }
    $("#total2").attr("value",tot);
    total_updt = tot;
    $("#ket").attr("value",ket);    
    hitung();    
    tambah_detail();
}


function loadDetail(no_bukti,no,nilkon1,tot){
    var no_bukti = no_bukti;
    var nomor = no;//$('#nomor').combogrid('getValue');
    var nilkon1=nilkon1;
    var tot = tot;
     $(function(){
            $('#trd').edatagrid({
                url: '<?php echo base_url(); ?>/index.php/transaksi/trd_isianbrg',
                queryParams:({ no_bukti:no_bukti,no:nomor,nilkon:nilkon1,tot:tot }),
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
                    idx=rowData.idx;
                    nomor_bukti=rowData.no_bukti;
                    no_dokumen=rowData.no_dokumen ;
                    jns=rowData.jns ;
                    nm_jenis=rowData.nm_jenis ;
                    kd_bidang=rowData.kd_bidang ;
                    nm_bidang=rowData.nm_bidang ;
                    kd_brg=rowData.kd_brg ;
                    nm_brg=rowData.nm_brg ;
                    kd_unit=rowData.kd_unit ;
                    kd_uskpd=rowData.kd_uskpd ;
                    s_dana=rowData.s_dana ;
                    no_sp2d=rowData.no_sp2d ;
                    tgl_sp2d=rowData.tgl_sp2d ;
                    nilai_sp2d=number_format(rowData.nilai_sp2d,2,'.',',');
                    nilai_kontrak=rowData.nilai_kontrak ;
                    kd_kegiatan=rowData.kd_kegiatan ;
                    nm_kegiatan=rowData.nm_kegiatan ;
                    kd_rek5=rowData.kd_rek5 ;
                    nm_rek5=rowData.nm_rek5 ;
                    jumlah=rowData.jumlah ;
                    harga=number_format(rowData.harga,2,'.',',');
                    ppn=number_format(rowData.ppn,2,'.',',');
                    total=number_format(rowData.total,2,'.',',');
                    keterangan=rowData.keterangan ;
                    invent=rowData.invent ;
                    //$('#kdbarang_u').combogrid('disable');
                    
                    //update_detail(idx);

                },
                 columns:[[
                     {field:'idx',title:'idx',width:100,align:'left',hidden:'true'},
                     {field:'nomor_bukti',title:'nomor_bukti',width:100,align:'left',hidden:'true'},               
                     {field:'no_dokumen',title:'Nomor',width:100,hidden:'true'},
                    {field:'jns',title:'Jenis',width:100,hidden:'true'},
             {field:'nm_jenis',title:'Nama Jenis',width:100,hidden:'true'},
             {field:'kd_bidang',title:'Kode Bidang',width:100,hidden:'true'},
             {field:'nm_bidang',title:'Nama Bidang',width:100,hidden:'true'},
             {field:'kd_brg',title:'Kode Barang',width:150},
             {field:'nm_brg',title:'Nama Barang',width:250},
             {field:'kd_unit',title:'Unit',width:100,hidden:'true'},
             {field:'kd_uskpd',title:'SKPD',width:100,hidden:'true'},
             {field:'s_dana',title:'Sumber Dana',width:100,hidden:'true'},
             {field:'no_sp2d',title:'No SP2D',width:150},
             {field:'tgl_sp2d',title:'TGL SP2D',width:100,hidden:'true'},
             {field:'nilai_sp2d',title:'Nilai SP2D',width:100,align:'right'},
             {field:'nilai_kontrak',title:'Nilai Kontrak',width:100,hidden:'true'},
             {field:'kd_kegiatan',title:'Kode Kegiatan',width:100,hidden:'true'},
             {field:'nm_kegiatan',title:'Nama Kegiatan',width:100,hidden:'true'},
             {field:'kd_rek5',title:'Kode Rekening',width:100,hidden:'true'},
             {field:'nm_rek5',title:'Nama Rekening',width:100,hidden:'true'},
             {field:'jumlah',title:'Jumlah',width:100,hidden:'true'},
             {field:'harga',title:'Harga/Unit',width:100,align:'right'},
             {field:'ppn',title:'PPN',width:100,hidden:'true'},
             {field:'total',title:'Total',width:100,align:'right'},
             {field:'keterangan',title:'Keterangan',width:100,hidden:'true'},
             {field:'invent',title:'Inventaris',width:100,hidden:'true'}, 
             {field:'hapus',width:30,align:'center',formatter:function(value,rec)
             {return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus_detail();''/>";}}
                     
                ]]  
            });
        });
    $('#trd').edatagrid('unselectAll');
}

function update_detail(idx){    
    $("#dialog-modal-update").dialog('open');
    var skpd= $('#unit').combogrid('getValue');
       alert('index update_detail   '+idx);
    nilkont     = document.getElementById('nilkont').value;
    nilkont_hide     = document.getElementById('nilkont_hide').value;
    nilapbd     = document.getElementById('nilapbd').value;
    nilsp2d     = document.getElementById('nilsp2d').value;
    kegiatan     = document.getElementById('kegiatan').value;
    rekening     = document.getElementById('rekening').value;
    //nm_kegiatan     = document.getElementById('nm_kegiatan').value;
    //nm_rekening     = document.getElementById('nm_rekening').value;
    $('#idx').attr('value',idx);
    $('#cmbjenis_u').combogrid("setValue",jns);
    $('#cmbjenis_u').combogrid('disable');
    $('#nmgolongan_u').attr('Value',nm_jenis);
    $('#bidang_u').combogrid('setValue',kd_bidang);
    $('#bidang_u').combogrid('disable');
    $('#nmbidang_u').attr('Value',nm_bidang);
    $('#kdbarang_u').combogrid('setValue',kd_brg);
    $('#kdbarang_u').combogrid('disable');
    $('#nmkelompok_u').attr('Value',nm_brg);
    $('#nosp2d_u').combogrid('setValue',no_sp2d);
    //$('#sp2d_dh_update').attr('Value',no_sp2d);
    sbrdana     = $('#dana').combobox('getValue');
    sp2d_dh_update();
    $('#jumlah_u').attr('value',jumlah);
    $('#harga_u').attr('value',harga);
    $('#nilppn_u').attr('value',ppn);
    if (angka(ppn)==0){
        $("#ppn_u").attr("checked",false);
    }else{
        $("#ppn_u").attr("checked",true);
    }
    $('#total1_u').attr('value',total);
    hitung_update();

    $('#tglsp2d_u').datebox('setValue',tgl_sp2d);
    $('#nilkon1_u').attr('value',nilkont);
    $('#nilkon1_hide_u').attr('value',nilkont_hide); 
    $('#nilsp2d_u').attr('value',nilai_sp2d);
    $('#ket_u').attr('value',keterangan);   
    
    $('#sbrdana_u').combobox('setValue',sbrdana);
    $('#nmbrg_u').attr('value','');
    
    
    $('#kegiatan_u').attr('value',kd_kegiatan);
    $('#rekening_u').attr('value',kd_rek5);
    $('#nm_kegiatan_u').attr('value',nm_kegiatan);
    $('#nm_rekening_u').attr('value',nm_rek5);
    
    
    
    
    //$('#total2_u').attr('value','');
    
    
    
    
    $('#nilsp2d_hide_u').attr('value',nilai_sp2d);

    
}

function load_sum_trd_isianbrg(){
        var kduskpd     = $('#unit').combogrid('getValue');                
        var nomor = document.getElementById('nomor').value;               
        $(function(){      
         $.ajax({
            type      : 'POST',
            data      : ({no:nomor,kduskpd:kduskpd}),
            url       : "<?php echo base_url(); ?>index.php/transaksi/load_sum_trd_isianbrg",
            dataType  : "json",
            success   : function(data){ 
                $.each(data, function(i,n){
                    
                    $("#total").attr("value",n['rektotal']);
                });
            }
         });
        });
    }

function set_grid(){
    //$(function(){
    $('#trd').edatagrid({
        columns:[[
            {field:'idx',title:'idx',width:100,align:'left',hidden:'true'},
            {field:'nomor_bukti',title:'nomor_bukti',width:100,align:'left',hidden:'true'},   	                          
             {field:'no_dokumen',title:'Nomor',width:100,hidden:true},
             {field:'jns',title:'Jenis',width:100,hidden:true},
             {field:'nm_jenis',title:'Nama Jenis',width:100,hidden:true},
             {field:'kd_bidang',title:'Kode Bidang',width:100,hidden:true},
             {field:'nm_bidang',title:'Nama Bidang',width:100,hidden:true},
             {field:'kd_brg',title:'Kode Barang',width:150},
             {field:'nm_brg',title:'Nama Barang',width:250},
             {field:'kd_unit',title:'Unit',width:100,hidden:true},
             {field:'kd_uskpd',title:'SKPD',width:100,hidden:true},
             {field:'s_dana',title:'Sumber Dana',width:100,hidden:true},
             {field:'no_sp2d',title:'No SP2D',width:150},
             {field:'tgl_sp2d',title:'TGL SP2D',width:100,hidden:true},
             {field:'nilai_sp2d',title:'Nilai SP2D',width:100,align:'right'},
             {field:'nilai_kontrak',title:'Nilai Kontrak',width:100,hidden:true},
             {field:'kd_kegiatan',title:'Kode Kegiatan',width:100,hidden:true},
             {field:'nm_kegiatan',title:'Nama Kegiatan',width:100,hidden:true},
             {field:'kd_rek5',title:'Kode Rekening',width:100,hidden:true},
             {field:'nm_rek5',title:'Nama Rekening',width:100,hidden:true},
             {field:'jumlah',title:'Jumlah',width:100,hidden:true},
             {field:'harga',title:'Harga/Unit',width:100,align:'right'},
             {field:'ppn',title:'PPN',width:100,hidden:true},
             {field:'total',title:'Total',width:100,align:'right'},
             {field:'keterangan',title:'Keterangan',width:100,hidden:true},
             {field:'invent',title:'Inventaris',width:100,hidden:true}, 
             {field:'hapus',width:30,align:'center',formatter:function(value,rec)
             {return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus_detail();''/>";}}

		]]
    });
   // });
}

function hitung(){
    tot_trans=angka(document.getElementById('total').value);
    kont    = angka(document.getElementById('nkon').value);
    jml 	= angka(document.getElementById('jumlah').value);
    hrg 	= angka(document.getElementById('harga').value);
    chk 	= document.getElementById('ppn').checked;
    total 	= jml * hrg;//jml * (kont/jml);//hrg ; 
    tt      = tot_trans+total;
    if (chk==true){
        totppn = total * 10/100;
        tothrg = total - totppn;        
    } else {
        totppn = 0;
        tothrg = total;
    }
    
    if(tt>kont){
        sweetAlert("MAAF..!!", "Total Tidak Boleh Melebihi Nilai Kontrak", "error");
        $('#harga').attr('value',0);
        $('#jumlah').attr('value',0);
        $('#total2').attr('value',0);
        exit();
    }
    total 	= number_format(total,2,'.',',');
    $('#total1').attr('value',total);        
    totppn 	= number_format(totppn,2,'.',',');
    $('#nilppn').attr('value',totppn);
    tothrg 	= number_format(tothrg,2,'.',',');
    $('#total2').attr('value',tothrg);
    //hsl     = number_format(hsl,2,'.',',');
    //$('#harga').attr('value',hsl);
}

function hitung_update(){
    kont    = document.getElementById('nkon_hide').value; 
    jml     = angka(document.getElementById('jumlah').value); 
    hrg     = angka(document.getElementById('harga').value); 
    totbel  = angka(document.getElementById('totbel_hide').value); 
    total   = (kont - totbel)/jml;
    
    total   = number_format(total,2,'.',',');
    $('#harga').attr('value',total);        
    hitung();
}

function hapus(){
      var rows  = $('#trh').datagrid('getSelected');
      var nomor = rows.no_dokumen;
      var skp   = rows.kd_uskpd;
      var invent= rows.invent;
      var no_renc = rows.no_rencana;
      var no_awas = rows.no_awas; 
      var no_bukti = rows.no_bukti;
      if(invent==1){
        alert('Data Sudah Di-Inventariskan dan Tidak Bisa Dihapus');
        exit();
      }else{
        var del   = confirm("Apakah Anda Yakin ingin menghapus data   "+nomor+"  "+skp+"?");
      }
    if(del==true){
        var urll = '<?php echo base_url(); ?>index.php/transaksi/hapus_isianbrg_523';
        $(document).ready(function(){
         $.post(urll,({no:nomor,skpd:skp,no_renc:no_renc,no_awas:no_awas,no_bukti:no_bukti}),function(data){
            status = data;
            if (status=='0'){
                alert('Gagal Hapus..!!');
                exit();
            } else {
                $('#trh').edatagrid('reload');
                exit();
            }
         });
        });    
      }
    } 




function hapus_detail(invent){
    var kduskpd     = $('#unit').combogrid('getValue');                
    var nomor = document.getElementById('nomor').value;
    var kdunit = document.getElementById('mlokasi').value;
    var rows = $('#trd').datagrid('getSelected');
    var ckd =   rows.kd_brg;
    var cnm =   rows.nm_brg;
    var ctot =   rows.total;
    var ctot2 =   angka(rows.total);
    var invent=rows.invent;
    var no_bukti=rows.no_bukti; 
     
                                    
    var idx = $('#trd').datagrid('getRowIndex',rows);
    if(invent==1){
        alert('Data Sudah Di-Inventariskan dan Tidak Bisa Dihapus');
        exit();
      }else{
        var tny = confirm('Yakin Ingin Menghapus Data, Kode Barang : '+ckd+' Nama Barang : '+cnm+' Nilai : '+ctot);
      }
    
    if (tny==true){        
        $('#trd').datagrid('deleteRow',idx);            
        
        /* var urll = '<?php  echo base_url(); ?>index.php/transaksi/dsimpan_trd_delete_dh';
             $(document).ready(function(){
             $.post(urll,({cskpd:kduskpd,no:nomor,kd_brg:ckd,kdunit:kdunit}),function(data){
             status = data;
                if (status=='0'){
                    alert('Gagal Hapus..!!');
                    exit();
                } else {
                    alert('Data Telah Terhapus..!!');
                    exit();
                }
             });
             }); */
        
        var total = angka(document.getElementById('total').value) - ctot2;  
           
        $('#total').attr('value',number_format(total,2,'.',','));
        $('#totbel').attr('value',number_format(total,2,'.',',')); 
        $('#totbel_hide').attr('value',number_format(total,2,'.',''));                          
        kosong2();
    }                     
}

function cekdulu()
 {
        var sd=$('#dstgl').datebox('getValue');
        var fd=$('#tanggal').datebox('getValue'); 
        
        var a= sd.length; 
        var c= fd.length; 

        if(c==8){
            var tglspp = fd.substr(7,8);
            var bulanspp = fd.substr(5,1);
            var tahunspp = fd.substr(0,4);
        }else if(c==9){
            var tglspp = fd.substr(7,9);
            var d = fd.substr(6,1);
            var tahunspp = fd.substr(0,4);
            if(d=='-'){
                var bulanspp = fd.substr(5,1);
            }else{
                var bulanspp = fd.substr(5,2);
            }
        }else if(c==10){
            var tglspp = fd.substr(8,10); 
            var bulanspp = fd.substr(5,2); 
            var tahunspp = fd.substr(0,4); 
        }


        

         if(sd=='' || sd=='0000-00-00'){
            alert("Tanggal Kas Tidak Boleh Kosong!!!");
            exit();
         }
         
         
        if (a==8){
            var tglspm = sd.substr(7,8);
            var bulanspm= sd.substr(5,1);
            var tahunspm = sd.substr(0,4);
        }else if(a==9){
            var tglspm =sd.substr(7,9);
            var tahunspm = sd.substr(0,4);
            var b= sd.substr(6,1);
        if(b=='-'){
            var bulanspm= sd.substr(5,1);
         }else{
            var bulanspm= sd.substr(5,2);
         }
        }else if(a==10){
            var tglspm = sd.substr(8,10);
            var bulanspm= sd.substr(5,2);
            var tahunspm = sd.substr(0,4);
         }
         
         if(tglspm<0){
             tglspm=tglspm*-1;
         }
         
         
        var tglsel=tglspm-tglspp;
        var blsel=bulanspm-bulanspp;
        var thnsel=tahunspm-tahunspp;

        if(thnsel<0)
        {

            var del   = confirm("Tahun Kurang   "+thnsel+"  Apakah Anda Yakin?");
                if(del==true){
                    tambah_detail();
                }else{
                    exit();
                }

           //alert("Tidak Boleh Kurang Tahun :"+thnsel);
         //exit();
        }

        if(blsel<0)
        {
            var del   = confirm("Bulan Kurang   "+blsel+"  Apakah Anda Yakin?");
                if(del==true){
                    tambah_detail();
                }else{
                    exit();
                }

           //alert("Tidak Boleh Kurang bulan : "+blsel);
         //exit();
        }else if(blsel==0){
             if(tglsel<0){
                var del   = confirm("Tanggal Kurang   "+tglsel+"  Apakah Anda Yakin?");
                if(del==true){
                    tambah_detail();
                }else{
                    exit();
                }
                 //alert("Tidak Boleh Kurang Tgl : "+tglsel);
                 }else{
                    tambah_detail();
                 }
        }else if(blsel>0){
            tambah_detail();
            
        }

 }

function tambah_detail(){    
       
    nilkont 	= document.getElementById('nilkont').value;
    nilkont_hide     = document.getElementById('nilkont_hide').value;
    nilapbd 	= document.getElementById('nilapbd').value; 
    nilapbd2     = angka(document.getElementById('nilapbd').value); 
    nilsp2d     = document.getElementById('nilsp2d').value;
    kegiatan     = document.getElementById('kegiatan').value;
    //rekening     = document.getElementById('rekening').value;
    nm_kegiatan     = document.getElementById('nm_kegiatan').value;
    nm_rekening     = document.getElementById('nm_rekening').value;

    var nomor = $('#nomor').combogrid('getValue');
    if(nomor==''){
        sweetAlert("MAAF..!!", "Nomor Dokumen Tidak Boleh Kosong....", "error");
        exit();
    }
    
    var jnsdana     = $('#dana').combobox('getValue');
    if(jnsdana==''){
        sweetAlert("MAAF..!!", "Jenis Dana Tidak Boleh Kosong....", "error");
        exit();
    }
    var buktibyr    = $('#bukti').combobox('getValue');
    if(buktibyr==''){
        sweetAlert("MAAF..!!", "Bukti Pembayaran Tidak Boleh Kosong....", "error");
        exit();
    }
    var cr_oleh     = $('#perolehan').combobox('getValue');
    if(cr_oleh==''){
        sweetAlert("MAAF..!!", "Cara Perolehan Tidak Boleh Kosong....", "error");
        exit();
    }
    var dasaroleh   = $('#dasar').combobox('getValue');
    if(dasaroleh==''){
        sweetAlert("MAAF..!!", "Dasar Perolehan Tidak Boleh Kosong....", "error");
        exit();
    }
    var nooleh      = document.getElementById('dsno').value;
    if(nooleh==''){
        sweetAlert("MAAF..!!", "Nomor Perolehan Tidak Boleh Kosong....", "error");
        exit();
    }


   // var sel = nilapbd2-nilkont_hide;
   // if(sel<0){
    //    alert('Nilai APBD Tidak Boleh Kurang Dari Nilai Kontrak');
    //    exit();
    //}else{
        $("#dialog-modal").dialog('open');
    //}

    sbrdana 	= $('#dana').combobox('getValue');
    cdate 		= '<?php echo date("Y-m-d"); ?>';
    $('#tglsp2d').datebox('setValue',cdate);
    $('#nilkon1').attr('value',nilkont);
    $('#nilkon1_hide').attr('value',nilkont_hide); 
    $('#nilsp2d').attr('value','');
	$('#cmbjenis').combogrid("clear");
    $('#sbrdana').combobox('setValue',sbrdana);
    $('#nmbrg').attr('value','');
	$('#bidang').combogrid('setValue','');
    $('#nosp2d').combogrid('setValue','');
    $('#kegiatan').attr('value',kegiatan);
    //$('#rekening').attr('value',kd_rek5);
    $('#nm_kegiatan').attr('value',nm_kegiatan);
    //$('#nm_rekening').attr('value',nm_rek5);
    $('#jumlah').attr('value','');
    $('#harga').attr('value','');
    $('#total1').attr('value','');
    $('#nilppn').attr('value','');
    $('#total2').attr('value','');
    //$('#ket').attr('value','');
    $('#nmgolongan').attr('Value','');
    $('#bidang').combogrid("clear");
    $('#kdbarang').combogrid("clear");
    $('#nmbidang').attr('Value','');
    $('#nmkelompok').attr('Value','');
    $('#nilsp2d_hide').attr('value','');

    sp2d_dh();
    //rekening(kegiatan);
}

function cetak_bap(){    
    $("#dialog-modal_bap").dialog('open');                    
}

function tutup(){ 
		 swal({
					title: "Jangan lupa disimpan.!!",
					type:"warning"
					});   
    $("#dialog-modal").dialog('close');
    $("#dialog-modal-update").dialog('close');
    $("#dialog-modal_bap").dialog('close');                      
}



function simpan(){
    var no_bukti    = document.getElementById('nomor_bukti').value;
    var no          = $('#nomor').combogrid('getValue');   
    var tgl         = $('#tanggal').datebox('getValue');  
    var nilkon      = document.getElementById('nilkont_hide').value;  
    var nilapbd     = angka(document.getElementById('nilapbd').value);  
    var kdcomp      = $('#compy').combobox('getValue');  
    var kdmilik     = document.getElementById('milik').value; //$('#milik').combobox('getValue');  
    var kdwilayah   = document.getElementById('wilayah').value;// $('#wilayah').combobox('getValue');  
    var kduskpd     = $('#unit').combogrid('getValue');  
    var mlokasi     = document.getElementById('mlokasi').value;  
    var jnsdana     = $('#dana').combobox('getValue');  
    var tahunang    = $('#tahun').combobox('getValue');  
    var buktibyr    = $('#bukti').combobox('getValue');  
    var dasaroleh   = $('#dasar').combobox('getValue');  
    var nooleh      = document.getElementById('dsno').value;  
    var tgloleh     = $('#dstgl').datebox('getValue');  
    var tahunoleh   = '<?php echo ($this->session->userdata('ta_simbakda')); ?>';   
    var tot         = angka(document.getElementById('total').value);     
    var cr_oleh     = $('#perolehan').combobox('getValue');
    var nkon        = document.getElementById('nkon_hide').value;
    var ntotbel     = document.getElementById('totbel_hide').value;
    var no_renc     = '';//$('#nomor_rencana').combogrid('getValue');
    var no_awas     = '';//$('#nomor_awas').combogrid('getValue');
    var sts_kdp     = document.getElementById('sts_kdp').value;
    var sel         =nkon-ntotbel;
    var selisih     =number_format(sel,2,',','.');
    $('#trd').datagrid('selectAll');
    var rows = $('#trd').datagrid('getSelections');

        for(var i=0; i<rows.length; i++){
                cidx        = rows[i].idx;
                jns         =rows[i].jns;

            }
    if(sel>0){
        sweetAlert("MAAF..!!", "Nilai Transaksi Kurang dari Nilai Kontrak", "error");
        $('#trd').datagrid('unselectAll');
        exit();
    }
    if(sel<0){
        sweetAlert("MAAF...!!","Total Transaksi Tidak Boleh Melebihi Nilai Kontrak        "+selisih);
        $('#trd').datagrid('unselectAll');
        exit();
    }
    if (no==''){
		sweetAlert("MAAF..!!", "Nomor Dokumen mohon diisi", "error");
        exit();
    } 
    if (tgl==''){
		sweetAlert("MAAF..!!", "Nomor Tanggal Dokumen mohon diisi", "error");
        exit();
    }
    if (jns!='01' ){
        if(kdcomp==''){
    		sweetAlert("MAAF..!!", "Rekanan mohon diisi", "error");
            exit();
        }
    }
    if (sts_kdp==''){
		sweetAlert("MAAF..!!", "Status mohon diisi", "error");
        exit();
    }            
    if (kduskpd==''){
		sweetAlert("MAAF..!!", "SKPD mohon diisi", "error");
        exit();
    }       
    
    //csql_h = " values('"+no+"','"+kdcomp+"','"+tgl+"','"+kdmilik+"','"+kdwilayah+"','"+mlokasi+"','"+kduskpd+"','"+jnsdana+"','"+buktibyr+"','"+dasaroleh+"','"+nooleh+"','"+tahunang+"','','"+tgloleh+"','"+tahunoleh+"','"+nilkon+"','"+nilapbd+"','user','<?php echo date('y-m-d H:i:s'); ?>','"+tot+"','"+cr_oleh+"')";
    $('#c_simpan').linkbutton("disable");
    $("#dialog-modal-aaa").dialog('open');
    $(document).ready(function(){
        $.ajax({
            type: "POST",       
            dataType : 'json',         
            data: ({tabel:'trh_isianbrg',no_bukti:no_bukti,no:no,tgl:tgl,nilkon:nilkon,nilapbd:nilapbd,kdcomp:kdcomp,kd_unit:kduskpd,kdmilik:kdmilik,kdwilayah:kdwilayah,mlokasi:mlokasi,jnsdana:jnsdana,tahunang:tahunang,buktibyr:buktibyr,dasaroleh:dasaroleh,nooleh:nooleh,tgloleh:tgloleh,tahunoleh:tahunoleh,tot:tot,cr_oleh:cr_oleh,no_renc:no_renc,no_awas:no_awas,sts_kdp:sts_kdp}),
            url: '<?php echo base_url(); ?>index.php/transaksi/simpan_isianbrg_523',
            success:function(data){
                simpan_detail_dh();
                                                                                                                    
            }
        });
   });  
                                  
}

function simpan_detail_dh(){
    var no_bukti    = document.getElementById('nomor_bukti').value;
    var no = $('#nomor').combogrid('getValue');
    var kduskpd     = $('#unit').combogrid('getValue');
    var csql = '';
    $('#trd').datagrid('selectAll');
    var rows = $('#trd').datagrid('getSelections');

        for(var i=0; i<rows.length; i++){
                no_bukti    = no_bukti;
                cidx        = rows[i].idx;
                no_dokumen  =rows[i].no_dokumen;
                jns         =rows[i].jns;
                nmjns       =rows[i].nm_jenis;
                kd_bidang   =rows[i].kd_bidang;
                cnmbidang   =rows[i].nm_bidang;
                kd_brg      =rows[i].kd_brg;
                nm_brg      =rows[i].nm_brg;
                kd_unit     =rows[i].kd_unit;
                kd_uskpd    =rows[i].kd_uskpd;
                s_dana      =rows[i].s_dana;
                no_sp2d     =rows[i].no_sp2d;
                tgl_sp2d    =rows[i].tgl_sp2d;
                nilai_sp2d  =angka(rows[i].nilai_sp2d);
                nilai_kontrak =rows[i].nilai_kontrak;
                kd_kegiatan =rows[i].kd_kegiatan;
                nm_kegiatan =rows[i].nm_kegiatan;
                kd_rek5     =rows[i].kd_rek5;
                nm_rek5     =rows[i].nm_rek5;
                jumlah      =angka(rows[i].jumlah);
                harga       =angka(rows[i].harga);
                ppn         =angka(rows[i].ppn);
                total       =angka(rows[i].total);
                keterangan  =rows[i].keterangan;
                invent      =rows[i].invent;
                               
                if(i>0){
                    csql = csql+","+"('"+no_bukti+"','"+no_dokumen+"','"+kd_unit+"','"+kd_uskpd+"','"+jns+"','"+nmjns+"','"+kd_bidang+"','"+cnmbidang+"','"+kd_brg+"','"+nm_brg+"','"+kd_kegiatan+"','"+nm_kegiatan+"','"+kd_rek5+"','"+nm_rek5+"','"+jumlah+"','"+harga+"','"+total+"','"+no_sp2d+"','"+tgl_sp2d+"','"+nilai_sp2d+"','"+keterangan+"','"+invent+"','"+ppn+"','0','"+s_dana+"','"+jns+"','"+nilai_kontrak+"')";
                } else {

                    csql = "values('"+no_bukti+"','"+no_dokumen+"','"+kd_unit+"','"+kd_uskpd+"','"+jns+"','"+nmjns+"','"+kd_bidang+"','"+cnmbidang+"','"+kd_brg+"','"+nm_brg+"','"+kd_kegiatan+"','"+nm_kegiatan+"','"+kd_rek5+"','"+nm_rek5+"','"+jumlah+"','"+harga+"','"+total+"','"+no_sp2d+"','"+tgl_sp2d+"','"+nilai_sp2d+"','"+keterangan+"','"+invent+"','"+ppn+"','0','"+s_dana+"','"+jns+"','"+nilai_kontrak+"')";                                            
                } 
        }
                $(document).ready(function(){
                $.ajax({
                    type: "POST", 
                    dataType:'json', 
                    url: '<?php echo base_url(); ?>/index.php/transaksi/simpan_isianbrg_523',   
                    data: ({tabel:'trd_isianbrg',no_bukti:no_bukti,no:no,sql:csql,kd_unit:kduskpd}),
                    
                    success:function(data){
                        status=data.pesan;
                        if(status=='1'){
                            $("#dialog-modal-aaa").dialog('close');
                            $('#trd').edatagrid('unselectAll');
                            sweetAlert("BERHASIL..!!", "Data Berhasil Disimpan", "success");
                            //$("#dialog-modal").dialog('close');
                            tab1();
                            $("#trh").edatagrid("reload");

                        }else{
                            $('#c_simpan').linkbutton("enable");
                            $("#dialog-modal-aaa").dialog('close');
                            swal({
                                title: "Oooopppppsssssssss!!!!!!!!!!",
                                text: "Data Gagal disimpan.!!",
                                imageUrl:"<?php echo base_url();?>/lib/images/er.jpg"
                                });
                        }   
                    }                                        
                });
            });
        //}
}

function append_save(){
    $('#trd').edatagrid('selectAll');
    var rows = $('#trd').edatagrid('getSelections');
    jgrid = rows.length ;
    var no_bukti    = document.getElementById('nomor_bukti').value;
    var no_dokumen  = $('#nomor').combogrid('getValue');    
    var cjns        = $('#cmbjenis').combobox('getValue');     
    var nmjns       = document.getElementById('nmgolongan').value;     
    var cbdg        = $('#bidang').combobox('getValue');    
    var cnmbidang   = document.getElementById('nmbidang').value;   
    var kdbrg       = $('#kdbarang').combogrid('getValue');     
    var cnmbrg      = document.getElementById('nmkelompok').value;     
    var nosp2d      = $('#nosp2d').combogrid('getValue');   
    var tglsp2d     = $('#tglsp2d').datebox('getValue');    
    var nilsp2d     = document.getElementById('nilsp2d').value;    
    var nilkont     = document.getElementById('nilkont_hide').value;    
    var kdgiat      = document.getElementById('kegiatan').value;    
    var nmkegi      = document.getElementById('nm_kegiatan').value;      
    var kdrek5      = document.getElementById('rekening').value; //$('#rekening').combogrid('getValue');   
    var nmrek5      = document.getElementById('nm_rekening').value;    
    var jml         = document.getElementById('jumlah').value;     
    var hrg         = document.getElementById('harga').value;         
    var tot1        = document.getElementById('total2').value;       
    var cppn        = document.getElementById('nilppn').value;          
    var tot         = angka(document.getElementById('total2').value);       
    var ket         = document.getElementById('ket').value;         
    var total       = angka(document.getElementById('total').value);   
    var kd_unit     = document.getElementById('mlokasi').value;     
    var kd_uskpd    = $('#unit').combogrid('getValue');     
    var sdana       = $('#dana').combobox('getValue');      
    var invt        ='';    
    var totalseluruh=0;


    if(cjns==''){
        alert('Golongan barang harap diisi.....');
        exit();
    }

    if(cbdg==''){
        alert('Bidang barang harap diisi.....');
        exit();
    }

    if(kdbrg==''){
        alert('Kode barang harap diisi.....');
        exit();
    }

    if(nosp2d==''){
        alert('Nomor SP2D harap diisi.....');
        exit();
    }

    if(jml==''){
        alert('Jumlah barang harap diisi.....');
        exit();
    }

    if(hrg==''){
        alert('Harga barang harap diisi.....');
        exit();
    }
    $('#nomor').combogrid('disable');
    if(updt='t'){
     pidx = jgrid ;
    pidx = pidx + 1 ;
    
    }else if(updt='f'){
      pidx = pidx + 1 ;
        
    }
    
    if(tot!=0){
        
        totalseluruh=total+tot;
        $('#trd').edatagrid('appendRow',{idx:pidx,nomor_bukti:no_bukti,no_dokumen:no_dokumen,jns:cjns,nm_jenis:nmjns,kd_bidang:cbdg,nm_bidang:cnmbidang,kd_brg:kdbrg,nm_brg:cnmbrg,kd_unit:kd_unit,kd_uskpd:kd_uskpd,s_dana:sdana,no_sp2d:nosp2d,tgl_sp2d:tglsp2d,nilai_sp2d:nilsp2d,nilai_kontrak:nilkont,kd_kegiatan:kdgiat,nm_kegiatan:nmkegi,kd_rek5:kdrek5,nm_rek5:nmrek5,jumlah:jml,harga:hrg,ppn:cppn,total:tot1,keterangan:ket,invent:invt});
        $('#total').attr('value',number_format(totalseluruh,2,'.',','));
        $('#totbel').attr('value',number_format(totalseluruh,2,'.',','));
        $('#totbel_hide').attr('value',totalseluruh);
        $('#trd').edatagrid('unselectAll');
        kosong2();
        alert('Data Telah Ditambahkan.....');
        tutup();
        exit();

    }

}

function append_save_update(){
    

    var rows = $('#trd').datagrid('getSelected');


    
    if(rows!=''){
        var idx = $('#trd').datagrid('getRowIndex',rows);
        $('#trd').edatagrid('deleteRow',idx);
    }else{
        var idx = document.getElementById('idx').value;
        $('#trd').edatagrid('deleteRow',idx);
    }

    
    $('#trd').edatagrid('unselectAll');
    
    $('#trd').edatagrid('selectAll');
    var rows = $('#trd').edatagrid('getSelections');
    jgrid = rows.length ;
    alert('idx jgrid   '+jgrid);
    pidx = jgrid ;
    alert('id akhir'+pidx);
    //$('#trd').edatagrid('unselectAll');
    var no_dokumen  = $('#nomor').combogrid('getValue');    
    var cmbjenis_u = $('#cmbjenis_u').combobox('getValue'); 
    var nmgolongan_u = document.getElementById('nmgolongan_u').value; 
    var bidang_u = $('#bidang_u').combobox('getValue'); 
    var nmbidang_u = document.getElementById('nmbidang_u').value; 
    var kdbarang_u = $('#kdbarang_u').combobox('getValue');
    
    var nmkelompok_u = document.getElementById('nmkelompok_u').value; 
    var sbrdana_u = $('#dana').combobox('getValue'); 
    var nosp2d_u = $('#nosp2d_u').combobox('getValue'); 
    
    var tglsp2d_u = $('#tglsp2d_u').datebox('getValue'); 
    var nilsp2d_hide_u = document.getElementById('nilsp2d_hide_u').value; 
    var nilkon1_hide_u = document.getElementById('nilkon1_hide_u').value; 
    var kegiatan_u = document.getElementById('kegiatan_u').value; 
    var nm_kegiatan_u = document.getElementById('nm_kegiatan_u').value;
    var rekening_u = document.getElementById('rekening_u').value; 
    var nm_rekening_u = document.getElementById('nm_rekening_u').value; 
    var jumlah_u = document.getElementById('jumlah_u').value; 
    var harga_u = angka(document.getElementById('harga_u').value); 
    var total1_u = angka(document.getElementById('total1_u').value); 
    var nilppn_u = document.getElementById('nilppn_u').value; 
    var total2_u = angka(document.getElementById('total2_u').value); 
    var ket_u = document.getElementById('ket_u').value; 
    var kd_uskpd    = $('#unit').combogrid('getValue'); 
    var kd_unit     = document.getElementById('mlokasi').value; 
    var invt        ='';
    
    var total = angka(document.getElementById('total').value);
    var totalseluruh=0;

    /*if(updt='t'){
     pidx = jgrid ;
    pidx = pidx + 1 ;
    
    }else if(updt='f'){
      pidx = pidx + 1 ;
        
    }*/
    
    if(total2_u!=0){
        
        totalseluruh=total+total2_u;
        $('#trd').edatagrid('appendRow',{idx:pidx,no_dokumen:no_dokumen,jns:cmbjenis_u,nm_jenis:nmgolongan_u,kd_bidang:bidang_u,nm_bidang:nmbidang_u,kd_brg:kdbarang_u,nm_brg:nmkelompok_u,kd_unit:kd_unit,kd_uskpd:kd_uskpd,s_dana:sbrdana_u,no_sp2d:nosp2d_u,tgl_sp2d:tglsp2d_u,nilai_sp2d:nilsp2d_hide_u,nilai_kontrak:nilkon1_hide_u,kd_kegiatan:kegiatan_u,nm_kegiatan:nm_kegiatan_u,kd_rek5:rekening_u,nm_rek5:nm_rekening_u,jumlah:jumlah_u,harga:harga_u,ppn:nilppn_u,total:total2_u,keterangan:ket_u,invent:invt});
    
        $('#total').attr('value',number_format(totalseluruh,2,'.',','));
        $('#trd').edatagrid('unselectAll');
        
        //$('#trd').edatagrid('reload');
    //    kosong2();
    }

}

function segarkan(){
    $('#trh').edatagrid('reload');
}

function tes(){
       $('#trd').datagrid('selectAll');
       var rows = $('#trd').datagrid('getSelections');                       
       for(var lp=0;lp<rows.length;lp++){
       }
}

function cetak(){
      
      $('#trd').datagrid('selectAll');
      var rows = $('#trd').datagrid('getSelections');    
      var ltotbaris = rows.length;
      lcisi = '&total_baris='+ltotbaris;
      for(var lp=0;lp<rows.length;lp++){ 
         lp1 = lp+1;
         lcnmbar = 'nmbar'+lp1;
         lcisibar = rows[lp].nm_brg;
         lcvol = 'vol'+lp1;
         lcisivol = rows[lp].jumlah;
         lcharga = 'harga'+lp1;
         lcisiharga = rows[lp].harga;
         lctot = 'total'+lp1;
         lcisitot = rows[lp].total;
         
         lcisi = lcisi+'&'+lcnmbar+'='+lcisibar+'&'+lcvol+'='+lcisivol+'&'+lcharga+'='+lcisiharga+'&'+lctot+'='+lcisitot;
      }
      url1 = "<?php echo base_url(); ?>index.php/laporan/ctk_bap1";
      var lcnmunit = $('#unit').combogrid('getValue'); 
      var lcnobap = document.getElementById('no_bap').value;
      var lchari = $('#hari').combobox('getValue'); 
      var lccom = $('#compy').combobox('getValue');
      var ldtglbap = $('#tgl_bap').datebox('getValue'); 
      var ldtgl_cetak = $('#tgl_ctk_bap').datebox('getValue');
      var lckepda = document.getElementById('kepda').value;
      var lcbln = $('#bln_bap').combobox('getValue'); 
      var ldtgl_kep = $('#tgl_kep').datebox('getValue');
      var lcthn = document.getElementById('tahun_bap').value;
      var lcawas1 = $('#pengawas1').combobox('getValue');
      var lcawas2 = $('#pengawas2').combobox('getValue');
      var lcawas3 = $('#pengawas3').combobox('getValue');
      var lcawas4 = $('#pengawas4').combobox('getValue');
      var lcawas5 = $('#pengawas5').combobox('getValue');
      var lcawas6 = $('#pengawas6').combobox('getValue');
      var lcawas7 = $('#pengawas7').combobox('getValue');
      var lcjabat1 = $('#jabat_awas1').combobox('getValue');
      var lcjabat2 = $('#jabat_awas2').combobox('getValue');
      var lcjabat3 = $('#jabat_awas3').combobox('getValue');
      var lcjabat4 = $('#jabat_awas4').combobox('getValue');
      var lcjabat5 = $('#jabat_awas5').combobox('getValue');
      var lcjabat6 = $('#jabat_awas6').combobox('getValue');
      var lcjabat7 = $('#jabat_awas7').combobox('getValue');
      
      var lckontrak = document.getElementById('kontrak_bap').value;
      var ldtgl_kontrak = $('#tgl_kontrak_bap').datebox('getValue');
      var lckegiatan = document.getElementById('kegiatan_bap').value;
      var lckerja = document.getElementById('pekerjaan_bap').value;
      var lclokasi = document.getElementById('lokasi_bap').value;
      var lnnilai_bap = document.getElementById('nilai_bap').value;
      var lcsumberdana = document.getElementById('dana_bap').value;
       
      lc1 = '?no_bap='+lcnobap+'&hari='+lchari+'&tgl_bap='+ldtglbap+'&tgl_cetak='+ldtgl_cetak+'&kepda='+lckepda+'&bln_bap='+lcbln+'&tgl_kep='+ldtgl_kep;
      lc2 = '&tahun_bap='+lcthn+'&pengawas1='+lcawas1+'&pengawas2='+lcawas2+'&pengawas3='+lcawas3+'&pengawas4='+lcawas4+'&pengawas5='+lcawas5+'&pengawas6='+lcawas6+'&pengawas7='+lcawas7;
      lc3 = '&jabat1='+lcjabat1+'&jabat2='+lcjabat2+'&jabat3='+lcjabat3+'&jabat4='+lcjabat4+'&jabat5='+lcjabat5+'&jabat6='+lcjabat6+'&jabat7='+lcjabat7+'&comp='+lccom;
      lc4 = '&kontrak='+lckontrak+'&tgl_kontrak='+ldtgl_kontrak+'&kegiatan='+lckegiatan+'&pekerjaan='+lckerja+'&lokasi='+lclokasi+'&nilai='+lnnilai_bap+'&dana='+lcsumberdana+'&nmunit='+lcnmunit;
      
      lc = lc1+lc2+lc3+lc4;
      var pariabel = url1+lc+lcisi;
      cetak_bap1(pariabel);
      window.open(url+lc,'_blank');
      window.focus();  
      
    } 
    
    function cetak_bap1(pariabel){
        window.open(pariabel,'_blank');
        window.focus();
    }

    function coba(){
        lc = '';
        for(var lp=0;lp<5;lp++){
            lcpar = 'par'+lp
            lcisi = 'isi'+lp
                        
            lc = lc + '&'+lcpar+'='+lcisi
            
        }
    }
	
	function max_rinci(){  
	var organisasi = $('#unit').combogrid('getValue');
		$.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>index.php/transaksi/load_idmax',
            data: ({skpd:organisasi,table:'trh_isianbrg',kolom:'no_dokumen',kolom_skpd:'kd_uskpd'}),
            dataType:"json",
            success:function(data){                                          
                $.each(data,function(i,n){                                    
                    no		      = n['kode'];
					no_urut		  = tambah_urut(no,4); 
					$("#nomor").attr("value",no_urut); 
                });
            }
        }); 
	 }
	 
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

    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    $(function(){ 
     $('#trh').edatagrid({
        url: '<?php echo base_url(); ?>/index.php/transaksi/trh_isianbrg',
        queryParams:({cari:kriteria})
        });        
     });
    } 

    function ambil_nomor(){
        var tab = 'trh_isianbrg';
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>/index.php/master/max_nomor',
            data: ({tabel:tab}),
            dataType:"json",
                success: function(data){
                $("#nomor_bukti").attr("value",data.nomor);
            }
        });
    }

    function cek_kdp(){
        if(updt=='f'){
            var nomor = $('#nomor').combogrid('getValue');
            var kdrek = document.getElementById('rekening').value;
        }else{
            var nomor = '';
            var kdrek = '';
        }
        
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>/index.php/transaksi/cekno_kdp',
            data: ({nomor:nomor,kdrek:kdrek}),
            dataType:"json",
                success: function(data){
                
                    $.each(data,function(i,n){
                    var xxx = n['jumlah'];
                    if(xxx==1){
                      $('#sts_kdp').attr('value','L');

                      swal({
                      title:"Sudah Ada Data KDP" ,
                      text:"Status KDP Akan Dialihkan Ke Pencairan Lanjutan KDP",
                      html:true,
                      confirmButtonColor: "blue",
                      type: "warning",
                      //timer: 10000,
                      confirmButtonText: "Ya",
                      showConfirmButton: true
                    });
                    }else{
                      $('#sts_kdp').attr('value','');
                    }
                });
              }
            });
    }
</script>

<div id="tabs" class="easyui-tabs">
		<p><h3 align="center">FORMULIR PENGADAAN BARANG 523</h3></p>
    <ul style="background-color:#2da305;">
        <li><a href="#tabs-1" style="width: 938px;" id="tabs1" onclick="javascript:segarkan()">List View</a></li>
        <li><a href="#tabs-2" style="width: 453px;" id="tabs2">Form Input</a></li>        
    </ul>
    <div id="tabs-1">
        <div>
            <p align="left">
                <input style="background-color:#07adeb ;width:20px;border:solid 1px #000000;" disabled/>
                <b>#Sudah di Inventarisasi</b>&nbsp;
                <input style="background-color:#FFF;width:20px;border:solid 1px #000000;" disabled/>
                <b>#Belum di Inventarisasi</b>&nbsp;
                <input style="background-color:#00ffb5;width:20px;border:solid 1px #000000;" disabled/>
                <b>#KDP</b>&nbsp;
                <input style="background-color:#cfcfcf;width:20px;border:solid 1px #000000;" disabled/>
                <b>#Lanjutan KDP</b>&nbsp;
                <input style="background-color:#dffd8b;width:20px;border:solid 1px #000000;" disabled/>
                <b>#Bukan KDP</b>&nbsp;
            </p>
            <p align="right">
                <a class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="javascript:kosong();tab2();">Tambah</a>
                <!--a class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:hapus();">Hapus</a-->                           
                <a class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="javascript:cari();" >Cari</a>
                <input type="text" value="" id="txtcari"/>
                <input type="hidden" value="" id="txtnodok_h"/>
                <div title="Untuk Edit Data, Klik 2x Di Baris Yang Akan di Edit">              
                <table  id="trh" title="List Dokumen" style="width:940px;height:400px;" >  
                </table>                
                </div>
            </p>
        </div>
    </div>
    <div id="tabs-2">  
        <br /><br />
        <table align="center" border="0">
            <tr>
                <td>No. Bukti</td>
                <td>:</td>
                <td><input id="nomor_bukti" name="nomor_bukti" style="width: 50px;" disabled="true"/></td>
            </tr>
            <tr>
                <td >No. Dokumen</td>
                <td>:</td>
                <td><input type="text" id="nomor" name="nomor" style="width: 140px;" /><input type="hidden" id="sp2d" name="sp2d" style="width: 140px;" /><input type="hidden" id="jns_spp" name="jns_spp" style="width: 140px;" /></td>
                <td width="50px"></td>
                <td width="100px">Jenis Dana</td>
                <td>:</td>
                <td><input type="text" id="dana" style="width: 140px;" /></td>                
            </tr>
            <tr hidden="true">
                <td>No.Dok.Perencanaan</td>
                <td>:</td>
                <td colspan="2"><input type="text" id="nomor_rencana" name="nomor_rencana" style="width: 140px;" /> *Isi Jika Ada Dokumen Perencanaan </td>
                <td width="50px"></td>
                <!-- <td ></td> -->
                <td></td>
                <td></td>                
            </tr>
            <tr hidden="true">
                <td>No.Dok.Pengawasan</td>
                <td>:</td>
                <td colspan="2"><input type="text" id="nomor_awas" name="nomor_awas" style="width: 140px;" /> *Isi Jika Ada Dokumen Pengawasan</td>
                <td width="50px"></td>
                <!-- <td ></td> -->
                <td></td>
                <td></td>                
            </tr>
            <tr>       
                <td>Tanggal Dokumen</td>
                <td>:</td>
                <td><input type="text" id="tanggal" style="width: 140px;" /></td>
                <td></td>
                <td>Tahun Anggaran</td>
                <td>:</td>
                <td><input type="text" id="tahun" style="width: 140px;" /></td>     
            </tr>
            <tr>
                <td >Nilai Kontrak</td>
                <td>:</td>
                <td><input type="text" id="nilkont" name="nilkont" style="width: 140px;text-align: right;" disabled="true" /><input type="hidden" id="nilkont_hide" name="nilkont_hide" style="width: 140px;text-align: right;" /></td>
                <td></td>
                <td >Bukti Pembayaran</td>
                <td>:</td>
                <td><input type="text" id="bukti" style="width: 140px;" /></td> 
            </tr>
            <tr>
                <td>Sisa Pagu APBD</td> 
                <td>:</td>
                <td><input type="text" id="nilapbd" name="nilapbd" style="width: 140px;text-align: right;"  readonly/></td>
                <td></td>
                <td >Cara Perolehan</td>
                <td>:</td>
                <td><input type="text" id="perolehan" style="width: 140px;" /></td>
                                               
            </tr>       
            <tr>
                <td>Perusahaan/Rekanan</td>
                <td>:</td>
                <td><input id="compy" name="compy" style="width: 140px;" value="" />  </td>
                <td></td>
                <td >Dasar Perolehan</td>
                <td>:</td>
                <td><input type="text" id="dasar" style="width: 140px;" /></td>  
                         
            </tr>                       
            <tr>
                <td colspan="3"></td>
                <td></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;a.Nomor</td>
                <td>:</td>
                <td><input type="text" id="dsno" style="width: 140px;" /></td>    
                
            </tr>
            <tr>
                <td>Kepemilikan</td>
                <td>:</td>
                <!-- <td><input id="milik" name="milik" style="width: 140px;" value=""/></td> -->
                <td> <select name="milik" id="milik" style="height: 27px; width: 200px;">
                     <option value="03">KABUPATEN BIAK NUMFOR</option>     
                     
                   </select></td> 
                <td></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;b.Tanggal</td>
                <td>:</td>
                <td><input type="text" id="dstgl" style="width: 140px;" /></td>
                
            </tr>                
            <tr>
                <td>Wilayah</td>
                <td>:</td>
                <!-- <td><input id="wilayah" name="wilayah" style="width: 140px;" value=""/></td> -->
                <td> <select name="wilayah" id="wilayah" style="height: 27px; width: 200px;">
                     <option value="03">KABUPATEN BIAK NUMFOR</option>     
                     
                   </select></td> 
                <td></td>
                <td >Status KDP</td>
                <td >:</td>
                <td ><select name="sts_kdp" id="sts_kdp" style="height: 27px; width: 140px;">
                     <option value="">-----</option>
                     <option value="K">KDP</option> 
                     <option value="B">Bukan KDP</option>
                     <option value="L">Pencairan Lanjutan KDP</option>     
                     
                   </select></td>
            </tr>
            <tr>
                <td>SKPD</td>
                <td>:</td>
                <td><input id="unit" name="unit" style="width: 140px;" value=""/> </td>
                <td></td>
                <td  colspan="3"><input id="nmunit" name="nmunit" style="width: 350px; border:0;" readonly="true" value=""/>
				</td>
                <td  hidden="true">:</td>
                <!--td  hidden="true"><input type="text" id="thn2" style="width: 140px;" /></td-->
            </tr>
            <tr>
                <td>Unit Kerja</td>
                <td>:</td>
                <td><input id="mlokasi" name="mlokasi" style="width: 350px; border:0;" readonly="true" value=""/> </td>
                <td></td>
                <td  colspan="3">
				<input id="nmlokasi" name="nmlokasi" style="width: 350px; border:0;" readonly="true" value=""/></td>
                <td  hidden="true">:</td>
                <!--td  hidden="true"><input type="text" id="thn2" style="width: 140px;" /></td-->
            </tr>
            <tr>
                <td >*Keterangan</td>
                <td colspan="6">Nilai Transaksi di SP2D &nbsp;&nbsp;:&nbsp;&nbsp;<input id="nkon" name="nkon" style="width: 140px;text-align: right;" disabled="true"><input type="hidden" id="nkon_hide" name="nkon_hide" style="width: 140px;text-align: right;" disabled="true">&nbsp;&nbsp;
                    Total Transaksi &nbsp;&nbsp;:&nbsp;&nbsp;<input id="totbel" name="totbel" style="width: 140px;text-align: right;" disabled="true"><input type="hidden" id="totbel_hide" name="totbel_hide" style="width: 140px;text-align: right;" disabled="true"></td>
            </tr>
        </table>  
        <br />
        <!--fieldset>
        <div align="center">
        	<!--a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:kosong();">Tambah</a-->
            <!--a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:simpan();">Simpan</a>
            <a class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:cetak_bap();">cetak</a> 
            <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:tab1();">Kembali</a>          
		</div>
        </fieldset-->
        <br /> 
        <div id="toolbar" align="center" >
    		<a class="easyui-linkbutton" id="tambah_det" iconCls="icon-add" plain="false" onclick="javascript:cekdulu();">Tambah Barang</a>   		                            		
        </div>
        <div align="center">
        <fieldset>
        <!-- <INPUT TYPE="button" VALUE="SIMPAN" style="height:40px;width:100px" onclick="javascript:simpan();" > -->
        <!-- <INPUT TYPE="button" VALUE="CETAK BAP" style="height:40px;width:100px" onclick="javascript:cetak_bap();"> -->
        <!-- <INPUT TYPE="button" VALUE="KEMBALI" style="height:40px;width:100px" onclick="javascript:tab1();" > -->
        <table>
            <tr>
                <td>
                    <a class="easyui-linkbutton" id="c_simpan" iconCls="icon-save" plain="false" onclick="javascript:simpan();">Simpan</a>
                    <a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:tab1();">Keluar</a>
                </td>
            </tr>
        </table>
        </fieldset>
        </div>  
        <!-- <div title="Untuk Edit Data, Klik 2x Di Baris Yang Akan di Edit"> -->
        <table  id="trd" title="Detail Barang" style="width:940px;height:300px;" >  
        </table>
        <!-- </div>  -->      
        <div align="right">Total : <input type="text" id="total" style="text-align: right;border:0;width: 200px;font-size: large;" readonly="true"/></div>        
         <br />
        
    </div>
</div>


    <div id="dialog-modal" title="Input Barang" >
    <p class="validateTips" >Semua Inputan Harus Di Isi.</p>     
    <fieldset title="Spesifikasi Barang" >    
        <table>
			<tr>
                <td>Golongan Barang</td>
                <td>:</td>
                <td><input id="cmbjenis" name="cmbjenis" style="width: 200px;" />&nbsp;&nbsp;<input type="text" id="nmgolongan" name="nmgolongan" style="width: 200px;border: 0;" readonly="true"/></td>
            </tr>
			<tr>
                <td>Bidang Barang</td>
                <td>:</td>
                <td><input  id="bidang" name="bidang" style="width: 200px;" />&nbsp;&nbsp;<input type="text" id="nmbidang" name="nmbidang" style="width: 200px;border: 0;" readonly="true"/></td>
            </tr>
            <tr>
                <td>Kode Barang</td>
                <td>:</td>
                <td><input  id="kdbarang" name="kdbarang" style="width: 200px;" />&nbsp;&nbsp;<input type="text" id="nmkelompok" name="nmkelompok" style="width: 300px;border: 0;" readonly="true"/></td>
            </tr>
		    <!--tr>
                <td>Kelompok Barang</td>
                <td>:</td>
                <td><input type="text" id="cmkel" style="width: 140px;" /></td>
            </tr>
			<tr>
                <td>Sub Kelompok Barang</td>
                <td>:</td>
                <td><input type="text" id="cmsubkel" style="width: 140px;" /></td>
            </tr>
            <tr>
                <td>Nama Barang</td>
                <td>:</td>
                <td><input type="text" id="kdbrg" style="width: 140px;"/></td>
            </tr-->
            <tr>
                <td></td>
                <td></td>
                <!-- <td><input type="text" id="nmbidang" style="width: 500px;border: 0;" readonly="true"/></td> -->
                <td><input type="text" id="nmbrg" style="width: 500px;border: 0;" readonly="true"/><input type="text" id="kdbrgx" style="width: 500px;border: 0;" hidden="true"/></td>
            </tr>            
        </table>
    </fieldset>
    <fieldset title="Bukti / SP2D">
        <table>
            <tr hidden="true">
                <td>Sumber Dana</td>
                <td>:</td>
                <td><input type="text" id="sbrdana" style="width: 140px;"/></td>
            </tr>
            <tr>
                <td>No. SP2D</td>
                <td>:</td>
                <td><input type="text" id="nosp2d" name="nosp2d" style="width: 200px;"/></td>
            </tr>
            <tr>
                <td>Tanggal SP2D</td>
                <td>:</td>
                <td><input type="text" id="tglsp2d" style="width: 140px;"/></td>
            </tr>            
            <tr>
                <td>Nilai SP2D</td>
                <td>:</td>
                <td><input type="text" id="nilsp2d" name="nilsp2d" style="width: 140px;text-align:right;" readonly="true"  /><input type="hidden" id="nilsp2d_hide" name="nilsp2d_hide" style="width: 140px;text-align:right;" readonly="true"  /></td>
                <td>Nilai Kontrak &nbsp; :&nbsp;&nbsp;<input type="text" id="nilkon1" name="nilkon1" style="width: 140px;text-align:right;" readonly="true"/><input type="hidden" id="nilkon1_hide" name="nilkon1_hide" style="width: 140px;text-align:right;" readonly="true"/></td>
            </tr>
            <tr>
                <td>Kegiatan</td>
                <td>:</td>
                <td><input type="text" id="kegiatan" name="kegiatan" style="width: 200px;" readonly="true"/></td>
                <td><input type="text" id="nm_kegiatan" name="nm_kegiatan" style="width: 300px;border:0;" readonly="true"/></td>
            </tr>
            <tr>
                <td>Rekening</td>
                <td>:</td>
                <td><input type="text" id="rekening" name="rekening" style="width: 200px;" readonly="true"/></td>
                <td><input type="text" id="nm_rekening" name="nm_rekening" style="width: 300px;border:0;" readonly="true"/></td>
            </tr>
        </table>
    </fieldset>
    <fieldset title="Keterangan Barang">
        <table>
            <tr>
                <td>Jumlah</td>
                <td>:</td>
                <td><input type="text" id="jumlah" style="width: 140px;text-align: right;" onclick="javascript:select();" onkeyup="hitung();" />&nbsp;&nbsp;&nbsp;
                    <a class="easyui-linkbutton" iconCls="calculator.png" plain="false" onclick="javascript:hitung_update();">Hitung</a>
                </td>
            </tr>
            <tr>
                <td>Harga Satuan</td>
                <td>:</td>
                <td><input type="text" id="harga" style="width: 140px;text-align: right;" onkeyup="hitung();" onkeypress="return(currencyFormat(this,',','.',event))" /></td>
            </tr>
            <tr>
                <td hidden="true">Total Harga</td>
                <td hidden="true">:</td>
                <td hidden="true"><input type="text" id="total1" style="width: 140px;text-align: right;"  readonly="true"/></td>
            </tr>
            <tr>
                <td hidden="true">PPN&nbsp;&nbsp;&nbsp;<input type="checkbox" id="ppn" onclick="hitung();" /></td>
                <td hidden="true">:</td>
                <td hidden="true"><input type="text" id="nilppn" style="width: 140px;text-align: right;" readonly="true"/></td>
            </tr>
            <tr>
                <td>Total</td>
                <td>:</td>
                <td><input type="text" id="total2" style="width: 140px;text-align: right;" readonly="true"/></td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td>:</td>
                <td><textarea id="ket" style="width: 450px; height: 40px;"></textarea></td>
            </tr>
        </table>
    </fieldset>
    <fieldset>
        <div align="center">
        	<!-- <a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:kosong2();">Tambah</a> -->
            <a class="easyui-linkbutton" iconCls="icon-save" plain="false" onclick="javascript:append_save();">Tampung</a>               		  
            <a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:tutup();">Kembali</a>
        </div>
    </fieldset>
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
    <div id="dialog-modal_bap" title="Cetak Berita Acara Penerimaan Barang" >
        <fieldset title="Spesifikasi Barang" >    
            <table border="0" width="100%">
                <tr>
                    <td width="20%">No BAP</td>
                    <td width="1%">:</td>
                    <td width="25%"><input type="text" id="no_bap" style="width: 200px;" /></td>
                    <td width="8%">&nbsp;</td>
                    <td width="20%">Hari</td>
                    <td width="1%">:</td>
                    <td width="25%"><input type="text" id="hari" style="width: 50px;" /></td>
                </tr>          
                <tr>
                    <td>Tgl. BAP</td>
                    <td>:</td>
                    <td><input type="text" id="tgl_bap" style="width: 100px;" /></td>
                    <td></td>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td><input type="text" id="tgl_ctk_bap" style="width: 100px;" /></td>
                </tr>
                <tr>
                    <td>Keputusan Bupati</td>
                    <td>:</td>
                    <td><input type="text" id="kepda" style="width: 200px;" /></td>
                    <td></td>
                    <td>Bulan</td>
                    <td>:</td>
                    <td><input type="text" id="bln_bap" style="width: 200px;" /></td>
                </tr>
                <tr>
                    <td>Tgl.Keputusan</td>
                    <td>:</td>
                    <td><input type="text" id="tgl_kep" style="width: 100px;" /></td>
                    <td></td>
                    <td>Tahun</td>
                    <td>:</td>
                    <td><input type="text" id="tahun_bap" style="width: 200px;" /></td>
                </tr>
                <tr>
                    <td colspan="7">&nbsp;</td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:1.</td>
                    <td colspan="5"><input type="text" id="pengawas1" style="width: 200px;" />&ensp;<input type="text" id="jabat_awas1" style="width: 140px;" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>&nbsp;2.</td>
                    <td colspan="5"><input type="text" id="pengawas2" style="width: 200px;" />&ensp;<input type="text" id="jabat_awas2" style="width: 140px;" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>&nbsp;3.</td>
                    <td colspan="5"><input type="text" id="pengawas3" style="width: 200px;" />&ensp;<input type="text" id="jabat_awas3" style="width: 140px;" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>&nbsp;4.</td>
                    <td colspan="5"><input type="text" id="pengawas4" style="width: 200px;" />&ensp;<input type="text" id="jabat_awas4" style="width: 140px;" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>&nbsp;5.</td>
                    <td colspan="5"><input type="text" id="pengawas5" style="width: 200px;" />&ensp;<input type="text" id="jabat_awas5" style="width: 140px;" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>&nbsp;6.</td>
                    <td colspan="5"><input type="text" id="pengawas6" style="width: 200px;" />&ensp;<input type="text" id="jabat_awas6" style="width: 140px;" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>&nbsp;7.</td>
                    <td colspan="5"><input type="text" id="pengawas7" style="width: 200px;" />&ensp;<input type="text" id="jabat_awas7" style="width: 140px;" /></td>
                </tr>
                <tr>
                    <td colspan="7">&nbsp;</td>
                </tr>
                <tr>
                    <td>No Kontrak</td>
                    <td>:</td>
                    <td colspan="5"><input type="text" id="kontrak_bap" style="width: 200px;" /></td>
                </tr>
                <tr>
                    <td>Tgl Kontrak</td>
                    <td>:</td>
                    <td colspan="5"><input type="text" id="tgl_kontrak_bap" style="width: 100px;" /></td>
                </tr>
                <tr>
                    <td>Kegiatan</td>
                    <td>:</td>
                    <td colspan="5"><input type="text" id="kegiatan_bap" style="width: 580px;" /></td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td>:</td>
                    <td colspan="5"><input type="text" id="pekerjaan_bap" style="width: 200px;" /></td>
                </tr>
                <tr>
                    <td>Lokasi</td>
                    <td>:</td>
                    <td colspan="5"><input type="text" id="lokasi_bap" style="width: 200px;" /></td>
                </tr>
                <tr>
                    <td>Nilai Kontrak</td>
                    <td>:</td>
                    <td colspan="5"><input type="text" id="nilai_bap" style="width: 200px;" /></td>
                </tr>
                <tr>
                    <td>Sumber Dana</td>
                    <td>:</td>
                    <td colspan="5"><input type="text" id="dana_bap" style="width: 200px;" /></td>
                </tr>
            </table>
        </fieldset>
         <fieldset style="alignment-adjust: ;">
            <div align="center">
                <a class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:cetak();return false">Cetak</a>                               
                <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:tutup();">Kembali</a>
            </div>
            
        </fieldset>
    
    </div>

    <div id="dialog-modal-update" title="Update Barang" >
    <p class="validateTips" >Semua Inputan Harus Di Isi.</p>     
    <fieldset title="Spesifikasi Barang" >    
        <table>
            <tr>
                <td>Golongan Barang</td>
                <td>:</td>
                <td><input id="cmbjenis_u" name="cmbjenis_u" style="width: 200px;" />&nbsp;&nbsp;<input type="text" id="nmgolongan_u" name="nmgolongan_u" style="width: 200px;border: 0;" readonly="true"/></td>
            </tr>
            <tr>
                <td>Bidang Barang</td>
                <td>:</td>
                <td><input  id="bidang_u" name="bidang_u" style="width: 200px;" />&nbsp;&nbsp;<input type="text" id="nmbidang_u" name="nmbidang_u" style="width: 200px;border: 0;" readonly="true"/></td>
            </tr>
            <tr>
                <td>Kode Barang</td>
                <td>:</td>
                <td><input  id="kdbarang_u" name="kdbarang_u" style="width: 200px;" />&nbsp;&nbsp;<input type="text" id="nmkelompok_u" name="nmkelompok_u" style="width: 300px;border: 0;" readonly="true"/></td>
            </tr>
           
            <tr>
                <td></td>
                <td></td>
                <!-- <td><input type="text" id="nmbidang" style="width: 500px;border: 0;" readonly="true"/></td> -->
                <td><input type="text" id="idx" style="width: 500px;border: 0;" readonly="true"/></td>
            </tr>            
        </table>
    </fieldset>
    <fieldset title="Bukti / SP2D">
        <table>
            <tr hidden="true">
                <td>Sumber Dana</td>
                <td>:</td>
                <td><input type="text" id="sbrdana_u" style="width: 140px;"/></td>
            </tr>
            <tr>
                <td>No. SP2D</td>
                <td>:</td>
                <td><input type="text" id="nosp2d_u" name="nosp2d_u" style="width: 200px;"/></td>
            </tr>
            <tr>
                <td>Tanggal SP2D</td>
                <td>:</td>
                <td><input type="text" id="tglsp2d_u" style="width: 140px;"/></td>
            </tr>            
            <tr>
                <td>Nilai SP2D</td>
                <td>:</td>
                <td><input type="text" id="nilsp2d_u" name="nilsp2d_u" style="width: 140px;text-align:right;" readonly="true"  /><input type="hidden" id="nilsp2d_hide_u" name="nilsp2d_hide_u" style="width: 140px;text-align:right;" readonly="true"  /></td>
                <td>Nilai Kontrak &nbsp; :&nbsp;&nbsp;<input type="text" id="nilkon1_u" name="nilkon1_u" style="width: 140px;text-align:right;" readonly="true"/><input type="hidden" id="nilkon1_hide_u" name="nilkon1_hide_u" style="width: 140px;text-align:right;" readonly="true"/></td>
            </tr>
            <tr>
                <td>Kegiatan</td>
                <td>:</td>
                <td><input type="text" id="kegiatan_u" name="kegiatan_u" style="width: 200px;" readonly="true"/></td>
                <td><input type="text" id="nm_kegiatan_u" name="nm_kegiatan_u" style="width: 300px;border:0;" readonly="true"/></td>
            </tr>
            <tr>
                <td>Rekening</td>
                <td>:</td>
                <td><input type="text" id="rekening_u" name="rekening_u" style="width: 200px;" readonly="true"/></td>
                <td><input type="text" id="nm_rekening_u" name="nm_rekening_u" style="width: 300px;border:0;" readonly="true"/></td>
            </tr>
        </table>
    </fieldset>
    <fieldset title="Keterangan Barang">
        <table>
            <tr>
                <td>Jumlah</td>
                <td>:</td>
                <td><input type="text" id="jumlah_u" style="width: 140px;text-align: right;" onkeyup="hitung_update();" /></td>
            </tr>
            <tr>
                <td>Harga Satuan</td>
                <td>:</td>
                <td><input type="text" id="harga_u" style="width: 140px;text-align: right;" onkeyup="hitung_update();" onkeypress="return(currencyFormat(this,',','.',event))" /></td>
            </tr>
            <tr>
                <td>Total Harga</td>
                <td>:</td>
                <td><input type="text" id="total1_u" style="width: 140px;text-align: right;"  readonly="true"/></td>
            </tr>
            <tr>
                <td>PPN&nbsp;&nbsp;&nbsp;<input type="checkbox" id="ppn_u" onclick="hitung_update();" /></td>
                <td>:</td>
                <td><input type="text" id="nilppn_u" style="width: 140px;text-align: right;" readonly="true"/></td>
            </tr>
            <tr>
                <td>Total</td>
                <td>:</td>
                <td><input type="text" id="total2_u" style="width: 140px;text-align: right;" readonly="true"/></td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td>:</td>
                <td><textarea id="ket_u" name="ket_u" style="width: 140px;"></textarea></td>
            </tr>
        </table>
    </fieldset>
    <fieldset>
        <div align="center">
            <!-- <a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:kosong2();">Tambah</a> -->
            <a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:append_save_update();">Tampung</a>                         
            <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:tutup();">Kembali</a>
       e%&Âò¬Ã ûQ=Â˜é\ì”²©Þ…@=#­a Ì›¤óƒ6qëíDÙ$·g]¥jkˆ‘˜Ð…