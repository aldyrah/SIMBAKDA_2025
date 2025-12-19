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
		url: '<?php echo base_url(); ?>index.php/master/load_wilayah',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'kd_wilayah',
    		title:'Kode Wilayah',
    		width:15,
            align:"center"},
            {field:'nm_wilayah',
    		title:'Nama Wilayah',
    		width:40},
            {field:'kd_provinsi',
    		title:'Kode Provinsi',
    		width:15,align:"center"},
            {field:'nm_provinsi',
            title:'Nama Provinsi',
            width:40},
            
			{field:'hapus',width:10,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus();'' />";}}
        ]],
        onSelect:function(rowIndex,rowData){
          lcidx = rowIndex;
          kdwil = rowData.kd_wilayah;
          nmwil = rowData.nm_wilayah;
          kdprov = rowData.kd_provinsi; 
          nm_provinsi=rowData.nm_provinsi;
          get(kdwil,nmwil,kdprov,nm_provinsi);   
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
          lcidx = rowIndex;
          judul = 'Edit Data Wilayah'; 
          lcstatus = 'edit';
          kdwil = rowData.kd_wilayah;
          nmwil = rowData.nm_wilayah;
          kdprov = rowData.kd_provinsi; 
          nm_provinsi=rowData.nm_provinsi;
          get(kdwil,nmwil,kdprov,nm_provinsi);   
          edit_data();   
        }
        
        });
       
    });        

	   function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data Wilayah';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        document.getElementById("kdwil").disabled=true;
        }  

    function get(kdwil,nmwil,kdprov){
        $("#kdwil").attr("value",kdwil);
        $("#nmwil").attr("value",nmwil);
        $("#kdprov").attr("value",kdprov); 
        $("#nm_provinsi").attr("value",nm_provinsi);                  
    }
    
       
    function kosong(){
        $("#kdwil").attr("value",'');
        $("#nmwil").attr("value",'');
        $("#kdprov").attr("value",''); 
        $("#nm_provinsi").attr("value",''); 
    }
    
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    
    $(function(){
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/master/load_wilayah',
        queryParams:({cari:kriteria})
        });        
     });
    }
    
    function simpan(){
        var ckdwil = document.getElementById('kdwil').value;
        var cnmwil = document.getElementById('nmwil').value;
        var ckdprov = document.getElementById('kdprov').value;
        var nm_provinsi= document.getElementById('nm_provinsi').value;
		
         if (ckdwil==''){
                    alert('Kode Wilayah Tidak Boleh Kosong');
                    exit();
          } 
                
                if (cnmwil==''){
                    alert('Nama Wilayah Tidak Boleh Kosong');
                    exit();
                } 
                
                if (ckdprov==''){
                    alert('Kode Provinsi Tidak Boleh Kosong');
                    exit();
                } 
                if (nm_provinsi==''){
                    alert('Nama Provinsi Tidak Boleh Kosong');
                    exit();
                }
        
                if(lcstatus=='tambah'){
                    
                    lcinsert = "(kd_wilayah,nm_wilayah,kd_provinsi,nm_provinsi)";
                    lcvalues = "('"+ckdwil+"','"+cnmwil+"','"+ckdprov+"','"+nm_provinsi+"')";
                    
                    
                    $(document).ready(function(){
                        $.ajax({
                            type: "POST",
                            url: '<?php echo base_url(); ?>index.php/master/simpan_master',
                            data: ({tabel:'mwilayah',kolom:lcinsert,nilai:lcvalues,cid:'kd_wilayah',lcid:ckdwil}),
                            dataType:"json"
                        });
                    });    
                    
                    
                $('#dg').datagrid('appendRow',{kd_wilayah:ckdwil,nm_wilayah:cnmwil,kd_provinsi:ckdprov,nm_provinsi:nm_provinsi});
                }else {
                    
                    lcquery = "UPDATE mwilayah SET nm_wilayah='"+cnmwil+"',kd_provinsi='"+ckdprov+"',nm_provinsi='"+nm_provinsi+"' where kd_wilayah='"+ckdwil+"'";
                    
        
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
                    		kd_wilayah: ckdwil,
                    		nm_wilayah: cnmwil,
                            kd_provinsi: ckdprov,
                            nm_provinsi : nm_provinsi                
                    	}
                    });
                }
               
                
                alert("Data Berhasil disimpan");
                $("#dialog-modal").dialog('close');
                    
       

    } 
    
     
        
    
     function tambah(){
        lcstatus = 'tambah';
        judul = 'Input Data Wilayah';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
        $("#dialog-modal").dialog('open');
        document.getElementById("kdwil").disabled=false;
        document.getElementById("kdwil").focus();
        } 
     function keluar(){
        $("#dialog-modal").dialog('close');
     }    
    
     function hapus(){
        var ckdwil = document.getElementById('kdwil').value;
		if (ckdwil !=''){
		var del=confirm('Apakah Anda yakin ingin Menhapus data '+ckdwil+'?');
		if (del==true){
        var urll = '<?php echo base_url(); ?>index.php/master/hapus_master';
        $(document).ready(function(){
         $.post(urll,({tabel:'mwilayah',cnid:ckdwil,cid:'kd_wilayah'}),function(data){
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
        });
		} }   
    } 
    
       
  
   </script>



<div id="content1"> 
<h2 align="center"><b>INPUTAN DATA WILAYAH</b></h2>
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
        <table id="dg" align="center" title="LISTING DATA WILAYAH" style="width:900px;height:365px;" >  
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
                <td width="30%">KODE PROVINSI</td>
                <td width="1%">:</td>
                <td><input type="text" id="kdprov" style="width:100px;"/></td>  
            </tr>
            <tr>
                <td width="30%">NAMA PROVINSI</td>
                <td width="1%">:</td>
                <td><input type="text" id="nm_provinsi" style="width:360px;"/></td>  
            </tr>
            <tr>
                <td width="30%">KODE WILAYAH</td>
                <td width="1%">:</td>
                <td><input type="text" id="kdwil" style="width:100px;"/></td>  
            </tr>            
            <tr>
                <td width="30%">NAMA WILAYAH</td>
                <td width="1%">:</td>
                <td><input type="text" id="nmwil" style="width:360px;"/></td>  
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

