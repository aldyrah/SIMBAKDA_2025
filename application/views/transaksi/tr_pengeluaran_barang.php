<script type="text/javascript" src="<?php echo base_url(); ?>easyui/autoCurrency.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>easyui/currencyFields.js"></script>
<script src="<?php echo base_url(); ?>lib/sweet-alert.min.js"></script>
<link   rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>lib/sweet-alert.css">
<script type="text/javascript">
    
    var updt = 'f';
    var idx2 = '';
    var total2 = 0;
     $(document).ready(function() {
          $("#tabs").tabs();
          $("#dialog-modal").dialog({
            height: 530,
            width: 1000,
            modal: true, 
            background:'#2da305',           
            autoOpen:false                
          });                       
     });    
     
    $(function(){         
         $('#trh').datagrid({
    		url: "<?php echo base_url(); ?>index.php/transaksi/trh_klrbrg",
            idField:"no_dokumen",            
            rownumbers:"true", 
            fitColumns:"true",
            singleSelect:"true",
            autoRowHeight:"false",
            loadMsg:"Tunggu Sebentar....!!",
            pagination:"true",
            nowrap:"true",                       
            columns:[[
        	    {field:'no_bak',title:'Nomor BAK',width:20},
                {field:'tgl_bak',title:'Tanggal BAK',width:40},
                {field:'nm_uskpd',title:'Unit SKPD',width:100},
                {field:'tahun',title:'Tahun',width:20,align:"center"},
				{field:'hapus',width:10,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus();'' />";}}
            ]],
            onSelect:function(rowIndex,rowData){
                nomor   = rowData.no_bak;
                nobap   = rowData.no_bap;
                tgl     = rowData.tgl_bak;
                kode    = rowData.kd_uskpd;
                nmkode  = rowData.nm_uskpd;
                tahun   = rowData.tahun;
                total   = rowData.total;
                get(nomor,nobap,tgl,kode,nmkode,tahun,total);
                load_detail();
            },
            onDblClickRow:function(rowIndex,rowData){ 
                nomor   = rowData.no_bak;
                section2();                                  
            }
        });
        
          $('#trd').edatagrid({    		
            idField:"no_dokumen",            
            rownumbers:"true",            
            singleSelect:"true",
            autoRowHeight:"false",
            toolbar:'#toolbar',
            loadMsg:"Tunggu Sebentar....!!",            
            nowrap:"true"
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
                updt = 't';                             
                get2(jns,rowData.kd_brg,rowData.nm_brg,rowData.merek,rowData.jumlah,rowData.harga,rowData.total,rowData.ket); 
            }          
        });
        
        $('#tglkel').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            }
         });
    
		 $('#uskpd').combogrid({  
            panelWidth:400,  
            idField:'kd_skpd',  
            textField:'kd_skpd',  
            mode:'remote',                      
            url:'<?php echo base_url(); ?>index.php/master/ambil_msskpd2',  
            columns:[[  
               {field:'kd_skpd',title:'Kode Unit',width:100},  
               {field:'nm_skpd',title:'Nama Unit',width:300}    
            ]],  
            onSelect:function(rowIndex,rowData){
               cuskpd 	  = rowData.kd_skpd; 
               ckd_lokasi = rowData.kd_lokasi;     
               $('#kdubidskpd').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_uskpd',queryParams:({kduskpd:ckd_lokasi}) });			   
               $('#nmuskpd').attr('value',rowData.nm_skpd);           
               $('#mlokasi').attr('value',ckd_lokasi);                           
            } 
         }); 
		 
	/* 	$('#kdskpd').combogrid({  
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
               $('#kdubidskpd').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_uskpd',queryParams:({kduskpd:lcskpdx}) });
               $("#nmskpd").attr("value",rowData.nm_skpd.toUpperCase());
           }  
         }); */
		 
        $('#kdubidskpd').combogrid({  
           panelWidth:500,  
           idField:'kd_uskpd',  
           textField:'kd_uskpd',  
           mode:'remote',
           //url:'<?php echo base_url(); ?>index.php/master/ambil_ubidskpd',  
           columns:[[  
               {field:'kd_uskpd',title:'KODE BIDANG',width:100},  
               {field:'nm_uskpd',title:'NAMA UNIT BIDANG',width:400}    
           ]],  
           onSelect:function(rowIndex,rowData){
               lcskpd = rowData.kd_uskpd; 
               $("#nmbidskpd").attr("value",rowData.nm_uskpd.toUpperCase());
           }  
         });
         
         
        $('#tahun').combobox({           
            valueField:'tahun',  
            textField:'tahun',
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
                //$('#kd').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_brg',queryParams:({gol:cgol,sts:'mrek5'}) });
            } 
        }); 
         
         $('#batrm').combogrid({  
            panelWidth:220,  
            idField:'no_dokumen',  
            textField:'no_dokumen',  
            mode:'remote',                      
            url:'<?php echo base_url(); ?>index.php/transaksi/ambil_trmbrg',  
            columns:[[  
               {field:'no_dokumen',title:'NO DOK',width:70},  
               {field:'tgl_bap',title:'Tgl BAP',width:130}    
            ]],  
            onSelect:function(rowIndex,rowData){
               cnoba		= rowData.no_bap;    
               cno_dokumen	= rowData.no_dokumen;                         
               //load_trm(cno_dokumen); 
				var unit = document.getElementById('mlokasi').value; 
                $('#kd').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_keluar_barang',queryParams:({dok:cno_dokumen,unit:unit}) });			   
              // $('#nmuskpd').attr('value',rowData.nm_uskpd);                               
            } 
         });
         
        $('#kd').combogrid({  
            panelWidth:600, 
            width:160, 
            idField:'kd_brg',  
            textField:'kd_brg',              
            mode:'remote',
            //url:'<?php echo base_url(); ?>index.php/master/ambil_brg',
            queryParams:({gol:'',sts:'mrek5'}),
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kd_brg',title:'Kode Barang',width:100},  
               {field:'nm_brg',title:'Nama Barang',width:500}    
            ]],  
            onSelect:function(rowIndex,rowData){    
				no_bap		= rowData.no_bap;
				no_dokumen	= rowData.no_dokumen;
				kd_brg		= rowData.kd_brg;
				kd_unit		= rowData.kd_unit;
				kd_uskpd	= rowData.kd_uskpd;
				nm_brg		= rowData.nm_brg;
				merek		= rowData.merek;
				tahun		= rowData.tahun;
				jumlah		= rowData.jumlah;
				harga		= rowData.harga;
				total		= rowData.total;
				cad			= rowData.cad;
				ket			= rowData.ket;
                $('#nm').attr('value',nm_brg);
                $('#nmrek').attr('value','');
                $('#merek').attr('value',merek);
                $('#jml').attr('value',jumlah);
                $('#hrg').attr('value',harga);
                $('#ket').attr('value',ket);
		
              /*   cnm = rowData.nm_brg;
                crek= rowData.nm_rek5;
                $('#nm').attr('value',cnm);
                $('#nmrek').attr('value',crek);
                $('#merek').focus(); */
            } 
        });  
    });
    
    function load_trm(cno_dokumen){
        var i = 0;
        var cno_dokumen = cno_dokumen;
        var tgl   = $('#tglkel').datebox('getValue');
        var kode  = $('#uskpd').combogrid('getValue');  
       //alert(nobap);             
         $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>index.php/transaksi/trd_trmbrg',
                data: ({no:cno_dokumen}),
                dataType:"json",
                success:function(data){                                          
                    $.each(data,function(i,n){                                    
                        no      = n['no_bap'];                                                                                        
                        kd      = n['kd_brg'];
                        nm      = n['nm_brg'];
                        mrk     = n['merek'];                        
                        jml     = n['jumlah'];                        
                        hrg     = number_format(n['harga'],2,'.',',');
                        tot     = number_format(n['total'],2,'.',',');
                        ket     = n['ket'];                                
                        $('#trd').datagrid('appendRow',{no_dokumen:no,kd_brg:kd,nm_brg:nm,merek:mrk,jumlah:jml,harga:hrg,total:tot,ket:ket});                                
                    });
                }
         });         
          set_grid();
    }
          
    function section1(){        
        $('#tabs1').click();   
        set_grid(); 
		$('#trh').datagrid('reload');
    }
    function section2(){            
        $('#tabs2').click();
        set_grid();                                                        
    }
    function get(nomor,nobap,tgl,kode,nmkode,tahun,total){
        $('#nomor').attr('value',nomor);
        $('#batrm').combogrid('setValue',nobap);
        $('#tglkel').datebox('setValue',tgl);
        $('#uskpd').combogrid('setValue',kode);
        $('#nmuskpd').attr('value',nmkode);
        $('#tahun').combobox('setValue',tahun);
        $('#total').attr('value',number_format(total,2,'.',','));
        $('#nomor').attr('disabled',true);
    }
    function kosong(){
        cdate = '<?php echo date("Y-m-d"); ?>';
        cthn = '<?php echo date("Y"); ?>';    
        var thn  = '<?php echo ($this->session->userdata('ta_simbakda')); ?>';
		var skpd  = '<?php echo ($this->session->userdata('skpd')); ?>';
        $('#nomor').attr('value','');
        $('#batrm').combogrid('setValue','');
        $('#tglkel').datebox('setValue',cdate);
        $('#uskpd').combogrid('setValue',skpd);
        //$('#nmuskpd').attr('value','');
        $('#tahun').combobox('setValue',thn);
        $('#nomor').attr('disabled',false);
    }
    function kosong2(){
        updt = 'f';
        $('#jenis').combogrid('setValue','');
        $('#kd').combogrid('setValue','');
        $('#nm').attr('value','');
        $('#nmrek').attr('value','');
        $('#merek').attr('value','');
        $('#jml').attr('value','');
        $('#hrg').attr('value','');
        $('#tot').attr('value','');
        $('#ket').attr('value','');
    }
    function load_detail(){
        var i = 0;
        var nobap = $('#batrm').combogrid('getValue');
        var tgl   = $('#tglkel').datebox('getValue');
        var kode  = $('#uskpd').combogrid('getValue');    
       //alert(nobap);  
	   //alert(nomor);            
         $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>index.php/transaksi/trd_klrbrg',
                data: ({no:nomor}),
                dataType:"json",
                success:function(data){                                          
                    $.each(data,function(i,n){                                    
                        no      = n['no_bak'];                                                                                        
                        kd      = n['kd_brg'];
                        nm      = n['nm_brg'];
                        mrk     = n['merek'];                        
                        jml     = n['jumlah'];                        
                        hrg     = number_format(n['harga'],2,'.',',');
                        tot     = number_format(n['total'],2,'.',',');
                        ket     = n['ket'];                                
                        $('#trd').datagrid('appendRow',{no_dokumen:no,kd_brg:kd,nm_brg:nm,merek:mrk,jumlah:jml,harga:hrg,total:tot,ket:ket});                                
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
            $('#trd2').datagrid('appendRow',{no_dokumen:no,kd_brg:kd,nm_brg:nm,merek:mrk,jumlah:jml,harga:hrg,total:tot,ket:ket});            
        }
        tot = document.getElementById('total').value;
        $('#total2').attr('value',tot);
        $('#trd').datagrid('unselectAll');    
    }
    function set_grid(){
         $('#trd').datagrid({                                                                   
              columns:[[
            	    {field:'no_dokumen',title:'Nomor Dokumen',width:100,hidden:true},
                    {field:'kd_brg',title:'Kode Barang',width:100},
                    {field:'nm_brg',title:'Nama Barang',width:200},
                    {field:'merek',title:'Merek',width:200},
                    {field:'jumlah',title:'Jumlah',width:100,align:"right"},
                    {field:'harga',title:'Harga',width:150,align:"right"},
                    {field:'total',title:'Total',width:150,align:"right"},                                
                    {field:'ket',title:'Keterangan',width:200}
                ]]
        });          
    }
    function set_grid2(){
         $('#trd2').datagrid({                                                                   
              columns:[[
                    {field:'hapus',title:'',width:35,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus_detail();'' />";}},
            	    {field:'no_dokumen',title:'Nomor Dokumen',width:100,hidden:true},
                    {field:'kd_brg',title:'Kode Barang',width:100},
                    {field:'nm_brg',title:'Nama Barang',width:200},
                    {field:'merek',title:'Merek',width:200},
                    {field:'jumlah',title:'Jumlah',width:100,align:"right"},
                    {field:'harga',title:'Harga',width:150,align:"right"},
                    {field:'total',title:'Total',width:150,align:"right"},                                
                    {field:'ket',title:'Keterangan',width:200}
                ]]
        });          
    }
    function tambah_detail(){
        var no = document.getElementById('nomor').value;
        var tgl = $('#tglkel').datebox('getValue');
        var kd  = $('#uskpd').combogrid('getValue');
        var thn = $('#tahun').combobox('getValue');
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
    }
    
    function append_save(){
        var no  = document.getElementById('nomor').value;        
        //var jns = $('#jenis').combogrid('getValue');
        var kd  = $('#kd').combogrid('getValue');
        var nm  = document.getElementById('nm').value;
        var nmrek  = document.getElementById('nmrek').value;
        var mrk  = document.getElementById('merek').value;
        var jml  = document.getElementById('jml').value;
        var hrg  = document.getElementById('hrg').value;
        var tot  = document.getElementById('tot').value;
        var ket  = document.getElementById('ket').value;
        var total  = angka(document.getElementById('total2').value);
        
        if (kd != '' && jml != '' && hrg != ''){        
            if (updt == 'f') {
                $('#trd').datagrid('appendRow',{no_dokumen:no,kd_brg:kd,nm_brg:nm,merek:mrk,jumlah:jml,harga:hrg,total:tot,ket:ket});
                $('#trd2').datagrid('appendRow',{no_dokumen:no,kd_brg:kd,nm_brg:nm,merek:mrk,jumlah:jml,harga:hrg,total:tot,ket:ket});
                a = total + angka(tot);               
            } else {
                $('#trd').datagrid('updateRow',{index:idx2,row:{no_dokumen:no,kd_brg:kd,nm_brg:nm,merek:mrk,jumlah:jml,harga:hrg,total:tot,ket:ket}});
                $('#trd2').datagrid('updateRow',{index:idx2,row:{no_dokumen:no,kd_brg:kd,nm_brg:nm,merek:mrk,jumlah:jml,harga:hrg,total:tot,ket:ket}});                        
                s = total - angka(total2);
                a = s + angka(tot);
            }
            updt = 'f';
            total = number_format(a,2,'.',',');
            $('#total').attr('value',total);
            $('#total2').attr('value',total);     alert(total);                                
            kosong2();
        }else {
                alert('Jenis, Kode, Jumlah dan Harga tidak boleh kosong');
                exit();
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
    
    function get2(jns,kd,nm,merek,jumlah,harga,total,ket){
        $('#jenis').combogrid('setValue',jns);
        $('#kd').combogrid('setValue',kd);
        $('#nm').attr('value',nm);
//        $('#nmrek').attr('value',nmrek);                                      
        $('#merek').attr('value',merek);
        $('#jml').attr('value',jumlah);
        $('#hrg').attr('value',harga);
        $('#tot').attr('value',total);
        $('#ket').attr('value',ket);
        total2 = total;
        
    }
     function simpan(){
        var cnoo     = document.getElementById('nomor').value;
        var cbatrm   = $('#batrm').combogrid('getValue');
        var ctgl     = $('#tglkel').datebox('getValue');
        var cuskpd   = $('#uskpd').combogrid('getValue');
        var cmlokasi = document.getElementById('mlokasi').value;
        var cnmuskpd = document.getElementById('nmuskpd').value;
        var cthn     = $('#tahun').combobox('getValue');
        var ctotal   = angka(document.getElementById('total').value);
        var tujuan   = $('#kdubidskpd').combogrid('getValue');
		//alert(cnoo+"--"+cbatrm+"--"+ctgl+"--"+cuskpd+"--"+cnmuskpd+"--"+cthn+"--"+ctotal);
        if (cnoo==''){
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
        if (cthn==''){
            alert('Tahun Tidak Boleh Kosong');
            exit();
        }		
       /* if(cbatrm==''){
            alert('Nomor BA Tidak Boleh Kosong');
            exit();
        }        */
             
        $(document).ready(function(){
            $.ajax({
                type: "POST",       
                dataType : 'json',         
                data: ({tabel:'trh_keluarbrg',no:cnoo,batrm:cbatrm,tgl:ctgl,uskpd:cuskpd,unit:cmlokasi,nmuskpd:cnmuskpd,tahun:cthn,total:ctotal,tujuan:tujuan}),
                url: '<?php echo base_url(); ?>index.php/transaksi/simpan_klrbrg',
                success:function(data){
                   status = data.pesan;       
                                
                   if (status == '0'){
                       alert('Gagal Simpan...!!');
                       exit();
                   } else { 
                       
                       $('#trd').datagrid('selectAll');
                       var trd = $('#trd').datagrid('getSelections');                       
 			           for(var w = 0; w < trd.length ; w++){
            				cno     = trd[w].no_bak;                                            
                            ckd     = trd[w].kd_brg;
                            cnm     = trd[w].nm_brg;
                            cmerk   = trd[w].merek;
                            cjum    = trd[w].jumlah;
                            chrg    = angka(trd[w].harga);
                            ctotal  = angka(trd[w].total);
                            cket    = trd[w].ket;   			
                            if (w > 0) {
                                csql = csql + ",('"+cnoo+"','"+ckd+"','"+cnm+"','"+cmerk+"','"+cjum+"','"+chrg+"','"+ctotal+"','"+cket+"')";
                            } else {
                                csql = " values('"+cnoo+"','"+ckd+"','"+cnm+"','"+cmerk+"','"+cjum+"','"+chrg+"','"+ctotal+"','"+cket+"')";                                            
							}
                                                                                        
             			}                   
                                                         
                        $(document).ready(function(){     
                            $.ajax({
                                type: "POST",   
                                dataType : 'json',                 
                                data: ({tabel:'trd_keluarbrg',no:cnoo,kd:ckd,uskpd:cuskpd,unit:cmlokasi,nm:cnm,merk:cmerk,jum:cjum,hrg:chrg,total:ctotal,ket:cket}),
                                url: '<?php echo base_url(); ?>index.php/transaksi/simpan_klrbrg',
                                success:function(data){                        
                                    status = data.pesan;   
                                    if (status=='1'){               
                                        alert('Data Berhasil Tersimpan');
                                    } else{                                                         
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
                                                                                                                              
                }
            });
       });                                 
    }
    
     function hapus(){
        var cnomor = document.getElementById('nomor').value;
        var urll = '<?php echo base_url(); ?>index.php/transaksi/hapus_klrbrg';
        var tny = confirm('Yakin Ingin Menghapus Data, Nomor Dokumen : '+cnomor);        
        if (tny==true){
        $(document).ready(function(){
        $.ajax({url:urll,
                 dataType:'json',
                 type: "POST",    
                 data:({no:cnomor,kd_unit:kode}),
                 success:function(data){
                        status = data.pesan;
                        if (status=='1'){
                            alert('Data Berhasil Terhapus');
							$('#trh').datagrid('reload');
                        } else {
                            alert('Gagal Hapus');
                        }        
                 }
                 
                });           
        });
        }     
    }
   
   function hapus_detail(){
        var rows = $('#trd2').datagrid('getSelected');
        ckd =   rows.kd_brg;
        cnm =   rows.nm_brg;
        ctot =   rows.total;                                   
        var idx = $('#trd2').datagrid('getRowIndex',rows);
        var tny = confirm('Yakin Ingin Menghapus Data, Kode Barang : '+ckd+' Nama Barang : '+cnm+' Nilai : '+ctot);
        if (tny==true){
            $('#trd2').datagrid('deleteRow',idx);
            $('#trd').datagrid('deleteRow',idx);            
            total = angka(document.getElementById('total2').value) - angka(ctot);
            $('#total2').attr('value',number_format(total,2,'.',','));
            $('#total').attr('value',number_format(total,2,'.',','));                                
            kosong2();
        }                     
    }

   </script>
   
  <style type="text/css">

form fieldset{
border: none;}

form input.highlight{background: #f9f9f9;border: solid 1px #CCCCCC;padding: 5px;}

form input.highlight:focus {border: solid 1px #D9AD00;background: #FFF7D7;}

    </style>
 

<div id="tabs" >
		<p><h3 align="center">PENGELUARAN BARANG</h3></p>
    <ul style="background-color:#2da305;">
        <li><a href="#tabs-1" style="width: 452px;" id="tabs1">List View</a></li>
        <li><a href="#tabs-2" style="width: 452px;" id="tabs2">Form Input</a></li>        
    </ul>
    <div id="tabs-1">
        <div>
            <p align="right">
                <a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:kosong();section2();">Tambah</a>               
                <a class="easyui-linkbutton" iconCls="icon-search" plain="true" >Cari</a>
                <input type="text" value="" id="txtcari"/>              
                <table  id="trh" title="List Dokumen" style="width:940px;height:400px;" >  
                </table>                
            </p>
        </div>
    </div>
    <div id="tabs-2">  
        <br/><br />
        <table>
            <tr>
                <td height="30px">No.B.A Pengeluaran</td>
                <td>:</td>
                <td><input class="highlight" placeholder="*isi no.berita pengeluaran" type="text" id="nomor" style="width: 200px;" onclick="javascript:select();" /></td>
                <td width="70px"></td>
                <td>TAHUN</td>
                <td>:</td>
                <td><input id="tahun" name="tahun" style="width: 100px;" value=""/>  </td> 
               
            </tr>
            <tr>
                <td height="30px">Tanggal Keluar</td>
                <td>:</td>
                <td><input type="text" id="tglkel" style="width: 140px;" /></td> 
                <td width="70px"></td>  
                <td>SKPD</td>
                <td>:</td>
                <td><input id="uskpd" name="uskpd" style="width: 140px;" />
				 <input hidden="true" type="text" name="mlokasi" id="mlokasi" style="border:0;width: 140px;" readonly="true"/>
				<input type="text" name="nmuskpd" id="nmuskpd" style="border:0;width: 200px;" readonly="true"/>
				</td>
                <td></td>                          
            </tr>     
            <tr>
                <td height="30px"></td>
                <td></td>
                <td></td> 
                <td width="70px"></td>  
                <td>UNIT TUJUAN</td>
                <td>:</td>
                <td><input id="kdubidskpd" name="kdubidskpd" style="width: 140px;" /><input id="nmbidskpd" name="nmbidskpd" style="width: 200px; border:0;" /></td>
                <td></td>                          
            </tr>         
            <tr hidden="true">                
                <td>JENIS BARANG</td>
                <td>:</td>
                <td><input id="" name="" style="width: 140px;" /></td>  
                <td width="70px"></td>
                <td>PILIH BARANG KELUAR</td>
                <td> </td>
                <td><input type="text" id="" style="border:0;width: 400px;" readonly="true"/></td>         
            </tr>                    
        </table>  
        <!--br />
        <fieldset>
        <div align="center">
        	<a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:kosong();">Tambah</a>
            <a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:simpan();">Simpan</a>   		  
            <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:section1();">Kembali</a>          
        </div>
        </fieldset-->
        <br /> 
        <table  id="trd" title="Detail Barangg" style="width:940px;height:300px;" >  
        </table>       
        <div align="right">Total : <input type="text" id="total" style="text-align: right;border:0;width: 200px;font-size: large;" readonly="true"/></div>        
        <br/>
        <div align="center">
		<fieldset>
		<INPUT TYPE="button" VALUE="SIMPAN" style="height:40px;width:100px" onclick="javascript:simpan();" >
		<INPUT TYPE="button" VALUE="KEMBALI" style="height:40px;width:100px" onclick="javascript:section1();" >
        </fieldset>
		</div> 
     
        <div id="toolbar" align="center" >
    		<a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:tambah_detail();"><b>KELUARKAN BARANG</b></a>   		                            		
        </div>
      
    </div>  
</div>

<div id="dialog-modal" title="Input Barang" >
    <p class="validateTips" >Semua Inputan Harus Di Isi.</p> 
    <fieldset>      
        <table>      
            <tr>
                <!--td>Jenis Barang</td>
                <td>:</td>
                <td width="150"><input id="jenis" name="jenis" value=""/> </td-->
                <td>No.DOK PENERIMAAN</td>
                <td>:</td>
                <td width="150"><input id="batrm" name="batrm" value=""/> </td>
                <td rowspan="9"></td>   
                <td rowspan="9" width="660"  >
                    <table  id="trd2" title="Detail Barang" style="width:665px;height:270px;" >  
                    </table>           
                    <div align="right">Total : <input type="text" id="total2" style="text-align: right;border:0;width: 200px;font-size: large;" readonly="true"/></div>     
                </td>         
            </tr>  
            <tr>
                <td>Kode barang</td>
                <td>:</td>
                <td><input id="kd" name="kd" value=""/>  </td>                            
            </tr>       
            <tr>
                <td>Nama Barang</td>
                <td>:</td>
                <td><input id="nm" name="nm" value="" readonly="true" style="border:0;"/>  </td>            
            </tr>  
            <tr>
                <td>Rekening</td>
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
                <td>Jumlah Keluar</td>
                <td>:</td>
                <td><input id="jml_klr" name="jml_klr" value="" style="text-align: right;" onkeypress="return(isNumberKey(event));" onkeyup="hitung();"/></td>            
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
                    <a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:append_save();">Simpan</a>
                    <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Keluar</a>                               
                </td>
            </tr>
        </table>   
    </fieldset>
</div>

