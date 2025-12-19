<script type="text/javascript" src="<?php echo base_url(); ?>easyui/autoCurrency.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>easyui/currencyFields.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>lib/jquery.maskMoney.min.js"></script>
<script src="<?php echo base_url(); ?>lib/sweet-alert.min.js"></script>
<link   rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>lib/sweet-alert.css">
<script type="text/javascript">
    
    var updt = 'f';
    var idx2 = '';
    var total2 = 0;
     $(document).ready(function() {
          $("#tabs").tabs();
          $("#dialog-modal").dialog({
            height: 900,
            width: 1000,
            modal: true, 
            background:'#2da305',           
            autoOpen:false                
          });                       
     });

     //this view has modify by demansyah msm biak 
    $(document).ready(function(){
      $('#hrg').maskMoney({thousands:',', decimal:'.', precision:0});
    });      
     
    $(function(){         
         $('#trh').edatagrid({
    		url: "<?php echo base_url(); ?>index.php/transaksi/trh_pelihara_barang",
            idField:"no_dokumen",            
            rownumbers:"true", 
            fitColumns:"true",
            singleSelect:"true",
            autoRowHeight:"false",
            loadMsg:"Tunggu Sebentar....!!",
            pagination:"true",
            nowrap:"true",                       
            columns:[[
        	    {field:'no_dokumen',title:'Nomor Dokumen',width:40},
                {field:'tgl_dokumen',title:'Tanggal',width:20},
                {field:'nm_uskpd',title:'Unit SKPD',width:100},
                {field:'kd_uskpd',title:'SKPD',hidden:true},
                {field:'kd_unit',title:'unit',hidden:true},
                {field:'tahun',title:'Tahun',width:20,align:"center"},
				{field:'hapus',width:5,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus();'' />";}}
            ]],
            onSelect:function(rowIndex,rowData){ 
                nomor   = rowData.no_dokumen;
                no_reg  = rowData.no_reg;
                tgl     = rowData.tgl_dokumen;
                unit    = rowData.kd_unit;
                kode    = rowData.kd_uskpd;
                nmkode  = rowData.nm_uskpd;
                tahun   = rowData.tahun;
                total   = rowData.total;
                get(nomor,no_reg,tgl,unit,kode,nmkode,tahun,total);
               
            },
            onDblClickRow:function(rowIndex,rowData){
                nomor   = rowData.no_dokumen;
                no_reg  = rowData.no_reg;
                tgl     = rowData.tgl_dokumen;
                unit    = rowData.kd_unit;
                kode    = rowData.kd_uskpd;
                nmkode  = rowData.nm_uskpd;
                tahun   = rowData.tahun;
                total   = rowData.total;
                get(nomor,no_reg,tgl,unit,kode,nmkode,tahun,total);
                section2();
                $('#mlokasi').combogrid('disable');
                $('#add').linkbutton('disable');
                }

        });
               
        $('#nomor').combogrid({  
            panelWidth:700,  
            idField:'no_kontrak',  
            textField:'no_kontrak',  
            mode:'remote',
            url:'<?php echo base_url(); ?>index.php/master/ambil_nomor_kontrak',  
            columns:[[  
                {field:'no_kontrak',title:'No Kontrak',width:200},  
                {field:'nilai2',title:'Nilai Kontrak',width:100,align:'right'},
                {field:'keterangan',title:'Keterangan',width:400}    
            ]],
            onSelect:function(rowIndex,rowData){
                $('#kd_rek').attr('value',rowData.kd_rek5);
                $('#hrg').attr('value',rowData.nilai2);
                $('#uskpd').attr('value',rowData.kd_skpd);
                $("#mlokasi").combogrid('clear');
                $('#mlokasi').combogrid('enable');
                $('#nmuskpd').attr('value','');
                $('#kd_kegiatan').attr('value',rowData.kd_kegiatan);
                $('#nm_kegiatan').attr('value',rowData.nm_kegiatan);
                $('#nm_rek5').attr('value',rowData.nm_rek5);
                $('#ket').attr('value',rowData.keterangan);
                $('#tanggal').datebox('setValue',rowData.tgl_bukti);
                $("#mlokasi").combogrid('grid').datagrid('reload');
                $('#mlokasi').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_ubidskpdh',queryParams:({skpd:rowData.kd_skpd}) });
            }  
            });

        $('#trd2').edatagrid({  
            //toolbar:'#toolbar',
            rownumbers:"true",             
            singleSelect:"true",
            autoRowHeight:"false",
            nowrap:"true",
            loadMsg:"Tunggu Sebentar....!!",
            onSelect:function(rowIndex,rowData){                    
                    idx = rowIndex;
                    nilx = rowData.nilai;
            },                                                     
            columns:[[  
                {field:'hapus',
                title:'Hapus',
                width:50,
                align:"center",
                formatter:function(value,rec){                                                                       
                    return '<img src="<?php echo base_url(); ?>/public/images/cross.png" onclick="javascript:hapus_detail();" />';                  
                    }                
                },          
            {field:'no_dokumen',
                    title:'Nomor Dok',          
                hidden:"true"}, 
            {field:'no_kib',
                    title:'Nomor Kib',          
                hidden:"true"},
            {field:'kd_skpd',
                    title:'SKPD',          
                hidden:"true"},
            {field:'kd_unit',
                    title:'Unit SKPD',          
                hidden:"true"}, 
            {field:'idbrg',
                    title:'ID Barang',          
                hidden:"true"}, 
            {field:'kd_golongan',
                    title:'Golongan',          
                hidden:"true"}, 
            {field:'nm_golongan',
                    title:'Nama Golongan',          
                hidden:"true"}, 
            {field:'kd_bidang',
                    title:'Bidang',          
                hidden:"true"},
            {field:'nm_bidang',
                    title:'Nama Bidang',          
                hidden:"true"}, 
            {field:'kd_brg',
                    title:'Kode Barang',          
                width:150,
                align:"center"},
            {field:'nm_brg',
                    title:'Nama Barang',          
                width:150,
                align:"left"},
            {field:'tahun',
                    title:'tahun',          
                hidden:"true"},
            {field:'pelihara',
                    title:'pelihara',          
                hidden:"true"},
            {field:'kd_kegiatan',
                    title:'kd_kegiatan',          
                hidden:"true"},
            {field:'nm_kegiatan',
                    title:'nm_kegiatan',          
                hidden:"true"},
            {field:'kdrek',
                    title:'kdrek',          
                hidden:"true"},
            {field:'nm_rek',
                    title:'nm_rek',          
                hidden:"true"},
            {field:'n_oleh',
                    title:'Nilai Perolehan',          
                width:150,
                align:"right"},
            {field:'umur',
                    title:'Umur',          
                width:50,
                align:"right"},
            {field:'hrg',
                    title:'Nilai Pemeliharaan',          
                width:150,
                align:"right"}, 
            {field:'tambah_umur',
                    title:'Tambah Umur',          
                width:50,
                align:"right"},
            {field:'uraian',
                    title:'uraian',          
                hidden:"true"},
            {field:'ket',
                    title:'Keterangan',          
                hidden:"true"}
                       
            ]]
        });      
    //}); 
		
        $('#tanggal').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            }
         });

       
     
         $('#mlokasi').combogrid({  
            panelWidth:500,  
            idField:'kd_uskpd',  
            textField:'kd_uskpd',  
            mode:'remote',                      
            //url:'<?php echo base_url(); ?>index.php/master/ambil_ubidskpdh',  
            columns:[[  
               {field:'kd_skpd',title:'Kode SKPD',width:100},  
               //{field:'nm_skpd',title:'Nama SKPD',width:250},
               {field:'kd_uskpd',title:'Kode Unit',width:150},  
               {field:'nm_uskpd',title:'Nama Unit',width:250}     
            ]],  
            onSelect:function(rowIndex,rowData){
               cuskpd = rowData.kd_skpd;            
               ckd_lokasi = rowData.kd_lokasi;    
               $('#nmuskpd').attr('value',rowData.nm_uskpd);    
               //$('#mlokasi').attr('value',rowData.kd_lokasi);                               
            } 
         });  

        $('#tahun').combobox({           
            valueField:'tahun',  
            textField:'tahun',
            width:160,
            url:'<?php echo base_url(); ?>index.php/master/tahun'
        });

        $('#cmbjenis').combogrid({           
        idField:'gol',  
        textField:'gol',
        mode:'remote',
        panelWidth:400,
        width:160,
        url:'<?php echo base_url(); ?>index.php/master/ambil_golongan_dh',
        columns:[[  
               
               {field:'gol',title:'Kode Golongan',width:100},  
               {field:'nm_golongan',title:'Nama Golongan',width:500}
            ]], 
        onSelect:function(rowIndex,rowData){
            cgol=rowData.gol;
            ngol=rowData.nm_golongan;
            
            $('#nmgolongan').attr('value',ngol);
            $('#bidang').combogrid('clear');
            $('#kdbarang').combogrid('clear');
            $('#nmbidang').attr('value','');
            $('#nmkelompok').attr('value','');
            
            
            $('#bidang').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_bidang',
            queryParams:({gol:cgol})
        });            
        }                    
    });

        $('#bidang').combogrid({  
            panelWidth:550,
            width:160, 
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
        $('#kdbarang').combogrid({
            panelWidth:550,
            width:160, 
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
                akib_dh();
            }                                                          
                
    });
        
        /*$('#jenis').combogrid({  
            panelWidth:400,  
            width:160,
            idField:'golongan',  
            textField:'golongan',  
            mode:'remote',                                  
            url:'<?php echo base_url(); ?>index.php/master/ambil_gol',  
            columns:[[  
               {field:'golongan',title:'Kode Golongan',width:100},  
               {field:'nm_golongan',title:'Nama Golongan',width:300}    
            ]],  
            onSelect:function(rowIndex,rowData){  
                cgol = rowData.golongan;
				coba();
			} 
        }); */
		   
		   function akib_dh(){
			var cthnn    = $('#tahun').combobox('getValue');
            var skpd     = document.getElementById('uskpd').value; //$('#uskpd').combogrid('getValue');
			if (cgol == '01'){
                $('#kib').combogrid({url:'<?php echo base_url(); ?>index.php/master/load_kiba',queryParams:({kdbrg:ckd_kelompok,tahun:cthnn,skpd:skpd})});
            }else if (cgol == '02'){
                $('#kib').combogrid({url:'<?php echo base_url(); ?>index.php/master/load_kibb_dh',queryParams:({kdbrg:ckd_kelompok,tahun:cthnn,skpd:skpd})});
			}else if (cgol == '03'){
                $('#kib').combogrid({url:'<?php echo base_url(); ?>index.php/master/load_kibc_dh',queryParams:({kdbrg:ckd_kelompok,tahun:cthnn,skpd:skpd})});
			}else if (cgol == '04'){
                $('#kib').combogrid({url:'<?php echo base_url(); ?>index.php/master/load_kibd_dh',queryParams:({kdbrg:ckd_kelompok,tahun:cthnn,skpd:skpd})});
			}else if (cgol == '05'){
                $('#kib').combogrid({url:'<?php echo base_url(); ?>index.php/master/load_kibe',queryParams:({kdbrg:ckd_kelompok,tahun:cthnn,skpd:skpd})});
			}else if (cgol == '06'){
                $('#kib').combogrid({url:'<?php echo base_url(); ?>index.php/master/load_kibf',queryParams:({kdbrg:ckd_kelompok,tahun:cthnn,skpd:skpd})});
			} 
		}
		
	$('#kib').combogrid({  
            panelWidth:900,  
            panelHeight:400, 
            width:160, 
            idField:'no_dokumen',  
            textField:'no_dokumen',              
            mode:'remote',            
			//url:'<?php echo base_url(); ?>index.php/transaksi/ambil_trd_treatbrg',
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[
               {field:'id_barang',title:'id_barang',width:50,hidden:true},
               {field:'no_reg',title:'No Reg',width:50},  
               {field:'no_dokumen',title:'No Dokumen',width:120},
               {field:'kd_brg',title:'Kode Aset',width:100},  
               {field:'nama',title:'Nama Aset',width:200},
               {field:'nilai2',title:'Harga',width:80,align:"right"},   
               {field:'kondisi',title:'Kondisi',width:50,align:"center"},  
               {field:'pelihara',title:'Pemeliharaan ke',width:95,align:"right"},
               {field:'keterangan',title:'Keterangan',width:160}     
            ]],  
             onSelect:function(rowIndex,rowData){
				$('#id_brg').attr('value',rowData.id_barang);
                $('#n_oleh').attr('value',rowData.nilai2);
                $('#n_oleh_hide').attr('value',rowData.nilai);
                $('#umur').attr('value',rowData.masa_manfaat);
                $('#pelihara').attr('value',rowData.pelihara);
                hitung();
    		}  
			
    });
		
    });
    
    function section1(){        
        $('#tabs1').click();  
        $('#trh').edatagrid('reload'); 
        set_grid();                                                     
    }
    function section2(){            
        $('#tabs2').click();
        load_detail();
        set_grid();                                                        
    }
	
   function get(nomor,no_reg,tgl,unit,kode,nmkode,tahun,total){
        $('#nomor').combogrid('setValue',nomor);
        $('#tanggal').datebox('setValue',tgl);
        $('#uskpd').attr('value',kode);
        $('#nmuskpd').attr('value',nmkode);
        $('#mlokasi').combogrid('setValue',unit);
       // $('#tahun').combobox('setValue',tahun);
        $('#total').attr('value',number_format(total,2,'.',','));
        $('#nomor').combogrid('disable');
    }
    function kosong(){
		var skpd = '<?php echo ($this->session->userdata('skpd'));?>';
		var unit = '<?php echo ($this->session->userdata('unit_skpd'));?>';
        cdate = '<?php echo date("Y-m-d"); ?>';
        //$('#nomor').attr('value','');
        $("#nomor").combogrid('clear');
        $("#nomor").combogrid('grid').datagrid('reload');
        $('#tanggal').datebox('setValue',cdate);
        $('#uskpd').attr('value',skpd);
        $('#mlokasi').combogrid('setValue',unit);
        $('#nomor').combogrid('enable');
        $('#total').attr('value','0');
        $('#nmuskpd').attr('value','');
        $('#mlokasi').combogrid('enable');
        $('#add').linkbutton('enable');
        $('#kd_rek').attr('value','');
        $('#hrg').attr('value',0);
        $('#ket').attr('value','');
		//max_rinci();
    }
    function kosong2(){ 
        updt = 'f';
        cthn = '<?php echo date("Y"); ?>'; 
        $('#tahun').combobox('setValue',cthn);
        $('#jenis').combogrid('setValue','');
		$('#kib').combogrid('clear');
        //$('#kd').combogrid('setValue','');
        $('#nilai').attr('value','');
        $('#kdkib').attr('value','');
        $('#nm_kib').attr('value','');
        //$('#kd_rek').attr('value','');
        $('#uraian').attr('value','');
        //$('#hrg').attr('value',0);
        //$('#ket').attr('value',''); 
        //$('#merek').attr('value','');
        //$('#jml').attr('value','');
        $('#tot').attr('value','');
        $('#total2').attr('value','0');
        $('#cmbjenis').combogrid('clear');
        $('#nmgolongan').attr('value','');
        $('#bidang').combogrid('clear');
        $('#nmbidang').attr('value','');
        $('#kdbarang').combogrid('clear');
        $('#nmkelompok').attr('value','');
        $('#id_brg').attr('value','');
        $('#n_oleh').attr('value',0);
        $('#n_oleh_hide').attr('value',0);
        $('#umur').attr('value',0);
        $('#persen').attr('value',0);
        $('#tambah_umur').attr('value',0);
        $('#pelihara').attr('value','');
        



    }
	
    function load_detail(){
        var i = 0;
        var nomor = $('#nomor').combogrid('getValue');//document.getElementById('nomor').value;
        var tgl   = $('#tanggal').datebox('getValue');
        var kode  = document.getElementById('uskpd').value; //$('#uskpd').combogrid('getValue');  
         $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>index.php/transaksi/trd_trpelihara',
                data: ({no:nomor}),
                dataType:"json",
				success:function(data){                                          
                    $.each(data,function(i,n){
                        idx             = n['idx'];                                    
                        no_dokumen      = n['no_dokumen'];
                        no_kontrak      = n['no_kontrak'];
                        kd_uskpd        = n['kd_uskpd'];
                        kd_unit         = n['kd_unit'];
                        id_barang       = n['id_barang'];
                        kd_golongan     = n['kd_golongan'];
                        nm_golongan     = n['nm_golongan'];
                        kd_bidang       = n['kd_bidang'];
                        nm_bidang       = n['nm_bidang'];
                        kd_brg          = n['kd_brg'];
                        nm_brg          = n['nm_brg'];
                        thn_kib         = n['thn_kib'];
                        pelihara        = n['pelihara'];
                        kd_rek          = n['kd_rek'];
                        total           = n['total'];
                        umur            = n['umur'];
                        uraian_pelihara = n['uraian_pelihara'];
                        ket             = n['ket'];
                        biaya_pelihara  = n['biaya_pelihara'];
                        harga           = n['harga']; 
                        nm_rek          = n['nm_rek'];
                        kd_kegiatan     = n['kd_kegiatan'];
                        nm_kegiatan     = n['nm_kegiatan'];

                        $('#trd').edatagrid('appendRow',{idx:idx,no_dokumen:no_dokumen,no_kib:no_kontrak,kd_skpd:kd_uskpd,kd_unit:kd_unit,idbrg:id_barang,kd_golongan:kd_golongan,nm_golongan:nm_golongan,
                            kd_bidang:kd_bidang,nm_bidang:nm_bidang,kd_brg:kd_brg,nm_brg:nm_brg,tahun:thn_kib,pelihara:pelihara,kdrek:kd_rek,nilai:total,umur:umur,uraian:uraian_pelihara,ket:ket,nm_rek:nm_rek,kd_kegiatan:kd_kegiatan,nm_kegiatan:nm_kegiatan });                              
                        //$('#trd').edatagrid('appendRow',{no_dokumen:no,kd_brg:kd,kd_uskpd:kds,nm_brg:nm,merek:mrk,jumlah:jml,kd_rek:kd_rek,harga:hrg,biaya_pelihara:biaya_pelihara,uraian_pelihara:uraian_pelihara,total:tot,ket:ket});                                
                    });
                }
         });         
          set_grid();
    }
    /*function load_detail2(){                     
       $('#trd').datagrid('selectAll');
       var rows = $('#trd').datagrid('getSelections');             
       if (rows.length==0){
            set_grid2();
            exit();
       }                     
		for(var p=0;p<rows.length;p++){
            no 		= rows[p].no_dokumen;                    
            kd 		= rows[p].kd_brg;                   
            kds 	= rows[p].kd_uskpd;
            nm 		= rows[p].nm_brg;
            mrk 	= rows[p].merek;
            jml 	= rows[p].jumlah;
            kd_rek 	= rows[p].kd_rek;
            hrg 	= rows[p].harga;
            biaya_pelihara 	= rows[p].biaya_pelihara;
            uraian_pelihara	= rows[p].uraian_pelihara;
            tot 	= rows[p].total;
            ket 	= rows[p].ket;                                                                                                             
            $('#trd2').edatagrid('appendRow',{no_dokumen:no,kd_brg:kd,kd_uskpd:kds,nm_brg:nm,merek:mrk,jumlah:jml,kd_rek:kd_rek,harga:hrg,biaya_pelihara:biaya_pelihara,uraian_pelihara:uraian_pelihara,total:tot,ket:ket});            
        }
        tot = document.getElementById('total').value;        
        $('#total2').attr('value',tot);
        $('#trd').edatagrid('unselectAll');    
    }*/

