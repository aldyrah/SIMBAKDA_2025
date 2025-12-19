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
	 $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
				height: 360,
				width: 900,
				modal: true,
				autoOpen:false,
			});
			$("#skp2").hide();
		
			
			
        });
		
 var nip='';
	var kdskpd='';
	var kdrek5='';
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
			//valid_ttd(kdskpd);
			valid_ttd1(kdskpd);
			}  
		}); 
	});

	$(function(){
		$('#kdrek5').combogrid({  
			panelWidth:630,  
			idField:'kd_rek5',  
			textField:'kd_rek5',  
			mode:'remote',
			url:'<?php echo base_url(); ?>index.php/akuntansi/rekening',  
			columns:[[  
				{field:'kd_rek5',title:'Kode Rekening',width:100},  
				{field:'nm_rek5',title:'Nama Rekening',width:500}    
			]],
			onSelect:function(rowIndex,rowData){
				rekening = rowData.kd_rek5;
				$("#kdrek5").attr("value",rowData.kd_rek5);
				$("#nmrek5").attr("value",rowData.nm_rek5);
			}  
		}); 
		
		 $('#tgl_ttd').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });     
	});

    $(function(){
		$('#dcetak').datebox({  
			required:true,
			formatter :function(date){
				var y = date.getFullYear();
				var m = date.getMonth()+1;
				var d = date.getDate();
				return y+'-'+m+'-'+d;
			}
		});
   	});

    $(function(){
		$('#dcetak2').datebox({  
			required:true,
			formatter :function(date){
				var y = date.getFullYear();
				var m = date.getMonth()+1;
				var d = date.getDate();
				return y+'-'+m+'-'+d;
			}
		});
   	});
	
	$(function(){
		$('#ttd').combogrid({  
			panelWidth:500,  
			idField:'nip',                    
			textField:'nama',
			mode:'remote',  
			fitColumns:true,  
			columns:[[  
				{field:'nip',title:'NIP',width:60},  
				{field:'nama',title:'NAMA',align:'left',width:100}								
			]],
			onSelect:function(rowIndex,rowData){
				nip = rowData.nip;
			}   
		});
   });
   
   $(function(){
		$('#ttd1').combogrid({  
			panelWidth:500,  
			url: '<?php echo base_url(); ?>/index.php/tukd/list_ttd_bb1',
			idField:'nip1',                    
			textField:'nama1',
			mode:'remote',  
			fitColumns:true,  
			columns:[[  
				{field:'nip1',title:'NIP',width:60},  
				{field:'nama1',title:'NAMA',align:'left',width:100}								
			]],
			onSelect:function(rowIndex,rowData){
				$("#ttd1").attr("value",rowData.nip1);
			}   
		});
   });
   
   function valid_ttd1(x){
		$(function(){
			$('#ttd1').combogrid({  
				panelWidth:500,  
				url: '<?php echo base_url(); ?>/index.php/tukd/list_ttd_bb1/'+x,  
				idField:'nip1',                    
				textField:'nama1',
				mode:'remote',  
				fitColumns:true,  
				columns:[[  
					{field:'nip1',title:'NIP',width:60},  
					{field:'nama1',title:'NAMA',align:'left',width:100}								
				]],
				onSelect:function(rowIndex,rowData){
				nip1 = rowData.nip1;
				}   
			});
		});
	}
   

	//function valid_ttd(x){
		
		$(function(){
			$('#ttd').combogrid({  
				panelWidth:500,  
				url: '<?php echo base_url(); ?>/index.php/tukd/list_ttd_bb2',  
				idField:'nip',                    
				textField:'nama',
				mode:'remote',  
				fitColumns:true,  
				columns:[[  
					{field:'nip',title:'NIP',width:60},  
					{field:'nama',title:'NAMA',align:'left',width:100}								
				]],
				onSelect:function(rowIndex,rowData){
				nip = rowData.nip;
				}   
			});
		});
	//}
		
		
		
		
		
		
		
		

	function cetak()
	{   var dcetak = $('#dcetak').datebox('getValue');      
		var dcetak2 = $('#dcetak2').datebox('getValue');
		
		var tgl_ttd = $('#tgl_ttd').datebox('getValue');
		var nip    = $('#ttd').combogrid("getValue");  		
		var nip1    = $('#ttd1').combogrid("getValue");  		
		//var ttd    = nip;                           
		//var ttd1 =ttd.split(" ").join("a");
		var enter      = document.getElementById('space').value; 
		var skpd   = kdskpd; 
		var rek5   = rekening; 
				var gl      = document.getElementById('gl').value; 
	
		//var space = document.getElementById('space').value;
		if(ctk=='1'){
		var url    = "<?php echo site_url(); ?>/akuntansi/cetakbb/1";
			lc= '?dcetak='+dcetak+'&skpd='+skpd+'&space='+enter+'&rek5='+rek5+'&dcetak2='+dcetak2+'&nip='+nip+'&nip1='+nip1+'&gl='+gl+'&tglttd='+tgl_ttd;
		}else if(ctk=='2'){
				var url    = "<?php echo site_url(); ?>/akuntansi/cetakbbkonsol/1";
			lc= '?dcetak='+dcetak+'&space='+enter+'&rek5='+rek5+'&dcetak2='+dcetak2+'&nip='+nip+'&nip1='+nip1+'&gl='+gl+'&tglttd='+tgl_ttd;
		

		}
		
			window.open(url+lc, '_blank');
			window.focus();
	}
		
	
