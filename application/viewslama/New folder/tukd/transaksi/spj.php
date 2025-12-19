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
   
    <script type="text/javascript"> 
    var nip='';
	var kdskpd='';
	var kdrek5='';
    
     $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
                height: 400,
                width: 800            
            });  
            get_skpd();
			$("#spasi").attr("value",0);
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
	
    function validate1(){
        var bln1 = document.getElementById('bulan1').value;
        
    }
    function get_skpd()
        {
        
        	$.ajax({
        		url:'<?php echo base_url(); ?>index.php/rka/config_skpd',
        		type: "POST",
        		dataType:"json",                         
        		success:function(data){
        								$("#sskpd").attr("value",data.kd_skpd);
        								$("#nmskpd").attr("value",data.nm_skpd);
                                       // $("#skpd").attr("value",rowData.kd_skpd);
        								kdskpd = data.kd_skpd;
                                        
        							  }                                     
        	});
             
        }
		function cetak()
        {
			var spasi =document.getElementById('spasi').value;
			var skpd   = kdskpd; 
			var bulan   =  document.getElementById('bulan1').value;
			var tglttd = $('#tgl_ttd').datebox("getValue");
			var url    = "<?php echo site_url(); ?>/tukd/cetak_spj";  
			window.open(url+'/'+skpd+'/'+bulan+'/'+spasi+'/'+tglttd, '_blank');
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



<h3>CETAK LAPORAN PERTANGGUNGJAWABAN SKPD (SPJ)</h3>
<div id="accordion">
    
    <p align="right">         
        <table id="sp2d" title="Cetak Buku Besar" style="width:922px;height:200px;" >  
		<tr >
			<td width="20%" height="40" style="border-top:none;border-bottom:none;"><B>SKPD</B></td>
			<td width="80%" style="border-top:none;border-bottom:none;"><input id="sskpd" name="sskpd" style="width: 150px;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="nmskpd" name="nmskpd" style="width: 500px; border:0;" /></td>
		</tr>
        <tr >
			<td width="20%" height="40" style="border-top:none;border-bottom:none;"><B>BULAN</B></td>
			<td style="border-top:none;border-bottom:none;"><?php echo $this->rka_model->combo_bulan('bulan1','onchange="javascript:validate1();"'); ?> </td>
		</tr>
		<tr>
			<td width="20%" style="border-top:none;border-bottom:none;"><b>TGL TTD</b></td>
			<td style="border-top:none;border-bottom:none;"><input type="text" id="tgl_ttd" name="tgl_ttd" style="width:100px;"/></td>
		</tr>
		<tr>
			<td width="20%" style="border-top:none;border-bottom:none;"><b>Enter TTD</b></td>
			<td style="border-top:none;border-bottom:none;"><input type="text" id="spasi" name="spasi" value="0" style="width:50px;"/>&nbsp; baris</td>
		</tr>
		<tr >
			<td colspan="2" style="border-top:none;border-bottom:none;"><a class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:cetak();">Cetak</a></td>
		</tr>
		
        </table>                      
    </p> 
    

</div>
</div>

 	
</body>

</html>