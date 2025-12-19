<script src="<?php echo base_url(); ?>lib/sweet-alert.min.js"></script>
<link   rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>lib/sweet-alert.css">
<script type="text/javascript" src="<?php echo base_url(); ?>easyui/autoCurrency.js"></script>
<script type="text/javascript">
    
    var updt = 'f';
    var idx2 = '';
    var total2 = 0;
     $(document).ready(function() {
          $("#tabs").tabs();
          $("#dialog-modal").dialog({
            height: 600,
            width: 1000,
            modal: true, 
            background:'#2da305',           
            autoOpen:false                
          });     
          $("#dialog-detail").dialog({
            height: 500,
            width: 500,
            modal: true, 
            background:'#2da305',           
            autoOpen:false                
          });                  
     });    
     
    $(function(){         
         $('#trh').edatagrid({
    		url: "<?php echo base_url(); ?>index.php/bhp/trh_masukbhp",
            idField:"no_dokumen",            
            rownumbers:"true", 
            fitColumns:"true",
            singleSelect:"true",
            autoRowHeight:"false",
            loadMsg:"Tunggu Sebentar....!!",
            pagination:"true",
            nowrap:"true",                       
            columns:[[
        	    {field:'no_dokumen',title:'Nomor Dokumen',width:30},
                {field:'tgl_dokumen',title:'Tanggal',width:20},
                {field:'nm_uskpd',title:'SKPD',width:50},
                {field:'nm_kegiatan',title:'KEGIATAN',width:80},
                {field:'total',title:'Total',width:40,align:"right"},
				{field:'hapus',width:5,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus();'' />";}}
            ]],
            onSelect:function(rowIndex,rowData){ 
                nomor   = rowData.no_dokumen;
                tgl     = rowData.tgl_dokumen;
                unit    = rowData.kd_unit;
                kode    = rowData.kd_uskpd;
                nmkode  = rowData.nm_uskpd;
                tahun   = rowData.tahun;
                total   = rowData.total;
                get(nomor,tgl,unit,kode,nmkode,tahun,total);
                
            }
        });
               
         $('#trd2').edatagrid({    		
            idField:"no_dokumen",            
            rownumbers:"true",            
            singleSelect:"true",
            autoRowHeight:"false",             
            loadMsg:"Tunggu Sebentar....!!",            
            nowrap:"true",
            onSelect:function(rowIndex,rowData){
                idx2 = rowIndex;
                var kode_brg = rowData.kode_brg;
				var detail_brg = rowData.detail_brg;
				var merk = rowData.merk;
				var jumlah = rowData.jumlah;
				var harga = rowData.harga;
				var total = rowData.total;
				var keterangan = rowData.keterangan;
				var kodegiat = rowData.kodegiat;
				var satuan = rowData.satuan;
				var sdana = rowData.sdana;
				var asal = rowData.asal;
                updt = 't';                             
                get2(kode_brg,detail_brg,merk,jumlah,harga,total,keterangan,kodegiat,satuan,sdana,asal); 
            }          
        });
        
    /*     $('#tanggal_terima').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            }
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
		
	 $('#tanggal_terima').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            },
			onSelect:function(){
			var upl= $('#tanggal').datebox('getValue'); 
			var spr= $('#tanggal_terima').datebox('getValue');
			if (Date.parse(upl)> Date.parse(spr)){swal({title: "Warning!",text: "Mohon untuk tidak melebihi tanggal Faktur.!!",type: "warning",confirmButtonText: "OK"});
				exit();
			}
			}
         });
     
	   $('#kdskpd').combogrid({  
           panelWidth:500,  
           idField:'kd_skpd',  
           textField:'kd_skpd',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/master/ambil_msskpd2',  
           columns:[[  
               {field:'kd_skpd',title:'KODE SKPD',width:100},  
               {field:'nm_skpd',title:'NAMA SKPD',width:400}    
           ]],  
           onSelect:function(rowIndex,rowData){
               lcskpd = rowData.kd_skpd; 
               lcskpdx = rowData.kd_lokasi;  
               $('#uskpd').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_uskpd',queryParams:({kduskpd:lcskpdx}) });
               $("#nmskpd").attr("value",rowData.nm_skpd.toUpperCase());
           }  
         });
	 
         $('#uskpd').combogrid({  
            panelWidth:700,  
            idField:'kd_uskpd',  
            textField:'kd_uskpd',  
            mode:'remote',                      
           // url:'<?php echo base_url(); ?>index.php/master/ambil_ubidskpd',  
            columns:[[  
               {field:'kd_uskpd',title:'Kode Unit',width:100},  
               {field:'nm_uskpd',title:'Nama Unit',width:700}    
            ]],  
            onSelect:function(rowIndex,rowData){
               cuskpd = rowData.kd_uskpd;               
               $('#nmuskpd').attr('value',rowData.nm_uskpd.toUpperCase());                               
            } 
         });  
         
        $('#tahun').combobox({           
            valueField:'tahun',  
            textField:'tahun',
            url:'<?php echo base_url(); ?>index.php/master/tahun'   
        });
		
       $('#kd').combogrid({url:'<?php echo base_url(); ?>index.php/bhp/ambil_brg',  
            panelWidth:600, 
            width:160, 
            idField:'kd_brg',  
            textField:'nm_brg',              
            mode:'remote',
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kd_brg',title:'Kode Barang',width:100},  
               {field:'nm_brg',title:'Nama Barang',width:250},  
               {field:'spek',title:'Spesifikasi',width:250}    
            ]],  
            onSelect:function(rowIndex,rowData){                                                             
                cnm  = rowData.nm_brg;                                                        
                csat = rowData.satuan;                                                       
                chrg = rowData.harga; 
                $('#nm').attr('value',cnm);
                $('#satuan').combogrid('setValue',csat);
                $('#spek').attr('value',rowData.spek);
                $('#merek').attr('value',rowData.spek);
                $('#hrg').attr('value',number_format(chrg));
				min_sisa();
                $('#jml').focus();
            } 
        }); 
       $('#kd_dt').combogrid({url:'<?php echo base_url(); ?>index.php/bhp/ambil_brg',  
            panelWidth:600, 
            width:160, 
            idField:'kd_brg',  
            textField:'kd_brg',              
            mode:'remote',
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kd_brg',title:'Kode Barang',width:100},  
               {field:'nm_brg',title:'Nama Barang',width:250},  
               {field:'spek',title:'Spesifikasi',width:250}    
            ]],  
            onSelect:function(rowIndex,rowData){                                                             
                cnm = rowData.nm_brg;
                $('#spek').attr('value',rowData.spek);				
                $('#nm_dt').attr('value',cnm);
            } 
        });
    //dana_dt,asal_dt,giat_dt,kd_dt,nm_dt,satuan_dt,merek_dt,jml_dt,hrg_dt,tot_dt,ket_dt 

	$('#dana').combogrid({url:'<?php echo base_url(); ?>index.php/bhp/dana',  
            panelWidth:600, 
            width:160, 
            idField:'kode',  
            textField:'nama',              
            mode:'remote',
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kode',title:'Kode Barang',width:100},  
               {field:'nama',title:'Nama Barang',width:500}    
            ]],  
            onSelect:function(rowIndex,rowData){                                                             
                cnm = rowData.nama;
                $('#nm_dana').attr('value',cnm);
            } 
        }); 
	$('#dana_dt').combogrid({url:'<?php echo base_url(); ?>index.php/bhp/dana',  
            panelWidth:600, 
            width:160, 
            idField:'kode',  
            textField:'nama',              
            mode:'remote',
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kode',title:'Kode Barang',width:100},  
               {field:'nama',title:'Nama Barang',width:500}    
            ]],  
            onSelect:function(rowIndex,rowData){                                                             
                cnm = rowData.nama;
                $('#nm_dana').attr('value',cnm);
            } 
        });
	
	$('#asal').combogrid({url:'<?php echo base_url(); ?>index.php/bhp/asal',  
            panelWidth:600, 
            width:160, 
            idField:'kode',  
            textField:'nama',              
            mode:'remote',
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kode',title:'Kode Barang',width:100},  
               {field:'nama',title:'Nama Barang',width:500}    
            ]],  
            onSelect:function(rowIndex,rowData){                                                             
                cnm = rowData.nm_brg;
                $('#nm_asal').attr('value',cnm);
            } 
        }); 
	$('#asal_dt').combogrid({url:'<?php echo base_url(); ?>index.php/bhp/asal',  
            panelWidth:600, 
            width:160, 
            idField:'kode',  
            textField:'nama',              
            mode:'remote',
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kode',title:'Kode Barang',width:100},  
               {field:'nama',title:'Nama Barang',width:500}    
            ]],  
            onSelect:function(rowIndex,rowData){                                                             
                cnm = rowData.nm_brg;
                $('#nm_asal').attr('value',cnm);
            } 
        }); 

	$('#giat').combogrid({url:'<?php echo base_url(); ?>index.php/bhp/ambil_giat',  
            panelWidth:650, 
            width:250, 
            idField:'kode',  
            textField:'nama',              
            mode:'remote',
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kode',title:'Kode Kegiatan',width:150},  
               {field:'nama',title:'Nama Kegiatan',width:500}    
            ]],  
            onSelect:function(rowIndex,rowData){                                                             
                cnm = rowData.nm_brg;
                $('#nm_giat').attr('value',cnm);
            } 
        });
	$('#giat_dt').combogrid({url:'<?php echo base_url(); ?>index.php/bhp/ambil_giat',  
            panelWidth:650, 
            width:160, 
            idField:'kode',  
            textField:'nama',              
            mode:'remote',
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kode',title:'Kode Kegiatan',width:150},  
               {field:'nama',title:'Nama Kegiatan',width:500}    
            ]],  
            onSelect:function(rowIndex,rowData){                                                             
                cnm = rowData.nm_brg;
                $('#nm_giat').attr('value',cnm);
            } 
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
	 $('#satuan_dt').combogrid({  
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
    });
	
    function section1(){        
        $('#tabs1').click(); 
        set_grid(); 
        $('#trh').datagrid('reload');                                                    
    }
    function section2(){            
        $('#tabs2').click();
        load_detail();
        set_grid();                                                        
    }
    function get(nomor,tgl,unit,kode,nmkode,tahun,total){
        $('#nomor').attr('value',nomor);
        $('#tanggal').datebox('setValue',tgl);
        $('#uskpd').combogrid('setValue',unit);
        $('#kdskpd').combogrid('setValue',kode);
        $('#nmuskpd').attr('value',nmkode);
        $('#tahun').combobox('setValue',tahun);
        $('#total').attr('value',total);
        $('#nomor').attr('disabled',true);
    }
	function get_edit(sdana,asal,kode_brg,no_dokumen,kodegiat,detail_brg,satuan,merk,jumlah,harga,total,keterangan){
	
		$('#dana_dt').combogrid('setValue',sdana);    
		$('#asal_dt').combogrid('setValue',asal);       	
		$('#kd_dt').combogrid('setValue',kode_brg);   
		$('#giat_dt').combogrid('setValue',kodegiat);  
		//$('#nm_dt').attr('value',rowData.detail_brg);    
		$('#satuan_dt').combogrid('setValue',satuan);    
		$('#merek_dt').attr('value',merk);    
		$('#jml_dt').attr('value',jumlah);    
		$('#hrg_dt').attr('value',harga);    
		$('#tot_dt').attr('value',total);     
		$('#tot_dt2').attr('value',total);   
		$('#ket_dt').attr('value',keterangan);  

	
/* 		$('#no_bast_edit').attr('value',no_dokumen);
        $('#giat_edit').attr('value',kodegiat);
        $('#nm_edit').attr('value',detail_brg);
        $('#satuan_edit').attr('value',satuan);
        $('#merek_edit').attr('value',merk);
        $('#jml_edit').attr('value',jumlah);
        $('#hrg_edit').attr('value',harga);
        $('#tot_edit').attr('value',total);
        $('#ket_edit').attr('value',keterangan); */
    }
    function kosong(){
        cdate = '<?php echo date("Y-m-d"); ?>';
        //cthn = '<?php echo date("Y"); ?>'; 
		var skpd  = '<?php echo ($this->session->userdata('skpd')); ?>'; 
		var uskpd  = '<?php echo ($this->session->userdata('unit_skpd')); ?>'; 
		var cthn  = '<?php echo ($this->session->userdata('ta_simbakda')); ?>';
        $('#nomor').attr('value','');
        $('#tanggal').datebox('setValue',cdate);
        $('#kdskpd').combogrid('setValue',skpd);
        $('#uskpd').combogrid('setValue',uskpd);
        $('#nm_perusahaan').attr('value','');
        $('#tahun').combobox('setValue',cthn);
        $('#total').attr('value','');
        $('#total2').attr('value','');
        $('#nomor').attr('disabled',false);
    }
    function kosong2(){
        updt = 'f';
        //$('#jenis').combogrid('setValue','');
		/* $('#asal').combogrid('setValue','');
		$('#dana').combogrid('setValue','');
		$('#giat').combogrid('setValue',''); */
        $('#kd').combogrid('setValue','');
        $('#nm').attr('value','');
        $('#nm_giat').attr('value','');
        $('#nm_asal').attr('value','');
        $('#nm_dana').attr('value','');
        $('#nmrek').attr('value','');
        $('#satuan').combogrid('setValue','');
        $('#merek').attr('value','');
        $('#jml').attr('value','');
        $('#hrg').attr('value','');
        $('#tot').attr('value','');
        $('#ket').attr('value','');
    }
	
    function load_detail(){
	//ini dari tabel trh_planbrg
        var i = 0;
        var nomor = document.getElementById('nomor').value;
        var tgl   = $('#tanggal').datebox('getValue');
        var kode  = $('#kdskpd').combogrid('getValue');  
		// ------------
		// ini ngambil dari tabel trd_planbrg sesuai nomor trh_planbrg
         $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>index.php/bhp/trd_masukbhp',
                data: ({no:nomor,skpd:kode}),
              /*   dataType:"json", */ 
				//rownumbers:true,
				singleSelect:true,
				idField:'no_dokumen',
				dataType:"json", 
				singleSelect:true,
				nowrap:"true",
				toolbar:'#toolbar',
				pagination:"true",
                success:function(data){                                          
                    $.each(data,function(i,n){ 
                        uni     = n['unit'];
                        skp     = n['skpd'];
                        tgld    = n['tgl_dokumen'];
                        prs     = n['nm_perush'];
                        no      = n['no_dokumen'];                                                                    
                        kd      = n['kode_brg'];
                        nm      = n['detail_brg']; 
                        mrk     = n['merk'];                       
                        jml     = n['jumlah']; 
                        hrg     = n['harga'];
                        tot     = n['total'];  
                        jmltot  = n['jml_tot'];                  
                        ket     = n['keterangan']; 
						kdgiat  = n['kodegiat'];
						satu    = n['satuan'];
						sdn     = n['sdana'];
						asl     = n['asal'];  
						trm     = n['no_terima'];
						tgltrm  = n['tgl_terima'];  
						$('#nomor').attr('value',no);
						$('#tanggal').datebox('setValue',tgld);
						$('#kdskpd').combogrid('setValue',skp);
						$('#uskpd').combogrid('setValue',uni);
						$('#nm_perusahaan').attr('value',prs);
						$('#nomor_terima').attr('value',trm);
						$('#tanggal_terima').datebox('setValue',tgltrm);
						$('#giat').combogrid('setValue',kdgiat);
						$('#total').attr('value',number_format(jmltot));		
						$('#dana').combogrid('setValue',sdn);
						$('#asal').combogrid('setValue',asl);
                    $('#trd').edatagrid('appendRow',{no_dokumen:no,kode_brg:kd,detail_brg:nm,merk:mrk,jumlah:jml,harga:hrg,total:tot,keterangan:ket,kodegiat:kdgiat,satuan:satu,sdana:sdn,asal:asl});                                
                    
                    });
                }
         });         
          set_grid();
    }
    
    function load_detail2(){  
       $('#trd').datagrid('selectAll');  
       var rows = $('#trd').datagrid('getSelections'); 
       if (rows.length==0){
            set_grid2();
            exit();
       }                     
		for(var p=0;p<rows.length;p++){
            no     = rows[p].no_dokumen;                    
            kd     = rows[p].kode_brg;
            nm     = rows[p].detail_brg;
            mrk    = rows[p].merk;
            jml    = rows[p].jumlah;
            hrg    = rows[p].harga;
            tot    = rows[p].total;
            ket    = rows[p].keterangan;
            kdgiat = rows[p].kodegiat;
            satu   = rows[p].satuan;
            sdn    = rows[p].sdana;
            asl    = rows[p].asal;                                                                                                               
            $('#trd2').edatagrid('appendRow',{no_dokumen:no,kode_brg:kd,detail_brg:nm,merk:mrk,jumlah:jml,harga:hrg,total:tot,keterangan:ket,kodegiat:kdgiat,satuan:satu,sdana:sdn,asal:asl});            
        }
        tot = document.getElementById('total').value;
        $('#total2').attr('value',tot);
        $('#trd').edatagrid('unselectAll');    
    } 
	
	
    function set_grid(){
         $('#trd').edatagrid({
              columns:[[                    
			        {field:'no',title:'ck',width:30,checkbox:true},         
                    //{field:'hapus',title:'',width:35,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus_detail();'' />";}},
                    //{field:'edit',title:'',width:35,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/edit.png' onclick='javascript:edit_detail();'' />";}},
					{field:'no_dokumen',title:'Nomor Dokumen',width:100,hidden:true},
                    {field:'kode_brg',title:'Kode Barang',width:100,align:"center"},
                    {field:'detail_brg',title:'Nama Barang',width:200,align:"left"},
                    {field:'merk',title:'Merek',width:150,align:"left"},
                    {field:'jumlah',title:'Jumlah',width:70,align:"center"},
                    {field:'harga',title:'Harga',width:150,align:"right"},
                    {field:'total',title:'Total',width:150,align:"right"},                                
                    {field:'keterangan',title:'Keterangan',width:200,align:"left"},
            	    {field:'kodegiat',title:'Nomor Dokumen',width:100,hidden:true},
            	    {field:'satuan',title:'Nomor Dokumen',width:100,hidden:true},
            	    {field:'sdana',title:'Nomor Dokumen',width:100,hidden:true},
            	    {field:'asal',title:'Nomor Dokumen',width:100,hidden:true}
                ]],
            onSelect:function(rowIndex,rowData){ 
                sdana   	 = rowData.sdana;
                asal   	 	 = rowData.asal;
                kode_brg   	 = rowData.kode_brg;
                no_dokumen   = rowData.no_dokumen;
                kodegiat   	 = rowData.kodegiat;
                detail_brg   = rowData.detail_brg;
                satuan   	 = rowData.satuan;
                merk   		 = rowData.merk;
                jumlah   	 = rowData.jumlah;
                harga   	 = rowData.harga;
                total   	 = rowData.total;
                keterangan   = rowData.keterangan;
                get_edit(sdana,asal,kode_brg,no_dokumen,kodegiat,detail_brg,satuan,merk,jumlah,harga,total,keterangan);
                
            }
        });       
    }
    function set_grid2(){
         $('#trd2').edatagrid({                                                                   
              columns:[[
					{field:'no_dokumen',title:'Nomor Dokumen',width:100,hidden:true},
                    {field:'kode_brg',title:'Kode Barang',width:100,align:"center"},
                    {field:'detail_brg',title:'Nama Barang',width:200,align:"left"},
                    {field:'merk',title:'Merek',width:150,align:"left"},
                    {field:'jumlah',title:'Jumlah',width:70,align:"center"},
                    {field:'harga',title:'Harga',width:150,align:"right"},
                    {field:'total',title:'Total',width:150,align:"right"},                                
                    {field:'keterangan',title:'Keterangan',width:200,align:"left"},
            	    {field:'kodegiat',title:'Nomor Dokumen',width:100,hidden:true},
            	    {field:'satuan',title:'Nomor Dokumen',width:100,hidden:true},
            	    {field:'sdana',title:'Nomor Dokumen',width:100,hidden:true},
            	    {field:'asal',title:'Nomor Dokumen',width:100,hidden:true}
                ]]
        });          
    }
    function tambah_detail(){
        var no 		= document.getElementById('nomor').value;
        var tgl 	= $('#tanggal').datebox('getValue');
        var kd  	= $('#uskpd').combogrid('getValue');
        var giat	= $('#giat').combogrid('getValue');
        $('#trd2').datagrid('reload');
        if (no!='' && tgl!='' && kd!='' && giat!=''){
            $("#dialog-modal").dialog('open'); 
            set_grid2();        
            kosong2();    
            load_detail2();    
        } else {
            alert('Nomor/Tanggal/Unit Kerja/Kegiatan masih kosong, harap isi terlebih dahulu');
        }        
    }
	
    function edit_detail(){
            $("#dialog-detail").dialog('open');    
    }
	
    function hitung(){
        var fa = angka(document.getElementById('jml').value);        
        var iz = angka(document.getElementById('hrg').value);
        var ve = angka(document.getElementById('jml_dt').value);        
        var ro = angka(document.getElementById('hrg_dt').value);
        var tot  = fa*iz;               
        var tot2 = ve*ro;        
            $('#tot').attr('value',number_format(tot,2,'.',','));
            $('#tot_dt').attr('value',number_format(tot2,2,'.',','));
    }
	
    function simpan_rinci(){
	//varibel------------------------------------------
		var cek    = $('#trd').datagrid('selectAll');
		var a1= [];
		var a2= [];
		var a3= [];
		var a4= [];
		var a5= [];
		var a6= [];
		var a7= [];
		var a8= [];
		var a9= [];
		var a10= [];
		var a11= [];
		var a12= [];
		var rows = $('#trd').datagrid('getSelections'); 
		for( i=0; i < rows.length; i++){ 
			a1.push(rows[i].no_dokumen);
			a2.push(rows[i].kode_brg);
			a3.push(rows[i].detail_brg);
			a4.push(rows[i].merk);
			a5.push(rows[i].jumlah);
			a6.push(rows[i].harga);
			a7.push(rows[i].total);
			a8.push(rows[i].keterangan);
			a9.push(rows[i].kodegiat);
			a10.push(rows[i].satuan);
			a11.push(rows[i].sdana);
			a12.push(rows[i].asal);
		}
		
		no   	=(a1.join('||'));
		kd   	=(a2.join('||'));
		nm   	=(a3.join('||'));
		mrk   	=(a4.join('||'));
		jml   	=(a5.join('||'));
		hrg   	=(a6.join('||'));
		tot  	=(a7.join('||'));
		ket   	=(a8.join('||'));
		giat  	=(a9.join('||'));
		satuan  =(a10.join('||'));
		dn   	=(a11.join('||'));
		asl 	=(a12.join('||'));
        var no_dok     	= document.getElementById('nomor').value; 
        var unit  		= $('#uskpd').combogrid('getValue');
        var skpd  		= $('#kdskpd').combogrid('getValue');
		var tgl			= $('#tanggal').datebox('getValue'); 
		var jml_sisa 	= "";
        var spek  		= "";
		var waktu 		= '<?php echo date('y-m-d H:i:s'); ?>'; 
       /***************************** SIMPAN KE TRD BHP ********************************************************************/ 
		$.ajax({
            type: 'POST',
            data: ({unit:unit,skpd:skpd,tgl:tgl,jml_sisa:jml_sisa,jml:jml,waktu:waktu,no:no,no_dok:no_dok,kd:kd,nm:nm,mrk:mrk,satuan:satuan,hrg:hrg,tot:tot,ket:ket,giat:giat,dn:dn,asl:asl}),
            url:"<?php echo base_url(); ?>index.php/bhp/detail_masuk_bhp",
			success:function(data){ 
             //var lctot = data; 
             //$('#total').attr('value',lctot);
             //$('#total2').attr('value',lctot);
			}
          });
        
        /******************************************************************************************************************/        
	} 
	
    function append_save(){
        var no     	= document.getElementById('nomor').value; 
        var dn     	= $('#dana').combogrid('getValue');
        var asl     = $('#asal').combogrid('getValue');
        var giat    = $('#giat').combogrid('getValue');
		var tgl		= $('#tanggal').datebox('getValue'); 
        var kd     	= $('#kd').combogrid('getValue');
        var unit  	= $('#uskpd').combogrid('getValue');
        var skpd  	= $('#kdskpd').combogrid('getValue');
        var nm     	= document.getElementById('nm').value;
		var satuan  = $('#satuan').combogrid('getValue');
        var mrk    	= document.getElementById('merek').value;
        var jml    	= document.getElementById('jml').value;
        var sisa   	= document.getElementById('min_sisa').value; 
		var jml_sisa= eval(jml);//+eval(sisa)
        var hrg    	= angka(document.getElementById('hrg').value);
        var tot   	= angka(document.getElementById('tot').value);
        var total  = angka(document.getElementById('total2').value);
        var ket    = document.getElementById('ket').value;
        var spek   = document.getElementById('spek').value;
		var waktu		= '<?php echo date('y-m-d H:i:s'); ?>'; 
        if (kd != '' && jml != '' && hrg != ''){        
            if (updt == 'f') {
			$('#trd').edatagrid('appendRow',{no_dokumen:no,kode_brg:kd,detail_brg:nm,merk:mrk,jumlah:jml,harga:hrg,total:tot,keterangan:ket,kodegiat:giat,satuan:satuan,sdana:dn,asal:asl});
			$('#trd2').edatagrid('appendRow',{no_dokumen:no,kode_brg:kd,detail_brg:nm,merk:mrk,jumlah:jml,harga:hrg,total:tot,keterangan:ket,kodegiat:giat,satuan:satuan,sdana:dn,asal:asl});
			a = total + tot;
            } else {
                $('#trd').edatagrid('updateRow',{no_dokumen:no,kode_brg:kd,detail_brg:nm,merk:mrk,jumlah:jml,harga:hrg,total:tot,keterangan:ket,kodegiat:giat,satuan:satuan,sdana:dn,asal:asl});
                $('#trd2').edatagrid('updateRow',{no_dokumen:no,kode_brg:kd,detail_brg:nm,merk:mrk,jumlah:jml,harga:hrg,total:tot,keterangan:ket,kodegiat:giat,satuan:satuan,sdana:dn,asal:asl});                        
                s = total - angka(total2);
                a = s + tot;
            }
            updt = 'f';		   
            totalx = number_format(a,2,'.',',');
            $('#total').attr('value',totalx);
            $('#total2').attr('value',totalx);                                    
            kosong2();        
        }else {
                alert('Jenis, Bidang, Kelompok, Sub Kelompok, Kode, Jumlah dan Harga tidak boleh kosong');
                exit();
        }
    }
	
	function simpan_detail(){
        var no     	= document.getElementById('nomor').value; 
        var dn     	= $('#dana_dt').combogrid('getValue');
        var asl     = $('#asal_dt').combogrid('getValue');
        var giat    = $('#giat_dt').combogrid('getValue');
        var kd     	= $('#kd_dt').combogrid('getValue');
        var unit  	= $('#uskpd').combogrid('getValue');
        var skpd  	= $('#kdskpd').combogrid('getValue');
        var nm     	= document.getElementById('nm_dt').value;
		var satuan  = $('#satuan_dt').combogrid('getValue');
        var mrk    	= document.getElementById('merek_dt').value;
        var jml    	= document.getElementById('jml_dt').value;
        var hrg    	= angka(document.getElementById('hrg_dt').value);
        var tot   	= angka(document.getElementById('tot_dt').value);
        var tot2   	= angka(document.getElementById('tot_dt2').value);
        //var total  = angka(document.getElementById('total2').value);
        var ket    = document.getElementById('ket_dt').value;
		var faiz   = $('#trd').datagrid('getSelected');
		cnox  = faiz.no_dokumen;	
        ckdx  = faiz.kode_brg;
        cjmlx = faiz.jumlah;
        ctotx = faiz.total; 
		
		lcquery = "UPDATE trd_masuk_bhp SET sdana='"+dn+"',asal='"+asl+"',kodegiat='"+giat+"',detail_brg='"+nm+"',satuan='"+satuan+"',merk='"+mrk+"',jumlah='"+jml+"',harga='"+hrg+"',total='"+tot+"',keterangan='"+ket+"' where skpd='"+skpd+"' and no_dokumen='"+no+"' and kode_brg='"+kd+"'";
        thistory = "UPDATE thistory_bhp SET sdana='"+dn+"',asal='"+asl+"',kodegiat='"+giat+"',detail_brg='"+nm+"',merk='"+mrk+"',jml_masuk='"+jml+"',sisa='"+jml+"',harga='"+hrg+"',total='"+tot+"',keterangan='"+ket+"' WHERE skpd='"+skpd+"' AND no_dokumen='"+no+"' AND kode_brg='"+kd+"'";
   
		   $(document).ready(function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>index.php/bhp/update_masuk_bhp',
                data: ({st_query:lcquery,thistory:thistory,cno:no,cunit:unit}),
                dataType:"json"
            });
            });
        var idx = $('#trd').datagrid('getRowIndex',faiz);
		$('#trd').datagrid('deleteRow',idx); 
		$('#trd').edatagrid('appendRow',{no_dokumen:no,kode_brg:kd,detail_brg:nm,merk:mrk,jumlah:jml,harga:hrg,total:tot,keterangan:ket,kodegiat:giat,satuan:satuan,sdana:dn,asal:asl});
		
		if(tot > tot2){
		var total = (angka(document.getElementById('total').value)-tot2) + tot;
		$('#total').attr('value',number_format(total,2,'.',','));    
		}else if(tot < tot2){
		total = (angka(document.getElementById('total').value)-tot2) - tot;
        $('#total').attr('value',number_format(total,2,'.',','));    
		}else{
		}
	}
    
    function keluar(){
		 swal({
					title: "Jangan lupa disimpan.!!",
					type:"warning"
					});
        $("#dialog-modal").dialog('close');
        $('#trd2').datagrid('reload');                            
    }   
	
	function keluar_detail(){
        $("#dialog-detail").dialog('close');                         
    }
    
    function get2(kode_brg,detail_brg,merk,jumlah,harga,total,keterangan,kodegiat,satuan,sdana,asal){
		$('#dana').combogrid('setValue',asal);
		$('#asal').combogrid('setValue',sdana);
		$('#giat').combogrid('setValue',kodegiat);
        $('#kd').combogrid('setValue',kd);
        $('#nm').attr('value',nm);
		$('#satuan').combogrid('setValue',satuan);                                      
        $('#merek').attr('value',merk);
        $('#jml').attr('value',jumlah);
        $('#hrg').attr('value',harga);
        $('#tot').attr('value',total);
        $('#ket').attr('value',ket);
        total2 = total;
        
    }
	
     function simpan(){
        var cno     		= document.getElementById('nomor').value; 
        var ctgl    		= $('#tanggal').datebox('getValue');
        var cno_terima     	= document.getElementById('nomor_terima').value; 
        var ctgl_terima    	= $('#tanggal_terima').datebox('getValue');
        var cuskpd  		= $('#uskpd').combogrid('getValue');
        var ckdskpd  		= $('#kdskpd').combogrid('getValue'); 
        var cnmuskpd 		= document.getElementById('nmuskpd').value;
        var cthn    		= '<?php echo ($this->session->userdata('ta_simbakda')); ?>';
        var cnmcomp 		= document.getElementById('nm_perusahaan').value;
        var ctotal  		= angka(document.getElementById('total').value);  
        var giat    		= $('#giat').combogrid('getValue'); 
        var tbl  			= "trh_masuk_bhp";     
        if (cno==''){
            alert('Nomor Dokumen Tidak Boleh Kosong');
            exit();
        } 
        if (ctgl==''){
            alert('Tanggal Dokumen Tidak Boleh Kosong');
            exit();
        }
        if (cuskpd==''){
            alert('Kode Unit Tidak Boleh Kosong');
            exit();
        }       
        if (cnmcomp==''){
            alert('Nama Toko/Perusahaan Tidak Boleh Kosong');
            exit();
        }             
        $(document).ready(function(){
            $.ajax({
                type: "POST",       
                dataType : 'json',         
                data: ({tabel:tbl,no:cno,tgl:ctgl,giat:giat,unit:cuskpd,skpd:ckdskpd,no_terima:cno_terima,tgl_terima:ctgl_terima,kdskpd:ckdskpd,nmuskpd:cnmuskpd,tahun:cthn,total:ctotal,comp:cnmcomp}),
                url: '<?php echo base_url(); ?>index.php/bhp/simpan_masuk_bhp',
                success:function(data){
                   status = data.pesan;    
                   if (status == '0'){
                       alert('Gagal Simpan...!!');
                       exit();
                   } else {                                
                       swal("Data Tersimpan!", "Silahkan klik Ok!", "success"); 
                    }                                                                                                     
                }
            });
	simpan_rinci();
       });                                 
    }
    
     function hapus(){
		var tny = confirm('PERINGATAN.!!, Yakinkan Dokumen Ini Belum Dikeluarkan, Karena akan mempengaruhi Stock Barang.!');
		if (tny==true){
        var cnomor = document.getElementById('nomor').value;
		//var unit   = $("#uskpd").combogrid('getValue');
        var tny = confirm('Yakin Ingin Menghapus Data, Nomor Dokumen : '+cnomor); 
        if (tny==true){
        var urll = '<?php echo base_url(); ?>index.php/bhp/hapus_masukbhp';
        $(document).ready(function(){
        $.ajax({url:urll,
                 dataType:'json',
                 type: "POST",    
                 data:({no:cnomor,unit:unit}),
                 success:function(data){
                        status = data.pesan;
                        if (status=='1'){
                            $('#trh').datagrid('reload');       
                        } else {
                            alert('Gagal Hapus');
                        }        
                 }
                 
                });           
        });
        }    
		} 
    }
  
 
   function hapus_detail(){
	var tny = confirm('PERINGATAN.!!, Yakinkan Barang Ini Belum Dikeluarkan, Karena akan mempengaruhi Stock Barang.!');
	if (tny==true){
		var skpd   = $("#kdskpd").combogrid('getValue');
        var cnomor = document.getElementById('nomor').value; 
        var tbl1   = "trh_masuk_bhp"; 
        var tbl2   = "trd_masuk_bhp"; 
        var rows   = $('#trd').datagrid('getSelected');
        cno  =   rows.no_dokumen;
        ckd  =   rows.kode_brg;
        cjml =   rows.jumlah;
        ctot =   rows.total; 
        var idx = $('#trd').datagrid('getRowIndex',rows);        
        var tny = confirm('Yakin Ingin Menghapus Data, Nomor Dokumen : '+cno+' Kode Barang : '+ckd+' Nilai : '+ctot);
		if (tny==true){
            $('#trd').datagrid('deleteRow',idx);            
            total = angka(document.getElementById('total').value) - angka(ctot);
             $.ajax({
                type: 'POST',
                data: ({tabel1:tbl1,tabel2:tbl2,nomor:cnomor,kd:ckd,total:total,skpd:skpd,kode:'kode_brg'}),
                url:"<?php echo base_url(); ?>index.php/bhp/trd_bhp_hapus"
            }); 
            //$('#total2').attr('value',number_format(total,2,'.',','));
            $('#total').attr('value',number_format(total,2,'.',','));
                       
			}      
		}               
    }
	
	function min_sisa(){  
	var organisasi 	= $('#kdskpd').combogrid('getValue');
	var kd_brg 		= $('#kd').combogrid('getValue');
	var harga	 	= angka(document.getElementById('hrg').value); 
		$.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>index.php/bhp/min_sisa',
            data: ({skpd:organisasi,brg:kd_brg,table:'thistory_bhp',kolom1:'jml_masuk',kolom2:'jml_keluar'}),
            dataType:"json",
            success:function(data){                                          
                $.each(data,function(i,n){                                    
                    min      = n['min'];	
					$("#min_sisa").attr("value",min);
                });
            }
        }); 
	 }
	
	function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    
    $(function(){
     $('#trh').edatagrid({
		url: '<?php echo base_url(); ?>index.php/bhp/trh_masukbhp',
        queryParams:({cari:kriteria})
        });        
     });
    }
	
   </script>


