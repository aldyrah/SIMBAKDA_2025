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
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/autoCurrency.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/numberFormat.js"></script>
    <link href="<?php echo base_url(); ?>easyui/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo base_url(); ?>easyui/jquery-ui.min.js"></script>
   
    <script type="text/javascript"> 
    var ctk='';
	var val='';
	 $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
				height: 360,
				width: 900,
				modal: true,
				autoOpen:false,
			});
			   
    

 
		$("#div_bend").hide();
			$("#div_bend1").hide();
			$("#div_periode").hide();
						$("#skp2").hide();
			

			$("#spasi").attr("value",0);
			
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
			   
			   
			       $('#tgl_ttd').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });      
			   
	});
	$(function(){
    	$('#rek3').combogrid({  
    		panelWidth:500,  
    		url: '<?php echo base_url(); ?>/index.php/tukd/list_mrek3',  
    			idField:'kd_rek3',                    
    			textField:'kd_rek3',
    			mode:'remote',  
    			fitColumns:true,  
    			columns:[[  
    				{field:'kd_rek3',title:'Rekening',width:30},  
    				{field:'nm_rek3',title:'Nama Rekening',align:'left',width:100}								
    			]],
    			onSelect:function(rowIndex,rowData){
    				$("#nmrek3").attr("value",rowData.nm_rek3);
    			}   
    		});
       });

	   
	   $(function(){
    	$('#ttd').combogrid({  
    		panelWidth:500,  
    		url: '<?php echo base_url(); ?>/index.php/tukd/load_ptd',  
    			idField:'nip',                    
    			textField:'nama',
    			mode:'remote',  
    			fitColumns:true,  
    			columns:[[  
    				{field:'nip',title:'NIP',width:30},  
    				{field:'nama',title:'NAMA',align:'left',width:100}								
    			]],
    			onSelect:function(rowIndex,rowData){
    				$("#ttd").attr("value",rowData.nip);
    			}   
    		});
       });	   




$(function(){
    	$('#sdana').combogrid({  
    		panelWidth:500,  
    		url: '<?php echo base_url(); ?>/index.php/tukd/load_sdana',  
    			idField:'kd_sdana',                    
    			textField:'nm_sdana',
    			mode:'remote',  
    			fitColumns:true,  
    			columns:[[  
    				{field:'kd_sdana',title:'kode',width:30},  
    				{field:'nm_sdana',title:'sumber dana',align:'left',width:100}								
    			]],
    			onSelect:function(rowIndex,rowData){
    				$("#sdana").attr("value",rowData.nm_rek3);
    			}   
    		});
       });



$(function(){ 
        
      $("#periode").hide();
      
       $('#tgl1').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });  
        
         
        
        $('#tgl2').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });
        });
		
