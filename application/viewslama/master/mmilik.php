
    <script type="text/javascript">
    
    var kdwil= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
                    
     $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
            height: 300,
            width: 800,
            modal: true,
            autoOpen:false,
        });
        });    
     
     $(function(){
     
            
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/master/load_milik',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'kd_milik',
    		title:'ID PEMILIK',
    		width:15,
            align:"center"},
            {field:'nm_milik',
    		title:'NAMA PEMILIK',
    		width:40,
            align:"left"},
			{field:'hapus',width:5,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus();'' />";}}
        ]],
        onSelect:function(rowIndex,rowData){
          lcidx = rowIndex;
          kdmilik = rowData.kd_milik;
          nmmilik = rowData.nm_milik;
          get(kdmilik,nmmilik);   
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
          lcidx = rowIndex;
          judul = 'Edit Data Pemilik'; 
          lcstatus = 'edit';
          kdmilik = rowData.kd_milik;
          nmmilik = rowData.nm_milik;
          get(kdmilik,nmmilik); 
          edit_data();   
        }
        
        });
       
    });        

      
    function get(kdmilik,nmmilik){
        $("#kdmilik").attr("value",kdmilik);
        $("#nmmilik").attr("value",nmmilik);                  
    }
    
       
    function kosong(){
        $("#kdmilik").attr("value",'');
        $("#nmmilik").attr("value",''); 
    }
    
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    
    $(function(){
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/master/load_milik',
        queryParams:({cari:kriteria})
        });        
     });
    }
    
    function simpan(){
        var ckdmilik = document.getElementById('kdmilik').value;
        var cnmmilik = document.getElementById('nmmilik').value;

        if (ckdmilik==''){
            alert('ID Pemilik Tidak Boleh Kosong');
            exit();
        } 
                
        if (cnmmilik==''){
            alert('Nama Pemilik Tidak Boleh Kosong');
            exit();
        } 
           
        if(lcstatus=='tambah'){
            
            lcinsert = "(kd_milik,nm_milik)";
            lcvalues = "('"+ckdmilik+"','"+cnmmilik+"')";
            
            
            $(document).ready(function(){
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>index.php/master/simpan_master',
                    data: ({tabel:'mmilik',kolom:lcinsert,nilai:lcvalues,cid:'kd_milik',lcid:ckdmilik}),
                    dataType:"json"
                });
            });    
            
        $('#dg').datagrid('appendRow',{kd_milik:ckdmilik,nm_milik:cnmmilik});
        }else {
            
            lcquery = "UPDATE mmilik SET nm_milik='"+cnmmilik+"' where kd_milik='"+ckdmilik+"'";            

            $(document).ready(function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>index.php/master/update_master',
                data: ({st_query:lcquery}),
                dataType:"json"
            });
            });
            
            
            
                $('#dg').datagrid('updateRow',{
            	index: lcidx,
            	row: {
            		kd_milik: ckdmilik,
            		nm_milik: cnmmilik                
            	}
            });
        }
       
        
        alert("Data Berhasil disimpan");
        $("#dialog-modal").dialog('close');
                    
       

    } 
    
      function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data Pemilik';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        document.getElementById("kdmilik").disabled=true;
        }    
        
    
     function tambah(){
        lcstatus = 'tambah';
        judul = 'Input Data Wilayah';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
        $("#dialog-modal").dialog('open');
        document.getElementById("kdmilik").disabled=false;
        document.getElementById("kdmilik").focus();
        } 
     function keluar(){
        $("#dialog-modal").dialog('close');
     }    
    
     function hapus(){
        var ckdmilik = document.getElementById('kdmilik').value;
		if (ckdmilik !=''){
		var del=confirm('Apakah Anda yakin ingin Menhapus data '+ckdmilik+'?');
		if (del==true){
        var urll = '<?php echo base_url(); ?>index.php/master/hapus_master';
        $(document).ready(function(){
         $.post(urll,({tabel:'mmilik',cnid:ckdmilik,cid:'kd_milik'}),function(data){
            status = data;
            if (status=='0'){
                alert('Gagal Hapus..!!');
                exit();
            } else {
                $('#dg').datagrid('deleteRow',lcidx);   
                alert('Data Berhasil Dihapus..!!');
                exit();
            }
         });
        });    }}
    } 
    
       
  
   </script>



<div id="content1"> 
<h2 align="center"><b>INPUTAN DATA PEMILIK</b></h2>
    <div align="center">
    <p>     
    <table style="width:400px;" border="0">
        <tr>
        <td width="10%">
        <a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:tambah()">Tambah</a></td>               
        <td width="5%"><a class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="javascript:cari();">Cari</a></td>
        <td><input type="text" value="" id="txtcari" style="width:300px;"/></td>
        </tr>
        <tr>
        <td colspan="4">
        <table id="dg" align="center" title="LISTING DATA PEMILIK" style="width:900px;height:365px;" >  
        </table>
        </td>
        </tr>
    </table>    
        
 
    </p> 
    </div>   
</div>

<div id="dialog-modal" title="">
    <p class="validateTips">Semua Inputan Harus Di Isi.</p> 
    <fieldset>
     <table align="center" style="width:100%;" border="0">
            <tr>
                <td width="30%">ID MILIK</td>
                <td width="1%">:</td>
                <td><input type="text" id="kdmilik" style="width:100px;"/></td>  
            </tr>
            <tr>
                <td width="30%">NAMA PEMILIK</td>
                <td width="1%">:</td>
                <td><input type="text" id="nmmilik" style="width:500px;"/></td>  
            </tr>
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