<div id="tabs" >
		<p><h3 align="center">LIST BARANG MASUK</h3></p>
    <ul style="background-color:#2da305;">
        <li><a href="#tabs-1" style="width: 452px;" id="tabs1">List View</a></li>
        <li><a href="#tabs-2" style="width: 452px;" id="tabs2">Form Input</a></li> 		
    </ul>
    <div id="tabs-1">
        <div>
            <p align="right">
                <a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:kosong();section2();">Tambah</a>
                <a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:section2();">Detail Barang</a>                          
                <a class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="javascript:cari();" >Cari</a>
                <input type="text" value="" id="txtcari" placeholder="*no_dok/kegiatan"/>              
                <table  id="trh" title="List Dokumen" style="width:940px;height:400px;" >  
                </table>                
            </p>
        </div>
    </div>
    <div id="tabs-2">  
        <br /><br />
        <table>
            <tr>
                <td height="30px">No. Faktur</td>
                <td>:</td>
                <td><input type="text" id="nomor" style="width: 200px;" onclick="javascript:select();" placeholder="*no kwitansi/no nota,dll" /></td>
                <td width="70px"></td>
                <td>Tanggal Faktur</td>
                <td>:</td>
                <td><input type="text" id="tanggal" style="width: 140px;" /></td>     
            </tr>
            <tr>
                <td height="30px">SKPD</td>
                <td>:</td>
                <td><input id="kdskpd" name="kdskpd" style="width: 140px;" /></td>
                <td></td>
                <td>Nama SKPD</td> 
                <td>:</td>
                <td><input type="text" id="nmskpd" style="border:0;width: 400px;" readonly="true"/></td>                                
            </tr>   
            <tr>
                <td height="30px">Unit Kerja</td>
                <td>:</td>
                <td><input id="uskpd" name="uskpd" style="width: 140px;" /></td>
                <td></td>
                <td>Nama Unit Kerja</td> 
                <td>:</td>
                <td><input type="text" id="nmuskpd" style="border:0;width: 400px;" readonly="true"/></td>                                
            </tr>    
            <tr>
                <td height="30px">No. B.A Penerimaan</td>
                <td>:</td>
                <td><input type="text" id="nomor_terima" style="width: 200px;" onclick="javascript:select();" placeholder="*isi nomor penerimaan jika ada" /></td>
                <td width="70px"></td>
                <td>Tanggal B.A Penerimaan</td>
                <td>:</td>
                <td><input type="text" id="tanggal_terima" style="width: 140px;" /></td>     
            </tr>   
            <tr>   
				<td>Kegiatan</td>
                <td>:</td>
                <td><input id="giat" name="giat" value=""/>  </td> 
                <td></td>				
                <td>Nama Perusahaan</td>
                <td>:</td>
                <td><textarea style="width: 250px;" id="nm_perusahaan" name="nm_perusahaan" placeholder="*isi nama toko/outlet/rekanan barang didapat"> </textarea></td>            
                  
			</tr>                         
        </table>  
		<br/>   
        <fieldset>
        <div align="center">
    		<a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:tambah_detail();"><b>Tambah Barang</b></a> <br/>  
        	<!--a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:kosong();">Tambah</a>
            <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:section1();">Kembali</a-->          
        </div>
        </fieldset>  
        <br /> 
		<table>
		<tr>
			<td>
			<table id="trd" title="Detail Barang" style="width:900px;height:300px;" ></table>
			</td>
			<td>
			<a class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="javascript:hapus_detail();">
			<a class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="javascript:edit_detail();">			
			</td>
		</tr>
		</table>  
        <div align="right">Jumlah : <input type="text" id="total" style="text-align: right;border:0;width: 200px;font-size: large;" readonly="true"/></div> 
        <br />
		<div align="center">
        <fieldset>
		<INPUT TYPE="button" VALUE="SIMPAN" style="height:40px;width:100px" onclick="javascript:simpan();" >
		<INPUT TYPE="button" VALUE="KEMBALI" style="height:40px;width:100px" onclick="javascript:section1();" >
        </fieldset>            
		</div>  