$(function(){ 
        
       $('#tglttd').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });  
        
        });
		
		
		
		
		
		
		
		
		
		

	function cetak()
	{  
	
	var skpd = $('#sskpd123').combogrid("getValue");
        
		if(ctk=='1'){
var url    = "<?php echo site_url(); ?>/rka/preview_dppa0/"+skpd+"/1/";  

		}else if(ctk=='2'){
var url    = "<?php echo site_url(); ?>/rka/preview_dppa1/"+skpd+"/1/";  

		}else if(ctk=='3'){
var url    = "<?php echo site_url(); ?>/rka/preview_dppa21/"+skpd+"/1/";  
			lc= '?skpd='+skpd;
		}else if(ctk=='4'){
			
			var url    = "<?php echo site_url(); ?>/rka/preview_dppa22/"+skpd+"/1/";  

		}else if(ctk=='5'){
var url    = "<?php echo site_url(); ?>/rka/preview_dpa0/"+skpd+"/1/";  

		}else if(ctk=='6'){
var url    = "<?php echo site_url(); ?>/rka/preview_dpa1/"+skpd+"/1/";  

		}else if(ctk=='7'){
var url    = "<?php echo site_url(); ?>/rka/preview_dpa21/"+skpd+"/1/";  
			lc= '?skpd='+skpd;
		}else if(ctk=='8'){
			
			var url    = "<?php echo site_url(); ?>/rka/preview_dpa22/"+skpd+"/1/";  
			
}else if(ctk=='9'){
			
			var url    = "<?php echo site_url(); ?>/rka/preview_dppa221a/"+skpd+"/1/";  

}else if(ctk=='10'){
			
			var url    = "<?php echo site_url(); ?>/rka/preview_dpa221dh/"+skpd+"/1/";  



		}
			window.open(url, '_blank');
			window.focus();
	}

	function cetakx()
	{   	var skpd = $('#sskpd123').combogrid("getValue");
        
		if(ctk=='1'){
var url    = "<?php echo site_url(); ?>/rka/preview_dppa0/"+skpd+"/2/";  

		}else if(ctk=='2'){
var url    = "<?php echo site_url(); ?>/rka/preview_dppa1/"+skpd+"/2/";  

		}else if(ctk=='3'){
var url    = "<?php echo site_url(); ?>/rka/preview_dppa21/"+skpd+"/2/";  
			lc= '?skpd='+skpd;
		}else if(ctk=='4'){
			
			var url    = "<?php echo site_url(); ?>/rka/preview_dppa22/"+skpd+"/2/";  

		}else if(ctk=='5'){
var url    = "<?php echo site_url(); ?>/rka/preview_dpa0/"+skpd+"/2/";  

		}else if(ctk=='6'){
var url    = "<?php echo site_url(); ?>/rka/preview_dpa1/"+skpd+"/2/";  

		}else if(ctk=='7'){
var url    = "<?php echo site_url(); ?>/rka/preview_dpa21/"+skpd+"/2/";  
			lc= '?skpd='+skpd;
		}else if(ctk=='8'){
			
			var url    = "<?php echo site_url(); ?>/rka/preview_dpa22/"+skpd+"/2/";  
}else if(ctk=='9'){
			
			var url    = "<?php echo site_url(); ?>/rka/preview_dppa221a/"+skpd+"/2/";  

}else if(ctk=='10'){
			
			var url    = "<?php echo site_url(); ?>/rka/preview_dpa221dh/"+skpd+"/2/";  


		}
			window.open(url+lc, '_blank');
			window.focus();
	}
		
	 function opt(val){        
        ctk = val; 
        if (ctk=='1'){
					$("#div_bend").show();
			$("#div_bend1").show();
			$("#div_periode").show();
			
		}else if (ctk=='2'){
			$("#div_sdana").hide();
		    $("#reke").hide();
            $("#div_bulan").show();
            $("#div_gaji").hide();
            $("#periode").hide();
			$("#div_ptd").hide();
			$("#div_skpd").hide();
			$("#gaya").hide();
			$("#div_reke").hide();
$("#skp2").hide();			
	}else if (ctk=='3'){
		$("#skp2").show();
				$("#div_bend").hide();
			$("#div_bend1").hide();
			$("#div_periode").hide();
}else if (ctk=='4'){
			$("#div_sdana").hide();
		    $("#reke").hide();
            $("#div_bulan").hide();
            $("#div_gaji").hide();
            $("#periode").hide();
			$("#div_ptd").hide();
			$("#div_skpd").hide();
			$("#gaya").hide();
			$("#div_reke").hide();

        }else {
			exit();
        } 
    }     
	
	$(function(){
	$('#sskpd123').combogrid({  
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
			nm_skpd = rowData.nm_skpd;
			$("#nmskpd123").attr("value",rowData.nm_skpd);
			$("#skpd123").attr("value",rowData.kd_skpd);
           
		}  
		}); 
	});


 function opt3(val){        
        ctk11 = val; 
        if (ctk11=='1'){
		    $("#tagih2").hide();
			 $("#sskpd123").combogrid("setValue",'');
			 $("#nmskpd123").attr("Value",'');
        } else if (ctk11=='2'){
			$("#tagih2").show();
		}else {
			exit();
        } 
    }     	   
      
	
		 function opt1(val){        
        ctk1 = val; 
        if (ctk1=='1'){
		    $("#tagih").hide();
			 $("#sskpd").combogrid("setValue",'');
			 $("#nmskpd").attr("Value",'');
        } else if (ctk1=='2'){
			$("#tagih").show();
		}else {
			exit();
        } 
    }     

    </script>

    <STYLE TYPE="text/css"> 
		 input.right{ 
         text-align:right; 
         } 
	</STYLE> 

