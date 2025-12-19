<script src="<?php echo base_url(); ?>lib/sweet-alert.min.js"></script>
<link   rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>lib/sweet-alert.css">
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
            $("#div_skpd").hide();
            $("#model_ctk").show();
        } else if (ctk=='2'){
            $("#div_skpd").show();
            $("#model_ctk").hide();
        } else if (ctk==''){
            $("#div_skpd").hide();
            $("#model_ctk").show();
		}else {
            exit();
        }                 
    }
	function formatx(itu){
	ini = itu;               
	$("#ini").attr("value",ini);
	}
           
	function openWindow($cek){
		var cpilih	= $cek;
		var tab		= ctk;
		var cini	= document.getElementById('ini').value;
		var cskpd	= $('#kdskpd').combogrid('getValue');
		var cnmskpd	= document.getElementById('nmskpd').value;
		var cbid	= $('#kdubidskpd').combogrid('getValue');
		var cnm_bid	= document.getElementById('nmbidskpd').value;
		var lctahu 	= document.getElementById('nip_tahu').value;
		var lcbend 	= document.getElementById('nip_bend').value;
		var cnmbend = document.getElementById('nama_bend').value;
		var cnmtahu = document.getElementById('nama_tahu').value;
		var ctahun	= $('#tahun').combogrid('getValue'); 
		var ckondisi= $('#kondisi').combobox('getValue'); 
		var cmilik  = $('#milik').combogrid('getValue'); 
		var pnilai	= $('#pilih_nilai').combobox('getValue'); 
		var lctgl2 	= $('#tgl_cetak').datebox('getValue');
		var tgl_reg	= $('#tgl_reg').datebox('getValue');
		var cjenis	= ''; 
		var cnmjenis = '';
		if(tab=='1'){
				if (cskpd ==''){
					swal({
					title: "Error!",
					text: "MOHON DILENGKAPI KODE SKPD.!!",
					type: "error",
					confirmButtonText: "OK"
					});
					exit();
				}
				if (cskpd !='' && cini ==''){
					swal({
					title: "Error!",
					text: "MOHON DILENGKAPI FORMAT LAPORAN.!!",
					type: "error",
					confirmButtonText: "OK"
					});
					exit();
				}
				if (pnilai ==''){
					swal({
					title: "Error!",
					text: "MOHON DILENGKAPI PILIHAN NILAI.!!",
					type: "error",
					confirmButtonText: "OK"
					});
					exit();
				}if (tgl_reg ==''){
					swal({
					title: "Error!",
					text: "MOHON DILENGKAPI KIB PER TANGGAL.!!",
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
		}else if(tab=='2'){
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
				if (pnilai ==''){
					swal({
					title: "Error!",
					text: "MOHON DILENGKAPI PILIHAN NILAI.!!",
					type: "error",
					confirmButtonText: "OK"
					});
					exit();
				}if (tgl_reg ==''){
					swal({
					title: "Error!",
					text: "MOHON DILENGKAPI KIB PER TANGGAL.!!",
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
		
		}	
		var url		= "<?php echo site_url(); ?>/laporan/lap_kib_g";
		iz = '?cbid='+cbid+'&jenis='+cjenis+'&nmjenis='+cnmjenis+'&cskpd='+cskpd+'&cnmskpd='+cnmskpd+'&cnm_bid='+cnm_bid+'&lctahu='+lctahu+'&lcbend='+lcbend+'&cnmbend='+cnmbend+'&cnmtahu='+cnmtahu+'&kondisi='+ckondisi+'&milik='+cmilik+'&tahun='+ctahun+'&tgl_reg='+tgl_reg+'&lctgl2='+lctgl2+'&pnilai='+pnilai+'&ini='+cini+'&fa='+cpilih;
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
               lcskpd = rowData.kd_skpd;
               lcskpdx = rowData.kd_lokasi; 
               $('#kdubidskpd').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_uskpd',queryParams:({kduskpd:lcskpdx,skpd:lcskpd}) });
               $("#nmskpd").attr("value",rowData.nm_skpd.toUpperCase());
               lckd_lokasi = rowData.kd_lokasi;
               $('#tahu').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_pa',queryParams:({kduskpd:lcskpd}) });
               $('#bend').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_pb',queryParams:({kduskpd:lcskpd}) });
                                
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
               $('#tahu').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_pa2',queryParams:({kduskpd:lcskpd}) });
               $('#bend').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_pb2',queryParams:({kduskpd:lcskpd}) });
                             
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
           //url:'<?php echo base_url(); ?>index.php/master/ambil_pa',
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
        
        $('#jenis').combogrid({  
           panelWidth:500,  
           idField:'kode',  
           textField:'jenis',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/master/ambil_jenis',
           queryParams:({kode:'06'}), 
           columns:[[  
               {field:'kode',title:'KODE',width:100},  
               {field:'jenis',title:'JENIS',width:400}    
           ]],  
           onSelect:function(rowIndex,rowData){
               jenis = rowData.jenis;
               $("#nmjenis").attr("value",rowData.jenis.toUpperCase());
           }  
         });
		
     $('#tahun').combobox({           
            valueField:'tahun',  
            textField:'tahun',
            panelWidth:60,  
            url:'<?php echo base_url(); ?>index.php/master/tahun'   
        });
     
	 $('#kondisi').combobox({
		valueField:'nama',  
        textField:'nama',
        width:60,
        data:[{kode:'1',nama:'B'},{kode:'2',nama:'KB'}]
	 });
	 
	 $('#milik').combogrid({  
       panelWidth:150,  
       idField:'kd_milik',  
       textField:'nm_milik',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_milik',
       loadMsg:"Tunggu Sebentar....!!",  
       columns:[[  
           {field:'kd_milik',title:'Kode',width:40},
           {field:'nm_milik',title:'Kondisi',width:110}
       ]],
        onSelect:function(rowIndex,rowData){
           lcmilik = rowData.kd_milik;
       }  
     });
	 $('#pilih_nilai').combobox({
		valueField:'kode',  
        textField:'nama',
        width:150,
        data:[{kode:'1',nama:'NILAI LAMA'},{kode:'2',nama:'NILAI BARU'}]
	 });
				 $('#tgl_cetak').datebox('setValue','<?php echo date('y-m-d')?>');
				 $('#tgl_reg').datebox('setValue','<?php echo date('y-m-d')?>');
    }); 
  
  
   </script>



<div id="content1"> 
    <h3 align="center"><b>CETAK LAPORAN KIB G<br>
    ASET TAK BERWUJUD</b></h3>
    <fieldset>
     <table align="center" style="width:100%;" border="0">
           <tr>
                <td><input type="radio" name="cetak" value="1" onclick="opt(this.value)" />SKPD &ensp;</td>
                <td><input type="radio" name="cetak" value="2" id="status" onclick="opt(this.value)" />UNIT&ensp;</td>
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
            <!--tr>
                <td colspan="3">
                <div id="">
                        <table style="width:100%;" border="0">
                            <td width="20%">PILIH JENIS CETAK KIB</td>
                            <td width="1%">:</td>
                            <td width="79%"><input id="jenis" name="jenis" style="width: 300px;" />
                            <input type="hidden" id="nmjenis" readonly="true" style="width: 500px;border:0" />
                            </td>
                        </table>
                </div>
                </td>
            </tr-->
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
                <div id="div_tahun">
                    <table style="width:100%;" border="0">
                        <td width="20%">TAHUN ASET</td>
                        <td width="1%">:</td>
                        <td><input type="text" id="tahun" style="width: 65px;" /><font color="red"><i>*isi jika ingin lap per tahun</i><font></td>  
                    </table>
                </div>
                </td> 
            </tr> 
            <tr>
                <td colspan="3">
                <div id="div_tahun">
                    <table style="width:100%;" border="0">
                        <td width="20%">KONDISI ASET</td>
                        <td width="1%">:</td>
                        <td><input type="text" id="kondisi" style="width: 65px;" /><font color="red"><i>*isi jika ingin lap per kondisi</i><font></td>  
                    </table>
                </div>
                </td> 
            </tr> 
            <tr>
                <td colspan="3">
                <div id="div_tahun">
                    <table style="width:100%;" border="0">
                        <td width="20%">KEPEMILIKAN ASET</td>
                        <td width="1%">:</td>
                        <td><input type="text" id="milik" style="width: 65px;" /><font color="red"><i>*isi jika ingin lap per kepemilikan</i><font></td>  
                    </table>
                </div>
                </td> 
            </tr> 
            <tr>
                <td colspan="3">
                <div id="div_nilai">
                    <table style="width:100%;" border="0">
                        <td width="20%">PILIH NILAI</td>
                        <td width="1%">:</td>
                        <td><input type="text" id="pilih_nilai" style="width: 150px;" /><font color="red"><i>*WAJIB DIISI</i><font></td>  
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
				<a  class="easyui-linkbutton" iconCls="icon-note_book" plain="true"  onclick="javascript:openWindow(4);">Cetak Pdf 1</a>
                <a  class="easyui-linkbutton" iconCls="icon-pdf" plain="true"  onclick="javascript:openWindow(1);">Cetak Pdf 2</a>
                <a  class="easyui-linkbutton" iconCls="icon-excel" plain="true" onclick="javascript:openWindow(2);">Cetak Excel</a>
                <a  class="easyui-linkbutton" iconCls="icon-word" plain="true" onclick="javascript:openWindow(3);">Cetak Word</a>
		        <a href="<?php echo base_url();?>" class="easyui-linkbutton" iconCls="icon-undo" plain="true">Keluar</a>
                </td>                
            </tr>
        </table>  
            
    </fieldset>  
</div>