<script src="<?php echo base_url(); ?>lib/sweet-alert.min.js"></script>
<link   rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>lib/sweet-alert.css">
<script type="text/javascript">
    
    var kdwil= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
    var ctk = '';
               
	function openWindow($cek){
		var cpilih	= $cek; 
		var cskpd	= $('#kdskpd').combogrid('getValue'); 
		var cnmskpd	= document.getElementById('nmskpd').value;
		var cbid	= $('#kdubidskpd').combogrid('getValue');
		var cnm_bid	= document.getElementById('nmbidskpd').value;
		var lctgl2 	= $('#tgl_cetak').datebox('getValue'); 
		if(cpilih=='1'){var url		= "<?php echo site_url(); ?>/laporan/kib_jenisb";}	
		if(cpilih=='2'){var url		= "<?php echo site_url(); ?>/laporan/kib_jenisc";}
		if(cpilih=='3'){var url		= "<?php echo site_url(); ?>/laporan/kib_jenisd";}
		if(cpilih=='4'){var url		= "<?php echo site_url(); ?>/laporan/kib_jenise";}

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
		iz = '?cbid='+cbid+'&cskpd='+cskpd+'&cnmskpd='+cnmskpd+'&cnm_bid='+cnm_bid+'&lctgl2='+lctgl2+'&fa='+cpilih;
		window.open(url+iz,'_blank');
		window.focus();
			
			}	
 
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
               lcskpdx 	= rowData.kd_lokasi; 
               lcskpd 	= rowData.kd_skpd; 
               $('#kdubidskpd').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_uskpd',queryParams:({kduskpd:lcskpdx,skpd:lcskpd}) });
               $("#nmskpd").attr("value",rowData.nm_skpd.toUpperCase());
               //lckd_lokasi = rowData.kd_lokasi;
               $('#tahu').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_pa',queryParams:({kduskpd:lcskpd,kode:'1'}) });
               $('#bend').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_pb',queryParams:({kduskpd:lcskpd,kode:'1'}) });
                                
           }  
         });
		 
        $('#kdubidskpd').combogrid({  
           panelWidth:500,  
           idField:'kd_uskpd',  
           textField:'kd_uskpd',  
           mode:'remote',
           //url:'<?php echo base_url(); ?>index.php/master/ambil_ubidskpd',  
           columns:[[  
               {field:'kd_uskpd',title:'KODE UNIT BIDANG',width:100},  
               {field:'nm_uskpd',title:'NAMA UNIT BIDANG',width:400}    
           ]],  
           onSelect:function(rowIndex,rowData){
               lcskpd = rowData.kd_uskpd;
              // $('#kdubidskpd').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_uskpd',queryParams:({kduskpd:lcskpd}) });
               $("#nmbidskpd").attr("value",rowData.nm_uskpd.toUpperCase());
               $('#tahu').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_pa2',queryParams:({kduskpd:lcskpd}) });
               $('#bend').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_pb2',queryParams:({kduskpd:lcskpd}) });
                             
           }  
         });
         
         $('#tgl_cetak').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });
      
    }); 
  
   </script>



<div id="content1"> 
    <h3 align="center"><b>CETAK LAPORAN PERJENIS BARANG KIB</b></h3>
    <fieldset>
     <table align="center" style="width:100%;" border="0">
            <tr>
                <td colspan="3">
                <div id="">
                        <table style="width:100%;" border="0">
                            <td width="20%">SKPD</td>
                            <td width="1%">:</td>
                            <td><input id="kdskpd" name="kdskpd" style="width: 100px;" />
                            <input type="hidden" id="nip_tahu"/> 
							<input  readonly="true" type="text" id="nmskpd" style="width: 500px;border:0"/> 
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
                <div id="div_tgl">
                    <table style="width:100%;" border="0">
                        <td width="20%">TANGGAL CETAK</td>
                        <td width="1%">:</td>
                        <td><input type="text" id="tgl_cetak" style="width: 140px;" /></td>  
                    </table>
                </div>
                </td> 
                
            </tr>    
            <tr><td colspan="3">&nbsp;</td></tr> 
            <tr>
                <td colspan="3" align="center">
				<button  class="easyui-linkbutton" iconCls="icon-settings" plain="true"  onclick="javascript:openWindow(1);">KIB B</button>
                <button  class="easyui-linkbutton" iconCls="icon-home" plain="true"  onclick="javascript:openWindow(2);">KIB C</button>
                <button  class="easyui-linkbutton" iconCls="icon-rss" plain="true" onclick="javascript:openWindow(3);">KIB D</button>
                <button  class="easyui-linkbutton" iconCls="icon-folder" plain="true" onclick="javascript:openWindow(4);">KIB E</button>
                </td>                
            </tr>
        </table>  
            
    </fieldset>  
</div>