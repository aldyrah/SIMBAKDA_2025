<script type="text/javascript" src="<?php echo base_url(); ?>lib/jquery.maskMoney.min.js"></script>
<script src="<?php echo base_url(); ?>lib/sweet-alert.min.js"></script>
<link   rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>lib/sweet-alert.css">
<script type="text/javascript">
    
    var updt = 'f';
    var idx2 = '';
    var total2 = 0;
    var nomor_bukti='';
    var sts_inp='';
     $(document).ready(function() {
          $("#accordion").accordion();
          $("#dialog-modal").dialog({
            height: 500,
            width: 1000,
            modal: true, 
            background:'#2da305',           
            autoOpen:false                
          });

          $("#dialog-modal-kib").dialog({
            height: 500,
            width: 1000,
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
     });

     //this view has modify by demansyah msm biak 
    $(document).ready(function(){
      $('#hrg').maskMoney({thousands:',', decimal:'.', precision:0});
    });      
     
    $(function(){         
         $('#trh').edatagrid({
    		url: "<?php echo base_url(); ?>index.php/transaksi/ambil_trh_reklas",
            idField:"no_dokumen",            
            rownumbers:"true", 
            fitColumns:"true",
            singleSelect:"true",
            autoRowHeight:"false",
            loadMsg:"Tunggu Sebentar....!!",
            pagination:"true",
            nowrap:"true",                       
            columns:[[
                {field:'no_bukti',title:'Nomor Bukti',width:20},
        	    {field:'no_dokumen',title:'Nomor Dokumen',width:40},
                {field:'tgl_dokumen',title:'Tanggal',width:20},
                {field:'nm_uskpd',title:'Unit OPD',width:100},
                {field:'kd_uskpd',title:'OPD',hidden:true},
                {field:'kd_unit',title:'unit',hidden:true},
                {field:'tahun',title:'Tahun',width:20,align:"center"},
                {field:'sts_inp',title:'STS',width:20,align:"center",hidden:true},
				//{field:'hapus',width:5,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus();'' />";}}
            ]],
            onSelect:function(rowIndex,rowData){
                no_bukti= rowData.no_bukti; 
                nomor   = rowData.no_dokumen;
                no_reg  = rowData.no_reg;
                tgl     = rowData.tgl_dokumen;
                unit    = rowData.kd_unit;
                nm_unit = rowData.nm_unit;
                kode    = rowData.kd_uskpd;
                nmkode  = rowData.nm_uskpd;
                tahun   = rowData.tahun;
                total   = rowData.total;
                sts_inp = rowData.sts_inp;
                updt    = 't';
                get(no_bukti,nomor,no_reg,tgl,unit,nm_unit,kode,nmkode,tahun,total,sts_inp);
               
            },
            onDblClickRow:function(rowIndex,rowData){
                no_bukti= rowData.no_bukti;
                nomor   = rowData.no_dokumen;
                no_reg  = rowData.no_reg;
                tgl     = rowData.tgl_dokumen;
                unit    = rowData.kd_unit;
                nm_unit = rowData.nm_unit;
                kode    = rowData.kd_uskpd;
                nmkode  = rowData.nm_uskpd;
                tahun   = rowData.tahun;
                total   = rowData.total;
                sts_inp = rowData.sts_inp;
                updt    = 't';
                get(no_bukti,nomor,no_reg,tgl,unit,nm_unit,kode,nmkode,tahun,total,sts_inp);
                load_detail(no_bukti,nomor,kode);
                section2();
                $('#mlokasi').combogrid('disable');
                $('#add').linkbutton('disable');
                $('#hapus').linkbutton('disable');
                $('#c_simpan').linkbutton('disable');
                }

        });
               
      
          /*$('#trd').edatagrid({  
            toolbar:'#toolbar',
            rownumbers:"true",             
            singleSelect:"true",
            autoRowHeight:"false",
            toolbar:"#toolbar",
            nowrap:"true",
            onSelect:function(rowIndex,rowData){                    
                    idx = rowIndex;
                    nilx = rowData.nilai;
            },                                                     
            columns:[[       
            {field:'kd_skpd',title:'Kode Skpd',width:120,align:"center",hidden:"true"},
            {field:'no_oleh',title:'No Oleh',width:250,align:"left",hidden:"true"},
            {field:'kd_brg',title:'Kode Barang',width:120,align:"center"},
            {field:'nm_brg',title:'Nama Barang',width:250,align:"left"},
            {field:'detail_brg',title:'Detail Barang',width:250,align:"right"},
            {field:'nilai',title:'Nilai',width:150,align:"right"},
            {field:'alamat1',title:'Alamat',width:250,align:"left"},
            {field:'nilai_kontrak',title:'Nilai Kontrak',width:80,align:"right"},
	
            ]]
        }); */
		
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
               {field:'kd_skpd',title:'Kode OPD',width:100},  
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

       

        $('#cmbjenis').combogrid({           
        idField:'gol',  
        textField:'gol',
        mode:'remote',
        panelWidth:400,
        width:160,
        url:'<?php echo base_url(); ?>index.php/master/ambil_golongan_rek',
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
            
            
            $('#bidang').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_bidang_rek',
            queryParams:({gol:cgol})
        });            
        }                    
    });

        $('#cmbjenis_kib').combogrid({           
        idField:'gol',  
        textField:'gol',
        mode:'remote',
        panelWidth:400,
        width:50,
        url:'<?php echo base_url(); ?>index.php/master/ambil_golongan_rek_kib',
        columns:[[  
               
               {field:'gol',title:'Kode Golongan',width:100},  
               {field:'nm_golongan',title:'Nama Golongan',width:500}
            ]], 
        onSelect:function(rowIndex,rowData){
            cgol=rowData.gol;
            ngol=rowData.nm_golongan;
            
            $('#nmgolongan_kib').attr('value',ngol);
            $('#bidang_kib').combogrid('clear');
            $('#kdbarang_kib').combogrid('clear');
            $('#nmbidang_kib').attr('value','');
            $('#nmbrg_kib').attr('value','');
            
            
            $('#bidang_kib').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_bidang_rek',
            queryParams:({gol:cgol})
        });            
        }                    
    });

$('#cmbjenis_kib_baru').combogrid({           
        idField:'gol',  
        textField:'gol',
        mode:'remote',
        panelWidth:400,
        width:50,
        url:'<?php echo base_url(); ?>index.php/master/ambil_golongan_rek_kib_baru',
        columns:[[  
               
               {field:'gol',title:'Kode Golongan',width:100},  
               {field:'nm_golongan',title:'Nama Golongan',width:500}
            ]], 
        onSelect:function(rowIndex,rowData){
            cgol=rowData.gol;
            ngol=rowData.nm_golongan;
            
            $('#nmgolongan_kib_baru').attr('value',ngol);
            $('#bidang_kib_baru').combogrid('clear');
            //$('#kdbarang_kib').combogrid('clear');
            $('#nmbidang_kib_baru').attr('value','');
            //$('#nmkelompok_kib').attr('value','');
            
            
            $('#bidang_kib_baru').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_bidang_rek',
            queryParams:({gol:cgol})
        });            
        }                    
    });

        $('#bidang').combogrid({  
            panelWidth:650,
            width:160, 
            height:150, 
            idField:'bidang',  
            textField:'bidang',              
            mode:'remote',            
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               
               {field:'bidang',title:'Kode Barang',width:100},  
               {field:'nm_bidang',title:'Nama Barang',width:550}
            ]],  
             onSelect:function(rowIndex,rowData){
                bidang=rowData.bidang;
                nmbidang=rowData.nm_bidang;
                 
                //$('#bidang').attr('value',bidang);
                $('#nmbidang').attr('value',nmbidang);
				
                $('#kdbarang').combogrid("clear");
                $('#nmkelompok').attr('value',''); 
				var skpd = $('#uskpd').combogrid('getValue'); 
				var gol  = $('#cmbjenis').combogrid('getValue');
                var dt   = $('#tanggal').datebox('getValue');
                var p    = dt.substr(0,4);
                var st_inp = sts_inp;

                $('#kdbarang').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_kdp_rek',
                queryParams:({skpd:skpd,kd_baru:bidang,gol:gol,p:p,sts_inp:sts_inp})});            
        }  
    });

    $('#bidang_kib').combogrid({  
            panelWidth:650,
            width:120, 
            height:150, 
            idField:'bidang',  
            textField:'bidang',              
            mode:'remote',            
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               
               {field:'bidang',title:'Kode Barang',width:100},  
               {field:'nm_bidang',title:'Nama Barang',width:550}
            ]],  
             onSelect:function(rowIndex,rowData){
                bidang=rowData.bidang;
                nmbidang=rowData.nm_bidang;
                 
                //$('#bidang').attr('value',bidang);
                $('#nmbidang_kib').attr('value',nmbidang);
                
                $('#kdbarang_kib').combogrid("clear");
                $('#nmkelompok_kib').attr('value',''); 
                var skpd = $('#uskpd').combogrid('getValue'); 
                var gol  = $('#cmbjenis_kib').combogrid('getValue');
                var dt   = $('#tanggal').datebox('getValue');
                var p    = dt.substr(0,4);
                var st_inp = sts_inp;
                $('#kdbarang_kib').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_kdp_rek',
                queryParams:({skpd:skpd,kd_baru:bidang,gol:gol,p:p,sts_inp:sts_inp})});            
        }  
    });