function cetakx()

	{  var dcetak = $('#dcetak').datebox('getValue');      
		var dcetak2 = $('#dcetak2').datebox('getValue');
		var tgl_ttd = $('#tgl_ttd').datebox('getValue');
		var nip    = $('#ttd').combogrid("getValue");  		
		var nip1    = $('#ttd1').combogrid("getValue");  		
		//var ttd    = nip;                           
		//var ttd1 =ttd.split(" ").join("a");
		var enter      = document.getElementById('space').value; 
		var gl      = document.getElementById('gl').value; 
		var skpd   = kdskpd; 
		var rek5   = rekening; 
		
	
		//var space = document.getElementById('space').value;
		if(ctk=='1'){
		var url    = "<?php echo site_url(); ?>/akuntansi/cetakbb/2";
			lc= '?dcetak='+dcetak+'&skpd='+skpd+'&space='+enter+'&rek5='+rek5+'&dcetak2='+dcetak2+'&nip='+nip+'&nip1='+nip1+'&gl='+gl+'&tglttd='+tgl_ttd;
		}else if(ctk=='2'){
				var url    = "<?php echo site_url(); ?>/akuntansi/cetakbbkonsol/2";
			lc= '?dcetak='+dcetak+'&space='+enter+'&rek5='+rek5+'&dcetak2='+dcetak2+'&nip='+nip+'&nip1='+nip1+'&gl='+gl+'&tglttd='+tgl_ttd;
		

		}
		
			window.open(url+lc, '_blank');
			window.focus();
	}


	function opt(val){        
        ctk = val; 
        if (ctk=='1'){
			
			$("#skp2").show();

        }else if (ctk=='2'){
		
			$("#skp2").hide();

	

		}else {
			exit();
        } 
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
<h5 align="center"><b><a href="#" id="section1">BUKU BESAR</a></b></h5>

 <fieldset>
     <table align="center" style="width:100%;" border="0">  
			
			<tr>
				<td width="99%" align="left"><input type="radio" name="cetak" value="1" onclick="opt(this.value)" />&nbsp;BUKU BESAR SKPD</td>
				<td width="1%" align="left">&nbsp;</td>
			</tr>
			<tr>
				<td width="99%" align="left"><input type="radio" name="cetak" value="2" onclick="opt(this.value)" />
			    &nbsp;BUKU BESAR KONSOLIDASI</td>
				<td>&nbsp;</td>
			</tr>
            	   
    
    
	 </table><br>
     
     
         
<div id="skp2">
			  <table >
					<tr >
						<td width="22px" height="10%" ><B>SKPD</B></td>
						<td width="900px"><input id="sskpd" name="sskpd" style="width: 150px;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="nmskpd" name="nmskpd" style="width: 500px; border:0;" /></td>
					</tr>
			</table> 
			
        </td></tr>
      </div>
    
    
    
    
    			<table id="sp2d" title="Cetak Buku Besar" style="width:870px;height:300px;" >  
    			<tr >
					<td width="20%" height="40" ><B>REKENING</B></td>
					<td width="80%"><input id="kdrek5" name="kdrek5" style="width: 150px;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="nmrek5" name="nmrek5" style="width: 500px; border:0;" /></td>
				</tr>
				<tr >
					<td width="20%" height="40" ><B>PERIODE</B></td>
					<td width="80%"><input id="dcetak" name="dcetak" type="text"  style="width:155px" />&nbsp;&nbsp;s/d&nbsp;&nbsp;<input id="dcetak2" name="dcetak2" type="text"  style="width:155px" /></td>
				</tr>				
				<tr>
							<td width="200px">TTD DI BUAT OLEH </td>
							<td width="200px" align="LEFT"><input id="ttd" name="ttd" style="width: 160px;" /></td>
							<td width="200px" align="center">&nbsp;</td>
							<td width="200px" align="left">&nbsp;</td>
							<td width="200px" align="right">&nbsp;</td>	
					<tr>
					
				<tr>
							<td width="200px">TTD MENGETAHUI </td>
							<td width="200px" align="LEFT"><input id="ttd1" name="ttd1" style="width: 160px;" /></td>
							<td width="200px" align="center">&nbsp;</td>
							<td width="200px" align="left">&nbsp;</td>
							<td width="200px" align="right">&nbsp;</td>	
					</tr>  
                    
                    
    
    <tr>
                            <td width="20%">TANGGAL TTD</td>
                            <td><input type="text" id="tgl_ttd" style="width: 100px;" /> 
                            </td> 
    </tr>
    
                    
                    
                    	<tr>
							<td width="200px">KEPALA BADAN</td>
							<td width="200px" align="LEFT"><select name="gl" id="gl" >
							 <option value="1">ENIAS RUMBEWAS, SE., M.Si</option>
							 <option value="2">DR. ENIAS RUMBEWAS, SE., M.Si</option>
						   </select></td>
							<td width="200px" align="center">&nbsp;</td>
							<td width="200px" align="left">&nbsp;</td>
							<td width="200px" align="right">&nbsp;</td>	
					</tr>  

			
             <tr>
				<td width="200px">Enter ttd</td>
				<td width="200px" align="LEFT"><input type="number" id="space" min="0" max="100" step="1" value ="0" style="width:40px;"/></td>
				<td width="200px" align="center">&nbsp;</td>
				<td width="200px" align="left">&nbsp;</td>
				<td width="200px" align="right">&nbsp;</td>
			</tr>
            
            
			
			</table> 
   
    
     <div id="cetak">
		<p align="center">         
			<a class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:cetak();">cetak</a>   
          	<a class="easyui-linkbutton" iconCls="icon-excel" plain="true" onclick="javascript:cetakx();">Export</a>
		</p> 
	  </div>  
   
</fieldset>
    

</div>

</div>

 	
</body>

</html>