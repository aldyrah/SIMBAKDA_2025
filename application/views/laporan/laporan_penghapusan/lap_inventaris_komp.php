    <script type="text/javascript">
    
    var kdwil= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
    var ctk = '';
                    
    
    function kosong(){
        $("#kdmilik").attr("value",'');
        $("#nmmilik").attr("value",'');
        $("#nmskpd").attr("value",'');
        $("#nmbidskpd").attr("value",''); 
    }
    
    function opt(val){        
        ctk = val; 
        if (ctk=='1'){
            $("#div_skpd").show();
            $("#div_bidang").show();
        } else if (ctk=='2'){
            $("#div_skpd").hide();
            $("#div_bidang").show();
            } else if (ctk=='3'){
            $("#div_skpd").hide();
            $("#div_bidang").show();
            } else {
            exit();
        }                 
    }   
    
             
	function openWindow($cek){
		var cpilih		= $cek;
		var oto		    = '<?php echo ($this->session->userdata('otori')); ?>';
		var unit	    = '<?php echo ($this->session->userdata('unit_skpd')); ?>';
		var	u			= unit.substring(9,11); 		
        var cskpd 		= $('#kdskpd').combogrid('getValue');
        var cnmskpd 	= document.getElementById('nmskpd').value; 
        var cbidang 	= $('#kdubidskpd').combogrid('getValue'); 
        var cnmbid 		= document.getElementById('nmbidskpd').value; 
        //var mengetahui= document.getElementById('mengetahui').value;
		//var ruangan 	= document.getElementById('ruangan').value;
        //var unit 		= document.getElementById('unit').value;
        var ctahu 		= document.getElementById('nip_tahu').value;
        var cbend 		= document.getElementById('nip_bend').value;
        var cnmtahu 	= $('#tahu').combogrid('getValue');
        var cnmbend 	= $('#bend').combogrid('getValue'); 
        var ctgl 		= $('#tgl_cetak').datebox('getValue');
		var tgl_reg		= $('#tgl_reg').datebox('getValue');
		if (cpilih == '3'){				
		var url			= "<?php echo site_url(); ?>/laporan_inventaris/preview_inventaris";
		}else if(cpilih != '3'){
		var url			= "<?php echo site_url(); ?>/laporan_inventaris/lap_inventaris";
		}
		
		if (oto=='01'){
				iz = '?kd_skpd='+cskpd+'&kd_bid='+cbidang+'&nm_skpd='+cnmskpd+'&nm_bid='+cnmbid+'&bend='+cbend+'&tahu='+ctahu+'&nmbend='+cnmbend+'&nmtahu='+cnmtahu+'&tgl_reg='+tgl_reg+'&tgl='+ctgl+'&fa='+cpilih;
				window.open(url+iz,'_blank');
				window.focus();
		}else{
			if(u=='01'){
				if(cskpd == ''){
					alert('Belum Pilih SKPD')
				}else if(ctgl == ''){
					alert('Belum Pilih Tanggal Cetak')
				}else if (tgl_reg ==''){
					alert('Belum Pilih Aset Per Tanggal');
					exit();
				}else{
				iz = '?kd_skpd='+cskpd+'&kd_bid='+cbidang+'&nm_skpd='+cnmskpd+'&nm_bid='+cnmbid+'&bend='+cbend+'&tahu='+ctahu+'&nmbend='+cnmbend+'&nmtahu='+cnmtahu+'&tgl_reg='+tgl_reg+'&tgl='+ctgl+'&fa='+cpilih;
				window.open(url+iz,'_blank');
				window.focus();
					}
				
			}else{
				if(cskpd == ''){
					alert('Anda Masuk Sebagai Unit.!,Wajib Pilih SKPD')
				}else if(cbidang == ''){
					alert('Anda Masuk Sebagai Unit.!,Wajib Pilih UNIT BIDANG')
				}else if(ctgl == ''){
					alert('Belum Pilih Tanggal Cetak')
				}else if (tgl_reg ==''){
					alert('Belum Pilih Aset Per Tanggal');
					exit();
				}else{
				iz = '?kd_skpd='+cskpd+'&kd_bid='+cbidang+'&nm_skpd='+cnmskpd+'&nm_bid='+cnmbid+'&bend='+cbend+'&tahu='+ctahu+'&nmbend='+cnmbend+'&nmtahu='+cnmtahu+'&tgl_reg='+tgl_reg+'&tgl='+ctgl+'&fa='+cpilih;
				window.open(url+iz,'_blank');
				window.focus();
					}
				}
			}
		}
	 
	
    $(function(){
        $("#div_skpd").hide();
        $("#div_bidang").show();
   	});  
    
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
               $("#nmskpd").attr("value",rowData.nm_skpd.toUpperCase());
               $('#kdubidskpd').combogrid('clear');
               $('#tahu').combogrid('clear');
               $('#bend').combogrid('clear');
               $("#nmbidskpd").attr("value",'');
               $('#ruangan').combogrid('clear');
               $('#tahu').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_pa',queryParams:({kduskpd:lcskpd,kode:'1'}) });
               $('#bend').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_pb',queryParams:({kduskpd:lcskpd,kode:'1'}) });
               $('#kdubidskpd').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_ubidskpdh',queryParams:({skpd:lcskpd,unit:lcunit}) });
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
           //url:'<?php echo base_url(); ?>index.php/master/ambil_pa',
           queryParams:({kduskpd:''}),
           loadMsg:"Tunggu Sebentar....!!",  
           columns:[[  
               {field:'nama',title:'Nama Pengguna Anggaran',width:300}    
           ]],  
           onSelect:function(rowIndex,rowData){
               lcnip = rowData.nip;
               $("#nip_tahu").attr("value",lcnip);                              
           } 
         });
         
         $('#bend').combogrid({  
           panelWidth:300,  
           idField:'nama',  
           textField:'nama',  
           mode:'remote',
          // url:'<?php echo base_url(); ?>index.php/master/ambil_bb',
           queryParams:({kduskpd:''}),
           loadMsg:"Tunggu Sebentar....!!",  
           columns:[[  
               {field:'nama',title:'Nama Pengurus Barang',width:300}    
           ]],  
           onSelect:function(rowIndex,rowData){
               lcnip_bend = rowData.nip;
               $("#nip_bend").attr("value",lcnip_bend);                              
           } 
         });
			$('#tgl_cetak').datebox('setValue','<?php echo date('y-m-d')?>');
			$('#tgl_reg').datebox('setValue','<?php echo date('y-m-d')?>');
            $("#div_tahu").hide();
            $("#div_bend").hide();
			$("#tutup").hide();
			$("#buka").show();
			//unit.substring(9,11)
			
	/* 		if(('<?php echo ($this->session->userdata('unit_skpd')); ?>').substring(9,11)=='01'){
            $("#div_bidang").show();
			}else{
			$("#div_bidang").hide();
			}
		 */
    }); 
  function buka(){
		$("#div_tahu").show();
		$("#div_bend").show();
        $("#tutup").show();
        $("#buka").hide();
	}
	function tutup(){
		$("#div_tahu").hide();
		$("#div_bend").hide();
        $("#tutup").hide();
        $("#buka").show();
		hapus_ttd();
	}
  
	function hapus_ttd(){
		   $("#tahu").combogrid("setValue",'');
		   $("#bend").combogrid("setValue",'');
		   $("#nip_tahu").attr("value",'');                              
		   $("#nip_bend").attr("value",'');                              
    }
    
  
   </script>