$('#bidang_kib_baru').combogrid({  
            panelWidth:650,
            width:120, 
            height:150, 
            idField:'bidang',  
            textField:'bidang',              
            mode:'remote',            
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               
               {field:'bidang',title:'Kode Barang',width:100},  
               {field:'nm_bidang',title:'Nama Barang',width:550}
            ]],  
             onSelect:function(rowIndex,rowData){
                bidang=rowData.bidang;
                nmbidang=rowData.nm_bidang;
                 
                //$('#bidang').attr('value',bidang);
                $('#nmbidang_kib_baru').attr('value',nmbidang);
                
                           
        }  
    });
        $('#kdbarang').combogrid({
            panelWidth:950,
            width:160, 
            idField:'kd_brg',  
            textField:'kd_brg',              
            mode:'remote',            
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
			
               {field:'no_reg',title:'NO REG',width:50}, 
               {field:'nm_brg',title:'NAMA BARANG',width:175}  , 
               {field:'nilai',title:'HARGA',width:100,align:'right'}, 
               {field:'nilai_kontrak',title:'NILAI KONTRAK',width:100,align:'right'}, 
               {field:'keterangan',title:'KETERANGAN',width:525}
            ]],  
             onSelect:function(rowIndex,rowData){
                ckd_kelompok    = rowData.kd_brg;                                          
                cnmkelompok     = rowData.nm_brg;                                         
                ket   			= rowData.keterangan;                                        
                nilai  			= rowData.nilai;                                      
                nilkon          = (rowData.nilai+"/"+rowData.nilai_kontrak);
				
                $('#id_barang').attr('value',rowData.id_barang);
                $('#ketkdp').attr('value',ket);
                $('#nilkdp').attr('value',nilai);
                $('#nmbrg').attr('value',rowData.nm_brg);

                $('#no_reg').attr('value',rowData.no_reg);
                $('#no').attr('value',rowData.no);
                $('#no_oleh').attr('value',rowData.no_oleh);
                $('#tgl_reg').attr('value',rowData.tgl_reg);
                $('#tgl_oleh').attr('value',rowData.tgl_oleh);
                $('#no_dokumen').attr('value',rowData.no_dokumen);
                $('#kd_brg').attr('value',rowData.kd_brg);
                $('#nm_brg').attr('value',rowData.nm_brg);
                $('#detail_brg').attr('value',rowData.detail_brg);
                $('#kd_tanah').attr('value',rowData.kd_tanah);
                $('#asal').attr('value',rowData.asal);
                $('#dsr_peroleh').attr('value',rowData.dsr_peroleh);
                $('#total_k').attr('value',rowData.total);
                $('#kondisi').attr('value',rowData.kondisi);
                $('#konstruksi').attr('value',rowData.konstruksi);
                $('#jenis').attr('value',rowData.jenis);
                $('#bangunan').attr('value',rowData.bangunan);
                $('#luas').attr('value',rowData.luas);
                $('#jumlah').attr('value',rowData.jumlah);
                $('#status_tanah').attr('value',rowData.status_tanah);
                $('#alamat1').attr('value',rowData.alamat1);
                $('#alamat2').attr('value',rowData.alamat2);
                $('#alamat3').attr('value',rowData.alamat3);
                $('#no_mutasi').attr('value',rowData.no_mutasi);
                $('#tgl_mutasi').attr('value',rowData.tgl_mutasi);
                $('#no_pindah').attr('value',rowData.no_pindah);
                $('#tgl_pindah').attr('value',rowData.tgl_pindah);
                $('#no_hapus').attr('value',rowData.no_hapus);
                $('#tgl_hapus').attr('value',rowData.tgl_hapus);
                $('#keterangan').attr('value',rowData.keterangan);
                $('#kd_skpd').attr('value',rowData.kd_skpd);
                $('#kd_unit').attr('value',rowData.kd_unit);
                $('#milik').attr('value',rowData.milik);
                $('#wilayah').attr('value',rowData.wilayah);
                $('#tahun').attr('value',rowData.tahun);
                $('#foto').attr('value',rowData.foto);
                $('#foto2').attr('value',rowData.foto2);
                $('#no_urut').attr('value',rowData.no_urut);
                $('#lat').attr('value',rowData.lat);
                $('#lon').attr('value',rowData.lon);
                $('#nilai').attr('value',rowData.nilai2);
            }                                                          
                
    });

