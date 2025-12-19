

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
    
    var kode = '';
    var giat = '';
    var nomor= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
    var ctk = '';
        
     $(document).ready(function() {
            
        get_skpd();
        });
    
     $(function(){ 
        
       $("#div_bulan").hide();
       $("#div_periode").hide(); 
      
       $('#tgl1').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });

        $('#bulana').combogrid({  
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
        
        $('#tgl2').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });
    
      //$('#skpd').combogrid({  
//           panelWidth:700,  
//           idField:'kd_skpd',  
//           textField:'kd_skpd',  
//           mode:'remote',
//           url:'<?php echo base_url(); ?>index.php/tukd/skpd_2',  
//           columns:[[  
//               {field:'kd_skpd',title:'Kode SKPD',width:100},  
//               {field:'nm_skpd',title:'Nama SKPD',width:700}    
//           ]],  
//           onSelect:function(rowIndex,rowData){
//               kode = rowData.kd_skpd;               
//               $("#nmskpd").attr("value",rowData.nm_skpd.toUpperCase());
//               $('#rek').combogrid({url:'<?php echo base_url(); ?>index.php/tukd/ambil_rek_tetap/'+kode});                 
//           }  
//       });
       
       // $('#bulan').combogrid({  
       //     panelWidth:120,
       //     panelHeight:300,  
       //     idField:'bln',  
       //     textField:'nm_bulan',  
       //     mode:'remote',
       //     url:'<?php echo base_url(); ?>index.php/rka/bulan',  
       //     columns:[[ 
       //         {field:'nm_bulan',title:'Nama Bulan',width:700}    
       //     ]] 
       // });
              
      
    });        
    
            $(function(){
      $('#bulan').combogrid({  
        panelWidth : 500,   
        idField    : 'no_sp2d',  
        textField  : 'no_sp2d',  
        mode       : 'remote',
        url        : '<?php echo base_url(); ?>/index.php/sisa_spj/C_sisa_spj/load_sp2d',  
        columns    : [[    
          {field:'no_sp2d',title:'NO SP2D',width:400, align:'left'},  
          {field:'nilai',title:'NILAI',width:100}
        ]],
        onSelect:function(rowIndex,rowData){
          $('.no_sp2d').html(rowData.no_sp2d);
          // = rowData.nm_persh;
          //rekening = rowData.rekening;
         // npwp = rowData.npwp;
          // $("#rekanan").attr("Value",nama_perusahaan);  
          // $("#rekening").attr("Value",rekening);
          // $("#npwp").attr("Value",npwp);    
        },
      }); 
    });

     $(function(){
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
       });
    
     function cetak(){
        $("#dialog-modal").dialog('close');
     } 
     
     function get_skpd()
        {
        
        	$.ajax({
        		url:'<?php echo base_url(); ?>index.php/rka/config_skpd',
        		type: "POST",
        		dataType:"json",                         
        		success:function(data){
        								$("#skpd").attr("value",data.kd_skpd);
        								$("#nmskpd").attr("value",data.nm_skpd);
        								kode = data.kd_skpd;
                                        validate_rek();
                                        
        							  }                                     
        	});
             
        }
     
     function openWindow( url ){
         var ckdskpd = document.getElementById('skpd').value;//$('#skpd').combogrid('getValue');
         //var ckdskpd = cnoskpd.split("/").join("123456789");
             ctglttd = $('#tgl_ttd').datebox('getValue');
         if(ctk==1){
            cbulana = $('#bulana').combogrid('getValue');
            lc = '?kd_skpd='+ckdskpd+'&bulana='+cbulana+'&cpilih=1';
            // lc = '?kd_skpd='+ckdskpd+'&cpilih=1';
         }else{
            cbulan = $('#bulan').combogrid('getValue');
            lc = '?kd_skpd='+ckdskpd+'&bulan='+cbulan+'&tgl_ttd='+ctglttd+'&cpilih=2';
         }
         window.open(url+lc,'_blank');
         window.focus();
         //window.open(url+'/'+ckdskpd+'/'+ctgl1+'/'+ctgl2+'/'+tglttd, '_blank');
         //'window.focus();
     }  
     
     function opt(val){        
        ctk = val; 
        if (ctk=='1'){
            $("#div_bulan").hide();
            $("#div_periode").show();
        } else if (ctk=='2'){
            $("#div_bulan").show();
            $("#div_periode").hide();
            } else {
            exit();
        }                 
    }     
    
    function coba(){
        var bln1 = $('#bulan1').combogrid('getValue');
        alert(bln1);
    }
  
   </script>


<div id="content1" align="center"> 
    <h3 align="center"><b>CETAK LAPORAN SISA SPJ TU<br>
   </b></h3>
    <fieldset style="width: 70%;">
     <table align="center" style="width:100%;" border="0">
            <tr>
                <td><input type="radio" name="cetak" value="1" onclick="opt(this.value)" />Keseluruhan &ensp;
                <input type="radio" name="cetak" value="2" id="status" onclick="opt(this.value)" />SP2D
                </td>
                <td>&ensp;</td>
                <td>&nbsp</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp</td>
            </tr>
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
                            <td width="79%"><input id="bulana" name="bulana" style="width: 100px;" /> 
                            </td>
                        </table>
                </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                 <div id="div_bulan">
                        <table style="width:100%;" border="0">
                            <td width="20%">SP2D</td>
                            <td width="1%">:</td>
                            <td width="79%"><input id="bulan" name="bulan" style="width: 100px;" />
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
            <td colspan="3">&nbsp;</td>
            </tr>            
            <tr>
                <td colspan="3" align="center">
                <a href="<?php echo site_url(); ?>/sisa_spj/C_sisa_spj/cetak_sisa_tu" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:openWindow(this.href);return false">Cetak</a>
				<a href="<?php echo site_url(); ?>/sisa_spj/C_sisa_spj/cetak_sisa_tu/2/" class="easyui-linkbutton" iconCls="icon-excel" plain="true" onclick="javascript:openWindow(this.href);return false">export</a>
				</td>                
            </tr>
        </table>  
            
    </fieldset>  
</div>	
