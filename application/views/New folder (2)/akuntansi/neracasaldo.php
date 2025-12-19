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
			$("#spasi").attr("value",0);
        }); 
		
     $(function(){ 
      
            $('#skpd').combogrid({  
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
                $("#nmskpd").attr("value",rowData.nm_skpd);
            }  
            }); 	      
      
       $('#tgl1').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
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
      
    
    	$('#ttd').combogrid({  
    		panelWidth:500,  
    		url: '<?php echo base_url(); ?>/index.php/tukd/list_ttd',  
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
	 
	 
	 
	 
	function cetak()
	{   
	
	
		ctglttd         = $('#tgl_ttd').datebox('getValue');
        var spasi       = document.getElementById('spasi').value;
        ckdskpd         = $('#skpd').combogrid('getValue');
        ctgl1 =  cbulan = $('#bulan').combogrid('getValue');

		
		if(ctk=='1'){
		var url    = "<?php echo site_url(); ?>/akuntansi/cetak_neracasaldo/1";
 lc = '?tgl1='+ctgl1+'&tgl_ttd='+ctglttd+'&skpd='+ckdskpd+'&spasi='+spasi;
		}else if(ctk=='2'){
				var url    = "<?php echo site_url(); ?>/akuntansi/cetak_neracasaldo_all/1";
 lc = '?tgl1='+ctgl1+'&tgl_ttd='+ctglttd+'&skpd='+ckdskpd+'&spasi='+spasi;
		

		}
		
			window.open(url+lc, '_blank');
			window.focus();
	}
		
	
function cetakx()
	{ 	ctglttd         = $('#tgl_ttd').datebox('getValue');
        var spasi       = document.getElementById('spasi').value;
        ckdskpd         = $('#skpd').combogrid('getValue');
        ctgl1 =  cbulan = $('#bulan').combogrid('getValue');

		
		if(ctk=='1'){
		var url    = "<?php echo site_url(); ?>/akuntansi/cetak_neracasaldo/2";
 lc = '?tgl1='+ctgl1+'&tgl_ttd='+ctglttd+'&skpd='+ckdskpd+'&spasi='+spasi;
		}else if(ctk=='2'){
				var url    = "<?php echo site_url(); ?>/akuntansi/cetak_neracasaldo_all/2";
 lc = '?tgl1='+ctgl1+'&tgl_ttd='+ctglttd+'&skpd='+ckdskpd+'&spasi='+spasi;
		

		}
		
			window.open(url+lc, '_blank');
			window.focus();
	}
     
   </script>








<div id="content"> 
<div id="accordion">
<h5 align="center"><b><a href="#" id="section1">NERACA SALDO</a></b></h5>

 <fieldset>
     <table align="center" style="width:100%;" border="0">  
			
			<tr>
				<td width="99%" align="left"><input type="radio" name="cetak" value="1" onclick="opt(this.value)" />&nbsp;NERACA SALDO SKPD</td>
				<td width="1%" align="left">&nbsp;</td>
			</tr>
			<tr>
				<td width="99%" align="left"><input type="radio" name="cetak" value="2" onclick="opt(this.value)" />
			    &nbsp;NERACA SALDO KONSOLIDASI</td>
				<td>&nbsp;</td>
			</tr>
            	   
    
    
	 </table><br>
     
     
         
<div id="skp2">
			  <table >
					<tr >
						<td width="22px" height="10%" ><B>SKPD</B></td>
						<td width="900px"><input id="skpd" name="sskpd" style="width: 150px;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="nmskpd" name="mskpd" style="width: 500px; border:0;" /></td>
					</tr>
			</table> 
			
        </td></tr>
      </div>
    
    
    
     <table align="center" style="width:100%;" border="0">
            <tr>
                <td colspan="3">
               
                </td>
            </tr>                      
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
            <tr>
                <td colspan="3">
                <div id="div_bend">
                        <table style="width:100%;" border="0">
                            <td width="20%">TANGGAL TTD</td>
                            <td width="1%">:</td>
                            <td><input type="text" id="tgl_ttd" style="width: 100px;" /> 
                            </td> 
                        </table>
                </div>
                </td> 
            </tr>
			 <tr>
                <td colspan="3">
                <div>
                        <table style="width:100%;" border="0">
                            <td width="20%">ENTER TTD</td>
                            <td width="1%">:</td>
                            <td><input type="text" id="spasi" style="width: 50px;" /> 
                            </td> 
                        </table>
                </div>
                </td> 
            </tr>
            <td colspan="3">&nbsp;</td>
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


