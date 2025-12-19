<script src="<?php echo base_url(); ?>lib/sweet-alert.min.js"></script>
<link   rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>lib/sweet-alert.css">
<script type="text/javascript" src="<?php echo base_url(); ?>easyui/autoCurrency.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>easyui/currencyFields.js"></script>
<script type="text/javascript">
    
    var updt = 'f';
    var idx2 = '';
    var total2 = 0;
    
     $(document).ready(function() {
          $("#tabs").tabs();
          $("#dialog-modal").dialog({
            height: 470,
            width: 600,
            modal: true, 
            background:'#2da305',           
            autoOpen:false                
          });  
		  $( "#dialog-foto" ).dialog({
            height: 500,
            width: 450,
            modal: true,
            autoOpen:false
        });                      
     });    
     
    $(function(){
		$('#trh').edatagrid({
		url: '<?php echo base_url(); ?>index.php/transaksi/ambil_listhapus',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Load Barang....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
        	    {field:'id_barang',title:'Nomor Dokumen',width:40,hidden:true},
                {field:'no_reg',title:'Register',width:7},
                {field:'kd_brg',title:'Kode',width:9},
        	    {field:'nm_brg',title:'Nama Barang',width:20},
				{field:'keterangan',title:'ALASAN DIHAPUS',width:20,align:"left",	
					editor:{type:'combobox',
					options:{ valueField:'alasan',
							  textField:'alasan',
							  panelwidth:40,	
							  panelheigth:20,
							  url :'<?php echo base_url(); ?>/index.php/master/malasan',	
							  required:false									  
							}
					}}
					]],
		onAfterEdit:function(rowIndex, rowData, changes){	
				id_barang	= rowData.id_barang;
				no_reg	    = rowData.no_reg;
				kd_brg	    = rowData.kd_brg;
				nm_brg	    = rowData.nm_brg;
				keterangan  = rowData.keterangan;
				simpan(id_barang,no_reg,kd_brg,nm_brg,keterangan);
		}, 
        onSelect:function(rowIndex,rowData){
                id_barang    = rowData.id_barang;
                no_reg       = rowData.no_reg;
                kd_brg       = rowData.kd_brg;
                nm_brg  	 = rowData.nm_brg;
                keterangan   = rowData.keterangan;
                foto		 = rowData.foto; 
				cokot(foto,'1');
				foto();
                get(id_barang,no_reg,kd_brg,nm_brg,keterangan,foto);
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
        
   /*       $('#uskpd').combogrid({  
            panelWidth:600,  
            idField:'kd_skpd',  
            textField:'kd_skpd',  
            mode:'remote',                      
            url:'<?php echo base_url(); ?>index.php/master/ambil_msskpd',  
            columns:[[  
               {field:'kd_skpd',title:'Kode Unit',width:100},  
               {field:'nm_skpd',title:'Nama Unit',width:590}    
            ]],  
            onSelect:function(rowIndex,rowData){
               cuskpd = rowData.kd_skpd;               
               $('#nmuskpd').attr('value',rowData.nm_skpd);    
               
                                          
            } 
         });  */ 
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
            } 
         });  
        
        $('#kib').combogrid({  
            panelWidth:400,  
            width:160,
            idField:'golongan',  
            textField:'golongan',  
            mode:'remote',                                  
            url:'<?php echo base_url(); ?>index.php/master/ambil_gol',  
            columns:[[  
               {field:'golongan',title:'Kode Golongan',width:100},  
               {field:'nm_golongan',title:'Nama Golongan',width:290}    
            ]],  
            onSelect:function(rowIndex,rowData){ 
              cgol = rowData.golongan;   
              cnm_gol = rowData.nm_golongan;  
              $('#nmgol').attr('value',cnm_gol);                                    
              load_kib(cgol);     
              nomer_akhir(cgol);       
            } 
        }); 
		
				 $('#tanggal').datebox('setValue','<?php echo date('y-m-d')?>');	
	
    });
    
	//function get(id_barang,no_reg,kd_brg,nm_brg,keterangan,foto){
    //$("#gambar1").attr("value",foto);
	//}
	
    function section1(){        
        $('#tabs1').click();   
        set_grid();                                                     
    }
	
	function simpan(id_barang,no_reg,kd_brg,nm_brg,keterangan){
				
		$(document).ready(function(){
			$.ajax({
				type: "POST",
				url: '<?php echo base_url(); ?>/index.php/master/simpan_malasan',
				data: ({id:id_barang,ket:keterangan,kode:kd_brg}),
				dataType:"json"
			});
		});                                  
		$('#trh').datagrid('reload');      
    } 
    
	function loadtab(){
       // var cuskpd = $('#uskpd').combogrid('getValue');
		$('#trh').edatagrid({
		url: '<?php echo base_url(); ?>index.php/transaksi/ambil_listhapus',
        //queryParams:({kdskpd:cuskpd}),
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Load Barang....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
        	    {field:'id_barang',title:'Nomor Dokumen',width:40,hidden:true},
                {field:'kd_brg',title:'Kode',width:9},
                {field:'no_reg',title:'Register',width:7},
        	    {field:'nm_brg',title:'Nama Barang',width:25},
				{field:'keterangan',title:'ALASAN DIHAPUS',width:30,align:"left",	
					editor:{type:'combobox',
					options:{ valueField:'alasan',
							  textField:'alasan',
							  panelwidth:40,	
							  panelheigth:20,
							  url :'<?php echo base_url(); ?>/index.php/master/malasan',	
							  required:false									  
							}
					}},
				{field:'foto',title:'Foto',width:2,align:'center',
				formatter:function(value,rec)
				{ return "<img src='<?php echo base_url(); ?>/public/images/img.png' onclick='javascript:foto();'' />";}}
					]]	
        });
	}
	
	   function nomer_akhir(cgol){
        var i 		= 0; 
        var gol		= cgol; 
		if(gol=='01'){
        var tabel 	='trhapus_a'
		}if(gol=='02'){
        var tabel 	='trhapus_b'
		}if(gol=='03'){
        var tabel 	='trhapus_c'
		}if(gol=='04'){
        var tabel 	='trhapus_d'
		}if(gol=='05'){
        var tabel 	='trhapus_e'
		}if(gol=='06'){
        var tabel 	='trhapus_f'
		} 
        var kd_unit	= $('#uskpd').combogrid('getValue');
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>index.php/transaksi/nomor',
            data: ({tabel:tabel,kd_unit:kd_unit}),
            dataType:"json",
            success:function(data){                                          
                $.each(data,function(i,n){                                    
                    nom      = n['urut'];  
					nomorku	= tambah_urut(nom,4);
                    //no_reg   = n['no_reg'];  
                    $("#nomor").attr("value",nomorku);
                    //$("#no_reg").attr("value",no_reg); 
                    //$("#tanggal").datebox("setValue",tanggal);                         
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
	
    function section2(){            
        $('#tabs2').click();
		loadtab();
		$('#trh').datagrid('reload');
        set_grid();                                                        
    }  
    
    function load_kib(cgol){
        var i = 0;
        var ngol 	= cgol;
        var cuskpd  = $('#uskpd').combogrid('getValue');
		var cari 	= document.getElementById('cari_brg');
        $('#trd').edatagrid({
            url: '<?php echo base_url(); ?>index.php/transaksi/ambil_kib',
            queryParams:({kdskpd:cuskpd,gol:ngol}),
            rownumbers:true, 
            fitColumns:false,
            singleSelect:false,
			pagination:"true",
		    columns:[[
 		            {field:'id_barang',title:'Nomor Dokumen',width:100,hidden:true},
 		            {field:'no_dokumen',title:'Nomor Dokumen',width:100,hidden:true},
                    {field:'no_reg',title:'No. Reg ',width:70,align:"center"},
                    {field:'kd_brg',title:'Kode Barang',width:100},
                    {field:'nm_brg',title:'Nama Barang',width:270},
                    {field:'tgl_reg',title:'Tanggal',width:100,align:"center"},
                    {field:'kondisi',title:'Kondisi',width:70,align:"center"},
                    {field:'tahun',title:'Tahun',width:70,align:"center"},
                    {field:'nilai',title:'Harga',width:180,align:"right"},   
                    {field:'no',title:'ck',width:30,checkbox:true}   
				]]	
			});
    }
	
    function  cokot(foto,lc){
         var lcfoto = 'foto'+lc;
         document.getElementById(lcfoto).src = "<?php echo base_url(); ?>data/"+foto;
    }   
	
	function gambar(lf){
        lcfoto = 'foto'+lf;
        document.getElementById("fotoZ").src =  document.getElementById(lcfoto).src;
        $("#dialog-modal_gambar").dialog('open');             
    }
	
	 function ajaxFileUpload(lc)
	{
        var lcno = 'gambar'+lc;
        var lcupload = 'fileToUpload'+lc;
		var cfile = document.getElementById(lcupload).files[0];
		//$("#gambar").attr("value",cfile.name);
		document.getElementById(lcno).value = cfile.name;
        cokot(cfile.name,lc);
		$("#loading").show();
		/*.ajaxStart(function(){
			$(this).show();
		})
		.ajaxComplete(function(){
			$(this).hide();
		});
		*/
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
	
   function foto(){ 
        judul = 'Upload Foto Barang';
        $("#dialog-foto").dialog({ title: judul });
        $("#dialog-foto").dialog('open');
		} 
	
	function kel(){
		$("#dialog-foto").dialog('close');
	}
  
 function load_save(){ 
    var lctgl  = $('#tanggal').datebox('getValue');
    var nohps  = document.getElementById('nomor').value;
    var skpd   = $('#uskpd').combogrid('getValue');
	
    if (nohps == ''){
         alert('No Hapus Tidak Boleh Kosong');
         exit();              
     } 
    if (lctgl == ''){
         alert('Tanggal Hapus Tidak Boleh Kosong');
         exit();              
     }
    
		var ids = []; 
		var idfa = [];  
        var idsa = [];
        var idsb = [];
        var idsc = [];
        var idsd = [];
        var idse = [];
        var idsf = [];
        var idsg = [];
        var idsh = [];
        
		var rows = $('#trd').edatagrid('getSelections'); 
		for( i=0; i < rows.length; i++){ 
		    ids.push(rows[i].no);
            idfa.push(rows[i].id_barang);
            idsa.push(rows[i].no_dokumen);
            idsb.push(rows[i].no_reg);
            idsc.push(rows[i].kd_brg);
            idsd.push(rows[i].nm_brg);            
            idse.push(rows[i].tgl_reg);
            idsf.push(rows[i].kondisi);
            idsg.push(rows[i].tahun);
            idsh.push(rows[i].nilai);
		}
        
     cno      =(ids.join('||'));    
     cidbar   =(idfa.join('||'));     
     cnodoc   =(idsa.join('||'));
	 cnoreg   =(idsb.join('||'));
     ckdbrg   =(idsc.join('||'));
     cnmbrg   =(idsd.join('||'));
     ctglreg  =(idse.join('||'));
     ckds     =(idsf.join('||'));
     cthn     =(idsg.join('||'));
     chrg     =(idsh.join('||'));
	 
   //alert(cidbar+cno+cnodoc+cnoreg+ckdbrg+cnmbrg+ctglreg+ckds+cthn+chrg);
    if (cno == ''){
         alert('Barang Yang Akan dihapus Belum Dipilih');
         exit();              
     }
    var r = confirm("Yakin ingin menghapus: "+ckdbrg+" ?");
     
    if(r==true){
         
         $.ajax({
            type: 'POST',
            data: ({id_barang:cidbar,uskpd:skpd,tgl:lctgl,no:cno,uskpd:skpd,no:cno,no_dokumen:nohps,no_reg:cnoreg,kd_brg:ckdbrg,nm_brg:cnmbrg,tgl_reg:ctglreg,kondisi:ckds,tahun:cthn,harga:chrg}),
            dataType:"json",
            url:"<?php echo base_url(); ?>index.php/transaksi/hapus_kib",
			success:function(data){ 
			swal({
				title: "Data Telah Diusulkan Dihapus!",
				type: "info",
				confirmButtonText: "OK"
				});
			}
         });
    }
    cgol = $('#kib').combogrid('getValue');                              
    load_kib(cgol);   
    
}

 function cari(){
 
    var gol 	= $('#kib').combogrid('getValue');
    var kdskpd 	= $('#uskpd').combogrid('getValue');
    var kriteria = document.getElementById("cari_brg").value; 
    $(function(){
     $('#trd').edatagrid({
		url: '<?php echo base_url(); ?>index.php/transaksi/ambil_kib',
        queryParams:({gol:gol,kdskpd:kdskpd,cari:kriteria})
        });        
     });
    }
    
</script>


<div id="tabs" >
		<p><h3 align="center">PENGHAPUSAN BARANG</h3></p>
    <ul style="background-color:#2da305;">
        <li><a href="#tabs-1" style="width: 452px;" id="tabs1">Form Penghapusan Barang</a></li>
        <li><a href="#tabs-2" style="width: 452px;" id="tabs2" onclick="javascript:loadtab();">List View</a></li>        
    </ul>
    <div id="tabs-2">
        <div>
            <p align="right">
                <a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:kosong();section2();">Tambah</a>               
                <a class="easyui-linkbutton" iconCls="icon-search" plain="true" >Cari</a>
                <input type="text" value="" id="txtcari" onkeypress="javascript:load_kib();"/>             
                <table  id="trh" title="List Dokumen" style="width:940px;height:400px;" >  
                </table>                
            </p>
        </div>
    </div>
    <div id="tabs-1">  
        <br /><br />
        <table>
            <tr>
                <td width= "150px">No. Hapus</td>
                <td>:</td>
                <td><input placeholder="Auto Number" type="text" id="nomor" style="width: 150px;" onclick="javascript:select();" readonly="true" /></td>
                <td></td>
                <td width= "200px">Tanggal Hapus</td>
                <td>:</td>
                <td><input type="text" id="tanggal" style="width: 100px;" /></td>     
            </tr>
            <tr>
                <td width= "150px">Unit Kerja</td>
                <td>:</td>
                <td><input id="uskpd" name="uskpd" style="width: 150px;" /></td>
                <td></td>
                <td>Nama Unit Kerja</td> 
                <td>:</td>
                <td><input type="text" id="nmuskpd" style="border:0;width: 400px;" readonly="true"/></td>                                
            </tr>
            <tr>
                <td height="30px">Pilih KIB</td>
                <td>:</td>
                <td><input id="kib" name="kib" style="width: 240px;" /><input type="text" id="nmgol" style="border:0;width: 200px;" readonly="true"/></td>
            </tr>  
        </table> 
		<table>
			<tr>
			<td colspan="3"> 
           <input placeholder="*cari nama aset/tahun" type="text" value="" id="cari_brg" style="width: 300px;" />  
			<a  class="easyui-linkbutton" iconCls="icon-file_search" plain="true" onclick="javascript:cari();" >Cari</a>
			</td>
			</tr>  
        </table> 
        <br />
        <table  id="trd" title="Detail Barang" style="width:940px;height:300px;" >  
        </table>       
        <div align="right"><input type="text" id="total" style="text-align: right;border:0;width: 200px;font-size: large;" readonly="true"/></div>        
        <div align="center" style="width: 1600px;"> <a class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="javascript:load_save()">HAPUS BARANG</a></div>
        </table>
        <div id="toolbar" align="center" >
    		<a><b>PILIH KIB DIHAPUS</b></a>   		
        </div>
    </div>  
</div>

<div id="dialog-foto" title="">
     <table align="center" style="width:100%;" border="0">
	  <!--tr>
                            <td valign="top" width="12%">Gambar</td>
                            <td valign="top" width="3%">:</td>
                            <td width="85%"><input type="text" id="gambar1" name="gambar" style="width:200px;" disabled="disabled" />
                                <img id="loading" src="<?php echo base_url();?>public/images/loading.gif" style="display:none;">
                            	<input type="file" id="fileToUpload1" name="fileToUpload"/>
                                <input type="button" id="btnupload" value="Upload" onclick="return ajaxFileUpload('1');"  /></td>
                           
      </tr-->
	 
		   <tr>
				<td valign="top" width="40%"><input type="file" id="fileToUpload1" name="fileToUpload"/></td>
				<td width="20%">
					<img id="loading" src="<?php echo base_url();?>public/images/loading.gif" style="display:none;">
					<input type="button" id="btnupload" value="Upload" onclick="return ajaxFileUpload('1');"  /></td>
			   	<td valign="top" width="40%"><input type="text" id="gambar1" name="gambar" style="width:200px;" hidden="true" /></td>
		   </tr>
           <tr>
            <td colspan="3">&nbsp;</td>
           </tr> 
           <tr>
				<td align="center" colspan="3">
				<img style="width: 300px; height:340px;" id="fotoZ" alt="Tidak Ada Gambar"/>
				</td>
           </tr>
           <tr>
				<td align="center" colspan="3">
				<a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:kel();">Kembali</a>
				</td>                
           </tr>
     </table>  
</div>



