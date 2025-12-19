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
          $("#nmbidskpd").attr("value",'');
          $("#pilihancetak").hide();
          tahun();
          tahun1();
          tahun2();
          bulan();
    });
               
    function opt(val){        
        ctk = val;
        if (ctk=='1'){
            $("#pilihancetak").show();
            $('input[name="cetak2"]').prop('checked', false);
            $('#tahun1').combogrid('clear');
            $('#tahun2').combogrid('clear');
            $('#bulan').combogrid('clear');
            $('#tahun').combogrid('clear');
            $("#skpd").show();
            $("#div_skpd").hide();
            $("#model_ctk").hide();
            $("#div_tahunsd").hide();
            $("#div_tahun").hide();
            $("#div_bulan").hide();
            $("#div_jenis").show();
        } else if (ctk=='2'){
            $("#pilihancetak").show();
            $('input[name="cetak2"]').prop('checked', false);
            $('#tahun1').combogrid('clear');
            $('#tahun2').combogrid('clear');
            $('#bulan').combogrid('clear');
            $('#tahun').combogrid('clear');
            $("#skpd").show();
            $("#div_skpd").show();
            $("#model_ctk").hide();
            $("#div_tahunsd").hide();
            $("#div_tahun").hide();
            $("#div_bulan").hide();
            $("#div_jenis").show();
        } else if (ctk=='3'){
            $("#skpd").show();
            $("#div_skpd").hide();
            $("#model_ctk").hide();
            $("#div_tahunsd").show();
            $("#div_tahun").hide();
            $("#div_bulan").hide();
            $("#div_jenis").show();
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
    var blnthn  = ctk2;
    var cpilih  = $cek; 
    if(ctk==''){
      swal({
          title: "Error!",
          text: "MOHON DILENGKAPI CETAK SKPD , UNIT ATAU KESELURUHAN!!",
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
    var bulan   = $('#bulan').combogrid('getValue');
    var tahun   = $('#tahun').combogrid('getValue');
    var tahun1  = $('#tahun1').combogrid('getValue');
    var tahun2  = $('#tahun2').combogrid('getValue');
    var lctgl2  = $('#tgl_cetak').datebox('getValue');
    var url     = "<?php echo site_url(); ?>/laporan_inventaris/lap_kib_c_dh_all";
    var jenis   = $('#jenis').combogrid('getValue');
    var nmjenis = document.getElementById('nmjenis').value; 

    //if(oto=='01'){
      if(ctk=='1'){
        if(cskpd==''){
          swal({
          title: "Error!",
          text: "MOHON DILENGKAPI KODE SKPD.!!",
          type: "error",
          confirmButtonText: "OK"
          });
          exit();
        }
        if(bulan=='' && blnthn=='01'){
          swal({
          title: "Error!",
          text: "MOHON BULAN DI ISI.!!",
          type: "error",
          confirmButtonText: "OK"
          });
          exit();
        }if(tahun=='' && blnthn=='01'){
          swal({
          title: "Error!",
          text: "MOHON TAHUN DIISI.!!",
          type: "error",
          confirmButtonText: "OK"
          });
          exit();
        }if(tahun1=='' && blnthn=='02'){
          swal({
          title: "Error!",
          text: "PERIODE TAHUN MOHON DILENGKAPI.!!",
          type: "error",
          confirmButtonText: "OK"
          });
          exit();
        }if(tahun2=='' && blnthn=='02'){
          swal({
          title: "Error!",
          text: "PERIODE TAHUN MOHON DILENGKAPI.!!",
          type: "error",
          confirmButtonText: "OK"
          });
          exit();
        }if(tahun2<tahun1 && blnthn=='02'){
          swal({
          title: "Error!",
          text: "PERIODE TAHUN PERTAMA TIDAK BOLEH LEBIH KECIL DARI TAHUN KEDUA.!!",
          type: "error",
          confirmButtonText: "OK"
          });
          exit();
        }if(jenis==''){
          swal({
          title: "Error!",
          text: "PILIH JENIS KIB!!",
          type: "error",
          confirmButtonText: "OK"
          });
          exit();
        }else{
          if(blnthn=='01'){
            lc = '?pilih='+cpilih+'&tampil='+cini+'&skpd='+cskpd+'&nmskpd='+cnmskpd+'&bidang='+cbid+'&nmbid='+cnm_bid+'&bulan='+bulan+'&tahun='+tahun+'&tglcetak='+lctgl2+'&pilctk='+pilctk+'&jenis='+jenis+'&nmjenis='+nmjenis+'&blnthn='+blnthn;
          }else{
            lc = '?pilih='+cpilih+'&tampil='+cini+'&skpd='+cskpd+'&nmskpd='+cnmskpd+'&bidang='+cbid+'&nmbid='+cnm_bid+'&tahun1='+tahun1+'&tahun2='+tahun2+'&tglcetak='+lctgl2+'&pilctk='+pilctk+'&jenis='+jenis+'&nmjenis='+nmjenis+'&blnthn='+blnthn;
          }
          
        }
      }else if(ctk=='2'){
        if(cskpd==''){
          swal({
          title: "Error!",
          text: "MOHON DILENGKAPI KODE SKPD.!!",
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
        }if(bulan=='' && blnthn=='01'){
          swal({
          title: "Error!",
          text: "MOHON BULAN DI ISI.!!",
          type: "error",
          confirmButtonText: "OK"
          });
          exit();
        }if(tahun=='' && blnthn=='01'){
          swal({
          title: "Error!",
          text: "MOHON TAHUN DIISI.!!",
          type: "error",
          confirmButtonText: "OK"
          });
          exit();
        }if(tahun1=='' && blnthn=='02'){
          swal({
          title: "Error!",
          text: "PERIODE TAHUN MOHON DILENGKAPI.!!",
          type: "error",
          confirmButtonText: "OK"
          });
          exit();
        }if(tahun2=='' && blnthn=='02'){
          swal({
          title: "Error!",
          text: "PERIODE TAHUN MOHON DILENGKAPI.!!",
          type: "error",
          confirmButtonText: "OK"
          });
          exit();
        }if(tahun2<tahun1 && blnthn=='02'){
          swal({
          title: "Error!",
          text: "PERIODE TAHUN PERTAMA TIDAK BOLEH LEBIH KECIL DARI TAHUN KEDUA.!!",
          type: "error",
          confirmButtonText: "OK"
          });
          exit();
        }if(jenis==''){
          swal({
          title: "Error!",
          text: "PILIH JENIS KIB!!",
          type: "error",
          confirmButtonText: "OK"
          });
          exit();
        }else{
          if(blnthn=='01'){
            lc = '?pilih='+cpilih+'&tampil='+cini+'&skpd='+cskpd+'&nmskpd='+cnmskpd+'&bidang='+cbid+'&nmbid='+cnm_bid+'&bulan='+bulan+'&tahun='+tahun+'&tglcetak='+lctgl2+'&pilctk='+pilctk+'&jenis='+jenis+'&nmjenis='+nmjenis+'&blnthn='+blnthn;
          }else{
            lc = '?pilih='+cpilih+'&tampil='+cini+'&skpd='+cskpd+'&nmskpd='+cnmskpd+'&bidang='+cbid+'&nmbid='+cnm_bid+'&tahun1='+tahun1+'&tahun2='+tahun2+'&tglcetak='+lctgl2+'&pilctk='+pilctk+'&jenis='+jenis+'&nmjenis='+nmjenis+'&blnthn='+blnthn;
          }
          
        }
      }else if(ctk=='3'){
        if(tahun1=='' || tahun2==''){
          swal({
          title: "Error!",
          text: "MOHON TAHUN DIISI.!!",
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
               {field:'kd_skpd',title:'KODE SKPD',width:100},  
               {field:'nm_skpd',title:'NAMA SKPD',width:400}    
           ]],  
           onSelect:function(rowIndex,rowData){
               lcskpd = rowData.kd_skpd;
               lcunit = rowData.kd_lokasi;
               $('#kdubidskpd').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_ubidskpdh',queryParams:({skpd:lcskpd}) });
               $("#nmskpd").attr("value",rowData.nm_skpd.toUpperCase());
               $('#kdubidskpd').combogrid('clear');
               $('#jenis').combogrid('clear');
               $('#bulan').combogrid('clear');
               $('#tahun').combogrid('clear');
               $('#tahun1').combogrid('clear');
               $('#tahun2').combogrid('clear');
               $('#tahu').combogrid('clear');
               $('#bend').combogrid('clear');
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

      $('#jenis').combogrid({  
           panelWidth:500,  
           idField:'kode',  
           textField:'jenis',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/master/ambil_jenis',
           queryParams:({kode:'03'}), 
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
  function opt2(val){
  ctk2=val;
  if(ctk2=='01'){
      $("#div_bulan").show();
      $("#div_tahun").show();
      $("#div_tahunsd").hide();
      $('#tahun1').combogrid('clear');
      $('#tahun2').combogrid('clear');
  }else{
      $("#div_bulan").hide();
      $('#bulan').combogrid('clear');
      $("#div_tahun").hide();
      $('#tahun').combogrid('clear');
      $("#div_tahunsd").show();
  }

}
  
   </script>



<div id="content1"> 
    <h3 align="center"><b>CETAK LAPORAN KIB C<br>
    KARTU INVENTARIS GEDUNG DAN BANGUNAN (KOMPILASI)</b></h3>
    <fieldset>
     <table align="center" style="width:100%;" border="0">
            <tr>
                <td><input type="radio" name="cetak" value="1" onclick="opt(this.value)" />SKPD &ensp;</td>
                <td><input type="radio" name="cetak" value="2" id="status" onclick="opt(this.value)" />UNIT&ensp;</td>
                <!-- <td><input type="radio" name="cetak" value="3" id="status" onclick="opt(this.value)" />Keseluruhan&ensp;</td> -->
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
                <div id="pilihancetak">
                        <table style="width:100%;" border="0">
                            <td width="20%">Pilih Periode</td>
                            <td width="1%">:</td>
                            <td><input type="radio" name="cetak2" value="01" onclick="opt2(this.value)" />Periode Per Bulan &ensp;</td>
                            <td><input type="radio" name="cetak2" value="02" id="status" onclick="opt2(this.value)" />Periode Per Tahun&ensp;</td>
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