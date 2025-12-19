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
        });

    $(function(){
	 $("#div_bulan").hide();
       $("#div_periode").hide(); 
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
   	
	 $('#bulan').combogrid({  
           panelWidth:120,
           panelHeight:300,  
           idField:'bln',  
           textField:'nm_bulan',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/rka/bulan',  
           columns:[[ 
               {field:'nm_bulan',title:'Nama Bulan',width:700}    
           ]] 
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
	
});


	 function opt(val){        
        ctk = val; 
        if (ctk=='1'){
            $("#div_bulan").hide();
            $("#div_periode").show();
        } else if (ctk=='2'){
            $("#div_bulan").show();
            $("#div_periode").hide();
            } else {
            exit();
        }                 
    }   
		function cetak()
        {
			
			var space = document.getElementById('space').value;
			//var status = document.getElementById('status').value;
			var url    = "<?php echo site_url(); ?>/tukd/reg_sp2d_dhani19/1/";  
		if(ctk==1){
			var status = document.getElementById('status').value;
			var periode1 = $('#perid1').datebox('getValue'); 
			var periode2 = $('#perid2').datebox('getValue');
			lc= '?posx='+periode1+'&posy='+periode2+'&sp='+space+'&status='+status;
		}else{
			var status = 2;
		var cbulan = $('#bulan').combogrid('getValue');
		lc= '?cbulan='+cbulan+'&sp='+space+'&status='+status;
		}
				window.open(url+lc, '_blank');
				window.focus();
        }
		
		function cetak_ex()
        {
			var space = document.getElementById('space').value;
			//var status = document.getElementById('status').value;
			var url    = "<?php echo site_url(); ?>/tukd/reg_sp2d_dhani19/2/";  
		if(ctk==1){
			var status = document.getElementById('status').value;
			var periode1 = $('#perid1').datebox('getValue'); 
			var periode2 = $('#perid2').datebox('getValue');
			lc= '?posx='+periode1+'&posy='+periode2+'&sp='+space+'&status='+status;
		}else{
			var status = 2;
		var cbulan = $('#bulan').combogrid('getValue');
		lc= '?cbulan='+cbulan+'&sp='+space+'&status='+status;
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
<h5 align="center"><b><a href="#" id="section1">REGISTER SP2D</a></b></h5>
 <fieldset>
<table style="width:100%;" border="0">
            <tr>
                <td><input type="radio" name="status" value="1" id="status" onclick="opt(this.value)" />Periode &ensp;
                <input type="radio" name="status" value="2" id="status" onclick="opt(this.value)" />Bulan
                </td></tr></table>
                <div id="div_bulan">
                        <table style="width:100%;" border="0">
                            <td width="20%">BULAN</td>
                        
                            <td width="79%"><input id="bulan" name="bulan" style="width: 100px;" />
                            </td>
                        </table>
                        
                        
                </div>
                <div id="div_periode">
                        <table style="width:100%;" border="0">
                            <td width="20%">PERIODE</td>
                           
                            <td width="79%"><input type="text" id="perid1" style="width: 100px;" /> s.d. <input type="text" id="perid2" style="width: 100px;" />
                            </td>
                        </table>
                </div>
     <table align="center" style="width:100%;" border="0">
          		<td width="200px">Enter ttd</td>
				<td width="200px" align="left"><input type="number" id="space" min="0" max="100" step="1" value ="0" style="width:40px;"/></td>
				<td width="200px" align="center">&nbsp;</td>
				<td width="200px" align="left">&nbsp;</td>
				<td width="200px" align="right">&nbsp;</td>
			</tr>
	 </table>
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