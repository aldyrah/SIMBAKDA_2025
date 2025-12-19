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
			$("#div_bulan").show();
			$("#realisasi").hide();
			$("#div_sdana").hide();
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
	{   var ttdd = $('#ttd').combogrid("getValue");
		var rek3 = $('#rek3').combogrid("getValue");
		var bulan = document.getElementById('bulan').value;
		var gaji = document.getElementById('gaji').value;
		var sdana = $('#sdana').combogrid("getValue");
		var chal = document.getElementById('hal').value;
		var tgl1 = $('#tgl1').datebox('getValue');
		var tgl2 = $('#tgl2').datebox('getValue');
		var skpd = $('#sskpd').combogrid("getValue");
		var tglttd = $('#tglttd').datebox('getValue');
	
		//var space = document.getElementById('space').value;
		if(ctk=='1'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_lrbl/1/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd+'&tglttd='+tglttd;
		}else if(ctk=='2'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_reg_sbl/1/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd+'&tglttd='+tglttd;
		}else if(ctk=='3'){
			var url    = "<?php echo site_url(); ?>/tukd/ghe_jasa/1/";  
			lc= '?bulan='+bulan+'&rek3='+rek3+'&chal='+chal+'&ttdd='+ttdd+'&tglttd='+tglttd+'&skpd='+skpd;
		}else if(ctk=='4'){
			var url    = "<?php echo site_url(); ?>/tukd/dhe_jasa/1/";
			lc= '?bulan='+bulan+'&rek3='+rek3+'&chal='+chal+'&ttdd='+ttdd+'&tglttd='+tglttd+'&skpd='+skpd;
		}else if(ctk=='5'){
			var url    = "<?php echo site_url(); ?>/tukd/brinci/1/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd+'&tglttd='+tglttd;
		}else if(ctk=='9'){
			var url    = "<?php echo site_url(); ?>/tukd/rek_sp2d_bel/1/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd+'&tglttd='+tglttd;
		}
			window.open(url+lc, '_blank');
			window.focus();
	}
		
	 function opt(val){        
        ctk = val; 
        if (ctk=='1'){
			$("#div_sdana").hide();
		    $("#reke").hide();
            $("#div_bulan").show();
            $("#div_gaji").hide();
            $("#periode").hide();
			$("#div_ptd").show();
			$("#div_skpd").hide();
			$("#gaya").hide();
        } else if (ctk=='2'){
			$("#div_sdana").hide();
			$("#reke").hide();
            $("#div_bulan").show();
            $("#div_gaji").hide();
            $("#periode").hide();
			$("#div_ptd").show();
			$("#div_skpd").hide();
			$("#gaya").hide();
        } else if (ctk=='3'){
			$("#div_sdana").hide();
		    $("#reke").show();
            $("#div_bulan").show();
            $("#div_gaji").hide();
            $("#periode").hide();
			$("#div_ptd").show();
			$("#div_skpd").hide();
			$("#gaya").show();
        } else if (ctk=='4'){
			$("#div_sdana").hide();
		    $("#reke").show();
            $("#div_bulan").show();
            $("#div_gaji").hide();
            $("#periode").hide();
			$("#div_ptd").show();
			$("#div_skpd").hide();
			$("#gaya").hide();
        } else if (ctk=='5'){
			$("#div_sdana").hide();
			$("#reke").hide();
            $("#div_bulan").show();
            $("#div_gaji").hide();
            $("#periode").hide();
			$("#div_ptd").show();
			$("#div_skpd").hide();
			$("#gaya").hide();
        }else if (ctk=='9'){
			$("#div_sdana").hide();
		    $("#reke").hide();
            $("#div_bulan").show();
            $("#div_gaji").hide();
            $("#periode").hide();
			$("#div_ptd").show();
			$("#div_skpd").hide();
			$("#gaya").hide();
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
<h5 align="center"><b><a href="#" id="section1">LAPORAN - LAPORAN BELANJA LANGSUNG</a></b></h5>

 <fieldset>
     <table align="center" style="width:100%;" border="0">  
			<tr>
				<td colspan="2" align="center" style="border-top:solid 1px red;border-bottom:solid 1px red"><i>Pastikan Pencairan di BUD sudah dilakukan atau SP2D telah di SPJkan agar Report Valid</i></td>
			</tr>
			<tr>
				<td width="50%" />&nbsp;MEITY</td>
				<td width="50%" />&nbsp;</td>
			</tr>
			<tr>
				<td width="50%" align="left"><input type="radio" name="cetak" value="1" onclick="opt(this.value)"/>&nbsp;Rincian Belanja Langsung Per SKPD</td>
				<td width="50%" align="left">&nbsp;</td>
			</tr>
			<tr>
				<td width="50%" align="left"><input type="radio" name="cetak" value="3" onclick="opt(this.value)"/>&nbsp;Rincian Belanja Langsung Perkode Rekening</td>
				<td width="50%" align="left">&nbsp;</td>
			</tr>
			<tr>
				<td width="50%" align="left"><input type="radio" name="cetak" value="4" onclick="opt(this.value)"/>&nbsp;Rincian Belanja Langsung Keseluruhan SKPD Perkode Rekening</td>
				<td width="50%" align="left">&nbsp;</td>
			</tr>
			<tr>
				<td width="50%" align="left"><input type="radio" name="cetak" value="5" onclick="opt(this.value)"/>&nbsp;Rincian Belanja Langsung Per Bulan</td>
                <td width="50%" align="left">&nbsp;</td>
			</tr>
			<tr>
				<td width="50%" align="left"><input type="radio" name="cetak" value="9" onclick="opt(this.value)"/>&nbsp;Rekapitulasi Rincian Belanja Langsung Per SP2D </td>
				<td width="50%" align="left">&nbsp;</td>
			</tr>

    
	 </table><br>
     
     
     
<div id="gaya">
<td width="922px" colspan="2"><input type="radio" name="cetak" value="1" onclick="opt1(this.value)" /><b>Keseluruhan</b></td></tr>
        <tr><td width="922px" colspan="2"><input type="radio" name="cetak" value="2" id="status" onclick="opt1(this.value)" /><b>Per SKPD</b>
			<div id="tagih">
				<table >
					<tr >
						<td width="22px" height="10%" ><B>SKPD</B></td>
						<td width="900px"><input id="sskpd" name="sskpd" style="width: 150px;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="nmskpd" name="nmskpd" style="width: 500px; border:0;" /></td>
					</tr>
				</table> 
			</div>
            </td></tr>
            </div>




	   <div id="reke">
			<table style="width:100%;" border="0">
				<td width="20%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;REKENING</td>
				<td width="1%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">:</td>
				<td width="79%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><input id="rek3" name="rek3" style="width: 100px;" />
				<input id="nmrek3" name="nmrek3" style="width: 565px;" style="border-bottom:hidden;border-top:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;" readonly/>
				</td>
			</table>
  	</div>
    

    
    
      <div id="div_sdana">
			<table style="width:100%;" border="0">
				<td width="20%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;SUMBER DANA</td>
				<td width="1%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">:</td>
				<td width="79%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><input id="sdana" name="rek3" style="width: 100px;" />
                </td>
			</table>
  	</div>
	
  	<div id="periode">
			<table style="width:100%;" border="0">
				<td width="20%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;PERIODE</td>
				<td width="1%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">:</td>
				<td width="79%"><input type="text" id="tgl1" style="width: 100px;" /> s.d. <input type="text" id="tgl2" style="width: 100px;" /></td>
			</table>
  	</div>
    
 
    

    
	  <div id="div_bulan">
			<table style="width:100%;" border="0">
				<td width="20%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;BULAN</td>
				<td width="1%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">:</td>
				<td width="79%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><select  name="bulan" id="bulan" >
							 <option value="">...Bulan Transaksi... </option>
							 <option value="1" >1 | Januari</option>
							 <option value="2">2 | Februari</option>
							 <option value="3">3 | Maret</option>
							 <option value="4">4 | April</option>
							 <option value="5">5 | Mei</option>
							 <option value="6">6 | Juni</option>
							 <option value="7">7 | Juli</option>
							 <option value="8">8 | Agustus</option>
							 <option value="9">9 | September</option>
							 <option value="10">10 | Oktober</option>
							 <option value="11">11 | November</option>
							 <option value="12">12 | Desember</option>
						   </select>
				</td>
			</table>
		</div>

		<div id="div_gaji">
			<table style="width:100%;" border="0">
				<td width="20%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;GAJI</td>
				<td width="1%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">:</td>
				<td width="79%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><select name="gaji" id="gaji" >
							 <option value="">...Pilih Jenis Gaji... </option>
							 <option value="1">1 | Regular</option>
							 <option value="2">2 | Susulan</option>
							 <option value="3">3 | Rapel</option>
							 <option value="4">4 | Rapel Gaji Pokok</option>
							 <option value="5">5 | Gaji 13</option>
							 <option value="6">6 | Duka</option>
							 
						   </select>
				</td>
			</table>
		</div>

<div id="div_ptd">
			<table style="width:100%;" border="0">
				<td width="20%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;TTD</td>
				<td width="1%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">:</td>
				<td width="79%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><input id="ttd" name="ttd" style="width: 160px;" />
				&nbsp;<input type="text" id="tglttd" style="width: 100px;" /></td>
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