<div id="content1"> 
    <h3 align="center"><b>CETAK BUKU INVENTARIS (KOMPILASI)</b></h3>
    <fieldset>
     <table align="center" style="width:100%;" border="0">
            <!--tr>
                <td><input type="radio" name="cetak" value="1" onclick="opt(this.value)" />SKPD &ensp;</td>
                <!--td><input type="radio" name="cetak" value="2" id="status" onclick="opt(this.value)" />Per BIDANG &ensp;</td-->
                <!--td><input type="radio" name="cetak" value="3" id="status1" onclick="opt(this.value)" checked="true" />Keseluruhan</td>
                
            </tr-->
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
                </td>
            </tr>
            <tr>
                <td colspan="3">
                <div id="div_bidang">
                        <table style="width:100%;" border="0">
                            <td width="20%">UNIT</td>
                            <td width="1%">:</td>
                            <td width="79%"><input id="kdubidskpd" name="kdubidskpd" style="width: 150px;" />
                            <input type="text" id="nmbidskpd" readonly="true" style="width: 500px;border:0" />
                            <br/><font color="red"><i>*Khusus SKPD isi jika ingin per unit</i><font></td>
                        </table>
                </div>
                </td>
            </tr>
             <tr>
				 <td colspan="3" align="left">
					<div id="buka">
						<button type="button" onclick="javascript:buka();return false">GUNAKAN TTD</button>
					</div>
					<div id="tutup">
						<button type="button" onclick="javascript:tutup();return false">TIDAK GUNAKAN TTD</button>
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
                            <td width="20%">ASET PER TANGGAL</td>
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
            
            <td colspan="3">&nbsp;</td>
            </tr>            
            <tr>
                <td colspan="3" align="center">
                <!--a  href="<?php echo base_url(); ?>index.php/laporan/lap_inventaris" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:openWindow(this.href);return false">Cetak pdf</a-->
                <a  class="easyui-linkbutton" iconCls="icon-note_book" plain="true"  onclick="javascript:openWindow(1);">Cetak Pdf 1</a>
                <a  class="easyui-linkbutton" iconCls="icon-pdf" plain="true"  onclick="javascript:openWindow(3);">Cetak Pdf 2</a>
				<a  class="easyui-linkbutton" iconCls="icon-excel" plain="true" onclick="javascript:openWindow(2);">Cetak Excel</a>
		        <a href="<?php echo base_url();?>" class="easyui-linkbutton" iconCls="icon-undo" plain="true">Keluar</a>
                </td>                
            </tr>
        </table>  
            
    </fieldset>  
</div>



