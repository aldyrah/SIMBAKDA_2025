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
  <style>   
  
    #tagih {
        position: relative;
        width: 922px;
        height: 100px;
        padding: 0.4em;
    }  
    </style>
    <script type="text/javascript"> 
    var nip='';
	var kdskpd='';
	var kdrek5='';
    
     $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
                height: 100,
                width: 922            
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

   	    $('#dcetak2').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
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
   	});
        
    $(function(){
        $("#tagih").hide();
   	});   
        
    function opt(val){        
        ctk = val; 
        if (ctk=='1'){
            $("#tagih").hide();
            $("#dcetak").datebox("setValue",'');
            $("#dcetak2").datebox("setValue",'');
        } else if (ctk=='2'){
           $("#tagih").show();
           } else {
            exit();
        }                 
    }   
    function cek(){
            var skpd = kdskpd; 	
		    if (ctk=='1'){                
                   cetak();   
                
            } else if (ctk=='2'){
                if (kdskpd==''){
                alert('Pilih SKPD Terlebih Dahulu');
                exit(); 
                }else {
                    cetak();
                    }            
            }
    }
    function cetak(){
            var skpd   = kdskpd; 
			var tgl1 =  cbulan = $('#bulan').combogrid('getValue');			
			if (ctk=='1'){
				var url ="<?php echo site_url(); ?>/akuntansi/ctk_lpe_pemda/1";
			} else{
				var url ="<?php echo site_url(); ?>/akuntansi/ctk_lpe_skpd/1";
			}	
			ctglttd = $('#dcetak2').datebox('getValue');
			
			window.open(url+'?cetak='+ctk+'&bulan='+tgl1+'&kdskpd='+skpd+'&tgl_ctk='+ctglttd);
			window.focus();
    }
	
	
	function cek1(){
            var skpd = kdskpd; 	
		    if (ctk=='1'){                
                   cetak1();   
                
            } else if (ctk=='2'){
                if (kdskpd==''){
                alert('Pilih SKPD Terlebih Dahulu');
                exit(); 
                }else {
                    cetak1();
                    }            
            }
    }
    function cetak1(){
            var skpd   = kdskpd; 
			var tgl1 =  cbulan = $('#bulan').combogrid('getValue');			
			if (ctk=='1'){
				var url ="<?php echo site_url(); ?>/akuntansi/ctk_lpe_pemda/2";
			} else{
				var url ="<?php echo site_url(); ?>/akuntansi/ctk_lpe_skpd/2";
			}	
			ctglttd = $('#dcetak2').datebox('getValue');
			
			window.open(url+'?cetak='+ctk+'&bulan='+tgl1+'&kdskpd='+skpd+'&tgl_ctk='+ctglttd);
			window.focus();
    }
     
     function runEffect(){
        var selectedEffect = 'blind';            
        var options = {};                      
        $( "#tagih" ).toggle( selectedEffect, options, 500 );
        };
        
      function pilih() {
       op = '1';       
      };   

    </script>
    <STYLE TYPE="text/css"> 
		 input.right{ 
         text-align:right; 
         } 
	</STYLE> 
</head>
<body>

<div id="content">
<h3>CETAK LAPORAN PERUBAHAN EKUITAS (LPE)</h3>
<div id="accordion">
    <p align="right">         
        <table>          
        <tr><td width="922px" colspan="2"><input type="radio" name="cetak" value="1" onclick="opt(this.value)" /><b>Keseluruhan</b></td></tr>
        <tr><td width="922px" colspan="2"><input type="radio" name="cetak" value="2" id="status" onclick="opt(this.value)" /><b>Per SKPD</b>
			<div id="tagih">
				<table >
					<tr >
						<td width="22px" height="10%" ><B>SKPD</B></td>
						<td width="900px"><input id="sskpd" name="sskpd" style="width: 150px;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="nmskpd" name="nmskpd" style="width: 500px; border:0;" /></td>
					</tr>
				</table> 
			</div>
        </td>
            <tr>
                <td colspan="3">
                <div id="div_periode">
                        <table style="width:100%;" border="0">
                            <td width="20%">BULAN</td>
                            <td width="1%">:</td>
                            <td width="79%"><input type="text" id="bulan" style="width: 100px;" /> 
                            </td>
                        </table>
                </div>
                </td>
            </tr>		
        </tr>
            <tr>
                <td colspan="3">
                <div id="div_bend">
                        <table style="width:100%;" border="0">
                            <td width="20%">TANGGAL TTD</td>
                            <td width="1%">:</td>
                            <td><input type="text" id="dcetak2" style="width: 100px;" /> 
                            </td> 
                        </table>
                </div>
                </td> 
            </tr> 		
		<tr >
			<td align="center" colspan="3">
			<a class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:cek();">Cetak</a>
			<a class="easyui-linkbutton" iconCls="icon-excel" plain="true" onclick="javascript:cek1();">Export</a>
			
			</td>
		</tr>
		
        </table>                      
    </p> 
</div>
</div>
</body>
</html>