<script src="<?php echo base_url(); ?>lib/sweet-alert.min.js"></script>
<link   rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>lib/sweet-alert.css">
<script type="text/javascript">
    
    var kdwil= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
    var ctk = '';

    $(document).ready(function() {
          $("#skpd").hide();
          $("#div_skpd").hide();
    });
               
    function opt(val){        
        ctk = val;
        if (ctk=='1'){
            $("#skpd").show();
            $("#div_skpd").hide();
            $("#model_ctk").show();
        } else if (ctk=='2'){
            $("#skpd").show();
            $("#div_skpd").show();
            $("#model_ctk").hide();
        } else if (ctk=='3'){
            $("#skpd").hide();
            $("#div_skpd").hide();
            $("#model_ctk").show();
		}else if (ctk==''){
            $("#skpd").hide();
            $("#div_skpd").hide();
            $("#model_ctk").show();
    }else {
            exit();
        }      
			//openWindow();
    }
	
	function formatx(itu){
	ini = itu;               
	$("#ini").attr("value",ini);
	}
	
	function openWindow($cek){
		var tab     = ctk;
		var cpilih	= $cek; 
    alert(tab);
		var oto		= '<?php echo ($this->session->userdata('otori')); ?>';
		var unit	= '<?php echo ($this->session->userdata('unit_skpd')); ?>';
		var	u		= unit.substring(9,11);
    var cini	= document.getElementById('ini').value;
		var cskpd	= $('#kdskpd').combogrid('getValue'); 
		var cnmskpd	= document.getElementById('nmskpd').value;
		var cbid	= $('#kdubidskpd').combogrid('getValue');
		var cnm_bid	= document.getElementById('nmbidskpd').value;
		var lctahu 	= document.getElementById('nip_tahu').value;
		var lcbend 	= document.getElementById('nip_bend').value;
		var cnmbend = document.getElementById('nama_bend').value;
		var cnmtahu = document.getElementById('nama_tahu').value; 
		var tgl_reg	= $('#tgl_reg').datebox('getValue');
		var lctgl2 	= $('#tgl_cetak').datebox('getValue');
		var url		= "<?php echo site_url(); ?>/laporan_inventaris/lap_kib_a";
		var sh 		= "";	

		if (oto=='01'){
		iz = '?cbid='+cbid+'&cskpd='+cskpd+'&cnmskpd='+cnmskpd+'&cnm_bid='+cnm_bid+'&lctahu='+lctahu+'&lcbend='+lcbend+'&cnmbend='+cnmbend+'&cnmtahu='+cnmtahu+'&lctgl2='+lctgl2+'&tgl_reg='+tgl_reg+'&sh='+sh+'&ini='+cini+'&fa='+cpilih;
		window.open(url+iz,'_blank');
		window.focus();
		}else{
			if(tab=='2'){
				
				if (cskpd ==''){
					swal({
					title: "Error!",
					text: "MOHON DILENGKAPI KODE SKPD.!!",
					type: "error",
					confirmButtonText: "OK"
					});
					exit();
				}	
				else if (cbid ==''){
					swal({
					title: "Error!",
					text: "MOHON DILENGKAPI UNIT.!!",
					type: "error",
					confirmButtonText: "OK"
					});
					exit();
				}else if (tgl_reg ==''){
					swal({
					title: "Error!",
					text: "MOHON DILENGKAPI KIB PER TANGGAL.!!",
					type: "error",
					confirmButtonText: "OK"
					});
					exit();
				}else{
				iz = '?cbid='+cbid+'&cskpd='+cskpd+'&cnmskpd='+cnmskpd+'&cnm_bid='+cnm_bid+'&lctahu='+lctahu+'&lcbend='+lcbend+'&cnmbend='+cnmbend+'&cnmtahu='+cnmtahu+'&lctgl2='+lctgl2+'&tgl_reg='+tgl_reg+'&sh='+sh+'&ini='+cini+'&fa='+cpilih;
				window.open(url+iz,'_blank');
				window.focus();

				}
				
			}else{
          if(tab=='2'){
					
				if (cskpd ==''){
						swal({
						title: "Error!",
						text: "MOHON DILENGKAPI KODE SKPD.!!",
						type: "error",
						confirmButtonText: "OK"
						});
						exit();
					}	
					else if (cbid ==''){
						swal({
						title: "Error!",
						text: "MOHON DILENGKAPI KODE UNIT.!!",
						type: "error",
						confirmButtonText: "OK"
						});
						exit();
					}
					else if (lctgl2 ==''){
						swal({
						title: "Error!",
						text: "MOHON DILENGKAPI TGL CETAK.!!",
						type: "error",
						confirmButtonText: "OK"
						});
						exit();
					
					}else if (tgl_reg ==''){
					swal({
					title: "Error!",
					text: "MOHON DILENGKAPI KIB PER TANGGAL.!!",
					type: "error",
					confirmButtonText: "OK"
					});
					exit();
        }else{
          iz = '?cbid='+cbid+'&cskpd='+cskpd+'&cnmskpd='+cnmskpd+'&cnm_bid='+cnm_bid+'&lctahu='+lctahu+'&lcbend='+lcbend+'&cnmbend='+cnmbend+'&cnmtahu='+cnmtahu+'&tgl_reg='+tgl_reg+'&lctgl2='+lctgl2+'&sh='+sh+'&ini='+cini+'&fa='+cpilih;
          window.open(url+iz,'_blank');
          window.focus();
        }
				}else{
					iz = '?cbid='+cbid+'&cskpd='+cskpd+'&cnmskpd='+cnmskpd+'&cnm_bid='+cnm_bid+'&lctahu='+lctahu+'&lcbend='+lcbend+'&cnmbend='+cnmbend+'&cnmtahu='+cnmtahu+'&tgl_reg='+tgl_reg+'&lctgl2='+lctgl2+'&sh='+sh+'&ini='+cini+'&fa='+cpilih;
					window.open(url+iz,'_blank');
					window.focus();

					}
				}
			}
		
		}		
 
    $(function(){
      $('#kdskpd').combogrid({  
           panelWidth:500,  
           idField:'kd_skpd',  
           textField:'kd_skpd',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/master/ambil_skpd_dh',  
           columns:[[  
               {field:'kd_skpd',title:'KODE SKPD',width:100},  
               {field:'nm_skpd',title:'NAMA SKPD',width:400}    
           ]],  
           onSelect:function(rowIndex,rowData){
               lcskpd = rowData.kd_skpd;
               lcunit = rowData.kd_lokasi;
               $('#kdubidskpd').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_ubidskpdh',queryParams:({skpd:lcskpd}) });
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
               {field:'kd_uskpd',title:'KODE UNIT BIDANG',width:150},  
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
		
         $('#tgl_reg').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });
        
        $('#tahu').combogrid({  
           panelWidth:300,  
           idField:'nama',  
           textField:'nama',  
           mode:'remote',
          // url:'<?php echo base_url(); ?>index.php/master/ambil_pa',
           queryParams:({kduskpd:''}),
           loadMsg:"Tunggu Sebentar....!!",  
           columns:[[  
               {field:'nama',title:'Nama Pengguna Anggaran',width:300}    
           ]],  
           onSelect:function(rowIndex,rowData){
               lcnip = rowData.nip;
			   lcnama = rowData.nama;
               $("#nip_tahu").attr("value",lcnip);
			   $("#nama_tahu").attr("value",lcnama);
           } 
         });
         
         $('#bend').combogrid({  
           panelWidth:300,  
           idField:'nama',  
           textField:'nama',  
           mode:'remote',
           //url:'<?php echo base_url(); ?>index.php/master/ambil_pb',
           queryParams:({kduskpd:''}),
           loadMsg:"Tunggu Sebentar....!!",  
           columns:[[  
               {field:'nama',title:'Nama Pengurus',width:300}    
           ]],  
           onSelect:function(rowIndex,rowData){
               lcnip_bend = rowData.nip;
			   lcnama_bend = rowData.nama;
               $("#nip_bend").attr("value",lcnip_bend);                              
			   $("#nama_bend").attr('value',lcnama_bend);
		   }		   
         });
		 
				 $('#tgl_cetak').datebox('setValue','<?php echo date('Y-m-d')?>');
				 $('#tgl_reg').datebox('setValue','<?php echo date('Y-m-d')?>');
    }); 
  
  
   </script>



<div id="content1"> 
    <h3 align="center"><b>CETAK LAPORAN KIB A<br>
    KARTU INVENTARIS BARANG TANAH (KOMPILASI)</b></h3>
    <fieldset>
     <table align="center" style="width:100%;" border="0">
            <tr>
                <td><input type="radio" name="cetak" value="1" onclick="opt(this.value)" />SKPD &ensp;</td>
                <td><input type="radio" name="cetak" value="2" id="status" onclick="opt(this.value)" />UNIT&ensp;</td>
                <td><input type="radio" name="cetak" value="3" id="status" onclick="opt(this.value)" />Keseluruhan&ensp;</td>
            </tr>
            <tr>
                <td colspan="3">
                <div id="skpd">
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
                <div id="div_tahu">
                        <table style="width:100%;" border="0">
                            <td width="20%">MENGETAHUI</td>
                            <td width="1%">:</td>
                            <td><input id="tahu" name="tahu" style="width: 300px;" />
                            <input type="hidden" id="nip_tahu"/> <input type="hidden" id="nama_tahu"/> 
                            </td> 
                        </table>
                </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                <div id="div_bend">
                        <table style="width:100%;" border="0">
                            <td width="20%">PENGURUS</td>
                            <td width="1%">:</td>
                            <td><input id="bend" name="bend" style="width: 300px;" />
                            <input type="hidden" id="nip_bend"/> <input type="hidden" id="nama_bend"/> 
                            </td> 
                        </table>
                </div>
                </td> 
            </tr>
            <tr>
                <td colspan="3">
                <div id="div_per">
                        <table style="width:100%;" border="0">
                            <td width="20%">KIB PER TANGGAL</td>
                            <td width="1%">:</td>
                            <td><input id="tgl_reg" name="tgl_reg" style="width: 140px;" />
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
			<tr> 
			<td colspan="3" align="left">
				<div  id="model_ctk">
				<a><b>.::FORMAT LAPORAN :</b></a>
				<form>
					  <input type="radio" name="format" value="fa"  onclick="formatx(this.value)"/>1. Tidak Tampilkan Unit<br/>    
					  <input type="radio" name="format" value="iz"  onclick="formatx(this.value)"/>2. Tampilkan Unit<br/>     
					  <input hidden="true" type="text"  name="ini" id="ini"/> 
				</form>
				</div>
			</td>
            </tr>
            <tr><td colspan="3">&nbsp;</td></tr> 
            <tr>
                <td colspan="3" align="center">
                <a  class="easyui-linkbutton" iconCls="icon-pdf" plain="true"  onclick="javascript:openWindow(1);">Cetak Pdf</a>
                <a  class="easyui-linkbutton" iconCls="icon-excel" plain="true" onclick="javascript:openWindow(2);">Cetak Excel</a>
                <a  class="easyui-linkbutton" iconCls="icon-word" plain="true" onclick="javascript:openWindow(3);">Cetak Word</a>
		        <a href="<?php echo base_url();?>" class="easyui-linkbutton" iconCls="icon-undo" plain="true">Keluar</a>
                </td>                
            </tr>
        </table>  
            
    </fieldset>  
</div>