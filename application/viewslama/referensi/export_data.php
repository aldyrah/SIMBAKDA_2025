     
<style type="text/css"> 

input[type=submit] {
    background: linear-gradient(to bottom, #0088CC, #0044CC);
    border: 1px solid #0088CC;
    color: #FFF;
    margin: 4px 10px;
    padding: 5px;
    width: 100px;
}

input[type=submit]:hover {
    cursor: pointer;
}

input[type=submit]:active {
    background: #0044CC;
}

input[type=file] {
    background: linear-gradient(to bottom, #0088CC, #0044CC);
    border: 1px solid #0088CC;
    color: #FFF;
    margin: 4px 10px;
    padding: 3px;
    width: 200px;
}

input[type=file]:hover {
    cursor: pointer;
}

input[type=submit]:active {
    background: #0044CC;
}

</style>
    
<script type="text/javascript">
 $(function(){
 
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
               $('#kdubidskpd').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_uskpd',queryParams:({kduskpd:lcskpdx,skpd:lcskpd}) });
               $("#nmskpd").attr("value",rowData.nm_skpd.toUpperCase());
                                
           }  
         });
		 
        $('#kdubidskpd').combogrid({  
           panelWidth:500,  
           idField:'kd_uskpd',  
           textField:'kd_uskpd',  
           mode:'remote',
          // url:'<?php echo base_url(); ?>index.php/master/ambil_ubidskpd',  
           columns:[[  
               {field:'kd_uskpd',title:'KODE UNIT BIDANG',width:100},  
               {field:'nm_uskpd',title:'NAMA UNIT BIDANG',width:400}    
           ]],  
           onSelect:function(rowIndex,rowData){
               lcskpd = rowData.kd_uskpd;
               $("#nmbidskpd").attr("value",rowData.nm_uskpd.toUpperCase());
           }  
         });
 
	 $('#kib').combogrid({  
            panelWidth:400,  
            width:200,
            idField:'golongan',  
            textField:'nm_golongan',  
            mode:'remote',                                  
            url:'<?php echo base_url(); ?>index.php/master/ambil_gol',  
            columns:[[  
               {field:'golongan',title:'Kode Golongan',width:100},  
               {field:'nm_golongan',title:'Nama Golongan',width:300}    
            ]],  
            onSelect:function(rowIndex,rowData){ 
              nm_golongan = rowData.nm_golongan;  
               $("#nm_golongan").attr("value",rowData.nm_golongan.toUpperCase());
            } 
        });
		
		
         $('#tgl_awal').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });
         $('#tgl_akhir').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });
		
    });
	function openWindow($cek){
		var cpilih	= $cek;
		var ckib	= $('#kib').combogrid('getValue'); 
		var cskpd	= $('#kdskpd').combogrid('getValue');
		var cnmskpd	= document.getElementById('nmskpd').value;
		var cbid	= $('#kdubidskpd').combogrid('getValue');
		var cnm_bid	= document.getElementById('nmbidskpd').value;
		var lctgl1 	= $('#tgl_awal').datebox('getValue');
		var lctgl2 	= $('#tgl_akhir').datebox('getValue');
		var cjenis	= ''; 
				if (cskpd ==''){
					swal({
					title: "Error!",
					text: "MOHON DILENGKAPI KODE SKPD.!!",
					type: "error",
					confirmButtonText: "OK"
					});
					exit();
				}
				if (cbid ==''){
					swal({
					title: "Error!",
					text: "MOHON DILENGKAPI KODE UNIT.!!",
					type: "error",
					confirmButtonText: "OK"
					});
					exit();
				}if (lctgl1 ==''){
					swal({
					title: "Error!",
					text: "MOHON DILENGKAPI TGL CETAK.!!",
					type: "error",
					confirmButtonText: "OK"
					});
					exit();
				}
				if (lctgl2 ==''){
					swal({
					title: "Error!",
					text: "MOHON DILENGKAPI TGL CETAK.!!",
					type: "error",
					confirmButtonText: "OK"
					});
					exit();
				}
				if(ckib=='01'){var url		= "<?php echo site_url(); ?>/master/export_kib_a";}
				if(ckib=='02'){var url		= "<?php echo site_url(); ?>/master/export_kib_b";}
				if(ckib=='03'){var url		= "<?php echo site_url(); ?>/master/export_kib_c";}
				if(ckib=='04'){var url		= "<?php echo site_url(); ?>/master/export_kib_d";}
				if(ckib=='05'){var url		= "<?php echo site_url(); ?>/master/export_kib_e";}
				if(ckib=='06'){var url		= "<?php echo site_url(); ?>/master/export_kib_f";}
		iz = '?cbid='+cbid+'&kib='+ckib+'&cskpd='+cskpd+'&cnmskpd='+cnmskpd+'&cnm_bid='+cnm_bid+'&lctgl1='+lctgl1+'&lctgl2='+lctgl2+'&fa='+cpilih;
		window.open(url+iz,'_blank');
		window.focus();
	
	}
</script>
<div id="content1"> 
    <h3 align="center"><b>EXPORT DATA KIB EXCEL</b></h3>
    <fieldset>                                   
<div id="" align="center" >
<br/> 
        <table  border="0" style="height:40px; width:700px;" >
            <tr>
                <td colspan="3" align="center" style="font-size: 12px; color:red;"><strong>EXPORT DATA KIB</strong></td>
            </tr>
            <tr>
                <td colspan="3">
                <div id="">
                        <table style="width:100%;" border="0">
                            <td width="20%">SKPD</td>
                            <td width="1%">:</td>
                            <td><input id="kdskpd" name="kdskpd" style="width: 100px;" />
                            <input type="hidden" id="nip_tahu"/> 
							<input type="text" id="nmskpd" readonly="true" style="width: 500px;border:0" /> 
                            </td> 
                        </table>
                </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                <div id="div_skpd">
                        <table style="width:100%;" border="0">
                            <td width="20%">UNIT</td>
                            <td width="1%">:</td>
                            <td width="79%"><input id="kdubidskpd" name="kdubidskpd" style="width: 100px;" />
                            <input type="text" id="nmbidskpd" readonly="true" style="width: 500px;border:0" />
                            </td>
                        </table>
                </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                <div id="div_awal">
                    <table style="width:100%;" border="0">
                        <td width="20%">PILIH KIB</td>
                        <td width="1%">:</td>
                        <td><input id="kib" name="kib" style="width: 30px;" />
                            <input hidden="true" type="text" id="nm_golongan" readonly="true" style="width: 40px;border:0" /></td>  
                    </table>
                </div>
                </td> 
            </tr>
            <tr>
                <td colspan="3">
                <div id="div_awal">
                    <table style="width:100%;" border="0">
                        <td width="20%">TANGGAL AWAL</td>
                        <td width="1%">:</td>
                        <td><input type="text" id="tgl_awal" style="width: 150px;" /></td>  
                    </table>
                </div>
                </td> 
            </tr>
            <tr>
                <td colspan="3">
                <div id="div_awal">
                    <table style="width:100%;" border="0">
                        <td width="20%">TANGGAL AKHIR</td>
                        <td width="1%">:</td>
                        <td><input type="text" id="tgl_akhir" style="width: 150px;" /></td>  
                    </table>
                </div>
                </td> 
            </tr>         
            <tr>
                <td colspan="3" align="center">
                <button  class="easyui-linkbutton" iconCls="icon-excel" plain="true" onclick="javascript:openWindow(1);">EXPORT</button>
                </td>                
            </tr>
        </table>
</div>
 <br/><br/> 
 <br/><br/>
 </fieldset>  
</div>

