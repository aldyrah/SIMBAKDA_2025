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
    var ctk='';
	var val='';
	 $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
				height: 360,
				width: 900,
				modal: true,
				autoOpen:false,
			});
			$("#vis").hide();
			$("#div_rere").hide();
			$("#div_gaji").hide();
			$("#div_skpd").hide();
			$("#reke").hide();
			$("#hal").attr("value",0);
			$("#periode").hide();
			$("#tagih").hide();
			$("#gaya").hide();
			
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
    	$('#rek3').combogrid({  
    		panelWidth:500,  
    		url: '<?php echo base_url(); ?>/index.php/tukd/list_mrek3',  
    			idField:'kd_rek3',                    
    			textField:'kd_rek3',
    			mode:'remote',  
    			fitColumns:true,  
    			columns:[[  
    				{field:'kd_rek3',title:'Rekening',width:30},  
    				{field:'nm_rek3',title:'Nama Rekening',align:'left',width:100}								
    			]],
    			onSelect:function(rowIndex,rowData){
    				$("#nmrek3").attr("value",rowData.nm_rek3);
    			}   
    		});
       });

	   
	   $(function(){
    	$('#ttd').combogrid({  
    		panelWidth:500,  
    		url: '<?php echo base_url(); ?>/index.php/tukd/load_ptd',  
    			idField:'nip',                    
    			textField:'nama',
    			mode:'remote',  
    			fitColumns:true,  
    			columns:[[  
    				{field:'nip',title:'NIP',width:30},  
    				{field:'nama',title:'NAMA',align:'left',width:100}								
    			]],
    			onSelect:function(rowIndex,rowData){
    				$("#ttd").attr("value",rowData.nip);
    			}   
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
        
      $("#periode").hide();
      
       $('#tgl1').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            },
			onSelect: function(date){
			lmpar();
	      }
			
			
        });  
        
         
        
        $('#tgl2').datebox({  
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
        
       $('#tglttd').datebox({  
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
$('#advis').combogrid({  
  panelWidth:500,  
  url:'<?php echo base_url(); ?>/index.php/tukd/combo_advise',
  idField:'no_advise',  
  textField:'no_advise',
  mode:'remote',  
  fitColumns:true,                       
  columns:[[  
  {field:'no_advise',title:'No',width:150},  
  {field:'tgl_advise',title:'Tanggal',align:'left',width:60},
  {field:'total',title:'total',align:'right',width:100}                      
  ]],
  onSelect:function(rowIndex,rowData){
    no_advise   = rowData.no_advise;
    tgl_advise = rowData.tgl_advise;
   
    total = rowData.total;
   

    

  }    
});
		
	 });
			
		
		function lmpar(){ 
		var tgl1 = $('#tgl1').datebox('getValue');
	//	alert(tgl1);
		$('#advis').combogrid({  
  panelWidth:500,  
  url:'<?php echo base_url(); ?>/index.php/tukd/combo_advise',
  idField:'no_advise',  
  textField:'no_advise',
  mode:'remote',  
  fitColumns:true, 
   queryParams:({tgl1:tgl1}),                       
  columns:[[  
  {field:'no_advise',title:'No',width:150},  
  {field:'tgl_advise',title:'Tanggal',align:'left',width:60},
  {field:'total',title:'total',align:'right',width:100}                      
  ]],
  onSelect:function(rowIndex,rowData){
    no_advise   = rowData.no_advise;
    tgl_advise = rowData.tgl_advise;
   
    total = rowData.total;
   

    

  }    
});
	}

	function cetak(){ 
		var chal = document.getElementById('hal').value;
		var rere = document.getElementById('rere').value;
		var tgl1 = $('#tgl1').datebox('getValue');
 			 var q       = $("#advis").combogrid("getValue") ; 
	
		//var space = document.getElementById('space').value;
		if(ctk=='1'){
			var url    = "<?php echo site_url(); ?>/tukd/surat_pengesahan/1/";  
			lc= '?chal='+chal+'&tgl1='+tgl1+'&advise='+q;
		}
		
			window.open(url+lc, '_blank');
			window.focus();
	}
		
	 function opt(val){        
        ctk = val; 
        if (ctk=='1'){
            $("#periode").show();
				$("#div_rere").hide();
				$("#vis").show();
		
      
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
<h5 align="center"><b><a href="#" id="section1">LAPORAN - LAPORAN</a></b></h5>

 <fieldset>
     <table align="center" style="width:100%;" border="0">  
			<tr>
				<td colspan="2" align="center" style="border-top:solid 1px red;border-bottom:solid 1px red">&nbsp;</td>
			</tr>
			<tr>
			  <td width="99%" align="left"><input type="radio" name="cetak" value="1" onclick="opt(this.value)" />&nbsp;SURAT PENGESAHAN</td>
				<td width="1%" align="left">&nbsp;</td>
			</tr>
		
    
    
	 </table><br>
     
     
     

  	<div id="periode">
			<table style="width:100%;" border="0">
				<td width="20%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;TANGGAL</td>
				<td width="1%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">:</td>
				<td width="79%"><input type="text" id="tgl1" style="width: 100px;"  onchange="javascript:lmpar();" />
                </td>
			</table>
  	</div>
    
    
      	<div id="vis">
			<table style="width:100%;" border="0">
				<td width="20%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;No advise</td>
				<td width="1%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">:</td>
				<td width="79%">  <input id="advis" name="advis" style="width:190px" />
                </td>
			</table>
  	</div>
    
    
  
    
    
   <div id="div_rere">
			<table style="width:100%;" border="0">
				  <td width="20%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;Jenis Beban</td>
				<td width="1%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">:</td>
				<td width="79%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><select  name="rere" id="rere" >
							 <option value="51" >51 | BELANJA TIDAK LANGSUNG</option>
							 <option value="52">52 | BELANJA LANGSUNG</option>
                              <option value="0">0 | PENGELUARAN PEMBIAYAAN</option>
						   </select>
				</td>
			</table>
		</div>
    

    

      
        
		 <div id="div_ttd">
			<table style="width:100%;" border="0">
				<td width="20%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;ENTER TTD</td>
				<td width="1%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">:</td>
				<td width="79%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><input id="hal" name="hal" style="width: 20px;" />&nbsp;baris
                </td>
			</table>
  	</div>
    






		
		
		
		
		
		
	  <div id="cetak">
		<p align="center">         
			<a class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:cetak();">cetak</a>   
          
		</p> 
	  </div>  
</fieldset>
    

</div>

</div>

 	
</body>

</html>