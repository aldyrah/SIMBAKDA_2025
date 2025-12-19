
    <script type="text/javascript">
    
    var knip= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
                    
     $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
            height: 240,
            width: 600,
            modal: true,
            autoOpen:false,
        });
        });    


     $(function(){     	 
     $('#oto').combogrid({  
       panelWidth:150,  
       panelHeight:160,  
       idField:'oto',  
       textField:'ket',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/load_oto',  
       columns:[[  
           {field:'oto',title:'KODE ',width:40},  
           {field:'ket',title:'KETERANGAN',width:90}    
       ]] 
     })   
	 });
			



     
     $(function(){
     
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>/index.php/master/load_otorisasi',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"false",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",
			
        columns:[[
    	    {field:'idmenu',
    		title:'ID',
    		width:5,
            align:"left"},
            {field:'judul',
    		title:'MENU',
    		width:15},
            {field:'administrator',
    		title:'ADMINISTRATOR',
			align:'center',
    		width:5,
			editor:{type:'combobox',
					options:{ valueField:'administrator',
							  textField:'administrator',
							  panelwidth:910,	
							  panelheigth:20,	
							  url :'<?php echo base_url(); ?>/index.php/master/yatidak1',
							  required:true									  
							}
					}			
			},
            {field:'operator1',
    		title:'OPERATOR 1',
			align:'center',
    		width:5,
			editor:{type:'combobox',
					options:{ valueField:'operator1',
							  textField:'operator1',
							  panelwidth:910,	
							  panelheigth:20,	
							  url :'<?php echo base_url(); ?>/index.php/master/yatidak2',
							  required:true									  
							}
					}			
			},
            {field:'operator2',
    		title:'OPERATOR 2',
			align:'center',
    		width:5,
			editor:{type:'combobox',
					options:{ valueField:'operator2',
							  textField:'operator2',
							  panelwidth:910,	
							  panelheigth:20,	
							  url :'<?php echo base_url(); ?>/index.php/master/yatidak3',
							  required:true									  
							}
					}			
			}
        ]],
		onAfterEdit:function(rowIndex, rowData, changes){								
				
				id=rowData.idmenu;
				adm=rowData.administrator;
				ope1=rowData.operator1;
				ope2=rowData.operator2;
				simpan(id,adm,ope1,ope2);

		}, 
		onSelect:function(rowIndex,rowData){
          lcidx = rowIndex;
          nm = rowData.nmuser;
          ket = rowData.ket;
		  oto = rowData.oto;	
		  get(nm,ket,oto);   
                                       
        }
        
        });
       
    });        

      
    function get(nm,ket,oto){
        $("#user").attr("value",nm);
        $("#ket").attr("value",ket);
        $("#oto").combogrid("setValue",oto);
    }
    
       
    function kosong(){
        $("#user").attr("value",'');
        $("#ket").attr("value",'');
        $("#pass").attr("value",'');
        $("#oto").combogrid("setValue",'');
    }
    
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    
    $(function(){
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>/index.php/referensi/load_user',
        queryParams:({cari:kriteria})
        });        
     });

	}
    
    function simpan(cid,cadm,cope1,cope2){
				
		$(document).ready(function(){
			$.ajax({
				type: "POST",
				url: '<?php echo base_url(); ?>/index.php/master/simpan_otorisasi',
				data: ({id:cid,adm:cadm,oper1:cope1,oper2:cope2}),
				dataType:"json"
			});
		});                                            
	
		//alert("Data Berhasil disimpan");
		$('#dg').datagrid('reload');        
       

    } 
    
      function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data user';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        document.getElementById("user").disabled=true;
        $("#pass").attr("value",'');

		}    
        
    
     function tambah(){
        lcstatus = 'tambah';
        judul = 'Input Data user';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
        $("#dialog-modal").dialog('open');
        document.getElementById("user").disabled=false;
        document.getElementById("user").focus();
        } 
     function keluar(){
        $("#dialog-modal").dialog('close');
     }    
    
     function hapus(){
        var cuser = document.getElementById('user').value;
               
		var r = confirm("Apakah Anda Yakin Ingin Menghapus User : "+cuser+" ?");
        
		if(r==true){
			$(document).ready(function(){
				$.ajax({
					type: "POST",
					url: '<?php echo base_url(); ?>/index.php/referensi/simpan_user',
					data: ({user:cuser,del:'1'}),
					dataType:"json"
				});
			});                                            
			alert("Data Berhasil Dihapus");
		}
		
		$('#dg').datagrid('reload');        

	} 
    
       
  
   </script>



<div id="content1"> 

    <div align="center">
    <table style="width:400px;" border="0">
        <tr>
			<td><h3 align="center"><b> OTORITAS MENU</b></h3></td>
        </tr>
        <tr>
			<td >
			<table id="dg" align="center" title="LISTING DATA USER" style="width:900px;height:320px;" >  
			</table>
			</td>
        </tr>
    </table>    
        
 
    </p> 
    </div>   
</div>

<div id="dialog-modal" title="" style="width:100%;height:100px" >
    <fieldset>
     <table align="center" style="width:100%;"  border="0">
            <tr>
                <td width="20%">USER</td>
                <td width="1%">:</td>
                <td><input type="text" id="user" style="width:100px;" size="20" maxlength="18"/></td>  
            </tr>            
            <tr>
                <td width="20%">PASSWORD</td>
                <td width="1%">:</td>
                <td><input type="text" id="pass" style="width:100px;"/></td>  
            </tr>
            <tr>
                <td width="20%">OTORISASI</td>
                <td width="1%">:</td>
                <td><input type="text" id="oto" style="width:103px;"/></td>  
            </tr>
            <tr>
                <td width="20%">KETERANGAN</td>
                <td width="1%">:</td>
                <td><input type="text" id="ket" style="width:360px;"/></td>  
            </tr>
            <tr>
            <td colspan="3">&nbsp;</td>
            </tr>            
            <tr>
                <td colspan="3" align="center"><a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:simpan();">Simpan</a>
		        <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Kembali</a>
                </td>                
            </tr>
        </table>  
            
    </fieldset> 
</div>

