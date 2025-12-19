<script type="text/javascript" src="<?php echo base_url(); ?>easyui/autoCurrency.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>easyui/currencyFields.js"></script>
<script src="<?php echo base_url(); ?>lib/sweet-alert.min.js"></script>
<link   rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>lib/sweet-alert.css">
<script type="text/javascript">
    
    var updt = '';
    var idx2 = '';
    //var total2 = 0;
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
            height: 400,
            width: 500,
            modal: true, 
            background:'#2da305',           
            autoOpen:false                
          });                     
     });    
     
    $(function(){         
         $('#trh').edatagrid({
    		url: "<?php echo base_url(); ?>index.php/transaksi/trh_planbrg",
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
                {field:'tahun',title:'Tahun',width:20,align:"center"},
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
                $('#koder').attr('value',kode);
                get(nomor,tgl,unit,kode,nmkode,tahun,total);
				//hapus();
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
                var b = rowData.kd_brg;
                var jns = b.slice(0,2); 
				var bdg = b.slice(0,4); 
				var klpk = b.slice(0,6);
				var klpk1 = b.slice(0,8); 
				updt == 't'; 
                get2(jns,bdg,klpk,klpk1,rowData.kd_brg,rowData.nm_brg,rowData.satuan,rowData.merek,rowData.jumlah,rowData.harga,rowData.total,rowData.ket); 
            }          
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
     
         $('#uskpd').combogrid({  
            panelWidth:700,  
            idField:'kd_skpd',  
            textField:'kd_skpd',  
            mode:'remote',                      
            url:'<?php echo base_url(); ?>index.php/master/ambil_msskpd2',  
            columns:[[  
               {field:'kd_skpd',title:'Kode Unit',width:100},  
               {field:'nm_skpd',title:'Nama Unit',width:700}    
            ]],  
            onSelect:function(rowIndex,rowData){
               cuskpd 	  = rowData.kd_skpd; 
               ckd_lokasi = rowData.kd_lokasi;  
               cnm_lokasi = rowData.nm_lokasi;               
               $('#nmuskpd').attr('value',rowData.nm_skpd);          
               $('#mlokasi').attr('value',ckd_lokasi);           
               $('#nmlokasi').attr('value',cnm_lokasi);                                
            } 
         });  
         
        $('#tahun').combobox({           
            valueField:'tahun',  
            textField:'tahun',
            panelWidth:60,  
            url:'<?php echo base_url(); ?>index.php/master/tahun'   
        });
        
        $('#jenis').combogrid({  
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
				$('#kd').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_brg',queryParams:({subkel:cgol,sts:'mrek5'})});             
                //$('#bida').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_bidang',queryParams:({gol:cgol}) });
            } 
        }); 
		
		$('#bida').combogrid({  
              panelWidth:600, 
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
				cbidang=rowData.bidang;
				$('#kelo').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_kelompok',queryParams:({bidang:cbidang}) });            
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
				$('#kd').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_brg',queryParams:({subkel:csubkel,sts:'mrek5'})});             
        }  
    }); 
		 
       $('#kd').combogrid({  
            panelWidth:600,  
            panelHeight:400, 
            width:160, 
            idField:'kd_brg',  
            textField:'kd_brg',              
            mode:'remote',
            url:'<?php echo base_url(); ?>index.php/master/ambil_brg',
            queryParams:({subkel:'csubkel',sts:'mrek5'}),
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kd_brg',title:'Kode Barang',width:100},  
               {field:'nm_brg',title:'Nama Barang',width:500}    
            ]],  
            onSelect:function(rowIndex,rowData){                                                             
                cnm = rowData.nm_brg;
                crek= rowData.nm_rek5;
                ckdrek= rowData.kd_rek5; 
                $('#nm').attr('value',cnm);
                $('#nmrek').attr('value',crek);
                $('#kdrek5').attr('value',ckdrek);
                $('#merek').focus();
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
        $('#uskpd').combogrid('setValue',kode);
        $('#nmuskpd').attr('value',nmkode);
        $('#mlokasi').attr('value',unit);
        $('#nmlokasi').attr('value',nmkode);
        $('#tahun').combobox('setValue',tahun);
        $('#total').attr('value',number_format(total,2,'.',','));
        $('#nomor').attr('disabled',true);
	}
    function kosong(){
        updt == 'f';
		var skpd  		= '<?php echo ($this->session->userdata('skpd')); ?>';
		//var unit_skpd  	= '<?php echo ($this->session->userdata('unit_skpd')); ?>';
		//var nmlokasi 	= '<?php echo ($this->session->userdata('nama_simbakda')); ?>'; 
        cdate 			= '<?php echo date("Y-m-d"); ?>';
        cthn 			= '<?php echo date("Y"); ?>';    
        $('#nomor').attr('value','');
        $('#tanggal').datebox('setValue',cdate);
        $('#uskpd').combogrid('setValue',skpd);
		//$('#mlokasi').attr('value',unit_skpd);
		//$('#nmlokasi').attr('value',nmlokasi);
        $('#tahun').combobox('setValue','');
        $('#nomor').attr('disabled',false);
		$('#total').attr('value','');
		$('#total2').attr('value','');
        $('#nm').attr('value','');
        $('#nmrek').attr('value','');
        $('#merek').attr('value','');
        $('#jml').attr('value','');
        $('#hrg').attr('value','');
        $('#tot').attr('value','');
        $('#ket').attr('value','');
		max_rinci();
    }
    function kosong2(){
        updt == 'f';
		
        $('#jenis').combogrid('setValue','');
		$('#bida').combogrid('setValue','');
		$('#kelo').combogrid('setValue','');
		$('#kelo1').combogrid('setValue','');
        $('#kd').combogrid('setValue','');
        $('#nm').attr('value','');
        $('#satuan').combogrid('setValue','');
        $('#nmrek').attr('value','');
        $('#kdrek5').attr('value','');
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
        var kode  = $('#uskpd').combogrid('getValue'); 
		// ------------
		// ini ngambil dari tabel trd_planbrg sesuai nomor trh_planbrg
         $.ajax({
                type: "POST",
				singleSelect:"true",
                url: '<?php echo base_url(); ?>index.php/transaksi/trd_planbrg',
                data: ({no:nomor,kode:kode}),
                dataType:"json",
                success:function(data){                                          
                    $.each(data,function(i,n){                                    
                        no      = n['no_dokumen'];                                                                                        
                        kd      = n['kd_brg'];                                                                                       
                        r5      = n['kd_rek5'];
                        nm      = n['nm_brg'];
                        mrk     = n['merek'];                        
                        jml     = n['jumlah'];                        
                        hrg     = number_format(n['harga'],2,'.',',');
                        tot     = number_format(n['total'],2,'.',',');
                        ket     = n['ket'];             
                        satuan  = n['satuan'];             
                        totalx  = n['totalxx'];
						$('#trd').edatagrid('appendRow',{no_dokumen:no,kd_brg:kd,kd_rek5:r5,nm_brg:nm,merek:mrk,jumlah:jml,harga:hrg,total:tot,ket:ket,satuan:satuan});                                
						$('#total').attr('value',number_format(totalx));       
						$('#total2').attr('value',number_format(totalx));
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
            no = rows[p].no_dokumen;                    
            kd = rows[p].kd_brg;
            nm = rows[p].nm_brg;
            mrk = rows[p].merek;
            jml = rows[p].jumlah;
            hrg = rows[p].harga;
            tot = rows[p].total;
            ket = rows[p].ket; 
            satuan = rows[p].satuan;                                                                                                               
            $('#trd2').edatagrid('appendRow',{no_dokumen:no,kd_brg:kd,nm_brg:nm,merek:mrk,jumlah:jml,harga:hrg,total:tot,ket:ket,satuan:satuan});            
        }
        tot = document.getElementById('total').value;
        $('#total2').attr('value',tot);
        $('#trd').edatagrid('unselectAll');    
    } 
	
    function set_grid(){
         $('#trd').edatagrid({
              columns:[[
                    {field:'hapus',title:'',width:35,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus_detail();'' />";}},
            	    {field:'no_dokumen',title:'Nomor Dokumen',width:100,hidden:true},
                    {field:'kd_brg',title:'Kode Barang',width:100},
                    {field:'nm_brg',title:'Nama Barang',width:200},
                    {field:'merek',title:'Merek',width:200},
                    {field:'jumlah',title:'Jumlah',width:100,align:"right"},
                    {field:'harga',title:'Harga',width:150,align:"right"},
                    {field:'total',title:'Total',width:150,align:"right"},                                
                    {field:'ket',title:'Keterangan',width:200},
					{field:'satuan',title:'satuan',width:100}
                ]],  
            onDblClickRow:function(rowIndex,rowData){                                                             
                ckd  	= rowData.kd_brg;                                                           
                cr5  	= rowData.kd_rek5;
                cnm  	= rowData.nm_brg;
                cjumlah = rowData.jumlah;
                cmerek 	= rowData.merek;
                cjumlah = rowData.jumlah;
                charga 	= rowData.harga;
                ctot 	= rowData.total;
                cket 	= rowData.ket;
                csat 	= rowData.satuan;
				//nmm,satuann,kdrekk5,merekk,jmla,hrga,tota
				$("#dialog-detail").dialog('open');
				$('#kdd').attr('value',ckd);
				$('#nmm').attr('value',cnm);
				$('#satuann').attr('value',csat);
				$('#kdrekk5').attr('value',cr5);
				$('#merekk').attr('value',cmerek);
				$('#jmla').attr('value',cjumlah);
				$('#hrga').attr('value',charga);
				$('#tota').attr('value',ctot);
				$('#kete').attr('value',cket);

            }
        });       
    }
    function set_grid2(){
         $('#trd2').edatagrid({                                                                   
              columns:[[
            	    {field:'no_dokumen',title:'Nomor Dokumen',width:100,hidden:true},
                    {field:'kd_brg',title:'Kode Barang',width:100},
                    {field:'nm_brg',title:'Nama Barang',width:200},
                    {field:'merek',title:'Merek',width:200},
                    {field:'jumlah',title:'Jumlah',width:100,align:"right"},
                    {field:'harga',title:'Harga',width:150,align:"right"},
                    {field:'total',title:'Total',width:150,align:"right"},                                
                    {field:'ket',title:'Keterangan',width:200},
					{field:'satuan',title:'satuan',width:100}
                    
                ]]
        });          
    }
    function tambah_detail(){
        var no = document.getElementById('nomor').value;
        var tgl = $('#tanggal').datebox('getValue');
        var kd  = $('#uskpd').combogrid('getValue');
        var thn = '<?php echo ($this->session->userdata('ta_simbakda')); ?>';
        $('#trd2').datagrid('reload');
        if (no!='' && tgl!='' && kd!='' && thn!=''){
            $("#dialog-modal").dialog('open');    
            set_grid2();
            load_detail2();        
            kosong2();       
        } else {
            alert('Nomor/Tanggal/Unit Kerja/Tahun masih kosong, harap isi terlebih dahulu');
        }        
    }
    
    function hitung(){
        var a = angka(document.getElementById('jml').value);        
        var b = angka(document.getElementById('hrg').value);        
        var tot = a*b;        
            tot = number_format(tot,2,'.',',');
            $('#tot').attr('value',tot);
			
			/*edit detail*/
			
        var c = angka(document.getElementById('jmla').value);        
        var d = angka(document.getElementById('hrga').value);        
        var tota = c*d;        
            tota = number_format(tota,2,'.',',');
            $('#tota').attr('value',tota);
			
    }
    
    function append_save(){
	
        var no     = document.getElementById('nomor').value;        
        var jns    = $('#jenis').combogrid('getValue');
		var bdg    = $('#bida').combogrid('getValue'); 
		var klpk   = $('#kelo').combogrid('getValue');
		var klpk1  = $('#kelo1').combogrid('getValue');
        var kd     = $('#kd').combogrid('getValue');
		var skp	   = $('#uskpd').combogrid('getValue');
		var satuan = $('#satuan').combogrid('getValue');
        var unit   = document.getElementById('mlokasi').value;
        var nm     = document.getElementById('nm').value;
        var kdrek5 = document.getElementById('kdrek5').value;
        var nmrek  = document.getElementById('nmrek').value;
        var mrk    = document.getElementById('merek').value;
        var jml    = document.getElementById('jml').value;
        var hrg    = angka(document.getElementById('hrg').value);
        var tot    = angka(document.getElementById('tot').value);
        var ket    = document.getElementById('ket').value;
        var total  = angka(document.getElementById('total2').value);
		
       /***************************** SIMPAN KE TRD PLBRG ********************************************************************/ 
            csql = " values('"+no+"','"+kd+"','"+kdrek5+"','"+unit+"','"+skp+"','"+nm+"','"+mrk+"','"+jml+"','"+hrg+"','"+tot+"','"+ket+"','"+satuan+"')"; 
            csql2= " VALUES('"+no+"','"+kd+"','"+kdrek5+"','"+unit+"','"+skp+"','"+nm+"','"+mrk+"','"+jml+"','"+hrg+"','"+tot+"','"+ket+"','"+satuan+"')";
         
        /********************************************** ********************************************************************/        
        if (jns != '' && kd != '' && jml != '' && hrg != ''){        
        if (updt = 'f') {
				$.ajax({
					type: 'POST',
					data: ({sql:csql,sql2:csql2,nodok:no}),
					url:"<?php echo base_url(); ?>index.php/transaksi/trd_plbrg",
					success:function(data){ 
					 //var lctot = data; alert(lctot);
					 //$('#total').attr('value',lctot);
					 //$('#total2').attr('value',lctot);
					}
				  });         
				   hitung_total();                          
				   kosong2(); 
                $('#trd').edatagrid('appendRow',{no_dokumen:no,kd_brg:kd,nm_brg:nm,merek:mrk,jumlah:jml,harga:hrg,total:tot,ket:ket,satuan:satuan});
                $('#trd2').edatagrid('appendRow',{no_dokumen:no,kd_brg:kd,nm_brg:nm,merek:mrk,jumlah:jml,harga:hrg,total:tot,ket:ket,satuan:satuan});
                //$('#trd2').edatagrid('appendRow',{no_dokumen:no,kd_brg:kd,nm_basdasdrg:nm,merek:mrk,jumlah:jml,harga:hrg,total:tot,ket:ket});
				a = total + angka(tot);                
            } else {
			lcquery = "update trd_planbrg set kd_rek5='"+kdrek5+"',merek='"+mrk+"',jumlah='"+jml+"',harga='"+hrg+"',total='"+total+"',ket='"+ket+"',satuan='"+satuan+"' where kd_unit='"+unit+"' and kd_uskpd='"+skp+"' and no_dokumen='"+no+"' and kd_brg ='"+kd+"'";          
			   $.ajax({
					type: 'POST',
					data: ({st_query:lcquery}),
					url:"<?php echo base_url(); ?>index.php/master/update_master",
					success:function(data){ 
					}
				  });         
				   hitung_total();                          
				   kosong2();
			   
			   $('#trd').edatagrid('updateRow',{index:idx2,row:{no_dokumen:no,kd_brg:kd,nm_brg:nm,merek:mrk,jumlah:jml,harga:hrg,total:tot,ket:ket,satuan:satuan}});
               $('#trd2').edatagrid('updateRow',{index:idx2,row:{no_dokumen:no,kd_brg:kd,nm_brg:nm,merek:mrk,jumlah:jml,harga:hrg,total:tot,ket:ket,satuan:satuan}});                        
               //$('#trd2').edatagrid('updateRow',{index:idx2,row:{no_dokumen:no,kd_asdasdbrg:kd,nm_brg:nm,medfdsfrek:mrk,jumlah:jml,harga:hrg,total:tot,ket:ket}});                        
			   s = total - angka(total2);
               a = s + angka(tot);
            }
            updt = 'f';
           total = number_format(a,2,'.',',');
           $('#total').attr('value',total);
           $('#total2').attr('value',total);                                    
           kosong2();
		   hitung_total();
        }else {
                alert('Jenis, Bidang, Kelompok, Sub Kelompok, Kode, Jumlah dan Harga tidak boleh kosong');
                exit();
        }
    }
    
	function update_detail(){
        var no     = document.getElementById('nomor').value;   
        var kd     = document.getElementById('kdd').value; 
		var skp	   = $('#uskpd').combogrid('getValue');
		var satuan = document.getElementById('satuann').value;
        var unit   = document.getElementById('mlokasi').value;
        var nm     = document.getElementById('nmm').value;
        var kdrek5 = document.getElementById('kdrekk5').value;
        var mrk    = document.getElementById('merekk').value;
        var jml    = document.getElementById('jmla').value;
        var hrg    = angka(document.getElementById('hrga').value);
        var tot    = angka(document.getElementById('tota').value);
        var ket    = document.getElementById('kete').value;
        var total  = angka(document.getElementById('tota').value);
	
			lcquery = "update trd_planbrg set kd_rek5='"+kdrek5+"',merek='"+mrk+"',jumlah='"+jml+"',harga='"+hrg+"',total='"+total+"',ket='"+ket+"',satuan='"+satuan+"' where kd_unit='"+unit+"' and kd_uskpd='"+skp+"' and no_dokumen='"+no+"' and kd_brg ='"+kd+"'";          
			   $.ajax({
					type: 'POST',
					data: ({st_query:lcquery}),
					url:"<?php echo base_url(); ?>index.php/master/update_master",
					success:function(data){ 
					}
				  });         
				  swal({
					title: "Data Sudah Dirubah.!",
					type:"success"
					});
				   hitung_total(); 
				  $("#dialog-detail").dialog('close');
				   
				   /* 
			   $('#trd').edatagrid('updateRow',{index:idx2,row:{no_dokumen:no,kd_brg:kd,nm_brg:nm,merek:mrk,jumlah:jml,harga:hrg,total:tot,ket:ket,satuan:satuan}});
               $('#trd2').edatagrid('updateRow',{index:idx2,row:{no_dokumen:no,kd_brg:kd,nm_brg:nm,merek:mrk,jumlah:jml,harga:hrg,total:tot,ket:ket,satuan:satuan}});                        
			   s = total - angka(total2);
               a = s + angka(tot); */
	}
	
    function keluar(){
		 swal({
					title: "Jangan lupa disimpan.!!",
					type:"warning"
					});
        $("#dialog-modal").dialog('close');
        $('#trd2').datagrid('reload');                            
    }   
    
	function exit(){
        $("#dialog-detail").dialog('close');
        //$('#trd').datagrid('reload');     
		/*  swal({
					title: "Data Sudah Dirubah.!",
					type:"success"
					});  */                      
    }
	
    function get2(jns,bdg,klpk,klpk1,kd,nm,satuan,merek,jumlah,harga,total,ket){
        $('#jenis').combogrid('setValue',jns);
		$('#bida').combogrid('setValue',bdg);
		$('#kelo').combogrid('setValue',klpk);
		$('#kelo1').combogrid('setValue',klpk1);
        $('#kd').combogrid('setValue',kd);
        $('#nm').attr('value',nm); 
        $('#satuan').combogrid('setValue',satuan);                                     
        $('#merek').attr('value',merek);
        $('#jml').attr('value',jumlah);
        $('#hrg').attr('value',harga);
        $('#tot').attr('value',total);
        $('#ket').attr('value',ket);
        total2 = total;
    }
	
     function simpan(){
        var cno     	= document.getElementById('nomor').value;
        var ctgl    	= $('#tanggal').datebox('getValue');
        var cuskpd  	= $('#uskpd').combogrid('getValue');
        var cnmuskpd 	= document.getElementById('nmuskpd').value;
        var cmlokasi 	= document.getElementById('mlokasi').value; 
        var cthn    	= $('#tahun').combobox('getValue');
        var ctotal  	= angka(document.getElementById('total').value);               
             
        if (cno==''){
			sweetAlert("MAAF..!!", "Nomor Dokumen, dan Tanggal Dokumen mohon diisi", "error");
            exit();
        } 
        /*if (ctgl==''){
            alert('Tanggal Dokumen Tidak Boleh Kosong');
            exit();
        }
        if (cuskpd==''){
            alert('Kode Unit Tidak Boleh Kosong');
            exit();
        }  */     
        if (cthn==''){
            sweetAlert('Tahun Tidak Boleh Kosong');
            exit();
        }       	
        $(document).ready(function(){
            $.ajax({
                type: "POST",       
                dataType : 'json',         
                data: ({tabel:'trh_planbrg',no:cno,tgl:ctgl,uskpd:cuskpd,lokasi:cmlokasi,nmuskpd:cnmuskpd,tahun:cthn,total:ctotal}),
                url: '<?php echo base_url(); ?>index.php/transaksi/simpan_planbrg',
                success:function(data){
                   status = data.pesan; 
                   if (status == '0'){
                       alert('Gagal Simpan...!!');
                       exit();
                   } else {                                                           
					swal({
					title: "Berhasil",
					text: "Data telah disimpan.!!",
					imageUrl:"<?php echo base_url();?>/lib/images/bantaeng.png"
					}); 
                    }                                                                                             
                }
				});
				});                                 
			}
    
     function hapus(){
        var cnomor = document.getElementById('nomor').value;
		var skp	   = $('#uskpd').combogrid('getValue'); 
        var tny = confirm('Yakin Ingin Menghapus Data, Nomor Dokumen : '+cnomor+' ??');    
        if (tny==true){
        $(document).ready(function(){
        var urll = '<?php echo base_url(); ?>index.php/transaksi/hapus_planbrg';
        $.ajax({url:urll,
                 dataType:'json',
                 type: "POST",    
                 data:({no:cnomor,skpd:skp}),
                 success:function(data){
                        status = data.pesan;
                        if (status=='1'){
                            //alert('Data Berhasil Terhapus');  
                            $('#trh').edatagrid('reload');          
                        } else {
                            alert('Gagal Hapus');
                        }        
                 }
                });           
        });
        }     
		}
   
    function hapus_detail(){
        var cnomor = document.getElementById('nomor').value;
		var skp	   = $('#uskpd').combogrid('getValue'); 
        var tny 	= confirm('Yakin Ingin Menghapus Data, Kode Barang : '+ckd+' Nama Barang : '+cnm+' Nilai : '+ctot);
        var rows   	= $('#trd').datagrid('getSelected');
        ckd 	   	= rows.kd_brg;
        cnm        	= rows.nm_brg;
        ctot 		= rows.total;     
        if (tny==true){
        $(document).ready(function(){
        var urll = '<?php echo base_url(); ?>index.php/transaksi/trd_plbrg_hapus';
		total = angka(document.getElementById('total').value) - angka(ctot);

        $.ajax({url:urll,
                 dataType:'json',
                 type: "POST",    
                 data:({nomor:cnomor,kd:ckd,ctotal:total,skpd:skp}),
                 success:function(data){
            alert("DATA BERHASIL TERHAPUS, SILAHKAN RELOAD KEMBALI.!");           
            //$('#trd').edatagrid('reload');    
            $('#total2').attr('value',number_format(total,2,'.',','));
            $('#total').attr('value',number_format(total,2,'.',','));       
                 }
                });           
        });
        }     
		}
	
	function cari(){
	var kriteria = document.getElementById("txtcari").value; 
	$(function(){
		$('#trh').edatagrid({
		url: '<?php echo base_url(); ?>index.php/transaksi/trh_planbrg',
        queryParams:({cari:kriteria})
        });        
     });
    }
	 
	function hitung_total(){
	var organisasi = $('#uskpd').combogrid('getValue');
	var no_dok 	   = document.getElementById('nomor').value; 
		$.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>index.php/transaksi/hitung_total',
            data: ({skpd:organisasi,kolskpd:'kd_uskpd',table:'trd_planbrg',kolom:'total',nomor:no_dok,kolnomor:'no_dokumen'}),
            dataType:"json",
            success:function(data){                                          
                $.each(data,function(i,n){                                    
					 total	      = n['total']; 
					 $('#total').attr('value',number_format(total));
					 $('#total2').attr('value',number_format(total));
                });
            }
        });
	 }
	 
	function max_rinci(){  
	var organisasi = $('#uskpd').combogrid('getValue');
		$.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>index.php/transaksi/load_idmax',
            data: ({skpd:organisasi,table:'trh_planbrg',kolom:'no_dokumen',kolom_skpd:'kd_uskpd'}),
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
		<p><h3 align="center">INPUT RENCANA KEBUTUHAN BARANG UNIT (RKBU)</h3></p>
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
                <td height="30px">SKPD</td>
                <td>:</td>
                <td><input id="uskpd" name="uskpd" style="width: 140px;" /></td>
                <td></td>
                <td>Nama SKPD</td> 
                <td>:</td>
                <td>
				<input type="text" id="nmuskpd" style="border:0;width: 400px;" readonly="true"/>
				</td>                                
            </tr>  
            <tr>
                <td height="30px">Unit Kerja</td>
                <td>:</td>
                <td><input id="mlokasi" name="mlokasi" style="border:0;width: 140px;" readonly="true" /></td>
                <td></td>
                <td> Nama Unit Kerja</td>
                <td>:</td>
                <td>
				<input type="text" id="nmlokasi" style="border:0;width: 400px;" readonly="true"/>
				</td>                           
            </tr>       
            <tr>
                <td>Tahun Rencana</td>
                <td>:</td>
                <td><input id="tahun" name="tahun" style="width: 65px;" value=""/>  </td>            
            </tr>                            
        </table>  
        <br />
        <fieldset>
        <div align="center">    		  
		<a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:tambah_detail();"><b>Tambah/Edit Barang</b></a>   		                            		
        	<!--a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:kosong();">Tambah</a><br/>  
        	<a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:kosong();">Tambah</a>
            <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:section1();">Kembali</a-->                   
        </div>
        </fieldset>
        <br /> 
        <table  id="trd" title="Detail Barang" style="width:940px;height:300px;" >  
        </table>       
        <div align="right">Total : <input type="text" id="total" style="text-align: right;border:0;width: 200px;font-size: large;" readonly="true"/></div>        
		<br />
        <div align="center">
		<fieldset>
		<INPUT TYPE="button" VALUE="SIMPAN" style="height:40px;width:100px" onclick="javascript:simpan();" >
		<INPUT TYPE="button" VALUE="KEMBALI" style="height:40px;width:100px" onclick="javascript:section1();" >
        </fieldset>
		</div>  
</div>

<div id="dialog-modal" title="Input Barang" >
    <p class="validateTips" >Semua Inputan Harus Diisi.</p> 
    <fieldset>      
        <table>   
            <tr>
                <td>Jenis Barang</td>
                <td>:</td>
                <td width="150"><input id="jenis" name="jenis" value=""/> </td>
                <td rowspan="9"></td>   
                <td rowspan="9" width="660"  >
                    <table  id="trd2" title="Detail Barang" style="width:665px;height:270px;" >  
                    </table>           
                    <div align="right">Total : <input type="text" id="total2" style="text-align: right;border:0;width: 200px;font-size: large;" readonly="true"/></div>     
                </td>         
            </tr>  
			<tr hidden="true">
                <td>Bidang barang</td>
                <td>:</td>
                <td><input id="bida" name="bida" value=""/>  </td>                            
            </tr> 
			<tr hidden="true">
                <td>Kelompok barang</td>
                <td>:</td>
                <td><input id="kelo" name="kelo" value=""/>  </td>                            
            </tr> 
			<tr hidden="true">
                <td>Sub Kelompok barang</td>
                <td>:</td>
                <td><input id="kelo1" name="kelo1" value=""/>  </td>                            
            </tr> 
            <tr>
                <td>Kode barang</td>
                <td>:</td>
                <td><input id="kd" name="kd" value="" />  </td>                            
            </tr>       
            <tr>
                <td>Nama barang</td>
                <td>:</td>
                <td><input id="nm" name="nm" value="" readonly="true" style="border:0;"/>  </td>            
            </tr>   
		   <tr>
				<td>Satuan</td>
				<td>:</td>
				<td><input type="text" id="satuan" name="satuan" style="width:100px;"/></td>
		   </tr>
            <tr>
                <td>Kode Rekening</td>
                <td>:</td>
                <td><input id="kdrek5" name="kdrek5" value="" style="width:100px;"/>  </td>            
            </tr> 
            <tr>
                <td>Nama Rekening</td>
                <td>:</td>
                <td><input id="nmrek" name="nmrek" value="" readonly="true" style="border:0;"/>  </td>            
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
                <td>Harga Satuan</td>
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
                <td><a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:kosong2();">Tambah</a>
                    <a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:append_save();">Tampung</a>
                    <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Keluar</a>                               
                </td>
            </tr>
        </table>   
    </fieldset>
</div>
<div id="dialog-detail" title="Edit Barang" >
    <fieldset>      
        <table>   
            <tr>
                <td>Barang</td>
                <td>:</td>
                <td><input id="kdd" name="kdd" value="" readonly="true" style="border:0;" style="width:50px;"/>/<input id="nmm" name="nmm" value="" readonly="true" style="border:0;"/>  </td>            
            </tr>   
		   <tr>
				<td>Satuan</td>
				<td>:</td>
				<td><input type="text" id="satuann" name="satuan" style="width:100px;"/></td>
		   </tr>
            <tr>
                <td>Kode Rekening</td>
                <td>:</td>
                <td><input id="kdrekk5" name="kdrekk5" value="" style="width:100px;"/>  </td>            
            </tr> 
            <!--tr>
                <td>Nama Rekening</td>
                <td>:</td>
                <td><input id="nmrekk" name="nmrekk" value="" readonly="true" style="border:0;"/>  </td>            
            </tr-->      
            <tr>
                <td>Merek</td>
                <td>:</td>
                <td><input id="merekk" name="merekk" value=""/>  </td>            
            </tr>     
            <tr>
                <td>Jumlah</td>
                <td>:</td>
                <td><input id="jmla" name="jmla" value="" style="text-align: right;" onkeypress="return(isNumberKey(event));" onkeyup="hitung();"/></td>            
            </tr>  
            <tr>
                <td>Harga Satuan</td>
                <td>:</td>
                <td><input id="hrga" name="hrga" value="" style="text-align: right;" onkeypress="return(currencyFormat(this,',','.',event));" onkeyup="hitung();"/>  </td>            
            </tr> 
            <tr>
                <td>Total Harga</td>
                <td>:</td>
                <td><input id="tota" name="tota" value="" style="text-align: right;border:0;" readonly="true" />  </td>            
            </tr>  
            <tr>
                <td>Keterangan</td>
                <td>:</td>
                <td><textarea id="kete" style="width: 155px; height: 60px;"></textarea> </td>            
            </tr> 
        </table>     
		
    </fieldset>  
    <fieldset>
        <table align="center">
            <tr>
                <td><a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:update_detail();">Ubah</a>
                    <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:exit();">Batal</a>
                </td>
            </tr>
        </table>   
    </fieldset>
</div>

