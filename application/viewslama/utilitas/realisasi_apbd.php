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

	<script src="<?php echo base_url(); ?>assets/sweetalert-master/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/sweetalert-master/dist/sweetalert.css">	
	
    <script type="text/javascript"> 
 
 
	$(function(){ 

			$capbd = '0';        
		   
		   $('#ctgl').datebox({  
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
         $capbd = val;                 
    }    
	

	function cetak(ctk)
	{
		var cetak =ctk; 
		var ctgl = $('#ctgl').datebox('getValue');
		var lc  = ctgl;	
		var capbd=$capbd;
	
		if(capbd=='0'){
		 	sweetAlert("Warning...", "Tentukan Sumber Anggaran Yang di Gunakan..!", "error");	
			return
		};
	
		if(ctgl==''){
		 	sweetAlert("Warning...", "Isi dulu periode tanggal..!", "error");	
			return
		};
		
		var url = "<?php echo site_url(); ?>/crealisasi/cetak_realisasi_apbd/";  
		
		window.open(url+lc+'/'+capbd+'/'+cetak, '_blank');
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
<h1 align="center" style="color:#6666FF">REALISASI APBD</h1> 




	<div id="div_ptd">
			<table style="width:100%;" border="0">
				<tr>
					<td width="20%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><b>&nbsp;Sumber Anggaran</b></td>
					<td width="1%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><b>:</b></td>
					<td height="30" align="left" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><input type="radio"  name="cetak" id="opt1" value="1" onclick="opt(this.value)"  />APBD &ensp;
					<input type="radio" name="cetak" id="opt2" value="2"  onclick="opt(this.value)" />APBD-P
					</td>
				</tr>
				<tr>
					<td width="20%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><b>&nbsp;Periode s/d Tanggal</b></td>
					<td width="1%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><b>:</b></td>
					<td width="79%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><input type="text" id="ctgl" style="width: 100px;" /></td>
				</tr>
				
			</table>
  	</div>
		
<div id="ctk">
		<tr >
		<br></br>
				<br></br>
			<td colspan="2" align="center">
				<p align="center"> 
					<a class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:cetak(1);">Cetak</a>
					<a class="easyui-linkbutton" iconCls="icon-excel" plain="true" onclick="javascript:cetak(2);">Cetak excel</a>
					<a class="easyui-linkbutton" iconCls="icon-word" plain="true" onclick="javascript:cetak(3);">Cetak word</a>
				</p>
			</td>
		</tr>
</div>
		

    

</div>

</div>

 	
</body>

</html>