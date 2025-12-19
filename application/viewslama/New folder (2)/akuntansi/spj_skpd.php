

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
    
   
     
     function openWindow( url ){
      
        ctglttd         = $('#tgl_ttd').datebox('getValue');
        var spasi       = document.getElementById('spasi').value;
        ckdskpd         = $('#skpd').combogrid('getValue');
        ctgl1 =  cbulan = $('#bulan').combogrid('getValue');
          
         lc = '?tgl1='+ctgl1+'&tgl_ttd='+ctglttd+'&skpd='+ckdskpd+'&spasi='+spasi;
        
         window.open(url+lc,'_blank');
         window.focus();
         
     }  
     
   </script>


<div id="content1" align="center"> 
    <h3 align="center"><b>CETAK SPJ SKPD</b></h3>
    
     <table align="center" style="width:100%;" border="0">
            <tr>
                <td colspan="3">
                <div id="div_skpd">
                        <table style="width:100%;" border="0">
                            <td width="20%">SKPD</td>
                            <td width="1%">:</td>
                            <td width="79%"><input id="skpd" name="skpd" style="width: 100px;" />&ensp;
                            <input type="text" id="nmskpd" readonly="true" style="width: 400px;border:0" />
                            </td>
                        </table>
                </div>
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
            <tr>
                <td colspan="3" align="center">
                <a href="<?php echo site_url(); ?>/akuntansi/cetak_spj_skpd/1" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:openWindow(this.href);return false">Cetak</a>
				<a href="<?php echo site_url(); ?>/akuntansi/cetak_spj_skpd/2" class="easyui-linkbutton" iconCls="icon-excel" plain="true" onclick="javascript:openWindow(this.href);return false">export</a>
                </td>                
            </tr>
        </table>  
             
</div>	