</head>
<body>

<div id="content"> 
<div id="accordion">
<h5 align="center"><b><a href="#" id="section1">DPPA &amp; DPA</a></b></h5>

 <fieldset>
     <table align="center" style="width:100%;" border="1">  
			<tr>
				<td colspan="2" align="center" style="border-top:solid 1px red;border-bottom:solid 1px red"><i>DPPA & DPA SKPD</i></td>
			</tr>
			<tr>
				<td width="50%" />&nbsp;</td>
				<td width="50%" />&nbsp;</td>
			</tr>
						<tr>
				<td width="50%" align="left">&nbsp;<B>PERUBAHAN</B></td>
				<td width="50%" align="left">&nbsp;<B>PENYUSUNAN</B></td>
			</tr>

			<tr>
				<td width="50%" align="left"><input type="radio" name="cetak" value="1" onclick="opt(this.value)"/>
				&nbsp;DPPA0</td>
				<td width="50%" align="left"><input type="radio" name="cetak" value="5" onclick="opt(this.value)"/>&nbsp;DPA0</td>
			</tr>
            <tr>
			  <td width="50%" align="left"><input type="radio" name="cetak" value="2" onclick="opt(this.value)"/>
				&nbsp;DPPA1</td>
			  <td width="50%" align="left"><input type="radio" name="cetak" value="6" onclick="opt(this.value)"/>&nbsp;DPA1&nbsp;</td>
			</tr>
			<tr>
			  <td width="50%" align="left"><input type="radio" name="cetak" value="3" onclick="opt(this.value)"/>
				DPPA21</td>
			  <td width="50%" align="left"><input type="radio" name="cetak" value="7" onclick="opt(this.value)"/>&nbsp;DPA21&nbsp;</td>
			</tr>
            <tr>
			  <td width="50%" align="left"><input type="radio" name="cetak" value="4" onclick="opt(this.value)"/>
				DPPA22</td>
			  <td width="50%" align="left"><input type="radio" name="cetak" value="8" onclick="opt(this.value)"/>&nbsp;DPA22&nbsp;&nbsp;</td>
			</tr>
            <tr>
			  <td width="50%" align="left"><input type="radio" name="cetak" value="9" onclick="opt(this.value)"/>
				DPPA221</td>
			  <td width="50%" align="left"><input type="radio" name="cetak" value="10" onclick="opt(this.value)"/>&nbsp;DPA221&nbsp;&nbsp;</td>
			</tr>
             
    
	 </table><br>
   

<td width="922px" colspan="2">
			
				<table >
					<tr >
						<td width="22px" height="10%" ><B>SKPD</B></td>
						<td width="900px"><input id="sskpd123" name="sskpd" style="width: 150px;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="nmskpd123" name="nmskpd123" style="width: 500px; border:0;" /></td>
					</tr>
				</table> 
			
            </td></tr>



<div id="cetak">
		<p align="center">         
			<a class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:cetak();">cetak</a> 
			<a class="easyui-linkbutton" iconCls="icon-excel" plain="true" onclick="javascript:cetakx();">Export</a>  
          
		</p> 
	  </div>  
</fieldset>
    

</div>

</div>

 	
</body>

</html>