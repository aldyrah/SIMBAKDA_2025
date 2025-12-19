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
    #tagih {
        position: relative;
        width: 800px;
        height: 100px;
        padding: 0.4em;
    }  
    </style>
    <script type="text/javascript"> 
    var nip='';
	var kdskpd='';
    var ctk='1';
	var kdrek5='';
    
     $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
                height: 100,
                width: 922            
            });             
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

	$(function(){
	$('#sskpdx').combogrid({  
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
			kdskpdx = rowData.kd_skpd;
			$("#nmskpdx").attr("value",rowData.nm_skpd);
			$("#skpdx").attr("value",rowData.kd_skpd);
           
		}  
		}); 
	});
        
 
	function batal(){
	  $("#sskpd").combogrid("setValue",'');
      $("#sskpdx").combogrid("setValue",'');
	  $("#nmskpd").atrr("Value",'');
      $("#nmskpdx").attr("Value",'');
	
	}
	

	var r='';

    function rekalx(){
        
        var kdskpd  = $("#sskpd").combogrid("getValue");
        var kdskpdx = $("#sskpdx").combogrid("getValue");
		var nmskpd  = document.getElementById('nmskpd').value;
		var nmskpdx = document.getElementById('nmskpdx').value;;
		if ( kdskpd == '' ){
            alert('Pilih Sumber SKPD Terlebih Dahulu...!!!');
            exit();
        }
        if ( kdskpdx == '' ){
            alert('Pilih Tujuan SKPD Terlebih Dahulu...!!!');
            exit();
        }

		var urll = '<?php echo base_url(); ?>index.php/master/proses_copy';
         r = confirm("Yakin Ingin Copy Data : "+kdskpd+" Ke "+kdskpdx+"...?");
	     if(r == true){
			 document.getElementById('load').style.visibility='visible';
				$(document).ready(function(){
				   $.post(urll,({ckdskpd:kdskpd,ckdskpdx:kdskpdx,cnmskpd:nmskpd,cnmskpdx:nmskpdx}),function(data){
						status = data;
						if (status=='0'){
							alert('Gagal Copy Data..!!');
							document.getElementById('load').style.visibility='hidden';
							exit();
						} else {
							alert('Data Gambar Berhasil Dicopy..!!');
							document.getElementById('load').style.visibility='hidden';
							exit();
						}
					});
				});  
		 }else{
			alert("Pilihan Yang Bijak Bro ...!!!!");
			document.getElementById('load').style.visibility='hidden';
		 }
	}
    
      
    
    </script>

    

</head>
<body>

<div id="content">
<center><h3>COPY KEGIATAN DAN RKA</h3></center>
    
    <p align="right">         
        <table id="sp2d" title="Cetak" style="width:920px;height:200px;">          
        <tr><td width="922px" colspan="2"></td></tr>
        <tr><td width="922px" colspan="2">
				<table >
					<tr >
						<td width="120px" height="40%" ><B>SUMBER SKPD</B></td>
						<td width="800px"><input id="sskpd" name="sskpd" style="width: 150px;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="nmskpd" name="nmskpd" style="width: 500px; border:0;" /></td>
					</tr>
				</table> 

				<table >
					<tr >
						<td width="120px" height="40%" ><B>TUJUAN SKPD</B></td>
						<td width="800px"><input id="sskpdx" name="sskpdx" style="width: 150px;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="nmskpdx" name="nmskpdx" style="width: 500px; border:0;" /></td>
					</tr>
				</table> 
        </td>
        </tr>

        <tr>
			<td align="center">
			<a class="easyui-linkbutton" id="proses" iconCls="icon-ok" plain="true" onclick="javascript:rekalx();">Proses</a>
			<a class="easyui-linkbutton" id="batal" iconCls="icon-cancel" plain="true" onclick="javascript:batal();">Batal</a>	
			</td>
		</tr>
		<tr height="70%" >
			<td align="center" style="visibility:hidden" >	
				<div id="load" > 
					<img SRC="<?php echo base_url(); ?>assets/images/mapping.gif" width="270" height="40" border="0" alt="">
				</div>
			</td>
		</tr>
        </table>                      
    </p> 

</div>
</body>
</html>
