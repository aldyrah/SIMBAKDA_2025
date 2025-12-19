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
			$("#giat").hide();
			
			$("#div_skpd").hide();
			
			//$("#gaya").show();
			
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
                kdskpd = rowData.kd_skpd;

                validate_giat();
                $("#kdgiat").combogrid("clear");
                $("#nmgiat").attr("Value",'');
                $("#nmskpd").attr("value",rowData.nm_skpd);
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
	
	
	function validate_giat(){
          

	  	    $(function(){
            $('#kdgiat').combogrid({  
            panelWidth : 600,  
            idField    : 'kd_kegiatan',  
            textField  : 'kd_kegiatan',  
            mode       : 'remote',
            url        : '<?php echo base_url(); ?>index.php/rka/pgiat_ms/'+kdskpd,  
            columns    : [[  
                {field:'kd_kegiatan',title:'Kode SKPD',width:140},  
                {field:'nm_kegiatan',title:'Nama Kegiatan',width:420},
                    
            ]],
            onSelect:function(rowIndex,rowData){
                
                kegiatan = rowData.kd_kegiatan;
                $("#nmgiat").attr("value",rowData.nm_kegiatan.toUpperCase());
                //$("#giat").attr("value",rowData.kd_kegiatan);
                
            },
            }); 
            });
		}
		

	function cetak()
	{   
		var skpd = $('#sskpd').combogrid("getValue");
		var kdgiat = $('#kdgiat').combogrid("getValue");
	var ttd = $('#ttd').datebox('getValue'); 

		if(ctk=='1'){
			var url    = "<?php echo site_url(); ?>/akuntansi/cetak_realisasianggtgl/1/";  
			lc= '?skpd='+kdskpd+'&cpilih=1'+'&tgl='+ttd;
		}else if(ctk=='2'){
			var url    = "<?php echo site_url(); ?>/akuntansi/cetak_realisasianggtgl/1/";  
			lc= '?skpd='+kdskpd+'&keg='+kdgiat+'&cpilih=2'+'&tgl='+ttd;
		}
		
			window.open(url+lc, '_blank');
			window.focus();
	}

			function ekport()
	{   
		var skpd = $('#sskpd').combogrid("getValue");
		var kdgiat = $('#kdgiat').combogrid("getValue");
	var ttd = $('#ttd').datebox('getValue'); 

		if(ctk=='1'){
			var url    = "<?php echo site_url(); ?>/akuntansi/cetak_realisasianggtgl/2/";  
			lc= '?skpd='+kdskpd+'&cpilih=1'+'&tgl='+ttd;
		}else if(ctk=='2'){
			var url    = "<?php echo site_url(); ?>/akuntansi/cetak_realisasianggtgl/2/";  
			lc= '?skpd='+kdskpd+'&keg='+kdgiat+'&cpilih=2'+'&tgl='+ttd;
		}
		
			window.open(url+lc, '_blank');
			window.focus();
	}
	 function opt(val){        
        ctk = val; 
        if (ctk=='1'){
			$("#giat").hide();
		    
			 $("#kdgiat").combogrid("setValue",'');
			 $("#nmgiat").attr("Value",'');
			//$("#gaya").show();
        }  else if (ctk=='2'){
        	 $("#giat").show();
			 
			 $("#kdgiat").combogrid("setValue",'');
			 $("#nmgiat").attr("Value",'');
			 //$("#gaya").show();
        }else {
			exit();
        } 
    }     
	
		 function opt1(val){        
        //ctk1 = val; 
        if ("#gaya"=='2'){
		    $("#kdgiat").show();
			 $("#sskpd").combogrid("setValue",'');
			 $("#nmskpd").attr("Value",'');
			 $("#kdgiat").combogrid("setValue",'');
			 $("#nmgiat").attr("Value",'');
			 $("#gaya").show();
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
<h5 align="center"><b><a href="#" id="section1">CETAK REALISASI ANGGARAN</a></b></h5>

 <fieldset>
     <table align="center" style="width:100%;" border="0">  
	<tr>
				<td colspan="2" align="center" style="border-top:solid 1px red;border-bottom:solid 1px red"><i>UP,GU,LS BENDAHARA DIAMBIL DARI TRANSAKSI ,TU, LS GAJI,LS PPKD & LS BARANG JASA DIAMBIL DARI SP2D TERBIT</i></td>
			</tr>

			<tr>
				<td width="100%" align="center">&nbsp;CETAK REALISASI ANGGARAN</td>
				
			</tr>
			<!--<tr>
				<td width="100%" align="left"><input type="radio" name="cetak" value="2" onclick="opt(this.value)" />&nbsp;Register Perhitungan Fihak Ketiga(PFK) Pembiayaan Keluar</td>
				<td width="0%" align="left">&nbsp;</td>
			</tr>-->
			
		
    
    
	 </table><br>
     
     
     
<div id="gaya">
<td width="922px" align="center" colspan="2"><input type="radio" name="cetak" value="1" onclick="opt(this.value)" /><b>Keseluruhan</b></td></tr>
        <tr><td width="922px" colspan="2"><input type="radio" name="cetak" value="2" id="status" onclick="opt(this.value)" /><b>Per Kegiatan</b>
			<div id="tagih">
				<table >
					<tr >
						<td width="22px" height="10%" ><B>SKPD</B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td width="900px"><input id="sskpd" name="sskpd" style="width: 150px;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="nmskpd" name="nmskpd" style="width: 500px; border:0;" /></td>
					</tr>
				</table> 
			</div>
            </td></tr>
            </div>




	   

<div id="giat">
			<table style="width:100%;" border="0">
				<td width="22px" height="10%"><b>Kegiatan</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
				
				<td width="900px"><input id="kdgiat" name="kdgiat" style="width: 160px;" />
				<input type="text" id="nmgiat" style="width: 500px; border:0;" /></td>
			</table>
  	</div>
    
      <div id="div_sdana">
			<table style="width:100%;" border="0">
				  <td width="20%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;PER Tanggal </td>
				<td width="1%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">:</td>
				<td width="79%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
						<input id="ttd" name="ttd" style="width: 100px;" />
                </td>
			</table>
  	</div>	
		
      
        
		<!-- <div id="div_ttd">
			<table style="width:100%;" border="0">
				<td width="20%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;ENTER TTD</td>
				<td width="1%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">:</td>
				<td width="79%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><input id="hal" name="hal" style="width: 20px;" />&nbsp;baris
                </td>
			</table>
  	</div>-->
    



		
		
		
		
		
		
	  <div id="cetak">
		<p align="center">         
			<a class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:cetak();">cetak</a>   
			<a class="easyui-linkbutton" iconCls="icon-excel" plain="true" onclick="javascript:ekport();">Export</a>   
          
		</p> 
	  </div>  
</fieldset>
    

</div>

</div>

 	
</body>

</html>