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
    
    <link href="<?php echo base_url(); ?>easyui/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo base_url(); ?>easyui/jquery-ui.min.js"></script>
   
    <script type="text/javascript"> 
    var nip='';
	var kdskpd='';
	var kdrek5='';
    var kode='';
    
    $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
                height: 400,
                width: 800            
            });
             get_skpd();               
        });   
	
	$(function(){
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

    function get_skpd()
        {
        
        	$.ajax({
        		url:'<?php echo base_url(); ?>index.php/rka/config_skpd',
        		type: "POST",
        		dataType:"json",                         
        		success:function(data){
        								$("#sskpd").attr("value",data.kd_skpd);
        								$("#nmskpd").attr("value",data.nm_skpd);
        								kdskpd = data.kd_skpd;
                                        validate_giat(kdskpd);
                                        validate_ttd(kdskpd);
                                        validate_rek(kode); 
                                        
        							  }                                     
        	});
             
        } 
	
     function validate_giat(){
		  $(function(){
            $('#giat').combogrid({  
            panelWidth:700,  
            idField:'kd_kegiatan',  
            textField:'kd_kegiatan',  
            mode:'remote',
            url:'<?php echo base_url(); ?>/index.php/tukd/ld_giat/'+kdskpd,  
            columns:[[  
                {field:'kd_kegiatan',title:'Kode Kegiatan',width:100},  
                {field:'nm_kegiatan',title:'Nama Kegiatan',width:660}    
            ]],
            onSelect:function(rowIndex,rowData){
                    kode = rowData.kd_kegiatan;                    
                    $("#nm_giat").attr("value",rowData.nm_kegiatan);                    
                    validate_rek(kode);
                    } 
            }); 
            });
		}
     function validate_rek(){
	   $(function(){
	   $('#kdrek5').combogrid({  
		panelWidth:630,  
		idField:'kd_rek5',  
		textField:'kd_rek5',  
		mode:'remote',
		url:'<?php echo base_url(); ?>index.php/tukd/ld_rek/'+kode,  
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
	});
    }
    
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
	//cdate = '<?php echo date("Y-m-d"); ?>';
 function validate_ttd(){
   $(function(){
            $('#ttd').combogrid({  
                panelWidth:500,  
                url: '<?php echo base_url(); ?>/index.php/tukd/pilih_ttd/'+kdskpd,  
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
     }  


		function cetak()
        {
			var dcetak = $('#dcetak').datebox('getValue');      
			var dcetak2= $('#dcetak2').datebox('getValue');
            var kgiat  = kode;      
			var ttd    = nip;                           
            var ttd1   = ttd.split(" ").join("aa"); 
			var skpd   = kdskpd; 
			var rek5   = rekening; 
			var tglttd = $('#tgl_ttd').datebox("getValue");
            var lc = '?tgl1='+dcetak+'&tgl2='+dcetak2+'&cgiat='+kgiat+'&cttd='+ttd1+'&cskpd='+skpd+'&crek5='+rek5+'&ttd='+tglttd;
			var url    = "<?php echo site_url(); ?>/tukd/cetak_rincian_objek";  
			//window.open(url+'/'+dcetak+'/'+ttd1+'/'+kdskpd+'/'+rek5+'/'+dcetak2+'/'+kgiat, '_blank');
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


<h3>CETAK LAPORAN RINCIAN PEROBJEK</h3>
<div id="accordion">

    
    <p align="right">         
        <table id="sp2d" title="Cetak Buku Besar" style="width:865px;height:200px;" >  
		<tr >
			<td width="20%" height="40" ><B>SKPD</B></td>
			<td width="80%"><input id="sskpd" name="sskpd" style="width: 150px;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="nmskpd" name="nmskpd" style="width: 500px; border:0;" /></td>
		</tr>
        <tr >
			<td width="20%" height="40" ><B>KEGIATAN</B></td>
			<td width="80%"><input id="giat" name="giat" style="width: 150px;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="nm_giat" name="nm_giat" style="width: 500px; border:0;" /></td>
		</tr>

		<tr >
			<td width="20%" height="40" ><B>REKENING</B></td>
			<td width="80%"><input id="kdrek5" name="kdrek5" style="width: 150px;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="nmrek5" name="nmrek5" style="width: 500px; border:0;" /></td>
		</tr>

		<tr >
			<td width="20%" height="40" ><B>PERIODE</B></td>
			<td width="80%"><input id="dcetak" name="dcetak" type="text"  style="width:155px" />&nbsp;&nbsp;s/d&nbsp;&nbsp;<input id="dcetak2" name="dcetak2" type="text"  style="width:155px" /></td>
		</tr>
		<tr >
			<td width="20%" height="40" ><B>PENANDA TANGAN</B></td>
			<td width="80%"><input id="ttd" name="ttd" type="text"  style="width:230px" /></td>
		</tr>
		<tr >
			<td width="20%" height="40" ><B>TGL TTD</B></td>
			<td width="80%"><input type="text" id="tgl_ttd" style="width: 100px;" /></td>
		</tr>
		<tr >
			
			<td colspan="2" width="80%"> 
            <a class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:cetak();">Cetak</a>
			</td>
		</tr>
		<tr >
			<td ></td>
			<td ></td>
		</tr>
        </table>                      
    </p> 
   
</div>
</div>

 	
</body>

</html>