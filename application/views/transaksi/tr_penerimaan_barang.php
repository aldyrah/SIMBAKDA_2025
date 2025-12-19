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
            height: 470,
            width: 1000,
            modal: true, 
            background:'#2da305',           
            autoOpen:false                
          });                       
     });    
     
    $(function(){         
         $('#trh').edatagrid({
    		url: "<?php echo base_url(); ?>index.php/transaksi/trh_trmbrg",
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
                {field:'tgl_bap',title:'Tanggal BAP',width:30},
                {field:'nm_uskpd',title:'Unit SKPD',width:100},
                {field:'tahun',title:'Tahun',width:20,align:"center"},
				{field:'hapus',width:10,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus();'' />";}}

		   ]],
            onSelect:function(rowIndex,rowData){ 
                no_bap      = rowData.no_bap; 
            	tgl_bap     = rowData.tgl_bap; 
            	no_dokumen  = rowData.no_dokumen; 
            	nip1        = rowData.nip1;
            	nip2        = rowData.nip2;
            	no_faktur   = rowData.no_faktur;
            	tgl_faktur  = rowData.tgl_faktur;
            	no_periksa  = rowData.no_periksa; 
            	tgl_periksa = rowData.tgl_periksa;
            	kd_unit     = rowData.kd_unit;   
            	kd_uskpd    = rowData.kd_uskpd;   
            	nm_uskpd    = rowData.nm_uskpd; 
            	ket         = rowData.keterangan;
            	tahun       = rowData.tahun; 
            	total       = rowData.total; 
                
                get(no_bap,tgl_bap,no_dokumen,nip1,nip2,no_faktur,tgl_faktur,no_periksa,tgl_periksa,kd_unit,kd_uskpd,nm_uskpd,ket,tahun,total);
                load_detail();
            },
            onDblClickRow:function(rowIndex,rowData){         
                section2();                                  
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
                updt = 't';                             
                get2(jns,rowData.kd_brg,rowData.nm_brg,rowData.merek,rowData.jumlah,rowData.harga,rowData.total,rowData.ket); 
            }          
        });
        
        $('#tglterima').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            }
         });
         
         $('#tglpriksa').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            }
         });
         
          $('#tglfak').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            }
         });
              
         $('#uskpd').combogrid({  
            panelWidth:600,  
            idField:'kd_skpd',  
            textField:'kd_skpd',  
            mode:'remote',                      
            url:'<?php echo base_url(); ?>index.php/master/ambil_msskpd2',  
            columns:[[  
               {field:'kd_skpd',title:'Kode Unit',width:65},  
               {field:'nm_skpd',title:'Nama Unit',width:250},
               {field:'kd_lokasi',title:'Kode Unit',width:90},  
               {field:'nm_lokasi',title:'Nama Unit',width:250}    
            ]],  
            onSelect:function(rowIndex,rowData){
               cuskpd 	  = rowData.kd_skpd;  
               ckd_lokasi = rowData.kd_lokasi;                      
               $('#nmuskpd').attr('value',rowData.nm_skpd);           
               $('#mlokasi').attr('value',rowData.ckd_lokasi);                              
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
				var cuskpd = $('#uskpd').combogrid('getValue');
                $('#kd').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_penerimaan_barang',
				queryParams:({gol:cgol,skpd:cuskpd})});
            } 
        }); 
         
        $('#kd').combogrid({  
            panelWidth:600, 
            idField:'kd_brg',  
            textField:'kd_brg',              
            mode:'remote',
            //url:'<?php echo base_url(); ?>index.php/master/ambil_penerimaan_barang',
            //queryParams:({gol:'',sts:'mrek5'}),
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kd_brg',title:'Kode Barang',width:190},  
               {field:'nm_brg',title:'Nama Barang',width:400}    
            ]],  
            onSelect:function(rowIndex,rowData){                                                             
                cnm 		= rowData.nm_brg;
                crek		= rowData.kd_kegiatan;                                                           
                jumlah 		= rowData.jumlah;
                harga  		= rowData.harga;                                                           
                total 		= rowData.total;
                keterangan 	= rowData.keterangan;
                $('#nm').attr('value',cnm);
                $('#nmrek').attr('value',crek);
                $('#jml').attr('value',jumlah);
                $('#hrg').attr('value',harga);
                $('#tot').attr('value',total);
                $('#kete').attr('value',keterangan);
                //$('#merek').focus();
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
        set_grid();                                                        
    }
    function get(no_bap,tgl_bap,no_dokumen,nip1,nip2,no_faktur,tgl_faktur,no_periksa,tgl_periksa,kd_unit,kd_uskpd,nm_uskpd,ket,tahun,total){
        $('#baterima').attr('value',no_bap);
        $('#tahun').combobox('setValue',tahun);
        $('#tglterima').datebox('setValue',tgl_bap);
        $('#uskpd').combogrid('setValue',kd_uskpd);
        $('#nmuskpd').attr('value',nm_uskpd);
        $('#mlokasi').attr('value',kd_unit);
        $('#nomor').attr('value',no_dokumen);
        $('#sampaikan').attr('Value',nip1);
        $('#priksa').attr('Value',no_periksa);
        $('#terima').attr('value',nip2);
        $('#tglpriksa').datebox('setValue',tgl_periksa);
        $('#ket').attr('value',ket);
        $('#nofak').attr('value',no_faktur);
        $('#tglfak').datebox('setValue',tgl_faktur);
        $('#total').attr('value',number_format(total,2,'.',','));
        $('#nomor').attr('disabled',true);
    }
    function kosong(){
		var skpd  = '<?php echo ($this->session->userdata('skpd')); ?>';
		var unit  = '<?php echo ($this->session->userdata('unit_skpd')); ?>';
        var thn  = '<?php echo ($this->session->userdata('ta_simbakda')); ?>';
        cdate = '<?php echo date("Y-m-d"); ?>';
       // cthn = '<?php echo date("Y"); ?>';    
        $('#baterima').attr('value','');
        $('#tahun').combobox('setValue',thn);
        $('#tglterima').datebox('setValue',cdate);
        $('#uskpd').combogrid('setValue',skpd);
        $('#mlokasi').attr('value',unit);
        $('#nomor').attr('value','');
        $('#nomor').attr('disabled',false);
        $('#sampaikan').attr('Value','');
        $('#priksa').attr('Value','');
        $('#terima').attr('value','');
        $('#tglpriksa').datebox('setValue',cdate);
        $('#ket').attr('value','');
        $('#nofak').attr('value','');
        $('#tglfak').datebox('setValue',cdate);
        $('#tot').attr('value','');   
		max_rinci();     
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
        $('#kete').attr('value','');
    }
    function load_detail(){
        var i = 0;
        var nobap = document.getElementById('baterima').value;
        var no    = document.getElementById('nomor').value;
        var tgl   = $('#tglterima').datebox('getValue');
        var kode  = $('#uskpd').combogrid('getValue');               
         $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>index.php/transaksi/trd_trmbrg',
                data: ({no:no,kode:kode}),
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
         $('#trd').edatagrid({                                                                   
              columns:[[
            	    {field:'no_bap',title:'Nomor BAP',width:100,hidden:true},
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
         $('#trd2').edatagrid({                                                                   
              columns:[[
                    {field:'hapus',title:'',width:35,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus_detail();'' />";}},
            	    {field:'no_bap',title:'Nomor BAP',width:100,hidden:true},
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
        var tgl = $('#tglterima').datebox('getValue');
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
        var bap = document.getElementById('baterima').value; 
        var no  = document.getElementById('nomor').value;       
        var jns = $('#jenis').combogrid('getValue');
        var kd  = $('#kd').combogrid('getValue');
        var cuskpd      = $('#uskpd').combogrid('getValue');
        var cmlokasi    = document.getElementById('mlokasi').value;
        var nm  	= document.getElementById('nm').value;
        var nmrek  	= document.getElementById('nmrek').value;
        var mrk  = document.getElementById('merek').value;
        var cthn = $('#tahun').combobox('getValue');
        var jml  = document.getElementById('jml').value;
        var hrg  = angka(document.getElementById('hrg').value);
        var tot  = angka(document.getElementById('tot').value);
        var ket  = document.getElementById('kete').value;
        var total  = angka(document.getElementById('total2').value);
        
     //*********************** Simpan ke table trd_trmbrg *************************************************************************************//
			//alert(bap+"','"+no+"','"+kd+"','"+cmlokasi+"','"+cuskpd+"','"+nm+"','"+mrk+"','"+cthn+"','"+jml+"','"+hrg+"','"+tot+"','"+ket);
                 csql = " values('"+bap+"','"+no+"','"+kd+"','"+cmlokasi+"','"+cuskpd+"','"+nm+"','"+mrk+"','"+cthn+"','"+jml+"','"+hrg+"','"+tot+"','"+ket+"')";
		$.ajax({
            type: 'POST',
            data: ({sql:csql,nomor:no,skpd:cuskpd}),
            url:"<?php echo base_url(); ?>index.php/transaksi/save_trmbrg",
			success:function(data){
             var lctot = data; //alert(lctot);
             $('#total').attr('value',lctot);
             $('#total2').attr('value',lctot);
			}
          });
        
     //*************************************************************************************************************************//   
                            
         if (jns != '' && kd != '' && jml != '' && hrg != ''){        
            if (updt == 'f') {
                $('#trd').edatagrid('appendRow',{no_bap:no,kd_brg:kd,nm_brg:nm,merek:mrk,jumlah:jml,harga:hrg,total:tot,ket:ket});
                $('#trd2').edatagrid('appendRow',{no_bap:no,kd_brg:kd,nm_brg:nm,merek:mrk,jumlah:jml,harga:hrg,total:tot,ket:ket});
                a = total + angka(tot);                
            } else {
                $('#trd').edatagrid('updateRow',{index:idx2,row:{no_bap:no,kd_brg:kd,nm_brg:nm,merek:mrk,jumlah:jml,harga:hrg,total:tot,ket:ket}});
                $('#trd2').edatagrid('updateRow',{index:idx2,row:{no_bap:no,kd_brg:kd,nm_brg:nm,merek:mrk,jumlah:jml,harga:hrg,total:tot,ket:ket}});                        
                s = total - angka(total2);
                a = s + angka(tot);
            }
            updt = 'f';
            total = number_format(a,2,'.',',');
            $('#total').attr('value',total);
            $('#total2').attr('value',total);                                    
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
         
        var cbaterima   = document.getElementById('baterima').value;
        var cthn        = $('#tahun').combobox('getValue');
        var ctglterima  = $('#tglterima').datebox('getValue');
        var cuskpd      = $('#uskpd').combogrid('getValue');
        var cmlokasi    = document.getElementById('mlokasi').value; 
        var cnmuskpd    = document.getElementById('nmuskpd').value;
        var cno         = document.getElementById('nomor').value;
        var csampai     = document.getElementById('sampaikan').value;
        var cpriksa     = document.getElementById('priksa').value;
        var cterima     = document.getElementById('terima').value;
        var ctglpriksa  = $('#tglpriksa').datebox('getValue');
        var cket        = document.getElementById('ket').value;
        var cnofak      = document.getElementById('nofak').value;
        var ctglfak     = $('#tglfak').datebox('getValue') ; 
        var ctotal      = angka(document.getElementById('total').value);           
          
        if (cno==''){
		sweetAlert("MAAF..!!", "Nomor Dokumen mohon diisi", "error");
            exit();
        } 
        if (ctglterima==''){
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
       
        $(document).ready(function(){
            $.ajax({
                type: "POST",       
                dataType : 'json',         
                data: ({tabel:'trh_terimabrg',batrm:cbaterima,tahun:cthn,tgltrm:ctglterima,lokasi:cmlokasi,uskpd:cuskpd,nmuskpd:cnmuskpd,nodok:cno,nip1:csampai,nopriksa:cpriksa,nip2:cterima,tglpriksa:ctglpriksa,ket:cket,nofak:cnofak,tglfak:ctglfak,total:ctotal}),
                url: '<?php echo base_url(); ?>index.php/transaksi/simpan_trmbrg',
                success:function(data){
                   status = data.pesan;       
                    if (status == '0'){
                       alert('Gagal Simpan...!!');
                       exit();
                   } else {                                                           
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
    
     function hapus(){
        var cnobap = document.getElementById('nomor').value;
        var cunit = document.getElementById('mlokasi').value;
        var tny = confirm('Yakin Ingin Menghapus Data, Nomor Dokumen : '+cnobap);        
        if (tny==true){
        var urll = '<?php echo base_url(); ?>index.php/transaksi/hapus_trmbrg';
        $(document).ready(function(){
        $.ajax({url:urll,
                 dataType:'json',
                 type: "POST",    
                 data:({no:cnobap,unit:cunit}),
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
        var cnomor = document.getElementById('nomor').value; 
        var cunit = document.getElementById('mlokasi').value; 
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
            
            $.ajax({
                type: 'POST',
                data: ({nomor:cnomor,kd:ckd,ctotal:total,unit:cunit}),
                url:"<?php echo base_url(); ?>index.php/transaksi/hps_trd_trmbrg"
            });
            
            $('#total2').attr('value',number_format(total,2,'.',','));
            $('#total').attr('value',number_format(total,2,'.',','));                                
            kosong2();
        }                     
    }
		 
	function max_rinci(){  
	var organisasi = $('#uskpd').combogrid('getValue'); 
		$.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>index.php/transaksi/load_idmax',
            data: ({skpd:organisasi,table:'trh_terimabrg',kolom:'no_dokumen',kolom_skpd:'kd_uskpd'}),
            dataType:"json",
            success:function(data){                                          
                $.each(data,function(i,n){                                    
                    no		      = n['kode']; //alert(no);
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
		<p><h3 align="center">PENERIMAAN BARANG</h3></p>
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
        <br /><br />
        <table>
             <tr>
                <td height="30px">No.B.A Penerimaan</td>
                <td>:</td>
                <td><input type="text" id="baterima" style="width: 200px;" onclick="javascript:select();" placeholder="*isi No. Penerimaan jika ada"/></td>
                <td width="70px"></td>
                <td>Tahun</td>
                <td>:</td>
                <td><input type="text" id="tahun" style="width: 140px;" /></td>     
            </tr>
            <tr>
                <td height="30px">Tanggal Terima</td>
                <td>:</td>
                <td><input type="text" id="tglterima" style="width: 140px;" /></td> 
                <td width="70px"></td>   
                <td>Kode Unit</td>
                <td>:</td>
                <td><input type="text" id="uskpd" style="width: 140px;" onclick="javascript:select();" /></td>
            </tr>
            <tr>
                <td height="30px">No Dokumen</td>
                <td>:</td>
                <td><input type="text" id="nomor" style="width: 200px;"/></td>
                <td width="70px"></td>
                <td>Nama SKPD</td>
                <td>:</td>
                 <td>
				 <input type="text" id="nmuskpd" style="border:0;width: 400px;" readonly="true"/>
				 <input type="text" id="mlokasi" style="border:0;width: 400px;" readonly="true"/>
				 </td> 
            </tr>
            <tr>
                <td height="30px">No.B.A Pemeriksaan</td>
                <td>:</td>
                <td><input type="text" id="priksa" style="width: 200px;" onclick="javascript:select();"  placeholder="*isi No. Pemeriksaan jika ada"/></td>
                <td width="70px"></td>
                <td>Disampaikan oleh</td>
                <td>:</td>
                <td><input type="txt" id="sampaikan" style="width: 200px;" placeholder="*isi nama penyalur jika ada"/></td>   
            </tr>
            <tr>
                <td height="30px">Tanggal Pemeriksaan</td>
                <td>:</td>
                <td><input id="tglpriksa" name="tglpriksa" style="width: 140px;" /></td>
                <td width="70px"></td>
                <td>Diterima oleh</td>
                <td>:</td>
                <td><input type="text" id="terima" style="width: 200px;"  placeholder="*isi nama penyimpan jika ada"/></td>                                 
            </tr> 
            <tr>
                <td>No Faktur</td>
                <td>:</td>
                <td><input type="text" id="nofak" style="width: 200px;" value="" placeholder="*no.faktur/no.kwitansi/no.nota, etc"/>  </td> 
                <td></td>
                <td>Keterangan</td> 
                <td>:</td>
                <td colspan="2"><textarea rows="2" cols="50" id="ket" style="width: 400px;" placeholder="*keterangan dari transaksi,etc"></textarea>             
            </tr>              
            <tr>
                <td>Tanggal Faktur</td>
                <td>:</td>
                <td><input id="tglfak" name="tglfak" style="width: 140px;" value=""/>  </td>            
            </tr>                            
        </table>  
        <br />
        <!--div align="center">
        	<a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:kosong();">Tambah</a>
            <a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:simpan();">Simpan</a>   		  
            <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:section1();">Kembali</a>          
        </div-->
        <br /> 
        <fieldset>
         <div id="toolbar" align="center" >
    		<a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:tambah_detail();"><b>Tambah/Edit Barang</b></a>   		                            		
        </div>
        </fieldset><br/>
        <table  id="trd" title="Detail Barang" style="width:940px;height:300px;" >  
        </table>       
        <div align="right">Total : <input type="text" id="total" style="text-align: right;border:0;width: 200px;font-size: large;" readonly="true"/></div>        
        <br/>
        <div align="center">
		<fieldset>
		<INPUT TYPE="button" VALUE="SIMPAN" style="height:40px;width:100px" onclick="javascript:simpan();" >
		<INPUT TYPE="button" VALUE="KEMBALI" style="height:40px;width:100px" onclick="javascript:section1();" >
        </fieldset>
		</div> 
    </div>  
</div>

<div id="dialog-modal" title="Input Barang" >
    <p class="validateTips" >Semua Inputan Harus Di Isi.</p> 
    <fieldset>      
        <table>      
            <tr>
                <td>Jenis Barang</td>
                <td>:</td>
                <td><input id="jenis" name="jenis" value=""/> </td>
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
                <td width="150"><input id="kd" name="kd" value=""/>  </td>                            
            </tr>       
            <tr>
                <td>Nama barang</td>
                <td>:</td>
                <td><input id="nm" name="nm" value="" readonly="true" style="border:0;"/>  </td>            
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
                <td><textarea id="kete" name="kete" value="" style="width: 155px; height: 60px;"></textarea> </td>            
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

