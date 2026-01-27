
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
       idField:'kd_kelompok',  
       textField:'kd_kelompok',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_kel1',  
       columns:[[  
           {field:'kd_kelompok',title:'KELOMPOK',width:120},  
           {field:'nm_kelompok',title:'NAMA KELOMPOK',width:400}    
       ]],  
       onSelect:function(rowIndex,rowData){
           $("#nmkel").attr("value",rowData.nm_kelompok.toUpperCase());
           if(lcstatus=='tambah'){ 
           $("#kdbrg").attr("value",rowData.kd_kelompok+'.'+rowData.nakhir);
           document.getElementById("kdbrg").focus();
           }                 
       }  
     });   
     
     $('#rek').combogrid({  
       panelWidth:500,  
       idField:'kd_rek5',  
       textField:'kd_rek5',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_rek5',  
       columns:[[  
           {field:'kd_rek5',title:'KODE REKENING',width:100},  
           {field:'nm_rek5',title:'NAMA REKENING',width:400}    
       ]],  
       onSelect:function(rowIndex,rowData){
           $("#nmrek").attr("value",rowData.nm_rek5.toUpperCase());  
       }  
     });  
        
        
            
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/master/load_barang',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'kd_brg',
    		title:'Kode Barang',
    		width:20,
            align:"center"},
            {field:'nm_brg',
    		title:'Nama Barang',
    		width:40},
            {field:'kd_rek5',
    		title:'Kode Rekening',
    		width:15,
            align:"center"},
            {field:'nmkel',
    		title:'Kelompok',
    		width:40,
            align:"left"},
			{field:'hapus',width:5,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus();'' />";}}
        ]],
        onSelect:function(rowIndex,rowData){
          lcidx = rowIndex;
          kdbrg = rowData.kd_brg;
          nmbrg = rowData.nm_brg;
          kdkel = rowData.kd_kelompok;
          kdrek = rowData.kd_rek5; 
          get(kdbrg,nmbrg,kdkel,kdrek);   
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
          lcidx = rowIndex;
          judul = 'Edit Data Barang'; 
          lcstatus = 'edit';
          kdbrg = rowData.kd_brg;
          nmbrg = rowData.nm_brg;
          kdkel   = rowData.kd_kelompok
          kdrek = rowData.kd_rek5; 
          get(kdbrg,nmbrg,kdkel,kdrek);   
          edit_data();   
        }
        
        });
       
    });        

      
    function get(kdbrg,nmbrg,kdkel,kdrek) {
        $("#kdbrg").attr("value",kdbrg);
        $("#nmbrg").attr("value",nmbrg);
        $("#kel").combogrid("setValue",kdkel);
        $("#rek").combogrid("setValue",kdrek);                   
    }
    
       
    function kosong(){
        $("#kdbrg").attr("value",'');
        $("#nmbrg").attr("value",'');
        $("#kel").combogrid("setValue",'');
        $("#nmkel").attr("value",'');
        $("#rek").combogrid("setValue",'');
        $("#nmrek").attr("value",'');
    }
    
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    
    $(function(){
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/master/load_barang',
        queryParams:({cari:kriteria})
        });        
     });
    }
    
    function simpan(){
    
    var ckdbrg = document.getElementById('kdbrg').value;
    var cnmbrg = document.getElementById('nmbrg').value;
    var ckel = $('#kel').combogrid('getValue');
    var crek = $('#rek').combogrid('getValue');
    var cnmkel = ckel+'-'+document.getElementById('nmkel').value;
        
    if (ckdbrg==''){
        alert('Kode Barang Tidak Boleh Kosong');
        return; // Menggunakan return untuk menghentikan eksekusi fungsi
    } 
    
    if (cnmbrg==''){
        alert('Nama Barang Tidak Boleh Kosong');
        return; // Menggunakan return untuk menghentikan eksekusi fungsi
    } 

    if(lcstatus=='tambah'){
        
        lcinsert = "(kd_brg,kd_rek5,nm_brg,kd_kelompok)";
        lcvalues = "('"+ckdbrg+"','"+crek+"','"+cnmbrg+"','"+ckel+"')";
        
        $(document).ready(function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>index.php/master/simpan_master',
                data: ({tabel:'mbarang',kolom:lcinsert,nilai:lcvalues,cid:'kd_brg',lcid:ckdbrg}),
                dataType:"json",
                success: function() {
                    $('#dg').datagrid('appendRow',{kd_brg:ckdbrg,nm_brg:cnmbrg,kd_rek5:crek,nmkel:cnmkel});
                    alert("Data Berhasil disimpan");
                    $("#dialog-modal").dialog('close');
                    location.reload(); // Menyegarkan halaman setelah berhasil disimpan
                }
            });
        });    
        
    } else {
        
        lcquery = "UPDATE mbarang SET nm_brg='"+cnmbrg+"',kd_kelompok='"+ckel+"',kd_rek5='"+crek+"' where kd_brg='"+ckdbrg+"'";
        
        $(document).ready(function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>index.php/master/update_master',
                data: ({st_query:lcquery}),
                dataType:"json",
                success: function() {
                    $('#dg').datagrid('updateRow',{
                        index: lcidx,
                        row: {
                            kd_brg: ckdbrg,
                            nm_brg: cnmbrg,
                            kd_rek5: crek,
                            nmkel: cnmkel                    
                        }
                    });
                    alert("Data Berhasil disimpan");
                    $("#dialog-modal").dialog('close');
                    location.reload(); // Menyegarkan halaman setelah berhasil disimpan
                }
            });
        });
    }
}


      function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data Barang';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        document.getElementById("kdsubkel").disabled=true;
        }    
        
    
     function tambah(){
        lcstatus = 'tambah';
        judul = 'Input Data Barang';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
        $("#dialog-modal").dialog('open');
        document.getElementById("kdbrg").disabled=false;
        document.getElementById("kdkel").focus();
        } 
     function keluar(){
        $("#dialog-modal").dialog('close');
     }    
    
     function hapus(){
        var ckdbrg = document.getElementById('kdbrg').value;
               if (ckdbrg !=''){
		var del=confirm('Apakah Anda yakin ingin Menhapus data '+ckdbrg+'?');
		if (del==true){          
        var urll = '<?php echo base_url(); ?>index.php/master/hapus_master';
        $(document).ready(function(){
         $.post(urll,({tabel:'mbarang',cnid:ckdbrg,cid:'kd_brg'}),function(data){ 
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
<h3 align="center"><u><b><a>INPUTAN DATA BARANG</a></b></u></h3>
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
        <table id="dg" align="center" title="LISTING DATA BARANG" style="width:900px;height:365px;" >  
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
                <td>KELOMPOK BARANG</td>
                <td>:</td>
                <td><input id="kel" name="kel" style="width: 200px;" /> </td>
            </tr>

                <tr>
                                    <td></td>
                <td></td>

                    <td><input type="text" id="nmkel" style="width: 500px;" readonly="true"/></td>
           </tr>
           <tr>
                <td width="30%">KODE BARANG</td>
                <td width="1%">:</td>
                <td><input type="text" id="kdbrg" readonly style="width:200px;"/></td>  
            </tr>            
            <tr>
                <td width="30%">NAMA BARANG</td>
                <td width="1%">:</td>
                <td><input type="text" id="nmbrg" style="width:360px;"/></td>  
            </tr>
            <tr>
                <td>KODE REKENING</td>
                <td>:</td>
                <td><input id="rek" name="rek" style="width: 100px;" /> <input type="text" id="nmrek" style="border:0;width: 400px;" readonly="true"/></td>
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

