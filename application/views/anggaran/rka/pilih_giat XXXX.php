    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/demo/demo.css">
	<script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.edatagrid.js"></script>
    <script type="text/javascript">
     
	var idx    = 0;
	var tidx   = 0;
	var oldRek = 0;
    var skpd   = ''; 
    var urusan = '';
    var vkdin  = '';
    var kdkegi = '';
    
    $(document).ready(function(){
        
            $(function(){
            $('#skpd').combogrid({  
            panelWidth:700,  
            idField:'kd_skpd',  
            textField:'kd_skpd',  
            mode:'remote',
            columns:[[  
                {field:'kd_skpd',title:'Kode SKPD',width:100},  
                {field:'nm_skpd',title:'Nama SKPD',width:700}    
            ]]
            }); 
            });

        
        	$(function(){
            $('#giat').combogrid({  
            panelWidth : 700,  
            idField    : 'kd_kegiatan',  
            textField  : 'kd_kegiatan',  
            mode       : 'remote',
            columns    : [[  
                {field:'kd_kegiatan',title:'Kode Kegiatan',width:100},  
                {field:'nm_kegiatan',title:'Nama Kegiatan',width:495},
                {field:'jns_kegiatan',title:'Jenis',width:40},
                {field:'lanjut',title:'',width:40}
            ]]
            }); 
            });
            

            $(function(){
            $("#giat").combogrid("disable");
            });
        
    });
    
        
    $(function(){
        $('#urusan').combogrid({  
            panelWidth:700,  
            idField:'kd_urusan',  
            textField:'kd_urusan',  
            mode:'remote',
            url:'<?php echo base_url(); ?>index.php/rka/urusan',  
            columns:[[  
                {field:'kd_urusan',title:'Kode Urusan',width:100},  
                {field:'nm_urusan',title:'Nama Urusan',width:700}    
            ]],
            onSelect:function(rowIndex,rowData){
                urusan = rowData.kd_urusan;
                $("#nm_urusan").attr("value",rowData.nm_urusan.toUpperCase());
                validate_skpd();
                
                
            }  
        }); 
      });
      
      
      function validate_skpd(){
		  $(function(){
            $('#skpd').combogrid({  
            panelWidth:700,  
            idField:'kd_skpd',  
            textField:'kd_skpd',  
            mode:'remote',
            url:'<?php echo base_url(); ?>/index.php/rka/skpd',  
            columns:[[  
                {field:'kd_skpd',title:'Kode SKPD',width:100},  
                {field:'nm_skpd',title:'Nama SKPD',width:700}    
            ]],
            onSelect:function(rowIndex,rowData){
                skpd = rowData.kd_skpd;
                $("#nm_skpd").attr("value",rowData.nm_skpd.toUpperCase());
                validate_combo(skpd,urusan);
                validate_giat(skpd,urusan);
                $("#giat").combogrid("disable");
            }  
            }); 
            });
		}
        
        
        function validate_giat(){
		}
        												
        
        function append_jak(){  
            
            xkdkegi = $("#giat").combogrid("getValue");
            xnmkegi = document.getElementById('nm_giat').value;
            xjns    = document.getElementById('jns_giat').value;
            xljt    = document.getElementById('ljt').value;
            
            if ( xkdkegi == '' ){
                alert("Pilih Kegiatan Terlebih Dahulu...!!!");
                exit();
            }
                        
            $('#dg').datagrid('appendRow',{kd_kegiatan:xkdkegi,nm_kegiatan:xnmkegi,jns_kegiatan:xjns,lanjut:xljt});
            
            var vkdskpd = $("#skpd").combogrid("getValue");
            var vkdkegi = $("#giat").combogrid("getValue");
            var vurus   = $("#urusan").combogrid("getValue");
            
            $(document).ready(function(){
               $.ajax({
                      type     : "POST",
                      url      : '<?php echo base_url(); ?>index.php/rka/psimpan_ar',
                      data     : ({urusan:vurus,skpd:vkdskpd,kegiatan:vkdkegi,jns:jenis,lanjut:xljt}),
                      dataType : "json",
                      success  : function(data){
                                 st12 = data.pesan;
                                 if ( st12 =='1' ){
                                    alert("Data Tersimpan...!!!");
                                 } else {
                                    alert("Gagal Simpan");
                                 }
                      }  
               }); 
            });       
            $("#giat").combogrid("setValue",'');
            $("#giat").combogrid("disable");
            $("#nm_giat").attr("value",'');
            $("#jns_giat").attr("value",'');
        }
         
        
        function validate_combo(skpd,urusan){
        var cskpd = document.getElementById('skpd').value;
            $(function(){
			$('#dg').edatagrid({
				url           : '<?php echo base_url(); ?>/index.php/rka/select_giat/'+skpd,
                 idField      : 'id',
                 toolbar      : "#toolbar",              
                 rownumbers   : "true", 
                 fitColumns   : "true",
                 singleSelect : "true",
                 onAfterEdit  : function(rowIndex, rowData, changes){								
								 rk  = rowData.kd_kegiatan;
								 jns = rowData.jns_kegiatan;
								 ljt = rowData.lanjut;
								simpan(rk,oldRek,jns,ljt);
							 },
                 columns:[[
	                {field:'ck',
					 title:'ck',
					 checkbox:true,
					 hidden:true},
					{field:'kd_kegiatan',
					 title:'Kegiatan',
					 width:30,
					 align:'left'/*,	
					 editor:{type:"combobox",
      		                options:{valueField:'kd_kegiatan',
									  textField:'kd_kegiatan',
									  panelwidth:910,	
									  url :'<?php echo base_url();?>/index.php/rka/ld_giat/'+skpd+'/'+urusan,                                   
									  required:true,
									  onSelect:function(){							
						                      oldRek=getSelections(getRowIndex(this));
                                              alert(oldRek);	
						                  }
									  }
							}*/
					},                    
					{field:'nm_kegiatan',
					 title:'Nama Kegiatan',
					 width:140/*,
					 editor:{type:"text"}*/
					},
                    {field:'jns_kegiatan',
					 title:'Jenis',
					 width:10,
                     align:'center'/*,
					 editor:{type:"combobox",
      		                options:{valueField:'jns_kegiatan',
									  textField:'jns_kegiatan',
									  panelwidth:910,	
									  url :'<?php echo base_url();?>/index.php/rka/ld_jns',
									  required:true									  
									  }
							}*/
                    },
                    {field:'lanjut',
					 title:'Lanjutan',
					 width:20,
                     align:'center',
					 editor:{type:"combobox",
      		                options:{valueField:'lanjut',
									  textField:'lanjut',
									  panelwidth:910,	
									  url :'<?php echo base_url();?>/index.php/rka/ld_lanjut',
									  required:true									  
									  }
							}
                    }
				]],
                    onSelect:function(rowIndex,rowData){
                        kg=rowData.kd_kegiatan;
                    } 
			});
		});
        }

    
	$(function(){
			$('#dg').edatagrid({
				url: '<?php echo base_url(); ?>/index.php/rka/select_giat',
                 idField:'id',
                 toolbar:"#toolbar",              
                 rownumbers:"true", 
                 fitColumns:"true",
                 singleSelect:"true",
				 onAfterEdit:function(rowIndex, rowData, changes){								
								rk=rowData.kd_kegiatan;
								jns=rowData.jns_kegiatan;
								ljt=rowData.lanjut;

								simpan(rk,oldRek,jns,ljt);
							 },
				 onSelect:function(){							
						  oldRek=getSelections(getRowIndex(this));	
                          alert(oldRek);
						  },
				columns:[[
	                {field:'ck',
					 title:'ck',
					 checkbox:true,
					 hidden:true},
					{field:'kd_kegiatan',
					 title:'Kegiatan',
					 width:30,
					 align:'left'/*,	
					 editor:{type:"combobox",
      		                options:{valueField:'kd_kegiatan',
									  textField:'kd_kegiatan',
									  panelwidth:910,	
									  url :'<?php echo base_url();?>/index.php/rka/ld_giat',
									  required:true,
									  onSelect:function(){							
						                      oldRek=getSelections(getRowIndex(this));	
                                              cek(oldRek);
                                              alert(oldRek);
						                  }
									  }
							}*/
					},                    
					{field:'nm_kegiatan',
					 title:'Nama Kegiatan',
					 width:140/*,
					 editor:{type:"text"}*/
					},
                    {field:'jns_kegiatan',
					 title:'Jenis',
					 width:10,
                     align:'center'/*,
					 editor:{type:"combobox",
      		                options:{valueField:'jns_kegiatan',
									  textField:'jns_kegiatan',
									  panelwidth:910,	
									  url :'<?php echo base_url();?>/index.php/rka/ld_jns',
									  required:true									  
									  }
							}*/
                    },
                    {field:'lanjut',
					 title:'Lanjutan',
					 width:20,
                     align:'center',
					 editor:{type:"combobox",
      		                options:{valueField:'lanjut',
									  textField:'lanjut',
									  panelwidth:910,	
									  url :'<?php echo base_url();?>/index.php/rka/ld_lanjut',
									  required:true									  
									  }
							}
                    }
				]]	
			
			});
  	
		  

		});




		function getSelections(idx){
			var ids = [];
			var rows = $('#dg').edatagrid('getSelections');
			for(var i=0;i<rows.length;i++){
				ids.push(rows[i].kd_kegiatan);
			}
			return ids.join(':');
		}


		function getRowIndex(target){  
			var tr = $(target).closest('tr.datagrid-row');  
			return parseInt(tr.attr('datagrid-row-index'));  
		}  


        function simpan(baru,lama,jns,lanjut){		
        if (lama==''){ lama=baru}
            $(function(){
				$('#dg').edatagrid({
				     url: '<?php echo base_url(); ?>/index.php/rka/update_giat/'+skpd+'/'+urusan+'/'+baru+'/'+lama+'/'+jns+'/'+lanjut,
					 idField:'id',
					 toolbar:"#toolbar",              
					 rownumbers:"true", 
					 fitColumns:"true",
					 singleSelect:"true"
				});
			});

		}
		
		function cek(keg)
        {
        	$.ajax({
        		url:'<?php echo base_url(); ?>index.php/rka/cek/'+keg+'/'+skpd,
        		type: "POST",
        		dataType:"json",                         
        		success:function(data){
        								sta = data.ket;
                                        kgt = data.kd_kegiatan;
                                        tombol(sta);
                                        
        							  }                                     
        	});
        }
        function cekq(keg){                
    		var a = keg;
            var b = skpd;
            $(function(){      
             $.ajax({
                type: 'POST',
                data:({skpd:b,keg:a}),
                url:"<?php echo base_url(); ?>index.php/rka/cek",
                dataType:"json",
                success:function(data){ 
                    sta = data.ket;
                    kgt = data.kd_kegiatan;
                    alert(kgt);
                    tombol(sta);
                }
             });
            });
        }
        
        function hapus(){
				var rek=getSelections();
				if (rek !=''){
				var del=confirm('Anda yakin akan menghapus kegiatan '+rek+' ?');
				if  (del==true){
					alert(skpd+' '+rek);
					$(function(){
						$('#dg').edatagrid({
							 url          : '<?php echo base_url(); ?>/index.php/rka/ghapus/'+skpd+'/'+rek,
							 idField      : 'id',
							 toolbar      : "#toolbar",              
							 rownumbers   : "true", 
							 fitColumns   : "true",
							 singleSelect : "true"
						});
					});
                    
                    var rows = $("#dg").edatagrid("getSelected");
                    var idx  = $("#dg").edatagrid("getRowIndex",rows);
                    $("#dg").edatagrid("deleteRow",idx);
 				}
				}
		}
        
        function tombol(st){ 
            if (st=='1'){
            
             $('#del').linkbutton('disable');
             } else {
             $('#del').linkbutton('enable');
             }
        }
        
        
        function input(){

            $("#giat").combogrid("enable");
            $("#dg").datagrid("selectAll");
            var rows  = $("#dg").datagrid("getSelections");
            kdkegi    = '';
            vkdin     = '';
            for ( i=0; i<rows.length; i++ ) {
                kdkegi = rows[i].kd_kegiatan ;
                if ( i==0 ){
                    vkdin = "'"+kdkegi+"'";
                } else {
                    vkdin = vkdin+","+"'"+kdkegi+"'";  
                }
            }   
            
            var vkdskpd = $("#skpd").combogrid("getValue");
            var vurus   = $("#urusan").combogrid("getValue");

            $('#giat').combogrid({  
            panelWidth  : 700,  
            idField     : 'kd_kegiatan',  
            textField   : 'kd_kegiatan',  
            mode        : 'remote',
            url         : "<?php echo base_url(); ?>index.php/rka/ld_giat_ar", 
            queryParams : ({skpd:vkdskpd,urusan:vurus,xxx:vkdin}), 
            columns     : [[  
                {field:'kd_kegiatan',title:'Kode Kegiatan',width:100},  
                {field:'nm_kegiatan',title:'Nama Kegiatan',width:495},
                {field:'jns_kegiatan',title:'Jenis',width:40},
                {field:'lanjut',title:'',width:40}
            ]],
            onSelect:function(rowIndex,rowData){
                    kode   = rowData.kd_kegiatan;
                    nama   = rowData.nm_kegiatan;
                    jenis  = rowData.jns_kegiatan;
                    lanjut = rowData.lanjut;
                    $("#nm_giat").attr("value",rowData.nm_kegiatan.toUpperCase());  
                    $("#jns_giat").attr("value",jenis);
                    $("#ljt").attr("value",lanjut);
                    } 
            }); 
            $("#dg").datagrid("unselectAll");
        }

	</script>
    
