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
        width: 922px;
        height: 100px;
        padding: 0.4em;
    }  
    </style>
    <script type="text/javascript"> 
    var nip='';
	var kdskpd='';
	var kdrek5='';
    
     $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
                height: 100,
                width: 922            
            });             
        });   
    

    
   
    $(function(){
		$('#tgl').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });  
    }); 

// function cetak()
	// {   
	// tgl = $('#tgl').datebox('getValue');

		// if(ctk=='1'){
			// var url    = "<?php echo site_url(); ?>/akuntansi/cetak_real_bm/1/";  
		// lc = '?tgl='+tgl;
		// }else if(ctk=='2'){
			// var url    = "<?php echo site_url(); ?>/akuntansi/cetak_real_bm/2";  
		// lc = '?tgl='+tgl;
		// }
		
			// window.open(url+lc, '_blank');
			// window.focus();
	// }
	
	
	function cetak1(){
		tgl = $('#tgl').datebox('getValue');
		var idsp2d     	= document.getElementById('idsp2d').value;//id_sp2d
		var url    = "<?php echo site_url(); ?>/akuntansi/cetak_real_bm/1/";  
		lc = '?tgl='+tgl+'&idsp2d='+idsp2d;
		window.open(url+lc,'_blank');
		window.focus();		
	}
	
	function cetak2(){
		tgl = $('#tgl').datebox('getValue');
		var url    = "<?php echo site_url(); ?>/akuntansi/cetak_real_bm/2/";  
		lc = '?tgl='+tgl+'&idsp2d='+idsp2d;
		window.open(url+lc,'_blank');
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



<h3>CETAK REALISASI SP2D (BELANJA MODAL) </h3>       
<div id="accordion">
    
    <p align="right"> 
	
        <table id="sp2d" title="Cetak" style="width:922px;height:200px;" >

		<tr>		<td width="20%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;JENIS SP2D</td>
				<td width="1%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">:</td>
				<td width="79%"><select id="idsp2d" name="idsp2d">
									<option value=''>Pilih Jenis SP2D</option>
									<option value='1'>SP2D Terbit</option>
									<option value='2'>SP2D Cair Kas</option>
									<option value='3'>SP2D Cair BUD</option>
								</select>  
                            </td>
		</tr>	         
        
        <tr>
			<td width="20%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;Per Tanggal </td>
				<td width="1%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">:</td>
				<td width="79%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
						<input id="tgl" name="tgl" style="width: 100px;" />
                </td>
		</tr>
		
		<tr align="center">
			<td colspan="2"><a class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:cetak1();">Cetak</a>
            <a class="easyui-linkbutton" iconCls="icon-excel" plain="true" onclick="javascript:cetak2();">Cetak excel</a>
            
		</tr>
		
        </table>                      
    </p> 
    

</div>

</div>

 	
</body>

</html>