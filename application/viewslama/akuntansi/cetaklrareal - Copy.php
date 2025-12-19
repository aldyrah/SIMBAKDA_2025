    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/default/easyui.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/icon.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/demo/demo.css">
  <script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery-1.8.0.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.easyui.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.edatagrid.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/autoCurrency.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/numberFormat.js"></script>
    <link href="<?php echo base_url(); ?>easyui/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo base_url(); ?>easyui/jquery-ui.min.js"></script>
    <script type="text/javascript">
  
     var ctk='';
  var val='';
   $(document).ready(function() {
      $("#spasi").attr("value",0);
        }); 
    
     $(function(){     
       $('#tgl1').datebox({  
            required:true,
            formatter :function(date){
              var y = date.getFullYear();
              var m = date.getMonth()+1;
              var d = date.getDate();
              return y+'-'+m+'-'+d;
            }
        });  
        
        $('#tgl_ttd').datebox({  
            required:true,
            formatter :function(date){
              var y = date.getFullYear();
              var m = date.getMonth()+1;
              var d = date.getDate();
              return y+'-'+m+'-'+d;
            }
        });         
      var cdate='<?php echo date('Y-m-d'); ?>';
   $("#tgl_ttd").datebox("setValue",cdate);
    
      $('#ttd').combogrid({  
        panelWidth:500,  
        url: '<?php echo base_url(); ?>/index.php/tukd/list_ttd',  
          idField:'nip',                    
          textField:'nama',
          mode:'remote',  
          fitColumns:true,  
          columns:[[  
            {field:'nip',title:'NIP',width:60},  
            {field:'nama',title:'NAMA',align:'left',width:100}                
          ]],
          onSelect:function(rowIndex,rowData){
          nip = rowData.nip;
          
          }   
        });
            
               $('#bulan').combogrid({  
                   panelWidth:120,
                   panelHeight:300,  
                   idField:'bln',  
                   textField:'nm_bulan',  
                   mode:'remote',
                   url:'<?php echo base_url(); ?>index.php/rka/bulan',  
                   columns:[[ 
                       {field:'nm_bulan',title:'Nama Bulan',width:700}    
                   ]] 
               });      
      
       });
   
   
    function opt(val){      
  ctk=val;
  
  }
   
     
     function cetak(){
     
if(ctk==''){
ctk=1;
}

var ctglttd = $('#tgl_ttd').datebox('getValue');
var spasi= document.getElementById('spasi').value;
var cbulan= $('#bulan').combogrid('getValue');
var skpd1 = $('#sskpd').combogrid("getValue");


if(cbulan==''){
alert("isi bulan dulu");
exit();
}


   
if(ctk==1){
var url ="<?php echo site_url(); ?>/akuntansi/cetak_lra_real";
}else{
var url ="<?php echo site_url(); ?>/akuntansi/cetak_lra_real1"; 
}


   
 lc = '?nbulan='+cbulan+'&tgl_ttd='+ctglttd+'&spasi='+spasi+'&kd_skpd='+skpd1;
        
         window.open(url+lc,'_blank');
         window.focus();
         
     }  
     
   
   $(function(){
  $('#sskpd').combogrid({  
    panelWidth:630,  
    idField:'kd_skpd',  
    textField:'kd_skpd',  
    mode:'remote',
    url:'<?php echo base_url(); ?>index.php/akuntansi/skpd',  
    columns:[[  
      {field:'kd_skpd',title:'Kode SKPD',width:100},  
      {field:'nm_skpd',title:'Nama SKPD',width:500}    
    ]],
    onSelect:function(rowIndex,rowData){
      kdskpd = rowData.kd_skpd;
      $("#nmskpd").attr("value",rowData.nm_skpd);
      $("#sskpd").attr("value",rowData.kd_skpd);
           
    }  
    }); 
  });
   
   </script>





<div id="content1" align="center"> 
    <h3 align="center"><b>CETAK LRA BERDASARKAN SP2D TERBIT</b></h3>
     <table align="center" style="width:100%;" border="0">                    
            <tr>
                <td colspan="3">
                <div id="div_periode">
                
                
                
                
                 <table style="width:100%;" border="0">
                            <td width="40%">
                            <input type="radio" name="cetak" value="1" onSelect="opt(this.value)" onclick="opt(this.value)" checked/>
                            &nbsp;REALISASI - ANGGARAN  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 

                            
                            <input type="radio" name="cetak" value="2" onclick="opt(this.value)" />
                            &nbsp;ANGGARAN - REALISASI </td>
                           
                        </table>
                
                
                
                
                
                
                 <table style="width:100%;" border="0">
                            <td width="20%">&nbsp;</td>
                          
                        </table>
                
                  <table style="width:100%;" border="0">
                            <td width="20%">SKPD</td>
                            <td width="1%">:</td>
                            <td width="79%"><input id="sskpd" name="sskpd" style="width: 150px;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input id="nmskpd" name="nmskpd" style="width: 500px; border:0;" />
                            </td>
                        </table>
                
                
                
                        <table style="width:100%;" border="0">
                            <td width="20%">BULAN</td>
                            <td width="1%">:</td>
                            <td width="79%"><input type="text" id="bulan" style="width: 100px;" /> 
                            </td>
                        </table>
                </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                <div id="div_bend">
                        <table style="width:100%;" border="0">
                            <td width="20%">TANGGAL TTD</td>
                            <td width="1%">:</td>
                            <td><input type="text" id="tgl_ttd" style="width: 100px;" /> 
                            </td> 
                        </table>
                </div>
                </td> 
            </tr>
       <tr>
                <td colspan="3">
                <div>
                
                
                
                
                        <table style="width:100%;" border="0">
                            <td width="20%">ENTER TTD</td>
                            <td width="1%">:</td>
                            <td><input type="text" id="spasi" style="width: 50px;" /> 
                            </td> 
                        </table>
                        
                        
                </div>
                </td> 
            </tr>
            <td colspan="3">&nbsp;</td>
            </tr>            
            <tr>
                <td colspan="3" align="center">
                <a class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:cetak()">Cetak</a>
                </td>                
            </tr>
        </table>  
            
  
</div>  