$('#kdbarang_kib').combogrid({
            panelWidth:950,
            width:120, 
            idField:'kd_brg',  
            textField:'kd_brg',              
            mode:'remote',            
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
            
               {field:'no_reg',title:'NO REG',width:50}, 
               {field:'nm_brg',title:'NAMA BARANG',width:175}  , 
               {field:'nilai',title:'HARGA',width:100,align:'right'}, 
               {field:'nilai_kontrak',title:'NILAI KONTRAK',width:100,align:'right'}, 
               {field:'keterangan',title:'KETERANGAN',width:525}
            ]],  
             onSelect:function(rowIndex,rowData){
                ckd_kelompok    = rowData.kd_brg;                                          
                cnmkelompok     = rowData.nm_brg;                                         
                ket             = rowData.keterangan;                                        
                nilai           = rowData.nilai;                                      
                nilkon          = (rowData.nilai+"/"+rowData.nilai_kontrak);
                
                $('#id_barang_kib').attr('value',rowData.id_barang);
                $('#ketkdp_kib').attr('value',ket);
                $('#nilkdp_kib').attr('value',nilai);
                $('#nmbrg_kib').attr('value',rowData.nm_brg);

                $('#no_reg_kib').attr('value',rowData.no_reg);
                $('#no_kib').attr('value',rowData.no);
                $('#no_oleh_kib').attr('value',rowData.no_oleh);
                $('#tgl_reg_kib').attr('value',rowData.tgl_reg);
                $('#tgl_oleh_kib').attr('value',rowData.tgl_oleh);
                $('#no_dokumen_kib').attr('value',rowData.no_dokumen);
                $('#kd_brg_kib').attr('value',rowData.kd_brg);
                $('#nm_brg_kib').attr('value',rowData.nm_brg);
                $('#detail_brg_kib').attr('value',rowData.detail_brg);
                $('#kd_tanah_kib').attr('value',rowData.kd_tanah);
                $('#asal_kib').attr('value',rowData.asal);
                $('#dsr_peroleh_kib').attr('value',rowData.dsr_peroleh);
                $('#total_k_kib').attr('value',rowData.total);
                $('#kondisi_kib').attr('value',rowData.kondisi);
                $('#konstruksi_kib').attr('value',rowData.konstruksi);
                $('#jenis_kib').attr('value',rowData.jenis);
                $('#bangunan_kib').attr('value',rowData.bangunan);
                $('#luas_kib').attr('value',rowData.luas);
                $('#jumlah_kib').attr('value',rowData.jumlah);
                $('#status_tanah_kib').attr('value',rowData.status_tanah);
                $('#alamat1_kib').attr('value',rowData.alamat1);
                $('#alamat2_kib').attr('value',rowData.alamat2);
                $('#alamat3_kib').attr('value',rowData.alamat3);
                $('#no_mutasi_kib').attr('value',rowData.no_mutasi);
                $('#tgl_mutasi_kib').attr('value',rowData.tgl_mutasi);
                $('#no_pindah_kib').attr('value',rowData.no_pindah);
                $('#tgl_pindah_kib').attr('value',rowData.tgl_pindah);
                $('#no_hapus_kib').attr('value',rowData.no_hapus);
                $('#tgl_hapus_kib').attr('value',rowData.tgl_hapus);
                $('#keterangan_kib').attr('value',rowData.keterangan);
                $('#kd_skpd_kib').attr('value',rowData.kd_skpd);
                $('#kd_unit_kib').attr('value',rowData.kd_unit);
                $('#milik_kib').attr('value',rowData.milik);
                $('#wilayah_kib').attr('value',rowData.wilayah);
                $('#tahun_kib').attr('value',rowData.tahun);
                $('#foto_kib').attr('value',rowData.foto);
                $('#foto2_kib').attr('value',rowData.foto2);
                $('#no_urut_kib').attr('value',rowData.no_urut);
                $('#lat_kib').attr('value',rowData.lat);
                $('#lon_kib').attr('value',rowData.lon);
                $('#nilai_kib').attr('value',rowData.nilai2);
            }                                                          
                
    });
        
	
		
	
		
	$('#uskpd').combogrid({  
            panelWidth:750,  
			//width:300,
            idField:'kd_skpd',  
            textField:'kd_skpd',  
            mode:'remote',                      
            url:'<?php echo base_url(); ?>index.php/master/ambil_msskpd2',  
            columns:[[  
               {field:'kd_skpd',title:'Kode OPD',width:80},  
               {field:'nm_skpd',title:'Nama OPD',width:250},
               {field:'kd_lokasi',title:'Kode Unit',width:130},  
               {field:'nm_lokasi',title:'Nama Unit',width:250}    
            ]],  
            onSelect:function(rowIndex,rowData){
               cuskpd = rowData.kd_skpd;   
               ckd_lokasi = rowData.kd_lokasi;  
               cnm_lokasi = rowData.nm_lokasi;          
               $('#nmunit').attr('value',rowData.nm_skpd);        
               $('#mlokasix').attr('value',ckd_lokasi);        
               $('#nmmlokasix').attr('value',cnm_lokasi); 
               if(updt=='f'){
                    ambil_nomor();
               }
                                           
            } 
         }); 
		
    });
    
    function section1(){        
        $('#section1').click();  
        $('#trh').edatagrid('reload'); 
        set_grid();                                                     
    }
    

    function section2(){
         $(document).ready(function(){                
             $('#section2').click(); 
                
         });    
     }
	
   function get(no_bukti,nomor,no_reg,tgl,unit,nm_unit,kode,nmkode,tahun,total,sts_inp){
        if(sts_inp=='1'){
            $('#status_am1').prop('checked', true);
            $('#status_am1').prop('disabled', true);
            $('#status_am2').prop('disabled', true);
        }else if(sts_inp=='2'){
            $('#status_am2').prop('checked', true);
            $('#status_am1').prop('disabled', true);
            $('#status_am2').prop('disabled', true);
        }
        $('#nomor_bukti').attr('value',no_bukti);
        $('#nomor').attr('value',nomor);
        $('#nomor').attr('disabled',true);
        $('#tanggal').datebox('setValue',tgl);
        $('#tanggal').datebox('disable');
        $('#uskpd').combogrid('setValue',kode);
        $('#uskpd').combogrid('disable');
        $('#nmuskpd').attr('value',nmkode);
        $('#mlokasix').attr('setValue',unit);
        $('#nmmlokasix').attr('value',nm_unit);
        $('#total').attr('value',number_format(total,2,'.',','));
        
    }
    function kosong(){
		var skpd = '<?php echo ($this->session->userdata('skpd'));?>';
		var unit = '<?php echo ($this->session->userdata('unit_skpd'));?>';
        cdate = '<?php echo date("Y-m-d"); ?>';
        sts_inp='1';
        $('#status_am1').prop('checked', true);
        $('#status_am1').prop('disabled', false);
        $('#status_am2').prop('disabled', false);
        
        $("#nomor_bukti").attr('value','');
        $("#nomor").attr('value','');
        $('#nomor').attr('disabled',false);
        $('#tanggal').datebox('setValue',cdate);
        $('#tanggal').datebox('enable');
        $('#uskpd').combogrid('enable');
        $('#uskpd').combogrid('clear');
        $('#uskpd').combogrid('grid').datagrid('reload');
        $('#nmunit').attr('value','');
        $('#mlokasix').attr('value','');
        $('#nmmlokasix').attr('value','');
        $('#total').attr('value','0.00');
        $('#nmuskpd').attr('value','');
        $('#mlokasi').combogrid('enable');
        $('#add').linkbutton('enable');
        $('#hapus').linkbutton('enable');
        $('#kd_rek').attr('value','');
        $('#hrg').attr('value',0);
        $('#ket').attr('value','');
        $('#add').linkbutton('enable');
        $('#c_simpan').linkbutton('enable');
        updt = 'f';
		//ambil_nomor();
        set_grid();
    }
    function kosong2(){ 
        if(sts_inp=='1'){
            $('#cmbjenis').combogrid('clear');
            $('#cmbjenis').combogrid('grid').datagrid('reload');
            $('#nmgolongan').attr('value','');
            $('#bidang').combogrid('clear');
            $('#bidang').combogrid('grid').datagrid('reload');
            $('#nmbidang').attr('value','');
            $('#kdbarang').combogrid('clear');
            $('#kdbarang').combogrid('grid').datagrid('reload');
            $('#nmbrg').attr('value','');
            $('#ketkdp').attr('value','');
            $('#id_barang').attr('value','');
            $('#nilkdp').attr('value','');
            $('#no_reg').attr('value','');
            $('#no').attr('value','');
            $('#no_oleh').attr('value','');
            $('#tgl_reg').attr('value','');
            $('#tgl_oleh').attr('value','');
            $('#no_dokumen').attr('value','');
            $('#kd_brg').attr('value','');
            $('#nm_brg').attr('value','');
            $('#detail_brg').attr('value','');
            $('#kd_tanah').attr('value','');
            $('#asal').attr('value','');
            $('#dsr_peroleh').attr('value','');
            $('#total_k').attr('value','');
            $('#kondisi').attr('value','');
            $('#konstruksi').attr('value','');
            $('#jenis').attr('value','');
            $('#bangunan').attr('value','');
            $('#luas').attr('value','');
            $('#jumlah').attr('value','');
            $('#status_tanah').attr('value','');
            $('#alamat1').attr('value','');
            $('#alamat2').attr('value','');
            $('#alamat3').attr('value','');
            $('#no_mutasi').attr('value','');
            $('#tgl_mutasi').attr('value','');
            $('#no_pindah').attr('value','');
            $('#tgl_pindah').attr('value','');
            $('#no_hapus').attr('value','');
            $('#tgl_hapus').attr('value','');
            $('#keterangan').attr('value','');
            $('#kd_skpd').attr('value','');
            $('#kd_unit').attr('value','');
            $('#milik').attr('value','');
            $('#wilayah').attr('value','');
            $('#tahun').attr('value','');
            $('#foto').attr('value','');
            $('#foto2').attr('value','');
            $('#no_urut').attr('value','');
            $('#lat').attr('value','');
            $('#lon').attr('value','');
            $('#nilai').attr('value','');
            $('#ket').attr('value','');
        }else if(sts_inp=='2'){
            $('#cmbjenis_kib').combogrid('clear');
            $('#cmbjenis_kib').combogrid('grid').datagrid('reload');
            $('#nmgolongan_kib').attr('value','');
            $('#bidang_kib').combogrid('clear');
            $('#bidang_kib').combogrid('grid').datagrid('reload');
            $('#nmbidang_kib').attr('value','');
            $('#kdbarang_kib').combogrid('clear');
            $('#kdbarang_kib').combogrid('grid').datagrid('reload');
            $('#nmbrg_kib').attr('value','');
            $('#ketkdp_kib').attr('value','');
            $('#id_barang_kib').attr('value','');
            $('#nilkdp_kib').attr('value','');
            $('#no_reg_kib').attr('value','');
            $('#no_kib').attr('value','');
            $('#no_oleh_kib').attr('value','');
            $('#tgl_reg_kib').attr('value','');
            $('#tgl_oleh_kib').attr('value','');
            $('#no_dokumen_kib').attr('value','');
            $('#kd_brg_kib').attr('value','');
            $('#nm_brg_kib').attr('value','');
            $('#detail_brg_kib').attr('value','');
            $('#kd_tanah_kib').attr('value','');
            $('#asal_kib').attr('value','');
            $('#dsr_peroleh_kib').attr('value','');
            $('#total_k_kib').attr('value','');
            $('#kondisi_kib').attr('value','');
            $('#konstruksi_kib').attr('value','');
            $('#jenis_kib').attr('value','');
            $('#bangunan_kib').attr('value','');
            $('#luas_kib').attr('value','');
            $('#jumlah_kib').attr('value','');
            $('#status_tanah_kib').attr('value','');
            $('#alamat1_kib').attr('value','');
            $('#alamat2_kib').attr('value','');
            $('#alamat3_kib').attr('value','');
            $('#no_mutasi_kib').attr('value','');
            $('#tgl_mutasi_kib').attr('value','');
            $('#no_pindah_kib').attr('value','');
            $('#tgl_pindah_kib').attr('value','');
            $('#no_hapus_kib').attr('value','');
            $('#tgl_hapus_kib').attr('value','');
            $('#keterangan_kib').attr('value','');
            $('#kd_skpd_kib').attr('value','');
            $('#kd_unit_kib').attr('value','');
            $('#milik_kib').attr('value','');
            $('#wilayah_kib').attr('value','');
            $('#tahun_kib').attr('value','');
            $('#foto_kib').attr('value','');
            $('#foto2_kib').attr('value','');
            $('#no_urut_kib').attr('value','');
            $('#lat_kib').attr('value','');
            $('#lon_kib').attr('value','');
            $('#nilai_kib').attr('value','');
            $('#ket_kib').attr('value','');
            $('#cmbjenis_kib_baru').combogrid('clear');
            $('#cmbjenis_kib_baru').combogrid('grid').datagrid('reload');
            $('#nmgolongan_kib_baru').attr('value','');
            $('#bidang_kib_baru').combogrid('clear');
            $('#bidang_kib_baru').combogrid('grid').datagrid('reload');
            $('#nmbidang_kib_baru').attr('value','');
        }
        

        $('#trd').edatagrid('selectAll');
        var rows = $('#trd').edatagrid('getSelections');
        jgrid = rows.length;
        if(jgrid=>1){
            $('#add').linkbutton('disable');
        }else{
            $('#add').linkbutton('enable');
        }
        $('#trd').edatagrid('unselectAll');

    }
	
    function load_detail(no_bukti,nomor,kode){
        var no_bukti = no_bukti;
        var nomor_r  = nomor;
        var skpd     = kode;
         $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>index.php/transaksi/ambil_trd_reklas',
                data: ({no_bukti:no_bukti,skpd:skpd,nomor_r:nomor_r}),
                dataType:"json",
				success:function(data){                                          
                    $.each(data,function(i,n){
						
						idx             = n['idx'];                                    
                        no_bukti        = n['no_bukti'];
                        no_reklas       = n['no_reklas'];
                        no_reg          = n['no_reg'];
                        id_barang       = n['id_barang'];
                        no              = n['no'];
                        no_oleh         = n['no_oleh'];
                        tgl_reg         = n['tgl_reg'];
                        tgl_oleh        = n['tgl_oleh'];
                        no_dokumen      = n['no_dokumen'];
                        kd_brg          = n['kd_brg'];
                        kd_brg_baru     = n['kd_brg_baru'];
                        nm_brg          = n['nm_brg'];
                        detail_brg      = n['detail_brg'];
                        kd_tanah        = n['kd_tanah'];
                        asal            = n['asal'];
                        dsr_peroleh     = n['dsr_peroleh'];
                        total           = n['total'];
                        kondisi         = n['kondisi'];
                        konstruksi      = n['konstruksi'];
                        jenis           = n['jenis'];
                        bangunan        = n['bangunan'];
                        luas            = n['luas'];
                        jumlah          = n['jumlah'];
                        status_tanah    = n['status_tanah'];
                        alamat1         = n['alamat1'];
                        alamat2         = n['alamat2'];
                        alamat3         = n['alamat3'];
                        no_mutasi       = n['no_mutasi'];
                        tgl_mutasi      = n['tgl_mutasi'];
                        no_pindah       = n['no_pindah'];
                        tgl_pindah      = n['tgl_pindah'];
                        no_hapus        = n['no_hapus'];
                        tgl_hapus       = n['tgl_hapus'];
                        keterangan      = n['keterangan'];
                        kd_skpd         = n['kd_skpd'];
                        kd_unit         = n['kd_unit'];
                        milik           = n['milik'];
                        wilayah         = n['wilayah'];
                        tahun           = n['tahun'];
                        foto            = n['foto'];
                        foto2           = n['foto2'];
                        no_urut         = n['no_urut'];
                        lat             = n['lat'];
                        lon             = n['lon'];
                        detail_riwayat  = n['detail_riwayat'];
                        nilai           = n['nilai'];
                        

                        $('#trd').edatagrid('appendRow',{
                            idx         :idx ,
                            nomor_bukti :no_bukti ,
                            no_reklas   :no_reklas ,
                            no_reg      :no_reg ,
                            id_barang   :id_barang ,
                            no          :no ,
                            no_oleh     :no_oleh ,
                            tgl_reg     :tgl_reg ,
                            tgl_oleh    :tgl_oleh ,
                            no_dokumen  :no_dokumen ,
                            kd_brg      :kd_brg ,
                            kd_brg_baru :kd_brg_baru ,
                            nm_brg      :nm_brg ,
                            detail_brg  :detail_brg ,
                            kd_tanah    :kd_tanah ,
                            asal        :asal ,
                            dsr_peroleh:dsr_peroleh ,
                            total       :total ,
                            kondisi     :kondisi ,
                            konstruksi  :konstruksi ,
                            jenis       :jenis ,
                            bangunan    :bangunan ,
                            luas        :luas ,
                            jumlah      :jumlah ,
                            status_tanah:status_tanah ,
                            alamat1     :alamat1 ,
                            alamat2     :alamat2 ,
                            alamat3     :alamat3 ,
                            no_mutasi   :no_mutasi ,
                            tgl_mutasi  :tgl_mutasi ,
                            no_pindah   :no_pindah ,
                            tgl_pindah  :tgl_pindah ,
                            no_hapus    :no_hapus ,
                            tgl_hapus   :tgl_hapus ,
                            keterangan  :keterangan ,
                            kd_skpd     :kd_skpd ,
                            kd_unit     :kd_unit ,
                            milik       :milik ,
                            wilayah     :wilayah ,
                            tahun       :tahun ,
                            foto        :foto ,
                            foto2       :foto2 ,
                            no_urut     :no_urut ,
                            lat         :lat ,
                            lon         :lon ,
                            nilai       :nilai ,
                            det_reklas  :detail_riwayat 
                        });                              
                    });
                }
         });         
          set_grid();
    }


 function set_grid(){
         $('#trd').edatagrid({  
            toolbar:'#toolbar',
            rownumbers:"true",             
            singleSelect:"true",
            autoRowHeight:"false",
            toolbar:"#toolbar",
            nowrap:"true",
            onSelect:function(rowIndex,rowData){                    
                    idx = rowIndex;
                    nilx = rowData.nilai;
            },                                                     
            columns:[[  
             
            {field:'idx',title:'idx',width:50,align:'left',hidden:'true'},
            {field:'nomor_bukti',width:50,align:'left',hidden:true},
            {field:'no_reklas',width:50,align:'left',hidden:true},
            {field:'no_reg',title:'No Reg',width:50,align:'left',hidden:true }, 
            {field:'id_barang',title:'ID Barang',width:50,align:'left',hidden:true }, 
            {field:'no',title:'No',width:50,align:'left',hidden:true },
            {field:'no_oleh',title:'No Oleh',width:50,align:'left',hidden:true },
            {field:'tgl_reg',title:'Tgl Reg',width:50,align:'left',hidden:true },
            {field:'tgl_oleh',title:'Tgl Oleh',width:50,align:'left',hidden:true },
            {field:'no_dokumen',title:'No Dokumen',width:220,align:'left'},
            {field:'kd_brg',title:'Kode Barang Lama',width:110,align:'left',hidden:true},
            {field:'kd_brg_baru',title:'Kode Barang',width:110,align:'left'},
            {field:'nm_brg',title:'nama Barang',width:150,align:'left'},
            {field:'detail_brg',title:'detail brg',width:50,align:'left',hidden:true },
            {field:'kd_tanah',title:'kd tanah',width:50,align:'left',hidden:true },
            {field:'asal',title:'asal',width:50,align:'left',hidden:true },
            {field:'dsr_peroleh',title:'dsr oleh',width:50,align:'left',hidden:true },
            {field:'total',title:'total',width:50,align:'left',hidden:true },
            {field:'kondisi',title:'Kondisi',width:50,align:'left',hidden:true },
            {field:'konstruksi',title:'konstruksi',width:50,align:'left',hidden:true },
            {field:'jenis',title:'jenis',width:50,align:'left',hidden:true },
            {field:'bangunan',title:'bangunan',width:50,align:'left',hidden:true },
            {field:'luas',title:'luas',width:50,align:'left',hidden:true },
            {field:'jumlah',title:'jumlah',width:50,align:'left',hidden:true },
            {field:'status_tanah',title:'',width:50,align:'left',hidden:true },
            {field:'alamat1',title:'Alamat',width:250,align:'left'},
            {field:'alamat2',title:'alamat2',width:50,align:'left',hidden:true }, 
            {field:'alamat3',title:'alamat3',width:50,align:'left',hidden:true },
            {field:'no_mutasi',title:'no_mutasi',width:50,align:'left',hidden:true },
            {field:'tgl_mutasi',title:'tgl_mutasi',width:50,align:'left',hidden:true },
            {field:'no_pindah',title:'no_pindah',width:50,align:'left',hidden:true },
            {field:'tgl_pindah',title:'tgl_pindah',width:50,align:'left',hidden:true },
            {field:'no_hapus',title:'no_hapus',width:50,align:'left',hidden:true },
            {field:'tgl_hapus',title:'tgl_hapus',width:50,align:'left',hidden:true },
            {field:'keterangan',title:'keterangan',width:50,align:'left',hidden:true },
            {field:'kd_skpd',title:'kd_skpd',width:50,align:'left',hidden:true },
            {field:'kd_unit',title:'kd_unit',width:50,align:'left',hidden:true },
            {field:'milik',title:'milik',width:50,align:'left',hidden:true },
            {field:'wilayah',title:'wilayah',width:50,align:'left',hidden:true },
            {field:'tahun',title:'tahun',width:50,align:'left',hidden:true },
            {field:'foto',title:'foto',width:50,align:'left',hidden:true },
            {field:'foto2',title:'foto2',width:50,align:'left',hidden:true },
            {field:'no_urut',title:'no_urut',width:50,align:'left',hidden:true },
            {field:'lat',title:'lat',width:50,align:'left',hidden:true },
            {field:'lon',title:'lon',width:50,align:'left',hidden:true },
            {field:'nilai',title:'Nilai',width:150,align:'right'},
            {field:'det_reklas',title:'Det Reklas',width:50,hidden:true}
            
	
            ]]
        });      
              
    }

    function tambah_detail(){
        var no = document.getElementById('nomor').value;
        var tgl = $('#tanggal').datebox('getValue');
        var kd  = $('#uskpd').combogrid('getValue');
        //var thn = $('#tahun').combobox('getValue');
        //$('#trd2').edatagrid('reload');
        if (no!='' && tgl!='' && kd!=''){
            if(sts_inp=='1'){
                $("#dialog-modal").dialog('open'); 
            }else{
                $("#dialog-modal-kib").dialog('open'); 
            }
            
            $('#append').linkbutton('enable');
            kosong2();   
            //set_grid2();
            //load_detail2();        
                  
        } else {
            alert('Nomor/Tanggal/Unit Kerja/Tahun masih kosong, harap isi terlebih dahulu');
        }        
    }
    
    
   

