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
          $("#div_tahunsd").hide();
          $("#div_tahun").hide();
          $("#div_bulan").hide();
          $("#nmskpd").attr("value",'');
          $("#model_ctk").hide();
          $("#div_jenis").hide();
          $("#nomor_dok").hide();
          $("#nmbidskpd").attr("value",'');
          tahun();
          tahun1();
          tahun2();
          bulan();
    });
               
    function opt(val){        
        ctk = val;
        if (ctk=='1'){
            $("#skpd").show();
            $("#div_skpd").hide();
            $("#model_ctk").hide();
            $("#div_tahunsd").hide();
            $("#div_tahun").hide();
            $("#div_bulan").hide();
            $("#div_jenis").hide();
            $("#nomor_dok").show();
        } else if (ctk=='2'){
            $("#skpd").show();
            $("#div_skpd").show();
            $("#model_ctk").hide();
            $("#div_tahunsd").hide();
            $("#div_tahun").hide();
            $("#div_bulan").hide();
            $("#div_jenis").hide();
            $("#nomor_dok").show();
            $('#nomor').combogrid('clear');
            $('#nomor').combogrid({url:'<?php echo base_url(); ?>index.php/transaksi/ambil_dok_hapus',queryParams:({kduskpd:'',unit:''}) });
            
		}else if (ctk==''){
            $("#skpd").hide();
            $("#div_skpd").hide();
            $("#model_ctk").hide();
            $("#div_tahunsd").hide();
            $("#div_tahun").hide();
            $("#div_bulan").hide();
            $("#div_jenis").hide();
    }else {
            exit();
        }      
			//openWindow();
    }
	
	function formatx(itu){
	ini = itu;               
	$("#ini").attr("value",ini);
	}

  function cetak($cek){
    var oto     = '<?php echo ($this->session->userdata('otori')); ?>';
    var pilctk  = ctk;
    var cpilih  = $cek; 
    if(ctk==''){
      swal({
          title: "Error!",
          text: "MOHON DILENGKAPI CETAK OPD ATAU UNIT!!",
          type: "error",
          confirmButtonText: "OK"
          });
          exit();
    }
    var cini    = document.getElementById('ini').value;
    var cskpd   = $('#kdskpd').combogrid('getValue'); 
    var cnmskpd = document.getElementById('nmskpd').value;
    var cbid    = $('#kdubidskpd').combogrid('getValue');
    var cnm_bid = document.getElementById('nmbidskpd').value;
    //var lctahu  = document.getElementById('nip_tahu').value;
    //var lcbend  = document.getElementById('nip_bend').value;
    //var cnmbend = document.getElementById('nama_bend').value;
    //var cnmtahu = document.getElementById('nama_tahu').value; 
    var bulan   = $('#bulan').combogrid('getValue'); 
    var tahun   = $('#tahun').combogrid('getValue');
    var tahun1  = $('#tahun1').combogrid('getValue');
    var tahun2  = $('#tahun2').combogrid('getValue');
    var lctgl2  = $('#tgl_cetak').datebox('getValue');
    var url     = "<?php echo site_url(); ?>/laporan/lap_daftar_barang_hapus";
    var jenis   = $('#jenis').combogrid('getValue');
    var nmjenis = document.getElementById('nmjenis').value; 
    var nomor   = $('#nomor').combogrid('getValue');
    var tglh    = document.getElementById('tgl_hapus').value;

    //if(oto=='01'){
      if(ctk=='1'){
        if(cskpd==''){
          swal({
          title: "Error!",
          text: "MOHON DILENGKAPI KODE OPD.!!",
          type: "error",
          confirmButtonText: "OK"
          });
          exit();
        }if(nomor==''){
          swal({
          title: "Error!",
          text: "MOHON NOMOR DOKUMEN DIISI.!!",
          type: "error",
          confirmButtonText: "OK"
          });
          exit();
        }else{
          lc = '?pilih='+cpilih+'&tampil='+cini+'&skpd='+cskpd+'&nmskpd='+cnmskpd+'&bidang='+cbid+'&nmbid='+cnm_bid+'&tglcetak='+lctgl2+'&pilctk='+pilctk+'&no_dok='+nomor+'&th='+tglh;
        }
      }else if(ctk=='2'){
        if(cskpd==''){
          swal({
          title: "Error!",
          text: "MOHON DILENGKAPI KODE OPD.!!",
          type: "error",
          confirmButtonText: "OK"
          });
          exit();
        }else if(cbid==''){
          swal({
          title: "Error!",
          text: "MOHON DILENGKAPI UNIT.!!",
          type: "error",
          confirmButtonText: "OK"
          });
          exit();
        }if(nomor==''){
          swal({
          title: "Error!",
          text: "MOHON NOMOR DOKUMEN DIISI.!!",
          type: "error",
          confirmButtonText: "OK"
          });
          exit();
        }else{
          lc = '?pilih='+cpilih+'&tampil='+cini+'&skpd='+cskpd+'&nmskpd='+cnmskpd+'&bidang='+cbid+'&nmbid='+cnm_bid+'&tglcetak='+lctgl2+'&pilctk='+pilctk+'&no_dok='+nomor+'&th='+tglh;
        }
      }else if(ctk=='3'){
        if(lctahu=='' && lcbend==''){
          swal({
          title: "Error!",
          text: "MOHON PENANDATANGAN DIISI.!!",
          type: "error",
          confirmButtonText: "OK"
          });
          exit();
        }else{
          lc = '?pilih='+cpilih+'&tampil='+cini+'&skpd='+cskpd+'&nmskpd='+cnmskpd+'&bidang='+cbid+'&nmbid='+cnm_bid+'&tahun1='+tahun1+'&tahun2='+tahun2+'&tglcetak='+lctgl2+'&pilctk='+pilctk+'&jenis='+jenis+'&nmjenis='+nmjenis;
        }
        
      }
        window.open(url+lc,'_blank');
        window.focus();
    /*}else{

    }*/
  }
	
		
 
    $(function(){
      $('#kdskpd').combogrid({  
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
               lcunit = rowData.kd_lokasi;
               $('#kdubidskpd').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_ubidskpdh',queryParams:({skpd:lcskpd}) });
               $("#nmskpd").attr("value",rowData.nm_skpd.toUpperCase());
               $("#nmbidskpd").attr("value",'');
               $('#kdubidskpd').combogrid('clear');
               $('#jenis').combogrid('clear');
               $('#jenis').combogrid('grid').datagrid('reload');
               $('#bulan').combogrid('clear');
               $('#tahun').combogrid('clear');
               $('#tahun1').combogrid('clear');
               $('#tahun2').combogrid('clear');
               $('#tahu').combogrid('clear');
               $('#bend').combogrid('clear');
               $('#nomor').combogrid('clear');
               $('#tahu').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_pa',queryParams:({kduskpd:lcskpd,kode:'1'}) });
               $('#bend').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_pb',queryParams:({kduskpd:lcskpd,kode:'1'}) });
               if(ctk=='1'){
                  $('#nomor').combogrid({url:'<?php echo base_url(); ?>index.php/transaksi/ambil_dok_hapus',queryParams:({kduskpd:lcskpd,unit:''}) });
                  $('#nomor').combogrid('grid').datagrid('reload');
               }else{
                  $('#nomor').combogrid({url:'<?php echo base_url(); ?>index.php/transaksi/ambil_dok_hapus',queryParams:({kduskpd:'',unit:''}) });
                  $('#nomor').combogrid('grid').datagrid('reload');
               }
               
                                
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
               var skpd = $('#kdskpd').combogrid('getValue');
              // $('#kdubidskpd').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_uskpd',queryParams:({kduskpd:lcskpd}) });
               $("#nmbidskpd").attr("value",rowData.nm_uskpd.toUpperCase());
               $('#tahu').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_pa2',queryParams:({kduskpd:lcskpd}) });
               $('#bend').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_pb2',queryParams:({kduskpd:lcskpd}) });
               $('#nomor').combogrid({url:'<?php echo base_url(); ?>index.php/transaksi/ambil_dok_hapus',queryParams:({kduskpd:skpd,unit:lcskpd}) });
                             
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

         $('#nomor').combogrid({  
           panelWidth:500,  
           idField:'no_hapus',  
           textField:'no_hapus',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/transaksi/ambil_dok_hapus', 
           rownumbers:true,
           singleSelect:true,
           columns:[[  
               {field:'no_hapus',title:'NO DOKUMEN',width:350,align:'left'},
               {field:'tgl_hapus',title:'TGL DOKUMEN',width:100,align:'center'},    
           ]],  
           onSelect:function(rowIndex,rowData){
               $('#tgl_hapus').attr('value',rowData.tgl);                             
           }  
      });

      $('#jenis').combogrid({  
           panelWidth:500,  
           idField:'kode',  
           textField:'jenis',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/master/ambil_jenis2',
           //queryParams:({kode:'02'}), 
           columns:[[  
               {field:'kode',title:'KODE',width:100},  
               {field:'jenis',title:'JENIS',width:400}    
           ]],  
           onSelect:function(rowIndex,rowData){
               jenis = rowData.jenis;
               $("#nmjenis").attr("value",rowData.jenis.toUpperCase()); 
           }  
         });
		 
				 $('#tgl_cetak').datebox('setValue','<?php echo date('Y-m-d')?>');
				 $('#tgl_reg').datebox('setValue','<?php echo date('Y-m-d')?>');
    }); 

function bulan(){
  $('#bulan').combogrid({  
           panelWidth:300,  
           idField:'n_bulan',  
           textField:'bulan',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/master/ambil_bulan',  
           columns:[[  
               {field:'n_bulan',title:'No',width:50},  
               {field:'bulan',title:'NAMA BULAN',width:250}    
           ]],  
           onSelect:function(rowIndex,rowData){
                                            
           }  
      });
}
function tahun(){
  $('#tahun').combogrid({  
           panelWidth:100,  
           idField:'tahun',  
           textField:'tahun',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/master/tahun',  
           columns:[[  
               {field:'tahun',title:'TAHUN',width:50}    
           ]],  
           onSelect:function(rowIndex,rowData){
                                            
           }  
      });
}

function tahun1(){
  $('#tahun1').combogrid({  
           panelWidth:100,  
           idField:'tahun',  
           textField:'tahun',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/master/tahun',  
           columns:[[  
               {field:'tahun',title:'TAHUN',width:50}    
           ]],  
           onSelect:function(rowIndex,rowData){
                                            
           }  
      });
}

function tahun2(){
  $('#tahun2').combogrid({  
           panelWidth:100,  
           idField:'tahun',  
           textField:'tahun',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/master/tahun',  
           columns:[[  
               {field:'tahun',title:'TAHUN',width:50}    
           ]],  
           onSelect:function(rowIndex,rowData){
                                            
           }  
      });
}


  
   </script>



<div id="content1"> 
    <h3 align="center"><b>CETAK DAFTAR BARANG YANG AKAN DIHAPUS</b></h3>
    <fieldset>
     <table align="center" style="width:100%;" border="0">
            <tr>
                <td><input type="radio" name="cetak" value="1" onclick="opt(this.value)" />OPD &ensp;</td>
                <td><input type="radio" name="cetak" value="2" id="status" onclick="opt(this.value)" />UNIT&ensp;</td>
                <!-- <td><input type="radio" name="cetak" value="3" id="status" onclick="opt(this.value)" />Keseluruhan&ensp;</td> -->
            </tr>
            <tr>
                <td colspan="3">
                <div id="skpd">
                        <table style="width:100%;" border="0">
                            <td width="20%">OPD</td>
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
                <div id="div_jenis">
                        <table style="width:100%;" border="0">
                            <td width="20%">PILIH JENIS CETAK KIB</td>
                            <td width="1%">:</td>
                            <td width="79%"><input id="jenis" name="jenis" style="width: 300px;" />
                            <input type="hidden" id="nmjenis" readonly="true" style="width: 500px;border:0" />
                            </td>
                        </table>
                </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                <div id="nomor_dok">
                        <table style="width:100%;" border="0">
                            <td width="20%">NO DOKUMEN</td>
                            <td width="1%">:</td>
                            <td><input id="nomor" name="nomor" style="width: 300px;" />
                            <input type="hidden" id="tgl_hapus"/>  
                            </td> 
                        </table>
                </div>
                </td> 
            </tr>
            <tr>
              <td colspan="3">
                <div id="div_bulan">
                  <table style="width:100%;" border="0">
                    <td width="20%" >BULAN</td>
                    <td width="1%" >:</td>
                    <td width="79%" ><input  name="bulan" id="bulan" style="width: 150px;" >
                    </td>
                  </table>
                </div>
              </td>
            </tr>
            <tr>
              <td colspan="3">
                <div id="div_tahun">
                  <table style="width:100%;" border="0">
                    <td width="20%" >TAHUN</td>
                    <td width="1%" >:</td>
                    <td width="79%" ><input  name="tahun" id="tahun" style="width: 150px;" >
                    </td>
                  </table>
                </div>
              </td>
            </tr>
             <tr>
              <td colspan="3">
                <div id="div_tahunsd">
                  <table style="width:100%;" border="0">
                    <td width="20%" >TAHUN</td>
                    <td width="1%" >:</td>
                    <td width="79%" ><input  name="tahun1" id="tahun1" style="width: 150px;" > s/d <input  name="tahun2" id="tahun2" style="width: 150px;" >
                    </td>
                  </table>
                </div>
              </td>
            </tr>
            <!-- <tr>
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
            </tr> -->
            
            <!-- <tr>
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
            </tr> -->
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
					  <input type="radio" name="format" value="no"  onclick="formatx(this.value)"/>1. Tidak Tampilkan Unit<br/>    
					  <input type="radio" name="format" value="ya"  onclick="formatx(this.value)"/>2. Tampilkan Unit<br/>     
					  <input hidden="true" type="text"  name="ini" id="ini"/> 
				</form>
				</div>
			</td>
            </tr>
            <tr><td colspan="3">&nbsp;</td></tr> 
            <tr>
                <td colspan="3" align="center">
                <a  class="easyui-linkbutton" iconCls="icon-pdf" plain="false"  onclick="javascript:cetak(1);">Cetak Pdf</a>
                <a  class="easyui-linkbutton" iconCls="icon-excel" plain="false" onclick="javascript:cetak(2);">Cetak Excel</a>
                <a  class="easyui-linkbutton" iconCls="icon-word" plain="false" onclick="javascript:cetak(3);">Cetak Word</a>
		        <a href="<?php echo base_url();?>" class="easyui-linkbutton" iconCls="icon-undo" plain="false">Keluar</a>
                </td>                
            </tr>
        </table>  
            
    </fieldset>  
</div>