function load_detail2(){
    $('#trd').edatagrid('selectAll');
       var rows = $('#trd').edatagrid('getSelections');
       idbrg = rows.idbrg;
       no    = rows.no_dokumen;
       
        $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>index.php/transaksi/trd_trpelihara_det',
                data: ({no:no,idbrg:idbrg}),
                dataType:"json",
                success:function(data){                                          
                    $.each(data,function(i,n){
                        idx             = n['idx'];                                    
                        uraian_pelihara = n['uraian_pelihara'];
                        ket             = n['ket'];
                        no_dokumen      = n['no_dokumen'];
                        no_kontrak      = n['no_kontrak'];
                        kd_uskpd        = n['kd_uskpd'];
                        kd_unit         = n['kd_unit'];
                        id_barang       = n['id_barang'];
                        kd_golongan     = n['kd_golongan'];
                        nm_golongan     = n['nm_golongan'];
                        kd_bidang       = n['kd_bidang'];
                        nm_bidang       = n['nm_bidang'];
                        kd_brg          = n['kd_brg'];
                        nm_brg          = n['nm_brg'];
                        kd_rek          = n['kd_rek'];
                        thn_kib         = n['thn_kib'];
                        pelihara        = n['pelihara'];
                        umur_lama       = n['umur_lama'];
                        umur_baru       = n['umur_baru'];
                        nilai_oleh      = n['nilai_oleh'];
                        nilai_pelihara  = n['nilai_pelihara']; 
                        kd_kegiatan     = n['kd_kegiatan'];
                        nm_kegiatan     = n['nm_kegiatan'];
                        nm_rek          = n['nm_rek'];

                        $('#trd2').edatagrid('appendRow',{idx:idx,no_dokumen:no_dokumen,no_kib:no_kontrak,kd_skpd:kd_uskpd,kd_unit:kd_unit,idbrg:id_barang,
                            kd_golongan:kd_golongan,nm_golongan:nm_golongan,kd_bidang:kd_bidang,nm_bidang:nm_bidang,kd_brg:kd_brg,nm_brg:nm_brg,tahun:thn_kib,
                            pelihara:pelihara,kdrek:kd_rek,n_oleh:nilai_oleh,umur:umur_lama,hrg:nilai_pelihara,tambah_umur:umur_baru,uraian:uraian_pelihara,ket:ket,
                            kd_kegiatan:kd_kegiatan,nm_kegiatan:nm_kegiatan,nm_rek:nm_rek
                        });                              
                                                 
                    });
                }
         });
    set_grid2();
}
	
 function set_grid(){
         $('#trd').edatagrid({  
            toolbar:'#toolbar',
            rownumbers:"true",             
            singleSelect:"true",
            autoRowHeight:"false",
            nowrap:"true",
            onSelect:function(rowIndex,rowData){                    
                    idx = rowIndex;
                    nilx = rowData.nilai;
            },                                                     
            columns:[[  
                /*{field:'hapus',
                title:'Hapus',
                width:50,
                align:"center",
                formatter:function(value,rec){                                                                       
                    return '<img src="<?php echo base_url(); ?>/public/images/cross.png" onclick="javascript:hapus_detail1();" />';                  
                    }                
                },*/          
            {field:'no_dokumen',
                    title:'Nomor Dok',          
                hidden:"true"}, 
            {field:'no_kib',
                    title:'Nomor Kib',          
                hidden:"true"},
            {field:'kd_skpd',
                    title:'SKPD',          
                hidden:"true"},
            {field:'kd_unit',
                    title:'Unit SKPD',          
                hidden:"true"}, 
            {field:'idbrg',
                    title:'ID Barang',          
                hidden:"true"}, 
            {field:'kd_golongan',
                    title:'Golongan',          
                hidden:"true"}, 
            {field:'nm_golongan',
                    title:'Nama Golongan',          
                hidden:"true"}, 
            {field:'kd_bidang',
                    title:'Bidang',          
                hidden:"true"},
            {field:'nm_bidang',
                    title:'Nama Bidang',          
                hidden:"true"}, 
            {field:'kd_brg',
                    title:'Kode Barang',          
                width:120,
                align:"center"},
            {field:'nm_brg',
                    title:'Nama Barang',          
                width:250,
                align:"left"},
            {field:'tahun',
                    title:'tahun',          
                hidden:"true"},
            {field:'pelihara',
                    title:'pelihara',          
                width:50,
                align:"right"},
            {field:'kd_kegiatan',
                    title:'kd_kegiatan',          
                hidden:"true"},
            {field:'nm_kegiatan',
                    title:'nm_kegiatan',          
                hidden:"true"},
            {field:'kdrek',
                    title:'kdrek',          
                hidden:"true"},
            {field:'nm_rek',
                    title:'nm_rek',          
                hidden:"true"},
            {field:'nilai',
                    title:'Nilai',          
                width:150,
                align:"right"},
            {field:'umur',
                    title:'Umur',          
                width:50,
                align:"center"},
            /*{field:'hrg',
                    title:'Nilai Pemeliharaan',          
                width:150,
                align:"right"}, 
            {field:'tambah_umur',
                    title:'Tambah Umur',          
                width:50,
                align:"right"},*/
            {field:'uraian',
                    title:'uraian',          
                width:230,
                align:"left"},
            {field:'ket',
                    title:'Keterangan',          
                hidden:"true"}
                       
            ]]
        });      
    //});          
    }
    function set_grid2(){
         $('#trd2').edatagrid({  
            //toolbar:'#toolbar',
            rownumbers:"true",             
            singleSelect:"true",
            autoRowHeight:"false",
            nowrap:"true",
            loadMsg:"Tunggu Sebentar....!!",
            onSelect:function(rowIndex,rowData){                    
                    idx = rowIndex;
                    idbrg = rowData.id_barang;
            },                                                     
            columns:[[  
                {field:'hapus',
                title:'Hapus',
                width:50,
                align:"center",
                formatter:function(value,rec){                                                                       
                    return '<img src="<?php echo base_url(); ?>/public/images/cross.png" onclick="javascript:hapus_detail();" />';                  
                    }                
                },          
            {field:'no_dokumen',
                    title:'Nomor Dok',          
                hidden:"true"}, 
            {field:'no_kib',
                    title:'Nomor Kib',          
                hidden:"true"},
            {field:'kd_skpd',
                    title:'SKPD',          
                hidden:"true"},
            {field:'kd_unit',
                    title:'Unit SKPD',          
                hidden:"true"}, 
            {field:'idbrg',
                    title:'ID Barang',          
                hidden:"true"}, 
            {field:'kd_golongan',
                    title:'Golongan',          
                hidden:"true"}, 
            {field:'nm_golongan',
                    title:'Nama Golongan',          
                hidden:"true"}, 
            {field:'kd_bidang',
                    title:'Bidang',          
                hidden:"true"},
            {field:'nm_bidang',
                    title:'Nama Bidang',          
                hidden:"true"}, 
            {field:'kd_brg',
                    title:'Kode Barang',          
                width:120,
                align:"center"},
            {field:'nm_brg',
                    title:'Nama Barang',          
                width:270,
                align:"left"},
            {field:'tahun',
                    title:'tahun',          
                hidden:"true"},
            {field:'pelihara',
                    title:'pelihara',          
                width:50,
                align:"right"},
            {field:'kd_kegiatan',
                    title:'kd_kegiatan',          
                hidden:"true"},
            {field:'nm_kegiatan',
                    title:'nm_kegiatan',          
                hidden:"true"},
            {field:'kdrek',
                    title:'kdrek',          
                hidden:"true"},
            {field:'nm_rek',
                    title:'nm_rek',          
                hidden:"true"},
            {field:'n_oleh',
                    title:'Nilai Perolehan',          
                width:150,
                align:"right"},
            {field:'umur',
                    title:'Umur',          
                width:50,
                align:"center"},
            {field:'hrg',
                    title:'Nilai Pemeliharaan',          
                width:150,
                align:"right"}, 
            {field:'tambah_umur',
                    title:'T. Umur',          
                width:50,
                align:"center"},
            {field:'uraian',
                    title:'uraian',          
                hidden:"true"},
            {field:'ket',
                    title:'Keterangan',          
                hidden:"true"}
                       
            ]]
        });      
    //});          
    }
	
    function tambah_detail(){
        var no = $('#nomor').combogrid('getValue'); //document.getElementById('nomor').value;
        var tgl = $('#tanggal').datebox('getValue');
        var kd  = document.getElementById('uskpd').value; //$('#uskpd').combogrid('getValue');
        //var thn = $('#tahun').combobox('getValue');
        $('#trd2').edatagrid('reload');
        if (no!='' && tgl!='' && kd!=''){
            $("#dialog-modal").dialog('open'); 
            $('#append').linkbutton('enable');
            kosong2();   
            set_grid2();
            load_detail2();        
                  
        } else {
            alert('Nomor/Tanggal/Unit Kerja/Tahun masih kosong, harap isi terlebih dahulu');
        }        
    }
    
    function hitung(){
        var a = angka(document.getElementById('n_oleh_hide').value);        
        var b = angka(document.getElementById('hrg').value);        
         pers = (b / a)*100;        
            $('#persen').attr('value',number_format(pers,2,'.',','));
            ambil_masa();
    }

    function ambil_masa(){
        var kdbrg = $('#kdbarang').combogrid('getValue');
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
   
   /* function append_save(){
		var no      = document.getElementById('nomor').value;        
        //var jns    	= $('#jenis').combogrid('getValue');  
        var kd      = document.getElementById('kdkib').value; 
		var skp	   	= $('#uskpd').combogrid('getValue');
        var mlokasi = document.getElementById('mlokasi').value;
        var nm      = document.getElementById('nm_kib').value;
        var mrk     = document.getElementById('nilai').value;
        var jml     = 1;
        var kd_rek  = document.getElementById('kd_rek').value;
        var nilai   = angka(document.getElementById('nilai').value);
        var hrg     = angka(document.getElementById('hrg').value); 
        var uraian  = document.getElementById('uraian').value;
       // var tot 	= angka(document.getElementById('tot').value);
		var tot 	= jml*hrg;
        var ket     = document.getElementById('ket').value;
		
        csql = " values('"+no+"','"+kd+"','"+mlokasi+"','"+skp+"','"+nm+"','"+nilai+"','"+jml+"','"+kd_rek+"','"+hrg+"','"+uraian+"','"+tot+"','"+ket+"')";
				$.ajax({
                    type: 'POST',
                    data: ({sql:csql,nodok:no,lokasi:mlokasi}),
                     url:"<?php echo base_url(); ?>index.php/transaksi/save_peliharabrg",
        			success:function(data){
                     var lctot = data;
                     $('#total').attr('value',lctot);
                     $('#total2').attr('value',lctot);
        			}
                  });
				  
        if (kd != '' && kd_rek != '' && uraian != '' && hrg != ''){  
            if (updt == 'f') {
                //for(var lpb=0; lpb<jml; lpb++){
				 no_dokumen:no,kd_brg:kd,kd_uskpd:kds,nm_brg:nm,merek:mrk,
						jumlah:jml,kd_rek:kd_rek,harga:hrg,biaya_pelihara:biaya_pelihara,uraian_pelihara:uraian_pelihara,
						total:tot,ket:ket 
$('#trd').edatagrid('appendRow',{no_dokumen:no,kd_brg:kd,kd_uskpd:skp,nm_brg:nm,merek:mrk,jumlah:jml,kd_rek:kd_rek,harga:hrg,biaya_pelihara:hrg,uraian_pelihara:uraian,total:tot,ket:ket});
$('#trd2').edatagrid('appendRow',{no_dokumen:no,kd_brg:kd,kd_uskpd:skp,nm_brg:nm,merek:mrk,jumlah:jml,kd_rek:kd_rek,harga:hrg,biaya_pelihara:hrg,uraian_pelihara:uraian,total:tot,ket:ket});
               //  }
                  a = total + angka(tot); 
                               
            } else {
                $('#trd').edatagrid('updateRow',{index:idx2,row:{no_dokumen:no,kd_brg:kd,kd_uskpd:skp,nm_brg:nm,merek:mrk,jumlah:jml,kd_rek:kd_rek,harga:hrg,biaya_pelihara:hrg,uraian_pelihara:uraian,total:tot,ket:ket}});
                $('#trd2').edatagrid('updateRow',{index:idx2,row:{no_dokumen:no,kd_brg:kd,kd_uskpd:skp,nm_brg:nm,merek:mrk,jumlah:jml,kd_rek:kd_rek,harga:hrg,biaya_pelihara:hrg,uraian_pelihara:uraian,total:tot,ket:ket}});                                
                s = total - angka(total2);
                a = s + angka(tot);
            }
            updt = 'f';
            total = number_format(a,2,'.',',');
            $('#total').attr('value',total);
            $('#total2').attr('value',total);                                    
            kosong2();
        }else {
                alert('Apakah semua inputan sudah lengkap??. Mohon diperiksa kembali KIB, PILIHAN ASET, KODE REKENING, URAIAN, dan BIAYA PEMELIHARAAN.!! ');
                exit();
			}
		}*/
    
function append_save(){
    var rows = $('#trd2').edatagrid('getSelections');
    jgrid = rows.length ;
    if(updt='t'){
     pidx = jgrid ;
    pidx = pidx + 1 ;
    
    }else if(updt='f'){
      pidx = pidx + 1 ;
    }
    var no      = $('#nomor').combogrid('getValue'); //document.getElementById('nomor').value;
    var skp     = document.getElementById('uskpd').value; //$('#uskpd').combogrid('getValue');
    var unit    = $('#mlokasi').combogrid('getValue'); //document.getElementById('mlokasi').value;
    var jns     = $('#cmbjenis').combogrid('getValue');
    var nmjns   = document.getElementById('nmgolongan').value;
    var bid     = $('#bidang').combogrid('getValue');
    var nmbid   = document.getElementById('nmbidang').value;
    var kd      = $('#kdbarang').combogrid('getValue');
    var nmkd    = document.getElementById('nmkelompok').value;
    var tahun   = $('#tahun').combogrid('getValue');
    var nkib    = $('#kib').combogrid('getValue');
    var idbrg   = document.getElementById('id_brg').value;
    var pelihara= document.getElementById('pelihara').value;
    var kd_giat = document.getElementById('kd_kegiatan').value;
    var nm_giat = document.getElementById('nm_kegiatan').value;
    var kdrek   = document.getElementById('kd_rek').value;
    var nmrek   = document.getElementById('nm_rek5').value;
    var oleh    = angka(document.getElementById('n_oleh_hide').value);
    var umur    = angka(document.getElementById('umur').value);
    var hrg     = angka(document.getElementById('hrg').value);
    var t_umur  = angka(document.getElementById('tambah_umur').value);
    var uraian  = document.getElementById('uraian').value;
    var ket     = document.getElementById('ket').value;
    var tot     = 0; 
    //alert('oleh   '+oleh+'hrg      '+hrg);
    var cnilai  = oleh+hrg;
    var umr     = umur+t_umur;
    var csql    ='';
    $('#trd2').edatagrid('appendRow',{idx:pidx,no_dokumen:no,no_kib:nkib,kd_skpd:skp,kd_unit:unit,idbrg:idbrg,kd_golongan:jns,nm_golongan:nmjns,kd_bidang:bid,nm_bidang:nmbid,kd_brg:kd,nm_brg:nmkd,tahun:tahun,pelihara:pelihara,kdrek:kdrek,n_oleh:oleh,umur:umur,hrg:'',tambah_umur:'',uraian:uraian,ket:ket,kd_kegiatan:kd_giat,nm_kegiatan:nm_giat,nm_rek:nmrek });
    //$('#trd').edatagrid('appendRow',{idx:pidx,no_dokumen:no,no_kib:nkib,kd_skpd:skp,kd_unit:unit,idbrg:idbrg,kd_golongan:jns,nm_golongan:nmjns,kd_bidang:bid,nm_bidang:nmbid,kd_brg:kd,nm_brg:nmkd,tahun:tahun,pelihara:pelihara,kdrek:kdrek,n_oleh:oleh,umur:umur,hrg:'',tambah_umur:'',uraian:uraian,ket:ket });
    $('#trd2').edatagrid('selectAll');
    var rows = $('#trd2').edatagrid('getSelections');
    jgrid = rows.length ;
    if(updt='t'){
        pidx = jgrid ;
        pidx = pidx + 1 ;
    }else if(updt='f'){
        pidx = pidx + 1 ;
    }
    $('#trd2').edatagrid('appendRow',{idx:pidx,no_dokumen:no,no_kib:nkib,kd_skpd:skp,kd_unit:unit,idbrg:idbrg,kd_golongan:jns,nm_golongan:nmjns,kd_bidang:bid,nm_bidang:nmbid,kd_brg:kd,nm_brg:nmkd,tahun:tahun,pelihara:pelihara,kdrek:kdrek,n_oleh:'',umur:'',hrg:hrg,tambah_umur:t_umur,uraian:uraian,ket:ket,kd_kegiatan:kd_giat,nm_kegiatan:nm_giat,nm_rek:nmrek });
    
    $('#trd2').edatagrid('selectAll');
        var rows = $('#trd2').datagrid('getSelections');

        for(var i=0; i<rows.length; i++){
                idx         = rows[i].idx;
                no_dokumen  = rows[i].no_dokumen;
                no_kib      = rows[i].no_kib;
                kd_skpd     = rows[i].kd_skpd;
                kd_unit     = rows[i].kd_unit;
                idbrg       = rows[i].idbrg;
                kd_golongan = rows[i].kd_golongan;
                nm_golongan = rows[i].nm_golongan;
                kd_bidang   = rows[i].kd_bidang;
                nm_bidang   = rows[i].nm_bidang;
                kd_brg      = rows[i].kd_brg;
                nm_brg      = rows[i].nm_brg;
                tahun       = rows[i].tahun;
                pelihara    = rows[i].pelihara;
                kdrek       = rows[i].kdrek;
                n_oleh      = rows[i].n_oleh;
                umur        = rows[i].umur;
                harga       = rows[i].hrg;
                t_umur      = rows[i].tambah_umur;
                uraian      = rows[i].uraian;
                ket         = rows[i].ket;
                kd_kegiatan = rows[i].kd_kegiatan;
                nm_kegiatan = rows[i].nm_kegiatan;
                nm_rek      = rows[i].nm_rek;

                               
                if(i>0){
                    csql = csql+","+"('"+no_dokumen+"','"+no_kib+"','"+kd_skpd+"','"+kd_unit+"','"+idbrg+"','"+kd_golongan+"','"+nm_golongan+"','"+kd_bidang+"','"+nm_bidang+"','"+kd_brg+"','"+nm_brg+"','"+tahun+"','"+pelihara+"','"+kdrek+"','"+n_oleh+"','"+umur+"','"+harga+"','"+t_umur+"','"+kd_kegiatan+"','"+nm_kegiatan+"','"+nm_rek+"')";
                } else {

                    csql = "values('"+no_dokumen+"','"+no_kib+"','"+kd_skpd+"','"+kd_unit+"','"+idbrg+"','"+kd_golongan+"','"+nm_golongan+"','"+kd_bidang+"','"+nm_bidang+"','"+kd_brg+"','"+nm_brg+"','"+tahun+"','"+pelihara+"','"+kdrek+"','"+n_oleh+"','"+umur+"','"+harga+"','"+t_umur+"','"+kd_kegiatan+"','"+nm_kegiatan+"','"+nm_rek+"')";        
                } 
        }
            $(document).ready(function(){
                $.ajax({
                    type: "POST", 
                    dataType:'json', 
                    url: '<?php echo base_url(); ?>/index.php/transaksi/simpan_peliharabrg',   
                    data: ({tabel:'temp_pelihara',no:no,sql:csql,uskpd:skp,lokasi:unit,id_brg:idbrg}),
                    
                    success:function(data){
                        status=data.pesan;
                        if(status=='1'){
                            $('#trd').edatagrid('appendRow',{idx:pidx,no_dokumen:no,no_kib:nkib,kd_skpd:skp,kd_unit:unit,idbrg:idbrg,kd_golongan:jns,nm_golongan:nmjns,kd_bidang:bid,nm_bidang:nmbid,kd_brg:kd,nm_brg:nmkd,tahun:tahun,pelihara:pelihara,kdrek:kdrek,nilai:cnilai,umur:umr,uraian:uraian,ket:ket,kd_kegiatan:kd_kegiatan,nm_kegiatan:nm_kegiatan,nm_rek:nm_rek });
                            $('#total2').attr('value',number_format(cnilai,2,'.',','));
                            $('#total').attr('value',number_format(cnilai,2,'.',','));
                            $('#trd2').edatagrid('unselectAll');
                            $('#append').linkbutton('disable');

                        }else{
                            alert('gagal');
                        }   
                    }                                        
                });
            });

        kosong2();



    
}




    function keluar(){
		 swal({
					title: "Jangan lupa disimpan.!!",
					type:"warning"
					});
        $("#dialog-modal").dialog('close');
        $('#trd2').edatagrid('reload');                              
    }   
    
    function get2(kd_brg,kd_uskpd,nm_brg,merek,jumlah,kd_rek,harga,biaya_pelihara,uraian_pelihara,total,ket){
        //$('#jenis').combogrid('setValue',jns);
		//$('#bida').combogrid('setValue',bdg);
		//$('#kelo').combogrid('setValue',klpk);
		//$('#kelo1').combogrid('setValue',klpk1);
        //$('#kdkib').combogrid('setValue',kdkib);
        //$('#nm_kib').attr('value',nm_kib);                                  
        $('#merek').attr('value',merek);
        $('#jml').attr('value',jumlah);
        $('#kd_rek').attr('value',kd_rek);
        $('#hrg').attr('value',biaya_pelihara);
        $('#uraian').attr('value',uraian_pelihara);
        $('#tot').attr('value',total);
        $('#ket').attr('value',ket);
        total2 = total;
		}
     function simpan(){
        var cno     = $('#nomor').combogrid('getValue'); //document.getElementById('nomor').value;
        var ctgl    = $('#tanggal').datebox('getValue');
        var cuskpd  = document.getElementById('uskpd').value; //$('#uskpd').combogrid('getValue');
        var cmlokasi = $('#mlokasi').combogrid('getValue'); //document.getElementById('mlokasi').value; 
        var cnmuskpd = document.getElementById('nmuskpd').value;
		var cthn    = '<?php echo ($this->session->userdata('ta_simbakda')); ?>';
        var ctotal  = angka(document.getElementById('total').value);  
        if (cno==''){
		sweetAlert("MAAF..!!", "Nomor Dokumen mohon diisi", "error");
            exit();
        } 
        if (ctgl==''){
		sweetAlert("MAAF..!!", "Nomor Tanggal Dokumen mohon diisi", "error");
            exit();
        }
        if (cuskpd==''){
            alert('Kode Unit Tidak Boleh Kosong');
            exit();
        }                 
        $(document).ready(function(){
            $.ajax({
                type: "POST",       
                dataType : 'json',         
                data: ({tabel:'trh_trpelihara',no:cno,tgl:ctgl,lokasi:cmlokasi,uskpd:cuskpd,nmuskpd:cnmuskpd,tahun:cthn,total:ctotal}),
                url: '<?php echo base_url(); ?>index.php/transaksi/simpan_peliharabrg',
                success:function(data){
                   status = data.pesan;                    
                   if (status == '0'){
                       alert('Gagal Simpan...!!');
                       exit();
                   } else {  
                   simpan_detail();                               
				 /*swal({
					title: "Berhasil",
					text: "Data telah disimpan.!!",
					imageUrl:"<?php echo base_url();?>/lib/images/biak.jpg"
					}); */                              
                    }                                                                                                         
                }
				});
				});                                 
			}
    function simpan_detail(){
        var no      = document.getElementById('nomor').value;
        var skpd    = document.getElementById('uskpd').value; //$('#uskpd').combogrid('getValue');
        var unit    = $('#mlokasi').combogrid('getValue'); //document.getElementById('mlokasi').value;
        var nom     = $('#kib').combogrid('getValue');
        var umur1   = angka(document.getElementById('umur').value);
        var t_umur  = angka(document.getElementById('tambah_umur').value);
        var id_brg  = document.getElementById('id_brg').value;
        var n_peli  = angka(document.getElementById('hrg').value);
        var n_oleh  = angka(document.getElementById('n_oleh_hide').value);
        var jns     = $('#cmbjenis').combogrid('getValue');
        var peli    = document.getElementById('pelihara').value;
        var kd_giat = document.getElementById('kd_kegiatan').value;
        var nm_giat = document.getElementById('nm_kegiatan').value;
        var kdrek   = document.getElementById('kd_rek').value;
        var nmrek   = document.getElementById('nm_rek5').value;
        var h_umur  = umur1+t_umur;
        var h_nilai = n_peli+n_oleh;
        var csql    ='';
        $('#trd').datagrid('selectAll');
        var rows = $('#trd').datagrid('getSelections');

        for(var i=0; i<rows.length; i++){
                idx         = rows[i].idx;
                no_dokumen  = rows[i].no_dokumen;
                no_kib      = rows[i].no_kib;
                kd_skpd     = rows[i].kd_skpd;
                kd_unit     = rows[i].kd_unit;
                idbrg       = rows[i].idbrg;
                kd_golongan = rows[i].kd_golongan;
                nm_golongan = rows[i].nm_golongan;
                kd_bidang   = rows[i].kd_bidang;
                nm_bidang   = rows[i].nm_bidang;
                kd_brg      = rows[i].kd_brg;
                nm_brg      = rows[i].nm_brg;
                tahun       = rows[i].tahun;
                pelihara    = rows[i].pelihara;
                kdrek       = rows[i].kdrek;
                nmrek       = rows[i].nmrek;
                nilai       = rows[i].nilai;
                umur        = rows[i].umur;
                uraian      = rows[i].uraian;
                ket         = rows[i].ket;
                kd_kegiatan = rows[i].kd_giat;
                nm_giat     = rows[i].nm_giat;
                               
                if(i>0){
                    csql = csql+","+"('"+no_dokumen+"','"+no_kib+"','"+kd_skpd+"','"+kd_unit+"','"+idbrg+"','"+kd_golongan+"','"+nm_golongan+"','"+kd_bidang+"','"+nm_bidang+"','"+kd_brg+"','"+nm_brg+"','"+tahun+"','"+pelihara+"','"+kdrek+"','"+nilai+"','"+umur+"','"+uraian+"','"+ket+"','"+n_peli+"','"+n_oleh+"','"+kd_kegiatan+"','"+nm_giat+"','"+nmrek+"')";
                } else {

                    csql = "values('"+no_dokumen+"','"+no_kib+"','"+kd_skpd+"','"+kd_unit+"','"+idbrg+"','"+kd_golongan+"','"+nm_golongan+"','"+kd_bidang+"','"+nm_bidang+"','"+kd_brg+"','"+nm_brg+"','"+tahun+"','"+pelihara+"','"+kdrek+"','"+nilai+"','"+umur+"','"+uraian+"','"+ket+"','"+n_peli+"','"+n_oleh+"','"+kd_kegiatan+"','"+nm_giat+"','"+nmrek+"')";         
                } 
        }
            $(document).ready(function(){
                $.ajax({
                    type: "POST", 
                    dataType:'json', 
                    url: '<?php echo base_url(); ?>/index.php/transaksi/simpan_peliharabrg',   
                    data: ({tabel:'trd_trpelihara',no:no,sql:csql,uskpd:kd_skpd,lokasi:kd_unit,h_umur:umur,total:nilai,id_brg:idbrg,jns:kd_golongan,pl:pelihara}),
                    
                    success:function(data){
                        status=data.pesan;
                        if(status=='1'){
                            $('#trd').edatagrid('unselectAll');
                        swal({
                            title: "Berhasil",
                            text: "Data telah disimpan.!!",
                            imageUrl:"<?php echo base_url();?>/lib/images/biak.jpg"
                            });
                            section1();
                            $("#trh").edatagrid("reload");
                        }else{
                            alert('gagal');
                        }   
                    }                                        
                });
            });
    }
    
    /*function hapus(){
        var cnomor = document.getElementById('nomor').value;
		var cmlokasi = document.getElementById('mlokasi').value;
        var tny = confirm('Yakin Ingin Menghapus Data, Nomor Dokumen : '+cnomor);        
        if (tny==true){
        var urll = '<?php echo base_url(); ?>index.php/transaksi/hapus_peliharabrg';
        $(document).ready(function(){
        $.ajax({url:urll,
                 dataType:'json',
                 type: "POST",    
                 data:({no:cnomor,skpd:cmlokasi}),
                 success:function(data){
                        status = data.pesan;
                        if (status=='1'){
                            alert('Data Berhasil Terhapus');         
                        } else {
                            alert('Gagal Hapus');
                        }        
                 }
                 
                });           
        });
        }
        $('#trh').edatagrid('reload');  
     
    }*/

    function hapus(){
      var rows = $('#trh').edatagrid('getSelected');
      no    = rows.no_dokumen;
      kode  = rows.kd_uskpd;
      unit  = rows.kd_unit;
      var del = confirm("Apakah Anda Yakin ingin menghapus data   "+no+" "+kode+" "+unit+"?");
        if (del==true){     
        var urll = '<?php echo base_url(); ?>index.php/transaksi/hapus_peliharabrg';

        $(document).ready(function(){
            $.ajax({
            type: "POST",
            url: urll,
            data: ({
                no:no,
                skpd:kode,
                unit:unit
            }),
            dataType:"json",
            success:function(data){                                          
            status = data;
                if (status=='0'){
                    alert('Gagal Hapus..!!');
                    exit();
                } else {
                    $('#trh').edatagrid('reload');
                    
                }
            }
            }); 
        });   
      }



        
    } 

    function hapus_detail1(){
        var n = angka(document.getElementById('total').value)
        var rows = $('#trd').edatagrid('getSelected');
        no_dokumen  = rows.no_dokumen;
        idbrg       = rows.idbrg;
        nilai       = rows.nilai;
        
        var idx = $('#trd').edatagrid('getRowIndex',rows);
        var del = confirm("Apakah Anda Yakin ingin menghapus data   "+no_dokumen+"   "+idbrg+"?");
        if (del==true){          
           $('#trd').edatagrid('deleteRow',idx);
           total = n-angka(nilai);
           $('#total').attr('value',number_format(total,2,'.',','));
           $('#trd').edatagrid('selectAll');
            var rows = $('#trd').edatagrid('getSelections');
            for(var i=0; i<rows.length; i++){
                idx         = rows[i].idx;
            }
            if(idx>0){
                $('#add').linkbutton('disable');
            }else{
                $('#add').linkbutton('enable');
            }
      }
    } 
   
   function hapus_detail(){
    
        var cnomor = document.getElementById('nomor').value;
        var n       = angka(document.getElementById('total2').value); 
        //alert(n);
        var skpd = document.getElementById('uskpd').value; // $('#uskpd').combogrid('getValue');
        var rows    = $('#trd2').edatagrid('getSelected');
		
        //no_dokumen  = rows.no_dokumen;
        idbrg       = rows.idbrg;
        oleh        = angka(rows.n_oleh);
        hrg         = angka(rows.harga);
        nm_brg      = rows.nm_brg;  
		//alert(oleh);alert(hrg);
        var idx = $('#trd2').edatagrid('getRowIndex',idx);
        
        var tny = confirm('Yakin Ingin Menghapus Data, ID Barang : '+idbrg+' Nama Barang : '+nm_brg );
        if (tny==true){
            $('#trd2').edatagrid('deleteRow',idx);
            $('#trd').edatagrid('deleteRow',idx);            
            var total = n - oleh- hrg;
            //alert(total);
            $.ajax({
                type: 'POST',
                data: ({no:cnomor,idbrg:idbrg,skpd:skpd}),
                url:"<?php echo base_url(); ?>index.php/transaksi/hps_trd_peliharabrg"
            });
            $('#trd2').edatagrid('reload');
            $('#trd2').edatagrid('selectAll');
            var rows = $('#trd2').edatagrid('getSelections');
            for(var i=0; i<rows.length; i++){
                idx         = rows[i].idx;
            }
            if(idx>0){
                $('#append').linkbutton('disable');
            }else{
                $('#append').linkbutton('enable');
            }
            $('#total2').attr('value',number_format(total,2,'.',','));
            $('#total').attr('value',number_format(total,2,'.',','));                                
            kosong2();
            //alert('xxxxxx');
        }                     
    }
	
	function max_rinci(){  
	var organisasi = $('#uskpd').combogrid('getValue');
		$.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>index.php/transaksi/load_idmax',
            data: ({skpd:organisasi,table:'trh_trpelihara',kolom:'no_dokumen',kolom_skpd:'kd_uskpd'}),
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
   </script>


<div id="tabs" >
   <p><h3 align="center">PEMELIHARAAN BARANG</h3></p>
	<ul style="background-color:#2da305;">
        <li><a href="#tabs-1" style="width: 452px;" id="tabs1">List View</a></li>
        <li><a href="#tabs-2" style="width: 452px;" id="tabs2">Form Input</a></li>        
    </ul>
    <div id="tabs-1">
        <div>
            <p align="right">
                <a class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="javascript:kosong();section2();">Tambah</a> 
                <a class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="javascript:section2();">Detail Barang</a>               
                <a class="easyui-linkbutton" iconCls="icon-search" plain="false" >Cari</a>
                <input type="text" value="" id="txtcari"/>              
                <table  id="trh" title="List Dokumen" style="width:940px;height:400px;" >  
                </table>                
            </p>
        </div>
    </div>
    <div id="tabs-2">  
        <br /><br />
        <table>
            <tr>
                <td height="30px">No. Dokumen</td>
                <td>:</td>
                <td><input type="text" id="nomor" style="width: 200px;" onclick="javascript:select();" /></td>
                <td width="70px"></td>
                <td>Tanggal Dokumen</td>
                <td>:</td>
                <td><input type="text" id="tanggal" style="width: 140px;" /></td>     
            </tr>
            <tr>
                <td height="30px">Unit Kerja</td>
                <td>:</td>
                <td><input id="uskpd" name="uskpd" style="width: 140px;" readonly="true" /></td>
                <td></td>
                <td>Nama Unit Kerja</td> 
                <td>:</td>
                <td><input type="text" id="nmuskpd" style="border:0;width: 400px;" readonly="true"/>
					<input type="text" id="mlokasi" name="mlokasi" style="border:0;width: 200px;" readonly="true"/>				
				</td>                                
            </tr>       
            <!--tr>
                <td>Tahun Aset</td>
                <td>:</td>
                <td><input id="tahun" name="tahun" style="width: 140px;" value=""/>  </td>            
            </tr-->                            
        </table>  
        <br />
        <div align="center">
        <fieldset>
        
            <table>
            <tr>
                <td>
                    <a class="easyui-linkbutton" id="c_simpan" iconCls="icon-save" plain="false" onclick="javascript:simpan();">Simpan</a>
                    <a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:section1();">Keluar</a>
                </td>
            </tr>
        </table>
        </fieldset>
        </div> 
        <!-- <fieldset > -->
        <div id="toolbar" align="center" >
    		<a id="add" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="javascript:tambah_detail();"><b>Tambah Barang</b></a>   		                            		
        </div>
        <!-- </fieldset> -->
        <!--br />
        <div align="center">
        	<a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:kosong();">Tambah</a>
            <a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:simpan();">Simpan</a>   		  
            <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:section1();">Kembali</a>          
        </div-->
        <br /> 
        <table  id="trd" title="Detail Barang" style="width:940px;height:300px;" >  
        </table>       
        <div align="right">Total : <input type="text" id="total" style="text-align: right;border:0;width: 200px;font-size: large;" readonly="true"/></div>        
        <br />
        
    </div>  
</div>

<div id="dialog-modal" title="Pilihan Kib" >
    <p class="validateTips" >Pilih Barang yang Ingin Dipelihara</p> 
	<fieldset>
	<table>
		<!--tr><td>PILIH KIB</td><td colspan="4">:<input id="jenis" name="jenis" value=""/></td></tr-->
		<!-- 
		<tr>
			<td>NAMA ASET</td>
			<TD>:<INPUT style="border:0; width:300px;" ID="nm_kib" NAME="nm_kib" VALUE=""/></td></TD><td>
			<td hidden="true">HARGA ASET</td>
			<td hidden="true">:<INPUT disabled="true" ID="nilai" NAME="nilai" VALUE=""/> NO:<INPUT disabled="true" ID="kdkib" NAME="kdkib" VALUE=""/></td>
		</tr> -->
        <tr>
                <td>Golongan Barang</td>
                <td>:<input type="text" id="cmbjenis" name="cmbjenis" style="width: 200px;" />&nbsp;&nbsp;<input type="text" id="nmgolongan" name="nmgolongan" style="width: 200px;border: 0;" readonly="true"/></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Bidang Barang</td>
                <td>:<input type="text" id="bidang" name="bidang" style="width: 200px;" />&nbsp;&nbsp;<input type="text" id="nmbidang" name="nmbidang" style="width: 200px;border: 0;" readonly="true"/></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Kode Barang</td>
                <td>:<input type="text" id="kdbarang" name="kdbarang" style="width: 200px;" />&nbsp;&nbsp;<input type="text" id="nmkelompok" name="nmkelompok" style="width: 200px;border: 0;" readonly="true"/></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Tahun KIB</td>
                <td>:<input type="text" id="tahun" name="tahun" style="width: 140px;" /></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
            <td>PILIH ASET</td>
            <td> :<input type="text" style="width: 140px;" ID="kib" NAME="kib" /><input type="hidden" id="id_brg" name="id_brg" style="width: 200px;"/></td>
            <td>PEMELIHARAAN KE</td>
            <td>:</td>
            <td><input type="text" style="width: 50px;" ID="pelihara" NAME="pelihara" disabled="true"/></td>
        </tr>
		<tr>
            <td>KODE KEGIATAN</td>
            <TD colspan='4'>:<INPUT style="width: 140px;" readonly="true" ID="kd_kegiatan" NAME="kd_kegiatan" /> <input type="text" id="nm_kegiatan" name="nm_kegiatan" style="width: 450px;border:0;" readonly="true"/></TD>
            <td></td>
            <TD></TD>       
            <td></td>
        </tr><tr>
			<td>KODE REKENING</td>
			<TD colspan='4'>:<INPUT style="width: 140px;" ID="kd_rek" NAME="kd_rek" readonly="true" /> <input type="text" id="nm_rek5" name="nm_rek5" style="width: 300px;border:0;" readonly="true"/></TD>
			<td></td>
			<TD></TD>		
			<td></td>
		</tr>
        <tr>
            <td>NILAI PEROLEHAN</td>
            <td> :<input style="width: 140px;text-align: right;" ID="n_oleh" NAME="n_oleh"  /><input type="hidden" id="n_oleh_hide" name="n_oleh_hide" style="width: 150px;"/></td>
            <td>UMUR</td>
            <td>:</td>
            <td><input style="width: 50px;text-align: right;" ID="umur" NAME="umur" disabled="true"/></td>
        </tr>
		<tr>
			<td>BIAYA PEMELIHARAAN</td>
			<td>:<INPUT ID="hrg" NAME="hrg" style="width: 140px;text-align: right;" readonly="true" onkeyup="hitung();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PERSENTASE : <input style="width: 60px;text-align: right;border:0;" ID="persen" NAME="persen" disabled="true"/>%</td>
			<td>PEN. MASA</td>
            <td>:</td>
            <td><input style="width: 50px;text-align: right;" ID="tambah_umur" NAME="tambah_umur" disabled="true"/></td>
		</tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <TD >URAIAN PEMELIHARAAN</TD>

            <TD  colspan="2"><TEXTAREA ID="uraian" style="width: 450px; height: 40px;"></TEXTAREA></TD>
        </tr>
        <tr>
            <TD >KETERANGAN</TD>

            <TD  colspan="2"><TEXTAREA ID="ket" style="width: 450px; height: 40px;"></TEXTAREA></TD>
        </tr>

	</table>
	</fieldset>
    <fieldset>
        <table align="center">
            <tr>
                <td><!-- <a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:kosong2();">Tambah</a> -->
                    <a id="append" class="easyui-linkbutton" iconCls="icon-save" plain="false" onclick="javascript:append_save();">Simpan</a>
                    <a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:keluar();">Keluar</a>                               
                </td>
            </tr>
        </table>   
    </fieldset>
    <fieldset>      
        <table border="1">      
            <tr> 
                <td rowspan="9" width="930"  >
                    <table  id="trd2" title="Detail Barang Rencana dipelihara" style="width:940px;height:270px;" >  
                    </table>           
                    <div align="right">Total : <input type="text" id="total2" style="text-align: right;border:0;width: 200px;font-size: large;" readonly="true"/></div>     
                </td>         
            </tr>  
        </table>            
    </fieldset>  
</div>

