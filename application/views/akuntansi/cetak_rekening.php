<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/demo/demo.css">
      <script src="<?php echo base_url(); ?>assets/sweetalert/lib/sweet-alert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/sweetalert/lib/sweet-alert.css">

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
	
        
    function cetak(ctk)
        {
    
    
var quer = document.getElementById('head1').value;
var rek = document.getElementById('rekening').value;
var cetak =ctk;           	
var url    = "<?php echo site_url(); ?>/akuntansi/tesaja/";	
var saldo = document.getElementById('saldo').value;		
		
lc= '?quer='+quer+'&saldo='+saldo+'&rek='+rek;
		
	window.open(url+cetak+lc, '_blank');
			
			
			  

			window.focus();
        }
		



        
    function cetak1(ctk)
        {
    
var quer = document.getElementById('head1').value;
var rek = document.getElementById('rekening').value;
var cetak =ctk;           	
var url    = "<?php echo site_url(); ?>/akuntansi/tesaja1/";	
var saldo = document.getElementById('saldo').value;		
		
lc= '?quer='+quer+'&saldo='+saldo+'&rek='+rek;
		
	window.open(url+cetak+lc, '_blank');
			
			
			  

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
<h5 align="center"><b><a href="#" id="section1">JURNAL</a></b></h5>

 <fieldset>
     <table align="center" style="width:100%;" border="0">  
		<tr>
			<td width="20%" height="84" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;MASUKAN TOTAL DIGIT DAN REKENINGNYA</td>
				<td width="1%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">:</td>
		  <td width="79%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
                <p>TOTAL DIGIT 
                  <input type="number" id="head1" min="0" max="100" step="1" value ="3" style="width:40px;"/>
                REKENING 64: &nbsp;
                <input id="rekening" name="rekening" style="width: 160px;" />
                
                </p>
                
                </td>
		</tr>
		
    
  <tr>
			<td width="20%" height="84" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;SALDO NORMAL NYA</td>
				<td width="1%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">:</td>
				<td width="79%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">    <select  name="saldo" id="saldo" >
							 <option value="d" >1 | debet</option>
                             <option value="k" >1 | kredit</option>
						
						   </select>

				</td>
			</tr>  
    
    
	 </table><br>
     
     
     

    
    

    

      
  



		
		
		
		
		<TABLE>
		
<tr >
			<td colspan="2">
            <a class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:cetak(0);">TAMPILKAN</a>
            <a class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:cetak(1);">Cetak</a>
            <a class="easyui-linkbutton" iconCls="icon-excel" plain="true" onclick="javascript:cetak(2);">Cetak excel</a>
            <a class="easyui-linkbutton" iconCls="icon-word" plain="true" onclick="javascript:cetak(3);">Cetak word</a></td>
		</tr>


		<tr >
			<td colspan="2">
				YANG ADA ANGGARANNYA 
			</td>
		</tr>


		<tr >
			<td colspan="2">
            <a class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:cetak1(0);">TAMPILKAN</a>
            <a class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:cetak1(1);">Cetak</a>
            <a class="easyui-linkbutton" iconCls="icon-excel" plain="true" onclick="javascript:cetak1(2);">Cetak excel</a>
            <a class="easyui-linkbutton" iconCls="icon-word" plain="true" onclick="javascript:cetak1(3);">Cetak word</a></td>
		</tr>
</TABLE>
</fieldset>
    

</div>

</div>

 	
</body>

</html>