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
			$("#div_bulan").hide();		
			
        });
$(function(){
	
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
		   

//tampilkan html
function cetakhtml(){   
		
		var cbulan		= $('#bulan').combogrid('getValue');//get bulan		
		if (cbulan==''){
			alert ('Pilih Bulan dulu bro');
			exit();
		}
		alert('Kamu Ganteng Bro');
		 //cetak Neraca
		if(ctk=='1'){
			var url    = "<?php echo site_url(); ?>/akuntansi/tesaja3/0/";  
			lc= '?nbulan='+cbulan;
		}
		//cetak LRA
		else if(ctk=='2'){
			var url    = "<?php echo site_url(); ?>/akuntansi/tesaja2/0/";  
			lc= '?nbulan='+cbulan;
		}
		//cetak LPE
		else if(ctk=='3'){
			var url    = "<?php echo site_url(); ?>/akuntansi/tesaja4a/0/";  
			lc= '?nbulan='+cbulan;
		}
		//cetak LO
		else if(ctk=='4'){
			var url    = "<?php echo site_url(); ?>/akuntansi/teslo/0/";  
			lc= '?nbulan='+cbulan;
		}
		
			window.open(url+lc, '_blank');
			window.focus();
	}
   //cetak PDF
	function cetak(){   
		
		var cbulan		= $('#bulan').combogrid('getValue');//get bulan		
		if (cbulan==''){
			alert ('Pilih Bulan dulu bro');
			exit();
		}
		 //cetak Neraca
		if(ctk=='1'){
			var url    = "<?php echo site_url(); ?>/akuntansi/tesaja3/1/";  
			lc= '?nbulan='+cbulan;
		}
		//cetak LRA
		else if(ctk=='2'){
			var url    = "<?php echo site_url(); ?>/akuntansi/tesaja2/1/";  
			lc= '?nbulan='+cbulan;
		}
		//cetak LPE
		else if(ctk=='3'){
			var url    = "<?php echo site_url(); ?>/akuntansi/tesaja4a/1/";  
			lc= '?nbulan='+cbulan;
		}
		//cetak LO
		else if(ctk=='4'){
			var url    = "<?php echo site_url(); ?>/akuntansi/teslo/1/";  
			lc= '?nbulan='+cbulan;
		}
		
			window.open(url+lc, '_blank');
			window.focus();
	}
		
		
	//cetak excel	
	function cetakex(){	
		var cbulan		= $('#bulan').combogrid('getValue');//get bulan		
		if (cbulan==''){
			alert ('Pilih Bulan dulu bro');
			exit();
		}
		 //cetak Neraca
		if(ctk=='1'){
			var url    = "<?php echo site_url(); ?>/akuntansi/tesaja3/2/";  
			lc= '?nbulan='+cbulan;
		}
		//cetak LRA
		else if(ctk=='2'){
			var url    = "<?php echo site_url(); ?>/akuntansi/tesaja2/2/";  
			lc= '?nbulan='+cbulan;
		}
		//cetak LPE
		else if(ctk=='3'){
			var url    = "<?php echo site_url(); ?>/akuntansi/tesaja4a/2/";  
			lc= '?nbulan='+cbulan;
		}
		//cetak LO
		else if(ctk=='4'){
			var url    = "<?php echo site_url(); ?>/akuntansi/teslo/2/";  
			lc= '?nbulan='+cbulan;
		}
		
			window.open(url+lc, '_blank');
			window.focus();
	}
		

	 function opt(val){        
        ctk = val; 
        if (ctk=='1'){//neraca
			
            $("#div_bulan").show();
            
		}else if (ctk=='2'){//lra
			
            $("#div_bulan").show();
           
        }else if (ctk=='3'){//lpe
			
            $("#div_bulan").show();
           
        }else if (ctk=='4'){ //lo
			
            $("#div_bulan").show();
           
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
<h5 align="center"><b><a href="#" id="section1">LAPORAN NERACA, LRA, LPE, LO <br /></a></b></h5>

 <fieldset>
     <table align="center" style="width:100%;" border="0">  
			
			
			<tr>
				<td width="50%" align="left">
					<input type="radio" name="cetak" value="1" onclick="opt(this.value)" />&nbsp;<b>NERACA SEMUA SKPD</b>
				</td>
			</tr>
			<tr>
				<td width="50%" align="left">
					<input type="radio" name="cetak" value="2" onclick="opt(this.value)" />&nbsp;<b>LRA SEMUA SKPD</b>
				</td>
			</tr>
			<tr>
				<td width="50%" align="left">
					<input type="radio" name="cetak" value="3" onclick="opt(this.value)" />&nbsp;<b>LPE SEMUA SKPD</b></td>
			</tr>
			<tr>
				<td width="50%" align="left">
				<input type="radio" name="cetak" value="4" onclick="opt(this.value)" />&nbsp;<b>LO SEMUA SKPD</b></td>
			</tr>
				
            	
            			
	 </table>
	 <br>
		<div id="div_bulan">
			<table style="width:100%;" border="0">
				<td width="20%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;BULAN</td>
				<td width="1%" 	style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">:</td>
				<td width="79%"><input type="text" id="bulan" style="width: 100px;" /> 
                            </td>
			</table>
		</div>
		<div id="div_ttd">
			
			<div id="cetak">
				<p align="center">         
					<a class="easyui-linkbutton" iconCls="icon-tip" 	plain="true" onclick="javascript:cetakhtml();	">Tampilkan	</a> 
					<a class="easyui-linkbutton" iconCls="icon-print" 	plain="true" onclick="javascript:cetak();		">cetak		</a>     
					<a class="easyui-linkbutton" iconCls="icon-excel" 	plain="true" onclick="javascript:cetakex();		">export	</a>     			
				</p> 
			</div>  
		</div>

</div>
</div>
</body>

</html>