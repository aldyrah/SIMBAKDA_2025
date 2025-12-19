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
          
          $("#div_tahunsd").hide();
		      $("#div_tahun").hide();
          $("#div_bulan").hide();
          $("#skpd").hide();
          
          tahun3();
          tahun1();
          tahun2();
          bulan();
    });
	
	function opt(val){        
        ctk = val;
        if (ctk=='1'){
            $('#tahun1').combogrid('clear');
            $('#tahun2').combogrid('clear');
            $('#bulan').combogrid('clear');
            $('#tahun3').combogrid('clear');
            $("#div_bulan").hide();
			$("#div_tahun").hide();
            $("#div_tahunsd").show();
            $("#skpd").hide();
        } else if(ctk=='2'){
            $('#tahun1').combogrid('clear');
            $('#tahun2').combogrid('clear');
            $('#bulan').combogrid('clear');
            $('#tahun3').combogrid('clear');
            $("#div_tahunsd").hide();
			$("#div_tahun").show();
            $("#div_bulan").show();
            $("#skpd").show();
        }else{
            exit();
        }      
			//openWindow();
    }
               
    

  function cetak($cek){
    var oto     = '<?php echo ($this->session->userdata('otori')); ?>';
    var cpilih  = $cek; 
	  var pilctk  = ctk;
    var cskpd   = $('#kdskpd').combogrid('getValue');
    var cnmskpd = document.getElementById('nmskpd').value;
    var tahun1  = $('#tahun1').combogrid('getValue');
    var tahun2  = $('#tahun2').combogrid('getValue');
	  var tahun3  = $('#tahun3').combogrid('getValue');
	  var bulan   = $('#bulan').combogrid('getValue');
    var lctgl   = $('#tgl_cetak').datebox('getValue');
	
	if(ctk=='1'){
		if(tahun1=='' || tahun2==''){
		  swal({
			  title: "Error!",
			  text: "MOHON TAHUN DIISI!!",
			  type: "error",
			  confirmButtonText: "OK"
			  });
			  exit();
		}
		lc = '?pilih='+cpilih+'&tahun1='+tahun1+'&tahun2='+tahun2+'&lctgl='+lctgl+'&pilctk='+pilctk;
	}else if(ctk=='2'){
		if(tahun3==''){
		  swal({
			  title: "Error!",
			  text: "MOHON TAHUN DIISI!!",
			  type: "error",
			  confirmButtonText: "OK"
			  });
			  exit();
		}
		if(bulan==''){
		  swal({
			  title: "Error!",
			  text: "MOHON BULAN DIISI!!",
			  type: "error",
			  confirmButtonText: "OK"
			  });
			  exit();
		}
		lc = '?pilih='+cpilih+'&skpd='+cskpd+'&nmskpd='+cnmskpd+'&tahun3='+tahun3+'&bulan='+bulan+'&lctgl='+lctgl+'&pilctk='+pilctk;
	}
	
    var url     = "<?php echo site_url(); ?>/laporan_kebijakan/rekap_susut";
    //lc = '?pilih='+cpilih+'&tahun1='+tahun1+'&tahun2='+tahun2+'&lctgl='+lctgl;
    window.open(url+lc,'_blank');
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
           
                                
           }  
         });
		
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

function tahun3(){
  $('#tahun3').combogrid({  
           panelWidth:100,  
           idField:'tahun',  
           textField:'tahun',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/master/tahun3',  
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
    <h3 align="center"><b>CETAK LAPORAN REKAP NILAI PEROLEHAN DAN PENYUSUTAN</b></h3>
    <fieldset>
     <table align="center" style="width:100%;" border="0">
	 		<tr>
                <td><input type="radio" name="cetak" value="1" onclick="opt(this.value)" />TAHUN &ensp;</td>
                <td><input type="radio" name="cetak" value="2" id="status" onclick="opt(this.value)" />BULAN dan TAHUN&ensp;</td>
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
                    <td width="79%" ><input  name="tahun3" id="tahun3" style="width: 150px;" > 
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
                <a  class="easyui-linkbutton" iconCls="icon-pdf" plain="false"  onclick="javascript:cetak(1);">Cetak Pdf</a>
                <a  class="easyui-linkbutton" iconCls="icon-excel" plain="false" onclick="javascript:cetak(2);">Cetak Excel</a>
                <a  class="easyui-linkbutton" iconCls="icon-word" plain="false" onclick="javascript:cetak(3);">Cetak Word</a>
                <a  class="easyui-linkbutton" iconCls="icon-note_book" plain="false" onclick="javascript:cetak(4);">Cetak HTML</a>
		        <a href="<?php echo base_url();?>" class="easyui-linkbutton" iconCls="icon-undo" plain="false">Keluar</a>
                </td>                
            </tr>
        </table>  
            
    </fieldset>  
</div>