/*function append_save(){
	var cthn    = '<?php echo ($this->session->userdata('ta_simbakda')); ?>';
	var nmskp   = document.getElementById('nmunit').value;
    var nomor   = document.getElementById('nomor').value;
    var id      = document.getElementById('id_barang').value;
    var skp     = $('#uskpd').combogrid('getValue');
    var jns     = $('#cmbjenis').combogrid('getValue');
    var kdbr    = $('#bidang').combogrid('getValue');
    var kd_brg  = $('#kdbarang').combogrid('getValue');
    var tgl     = $('#tanggal').datebox('getValue');
    var ket     = document.getElementById('ket').value;
    var tot     = angka(document.getElementById('total').value);
	var nilai   = angka(document.getElementById('nilkdp').value);
		
            $(document).ready(function(){
                $.ajax({
                    type: "POST", 
                    dataType:'json', 
                    url: '<?php echo base_url(); ?>/index.php/transaksi/simpan_reklasbrg',   
                    data: ({tabel:'trd_reklas',no:nomor,id:id,uskpd:skp,jns:jns,nilai:nilai,tgl:tgl,kdbr:kdbr,kd_brg:kd_brg,ket:ket,tot:"",lok:"",thn:cthn,nmskp:nmskp,trd_kdbrg:"",trd_nilai:""}),
                    
                    success:function(data){
                        status=data.pesan;
                        if(status=='1'){
							alert("Data Berhasil Disimpan.!");
							load_detail(nomor);
							$('#trd').edatagrid('reload');    
                            $('#total').attr('value',number_format(tot+nilai,2,'.',','));
                      

                        }else{
                            alert('Gagal disimpan.!');
                        }   
                    }                                        
                });
            });

        kosong2();

}*/

