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
    var nip='';
	
	 $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
            height: 360,
            width: 900,
            modal: true,
            autoOpen:false,
        });
		$("#tagih").hide();
			$("#gaya").hide();
		$("#div_periode").hide();
		$("#div_ttd").hide();
		$("#rinci").hide();
		$("#div_sdana").hide();
		
			
        });

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
	
	
	
	 function opt(val){        
        ctk = val; 
        if (ctk=='1'){
			$("#div_ttd").hide();
			$("#gaya").show();
			$("#div_periode").hide();
			$("#rinci").show();
				$("#div_sdana").show();
        }else if(ctk=='2'){
			$("#div_ttd").hide();
			$("#gaya").show();
			$("#div_periode").hide();
			$("#rinci").show();
			$("#div_sdana").show();
		
	}else{
		
		
			exit();
        } 
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
			$("#skpd").attr("value",rowData.kd_skpd);
           
		}  
		}); 
	});
	
	
	
	
	
	    function validate1(){
        var bln1 = document.getElementById('bulan1').value;
        
    }
	
	
	
	
	


		function cetak()
        {
		var skpd=$('#sskpd').combogrid("getValue");
			//var bulan   =  document.getElementById('bulan1').value;
			var spasi =document.getElementById('spasi').value;
			//var tglttd = $('#tgl_ttd').datebox("getValue");
			var sdana = $('#sdana').combogrid("getValue");

if(ctk=='1'){
		var url    = "<?php echo site_url(); ?>/rka/anggaranpersumberdanaspd/1/";  
			lc= '?skpd='+skpd+'&sumber='+sdana;
}else if(ctk=='2'){
			var url  = "<?php echo site_url(); ?>/rka/anggaranpersumberdanaspdrinci/1/";  
			lc= '?skpd='+skpd+'&sumber='+sdana;
			}

				window.open(url+lc, '_blank');
				window.focus();
        }
		
		function cetak_ex()
        {
		var skpd=$('#sskpd').combogrid("getValue");
			//var bulan   =  document.getElementById('bulan1').value;
			var spasi =document.getElementById('spasi').value;
			//var tglttd = $('#tgl_ttd').datebox("getValue");
			var sdana = $('#sdana').combogrid("getValue");

if(ctk=='1'){
		var url    = "<?php echo site_url(); ?>/rka/anggaranpersumberdanaspd/2/";  
			lc= '?skpd='+skpd+'&sumber='+sdana;
		}else if(ctk=='2'){
			var url    = "<?php echo site_url(); ?>/rka/anggaranpersumberdanaspdrinci/2/";  
			lc= '?skpd='+skpd+'&sumber='+sdana;
			}


				window.open(url+lc, '_blank');
				window.focus();
        }
		
		function cetak_ex1()
        {
		
			var skpd=$('#sskpd').combogrid("getValue");
if(ctk=='1'){
		var url    = "<?php echo site_url(); ?>/rka/realsppspdexcelrinci/2/";  
				lc= '?skpd='+skpd;
		}else if(ctk=='2'){
			var url    = "<?php echo site_url(); ?>/rka/realsp2dspdexcel/2/";  
				lc= '?skpd='+skpd;
			
			}
		
				window.open(url+lc, '_blank');
				window.focus();
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
<h5 align="center"><b><a href="#" id="section1">REALISASI </a></b></h5>
 <fieldset>


  <table align="center" style="width:100%;" border="0">  
		
		
	  <tr>
				<td width="73%" align="left"><input type="radio" name="cetak" value="1" onclick="opt(this.value)"/>
				Realisasi Anggaran Terhadap SPD Terbit per Sumber Dana</td>
				<td width="27%" align="left">&nbsp;</td>
			</tr>
			<tr>
			  <td width="73%" align="left"><input type="radio" name="cetak" value="2" onclick="opt(this.value)"/>
Realisasi Anggaran Terhadap SPD Terbit per Sumber Dana Rinci</td>
				<td width="27%" align="left">&nbsp;</td>
			</tr>
		
		
			
    
    
	 </table><br>











<div id="gaya">
<td width="922px" colspan="2"><input type="radio" name="cetak" value="1" onclick="opt1(this.value)" /><b>Keseluruhan</b></td></tr>
        <tr><td width="922px" colspan="2"><input type="radio" id="cetak" name="cetak" value="2" id="status" onclick="opt1(this.value)" /><b>Per SKPD</b>
			<div id="tagih">
				<table >
					<tr >
						<td width="22px" height="10%" ><B>SKPD</B></td>
						<td width="900px"><input id="sskpd" name="sskpd" style="width: 150px;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="nmskpd" name="nmskpd" style="width: 500px; border:0;" /></td>
					</tr>
				</table> 
			</div>
            </td></tr>
            </div>
            
<div id="div_periode">
                        <table style="width:100%;" border="0">
                            <td width="20%"><B>BULAN</B></td>
                            <td width="1%">:</td>
                            <td width="79%"><?php echo $this->rka_model->combo_bulan('bulan1','onchange="javascript:validate1();"'); ?> </td>
                            </td>
                        </table>            

</div>

                
                
                      <div id="div_sdana">
			<table style="width:100%;" border="0">
				<td width="20%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><b>SUMBER DANA</b></td>
				<td width="79%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><input id="sdana" name="rek3" style="width: 100px;" />
                </td>
			</table>
  	</div>
   <table style="width:100%;" border="0">
                            <td width="20%"><b>Enter TTD</b></td>
                            <td width="1%">:</td>
                            <td width="79%"><input type="text" id="spasi" name="spasi" value="0" style="width:50px;"/>&nbsp; baris</td>
                            </td>
                        </table>

     		<p align="center">         
			<a class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:cetak();">cetak</a>   
            <a class="easyui-linkbutton" iconCls="icon-excel" plain="true" onclick="javascript:cetak_ex();">Export</a>

<div id="rinci">
<p align="center"> 
                        </p>
                        </div>
		</p> 
	  </div>  
</fieldset>
    

</div>

</div>

 	
</body>

</html>