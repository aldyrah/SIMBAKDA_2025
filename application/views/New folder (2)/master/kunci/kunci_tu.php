<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/demo/demo.css">
      <script src="<?php echo base_url(); ?>assets/sweetalert/lib/sweet-alert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/sweetalert/lib/sweet-alert.css">

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
            },
			onSelect: function(date){
			lmpar();
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
		
		
		
		
		
	$(function(){ 	
$('#advis').combogrid({  
  panelWidth:500,  
  url:'<?php echo base_url(); ?>/index.php/tukd/combo_advise',
  idField:'no_advise',  
  textField:'no_advise',
  mode:'remote',  
  fitColumns:true,                       
  columns:[[  
  {field:'no_advise',title:'No',width:150},  
  {field:'tgl_advise',title:'Tanggal',align:'left',width:60},
  {field:'total',title:'total',align:'right',width:100}                      
  ]],
  onSelect:function(rowIndex,rowData){
    no_advise   = rowData.no_advise;
    tgl_advise = rowData.tgl_advise;
   
    total = rowData.total;
   

    

  }    
});
		
	 });
			
		
		function lmpar(){ 
		var tgl1 = $('#tgl1').datebox('getValue');
	//	alert(tgl1);
		$('#advis').combogrid({  
  panelWidth:500,  
  url:'<?php echo base_url(); ?>/index.php/tukd/combo_advise',
  idField:'no_advise',  
  textField:'no_advise',
  mode:'remote',  
  fitColumns:true, 
   queryParams:({tgl1:tgl1}),                       
  columns:[[  
  {field:'no_advise',title:'No',width:150},  
  {field:'tgl_advise',title:'Tanggal',align:'left',width:60},
  {field:'total',title:'total',align:'right',width:100}                      
  ]],
  onSelect:function(rowIndex,rowData){
    no_advise   = rowData.no_advise;
    tgl_advise = rowData.tgl_advise;
   
    total = rowData.total;
   

    

  }    
});
	}


	
    function simpan_spm(){        

var skpd = $('#sskpd').combogrid("getValue");
  
		
            lcquery = "UPDATE sclient  SET keamanan='"+skpd+"' "; 
            
            $(document).ready(function(){
            $.ajax({
                type     : "POST",
                url      : '<?php echo base_url(); ?>/index.php/tukd/update_keamanan',
                data     : ({st_query:lcquery}),
                dataType : "json",
                success  : function(data){
                           status=data ;
                        
                       
                        
                        if ( status=='2' ){
                            //alert('Data Tersimpan...!!!');
							  swal({
			  title: 'Tersimpan..!!',
			  text: "Akan Menutup Dalam 2 Detik!!!",
			  confirmButtonColor: "#80C8FE",
			  type: "success",
			  timer: 3500,
			  confirmButtonText: "Ya",
			  showConfirmButton: true
			});
                            lcstatus = 'edit';
                            exit();
                        }
                        
                        if ( status=='0' ){
                            alert('Gagal Simpan...!!!');
                            exit();
                        }
                    }
            });
            });
            
          
        }
        
	
	
		
	 function opt(val){        
    ctk=val;
        if (ctk=='1'){
    
	       			 $("#sskpd").combogrid("setValue",'');
			 $("#nmskpd").attr("Value",'');

				$("#skp2").hide();
			
	
      
		}else {
							$("#skp2").show();
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
<h5 align="center"><b><a href="#" id="section1">KEAMANAN TU</a></b></h5>

 <fieldset>
     <table align="center" style="width:100%;" border="0">  
			<tr>
				<td colspan="3" align="center" style="border-top:solid 1px red;border-bottom:solid 1px red">&nbsp;</td>
			</tr>
			<td width="20%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;KUNCI</td>
				<td width="1%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">:</td>
				<td width="79%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
<input type="radio" name="T" value="1"  onclick="opt(this.value)"/> KUNCI<BR />
<input type="radio" name="T" value="2"  onclick="opt(this.value)"/>BUKA
			  &nbsp;KUNCI TU                

				</td>
			</tr>
		
    
    
	 </table><br>
     
     
     

    
    

    

      
           
<div id="skp2">
			  <table >
					<tr >
						<td width="22px" height="10%" ><B>SKPD</B></td>
						<td width="900px"><input id="sskpd" name="sskpd" style="width: 150px;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="nmskpd" name="nmskpd" style="width: 500px; border:0;" /></td>
					</tr>
			</table> 
			
        </td></tr>
      </div>
    






		
		
		
		
		
		
	  <div id="cetak">
		<p align="center">         
			  <a id="save" class="easyui-linkbutton" iconCls="icon-save" plain="false" onclick="javascript:simpan_spm();">Simpan</a>  
          
		</p> 
	  </div>  
</fieldset>
    

</div>

</div>

 	
</body>

</html>