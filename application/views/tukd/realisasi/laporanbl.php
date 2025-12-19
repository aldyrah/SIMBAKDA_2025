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
			$("#div_rekap").hide();
			$("#div_bulan").show();
			$("#realisasi").hide();
			$("#div_sdana").hide();
			$("#div_gaji").hide();
			$("#div_skpd").hide();
			$("#div_lra").hide();
			$("#reke").hide();
			$("#hal").attr("value",0);
			$("#periode").hide();
			$("#tagih").hide();
			$("#gaya").hide();
			$("#skp2").hide();
			
			
			
			
			
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
			$("#sskpd").attr("value",rowData.kd_skpd);
           
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
    				$('#kode').attr("value",rowData.kode);
    			}   
    		});
       });	   







$(function(){
	$('#sskpd123').combogrid({  
		panelWidth:630,  
		idField:'kd_skpd',  
		textField:'kd_skpd',  
		mode:'remote',
		
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
					 sudana     = rowData.nm_sdana;
    				$("#sdana").attr("value",rowData.nm_rek3);
				
				//alert(sudana);
						 $('#sskpd123').combogrid({url: '<?php echo base_url(); ?>/index.php/tukd/skpd_sumber',
                                   queryParams:({sb:sudana})
                                   });
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
		var rekap = document.getElementById('rekap').value;
		var gaji = document.getElementById('gaji').value;
		var sdana = $('#sdana').combogrid("getValue");
		var chal = document.getElementById('hal').value;
		var tgl1 = $('#tgl1').datebox('getValue');
		var tgl2 = $('#tgl2').datebox('getValue');
		var skpd = $('#sskpd123').combogrid("getValue");
			var skpd1 = $('#sskpd').combogrid("getValue");
		var tglttd = $('#tglttd').datebox('getValue');
		var kode  = document.getElementById('kode').value;
		
		
		if(ctk=='2'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_reg_sbl/1/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd+'&tglttd='+tglttd;
		
		}else if(ctk=='4'){
			var url    = "<?php echo site_url(); ?>/tukd/rek_sp2d_bl/1/";
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd+'&tglttd='+tglttd;
		
		}else if(ctk=='7'){
			var url    = "<?php echo site_url(); ?>/tukd/potongan/1/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd+'&tglttd='+tglttd;
//=====================INI BARU =================================================
		}else if(ctk=='8'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_sp2d_baru/1/";  
			lc= '?bulan='+bulan+'&sdana='+sdana+'&chal='+chal+'&ttdd='+ttdd+'&tglttd='+tglttd+'&skpd='+skpd+'&rekap='+rekap;
//===============================================================================
		
		}else if(ctk=='12'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_sp2d_rekapitulasi/1/";  
			lc= '?bulan='+bulan+'&sdana='+sdana+'&chal='+chal+'&ttdd='+ttdd+'&tglttd='+tglttd+'&skpd='+skpd; 
		}else if(ctk=='13'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_pfk/1/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd+'&tglttd='+tglttd+'&rekap='+rekap;
		}else if(ctk=='14'){
			var url    = "<?php echo site_url(); ?>/tukd/tes_toh/1/";  
			lc= '?bulan='+bulan+'&sdana='+sdana+'&chal='+chal+'&ttdd='+ttdd+'&tglttd='+tglttd+'&skpd='+skpd; 
		
		}else if(ctk=='29'){
			var url    = "<?php echo site_url(); ?>/tukd/reg_sp2d_mawar/1/";  
			lc= '?posx='+tgl1+'&posy='+tgl2+'&sp='+chal+'&ttdd='+ttdd+'&tglttd='+tglttd+'&skpd='+skpd1+'&tampil='+ctk2+'&kode='+kode;
		}else if(ctk=='30'){
			var url    = "<?php echo site_url(); ?>/tukd/MANAJEMEN_KAS/1/";  
			lc= '?bulan='+bulan+'&chal='+chal;
		}else if(ctk=='31'){
			var url    = "<?php echo site_url(); ?>/tukd/rekap_sdana/1/";  
			lc= '?ttdd='+ttdd+'&tglttd='+tglttd+'&chal='+chal+'&bulan='+bulan;
		
	}else if(ctk=='32'){
			var url    = "<?php echo site_url(); ?>/tukd/mawar_2/1/";  
			lc= '?bulan='+bulan+'&sp='+chal+'&ttdd='+ttdd+'&tglttd='+tglttd; 
		}else if(ctk=='35'){
			var url    = "<?php echo site_url(); ?>/tukd/duasumber/1/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd+'&tglttd='+tglttd; 
		}else if(ctk=='36'){
			var url    = "<?php echo site_url(); ?>/tukd/REKAP_a/1/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&tampil='+ctk2;
		}
			window.open(url+lc, '_blank');
			window.focus();
	}



	function cetakx()
	{   var ttdd = $('#ttd').combogrid("getValue");
		var rek3 = $('#rek3').combogrid("getValue");
		var bulan = document.getElementById('bulan').value;
		var rekap = document.getElementById('rekap').value;
		var gaji = document.getElementById('gaji').value;
		var sdana = $('#sdana').combogrid("getValue");
		var chal = document.getElementById('hal').value;
		var tgl1 = $('#tgl1').datebox('getValue');
		var tgl2 = $('#tgl2').datebox('getValue');
		var skpd = $('#sskpd123').combogrid("getValue");
			var skpd1 = $('#sskpd').combogrid("getValue");
		var tglttd = $('#tglttd').datebox('getValue');
		
		
		if(ctk=='2'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_reg_sbl/2/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd+'&tglttd='+tglttd;
		
		}else if(ctk=='4'){
			var url    = "<?php echo site_url(); ?>/tukd/rek_sp2d_bl/2/";
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd+'&tglttd='+tglttd;
		
		}else if(ctk=='7'){
			var url    = "<?php echo site_url(); ?>/tukd/potongan/2/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd+'&tglttd='+tglttd;
//=====================INI BARU =================================================
		}else if(ctk=='8'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_sp2d_baru/2/";  
			lc= '?bulan='+bulan+'&sdana='+sdana+'&chal='+chal+'&ttdd='+ttdd+'&tglttd='+tglttd+'&skpd='+skpd+'&rekap='+rekap;
//===============================================================================
		
		}else if(ctk=='12'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_sp2d_rekapitulasi/2/";  
			lc= '?bulan='+bulan+'&sdana='+sdana+'&chal='+chal+'&ttdd='+ttdd+'&tglttd='+tglttd+'&skpd='+skpd; 
		}else if(ctk=='13'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_pfk/2/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd+'&tglttd='+tglttd+'&rekap='+rekap;
		}else if(ctk=='14'){
			var url    = "<?php echo site_url(); ?>/tukd/tes_toh/2/";  
			lc= '?bulan='+bulan+'&sdana='+sdana+'&chal='+chal+'&ttdd='+ttdd+'&tglttd='+tglttd+'&skpd='+skpd; 
		
		}else if(ctk=='29'){
			var url    = "<?php echo site_url(); ?>/tukd/reg_sp2d_mawar/2/";  
			lc= '?posx='+tgl1+'&posy='+tgl2+'&sp='+chal+'&ttdd='+ttdd+'&tglttd='+tglttd+'&skpd='+skpd1+'&tampil='+ctk2+'&kode='+kode;
		}else if(ctk=='30'){
			var url    = "<?php echo site_url(); ?>/tukd/MANAJEMEN_KAS/2/";  
			lc= '?bulan='+bulan+'&chal='+chal;
		}else if(ctk=='31'){
			var url    = "<?php echo site_url(); ?>/tukd/rekap_sdana/2/";  
			lc= '?ttdd='+ttdd+'&tglttd='+tglttd+'&chal='+chal+'&bulan='+bulan;
		
	}else if(ctk=='32'){
			var url    = "<?php echo site_url(); ?>/tukd/mawar_2/2/";  
			lc= '?bulan='+bulan+'&sp='+chal+'&ttdd='+ttdd+'&tglttd='+tglttd; 
		}else if(ctk=='35'){
			var url    = "<?php echo site_url(); ?>/tukd/duasumber/2/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd+'&tglttd='+tglttd; 
		}else if(ctk=='36'){
			var url    = "<?php echo site_url(); ?>/tukd/REKAP_a/2/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&tampil='+ctk2;
		}
			window.open(url+lc, '_blank');
			window.focus();
	}

		
			 function opt2(val){        
        ctk2 = val; 
		
		    }    
		
	 function opt(val){        
        ctk = val; 
        if (ctk=='2'){
			$("#div_sdana").hide();
			$("#reke").hide();
            $("#div_bulan").show();
            $("#div_gaji").hide();
            $("#periode").hide();
			$("#div_ptd").show();
			$("#div_skpd").hide();
			$("#gaya").hide();
			$("#skp2").hide();
			$("#div_rekap").hide();
			$("#div_lra").hide();
        } else if (ctk=='4'){
			$("#div_sdana").hide();
			$("#reke").hide();
            $("#div_bulan").show();
            $("#div_gaji").hide();
            $("#periode").hide();
			$("#div_ptd").show();
			$("#div_skpd").hide();
			$("#gaya").hide();
			$("#skp2").hide();
			$("#div_rekap").hide();
   $("#div_lra").hide();
        }else if (ctk=='7'){
			$("#div_sdana").hide();
		    $("#reke").hide();
			$("#div_sdana").hide();
            $("#div_bulan").show();
            $("#div_gaji").hide();
            $("#periode").hide();
			$("#div_ptd").show();
			$("#div_skpd").hide();
			$("#gaya").hide();
			$("#skp2").hide();
			$("#div_rekap").hide();
			$("#div_lra").hide();
        }else if (ctk=='8'){
						$("#div_rekap").show();
			$("#div_sdana").show();
		    $("#reke").hide();
            $("#div_bulan").show();
            $("#div_gaji").hide();
            $("#periode").hide();
			$("#div_ptd").show();
			$("#div_skpd").hide();
			$("#gaya").hide();
			$("#skp2").show();

      $("#div_lra").hide();
		}else if (ctk=='12'){
			$("#div_sdana").show();
		    $("#reke").hide();
            $("#div_bulan").show();
            $("#div_gaji").hide();
            $("#periode").hide();
			$("#div_ptd").show();
			$("#div_skpd").hide();
			$("#gaya").hide();
			$("#skp2").show();
			$("#div_rekap").hide();
			$("#div_lra").hide();
		}else if (ctk=='13'){
			$("#div_sdana").hide();
		    $("#reke").hide();
            $("#div_bulan").show();
            $("#div_gaji").hide();
            $("#periode").hide();
			$("#div_ptd").show();
			$("#div_skpd").hide();
			$("#gaya").hide();
			$("#skp2").hide();
			$("#div_rekap").show();
			$("#div_lra").hide();
		}else if (ctk=='14'){
		$("#div_rekap").hide();
			$("#div_sdana").show();
		    $("#reke").hide();
            $("#div_bulan").show();
            $("#div_gaji").hide();
            $("#periode").hide();
			$("#div_ptd").show();
			$("#gaya").hide();
			$("#skp2").hide();
			$("#div_lra").hide();
       }else if (ctk=='29'){
		   $("#div_lra").show();
	   $("#div_rekap").hide();
			$("#div_sdana").hide();
		    $("#reke").hide();
            $("#div_bulan").hide();
            $("#div_gaji").hide();
            $("#periode").show();
            $("#div_ptd").show();
            $("#div_skpd").hide();
			$("#gaya").show();
			$("#skp2").hide();
	}else if (ctk=='30'){
		$("#div_lra").hide();
	$("#div_rekap").hide();
			$("#div_sdana").hide();
		    $("#reke").hide();
            $("#div_bulan").show();
            $("#div_gaji").hide();
            $("#periode").hide();
            $("#div_ptd").hide();
            $("#div_skpd").hide();
			$("#gaya").hide();
			$("#skp2").hide();
	}else if (ctk=='31'){
	$("#div_rekap").hide();
	$("#div_lra").hide();
			$("#div_sdana").hide();
		    $("#reke").hide();
            $("#div_bulan").show();
            $("#div_gaji").hide();
            $("#periode").hide();
            $("#div_ptd").show();
            $("#div_skpd").hide();
			$("#gaya").hide();
			$("#skp2").hide();
		}else if (ctk=='32'){
		$("#div_rekap").hide();
			$("#div_sdana").hide();
		    $("#reke").hide();
            $("#div_bulan").show();
            $("#div_gaji").hide();
            $("#periode").hide();
            $("#div_ptd").show();
            $("#div_skpd").hide();
			$("#gaya").hide();
			$("#skp2").hide();
			$("#div_lra").hide();
		}else if (ctk=='35'){
		$("#div_rekap").hide();
			$("#div_sdana").hide();
		    $("#reke").hide();
            $("#div_bulan").show();
            $("#div_gaji").hide();
            $("#periode").hide();
            $("#div_ptd").show();
            $("#div_skpd").hide();
			$("#gaya").hide();
			$("#skp2").hide();
			$("#div_lra").hide();
	}else if (ctk=='36'){
		$("#div_lra").show();
	$("#div_rekap").hide();
			$("#div_sdana").hide();
		    $("#reke").hide();
            $("#div_bulan").show();
            $("#div_gaji").hide();
            $("#periode").hide();
            $("#div_ptd").hide();
            $("#div_skpd").hide();
			$("#gaya").hide();
			$("#skp2").hide();
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
	
	 function opt3(val){        
        ctk11 = val; 
        if (ctk11=='1'){
		    $("#tagih2").hide();
			 $("#sskpd1").combogrid("setValue",'');
			 $("#nmskpd1").attr("Value",'');
        } else if (ctk11=='2'){
			$("#tagih2").show();
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
	
				<td width="50%" />&nbsp;NURCE</td>

                <td width="50%" align="left">&nbsp;</td>
			</tr>
			<tr>

				<td width="50%" align="left"><input type="radio" name="cetak" value="7" onclick="opt(this.value)"/>&nbsp;Rekapitulasi pfk Belanja Langsung Per Bulan</td>
                <td width="50%" align="left">&nbsp;</td>
			</tr>
			<tr>

				<td width="50%" align="left"><input type="radio" name="cetak" value="13" onclick="opt(this.value)"/>&nbsp;Register Perhitungan Fihak Ketiga(PFK) Belanja Langsung</td>
                <td width="50%" align="left">&nbsp;</td>
			</tr>
			<tr>

                <td width="50%" align="left"><input type="radio" name="cetak" value="12" onclick="opt(this.value)"/>&nbsp;Rekapitulasi SP2D Belanja Langsung</td>
                <td width="50%" align="left">&nbsp;</td>
			</tr>
			<tr>

				<td width="50%" align="left"><input type="radio" name="cetak" value="2" onclick="opt(this.value)"/>&nbsp;Register SP2D Belanja Langsung Per SKPD</td>
			<td width="50%" align="left">&nbsp;</td>
            </tr>
			<tr>
				
				<td width="50%" align="left"><input type="radio" name="cetak" value="8" onclick="opt(this.value)" />&nbsp;Register SP2D Sumber Dana</td>
                <td width="50%" align="left">&nbsp;</td>
			</tr>
			<tr>
				
				<td width="50%" align="left"><input type="radio" name="cetak" value="4" onclick="opt(this.value)"/>&nbsp;Rekapitulasi Belanja Langsung Per Sumber Dana</td>
                <td width="50%" align="left">&nbsp;</td>
			</tr>
			<tr>
				
				<td width="50%" align="left"><input type="radio" name="cetak" value="14" onclick="opt(this.value)"/>&nbsp;Rekapitulasi Belanja Langsung SP2D Seluruh SKPD</td>
                <td width="50%" align="left">&nbsp;</td>
			</tr>	
			<tr>
	
				<td width="50%" align="left"><input type="radio" name="cetak" value="29" onclick="opt(this.value)"/>&nbsp;Realisasi SP2D</td>
                <td width="50%" align="left" hidden="true"><input type="text" name="kode" id="kode">&nbsp;</td>
			</tr>				
    		<tr>
		
				<td width="50%" align="left"><input type="radio" name="cetak" value="30" onclick="opt(this.value)"/>&nbsp;Manajemen KAS</td>
                <td width="50%" align="left">&nbsp;</td>
			</tr>
			<tr>
		
				<td width="50%" align="left"><input type="radio" name="cetak" value="31" onclick="opt(this.value)"/>&nbsp;Laporan Sumber Dana Per Bulan</td>
                <td width="50%" align="left">&nbsp;</td>
			</tr>
			<tr>
				<td width="50%" align="left"><input type="radio" name="cetak" value="32" onclick="opt(this.value)"/>
				&nbsp;Rekap Register SP2D Belanja Langsung</td>
                <td width="50%" align="left">&nbsp;</td>
			</tr>
    
	  <tr>
		
				<td width="50%" align="left"><input type="radio" name="cetak" value="35" onclick="opt(this.value)"/>
				&nbsp;SP2D beberapa sumber dana</td>
                <td width="50%" align="left">&nbsp;</td>
			</tr>
            
            
              <tr>
		
				<td width="50%" align="left"><input type="radio" name="cetak" value="36" onclick="opt(this.value)"/>
				&nbsp;REKAPITULASI SP2D BELANJA LANGSUNG KESELURUHAN</td>
                <td width="50%" align="left">&nbsp;</td>
			</tr>
	 </table><br>
     
     
     
        <div id="div_lra">
	<table style="width:100%;" border="0">
   <td width="20%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
   <input type="radio" name="cekcekcek" id="cekcekcek" value="1" onclick="opt2(this.value)" /> TAMPILKAN 
   <input type="radio" name="cekcekcek" id="cekcekcek" value="0" onclick="opt2(this.value)"/> TIDAK DI TAMPILAKAN
 
</table>
</div>

     
     
     
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
	
    
         
<div id="skp2">
<td width="922px" colspan="2"><input type="radio" name="cetaka" value="1" onclick="opt3(this.value)" /><b>Keseluruhan</b></td></tr>
        <tr><td width="922px" colspan="2"><input type="radio" name="cetaka" value="2" id="status" onclick="opt3(this.value)" /><b>Per SKPD</b>
			<div id="tagih2">
				<table >
					<tr >
						<td width="22px" height="10%" ><B>SKPD</B></td>
						<td width="900px"><input id="sskpd123" name="sskpd" style="width: 150px;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="nmskpd123" name="nmskpd123" style="width: 500px; border:0;" /></td>
					</tr>
				</table> 
			</div>
            </td></tr>
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
		
      
	  
	  	  <div id="div_rekap">
			<table style="width:100%;" border="0">
				<td width="20%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;JUDUL </td>
				<td width="1%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">:</td>
				<td width="79%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><select  name="rekap" id="rekap" >
							 <option value="">...PILIH JUDUL... </option>
						 <option value="0">0 | REGISTER</option>	
						<option value="1" >1 | REKONSILIASI</option>
	
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
          	<a class="easyui-linkbutton" iconCls="icon-excel" plain="true" onclick="javascript:cetakx();">Export</a>
		</p> 
	  </div>  
      
      
      
      
</fieldset>
    

</div>

</div>

 	
</body>

</html>