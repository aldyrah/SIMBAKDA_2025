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
	$(document).ready(function(){
        $("#accordion").accordion();            
        $( "#dialog-modal" ).dialog({
            height: 360,
            width: 900,
            modal: true,
            autoOpen:false,
        });
    });

	$(function(){
    	$('#sdana').combogrid({  
    		panelWidth:500,  
    		url: '<?php echo base_url(); ?>/index.php/tukd/load_sdana',  
			idField:'kd_sdana',                    
			textField:'nm_sdana',
			mode:'remote',  
			fitColumns:true,  
			columns:[[  
				{field:'kd_sdana',title:'kode',width:30},  
				{field:'nm_sdana',title:'sumber dana',align:'left',width:100}								
			]],
			onSelect:function(rowIndex,rowData){
				$("#sdana").attr("value",rowData.nm_rek3);
			}   
    	});
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
		$('#ttd').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });  
    });
	
	function cetak(){
		var periode1 = $('#perid1').datebox('getValue'); 
		var periode2 = $('#perid2').datebox('getValue');
		var sdana 	 = $('#sdana').combogrid("getValue");
		var APBD = document.getElementById('APBD').value;
		var tglttd = $('#ttd').combogrid("getValue");
		var chal = document.getElementById('hal').value;
		
		if(APBD=='0'){
		var url    = "<?php echo site_url(); ?>/tukd/cetak_ringksumberdanaskpd/1/";  
		lc= '?tgl1='+periode1+'&tgl2='+periode2+'&sdana='+sdana+'&tglttd='+tglttd+'+&space='+chal+'&APBD='+APBD;
		}else{
			var url    = "<?php echo site_url(); ?>/tukd/cetak_ringksumberdanaubahskpd/1/";  
		lc= '?tgl1='+periode1+'&tgl2='+periode2+'&sdana='+sdana+'&tglttd='+tglttd+'+&space='+chal+'&APBD='+APBD;
			}
		
			window.open(url+lc, '_blank');
			window.focus();
	}

	function cetak_ex(){
		var periode1 = $('#perid1').datebox('getValue'); 
		var periode2 = $('#perid2').datebox('getValue');
		var sdana    = $('#sdana').combogrid("getValue");
		var tglttd = $('#ttd').combogrid("getValue");
		var APBD = document.getElementById('APBD').value;
		var chal = document.getElementById('hal').value;
		if(APBD=='0'){
		var url    = "<?php echo site_url(); ?>/tukd/cetak_ringksumberdanaskpd/2/";  
		lc= '?tgl1='+periode1+'&tgl2='+periode2+'&sdana='+sdana+'&tglttd='+tglttd+'+&space='+chal+'&APBD='+APBD;
		}else{
			var url    = "<?php echo site_url(); ?>/tukd/cetak_ringksumberdanaubahskpd/2/";  
		lc= '?tgl1='+periode1+'&tgl2='+periode2+'&sdana='+sdana+'&tglttd='+tglttd+'+&space='+chal+'&APBD='+APBD;
			}
			
			
			window.open(url+lc, '_blank');
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
<h5 align="center"><b><a href="#" id="section1">RINGKASAN REALISASI PERKEGIATAN BERDASAKAN SUMBER DANA PER SKPD</a></b></h5>
<fieldset>
      <div id="div_sdana">
			<table style="width:100%;" border="0">
				<td width="20%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;SUMBER DANA</td>
				<td width="1%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">:</td>
				<td width="79%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
						<input id="sdana" name="rek3" style="width: 100px;" />
                </td>
			</table>
  	</div>
	
		  <div id="div_su">
			<table style="width:100%;" border="0">
				  <td width="20%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;SUMBER DANA APBD</td>
				<td width="1%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">:</td>
				<td width="79%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><select  name="APBD" id="APBD" >
						
							 <option value="1" >PERUBAHAN</option>
							 
						   </select>
				</td>
			</table>
		</div>

		
    <div id="div_sdana">
			<table style="width:100%;" border="0">
				<td width="20%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;Tanggal TTD</td>
				<td width="1%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">:</td>
				<td width="79%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
						<input id="ttd" name="ttd" style="width: 100px;" />
                </td>
			</table>
  	</div>	
    <table align="center" style="width:100%;" border="0">
            <tr>
                <td colspan="5" align="center">PERIODE</td>
            </tr>            
            <tr>
                <td width="200px">Tanggal</td>
                <td width="200px" align="right"><input type="text" id="perid1" style="width: 140px;" /></td>
				<td width="200px" align="center">s . d </td>
				<td width="200px" align="left"><input type="text" id="perid2" style="width: 140px;" /></td>
				<td width="200px" align="right">&nbsp;</td>
            </tr>
	</table>
	  <div>
	  
	   <div id="div_ttd">
			<table style="width:100%;" border="0">
				<td width="20%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;ENTER TTD</td>
				<td width="1%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">:</td>
				<td width="79%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><input id="hal" name="hal" style="width: 20px;" />&nbsp;baris
                </td>
			</table>
  	</div>
	
	
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