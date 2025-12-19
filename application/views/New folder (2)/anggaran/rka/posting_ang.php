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
    var ctk='1';
	var kdrek5='';
    var pilih=1;
	var isi='';
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
   	     $('#tgldpa').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            },
            onSelect: function(date){
		      jaka = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
	       }
        });
   	});

	$(function(){  
		$("#tagih").hide();  
	});

     function opt(isi){
		pilih=isi;
		if (pilih=='1'){
			$("#tagih").hide();							
        } else{
			$("#tagih").show();	
		}
	 }

    function cek(){            
		if(pilih==1){
			var r= confirm("Apa anda yakin ingin Posting Keseluruhan ..!!");
			if (r==true)
			{
				rekal2();
			}
		}else{
			var kdskpd = $("#sskpd").combogrid("getValue");
			if ( kdskpd == '' ){
				alert('Pilih SKPD Terlebih Dahulu...!!!');
				exit();
            }else{
				var r= confirm("Apa anda yakin ingin Posting PerSKPD ..!!");
				if (r==true)
				{
					rekal();
				}
			}
		}
            
    }
      
     function rekal(){  
        var kdskpd = $("#sskpd").combogrid("getValue"); 
        var cno = document.getElementById('dpa').value;
		var ctgl = $('#tgldpa').datebox('getValue');
		document.getElementById('load').style.visibility='visible';
        
		$(function(){      
		 $.ajax({
			type: 'POST',
			data: ({ctk:ctk,skpd:kdskpd,no:cno,tgl:ctgl}),
			dataType:"json",
			url:"<?php echo base_url(); ?>index.php/rka/proses_posting",
			success:function(data){
				if (data == '1'){
					alert('POSTING SELESAI');
				}else{
					alert('CLIENT LAIN SEDANG MELAKUKAN REKAL');					
				}
				document.getElementById('load').style.visibility='hidden';
			}
		 });
		});
	}

	function rekal2(){  
        var cno = document.getElementById('dpa').value;
		var ctgl = $('#tgldpa').datebox('getValue');
		document.getElementById('load').style.visibility='visible';
        
		$(function(){      
		 $.ajax({
			type: 'POST',
			data: ({ctk:ctk,no:cno,tgl:ctgl}),
			dataType:"json",
			url:"<?php echo base_url(); ?>index.php/rka/posting_all",
			success:function(data){
				if (data == '1'){
					alert('POSTING SELESAI');
				}else{
					alert('CLIENT LAIN SEDANG MELAKUKAN REKAL');					
				}
				document.getElementById('load').style.visibility='hidden';
			}
		 });
		});
	}
    
     function runEffect() {
        var selectedEffect = 'blind';            
        var options = {};                      
        $( "#tagih" ).toggle( selectedEffect, options, 500 );
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



<h3>REKAL APBD</h3>
<div id="accordion" width="100%">
    
    <p align="right">         
        <table id="sp2d" border="1" title="Cetak" style="width:922px;height:200px;">          
        <tr>
			<td width="200px" colspan="2">
				<input type="radio" name="cetak" value="1" onclick="opt(this.value)" /><b>Keseluruhan</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="cetak" value="2" id="status" onclick="opt(this.value)" /><b>Per SKPD</b>
			</td>
		</tr>
        <tr>
			<td width="922px" colspan="2">
				
                    <div id="tagih">
                        <table >
                            <tr >
                    			<td width="22px" height="40%" ><B>SKPD</B></td>
                    			<td width="900px"><input id="sskpd" name="sskpd" style="width: 150px;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="nmskpd" name="nmskpd" style="width: 500px; border:0;" /></td>
                    		</tr>
                        </table> 
                    </div>
			</td>
        </tr>

            <tr>
            <td width="30%">NO. Jurnal  : <input type="text" id="dpa" style="width:200px;"/></td>  
            </tr>
			
            <tr>
                <td width="30%">TGL Jurnal  : <input type="text" id="tgldpa" style="width:100px;"/></td>  
            </tr>
        <tr>
			<td width="10%" align="center"> 
			<INPUT TYPE="button" VALUE="PROSES" style="height:40px;width:100px" onclick="javascript:cek();" >
			</td>
		</tr>
		<tr height="70%" >
			<td align="center" style="visibility:hidden" >	<DIV id="load" > <IMG SRC="<?php echo base_url(); ?>assets/images/mapping.gif" WIDTH="270" HEIGHT="40" BORDER="0" ALT=""></DIV></td>
		</tr>
        </table>                      
    </p> 

</div>
</div>
</body>
</html>
