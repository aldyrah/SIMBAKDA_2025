<script src="<?php echo base_url(); ?>lib/sweet-alert.min.js"></script>
<link   rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>lib/sweet-alert.css">
<script type="text/javascript">
    
    var kdwil= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
    var ctk = '';
    var ctk2='';

    $(document).ready(function() {
          
          $("#div_tahunsd").show();
          
          tahun();
          tahun1();
          tahun2();
          bulan();
    });
               
    

  function cetak($cek){
    var oto     = '<?php echo ($this->session->userdata('otori')); ?>';
    var cpilih  = $cek; 
    var tahun1  = $('#tahun1').combogrid('getValue');
    var tahun2  = $('#tahun2').combogrid('getValue');
    var lctgl   = $('#tgl_cetak').datebox('getValue');
    if(tahun1=='' || tahun2==''){
      swal({
          title: "Error!",
          text: "MOHON TAHUN DIISI!!",
          type: "error",
          confirmButtonText: "OK"
          });
          exit();
    }
    var url     = "<?php echo site_url(); ?>/laporan_kebijakan/rekap_susut";
    
    
    lc = '?pilih='+cpilih+'&tahun1='+tahun1+'&tahun2='+tahun2+'&lctgl='+lctgl;
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
    <h3 align="center"><b>CETAK LAPORAN REKAP NILAI PEROLEHAN DAN PENYUSUTAN</b></h3>
    <fieldset>
     <table align="center" style="width:100%;" border="0">
           
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