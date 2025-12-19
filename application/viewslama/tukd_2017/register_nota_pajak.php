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
			   
    

 
		$("#div_bend").hide();
			$("#div_bend1").hide();
			$("#div_periode").hide();
						$("#skp2").hide();
			

			$("#spasi").attr("value",0);
			
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
		
		
		
		
		
		
		
		
		
		

	function cetak()
	{  
	

var periode1 = $('#perid1').datebox('getValue'); 
var periode2 = $('#perid2').datebox('getValue');
			
			
			//lc= '?posx='+periode1+'&posy='+periode2+'&sp='+space;	
	var apbd =document.getElementById('apbd').value;



				if(ctk=='1'){
			var url    = "<?php echo site_url(); ?>/tukd/reg_nota/1/";  
 lc= '?posx='+periode1+'&posy='+periode2+'&apbd='+apbd;	
		}else if(ctk=='2'){


		}else if(ctk=='3'){
			var url    = "<?php echo site_url(); ?>/tukd/register_pajak_icad/1/";  
			 lc= '?posx='+periode1+'&posy='+periode2+'&apbd='+apbd;	
		}else if(ctk=='4'){


		}

			window.open(url+lc, '_blank');
			window.focus();
	}

	function cetakx()
	{  
	
	
var periode1 = $('#perid1').datebox('getValue'); 
var periode2 = $('#perid2').datebox('getValue');
			
			
			//lc= '?posx='+periode1+'&posy='+periode2+'&sp='+space;	
	var apbd =document.getElementById('apbd').value;



				if(ctk=='1'){
			var url    = "<?php echo site_url(); ?>/tukd/reg_nota/2/";  
 lc= '?posx='+periode1+'&posy='+periode2+'&apbd='+apbd;	
		}else if(ctk=='2'){


		}else if(ctk=='3'){
			var url    = "<?php echo site_url(); ?>/tukd/register_pajak_icad/2/";  
			 lc= '?posx='+periode1+'&posy='+periode2+'&apbd='+apbd;	
		}else if(ctk=='4'){


		}

			window.open(url+lc, '_blank');
			window.focus();
	}
		
	 function opt(val){        
        ctk = val; 
        if (ctk=='1'){
					$("#berkala").show();
			$("#div_bend1").show();
		//	$("#div_periode").show();
			
		}else if (ctk=='2'){
								$("#berkala").show();
			$("#div_bend1").hide();
	}else if (ctk=='3'){
		$("#skp2").show();
		$("#berkala").show();
			$("#div_bend1").hide();
}else if (ctk=='4'){
			$("#berkala").show();
			$("#div_bend1").show();

        }else {
			exit();
        } 
    }     
	
	$(function(){
	$('#sskpd123').combogrid({  
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
			nm_skpd = rowData.nm_skpd;
			$("#nmskpd123").attr("value",rowData.nm_skpd);
			$("#skpd123").attr("value",rowData.kd_skpd);
           
		}  
		}); 
	});


 function opt3(val){        
        ctk11 = val; 
        if (ctk11=='1'){
		    $("#tagih2").hide();
			 $("#sskpd123").combogrid("setValue",'');
			 $("#nmskpd123").attr("Value",'');
        } else if (ctk11=='2'){
			$("#tagih2").show();
		}else {
			exit();
        } 
    }     	   
      
	
		 function opt1(val){        
        ctk1 = val; 
        if (ctk1=='1'){
		    $("#tagih").hide();
			 $("#sskpd").combogrid("setValue",'');
			 $("#nmskpd").attr("Value",'');
        } else if (ctk1=='2'){
			$("#tagih").show();
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
<h5 align="center"><b>REGISTER</b></h5>

 <fieldset>
     <table align="center" style="width:100%;" border="0">  
			<tr>
				<td colspan="2" align="center" style="border-top:solid 1px red;border-bottom:solid 1px red">&nbsp;</td>
			</tr>
			<tr>
				<td width="64%" />&nbsp;</td>
				<td width="33%" />&nbsp;<td width="1%"></td>
			</tr>
			<tr>
				<td width="64%" align="left"><input type="radio" name="cetak" value="1" onclick="opt(this.value)"/>
				&nbsp;REGISTER NOTA</td>
				<td width="2%" align="left">&nbsp;</td>
			</tr>
            <tr>
			  <td width="64%" align="left"><input type="radio" name="cetak" value="3" onclick="opt(this.value)"/>
				REGISTER PAJAK SP2D</td>
			  <td width="2%" align="left">&nbsp;</td>
			</tr>
             
    
	 </table><br>
     


    
   


 <div id="div_bend1">
 <table style="width:100%;" border="0">
   <tr>
                            <td width="20%">JENIS</td>
                            <td width="1%">:</td>
                            
                            	<td width="79%" style="border-bottom:hidden;border-spacing: 3px;padding:3px;"><select  name="apbd" id="apbd" >
     <option value="">...Pilih jenis... </option>
     <option value="BL">1 | BELANJA LANGSUNG</option>
     <option value="BTL">2 | BELANJA TIDAK LANGSUNG</option>
     <option value="PEMB">3 | LAINYA</option>
   </select></td> 
                            </tr>
                            </table>
                            </div>



<div id="berkala">
 <table align="center" style="width:100%;" border="0">
                 
            <tr>
                <td width="200px">Tanggal</td>
                <td width="200px" align="right"><input type="text" id="perid1" style="width: 140px;" /></td>
				<td width="200px" align="center">s . d </td>
				<td width="200px" align="left"><input type="text" id="perid2" style="width: 140px;" /></td>
				<td width="200px" align="right">&nbsp;</td>
            </tr>
	 </table>
</div>
                            
                             <div>
                        <table style="width:100%;" border="0">
                            <td width="20%">ENTER TTD</td>
                            <td width="1%">:</td>
                            <td><input type="text" id="spasi" style="width: 50px;" /> 
                            </td> 
                        </table>
                </div>
		
		
		
		
		
		
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