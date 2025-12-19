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
			$("#div_sdana").hide();
			$("#div_skpd").hide();
			$("#reke").hide();
			$("#hal").attr("value",0);
			$("#periode").hide();
			
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
    	$('#skpd').combogrid({  
    		panelWidth:500,  
    		url: '<?php echo base_url(); ?>/index.php/tukd/skpd',  
    			idField:'kd_skpd',                    
    			textField:'nm_skpd',
    			mode:'remote',  
    			fitColumns:true,  
    			columns:[[  
    				{field:'kd_skpd',title:'KODE',width:30},  
    				{field:'nm_skpd',title:'NAMA SKPD',align:'left',width:100}								
    			]],
    			onSelect:function(rowIndex,rowData){
    				$("#skpd").attr("value",rowData.kd_skpd);
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

	function cetak()
	{   var ttdd = $('#ttd').combogrid("getValue");
		var rek3 = $('#rek3').combogrid("getValue");
		var bulan = document.getElementById('bulan').value;
		var sdana = $('#sdana').combogrid("getValue");
		var chal = document.getElementById('hal').value;
		var tgl1 = $('#tgl1').datebox('getValue');
		var tgl2 = $('#tgl2').datebox('getValue');
		var skpd = $('#skpd').combogrid("getValue");
		//var space = document.getElementById('space').value;
		if(ctk=='1'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_lrbl/1/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='2'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_reg_sbl/1/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='3'){
			var url    = "<?php echo site_url(); ?>/tukd/ghe_jasa/1/";  
			lc= '?bulan='+bulan+'&rek3='+rek3+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='4'){
			var url    = "<?php echo site_url(); ?>/tukd/rek_sp2d_bl/1/";
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='5'){
			var url    = "<?php echo site_url(); ?>/tukd/brinci/1/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='6'){
			var url    = "<?php echo site_url(); ?>/tukd/reg_bhp/1/";  
			lc= '?bulan='+bulan;
		}else if(ctk=='7'){
			var url    = "<?php echo site_url(); ?>/tukd/potongan/1/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
//=====================INI BARU =================================================
		}else if(ctk=='8'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_sp2d_baru/1/";  
			lc= '?bulan='+bulan+'&sdana='+sdana+'&chal='+chal+'&ttdd='+ttdd;
//===============================================================================
		}else if(ctk=='9'){
			var url    = "<?php echo site_url(); ?>/tukd/rek_sp2d_bel/1/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='10'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_sp2d_gj_btl/1/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='11'){
			var url    = "<?php echo site_url(); ?>/tukd/tamsil/1/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='12'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_sp2d_gj_susul/1/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='13'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_pfk/1/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='14'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_sp2d_uang_duka/1/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='15'){
			var url    = "<?php echo site_url(); ?>/tukd/btl_hibah/1/";    
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='16'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_lap_otsus/1/";  
			lc= '?tgl1='+tgl1+'&tgl2='+tgl2+'&sdana='+sdana+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='17'){
			var url    = "<?php echo site_url(); ?>/tukd/reg_sp2d_btl/1/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='18'){
			var url    = "<?php echo site_url(); ?>/tukd/setoran_kas/1/";  
			lc= '?bulan='+bulan;
		}else if(ctk=='19'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_btl_kdh/1/";  
			lc= '?bulan='+bulan;
		}else if(ctk=='20'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_tprofesi/1/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='21'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_jabar_real/1/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='22'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_pfk_btl/1/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='23'){
			var url    = "<?php echo site_url(); ?>/tukd/btl_bansos/1/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='24'){
			var url    = "<?php echo site_url(); ?>/tukd/btl_bbkp/1/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='25'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_pfk_btl_skpd/1/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd+'&skpd='+skpd;
		}
		
			window.open(url+lc, '_blank');
			window.focus();
	}

	function cetakx()
	{	var ttdd = $('#ttd').combogrid("getValue");
		var rek3 = $('#rek3').combogrid("getValue");
		var bulan = document.getElementById('bulan').value;
		var sdana = $('#sdana').combogrid("getValue");
		var chal = document.getElementById('hal').value;
		var tgl1 = $('#tgl1').datebox('getValue');
		var tgl2 = $('#tgl2').datebox('getValue');
		var skpd = $('#skpd').combogrid("getValue");
		//var space = document.getElementById('space').value;
		if(ctk=='1'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_lrbl/2/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='2'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_reg_sbl/2/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='3'){
			var url    = "<?php echo site_url(); ?>/tukd/ghe_jasa/2/";  
			lc= '?bulan='+bulan+'&rek3='+rek3+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='4'){
			var url    = "<?php echo site_url(); ?>/tukd/rek_sp2d_bl/1/";
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='5'){
			var url    = "<?php echo site_url(); ?>/tukd/brinci/2/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='6'){
			var url    = "<?php echo site_url(); ?>/tukd/reg_bhp/2/";  
			lc= '?bulan='+bulan;
		}else if(ctk=='7'){
			var url    = "<?php echo site_url(); ?>/tukd/potongan/2/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
//=====================INI BARU =================================================
		}else if(ctk=='8'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_sp2d_baru/2/";  
			lc= '?bulan='+bulan+'&sdana='+sdana+'&chal='+chal+'&ttdd='+ttdd;
//===============================================================================
		}else if(ctk=='9'){
			var url    = "<?php echo site_url(); ?>/tukd/rek_sp2d_bel/2/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='10'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_sp2d_gj_btl/2/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='11'){
			var url    = "<?php echo site_url(); ?>/tukd/tamsil/2/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='12'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_sp2d_gj_susul/2/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='13'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_pfk/2/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='14'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_sp2d_uang_duka/2/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='15'){
			var url    = "<?php echo site_url(); ?>/tukd/btl_hibah/2/";    
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='16'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_lap_otsus/2/";  
			lc= '?tgl1='+tgl1+'&tgl2='+tgl2+'&sdana='+sdana+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='17'){
			var url    = "<?php echo site_url(); ?>/tukd/reg_sp2d_btl/2/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='18'){
			var url    = "<?php echo site_url(); ?>/tukd/setoran_kas/2/";  
			lc= '?bulan='+bulan;
		}else if(ctk=='19'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_btl_kdh/2/";  
			lc= '?bulan='+bulan;
		}else if(ctk=='20'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_tprofesi/2/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='21'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_jabar_real/2/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='22'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_pfk_btl/2/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='23'){
			var url    = "<?php echo site_url(); ?>/tukd/btl_bansos/2/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='24'){
			var url    = "<?php echo site_url(); ?>/tukd/btl_bbkp/2/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd;
		}else if(ctk=='25'){
			var url    = "<?php echo site_url(); ?>/tukd/cetak_pfk_btl_skpd/2/";  
			lc= '?bulan='+bulan+'&chal='+chal+'&ttdd='+ttdd+'&skpd='+skpd;
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
            $("#periode").hide();
			$("#div_ptd").show();
			$("#div_skpd").hide();
        } else if (ctk=='2'){
			$("#div_sdana").hide();
			$("#reke").hide();
            $("#div_bulan").show();
            $("#periode").hide();
			$("#div_ptd").show();
			$("#div_skpd").hide();
        } else if (ctk=='3'){
			$("#div_sdana").hide();
		    $("#reke").show();
            $("#div_bulan").show();
            $("#periode").hide();
			$("#div_ptd").show();
			$("#div_skpd").hide();
        } else if (ctk=='4'){
			$("#div_sdana").hide();
			$("#reke").hide();
            $("#div_bulan").show();
            $("#periode").hide();
			$("#div_ptd").show();
			$("#div_skpd").hide();
        } else if (ctk=='5'){
			$("#div_sdana").hide();
			$("#reke").hide();
            $("#div_bulan").show();
            $("#periode").hide();
			$("#div_ptd").show();
			$("#div_skpd").hide();
        } else if (ctk=='6'){
			$("#div_sdana").hide();
		    $("#reke").hide();
            $("#div_bulan").show();
            $("#periode").hide();
			$("#div_ptd").show();
			$("#div_skpd").hide();
        }else if (ctk=='7'){
			$("#div_sdana").hide();
		    $("#reke").hide();
			$("#div_sdana").hide();
            $("#div_bulan").show();
            $("#periode").hide();
			$("#div_ptd").show();
			$("#div_skpd").hide();
        }else if (ctk=='8'){
			$("#div_sdana").show();
		    $("#reke").hide();
            $("#div_bulan").show();
            $("#periode").hide();
			$("#div_ptd").show();
			$("#div_skpd").hide();
        }else if (ctk=='9'){
			$("#div_sdana").hide();
		    $("#reke").hide();
            $("#div_bulan").show();
            $("#periode").hide();
			$("#div_ptd").show();
			$("#div_skpd").hide();
        }else if (ctk=='10'){
			$("#div_sdana").hide();
		    $("#reke").hide();
            $("#div_bulan").show();
            $("#periode").hide();
			$("#div_ptd").show();
			$("#div_skpd").hide();
		}else if (ctk=='11'){
			$("#div_sdana").hide();
		    $("#reke").hide();
            $("#div_bulan").show();
            $("#periode").hide();
			$("#div_ptd").show();
			$("#div_skpd").hide();
		}else if (ctk=='12'){
			$("#div_sdana").hide();
		    $("#reke").hide();
            $("#div_bulan").show();
            $("#periode").hide();
			$("#div_ptd").show();
			$("#div_skpd").hide();
		}else if (ctk=='13'){
			$("#div_sdana").hide();
		    $("#reke").hide();
            $("#div_bulan").show();
            $("#periode").hide();
			$("#div_ptd").show();
			$("#div_skpd").hide();
		}else if (ctk=='14'){
			$("#div_sdana").hide();
		    $("#reke").hide();
            $("#div_bulan").show();
            $("#periode").hide();
			$("#div_ptd").show();
        }else if (ctk=='15'){
			$("#div_sdana").hide();
		    $("#reke").hide();
            $("#div_bulan").show();
            $("#periode").hide();
			$("#div_ptd").show();
			$("#div_skpd").hide();
        }else if (ctk=='16'){
			$("#div_sdana").show();
		    $("#reke").hide();
            $("#div_bulan").hide();
            $("#periode").show();
            $("#div_ptd").show();
            $("#div_skpd").hide();
		}else if (ctk=='17'){
			$("#div_sdana").hide();
		    $("#reke").hide();
            $("#div_bulan").show();
            $("#periode").hide();
			$("#div_ptd").show();
			$("#div_skpd").hide();
		}else if (ctk=='18'){
			$("#div_sdana").hide();
		    $("#reke").hide();
            $("#div_bulan").show();
            $("#periode").hide();
			$("#div_ptd").hide();
			$("#div_skpd").hide();
		}else if (ctk=='19'){
			$("#div_sdana").hide();
		    $("#reke").hide();
            $("#div_bulan").show();
			$("#periode").hide();
			$("#div_ptd").show();
			$("#div_skpd").hide();
		}else if (ctk=='20'){
			$("#div_sdana").hide();
		    $("#reke").hide();
            $("#div_bulan").show();
			$("#div_ptd").show();
			$("#periode").hide();
			$("#div_skpd").hide();
    	}else if (ctk=='21'){
			$("#div_sdana").hide();
		    $("#reke").hide();
            $("#div_bulan").show();
			$("#div_ptd").show();
			$("#periode").hide();
			$("#div_skpd").hide();
		}else if (ctk=='22'){
			$("#div_sdana").hide();
		    $("#reke").hide();
            $("#div_bulan").show();
            $("#periode").hide();
			$("#div_ptd").show();
			$("#div_skpd").hide();
		}else if (ctk=='23'){
			$("#div_sdana").hide();
		    $("#reke").hide();
            $("#div_bulan").show();
            $("#periode").hide();
			$("#div_ptd").show();
			$("#div_skpd").hide();
		}else if (ctk=='24'){
			$("#div_sdana").hide();
		    $("#reke").hide();
            $("#div_bulan").show();
            $("#periode").hide();
			$("#div_ptd").show();
			$("#div_skpd").hide();
        }else if (ctk=='25'){
			$("#div_sdana").hide();
		    $("#reke").hide();
            $("#div_bulan").show();
            $("#periode").hide();
			$("#div_ptd").show();
			$("#div_skpd").show();
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
				<td colspan="2" align="center" width="100%" style="border-top:solid 1px red;border-bottom:solid 1px red"><i>Pastikan Pencairan di BUD sudah dilakukan atau SP2D telah di SPJkan agar Report Valid</i></td>
			</tr>

			<tr>
				<td width="50%" align="left"><input type="radio" name="cetak" value="1" onclick="opt(this.value)" />&nbsp;Rincian Belanja Langsung Per SKPD</td>
				<td width="50%" align="left"><input type="radio" name="cetak" value="2" onclick="opt(this.value)" />&nbsp;Register SP2D Belanja Langsung Per SKPD</td>
			</tr>
			<tr>
				<td width="50%" align="left"><input type="radio" name="cetak" value="3" onclick="opt(this.value)" />&nbsp;Rincian Belanja Langsung Perkode Rekening</td>
				<td width="50%" align="left"><input type="radio" name="cetak" value="4" onclick="opt(this.value)" />&nbsp;Rekapitulasi Belanja Langsung Per Sumber Dana</td>
			</tr>
			<tr>
				<td width="50%" align="left"><input type="radio" name="cetak" value="5" onclick="opt(this.value)" />&nbsp;Rincian Belanja Langsung Per Bulan</td>
                
                
                

				<td width="50%" align="left"><input type="radio" name="cetak" value="8" onclick="opt(this.value)" />
			    &nbsp;Register SP2D Sumber Dana</td>
			</tr>
			<tr>
				<td width="50%" align="left"><input type="radio" name="cetak" value="7" onclick="opt(this.value)" />&nbsp;Rekapitulasi pfk Belanja Langsung Per Bulan</td>
			  <td width="50%" align="left"><input type="radio" name="cetak" value="10" onclick="opt(this.value)" />
		      &nbsp;Rekapitulasi Gaji Regular</td>
			</tr>
			<tr>
				<td width="50%" align="left"><input type="radio" name="cetak" value="9" onclick="opt(this.value)" />&nbsp;Rekapitulasi Rincian Belanja Langsung Per SP2D </td>
				<td width="50%" align="left"><input type="radio" name="cetak" value="12" onclick="opt(this.value)" />
			    &nbsp;Rekapitulasi Gaji Susulan</td>
			</tr>
			<tr>
				<td width="50%" align="left"><input type="radio" name="cetak" value="11" onclick="opt(this.value)" />&nbsp;Rincian Belanja Tidak Langsung Tambah Penghasilan</td>
				<td width="50%" align="left"><input type="radio" name="cetak" value="14" onclick="opt(this.value)" />
			    &nbsp;Rekapitulasi Uang Duka</td>
			</tr>
			<tr>
				<td width="50%" align="left"><input type="radio" name="cetak" value="13" onclick="opt(this.value)" />&nbsp;Register Perhitungan Fihak Ketiga(PFK) Belanja Langsung</td>
				<td width="50%" align="left"><input type="radio" name="cetak" value="16" onclick="opt(this.value)" />
			    &nbsp;Laporan OTSUS / DAK</td>
			</tr>
			<tr>
				<td width="50%" align="left"><input type="radio" name="cetak" value="15" onclick="opt(this.value)" />&nbsp;Daftar Belanja Tidak langsung (Belanja Hibah)</td>
				<td width="50%" align="left"><input type="radio" name="cetak" value="17" onclick="opt(this.value)" />&nbsp;Daftar Sp2d Belanja Tidak langsung</td>
			</tr>
            	<tr>
				<td width="50%" align="left"><input type="radio" name="cetak" value="18" onclick="opt(this.value)" />&nbsp;Daftar Setoran Sisa</td>
				<td width="50%" align="left"><input type="radio" name="cetak" value="19" onclick="opt(this.value)" />&nbsp;Daftar Belanja Tidak langsung (KDH)</td>
			</tr>
			<tr>
			<td width="50%" align="left"><input type="radio" name="cetak" value="20" onclick="opt(this.value)" />&nbsp;Tunjangan Profesi Guru</td>
			<td width="50%" align="left"><input type="radio" name="cetak" value="21" onclick="opt(this.value)" />&nbsp;Penjabaran Penerimaan</td>
			
			</tr>
			<tr>
				<td width="50%" align="left"><input type="radio" name="cetak" value="22" onclick="opt(this.value)" />&nbsp;Register Perhitungan Fihak Ketiga(PFK) Belanja Tidak Langsung</td>
				<td width="50%" align="left"><input type="radio" name="cetak" value="23" onclick="opt(this.value)" />
			    &nbsp;Daftar Belanja Bantuan sosial</td>
			</tr>
			<tr>
				<td width="50%" align="left"><input type="radio" name="cetak" value="24" onclick="opt(this.value)" />&nbsp;Belanja Bantuan Keuangan Kepada Provinsi/Kabupaten/Kota</td>
				<td width="50%" align="left"><input type="radio" name="cetak" value="25" onclick="opt(this.value)" />&nbsp;Register Perhitungan Fihak Ketiga(PFK) Belanja Tidak Langsung per SKPD</td>
			</tr>
    
	 </table><br>
     
     
     
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
				<td width="79%"><input type="text" id="tgl1" style="width: 100px;" /> s.d. <input type="text" id="tgl2" style="width: 100px;" />
                </td>
			</table>
  	</div>
    
    
    <div id="div_skpd">
			<table style="width:100%;" border="0">
				<td width="20%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;SKPD</td>
				<td width="1%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">:</td>
				<td width="79%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><input id="skpd" name="skpd" style="width: 250px;" />
                </td>
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

<div id="div_ptd">
			<table style="width:100%;" border="0">
				<td width="20%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;TTD</td>
				<td width="1%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">:</td>
				<td width="79%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><input id="ttd" name="ttd" style="width: 160px;" />
				&nbsp;</td>
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