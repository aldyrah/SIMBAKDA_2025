<script src="<?php echo base_url(); ?>lib/sweet-alert.min.js"></script>
<link   rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>lib/sweet-alert.css">
<script type="text/javascript">
    
    var kdwil		= '';
    var judul		= '';
    var cid 		= 0;
    var lcidx 		= 0;
    var lcstatus 	= '';
    var ctk 		= '';
                         
    function opt(val){        
        ctk = val; 
        if (ctk=='1'){
            $("#per_tahun").show();
        } else if (ctk=='2'){
            $("#per_tahun").hide();
            // $("#kdubidskpd").hide();
            // $("#tahu").hide();
        }else {
            exit();
        }                 
    }
           
	function openWindow($cek){
		var cpilih		= $cek; 
		var tahun	 	= document.getElementById("tahun").value; 
		var tahun2	 	= document.getElementById("tahun2").value; 
		var lctgl2 		= $('#tgl_cetak').datebox('getValue');
		var cjenis		= ''; 
		var cnmjenis 	= ''; 

        var cskpd       = $('#kdubidskpd').combogrid('getValue');
        // alert(cskpd);

        
        
        //var cnmskpd   = document.getElementById('nmskpd').value;
        var ctahu       = document.getElementById('nip_tahu').value;
        // alert(ctahu);
        // var cbend       = document.getElementById('nip_bend').value;
        // alert(cbend);
		if (lctgl2 ==''){
			swal({
			title: "Error!",
			text: "MOHON DILENGKAPI TGL CETAK.!!",
			type: "error",
			confirmButtonText: "OK"
			});
			exit();
		}
		var url		= "<?php echo site_url(); ?>/laporan/lap_rekap_rkbu";
		iz = '?kd_skpd='+cskpd+'&tahun='+tahun+'&tahun2='+tahun2+'&lctgl2='+lctgl2+'&fa='+cpilih+'&tahu='+ctahu;
		window.open(url+iz,'_blank');
		window.focus();
	
	} 
 
       
    $(function(){  
         $('#tgl_cetak').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });
        ;
		
    }); 

    $(function(){
        $('#kdubidskpd').combogrid({  
           panelWidth:500,  
           idField:'kd_skpd',  
           textField:'kd_skpd',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/master/ambil_skpd_dh',  
           columns:[[  
               {field:'kd_skpd',title:'KODE OPD',width:100},  
               {field:'nm_skpd',title:'NAMA OPD',width:400}    
           ]],  
           onSelect:function(rowIndex,rowData){
               lcskpd = rowData.kd_skpd;
               kd_lokasi = rowData.kd_lokasi;
               $("#kd_lokasi").attr("value",rowData.kd_lokasi);
               $("#nmskpd").attr("value",rowData.nm_skpd.toUpperCase());
               $('#tahu').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_pa',queryParams:({kduskpd:lcskpd}) });
               $('#bend').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_pb',queryParams:({kduskpd:lcskpd}) });
                                
           }  
         });

        });

         $(function(){
        $('#tahu').combogrid({  
           panelWidth:300,  
           idField:'nama',  
           textField:'nama',  
           mode:'remote',
           //url:'<?php echo base_url(); ?>index.php/master/ambil_pa',
           //queryParams:({kduskpd:''}),
           loadMsg:"Tunggu Sebentar....!!",  
           columns:[[  
               {field:'nama',title:'Nama Pengguna Anggaran',width:300}    
           ]],  
           onSelect:function(rowIndex,rowData){
               lcnip = rowData.nip;
               $("#nip_tahu").attr("value",lcnip);                              
           } 
         });
        });
  
  
   </script>



<div id="content1"> 
    <h3 align="center"><b>CETAK LAPORAN<br>
    REKAPITULASI RENCANA KEBUTUHAN BARANG UNIT (RKBU)</b></h3>
    <fieldset>
     <table align="center" style="width:100%;" border="0">
           <tr>
                <td><input type="radio" name="cetak" value="1" onclick="opt(this.value)" />PER TAHUN &ensp;</td>
                <td><input type="radio" name="cetak" value="2" id="status" onclick="opt(this.value)" />SEMUA&ensp;</td>
            </tr>
            <tr>
                <td colspan="3">
                <div id="per_tahun">
                        <table style="width:100%;" border="0">
                            <td width="20%">Tahun</td>
                            <td width="1%">:</td>
                            <td align="right" width="1%">Tahun Awal <select id="tahun" class="select" style="width:80px;">
							<option value='' selected></option>					
							<?php
							$th=date("Y");
							for($i=$th;$i>=$th-100;$i--){
							echo "<option value='$i'>$i</option>";					
							}					
							?>
							</select>
							</td> 
                            <td width="1%"><b>&ensp;S/D&ensp;</b></td>
                            <td>Tahun Akhir <select id="tahun2" class="select" style="width:80px;">
								<option value='' selected></option>					
								<?php
									$th=date("Y");
									for($i=$th;$i>=$th-100;$i--){
										echo "<option value='$i'>$i</option>";					
									}					
								?>
							</select>
							</td> 
                        </table>
                </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                <div id="div_skpd">
                    <table style="width:100%;" border="0">
                        <td width="20%">OPD</td>
                <td width="1%">:</td>
                <td><input id="kdubidskpd" name="kdubidskpd" style="width: 150px;"/>
                <input type="text" id="nmskpd" readonly="true" style="width: 500px;border:0" />
                <input type="text" id="kd_lokasi" hidden="true" style="width: 500px;border:0" />
                </td>  
                    </table>
                </div>
                </td> 
                
            </tr>
            <tr>
                <td colspan="3">
                <div id="div_ttd">
                    <table style="width:100%;" border="0">
                        <td width="20%">MENGETAHUI</td>
                <td width="1%">:</td>
                <td><input id="tahu" name="tahu" style="width: 300px;" />
                <input type="hidden" id="nip_tahu"/> 
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
            
            <td colspan="3">&nbsp;</td> 
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