</head>
<body>

<div id="content">   
    
  <table style="border-collapse:collapse; border-spacing:3px; padding: 3px 3px 3px 3px;width:910px" border='2'>
  
  <tr style="border-collapse:collapse; border-spacing:3px; padding: 3px 3px 3px 3px;border-bottom-color:transparent;">    
  <td style="border-collapse:collapse; border-spacing:3px; padding: 3px 3px 3px 3px;border-bottom-color:transparent;"></td>
  </tr>
  
  
  <tr style="border-collapse:collapse; border-spacing:3px; padding: 3px 3px 3px 3px;border-bottom-color:transparent;">    
  <td style="border-collapse:collapse; border-spacing:3px; padding: 3px 3px 3px 3px;border-bottom-color:transparent;">&nbsp;&nbsp;U R U S A N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="urusan" name="urusan" style="width: 100px;" />&nbsp;&nbsp;&nbsp;<input id="nm_urusan" name="nm_urusan" style="width:200px;border: 0;"/></td>
  </tr>
  <tr style="border-collapse:collapse; border-spacing:3px; padding: 3px 3px 3px 3px;border-bottom-color:transparent;">
  <td style="border-collapse:collapse; border-spacing:3px; padding: 3px 3px 3px 3px;border-bottom-color:transparent;">&nbsp;&nbsp;S K P D&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="skpd" name="skpd" style="width: 100px;" />&nbsp;&nbsp;&nbsp;<input id="nm_skpd" name="nm_skpd" style="width:600px;border: 0;"/></td>
  </tr>
  <tr style="border-collapse:collapse; border-spacing:3px; padding: 3px 3px 3px 3px;border-bottom-color:transparent;">
  <td style="border-collapse:collapse; border-spacing:3px; padding: 3px 3px 3px 3px;border-bottom-color:transparent;">&nbsp;&nbsp;K E G I A T A N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="giat" name="giat" style="width: 150px;" />&nbsp;&nbsp;&nbsp;<input id="nm_giat" name="nm_giat" style="width:550px;border: 0;"/></td>
  </tr>
  
  <tr style="border-collapse:collapse; border-spacing:3px; padding: 3px 3px 3px 3px;border-bottom-color:transparent;">    
  <td style="border-collapse:collapse; border-spacing:3px; padding: 3px 3px 3px 3px;border-bottom-color:transparent;">&nbsp;&nbsp;L A N J U T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="hidden" id="jns_giat" name="jns_giat" style="width: 70px;" />
  <select name="ljt" id="ljt" style="height: 27px; width: 190px;">
     <option value="Ya">Ya</option>
     <option value="Tidak">Tidak</option>
   </select><!-- <input type="text" id="ljt" name="ljt" style="width: 70px;" /> --></td>
  </tr>
  
  <tr align='center'>
  <td align="center" style="border-collapse:collapse; border-spacing:3px; padding: 3px 3px 3px 3px;border-bottom-color:transparent;">
  <button class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:input();">TAMBAH</button>
  <button class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:append_jak();">SIMPAN</button>
  <button id="del" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:hapus();">HAPUS</button></td>    	
  </tr>	
  
  <tr>
  <td align="center" style="border-collapse:collapse; border-spacing:3px; padding: 3px 3px 3px 3px;border-bottom-color:black;"></td>
  </tr>	

  </table> 
  <table id="dg" title="Pilih Kegiatan Anggaran" style="width:910%;height:300%" >  
  </table>    	    
 
</div>  	