</div>

<div id="dialog-modal" title="Input Barang Habis Pakai" >
    <p class="validateTips" >Semua Inputan Harus Di Isi.</p> 
    <fieldset>      
        <table>      
            <tr>
                <td>Sumber Dana</td>
                <td>:</td>
                <td width="150"><input id="dana" name="dana" value=""/> </td>
                <td rowspan="9"></td>   
                <td rowspan="9" width="660"  >
                    <table  id="trd2" title="Detail Barang" style="width:665px;height:270px;" >  
                    </table>           
                    <div align="right">Jumlah : <input type="text" id="total2" style="text-align: right;border:0;width: 200px;font-size: large;" readonly="true"/></div>     
                </td>         
            </tr>  
			<tr>
                <td>Perolehan</td>
                <td>:</td>
                <td><input id="asal" name="asal" value=""/>  </td>                            
            </tr> 
			<!--tr>
                <td>Sub Kelompok barang</td>
                <td>:</td>
                <td><input id="kelo1" name="kelo1" value=""/>  </td>                            
            </tr--> 
            <tr>
                <td>Kode barang</td>
                <td>:</td>
                <td><input id="kd" name="kd" value=""/>  </td>                            
            </tr>  
            <tr hidden="true">
                <td>Sisa Barang</td>
                <td>:</td>
                <td><input id="min_sisa" name="min_sisa" value=""/>  </td>                            
            </tr>      
            <tr>
                <td>Nama barang</td>
                <td>:</td>
                <td><input id="nm" name="nm" value="" readonly="true" style="border:0;"/>  
				<input hidden="true" id="spek" name="spek" value="" readonly="true" style="border:0;"/></td>            
            </tr>  
            <tr>
                <td>Satuan</td>
                <td>:</td>
                <td><input id="satuan" name="satuan" value=""/>  </td>            
            </tr>      
            <tr>
                <td>Merek</td>
                <td>:</td>
                <td><input id="merek" name="merek" value=""/>  </td>            
            </tr>     
            <tr>
                <td>Jumlah</td>
                <td>:</td>
                <td><input id="jml" name="jml" value="" style="text-align: right;" onkeypress="return(isNumberKey(event));" onkeyup="hitung();"/></td>            
            </tr>  
            <tr>
                <td>Harga</td>
                <td>:</td>
                <td><input id="hrg" name="hrg" value="" style="text-align: right;" onkeypress="return(currencyFormat(this,',','.',event));" onkeyup="hitung();"/>  </td>            
            </tr> 
            <tr>
                <td>Total Harga</td>
                <td>:</td>
                <td><input id="tot" name="tot" value="" style="text-align: right;border:0;" readonly="true" />  </td>            
            </tr>  
            <tr>
                <td>Keterangan</td>
                <td>:</td>
                <td><textarea id="ket" style="width: 155px; height: 60px;"></textarea> </td>            
            </tr> 
        </table>     
		
    </fieldset>  
    <fieldset>
        <table align="center">
            <tr>
                <td>
					<!--a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:kosong2();">Tambah</a-->
                    <a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:append_save();">Tampung</a>
                    <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Keluar</a>                               
                </td>
            </tr>
        </table>   
    </fieldset>
