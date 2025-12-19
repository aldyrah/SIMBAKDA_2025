<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/demo/demo.css">
	<script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.edatagrid.js"></script>
    <link href="<?php echo base_url(); ?>easyui/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo base_url(); ?>easyui/jquery-ui.min.js"></script>
  <style>   
  
    
    </style>
    <script type="text/javascript"> 
	
    var nip='';
	var kdskpd='';
	var kdrek5='';
     var ctk='';
     $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
                height: 100,
                width: 922            
            });  
				$("#div_A").hide();           
				$("#div_bend").hide();           
				
        });   
    
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
			$("#skpd").attr("value",rowData.kd_skpd);
           
		}  
		}); 
	});
	
	 function opt(val){        
        ctk = val; 
        if (ctk=='1'){
          $("#div_A").hide();  
		  $("#div_bend").hide();  
        } else if (ctk=='2'){
         $("#div_A").show(); 
		 $("#div_bend").show();          
           } else {
        	exit();
        }                 
    }  
        
    $(function(){
   	    $('#dcetak').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });

   	    $('#dcetak2').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
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
        

    

    function cetak(){
    
	
	        var tgl1 =  cbulan = $('#bulan').combogrid('getValue');
			var uye = document.getElementById('uye').value;
			var apbd = document.getElementById('APBD').value;	
	
			var tgl1 =  cbulan = $('#bulan').combogrid('getValue');			
			ctglttd = $('#dcetak2').datebox('getValue');



if(ctk=='1'){
			var url ="<?php echo site_url(); ?>/akuntansi/kas_bul/1";
}else if(ctk=='2'){
				var url ="<?php echo site_url(); ?>/akuntansi/cetak_baru_bulan/1";
}
			
			window.open(url+'?bulan='+tgl1+'&tgl_ctk='+ctglttd+'&uye='+uye+'&apbd='+apbd);
			window.focus();
    }
     
	 
	   function eksport(){
    
	
	        var tgl1 =  cbulan = $('#bulan').combogrid('getValue');
			var uye = document.getElementById('uye').value;
			var apbd = document.getElementById('APBD').value;	
	
			var tgl1 =  cbulan = $('#bulan').combogrid('getValue');			
			ctglttd = $('#dcetak2').datebox('getValue');



if(ctk=='1'){
			var url ="<?php echo site_url(); ?>/akuntansi/kas_bul/2";
}else if(ctk=='2'){
				var url ="<?php echo site_url(); ?>/akuntansi/cetak_baru_bulan/2";
}
			
			window.open(url+'?bulan='+tgl1+'&tgl_ctk='+ctglttd+'&uye='+uye+'&apbd='+apbd);
			window.focus();
    }
     
    
        
  

    </script>

</head>
<body>
<p align="right">                       
    </p>    
<div id="content">
<h3>CETAK KAS</h3>
<div id="accordion">
 <table align="center" style="width:100%;" border="0">  
			
			<tr>
		     <td width="90%" align="left"><input name="a" type="radio"onclick="opt(this.value)" value="1" />&nbsp;LAPORAN POSISI KAS BULANAN</td>
				<td width="1%" align="left">&nbsp;</td>
			</tr>
			<tr>
			  <td width="90%" align="left"><input name="a" type="radio" onclick="opt(this.value)" value="2" />
			    &nbsp;LAPORAN RINGKASAN REALISASI APBD BULANAN</td>
				<td>&nbsp;</td>
			</tr>
            	 















 <tr>
                <td colspan="3">
                <div id="div_periode">
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
                              <div id="div_A">
                        <table style="width:100%;" border="0">
                            <td width="20%">JENIS APBD</td>
                            <td width="1%">:</td>
                            <td><select  name="APBD" id="APBD" >
							 <option value="0">PENYUSUNAN</option>
							 <option value="1" >PERUBAHAN</option> 
                            </td> 
                        </table>
                </div>
        </tr>
        
        
        
        
          <tr>
                <td colspan="3">
                <div id="div_bend">
                        <table style="width:100%;" border="0">
                            <td width="20%">TTD</td>
                            <td width="1%">:</td>
                            <td><select  name="uye" id="uye" >
							 <option value="0">KEPALA BPKAD</option>
							 <option value="1" >BUPATI</option> 
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
                            <td><input type="text" id="dcetak2" style="width: 100px;" /> 
                            </td> 
                        </table>
                </div>
                
          
                </td> 
            </tr> 		






    
    <tr>
    <td align="center" colspan="3">
    <a class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:cetak();">Cetak</a><a class="easyui-linkbutton" iconCls="icon-excel" plain="true" onclick="javascript:eksport();">export</a>
     </td>
		</tr>
   
    
	 </table>




        
  
</div>
</div>
</body>
</html>