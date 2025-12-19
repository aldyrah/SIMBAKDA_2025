    <script type="text/javascript">
    
    var kdwil= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
                    
    
    function kosong(){
        $("#kdmilik").attr("value",'');
        $("#nmmilik").attr("value",''); 
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
        var ctahu 		= document.getElementById('nip_tahu').value;
        var cbend 		= document.getElementById('nip_bend').value;
        var cnmtahu 	= $('#tahu').combogrid('getValue');
        var cnmbend 	= $('#bend').combogrid('getValue'); 
        var ctgl_awal 	= $('#tgl_awal').datebox('getValue');
        var ctgl_akhir 	= $('#tgl_akhir').datebox('getValue');
        var ctgl 		= $('#tgl_cetak').datebox('getValue');
		var tgl_reg		= $('#tgl_reg').datebox('getValue');
        var cthn    	= '<?php echo ($this->session->userdata('ta_simbakda')); ?>';
		var url			= "<?php echo site_url(); ?>/laporan/lap_mutasi";
        
		if (oto=='01'){
        lc = '?kd_skpd='+cskpd+'&nm_skpd='+cnmskpd+'&kd_bid='+cbidang+'&nm_bid='+cnmbid+'&tahu='+ctahu+'&bend='+cbend+'&nmbend='+cnmbend+'&nmtahu='+cnmtahu+'&tgl='+ctgl+'&tgl_awal='+ctgl_awal+'&tgl_akhir='+ctgl_akhir+'&tgl_reg='+tgl_reg+'&tahun='+cthn+'&fa='+cpilih;
        window.open(url+lc,'_blank');
        window.focus();
		}else{
		if(u=='01'){
			if(cskpd==''){
				alert('Belum Pilih SKPD');
			}else if(ctgl_awal == ''){
					alert('Belum Pilih Tanggal Awal')
			}else if(ctgl_akhir == ''){
					alert('Belum Pilih Tanggal Akhir')
			}else if(ctgl == ''){
				alert('Belum Pilih Tahun')
			}else if (tgl_reg ==''){
					alert('Belum Pilih Aset Per Tanggal');
					exit();
				}else if(cthn == ''){
				alert('Belum Pilih Tahun')
			}else{
			lc = '?kd_skpd='+cskpd+'&nm_skpd='+cnmskpd+'&kd_bid='+cbidang+'&nm_bid='+cnmbid+'&tahu='+ctahu+'&bend='+cbend+'&nmbend='+cnmbend+'&nmtahu='+cnmtahu+'&tgl_awal='+ctgl_awal+'&tgl_akhir='+ctgl_akhir+'&tgl_reg='+tgl_reg+'&tgl='+ctgl+'&tahun='+cthn+'&fa='+cpilih;
			window.open(url+lc,'_blank');
			window.focus();
			}
		}else{
			if(cskpd==''){
				alert('Belum Pilih SKPD');
			}else if(cbidang == ''){
				alert('Belum Pilih UNIT BIDANG')
			}else if(ctgl_awal == ''){
					alert('Belum Pilih Tanggal Awal')
			}else if(ctgl_akhir == ''){
					alert('Belum Pilih Tanggal Akhir')
			}else if(ctgl == ''){
				alert('Belum Pilih Tahun')
			}else if (tgl_reg ==''){
					alert('Belum Pilih Aset Per Tanggal');
					exit();
				}else if(cthn == ''){
				alert('Belum Pilih Tahun')
			}else{
			lc = '?kd_skpd='+cskpd+'&nm_skpd='+cnmskpd+'&kd_bid='+cbidang+'&nm_bid='+cnmbid+'&tahu='+ctahu+'&bend='+cbend+'&nmbend='+cnmbend+'&nmtahu='+cnmtahu+'&tgl_awal='+ctgl_awal+'&tgl_akhir='+ctgl_akhir+'&tgl_reg='+tgl_reg+'&tgl='+ctgl+'&tahun='+cthn+'&fa='+cpilih;
			window.open(url+lc,'_blank');
			window.focus();
			}
		}
		}
    } 
    
    function keluar(){
        
    }
    
    $(function(){
        $('#kdubidskpd').combogrid({  
           panelWidth:500,  
           idField:'kd_uskpd',  
           textField:'kd_uskpd',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/master/ambil_ubidskpd',  
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
               lcunit = rowData.kd_lokasi;
               $("#nmskpd").attr("value",rowData.nm_skpd.toUpperCase());
               $('#tahu').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_pa',queryParams:({kduskpd:lcskpd}) });
               $('#bend').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_pb',queryParams:({kduskpd:lcskpd}) });
               $('#kdubidskpd').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_ubidskpd',queryParams:({skpd:lcskpd,unit:lcunit}) });
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
         $('#tgl_cetak').datebox({  
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
           url:'<?php echo base_url(); ?>index.php/master/ambil_pa',
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
           url:'<?php echo base_url(); ?>index.php/master/ambil_bb',
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
         
         $('#tahun').combobox({           
            valueField:'tahun',  
            textField:'tahun',
            url:'<?php echo base_url(); ?>index.php/master/tahun',
            
        });
		$('#tgl_reg').datebox('setValue','<?php echo date('y-m-d')?>');
		$('#tgl_cetak').datebox('setValue','<?php echo date('y-m-d')?>');
            $("#div_tahu").hide();
            $("#div_bend").hide();
			$("#tutup").hide();
			$("#buka").show();
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
	}
  
   </script>



<div id="content1"> 
    <h3 align="center"><b>LAPORAN MUTASI BARANG</b></h3>
    <fieldset>
     <table align="center" style="width:100%;" border="0">
            <tr>
				<td width="20%">SKPD</td>
				<td width="1%">:</td>
				<td width="79%"><input id="kdskpd" name="kdskpd" style="width: 150px;" />
				<input type="text" id="nmskpd" readonly="true" style="width: 500px;border:0" />
				</td>
            </tr>
            <tr>
				<td width="20%">UNIT</td>
				<td width="1%">:</td>
				<td width="79%"><input id="kdubidskpd" name="kdubidskpd" style="width: 150px;" />
				<input type="text" id="nmbidskpd" readonly="true" style="width: 500px;border:0" />
                <br/><font color="red"><i>*Khusus SKPD isi jika ingin per unit</i><font></td>
            </tr>            <!--tr>
                <td>TAHUN</td>
                <td>:</td>
                <td><input id="tahun" name="tahun" style="width: 100px;" />
                </td>
            </tr-->        
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
                <td width="20%">PERIODE AWAL</td>
                <td width="1%">:</td>
                <td><input type="text" id="tgl_awal" style="width: 150px;" /></td>  
            </tr>
            <tr>
                <td width="20%">PERIODE AKHIR</td>
                <td width="1%">:</td>
                <td><input type="text" id="tgl_akhir" style="width: 150px;" /></td>  
            </tr>
            <tr hidden="true">
                <td colspan="3">
                <div id="div_per">
                        <table style="width:100%;" border="0">
                            <td width="20%">ASET PER TANGGAL</td>
                            <td width="1%">:</td>
                            <td><input id="tgl_reg" name="tgl_reg" style="width: 150px;" />
                            </td> 
                        </table>
                </div>
                </td> 
            </tr>
            <tr>
                <td width="20%">TANGGAL CETAK</td>
                <td width="1%">:</td>
                <td><input type="text" id="tgl_cetak" style="width: 150px;" /></td>  
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