function append_save(){
    var nomor_bukti     = document.getElementById('nomor_bukti').value;
    var no_reklas       = document.getElementById('nomor').value;
    if(sts_inp=='1'){
        var jenis           = $('#cmbjenis').combogrid('getValue');
        var bidang          = $('#bidang').combogrid('getValue');
        var brg             = $('#kdbarang').combogrid('getValue');
        var no_reg          = document.getElementById('no_reg').value;
        var id_barang       = document.getElementById('id_barang').value;
        var no              = document.getElementById('no').value;
        var no_oleh         = document.getElementById('no_oleh').value;
        var tgl_reg         = document.getElementById('tgl_reg').value;
        var tgl_oleh        = document.getElementById('tgl_oleh').value;
        var no_dokumen      = document.getElementById('no_dokumen').value;
        var kd_brg          = document.getElementById('kd_brg').value;
        var nm_brg          = document.getElementById('nmbidang').value;
        var detail_brg      = document.getElementById('detail_brg').value;
        var kd_tanah        = document.getElementById('kd_tanah').value;
        var asal            = document.getElementById('asal').value;
        var dsr_peroleh     = document.getElementById('dsr_peroleh').value;
        var total_k         = document.getElementById('total_k').value;
        var kondisi         = document.getElementById('kondisi').value;
        var konstruksi      = document.getElementById('konstruksi').value;
        var jenis           = document.getElementById('jenis').value;
        var bangunan        = document.getElementById('bangunan').value;
        var luas            = document.getElementById('luas').value;
        var jumlah          = document.getElementById('jumlah').value;
        var status_tanah    = document.getElementById('status_tanah').value;
        var alamat1         = document.getElementById('alamat1').value;
        var alamat2         = document.getElementById('alamat2').value;
        var alamat3         = document.getElementById('alamat3').value;
        var no_mutasi       = document.getElementById('no_mutasi').value;
        var tgl_mutasi      = document.getElementById('tgl_mutasi').value;
        var no_pindah       = document.getElementById('no_pindah').value;
        var tgl_pindah      = document.getElementById('tgl_pindah').value;
        var no_hapus        = document.getElementById('no_hapus').value;
        var tgl_hapus       = document.getElementById('tgl_hapus').value;
        var keterangan      = document.getElementById('keterangan').value;
        var kd_skpd         = document.getElementById('kd_skpd').value;
        var kd_unit         = document.getElementById('kd_unit').value;
        var milik           = document.getElementById('milik').value;
        var wilayah         = document.getElementById('wilayah').value;
        var tahun           = document.getElementById('tahun').value;
        var foto            = document.getElementById('foto').value;
        var foto2           = document.getElementById('foto2').value;
        var no_urut         = document.getElementById('no_urut').value;
        var lat             = document.getElementById('lat').value;
        var lon             = document.getElementById('lon').value;
        var nilai           = document.getElementById('nilkdp').value; 
        var total_h         = angka(document.getElementById('total').value); 
        var det_rekl        = document.getElementById('ket').value;
    }else if(sts_inp=='2'){
        var jenis           = $('#cmbjenis_kib_baru').combogrid('getValue');
        var bidang          = $('#bidang_kib_baru').combogrid('getValue');
        var brg             = $('#bidang_kib_baru').combogrid('getValue');
        var no_reg          = document.getElementById('no_reg_kib').value;
        var id_barang       = document.getElementById('id_barang_kib').value;
        var no              = document.getElementById('no_kib').value;
        var no_oleh         = document.getElementById('no_oleh_kib').value;
        var tgl_reg         = document.getElementById('tgl_reg_kib').value;
        var tgl_oleh        = document.getElementById('tgl_oleh_kib').value;
        var no_dokumen      = document.getElementById('no_dokumen_kib').value;
        var kd_brg          = document.getElementById('kd_brg_kib').value;
        var nm_brg          = document.getElementById('nmbidang_kib').value;
        var detail_brg      = document.getElementById('detail_brg_kib').value;
        var kd_tanah        = document.getElementById('kd_tanah_kib').value;
        var asal            = document.getElementById('asal_kib').value;
        var dsr_peroleh     = document.getElementById('dsr_peroleh_kib').value;
        var total_k         = document.getElementById('total_k_kib').value;
        var kondisi         = document.getElementById('kondisi_kib').value;
        var konstruksi      = document.getElementById('konstruksi_kib').value;
        var jenis           = document.getElementById('jenis_kib').value;
        var bangunan        = document.getElementById('bangunan_kib').value;
        var luas            = document.getElementById('luas_kib').value;
        var jumlah          = document.getElementById('jumlah_kib').value;
        var status_tanah    = document.getElementById('status_tanah_kib').value;
        var alamat1         = document.getElementById('alamat1_kib').value;
        var alamat2         = document.getElementById('alamat2_kib').value;
        var alamat3         = document.getElementById('alamat3_kib').value;
        var no_mutasi       = document.getElementById('no_mutasi_kib').value;
        var tgl_mutasi      = document.getElementById('tgl_mutasi_kib').value;
        var no_pindah       = document.getElementById('no_pindah_kib').value;
        var tgl_pindah      = document.getElementById('tgl_pindah_kib').value;
        var no_hapus        = document.getElementById('no_hapus_kib').value;
        var tgl_hapus       = document.getElementById('tgl_hapus_kib').value;
        var keterangan      = document.getElementById('keterangan_kib').value;
        var kd_skpd         = document.getElementById('kd_skpd_kib').value;
        var kd_unit         = document.getElementById('kd_unit_kib').value;
        var milik           = document.getElementById('milik_kib').value;
        var wilayah         = document.getElementById('wilayah_kib').value;
        var tahun           = document.getElementById('tahun_kib').value;
        var foto            = document.getElementById('foto_kib').value;
        var foto2           = document.getElementById('foto2_kib').value;
        var no_urut         = document.getElementById('no_urut_kib').value;
        var lat             = document.getElementById('lat_kib').value;
        var lon             = document.getElementById('lon_kib').value;
        var nilai           = document.getElementById('nilkdp_kib').value; 
        var total_h         = angka(document.getElementById('total').value); 
        var det_rekl        = document.getElementById('ket_kib').value;
    }
    

    $('#trd').edatagrid('selectAll');
      var rows = $('#trd').edatagrid('getSelections');
      jgrid = rows.length ;

      if(updt='t'){
            pidx = jgrid ;
            pidx = pidx + 1 ;
          }else if(updt='f'){
            pidx = pidx + 1 ;
          }
    $('#trd').edatagrid('appendRow',{
        idx             :pidx,
        nomor_bukti     :nomor_bukti,
        no_reklas       :no_reklas,
        no_reg          :no_reg,
        id_barang       :id_barang,
        no              :no,
        no_oleh         :no_oleh,
        tgl_reg         :tgl_reg,
        tgl_oleh        :tgl_oleh,
        no_dokumen      :no_dokumen,
        kd_brg          :kd_brg,
        kd_brg_baru     :bidang,
        nm_brg          :nm_brg,
        detail_brg      :detail_brg,
        kd_tanah        :kd_tanah,
        asal            :asal,
        dsr_peroleh     :dsr_peroleh,
        total           :total_k,
        kondisi         :kondisi,
        konstruksi      :konstruksi,
        jenis           :jenis,
        bangunan        :bangunan,
        luas            :luas,
        jumlah          :jumlah,
        status_tanah    :status_tanah,
        alamat1         :alamat1,
        alamat2         :alamat2,
        alamat3         :alamat3,
        no_mutasi       :no_mutasi,
        tgl_mutasi      :tgl_mutasi,
        no_pindah       :no_pindah,
        tgl_pindah      :tgl_pindah,
        no_hapus        :no_hapus,
        tgl_hapus       :tgl_hapus,
        keterangan      :keterangan,
        kd_skpd         :kd_skpd,
        kd_unit         :kd_unit,
        milik           :milik,
        wilayah         :wilayah,
        tahun           :tahun,
        foto            :foto,
        foto2           :foto2,
        no_urut         :no_urut,
        lat             :lat,
        lon             :lon,
        nilai           :nilai,
        det_reklas      :det_rekl
    });
    
    var totalseluruh = total_h + angka(nilai);
    $('#total').attr('value',number_format(totalseluruh,2,'.',','));
    kosong2();
    keluar();

}

