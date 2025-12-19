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
				$('#cskpd').combogrid({
				panelWidth : 700,  
				idField    : 'kd_skpd',  
				textField  : 'kd_skpd',  
				mode       : 'remote',
				url:'<?php echo base_url(); ?>index.php/cmrskpd/config_skpd',
				columns    : [[  
					{field:'kd_skpd',title:'Kode SKPD',width:150},  
					{field:'nm_skpd',title:'Nama SKPD',width:550}    
				]],
				onSelect:function(rowIndex,rowData){
					kdskpd = rowData.kd_skpd;
					$("#nmskpd").attr("value",rowData.nm_skpd.toUpperCase());
					
				},
            });
			 

		
	});
$(document).ready(function(){
	$("#input-box").show();
			
		$('#corder').combobox({
            valueField:'id',
            textField:'text',
            data: [{
    			id: 'no_sp2d',
    			text: 'No SP2D'
    			},{
    			id: 'nilai_sp2d',
    			text: 'Nilai SP2D'
    			},{
    			id: 'spj',
    			text: 'Nilai SPJ'
    			},{
    			id: 'selisih',
    			text: 'Umur Utang'
    			}]
        	});
        	$('#cspp').combobox({
            valueField:'id',
            textField:'text',
            data: [{
    			id: '1',
    			text: 'UP/GU'
    			},{
    			id: '2',
    			text: 'TU'
    			}]
        	});  	
		$('#csort').combobox({
            valueField:'id',
            textField:'text',
            data: [{
    			id: 'asc',
    			text: 'ASCENDING (A-Z)'
    			},{
    			id: 'desc',
    			text: 'DESCENDING (Z-A)'
    			}]
        	}); 	
});


	function cetak(ctk)
	{
		var cetak =ctk; 
		
		var ctgl = $('#ctgl').datebox('getValue');
		var lc  = ctgl;	
		var cskpd	= $('#cskpd').combogrid('getValue');
		var corder	= $('#corder').combogrid('getValue');	
		var csort	= $('#csort').combogrid('getValue');
		var csppp	= $('#cspp').combogrid('getValue');		
		if(ctgl==''){
		 	sweetAlert("Warning...", "Isi dulu periode tanggal..!", "error");	
			return
		};
		
		var url = "<?php echo site_url(); ?>/cmrskpd/cetak_mr/";  
		
		window.open(url+lc+'/'+cetak+'/'+cskpd+'/'+corder+'/'+csort+'/'+csppp, '_blank');
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
<h1 align="center" style="color:#6666FF">LAPORAN RINCIAN PERTANGGUNGJAWABAN SP2D BERDASARKAN SPJ</h1> 




	<div id="div_ptd">
			<table style="width:100%;" border="0">
			<tr>
				<td width="20%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><b> SKPD</b></td>
				<td width="1%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><b>:</b></td>
				<td colspan="2" width="79%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><input type="text" id="cskpd" style="width: 100px;" /></td>
				</tr>
			<tr>
				<td width="20%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><b> Per Tanggal</b></td>
				<td width="1%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><b>:</b></td>
				<td colspan="2" width="79%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><input type="text" id="ctgl" style="width: 100px;" /></td>
			</tr>
			<tr>
				<td width="20%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><b> Jenis SPP</b></td>
				<td width="1%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><b>:</b></td>
				<td width="15%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><input type="text" id="cspp" style="width: 100px;" /></td>
			</tr>
			<tr>
				<td width="20%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><b> Urutkan Berdasarkan</b></td>
				<td width="1%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><b>:</b></td>
				<td width="15%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><input type="text" id="corder" style="width: 100px;" /></td>
                <td width="64%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><input type="text" id="csort" style="width: 150px;" /></td>
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