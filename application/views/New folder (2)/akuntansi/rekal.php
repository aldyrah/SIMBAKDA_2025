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

	<script src="<?php echo base_url(); ?>assets/sweetalert/lib/sweet-alert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/sweetalert/lib/sweet-alert.css">
   <style>
.myButton {
	-moz-box-shadow: 0px 10px 24px -8px #276873;
	-webkit-box-shadow: 0px 10px 24px -8px #276873;
	box-shadow: 0px 10px 24px -8px #276873;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #599bb3), color-stop(1, #408c99));
	background:-moz-linear-gradient(top, #599bb3 5%, #408c99 100%);
	background:-webkit-linear-gradient(top, #599bb3 5%, #408c99 100%);
	background:-o-linear-gradient(top, #599bb3 5%, #408c99 100%);
	background:-ms-linear-gradient(top, #599bb3 5%, #408c99 100%);
	background:linear-gradient(to bottom, #599bb3 5%, #408c99 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#599bb3', endColorstr='#408c99',GradientType=0);
	background-color:#599bb3;
	-moz-border-radius:6px;
	-webkit-border-radius:6px;
	border-radius:6px;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Verdana;
	font-size:22px;
	font-weight:bold;
	padding:12px 58px;
	text-decoration:none;
	text-shadow:-1px 5px 0px #3d768a;
}
.myButton:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #408c99), color-stop(1, #599bb3));
	background:-moz-linear-gradient(top, #408c99 5%, #599bb3 100%);
	background:-webkit-linear-gradient(top, #408c99 5%, #599bb3 100%);
	background:-o-linear-gradient(top, #408c99 5%, #599bb3 100%);
	background:-ms-linear-gradient(top, #408c99 5%, #599bb3 100%);
	background:linear-gradient(to bottom, #408c99 5%, #599bb3 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#408c99', endColorstr='#599bb3',GradientType=0);
	background-color:#408c99;
}
.myButton:active {
	position:relative;
	top:1px;
}

   </style>
    <script type="text/javascript"> 
    var bln='';
	function rekal(){
		document.getElementById('load').style.visibility='visible';

		$(function(){      
		 $.ajax({
			type: 'POST',
			data: ({bulan:bln,nomor:'1'}),
			dataType:"json",
			url:"<?php echo base_url(); ?>index.php/akuntansi/proses_rekal",
			success:function(data){
				if (data == '1'){
					swal("Good job!", "Rekal Transaction Finish !!", "success");
				}else{
					swal("Oops...", "Something went wrong!", "error");					
				}
				document.getElementById('load').style.visibility='hidden';
			}
		 });
		});
	}
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
        
        
       
       $('#bulan').combogrid({  
           panelWidth:120,
           panelHeight:300,  
           idField:'bln',  
           textField:'nm_bulan',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/rka/bulan',  
           columns:[[ 
               {field:'nm_bulan',title:'Nama Bulan',width:700}    
           ]] ,
           onSelect:function(rowIndex,rowData){
					bln = rowData.bln;
					
					}  
       });

    });

    </script>

</head>
<body>

<div id="content">
 <h3>REKAL TRANSAKSI</h3>
  <div id="accordion">
    <p align="right" >         
        <table id="sp2d" title="Proses Rekal Transaksi" style="width:920px;height:350px;" border="0px">
        <tr>
			<td width="13%" align="right">BULAN</td>
			<td width="1%" align="center">:</td>
			<td width="15%" align="left"><input id="bulan" name="bulan" style="width: 100px;" />
			</td>
		</tr> 
		<tr >
			<td width="100%" align="center" colspan="3"> <a onclick="javascript:rekal();" class="myButton">PROSES</a></td>
		</tr>
		<tr height="60%" >
			<td colspan="3" align="center" style="visibility:hidden" >	
			<DIV id="load" > <b>Sedang Proses Rekal Transaksi</b><IMG src="<?php echo base_url(); ?>assets/images/loading14.gif" WIDTH="800" HEIGHT="100" BORDER="0" ALT=""></DIV></td>
		</tr>
        </table>                      
    </p> 
</div>
</div>

 	
</body>

</html>