function keluar(){
		 
        //$('#trd2').edatagrid('reload');   

        $('#trd').edatagrid('selectAll');
        var rows = $('#trd').edatagrid('getSelections');
        jgrid = rows.length;
        if(jgrid==0){
            $('#add').linkbutton('enable');
            $("#dialog-modal").dialog('close');
            $("#dialog-modal-kib").dialog('close');
        }else{
            $('#add').linkbutton('disable');
            swal({
                    title: "Jangan lupa disimpan.!!",
                    type:"warning"
                    });
        $("#dialog-modal").dialog('close');
        $("#dialog-modal-kib").dialog('close');
        }
        $('#trd').edatagrid('unselectAll');                           
    }   
    
    
function simpan(){
		var ct      = '<?php echo ($this->session->userdata('ta_simbakda')); ?>';
        var nb      = document.getElementById('nomor_bukti').value;
		var nr      = document.getElementById('nomor').value;
		var skp     = $('#uskpd').combogrid('getValue');
		var nmskp   = document.getElementById('nmunit').value;
		var lok     = document.getElementById('mlokasix').value;
        var nmlok   = document.getElementById('nmmlokasix').value;
		var tgl     = $('#tanggal').datebox('getValue');
		var tot     = angka(document.getElementById('total').value);
        var st_inp  = sts_inp; 
		
        if (nr==''){
		sweetAlert("MAAF..!!", "Nomor Dokumen mohon diisi", "error");
            exit();
        } 
        if (tgl==''){
		sweetAlert("MAAF..!!", "Nomor Tanggal Dokumen mohon diisi", "error");
            exit();
        }
        if (skp==''){
            sweetAlert("MAAF..!!", "Kode Unit Harus Diisi", "error");
            exit();
        }                 
        $(document).ready(function(){
            $.ajax({
                type: "POST",       
                dataType : 'json',         
                data: ({tabel:'trh_reklas',ct:ct,nb:nb,nr:nr,skp:skp,nmskp:nmskp,lok:lok,nmlok:nmlok,tgl:tgl,tot:tot}),
                url: '<?php echo base_url(); ?>index.php/transaksi/simpan_reklasbrg',
                success:function(data){
                   status = data.pesan;                    
                   if (status == '0'){
                       alert('Gagal Simpan...!!');
                       exit();
                   } else {  
                   simpan_detail();                               
				 swal({
					title: "Berhasil",
					text: "Data telah disimpan.!!",
					imageUrl:"<?php echo base_url();?>/lib/images/biak.jpg"
					});                              
                    }                                                                                                         
                }
				});
				});                                 
			}
			
     function simpan_detail(){
        var tgl     = $('#tanggal').datebox('getValue');
        var nr      = document.getElementById('nomor').value;
        var st_inp = sts_inp; 
        var csql    ='';
        $('#trd').datagrid('selectAll');
        var rows = $('#trd').datagrid('getSelections');
        var a1  = [];
        var a2  = [];
        var a3  = [];
        var a4  = [];
        var a5  = [];
        var a6  = [];
        var a7  = [];
        var a8  = [];
        var a9  = [];
        var a10 = [];
        var a11 = [];
        var a12 = [];
        var a13 = [];
        var a14 = [];
        var a15 = [];
        var a16 = [];
        var a17 = [];
        var a18 = [];
        var a19 = [];
        var a20 = [];
        var a21 = [];
        var a22 = [];
        var a23 = [];
        var a24 = [];
        var a25 = [];
        var a26 = [];
        var a27 = [];
        var a28 = [];
        var a29 = [];
        var a30 = [];
        var a31 = [];
        var a32 = [];
        var a33 = [];
        var a34 = [];
        var a35 = [];
        var a36 = [];
        var a37 = [];
        var a38 = [];
        var a39 = [];
        var a40 = [];
        var a41 = [];
        var a42 = [];
        var a43 = [];
        var a44 = [];
        var a45 = [];
        var a46 = [];
        var a47 = [];
        var a48 = [];


        for(var i=0; i<rows.length; i++){
            a1.push(rows[i].nomor_bukti);
            a2.push(rows[i].no_reklas);
            a3.push(rows[i].no_reg);
            a4.push(rows[i].id_barang);
            a5.push(rows[i].no);
            a6.push(rows[i].no_oleh);
            a7.push(rows[i].tgl_reg);
            a8.push(rows[i].tgl_oleh);
            a9.push(rows[i].no_dokumen);
            a10.push(rows[i].kd_brg);
            a11.push(rows[i].kd_brg_baru);
            a12.push(rows[i].kd_brg_baru);
            a13.push(rows[i].kd_brg_baru);
            a14.push(rows[i].nm_brg);
            a15.push(rows[i].detail_brg);
            a16.push(rows[i].kd_tanah);
            a17.push(rows[i].asal);
            a18.push(rows[i].dsr_peroleh);
            a19.push(rows[i].total);
            a20.push(rows[i].kondisi);
            a21.push(rows[i].konstruksi);
            a22.push(rows[i].jenis);
            a23.push(rows[i].bangunan);
            a24.push(rows[i].luas);
            a25.push(rows[i].jumlah);
            a26.push(rows[i].status_tanah);
            a27.push(rows[i].alamat1);
            a28.push(rows[i].alamat2);
            a29.push(rows[i].alamat3);
            a30.push(rows[i].no_mutasi);
            a31.push(rows[i].tgl_mutasi);
            a32.push(rows[i].no_pindah);
            a33.push(rows[i].tgl_pindah);
            a34.push(rows[i].no_hapus);
            a35.push(rows[i].tgl_hapus);
            a36.push(rows[i].keterangan);
            a37.push(rows[i].kd_skpd);
            a38.push(rows[i].kd_unit);
            a39.push(rows[i].milik);
            a40.push(rows[i].wilayah);
            a41.push(rows[i].tahun);
            a42.push(rows[i].foto);
            a43.push(rows[i].foto2);
            a44.push(rows[i].no_urut);
            a45.push(rows[i].lat);
            a46.push(rows[i].lon);
            a47.push(angka(rows[i].nilai));
            a48.push(rows[i].det_reklas);
            
        }
            bukti       =(a1.join('||'));
            reklas      =(a2.join('||'));
            reg         =(a3.join('||'));
            id_b        =(a4.join('||'));
            nom         =(a5.join('||'));
            oleh        =(a6.join('||'));
            tglreg      =(a7.join('||'));
            tgloleh     =(a8.join('||'));
            nodokumen   =(a9.join('||'));
            kdbrglama   =(a10.join('||'));
            kdbrgbaru   =(a11.join('||'));
            gol         =(a12.join('||'));
            bid         =(a13.join('||'));
            nmbrg       =(a14.join('||'));
            detailbrg   =(a15.join('||'));
            kdtanah     =(a16.join('||'));
            asl         =(a17.join('||'));
            dsrperoleh  =(a18.join('||'));
            ttal        =(a19.join('||'));
            kond        =(a20.join('||'));
            kons        =(a21.join('||'));
            jns         =(a22.join('||'));
            bangun      =(a23.join('||'));
            ls          =(a24.join('||'));
            jmlh        =(a25.join('||'));
            statustanah =(a26.join('||'));
            alamat1a    =(a27.join('||'));
            alamat2a    =(a28.join('||'));
            alamat3a    =(a29.join('||'));
            nomutasi    =(a30.join('||'));
            tglmutasi   =(a31.join('||'));
            nopindah    =(a32.join('||'));
            tglpindah   =(a33.join('||'));
            nohapus     =(a34.join('||'));
            tglhapus    =(a35.join('||'));
            keter       =(a36.join('||'));
            kdskpd      =(a37.join('||'));
            kdunit      =(a38.join('||'));
            milk        =(a39.join('||'));
            wil         =(a40.join('||'));
            thn         =(a41.join('||'));
            fto         =(a42.join('||'));
            fto2        =(a43.join('||'));
            nourut      =(a44.join('||'));
            latx        =(a45.join('||'));
            lonx        =(a46.join('||'));
            nil         =(a47.join('||'));
            det_r       =(a48.join('||'));
            
            $(document).ready(function(){
                $.ajax({
                    type: "POST", 
                    dataType:'json', 
                    url: '<?php echo base_url(); ?>/index.php/transaksi/simpan_reklasbrg',   
                    data: ({tabel:'trd_reklas',
                            bukti       :bukti,
                            reklas      :nr,
                            reg         :reg,
                            id_b        :id_b,
                            nom         :nom,
                            oleh        :oleh,
                            tglreg      :tglreg,
                            tgloleh     :tgloleh,
                            nodokumen   :nodokumen,
                            kdbrglama   :kdbrglama,
                            kdbrgbaru   :kdbrgbaru,
                            gol         :gol,
                            bid         :bid,
                            nmbrg       :nmbrg,
                            detailbrg   :detailbrg,
                            kdtanah     :kdtanah,
                            asl         :asl,
                            dsrperoleh  :dsrperoleh,
                            ttal        :ttal,
                            kond        :kond,
                            kons        :kons,
                            jns         :jns,
                            bangun      :bangun,
                            ls          :ls,
                            jmlh        :jmlh,
                            statustanah :statustanah,
                            alamat1a    :alamat1a,
                            alamat2a    :alamat2a,
                            alamat3a    :alamat3a,
                            nomutasi    :nomutasi,
                            tglmutasi   :tglmutasi,
                            nopindah    :nopindah,
                            tglpindah   :tglpindah,
                            nohapus     :nohapus,
                            tglhapus    :tglhapus,
                            keter       :keter,
                            kdskpd      :kdskpd,
                            kdunit      :kdunit,
                            milk        :milk,
                            wil         :wil,
                            thn         :thn,
                            fto         :fto,
                            fto2        :fto2,
                            nourut      :nourut,
                            latx        :latx,
                            lonx        :lonx,
                            nil         :nil,
                            det_r       :det_r,
                            tgl         :tgl,
                            sts_inp     :sts_inp
                        }),
                    
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
     
    

    function hapus(){
      $('#trd').edatagrid('selectAll');
      var rows          = $('#trd').edatagrid('getSelected');
      var bukti         = rows.nomor_bukti;
      var no_reklas     = rows.no_reklas;
      var id_barang     = rows.id_barang;
      var kd_baru       = rows.kd_brg_baru;
      var skpd          = rows.kd_skpd;
      var unit          = rows.kd_unit;
      var kd_lama       = rows.kd_brg;
      var st_inp        = sts_inp; 
      var urll          = '<?php echo base_url(); ?>index.php/transaksi/hapus_reklas';
      swal({
          title:"Apakah Anda Yakin Ingin Menghapus Data" ,
          text:"Hapus Data "+no_reklas+"?",
          type: "warning",
          html:true,
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Ya",
          cancelButtonText: "Tidak",
          closeOnConfirm: true,
          closeOnCancel: true
        },
        function(isConfirm){
          $("#dialog-modal-aaa").dialog('open');
          $(document).ready(function(){
                 $.post(urll,({bukti:bukti,no_reklas:no_reklas,id_barang:id_barang,kd_baru:kd_baru,skpd:skpd,unit:unit,sts_inp:st_inp,kd_lama:kd_lama}),function(data){
                    status = data.pesan;
                    if (status=='0'){
                        $("#dialog-modal-aaa").dialog('close');
                        sweetAlert("GAGAL..!!", "Data Gagal Dihapus", "error");
                        exit();
                    } else {
                        $("#dialog-modal-aaa").dialog('close');
                        sweetAlert("BERHASIL..!!", "Data Berhasil Dihapus", "success");
                        section1();
                        exit();
                    }
                 });
                });    
              });
      /*var del = confirm("Apakah Anda Yakin ingin menghapus data   "+no+" "+kode+" "+unit+"?");
        if (del==true){     
        var urll = '<?php echo base_url(); ?>index.php/transaksi/hapus_peliharabrg';
        $(document).ready(function(){
         $.post(urll,({no:no,skpd:kode,unit:unit}),function(data){
            status = data;
            if (status=='0'){
                alert('Gagal Hapus..!!');
                exit();
            } else {
                $('#trh').edatagrid('reload');
                
            }
         });
        });   
      }*/
    } 


    function ambil_nomor(){
        var tab = 'trh_reklas';
        var skpd = $('#uskpd').combogrid('getValue');
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

     function cari(zz){
    var kriteria = document.getElementById("txtcari").value; 
    
    $(function(){
     $('#trh').edatagrid({
            url: '<?php echo base_url(); ?>index.php/transaksi/ambil_trh_reklas',
            queryParams:({cari:zz})
        });        
     });
    }

    function hapus_det(){
        var rows = $('#trd').edatagrid('getSelected');
        var dok  = rows.no_dokumen;
        var kbrg = rows.kd_brg_baru;
        var nmb  = rows.nm_brg;
        var nil  = rows.nilai;
        var total = document.getElementById('total').value;
        var sisa = angka(total)-angka(nil);
        var idx   = $('#trd').datagrid('getRowIndex',rows);
          var tny   = confirm('Yakin Ingin Menghapus Data, No.Dokumen : '+dok+' Kode Barang : '+kbrg+'-'+nmb+' Nilai : '+nil);
          if (tny==true){
              $('#trd').datagrid('deleteRow',idx);  


              $('#trd').edatagrid('selectAll');
                    var row = $('#trd').edatagrid('getSelections');
                    jgrid = row.length;
                    if(jgrid==0){
                        $('#add').linkbutton('enable');
                    }else{
                        $('#add').linkbutton('disable');
                    }
                        $('#trd').edatagrid('unselectAll');



              $('#total').attr('value',number_format(sisa,2,'.',','));
                    
            } 
    }

    function opt(val){        
        sts_inp = val; 
        if (sts_inp==1){
            sts_inp='1';
            //$('#oto').show();
            //$('#man').hide();
        } else if(sts_inp==2){
            sts_inp='2'; 
            //$('#oto').hide();
            //$('#man').show();
        }           
    }
   </script>

<body>



<div id="content">    
<div id="accordion">


<h3><a href="#" id="section1"><i>REKLASIFIKASI BARANG</i></a></h3>
    <div>
    <p align="right">         
        <a class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="javascript:kosong();section2();">Tambah</a>
        <a plain="false">Cari</a>
        <input id="txtcari" class="easyui-searchbox" data-options="prompt:'Please Input Value',searcher:function(value,name){cari(value)}" style="width:190px"/>
                                  
    </p> 
    <p align="center">
      <table align="center" id="trh" title="LIST REKLAS BARANG" style="width:915px;height:350px;" >  
        </table>
    </p>
    </div> 

<h3><a href="#" id="section2"><i>INPUT REKLAS BARANG</i></a></h3>
    <div>
        <fieldset>
        <table>
            <tr style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
              <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;" colspan="5"><b>REKLAS KDP</b><input type="radio" value="1" id="status_am1" name="status_am" onclick="opt(this.value)"/>&nbsp;&nbsp;<b>REKLAS KIB</b><input type="radio" value="2" id="status_am2" name="status_am" onclick="opt(this.value)"/></td>
            </tr>
            <tr>
                <td height="30px"  style="width: 100px;">No. Bukti</td>
                <td>:</td>
                <td><input id="nomor_bukti" name="nomor_bukti" style="width: 130px;" placeholder="AutoNumber" disabled="true"/></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>     
            </tr>
            <tr>
                <td height="30px"  style="width: 100px;">No. Reklas</td>
                <td>:</td>
                <td><input type="text" id="nomor" name="nomor" style="width: 150px;"/></td>
                <td style="width: 50px;"></td>
                <td style="width: 100px;">Tanggal Reklas</td>
                <td>:</td>
                <td><input type="text" id="tanggal" style="width: 140px;" /></td>     
            </tr>
            <tr>
                <td height="30px">Unit Kerja</td>
                <td>:</td>
                <td><input id="uskpd" name="uskpd" style="width: 140px;" readonly="true" />
				</td>
                <td><input id="mlokasix" name="mlokasix" hidden="true" style="width: 140px;" readonly="true" /></td>
                <td>Nama Unit Kerja</td> 
                <td>:</td>
                <td>
				<input type="text" id="nmunit" style="border:0;width: 400px;" readonly="true"/>
                <input id="nmmlokasix" name="nmmlokasix" hidden="true" style="width: 140px;" readonly="true" />
				</td>                                
            </tr>                               
        </table> 
        <!-- </fieldset>  -->
        <br /> 
        <!-- <div align="center">
        <fieldset> -->
        
            <table align="center">
            <tr>
                <td>
                    <a class="easyui-linkbutton" id="c_simpan" iconCls="icon-save" plain="false" onclick="javascript:simpan();">Simpan</a>
                    <a class="easyui-linkbutton" id="c_hapus" iconCls="icon-remove" plain="false" onclick="javascript:hapus();">Hapus</a>
                    <a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:section1();">Keluar</a>
                </td>
            </tr>
        </table>
        </fieldset>
        <!-- </div>  -->
        <!-- <fieldset > -->
        <div id="toolbar" align="right" >
    		<a id="add" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="javascript:tambah_detail();">Tambah Barang</a> 
            <a id="hapus" name="hapus" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="javascript:hapus_det();">Hapus Detail</a>  		                            		
        </div>
        
        <br /> 
        <table  id="trd" title="Detail Barang" style="width:910px;height:350px;" >  
        </table>       
        <div align="right">Total : <input type="text" id="total" style="text-align: right;border:0;width: 200px;font-size: large;" readonly="true"/></div>        
        <br />
        
    <!-- </div>  --> 
<!-- </div> -->
</div>
</div>

<div id="dialog-modal" title="Pilih KDP" >
    <p class="validateTips" >Pilih Barang yang Ingin Direklas</p> 
	<fieldset>
	<table>
			<tr>
                <td>Golongan Barang Reklas</td>
                <td colspan="3">:<input type="text" id="cmbjenis" name="cmbjenis" style="width: 200px;" />&nbsp;&nbsp;
                    <input type="text" id="nmgolongan" name="nmgolongan" style="width: 400px;border: 0;" readonly="true"/></td>
                <!-- <td></td>
                <td></td> -->
            </tr>
            <tr>
                <td>Kode Barang Baru</td>
                <td colspan="3">:<input type="text" id="bidang" name="bidang" style="width: 200px;" />&nbsp;&nbsp;
                    <input type="text" id="nmbidang" name="nmbidang" style="width: 400px;border: 0;" readonly="true"/></td>
                <!-- <td></td>
                <td></td> -->
            </tr>
            <tr>
                <td>Pilih KDP</td>
                <td colspan="3">:<input type="text" id="kdbarang" name="kdbarang" style="width: 400px;" />&nbsp;&nbsp;
                    <input type="text" id="nmbrg" name="nmbrg" style="width: 400px;border: 0;" readonly="true"/></td>
                <!-- <td></td>
                <td></td> -->
            </tr>

			<tr>
				<td>Konstruksi</td>
				<td>:<input type="text" id="ketkdp" style="border:0;width: 350px;" readonly="true"/>
				<input type="text" id="id_barang" style="border:0;width: 350px;" hidden="true" readonly="true"/></td>
				<td>Nilai KDP</td>
				<td>:</td>
				<td><input type="text" id="nilkdp" style="border:0;width: 150px; text-align:right;" readonly="true"/></td>
			</tr>
            <tr hidden="true">
                <td><input type="text" id="no_reg" name="no_reg" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="no" name="no" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="no_oleh" name="no_oleh" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="tgl_reg" name="tgl_reg" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="tgl_oleh" name="tgl_oleh" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="no_dokumen" name="no_dokumen" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="kd_brg" name="kd_brg" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="nm_brg" name="nm_brg" style="border:0;width: 350px;" readonly="true"/>
                </td>
                <td><input type="text" id="detail_brg" name="detail_brg" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="kd_tanah" name="kd_tanah" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="asal" name="asal" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="dsr_peroleh" name="dsr_peroleh" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="total_k" name="total_k" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="kondisi" name="kondisi" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="konstruksi" name="konstruksi" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="jenis" name="jenis" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="bangunan" name="bangunan" style="border:0;width: 350px;" readonly="true"/>
                </td>
                <td><input type="text" id="luas" name="luas" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="jumlah" name="jumlah" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="status_tanah" name="status_tanah" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="alamat1" name="alamat1" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="alamat2" name="alamat2" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="alamat3" name="alamat3" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="no_mutasi" name="no_mutasi" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="tgl_mutasi" name="tgl_mutasi" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="no_pindah" name="no_pindah" style="border:0;width: 350px;" readonly="true"/>
                </td>
                <td><input type="text" id="tgl_pindah" name="tgl_pindah" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="no_hapus" name="no_hapus" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="tgl_hapus" name="tgl_hapus" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="keterangan" name="keterangan" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="kd_skpd" name="kd_skpd" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="kd_unit" name="kd_unit" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="milik" name="milik" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="wilayah" name="wilayah" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="tahun" name="tahun" style="border:0;width: 350px;" readonly="true"/>
                </td>
                <td><input type="text" id="foto" name="foto" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="foto2" name="foto2" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="no_urut" name="no_urut" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="lat" name="lat" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="lon" name="lon" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="nilai" name="nilai" style="border:0;width: 350px;" readonly="true"/>
                </td>
            </tr>

		<tr>
            <TD>PENJELASAN REKLAS</TD>

            <TD  colspan="2"><TEXTAREA ID="ket" style="width: 450px; height: 40px;"></TEXTAREA></TD>
        </tr>

	</table>
	</fieldset>
    <fieldset>
        <table align="center">
            <tr>
                <td><a id="append" class="easyui-linkbutton" iconCls="icon-save" plain="false" onclick="javascript:append_save();">Simpan</a>
                    <a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:keluar();">Keluar</a>                               
                </td>
            </tr>
        </table>   
    </fieldset>
</div>


<div id="dialog-modal-kib" title="Pilih KIB" >
    <p class="validateTips" >Pilih Barang yang Ingin Direklas</p> 
    <fieldset>
    <table align="center" border="0">
            <tr>
                <td>Golongan Barang Reklas</td>
                <td >:<input type="text" id="cmbjenis_kib" name="cmbjenis_kib" style="width: 200px;" />&nbsp;&nbsp;
                    <input type="text" id="nmgolongan_kib" name="nmgolongan_kib" style="width: 400px;border: 0;" readonly="true"/></td>
                <!-- <td></td>
                <td></td> -->
            </tr>
            <tr>
                <td>Kode Barang</td>
                <td colspan="3">:<input type="text" id="bidang_kib" name="bidang_kib" style="width: 200px;" />&nbsp;&nbsp;
                    <input type="text" id="nmbidang_kib" name="nmbidang_kib" style="width: 400px;border: 0;" readonly="true"/></td>
                <!-- <td></td>
                <td></td> -->
            </tr>
            <tr>
                <td>Pilih KIB</td>
                <td colspan="3">:<input type="text" id="kdbarang_kib" name="kdbarang_kib" style="width: 400px;" />&nbsp;&nbsp;
                    <input type="text" id="nmbrg_kib" name="nmbrg_kib" style="width: 400px;border: 0;" readonly="true"/></td>
                <!-- <td></td>
                <td></td> -->
            </tr>

            <tr>
                <td>Konstruksi</td>
                <td>:<input type="text" id="ketkdp_kib" style="border:0;width: 350px;" readonly="true"/>
                <input type="text" id="id_barang_kib" style="border:0;width: 350px;" hidden="true" readonly="true"/></td>
                <td>Nilai KIB</td>
                <td>:</td>
                <td><input type="text" id="nilkdp_kib" style="border:0;width: 150px; text-align:right;" readonly="true"/></td>
            </tr>
            <tr>
                <td>Golongan Barang Baru</td>
                <td >:<input type="text" id="cmbjenis_kib_baru" name="cmbjenis_kib_baru" style="width: 200px;" />&nbsp;&nbsp;
                    <input type="text" id="nmgolongan_kib_baru" name="nmgolongan_kib_baru" style="width: 400px;border: 0;" readonly="true"/></td>
                <!-- <td></td>
                <td></td> -->
            </tr>
            <tr>
                <td>Kode Barang Baru</td>
                <td colspan="3">:<input type="text" id="bidang_kib_baru" name="bidang_kib_baru" style="width: 200px;" />&nbsp;&nbsp;
                    <input type="text" id="nmbidang_kib_baru" name="nmbidang_kib_baru" style="width: 400px;border: 0;" readonly="true"/></td>
                <!-- <td></td>
                <td></td> -->
            </tr>
            <tr hidden="true">
                <td><input type="text" id="no_reg_kib" name="no_reg_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="no_kib" name="no_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="no_oleh_kib" name="no_oleh_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="tgl_reg_kib" name="tgl_reg_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="tgl_oleh_kib" name="tgl_oleh_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="no_dokumen_kib" name="no_dokumen_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="kd_brg_kib" name="kd_brg_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="nm_brg_kib" name="nm_brg_kib" style="border:0;width: 350px;" readonly="true"/>
                </td>
                <td><input type="text" id="detail_brg_kib" name="detail_brg_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="kd_tanah_kib" name="kd_tanah_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="asal_kib" name="asal_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="dsr_peroleh_kib" name="dsr_peroleh_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="total_k_kib" name="total_k_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="kondisi_kib" name="kondisi_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="konstruksi_kib" name="konstruksi_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="jenis_kib" name="jenis_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="bangunan_kib" name="bangunan_kib" style="border:0;width: 350px;" readonly="true"/>
                </td>
                <td><input type="text" id="luas_kib" name="luas_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="jumlah_kib" name="jumlah_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="status_tanah_kib" name="status_tanah_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="alamat1_kib" name="alamat1_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="alamat2_kib" name="alamat2_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="alamat3_kib" name="alamat3_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="no_mutasi_kib" name="no_mutasi_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="tgl_mutasi_kib" name="tgl_mutasi_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="no_pindah_kib" name="no_pindah_kib" style="border:0;width: 350px;" readonly="true"/>
                </td>
                <td><input type="text" id="tgl_pindah_kib" name="tgl_pindah_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="no_hapus_kib" name="no_hapus_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="tgl_hapus_kib" name="tgl_hapus_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="keterangan_kib" name="keterangan_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="kd_skpd_kib" name="kd_skpd_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="kd_unit_kib" name="kd_unit_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="milik_kib" name="milik_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="wilayah_kib" name="wilayah_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="tahun_kib" name="tahun_kib" style="border:0;width: 350px;" readonly="true"/>
                </td>
                <td><input type="text" id="foto_kib" name="foto_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="foto2_kib" name="foto2_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="no_urut_kib" name="no_urut_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="lat_kib" name="lat_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="lon_kib" name="lon_kib" style="border:0;width: 350px;" readonly="true"/>
                    <input type="text" id="nilai_kib" name="nilai_kib" style="border:0;width: 350px;" readonly="true"/>
                </td>
            </tr>

        <tr>
            <TD>PENJELASAN REKLAS</TD>

            <TD  colspan="2"><TEXTAREA ID="ket_kib" style="width: 450px; height: 40px;"></TEXTAREA></TD>
        </tr>

    </table>
    </fieldset>
    <fieldset>
        <table align="center">
            <tr>
                <td><a id="append" class="easyui-linkbutton" iconCls="icon-save" plain="false" onclick="javascript:append_save();">Simpan</a>
                    <a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:keluar();">Keluar</a>                               
                </td>
            </tr>
        </table>   
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

</body>