</div>

<div id="dialog-detail" title="Edit Detail Barang" >
    <fieldset>      
        <table>   
			<tr>
                <td>Perolehan</td>
                <td>:</td>
                <td><input id="dana_dt" name="dana_dt" value=""/>  </td>                            
            </tr> 
			<tr>
                <td>Perolehan</td>
                <td>:</td>
                <td><input id="asal_dt" name="asal_dt" value=""/>  </td>                            
            </tr> 
			<tr>
                <td>Kegiatan</td>
                <td>:</td>
                <td><input id="giat_dt" name="giat_dt" value=""/>  </td>                            
            </tr> 
            <tr>
                <td>Kode barang</td>
                <td>:</td>
                <td><input disabled="true" id="kd_dt" name="kd_dt" value=""/>  </td>                            
            </tr>       
            <tr>
                <td>Nama barang</td>
                <td>:</td>
                <td><input id="nm_dt" name="nm_dt" value="" readonly="true" style="border:0;"/>  </td>            
            </tr>  
            <tr>
                <td>Satuan</td>
                <td>:</td>
                <td><input id="satuan_dt" name="satuan_dt" value=""/>  </td>            
            </tr>      
            <tr>
                <td>Merek</td>
                <td>:</td>
                <td><input id="merek_dt" name="merek_dt" value=""/>  </td>            
            </tr>     
            <tr>
                <td>Jumlah</td>
                <td>:</td>
                <td><input id="jml_dt" name="jml_dt" value="" style="text-align: right;" onkeypress="return(isNumberKey(event));" onkeyup="hitung();"/></td>            
            </tr>  
            <tr>
                <td>Harga</td>
                <td>:</td>
                <td><input id="hrg_dt" name="hrg_dt" value="" style="text-align: right;" onkeypress="return(currencyFormat(this,',','.',event));" onkeyup="hitung();"/>  </td>            
            </tr> 
            <tr>
                <td>Total Harga</td>
                <td>:</td>
                <td><input id="tot_dt" name="tot_dt" value="" style="text-align: right;border:0;" readonly="true" />  </td>            
            </tr> 
            <tr hidden="true">
                <td>Total Harga 2</td>
                <td>:</td>
                <td><input id="tot_dt2" name="tot_dt2" value="" style="text-align: right;border:0;" readonly="true" />  </td>            
            </tr> 
            <tr>
                <td>Keterangan</td>
                <td>:</td>
                <td><textarea id="ket_dt" style="width: 155px; height: 60px;"></textarea> </td>            
            </tr> 
        </table>     
		
    </fieldset>  
    <fieldset>
        <table align="center">
            <tr>
                <td><a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:simpan_detail();">Ubah</a>
                    <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar_detail();">Keluar</a>                               
                </td>
            </tr>
        </table>   
    </fieldset>
</div>

