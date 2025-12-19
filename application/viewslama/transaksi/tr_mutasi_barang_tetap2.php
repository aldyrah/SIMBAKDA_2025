<script src="<?php echo base_url(); ?>lib/sweet-alert.min.js"></script>
<link   rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>lib/sweet-alert.css">
<script type="text/javascript" src="<?php echo base_url(); ?>easyui/autoCurrency.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>easyui/currencyFields.js"></script>
<script type="text/javascript">
    
    var updt = 'f';
    var idx2 = '';
    var total2 = 0;
	 $(document).ready(function() {
          $("#dialog-modal").dialog({
            height: 400,
            width: 600,
            modal: true, 
            background:'#2da305',           
            autoOpen:false                
          });                       
     }); 
    $(function(){ 
	$('#trd').edatagrid({
            url: '<?php echo base_url(); ?>index.php/transaksi/ambil_listmutasi',
            //queryParams:({skpd:cuskpd}),
            rownumbers:true, 
            fitColumns:false,
            singleSelect:false,
			pagination:"true",
			columns:[[
                    {field:'no_mutasi',title:'ID ',width:60,align:"center",hidden:true},
                    {field:'id_barang',title:'ID ',width:60,align:"center",hidden:true},
                    {field:'kd_unit',title:'A',width:60,align:"center",hidden:true},
                    {field:'kd_unitb',title:'B',width:60,align:"center",hidden:true},
                    {field:'kd_skpdb',title:'B',width:60,align:"center",hidden:true},
					{field:'tahun',title:'tahun',width:60,align:"center",hidden:true},					
					{field:'kondisi',title:'kds',width:60,align:"center",hidden:true},
                    {field:'no',title:'ck',width:30,checkbox:true},   
                    {field:'no_reg',title:'NO REG ',width:60,align:"center"},
                    {field:'kd_brg',title:'KODE BARANG',width:110,align:"center"},
                    {field:'nm_brg',title:'NAMA BARANG',width:320,align:"left"},
                    {field:'asal',title:'ASAL',width:200,align:"left"},
                    {field:'tujuan',title:'TUJUAN',width:200,align:"left"},
                    {field:'harga_awal',title:'HARGA',width:180,align:"right"},  
                    {field:'keterangan',title:'KET',width:300,align:"left"}      
                ]],   
                onDblClickRow:function(rowIndex,rowData){ 
				$('#reg').attr('value',rowData.no_reg);	
				$('#kd').attr('value',rowData.kd_brg);
				$('#nm').attr('value',rowData.nm_brg); 
				$('#id_brg').attr('value',rowData.id_barang);	
				$('#thn').attr('value',rowData.tahun);	
				$('#kds').attr('value',rowData.kondisi);
				$('#skpd_awal').attr('value',rowData.asal);
				$('#skpd_tujuan').attr('value',rowData.tujuan);
				$('#ket').attr('value',rowData.keterangan);
				$('#tgl_usul').datebox('setValue',rowData.tgl_mutasi);	
				$('#hrg').attr('value',number_format(rowData.harga_awal));
				$("#dialog-modal").dialog('open'); 
                }
        });

	
        $('#trd').edatagrid({    		   
            rownumbers:"true",           
            toolbar:'#toolbar',
            loadMsg:"Load Barang....!!",            
            nowrap:"true"
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
		 
        $('#tgl_usul').datebox({  
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
            idField:'kd_uskpd',  
            textField:'kd_uskpd',  
            mode:'remote',                      
            url:'<?php echo base_url(); ?>index.php/master/ambil_ubidskpd',  
            columns:[[  
               {field:'kd_uskpd',title:'Kode Unit',width:100},  
               {field:'nm_uskpd',title:'Nama Unit',width:700}    
            ]],  
            onSelect:function(rowIndex,rowData){
               cuskpd = rowData.kd_uskpd;               
               $('#nmuskpd').attr('value',rowData.nm_uskpd);    
                load_kib(cuskpd);  
				
            } 
         });  
          
                $('#tgl_reg').datebox({  
                    required:true,
                    formatter :function(date){
                  	var y = date.getFullYear();
                   	var m = date.getMonth()+1;
                   	var d = date.getDate();    
                   	return y+'-'+m+'-'+d;
                    }
                });
                
                $('#uskpdb').combogrid({  
                    panelWidth:500,  
                    idField:'kd_skpd',  
                    textField:'kd_skpd',  
                    mode:'remote',                      
                    url:'<?php echo base_url(); ?>index.php/master/ambil_skpd',  
                    columns:[[  
                       {field:'kd_skpd',title:'Kode Unit',width:80},  
                       {field:'nm_skpd',title:'Nama Unit',width:400}    
                    ]],  
                    onSelect:function(rowIndex,rowData){
                       cuskpd = rowData.kd_skpd;               
                       $('#nmuskpdb').attr('value',rowData.nm_skpd);    
                    } 
                 });   
    });
    
/*     function load_kib(cuskpd){
		var i 		= 0;
        var cuskpd 	= cuskpd;
		//var cuskpd  = $('#uskpd').combogrid('getValue');
		//var cari 	= document.getElementById('cari_brg');
        $('#trd').edatagrid({
            url: '<?php echo base_url(); ?>index.php/transaksi/ambil_listmutasi',
            queryParams:({skpd:cuskpd}),
            rownumbers:true, 
            fitColumns:false,
            singleSelect:false,
			pagination:"true",
			columns:[[
                    {field:'no_mutasi',title:'ID ',width:60,align:"center",hidden:true},
                    {field:'id_barang',title:'ID ',width:60,align:"center",hidden:true},
                    {field:'kd_unit',title:'A',width:60,align:"center",hidden:true},
                    {field:'kd_unitb',title:'B',width:60,align:"center",hidden:true},
                    {field:'kd_skpdb',title:'B',width:60,align:"center",hidden:true},
					{field:'tahun',title:'tahun',width:60,align:"center",hidden:true},					
					{field:'kondisi',title:'kds',width:60,align:"center",hidden:true},
                    {field:'no',title:'ck',width:30,checkbox:true},   
                    {field:'no_reg',title:'NO REG ',width:60,align:"center"},
                    {field:'kd_brg',title:'KODE BARANG',width:110,align:"center"},
                    {field:'nm_brg',title:'NAMA BARANG',width:320,align:"left"},
                    {field:'asal',title:'ASAL',width:200,align:"left"},
                    {field:'tujuan',title:'TUJUAN',width:200,align:"left"},
                    {field:'harga_awal',title:'HARGA',width:180,align:"right"},  
                    {field:'keterangan',title:'KET',width:300,align:"left"}      
                ]]
        }); 
    } */
	
    function simpan(){
      /*   var id_brg     = document.getElementById('id_brg').value; 
		var cno_urut   = document.getElementById('no_urut').value;
        var	ctgl_muts  = $('#tanggal').datebox('getValue');
        var	cno_reg    = document.getElementById('reg').value;
        var	ckd_brg    = document.getElementById('kd').value; 
        var cuskpdb    = $('#uskpdb').combobox('getValue');
        var	ckondisi   = document.getElementById('kds').value;
        var	cuskpd     = $('#uskpd').combobox('getValue');
        var	cthn       = document.getElementById('thn').value;
        var	chrg       = angka(document.getElementById('hrg').value);
        var	cket       = document.getElementById('ket').value;
        var gol        = cgol; 
        var cno_muts   = cuskpd+"."+cuskpdb+"."+cthn+"."+cno_reg+"."+cno_urut;*/
		var rows   	= $('#trd').datagrid('getSelected');
        cnom 		= rows.no_mutasi; 
        cid 		= rows.id_barang; 
        cuni 		= rows.kd_unit; 
        ckdu 		= rows.kd_unitb; 
        csku 		= rows.kd_skpdb; 
        creg 		= rows.no_reg; 
        ckd 	   	= rows.kd_brg;
        cnm        	= rows.nm_brg; 
        ctuju      	= rows.tujuan;
        cnilai     	= rows.harga_awal; 
        cket      	= rows.keterangan;
        cthn 	   	= rows.tahun;
        ckds 	   	= rows.kondisi;
        asal 	   	= rows.asal;
        tujuan 	   	= rows.tujuan;
		ckode		= ckd.slice(0,2);
        var	ctgl_muts  = $('#tanggal').datebox('getValue');
        var cuskpd     = $('#uskpd').combobox('getValue');
        if (ctgl_muts == ''){
            alert('Tanggal Penetepan Mutasi Tidak Boleh Kosong');
            exit();              
        } 
		
    var r = confirm("Apakah Anda Yakin ingin Mutasi: "+cnm+" dari "+asal+" ke "+tujuan+" ??");
	
    if(r==true){
         $(document).ready(function(){
            $.ajax({
                type: "POST",       
                dataType : 'json',         
                data: ({cnom:cnom,cid:cid,cuni:cuni,ckdu:ckdu,csku:csku,cuskpd:cuskpd,creg:creg,ckd:ckd,cnm:cnm,ctuju:ctuju,cnilai:cnilai,cket:cket,ckode:ckode,ctgl_muts:ctgl_muts,cthn:cthn,ckds:ckds}),
                url: '<?php echo base_url(); ?>index.php/transaksi/simpan_mts_adm',
                success:function(data){
                status = data.pesan;   
                    if (status=='1'){               
                    swal({
					title: "Success!",
					text: "Data Berhasil Dimutasi.!!",
					type: "success",
					confirmButtonText: "OK"
					});
					$('#trd').datagrid('reload');
					exit();
                    } else{ 
					swal({
					title: "Error!",
					text: "Gagal Tersimpan.!!",
					type: "error",
					confirmButtonText: "OK"
					});
					exit();
                    }                                                                                                                                       
                }
            });
       });
		}
     }
	 
   function keluar(){
        $("#dialog-modal").dialog('close');
    }      

	function hapus(){
		var rows   	= $('#trd').datagrid('getSelected');
        ca 		= rows.kd_unit; 
        cb 		= rows.kd_unitb; 
        cc 		= rows.kd_brg; 
        cd 		= rows.nm_brg; 
        ce 		= rows.asal;
        cf 		= rows.tujuan;
		if (ca !=''){
		var del=confirm('Apakah Anda yakin ingin Menolak Usulan Mutasi '+ce+' dengan aset '+cd+' ke '+cf+'?');
		if (del==true){
        var urll = '<?php echo base_url(); ?>index.php/master/hapus_master_lengkap';
        $(document).ready(function(){
         $.post(urll,({tabel:'mutasi_brg',cid:'kd_unit',cnid:ca,cid2:'kd_unitb',cnid2:cb,cid3:'kd_brg',cnid3:cc}),
		 function(data){
         /*    status = data;
            if (status=='0'){
                alert('Gagal Hapus..!!');
                exit();
            } else { */
                $('#trd').datagrid('reload');
					swal({
					title: "Error!",
					text: "Usulan Mutasi Ditolak.!!",
					type: "error",
					confirmButtonText: "OK"
					});
					exit();
            //}
         });
        });    
		}}
    } 
	
function cari(){ 
    var kriteria = document.getElementById("cari_brg").value; 
    $(function(){
     $('#trd').edatagrid({
		url: '<?php echo base_url(); ?>index.php/transaksi/ambil_listmutasi',
        queryParams:({cari:kriteria})
        });        
     });
    }
    
   </script>

<div id="isi">
<p><h3 align="center">.: PENETAPAN MUTASI BARANG :.</h3></p>
    <div id="isian">  
	
        <table>
            <tr hidden="true">
                <td height="30px">KODE UNIT</td>
                <td>:</td>
                <td><input hidden="true" id="uskpd" name="uskpd" style="width: 160px;" /> <input type="text" id="nmuskpd" style="border:0;width: 300px;" readonly="true"/></td>
                                       
            </tr>
          </table>
		<table>
		<tr>
			<td>TGL PENETAPAN MUTASI</td>
			<td>:</td>
			<td><input type="text" id="tanggal" style="width: 140px;" /></td> 
			<td></td>				
			<td ><input placeholder="*cari nama barang/asal/tujuan" type="text" value="" id="cari_brg" style="width: 250px;" /></td>  
			<td > 
			<a class="easyui-linkbutton" iconCls="icon-file_search" plain="true" onclick="javascript:cari();" ></a>
			</td>
		</tr>
        </table>  
        <br /> 
        <table  id="trd" style="width:940px;height:300px;" ></table> 
        <br /> 
		<table> 
		<tr>
		<td align="right">		
        <div align="right" style="width: 200px;"> <a class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="javascript:hapus()">TOLAK MUTASI</a></div>		
        </td>
		<td align="right">
		<div align="right" style="width: 200px;"> <a class="easyui-linkbutton" iconCls="icon-ok" plain="true" onclick="javascript:simpan()">TETAPKAN MUTASI</a></div>
        </td>
		</tr>
		</table>
		<div id="toolbar" align="center" >
    		<a><b>DAFTAR BARANG PENETAPAN MUTASI</b></a>  
        </div>
    </div>  
</div>
<div id="dialog-modal" title="Detail Usulan Mutasi" >
    <fieldset>      
        <table > 
            <tr>
                <td>No Reg</td>
                <td>:</td>
                <td><input id="reg" name="reg" readonly="true" style="text-align: left;border:0;" />  </td>  
            </tr>         
            <tr>
                <td>Nama Aset</td>
                <td>:</td>
                <td><input id="kd" name="kd" readonly="true" style="text-align: left;border:0;" />  </td>  
            </tr>   
            <tr>
                <td>Tahun</td>
                <td>:</td>
                <td><input id="thn" name="thn" readonly="true" style="text-align: left;border:0;" />  </td>            
            </tr> 
            
            <tr>
                <td>Kondisi</td>
                <td>:</td>
                <td><input id="kds" name="kds" readonly="true" style="text-align: left;border:0;" />  </td>            
            </tr>  
            <tr>
                <td>Harga</td>
                <td>:</td>
                <td><input id="hrg" name="hrg" value="" style="text-align: right;border:0;" readonly="true" />  </td>            
            </tr>  
            <tr>
                <td>Keterangan</td>
                <td>:</td>
                <td><textarea id="ket" style="text-align: left;border:0;" readonly="true"></textarea> </td>            
            </tr>       
            <tr>
                <td>Tanggal Diusulkan</td>
                <td>:</td>
                <td><input id="tgl_usul" name="tgl_usul" value="" readonly="true" style="text-align: right;border:0;" />  </td>            
            </tr>     
            <tr>
                <td>SKPD Pemilik</td>
                <td>:</td>
                <td><input id="skpd_awal" name="skpd_awal" readonly="true" style="width: 300px; text-align: left;border:0;" />  </td>   
            </tr>        
            <tr>
                <td>SKPD Tujuan</td>
                <td>:</td>
                <td><input id="skpd_tujuan" name="skpd_tujuan" value="" readonly="true" style="width: 300px;text-align: left;border:0;" />  </td>            
            </tr> 
        </table>            
    </fieldset>  
    <fieldset>
        <table align="center">
            <tr>
                <td>
                    <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">OK</a>                               
                </td>
            </tr>
        </table>   
    </fieldset>
</div>
