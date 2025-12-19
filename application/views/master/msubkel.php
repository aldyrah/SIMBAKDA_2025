  
    <script type="text/javascript">
    
    var kdkel= '';
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
     
     $('#kel').combogrid({  
       panelWidth:500,  
       idField:'kelompok',  
       textField:'kelompok',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_kel',  
       columns:[[  
           {field:'kelompok',title:'KELOMPOK',width:100},  
           {field:'nm_kelompok',title:'NAMA KELOMPOK',width:400}    
       ]],  
       onSelect:function(rowIndex,rowData){
           $("#nmkel").attr("value",rowData.nm_kelompok.toUpperCase());
           if(lcstatus=='tambah'){ 
           $("#kdsubkel").attr("value",rowData.kelompok);
           }                 
       }  
     });   
        
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/master/load_subkelompok',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'kd_kelompok',
    		title:'Kode Sub Kelompok',
    		width:15,
            align:"center"},
            {field:'nm_kelompok',
    		title:'Nama Kelompok',
    		width:40},
            {field:'nmkel',
    		title:'Kelompok',
    		width:40,
            align:"left"},
			{field:'hapus',width:5,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus();'' />";}}
        ]],
        onSelect:function(rowIndex,rowData){
          lcidx = rowIndex;
          kdsubkel = rowData.kd_kelompok;
          nmsubkel = rowData.nm_kelompok;
          kdkel   = rowData.kelompok
          get(kdsubkel,nmsubkel,kdkel);   
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
          lcidx = rowIndex;
          judul = 'Edit Data Sub Kelompok'; 
          lcstatus = 'edit';
          kdsubkel = rowData.kd_kelompok;
          nmsubkel = rowData.nm_kelompok;
          kdkel   = rowData.kelompok
          get(kdsubkel,nmsubkel,kdkel);
          edit_data();   
        }
        
        });
       
    });        

      
    function get(kdsubkel,nmsubkel,kdkel) {
        $("#kdsubkel").attr("value",kdsubkel);
        $("#nmsubkel").attr("value",nmsubkel);
        $("#kel").combogrid("setValue",kdkel);
                   
    }
    
       
    function kosong(){
        $("#kdsubkel").attr("value",'');
        $("#nmkel").attr("value",'');
        $("#nmsubkel").attr("value",'');
        $("#kel").combogrid("setValue",'');
    }
    
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    
    $(function(){
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/master/load_subkelompok',
        queryParams:({cari:kriteria})
        });        
     });
    }
    
    function simpan(){
        
        var ckdsubkel = document.getElementById('kdsubkel').value;
        var cnmsubkel = document.getElementById('nmsubkel').value;
        var ckel = $('#kel').combogrid('getValue');
        var cnmkel = document.getElementById('nmkel').value;
                
        if (ckdsubkel==''){
            alert('Kode Sub Kelompok Tidak Boleh Kosong');
            exit();
        } 
        
        if (cnmsubkel==''){
            alert('Nama Sub Kelompok Tidak Boleh Kosong');
            exit();
        } 
        
        if (ckel==''){
            alert('Kelompok Tidak Boleh Kosong');
            exit();
        } 

        if(lcstatus=='tambah'){
            
            lcinsert = "(kd_kelompok,nm_kelompok,kelompok)";
            lcvalues = "('"+ckdsubkel+"','"+cnmsubkel+"','"+ckel+"')";
            
            
            $(document).ready(function(){
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>index.php/master/simpan_master',
                    data: ({tabel:'mkelompok1',kolom:lcinsert,nilai:lcvalues,cid:'kd_kelompok',lcid:ckdsubkel}),
                    dataType:"json"
                });
            });    
            
            
        $('#dg').datagrid('appendRow',{kd_kelompok:ckdsubkel,nm_kelompok:cnmsubkel,nmkel:cnmkel,kelompok:ckel});
        }else {
            
            lcquery = "UPDATE mkelompok1 SET nm_kelompok='"+cnmsubkel+"',kelompok='"+ckel+"' where kd_kelompok='"+ckdsubkel+"'";
            
            //alert(lcquery);
            $(document).ready(function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>/index.php/master/update_master',
                data: ({st_query:lcquery}),
                dataType:"json"
            });
            });
            
            
            
                $('#dg').datagrid('updateRow',{
            	index: lcidx,
            	row: {
            		kd_kelompok: ckdsubkel,
            		nm_kelompok: cnmsubkel,
                    nmkel: cnmkel,
                    kel: ckel                    
            	}
            });
        }
       
        
        alert("Data Berhasil disimpan");
        $("#dialog-modal").dialog('close');
        //section1();
    } 
    
      function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data Kelompok';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        document.getElementById("kdsubkel").disabled=true;
        }    
        
    
     function tambah(){
        lcstatus = 'tambah';
        judul = 'Input Data Sub Kelompok';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
        $("#dialog-modal").dialog('open');
        document.getElementById("kdsubkel").disabled=false;
        document.getElementById("kdkel").focus();
        } 
     function keluar(){
        $("#dialog-modal").dialog('close');
     }    
    
     function hapus(){
        var ckdsubkel = document.getElementById('kdsubkel').value;
        if (ckdsubkel !=''){
		var del=confirm('Apakah Anda yakin ingin Menhapus data '+ckdsubkel+'?');
		if (del==true){       
        var urll = '<?php echo base_url(); ?>index.php/master/hapus_master';
        $(document).ready(function(){
         $.post(urll,({tabel:'mkelompok1',cnid:ckdsubkel,cid:'kd_kelompok'}),function(data){
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
        });}}    
    } 
    
    
  
   </script>



<div id="content1"> 
<h3 align="center"><u><b><a>INPUTAN SUB KELOMPOK</a></b></u></h3>
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
        <table id="dg" align="center" title="LISTING DATA SUB KELOMPOK" style="width:900px;height:365px;" >  
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
                <td>KELOMPOK</td>
                <td>:</td>
                <td><input id="kel" name="kel" style="width: 75px;" /> <input type="text" id="nmkel" style="border:0;width: 430px;" readonly="true"/></td>
            </tr>
           <tr>
                <td width="30%">KODE SUB KELOMPOK</td>
                <td width="1%">:</td>
                <td><input type="text" id="kdsubkel" style="width:100px;"/></td>  
            </tr>            
            <tr>
                <td width="30%">NAMA SUB KELOMPOK</td>
                <td width="1%">:</td>
                <td><input type="text" id="nmsubkel" style="width:360px;"/></td>  
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

