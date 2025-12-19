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
		$('#nmskpd').attr('value','');
        });

			$(function(){
				 $('#perid1').datebox({  
					required:true,
					formatter :function(date){
						var y = date.getFullYear();
						var m = date.getMonth()+1;
						var d = date.getDate();
						if(d<10){
							d='0'+d
						} 
						if(m<10){
							m='0'+m
						}
						return y+'-'+m+'-'+d;
					}
				});
			});
			$(function(){
				 $('#perid2').datebox({  
					required:true,
					formatter :function(date){
						var y = date.getFullYear();
						var m = date.getMonth()+1;
						var d = date.getDate();
						if(d<10){
							d='0'+d
						} 
						if(m<10){
							m='0'+m
						}
						return y+'-'+m+'-'+d;
					}
				});
			});
	
            $(function(){
            $('#sskpd').combogrid({  
            panelWidth:700,  
            idField:'kd_skpd',  
            textField:'kd_skpd',  
            mode:'remote',
            url:'<?php echo base_url(); ?>index.php/rka/skpd',  
            columns:[[  
                {field:'kd_skpd',title:'Kode SKPD',width:100},  
                {field:'nm_skpd',title:'Nama SKPD',width:700}    
            ]],
            onSelect:function(rowIndex,rowData){
                nmskpd = rowData.nm_skpd;
                $("#nmskpd").attr("value",rowData.nm_skpd);
            }  
            }); 
            });	
	

			function cetak()
			{
				//var kdskpd=$('#sskpd').combogrid('getValue');
				var url    = "<?php echo site_url(); ?>/tukd/realisasi_sp2d/1/";  
				//lc= '?posx='+kdskpd;
					window.open(url, '_blank');
					window.focus();
			}
		
			function cetak_ex()
			{
				//var kdskpd=$('#sskpd').combogrid('getValue');
				var url    = "<?php echo site_url(); ?>/tukd/realisasi_sp2d/2/";  
				//lc= '?posx='+kdskpd;
					window.open(url, '_blank');
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
<h5 align="center"><b><a href="#" id="section1">DAFTAR REALISASI SP2D PER-SKPD</a></b></h5>
 <fieldset>
     <!--<table align="center" style="width:100%;" border="0">
			<tr>
				<td>
					<h3>S K P D&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input id="sskpd" name="sskpd" style="width: 100px;" />
					<input id="nmskpd" name="nmskpd" style="width: 450px; border:0;  " /></h3>
				</td>
			</tr>
	 </table>-->
	  <div>
		<p align="center">         
			<a class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:cetak();">cetak</a>   
            <a class="easyui-linkbutton" iconCls="icon-excel" plain="true" onclick="javascript:cetak_ex();">Export</a>
		</p> 
	  </div>  
</fieldset>
</div>
</div>
</body>
</html>