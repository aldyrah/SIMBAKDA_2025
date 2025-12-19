    <script type="text/javascript">
    
    var kdwil= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
    var ctk = '';
                    
    
    function opt(val){        
        ctk = val; 
        if (ctk=='1'){
            $("#div_skpd").show();
            $("#div_bidang").hide();
        } else if (ctk=='2'){
            $("#div_skpd").hide();
            $("#div_bidang").show();
            } else if (ctk=='3'){
            $("#div_skpd").hide();
            $("#div_bidang").hide();
            } else {
            exit();
        }                 
    }   
     
	function openWindow($cek){
		var cpilih		= $cek;
        var cskpd 		= $('#kdskpd').combogrid('getValue');
        var ckib 		= $('#kib').combogrid('getValue');
        var ctahun 		= $('#tahun').combogrid('getValue');
        var cnmskpd 	= document.getElementById('nmskpd').value; 
		if (ckib == ''){
		alert("Mohon Diisi Kib yang Ingin Dicetak.!");
		exit();
		}
		if (cpilih == '3'){
		var url			= "<?php echo site_url(); ?>/laporan/ctk_label";
		}else if(cpilih != '3'){
		var url			= "<?php echo site_url(); ?>/laporan/ctk_label";
		}
		if(cskpd == ''){
            alert('Belum Pilih SKPD')
        }else if(ctahun == ''){
            alert('Mohon Dipilih Tahun Aset.!')
        }else{
		iz = '?kd_skpd='+cskpd+'&nm_skpd='+cnmskpd+'&kib='+ckib+'&tahun='+ctahun+'&fa='+cpilih;
		window.open(url+iz,'_blank');
		window.focus();
		}
	} 
	
    $(function(){
        $('#kdskpd').combogrid({  
           panelWidth:500,  
           idField:'kd_skpd',  
           textField:'kd_skpd',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/master/ambil_msskpd',  
           columns:[[  
               {field:'kd_skpd',title:'KODE SKPD',width:100},  
               {field:'nm_skpd',title:'NAMA SKPD',width:400}    
           ]],  
           onSelect:function(rowIndex,rowData){
               lcskpd = rowData.kd_skpd;
               lckd_lokasi = rowData.kd_lokasi;
               
               $("#nmskpd").attr("value",rowData.nm_skpd.toUpperCase());
                   
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
        
     $('#tahun').combobox({           
            valueField:'tahun',  
            textField:'tahun',
            panelWidth:60,  
            url:'<?php echo base_url(); ?>index.php/master/tahun'   
        });
    }); 
  
  
   </script>



<div id="content1"> 
    <h3 align="center"><b>CETAK LABEL ASET</b></h3>
    <fieldset>
     <table align="center" style="width:100%;" border="0">
            <tr>
                <td colspan="3">
                <div id="">
                        <table style="width:100%;" border="0">
                    
                            <td width="20%">SKPD</td>
                            <td width="1%">:</td>
                            <td width="79%"><input id="kdskpd" name="kdskpd" style="width: 150px;" />
                            <input type="text" id="nmskpd" readonly="true" style="width: 500px;border:0" />
                            </td>
                        </table>
                </div>
            
            <td colspan="3">&nbsp;</td>
            </tr>  
            <tr>
                <td colspan="3">
                <div id="">
                        <table style="width:100%;" border="0">
                    
                            <td width="20%">PILIH KIB</td>
                            <td width="1%">:</td>
                            <td width="79%"><input id="kib" name="kib" style="width: 150px;" />
                            <input hidden="true" type="text" id="nm_golongan" readonly="true" style="width: 700px;border:0" />
                            </td>
                        </table>
                </div>
            
            <td colspan="3">&nbsp;</td>
            </tr> 
            <tr>
                <td colspan="3">
                <div id="">
                        <table style="width:100%;" border="0">
                            <td width="20%">TAHUN</td>
                            <td width="1%">:</td>
                            <td width="79%"><input id="tahun" name="tahun" style="width: 50px;" />
                            </td>
                        </table>
                </div>
            
            <td colspan="3">&nbsp;</td>
            </tr>           
            <tr>
                <td colspan="3" align="center">
                <a  class="easyui-linkbutton" iconCls="icon-pdf" plain="true"  onclick="javascript:openWindow(2);">Cetak Pdf</a>
                <a  class="easyui-linkbutton" iconCls="icon-word" plain="true" onclick="javascript:openWindow(3);">Cetak Word</a>
		        <a href="<?php echo base_url();?>" class="easyui-linkbutton" iconCls="icon-undo" plain="true">Keluar</a>
                </td>                
            </tr>
        </table>  
            
    </fieldset>  
</div>



