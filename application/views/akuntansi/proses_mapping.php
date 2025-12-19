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
		function mapping(){
			document.getElementById('load').style.visibility='visible';
			document.getElementById('proses').style.visibility='hidden';
			$.ajax({
				type: 'POST',
				data: ({nomor:'1'}),
				dataType:"json",
				url:"<?php echo base_url(); ?>index.php/akuntansi_c/proses_rekal_sp2d",
				success:function(data){
					if (data=1){
						document.getElementById('load').style.visibility='hidden';
						document.getElementById('proses').style.visibility='visible';
						alert('PROSES REKAL SP2D BUD SELESAI');
					}
				}
			});
		}
		
		function mapping_sp2d_skpd(){
			document.getElementById('load').style.visibility='visible';
			document.getElementById('proses_sp2d').style.visibility='hidden';
			$.ajax({
				type: 'POST',
				data: ({nomor:'1'}),
				dataType:"json",
				url:"<?php echo base_url(); ?>index.php/akuntansi_c/proses_rekal_sp2d_skpd",
				success:function(data){
					if (data=1){
						document.getElementById('load').style.visibility='hidden';
						document.getElementById('proses_sp2d').style.visibility='visible';
						alert('PROSES REKAL SP2D SKPD SELESAI');
					}
				}
			});
		}
		
		function mapping_spj_skpd(){
			document.getElementById('load').style.visibility='visible';
			document.getElementById('proses_spj').style.visibility='hidden';
			$.ajax({
				type: 'POST',
				data: ({nomor:'1'}),
				dataType:"json",
				url:"<?php echo base_url(); ?>index.php/akuntansi_c/proses_rekal_spj_skpd",
				success:function(data){
					if (data=1){
						document.getElementById('load').style.visibility='hidden';
						document.getElementById('proses_spj').style.visibility='visible';
						alert('PROSES REKAL SPJ SKPD SELESAI');
					}
				}
			});
		}
		
		function mapping_trmpjk_skpd(){
			document.getElementById('load').style.visibility='visible';
			document.getElementById('proses_trmpjk').style.visibility='hidden';
			$.ajax({
				type: 'POST',
				data: ({nomor:'1'}),
				dataType:"json",
				url:"<?php echo base_url(); ?>index.php/akuntansi_c/proses_rekal_trmpjk_skpd",
				success:function(data){
					if (data=1){
						document.getElementById('load').style.visibility='hidden';
						document.getElementById('proses_trmpjk').style.visibility='visible';
						alert('PROSES REKAL PAJAK TERIMA SKPD SELESAI');
					}
				}
			});
		}
		
		function mapping_strpjk_skpd(){
			document.getElementById('load').style.visibility='visible';
			document.getElementById('proses_strpjk').style.visibility='hidden';
			$.ajax({
				type: 'POST',
				data: ({nomor:'1'}),
				dataType:"json",
				url:"<?php echo base_url(); ?>index.php/akuntansi_c/proses_rekal_strpjk_skpd",
				success:function(data){
					if (data=1){
						document.getElementById('load').style.visibility='hidden';
						document.getElementById('proses_strpjk').style.visibility='visible';
						alert('PROSES REKAL PAJAK SETOR SKPD SELESAI');
					}
				}
			});
		}
		
		function mapping_pend_skpd(){
			document.getElementById('load').style.visibility='visible';
			document.getElementById('proses_pend').style.visibility='hidden';
			$.ajax({
				type: 'POST',
				data: ({nomor:'1'}),
				dataType:"json",
				url:"<?php echo base_url(); ?>index.php/akuntansi_c/proses_rekal_pend_skpd",
				success:function(data){
					if (data=1){
						document.getElementById('load').style.visibility='hidden';
						document.getElementById('proses_pend').style.visibility='visible';
						alert('PROSES REKAL PENDAPATAN SKPD SELESAI');
					}
				}
			});
		}
		
		function mapping_pend_bud(){
			document.getElementById('load').style.visibility='visible';
			document.getElementById('proses_pendbud').style.visibility='hidden';
			$.ajax({
				type: 'POST',
				data: ({nomor:'1'}),
				dataType:"json",
				url:"<?php echo base_url(); ?>index.php/akuntansi_c/proses_rekal_pend_bud",
				success:function(data){
					if (data=1){
						document.getElementById('load').style.visibility='hidden';
						document.getElementById('proses_pendbud').style.visibility='visible';
						alert('PROSES REKAL PENERIMAAN PPKD SELESAI');
					}
				}
			});
		}
		
		
		
    </script>
</head>
<body>
	<div id="content">
		<h3>REKAL TRANSAKSI SP2D BUD, SP2D SKPD, SPJ SKPD, PAJAK DALAM BENTUK JURNAL </h3>
		<div id="accordion" align="center" >
			<div id="proses">
				<INPUT TYPE="button" VALUE="1. PROSES PENCAIRAN SP2D BUD" style="height:40px;width:275px" onclick="mapping()">
			</div>
			<div id="proses_sp2d">
				<INPUT TYPE="button" VALUE="2. PROSES PENCAIRAN SP2D SKPD" style="height:40px;width:275px" onclick="mapping_sp2d_skpd()">
			</div>	
			<div id="proses_spj">
				<INPUT TYPE="button" VALUE="3. PROSES SPJ SKPD" style="height:40px;width:275px" onclick="mapping_spj_skpd()">
			</div>	
			<div id="proses_trmpjk">
			  <input name="button" type="button" style="height:40px;width:275px" onclick="mapping_trmpjk_skpd()" value="4. PROSES TERIMA PAJAK SKPD" />
			</div>
			<div id="proses_strpjk">
			  <input name="button" type="button" style="height:40px;width:275px" onclick="mapping_strpjk_skpd()" value="5. PROSES SETOR PAJAK SKPD" />
			</div>
			<div id="proses_pend">
			  <input name="button" type="button" style="height:40px;width:275px" onclick="mapping_pend_skpd()" value="6. PROSES TERIMA-SETOR PENDAPATAN" />
			</div>	
			<div id="proses_pendbud">
			  <input name="button" type="button" style="height:40px;width:275px" onclick="mapping_pend_bud()" value="7. PROSES PENERIMAAN PPKD" />
			</div>	
			<div id="load" style="visibility:hidden">
				<img src="<?php echo base_url(); ?>assets/images/mapping.gif" WIDTH="270" HEIGHT="40" BORDER="0" ALT=""></img>
			</div>
		</div>
	</div>
<!---->
</body>
</html>