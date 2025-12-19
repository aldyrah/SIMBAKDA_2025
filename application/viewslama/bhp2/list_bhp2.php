    <script type="text/javascript">
    
    var kdwil= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
                    
     $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
            height: 500,
            width: 850,
            modal: true,
            autoOpen:false,
        });
        });    
     
   $(function(){
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/bhp/load_mbarang_hbs',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'kode',title:'Kode Barang',width:15,align:"left"},
            {field:'nama',title:'Nama Barang',width:30},
            {field:'header',title:'Header',width:10,align:"left"},
            {field:'satuan',title:'Satuan',width:10,align:"center"},
			{field:'hapus',width:5,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus();'' />";}}
        ]],
        onSelect:function(rowIndex,rowData){
          lcidx  = rowIndex;
          kode   = rowData.kode;
          nama   = rowData.nama;
          tipe   = rowData.tipe;
          header = rowData.header;
          jenis  = rowData.jenis;  
          satuan = rowData.satuan;
          spek   = rowData.spek; 
          get(kode,nama,tipe,header,jenis,satuan,spek);   
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
          lcidx = rowIndex;
          judul = 'Edit Data Barang'; 
          lcstatus = 'edit';
          kode   = rowData.kode;
          nama   = rowData.nama;
          tipe   = rowData.tipe;
          header = rowData.header;
          jenis  = rowData.jenis;  
          satuan = rowData.satuan;
          spek   = rowData.spek;  
		  if(jenis=="1"){
		  alert("page 1");
		  }if(jenis=="2"){
		  alert("page 2");
		  }if(jenis=="3"){
		  alert("page 3");
		  }if(jenis=="4"){
		  alert("page 5");
		  }if(jenis=="5"){
		  alert("page 6");
		  }
          get(kode,nama,tipe,header,jenis,satuan,spek);
          edit_data(jenis);   
        }
        
        });
           

	function edit_data(jenis){
        var jenis = jenis; 
		alert("haii faiz"+jenis);
        lcstatus = 'edit';
        judul = 'Edit Data Wilayah';
        $("#dialog-modal").dialog({ title: judul, id:jenis });
        $("#dialog-modal").dialog('open');
        document.getElementById("kdwil").disabled=true;
        }  

	$('#gol').combogrid({  
            panelWidth:300, 
            width:100, 
            idField:'kode',  
            textField:'kode',              
            mode:'remote',
            url:'<?php echo base_url(); ?>index.php/bhp/ambil_golongan',
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kode',title:'Kode Kegiatan',width:100},  
               {field:'nama',title:'Nama Kegiatan',width:200}    
            ]],  
            onSelect:function(rowIndex,rowData){                                                             
                kode = rowData.kode;
				nama 	= rowData.nama;
				$('#namagol').attr('value',nama);
            } 
        }); 
	   
	$('#bag').combogrid({  
            panelWidth:300, 
            width:100, 
            idField:'kode',  
            textField:'kode',              
            mode:'remote',
            url:'<?php echo base_url(); ?>index.php/bhp/ambil_bidang',
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kode',title:'Kode Kegiatan',width:100},  
               {field:'nama',title:'Nama Kegiatan',width:200}    
            ]],  
            onSelect:function(rowIndex,rowData){                                                             
                kode = rowData.kode;
				nama 	= rowData.nama;
				$('#namabag').attr('value',nama);
            } 
        }); 
	 
	$('#kel').combogrid({  
            panelWidth:300, 
            width:100, 
            idField:'kode',  
            textField:'kode',              
            mode:'remote',
            url:'<?php echo base_url(); ?>index.php/bhp/ambil_kelompok',
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kode',title:'Kode Kegiatan',width:100},  
               {field:'nama',title:'Nama Kegiatan',width:200}    
            ]],  
            onSelect:function(rowIndex,rowData){                                                             
                kode = rowData.kode;
				nama 	= rowData.nama;
				$('#namakel').attr('value',nama);
            } 
        }); 
	   
	  $('#subkel').combogrid({  
            panelWidth:300, 
            width:100, 
            idField:'kode',  
            textField:'kode',              
            mode:'remote',
            url:'<?php echo base_url(); ?>index.php/bhp/ambil_subkel',
            loadMsg:"Tunggu Sebentar....!!",                                                 
            columns:[[  
               {field:'kode',title:'Kode Kegiatan',width:100},  
               {field:'nama',title:'Nama Kegiatan',width:200}    
            ]],  
            onSelect:function(rowIndex,rowData){                                                             
                kode = rowData.kode;
				nama 	= rowData.nama;
				$('#namasubkel').attr('value',nama);
            } 
        }); 
		
    });    
    function get(kode,nama,tipe,header,jenis,satuan,spek){
        $("#gol").combogrid("setValue",kode);
        $("#bag").combogrid("setValue",kode);
        $("#kel").combogrid("setValue",kode);
        $("#subkel").combogrid("setValue",kode);
        $("#nama").attr("value",nama); 
        $("#header").attr("value",header);  
        $("#satuan").attr("value",satuan);                    
    }
    
       
    function kosong(){
        $("#gol").combogrid("setValue",'');
        $("#bag").combogrid("setValue",'');
        $("#kel").combogrid("setValue",'');
        $("#subkel").combogrid("setValue",'');
        $("#nama").attr("value",''); 
        $("#header").attr("value",'');  
        $("#satuan").attr("value",'');  
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
    
function simpan_gol(){
        var kd_gol = document.getElementById('kd_gol').value;
        var nm_gol = document.getElementById('nm_gol').value;
        var tipe   = "H";
		alert(tipe);
        var header = '';
        var jenis  = 1;
        var satuan = '';
        var spek   = '';
				if (kd_gol==''){
                    alert('Kode Barang Tidak Boleh Kosong');
                    exit();
                } 
                if (nm_gol==''){
                    alert('Nama Barang Tidak Boleh Kosong');
                    exit();
                } 
                if(lcstatus=='tambah'){
                    lcinsert = "(kode,nama,tipe,header,jenis,satuan,spek)";
                    lcvalues = "('"+kd_gol+"','"+nm_gol+"','"+tipe+"','"+header+"','"+jenis+"','"+satuan+"','"+spek+"')";
                    $(document).ready(function(){
                        $.ajax({
                            type: "POST",
                            url: '<?php echo base_url(); ?>index.php/bhp/simpan_barang',
                            data: ({tabel:'mbarang_hbs',kolom:lcinsert,nilai:lcvalues,cid:'kode',lcid:kd_gol}),
                            dataType:"json"
                        });
                    });    
                $('#dg').datagrid('appendRow',{kode:kd_gol,nama:nm_gol,tipe:tipe,header:header,jenis:jenis,satuan:satuan,spek:spek});
                }else {
                    lcquery = "UPDATE mbarang_hbs SET nama='"+nm_gol+"',tipe='"+tipe+"',header='"+header+"',jenis='"+jenis+"',satuan='"+satuan+"',spek='"+spek+"' where kode='"+kd_gol+"'";
                    
                    $(document).ready(function(){
                    $.ajax({
                        type: "POST",
                        url: '<?php echo base_url(); ?>index.php/bhp/update_barang',
                        data: ({st_query:lcquery}),
                        dataType:"json"
                    });
                    });
                        $('#dg').datagrid('updateRow',{
                    	index: lcidx,
                    	row: {
                    		kode:kd_gol,nama:nm_gol,tipe:tipe,header:header,jenis:jenis,satuan:satuan,spek:spek               
                    	}
                    });
                }
                alert("Data Berhasil disimpan");
    } 
	
 function simpan_bid(){
        var kd_bid = document.getElementById('kd_bid').value;
        var nm_bid = document.getElementById('nm_bid').value;
        var tipe   = "H";
        var header = $('#gol').combogrid('getValue');
		//alert(header);
        var jenis  = 2;
        var satuan = '';
        var spek   = '';
		var kd_bidx = ""+header+""+kd_bid+"";
				if (kd_bid==''){
                    alert('Kode Barang Tidak Boleh Kosong');
                    exit();
                } 
                if (nm_bid==''){
                    alert('Nama Barang Tidak Boleh Kosong');
                    exit();
                } 
                if(lcstatus=='tambah'){
                    lcinsert = "(kode,nama,tipe,header,jenis,satuan,spek)";
                    lcvalues = "('"+kd_bidx+"','"+nm_bid+"','"+tipe+"','"+header+"','"+jenis+"','"+satuan+"','"+spek+"')";
                    $(document).ready(function(){
                        $.ajax({
                            type: "POST",
                            url: '<?php echo base_url(); ?>index.php/bhp/simpan_barang',
                            data: ({tabel:'mbarang_hbs',kolom:lcinsert,nilai:lcvalues,cid:'kode',lcid:kd_bidx}),
                            dataType:"json"
                        });
                    });    
                $('#dg').datagrid('appendRow',{kode:kd_bidx,nama:nm_bid,tipe:tipe,header:header,jenis:jenis,satuan:satuan,spek:spek});
                }else {
                    lcquery = "UPDATE mbarang_hbs SET nama='"+nm_bid+"',tipe='"+tipe+"',header='"+header+"',jenis='"+jenis+"',satuan='"+satuan+"',spek='"+spek+"' where kode='"+kd_bidx+"'";
                    
                    $(document).ready(function(){
                    $.ajax({
                        type: "POST",
                        url: '<?php echo base_url(); ?>index.php/bhp/update_barang',
                        data: ({st_query:lcquery}),
                        dataType:"json"
                    });
                    });
                        $('#dg').datagrid('updateRow',{
                    	index: lcidx,
                    	row: {
                    		kode:kd_bidx,nama:nm_bid,tipe:tipe,header:header,jenis:jenis,satuan:satuan,spek:spek               
                    	}
                    });
                }
                alert("Data Berhasil disimpan");
                //$("#dialog-modal").dialog('close');
    }    
 
 function simpan_kel(){
		alert(header);
        var kd_kel = document.getElementById('kd_kel').value;
        var nm_kel = document.getElementById('nm_kel').value;
        var tipe   = "H";
        var header = $('#bag').combogrid('getValue');
        var jenis  = 3;
        var satuan = '';
        var spek   = '';
		var kd_kelx = ""+header+""+kd_kel+"";
				if (kd_kel==''){
                    alert('Kode Barang Tidak Boleh Kosong');
                    exit();
                } 
                if (nm_kel==''){
                    alert('Nama Barang Tidak Boleh Kosong');
                    exit();
                } 
                if(lcstatus=='tambah'){
                    lcinsert = "(kode,nama,tipe,header,jenis,satuan,spek)";
                    lcvalues = "('"+kd_kelx+"','"+nm_kel+"','"+tipe+"','"+header+"','"+jenis+"','"+satuan+"','"+spek+"')";
                    $(document).ready(function(){
                        $.ajax({
                            type: "POST",
                            url: '<?php echo base_url(); ?>index.php/bhp/simpan_barang',
                            data: ({tabel:'mbarang_hbs',kolom:lcinsert,nilai:lcvalues,cid:'kode',lcid:kd_kelx}),
                            dataType:"json"
                        });
                    });    
                $('#dg').datagrid('appendRow',{kode:kd_kelx,nama:nm_kel,tipe:tipe,header:header,jenis:jenis,satuan:satuan,spek:spek});
                }else {
                    lcquery = "UPDATE mbarang_hbs SET nama='"+nm_kel+"',tipe='"+tipe+"',header='"+header+"',jenis='"+jenis+"',satuan='"+satuan+"',spek='"+spek+"' where kode='"+kd_kelx+"'";
                    
                    $(document).ready(function(){
                    $.ajax({
                        type: "POST",
                        url: '<?php echo base_url(); ?>index.php/bhp/update_barang',
                        data: ({st_query:lcquery}),
                        dataType:"json"
                    });
                    });
                        $('#dg').datagrid('updateRow',{
                    	index: lcidx,
                    	row: {
                    		kode:kd_kelx,nama:nm_kel,tipe:tipe,header:header,jenis:jenis,satuan:satuan,spek:spek               
                    	}
                    });
                }
                alert("Data Berhasil disimpan");
                //$("#dialog-modal").dialog('close');
    } 
    
 function simpan_subkel(){
		//alert(header);
        var kd_subkel = document.getElementById('kd_subkel').value;
        var nm_subkel = document.getElementById('nm_subkel').value;
        var tipe   = "H";
        var header = $('#kel').combogrid('getValue');
        var jenis  = 4;
		alert(jenis);
        var satuan = '';
        var spek   = '';
		var kd_subkelx = ""+header+""+kd_subkel+"";
				if (kd_subkel==''){
                    alert('Kode Barang Tidak Boleh Kosong');
                    exit();
                } 
                if (nm_subkel==''){
                    alert('Nama Barang Tidak Boleh Kosong');
                    exit();
                } 
                if(lcstatus=='tambah'){
                    lcinsert = "(kode,nama,tipe,header,jenis,satuan,spek)";
                    lcvalues = "('"+kd_subkelx+"','"+nm_subkel+"','"+tipe+"','"+header+"','"+jenis+"','"+satuan+"','"+spek+"')";
                    $(document).ready(function(){
                        $.ajax({
                            type: "POST",
                            url: '<?php echo base_url(); ?>index.php/bhp/simpan_barang',
                            data: ({tabel:'mbarang_hbs',kolom:lcinsert,nilai:lcvalues,cid:'kode',lcid:kd_subkelx}),
                            dataType:"json"
                        });
                    });    
                $('#dg').datagrid('appendRow',{kode:kd_subkelx,nama:nm_subkel,tipe:tipe,header:header,jenis:jenis,satuan:satuan,spek:spek});
                }else {
                    lcquery = "UPDATE mbarang_hbs SET nama='"+nm_subkel+"',tipe='"+tipe+"',header='"+header+"',jenis='"+jenis+"',satuan='"+satuan+"',spek='"+spek+"' where kode='"+kd_subkelx+"'";
                    
                    $(document).ready(function(){
                    $.ajax({
                        type: "POST",
                        url: '<?php echo base_url(); ?>index.php/bhp/update_barang',
                        data: ({st_query:lcquery}),
                        dataType:"json"
                    });
                    });
                        $('#dg').datagrid('updateRow',{
                    	index: lcidx,
                    	row: {
                    		kode:kd_kelx,nama:nm_subkel,tipe:tipe,header:header,jenis:jenis,satuan:satuan,spek:spek               
                    	}
                    });
                }
                alert("Data Berhasil disimpan");
    }   

function simpan_subsubkel(){
        var kd_subsubkel = document.getElementById('kd_subsubkel').value;
        var nm_subsubkel = document.getElementById('nm_subsubkel').value;
        var tipe   = "S";
        var header = $('#subkel').combogrid('getValue');
        var jenis  = 5;
        var satuan = document.getElementById('satuan').value;
        var spek   = document.getElementById('spesifikasi').value;
		alert(satuan);
		var kd_subsubkelx = ""+header+""+kd_subsubkel+"";
				if (kd_subsubkel==''){
                    alert('Kode Barang Tidak Boleh Kosong');
                    exit();
                } 
                if (nm_subsubkel==''){
                    alert('Nama Barang Tidak Boleh Kosong');
                    exit();
                } 
                if(lcstatus=='tambah'){
                    lcinsert = "(kode,nama,tipe,header,jenis,satuan,spek)";
                    lcvalues = "('"+kd_subsubkelx+"','"+nm_subsubkel+"','"+tipe+"','"+header+"','"+jenis+"','"+satuan+"','"+spek+"')";
                    $(document).ready(function(){
                        $.ajax({
                            type: "POST",
                            url: '<?php echo base_url(); ?>index.php/bhp/simpan_barang',
                            data: ({tabel:'mbarang_hbs',kolom:lcinsert,nilai:lcvalues,cid:'kode',lcid:kd_subsubkelx}),
                            dataType:"json"
                        });
                    });    
                $('#dg').datagrid('appendRow',{kode:kd_subsubkelx,nama:nm_subsubkel,tipe:tipe,header:header,jenis:jenis,satuan:satuan,spek:spek});
                }else {
                    lcquery = "UPDATE mbarang_hbs SET nama='"+nm_subsubkel+"',tipe='"+tipe+"',header='"+header+"',jenis='"+jenis+"',satuan='"+satuan+"',spek='"+spek+"' where kode='"+kd_subsubkelx+"'";
                    
                    $(document).ready(function(){
                    $.ajax({
                        type: "POST",
                        url: '<?php echo base_url(); ?>index.php/bhp/update_barang',
                        data: ({st_query:lcquery}),
                        dataType:"json"
                    });
                    });
                        $('#dg').datagrid('updateRow',{
                    	index: lcidx,
                    	row: {
                    		kode:kd_subsubkelx,nama:nm_subsubkel,tipe:tipe,header:header,jenis:jenis,satuan:satuan,spek:spek               
                    	}
                    });
                }
                alert("Data Berhasil disimpan");
    }    	
    
     function tambah(){
        lcstatus = 'tambah';
        judul = 'Input Data Barang';
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
        var ckdwil 	= document.getElementById('kdwil').value;
        var urll 	= '<?php echo base_url(); ?>index.php/master/hapus_master';
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
    } 
    
   </script>


<div id="content1"> 
	<h2 align="center"><b>LISTING BARANG HABIS PAKAI</b></h2>
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
				<table id="dg" align="center" title="LISTING DATA BARANG" style="width:900px;height:365px;" ></table>
			</td>
        </tr>
		</table> 
		</p> 
    </div>   
</div>

<div id="dialog-modal" title="">
<div id="accordion">
<h2><a href="#" id="1" onclick="javascript:validate_combo()"><b>Golongan</b></a></h2>
<div id="1">
    <p class="validateTips">Semua Inputan Harus Di Isi.</p> 
    <fieldset>
     <table align="center" style="width:100%;" border="0">
            <tr>
                <td width="30%">KODE GOLONGAN</td>
                <td width="1%">:</td>
                <td><input type="text" id="kd_gol" style="width:100px;"/></td>  
            </tr>        
            <tr>
                <td width="30%">NAMA GOLONGAN</td>
                <td width="1%">:</td>
                <td><input type="text" id="nm_gol" style="width:360px;"/></td>  
            </tr>
            <tr>
            <td colspan="3">&nbsp;</td>
            </tr>            
            <tr>
                <td colspan="3" align="center"><a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:simpan_gol();">Simpan</a>
		        <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Kembali</a>
                </td>                
            </tr>
        </table>  
    </fieldset> 
</div>
<h2><a href="#" id="2" onclick="javascript:validate_combo()"><b>Bidang</b></a></h2>
<div id="2">
    <p class="validateTips">Semua Inputan Harus Di Isi.</p> 
    <fieldset>
     <table align="center" style="width:100%;" border="0">
            <tr>
                <td width="30%">GOLONGAN</td>
                <td width="1%">:</td>
                <td><input type="text" id="gol" style="width:70px;"/>
				<input type="text" id="namagol" style="width:300px;"/></td>  
            </tr>
            <tr>
                <td width="30%">KODE BARANG</td>
                <td width="1%">:</td>
                <td><input type="text" id="kd_bid" style="width:100px;"/></td>  
            </tr>            
            <tr>
                <td width="30%">NAMA BIDANG</td>
                <td width="1%">:</td>
                <td><input type="text" id="nm_bid" style="width:360px;"/></td>  
            </tr>
            <tr>
            <td colspan="3">&nbsp;</td>
            </tr>            
            <tr>
                <td colspan="3" align="center"><a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:simpan_bid();">Simpan</a>
		        <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Kembali</a>
                </td>                
            </tr>
        </table>  
            
    </fieldset> 
</div>
<h2><a href="#" id="3" onclick="javascript:validate_combo()"><b>Kelompok</b></a></h2>
<div id="3">
    <p class="validateTips">Semua Inputan Harus Di Isi.</p> 
    <fieldset>
     <table align="center" style="width:100%;" border="0">
            <tr>
                <td width="30%">BIDANG</td>
                <td width="1%">:</td>
                <td><input type="text" id="bag" style="width:70px;"/>
				<input type="text" id="namabag" style="width:300px;"/></td>  
            </tr>
            <tr>
                <td width="30%">KODE KELOMPOK</td>
                <td width="1%">:</td>
                <td><input type="text" id="kd_kel" style="width:100px;"/></td>  
            </tr>            
            <tr>
                <td width="30%">NAMA KELOMPOK</td>
                <td width="1%">:</td>
                <td><input type="text" id="nm_kel" style="width:360px;"/></td>  
            </tr>
            <tr>
            <td colspan="3">&nbsp;</td>
            </tr>            
            <tr>
                <td colspan="3" align="center"><a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:simpan_kel();">Simpan</a>
		        <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Kembali</a>
                </td>                
            </tr>
        </table>  
            
    </fieldset> 
</div>
<h2><a href="#" id="4" onclick="javascript:validate_combo()"><b>Sub Kelompok</b></a></h2>
<div id="4">
    <p class="validateTips">Semua Inputan Harus Di Isi.</p> 
    <fieldset>
     <table align="center" style="width:100%;" border="0">
            <tr>
                <td width="30%">KODE KELOMPOK</td>
                <td width="1%">:</td>
                <td><input type="text" id="kel" style="width:70px;"/>
				<input type="text" id="namakel" style="width:300px;"/></td>  
            </tr>
            <tr>
                <td width="30%">KODE SUB KELOMPOK</td>
                <td width="1%">:</td>
                <td><input type="text" id="kd_subkel" style="width:100px;"/></td>  
            </tr>            
            <tr>
                <td width="30%">NAMA SUB KELOMPOK</td>
                <td width="1%">:</td>
                <td><input type="text" id="nm_subkel" style="width:360px;"/></td>  
            </tr>
            <tr>
            <td colspan="3">&nbsp;</td>
            </tr>            
            <tr>
                <td colspan="3" align="center"><a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:simpan_subkel();">Simpan</a>
		        <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Kembali</a>
                </td>                
            </tr>
        </table>  
            
    </fieldset> 
</div>
<h2><a href="#" id="5" onclick="javascript:validate_combo()"><b>Sub Sub Kelompok</b></a></h2>
<div id="5">
    <p class="validateTips">Semua Inputan Harus Di Isi.</p> 
    <fieldset>
     <table align="center" style="width:100%;" border="0">
            <tr>
                <td width="30%">KODE KELOMPOK</td>
                <td width="1%">:</td>
                <td><input type="text" id="subkel" style="width:70px;"/>
				<input type="text" id="namasubkel" style="width:300px;"/></td>  
            </tr>
            <tr>
                <td width="30%">KODE BARANG</td>
                <td width="1%">:</td>
                <td><input type="text" id="kd_subsubkel" style="width:100px;"/></td>  
            </tr>            
            <tr>
                <td width="30%">NAMA BARANG</td>
                <td width="1%">:</td>
                <td><input type="text" id="nm_subsubkel" style="width:360px;"/></td>  
            </tr>
            <tr>
                <td width="30%">SATUAN</td>
                <td width="1%">:</td>
                <td><input type="text" id="satuan" style="width:120px;"/></td>  
            </tr>            
            <tr>
                <td width="30%">SPESIFIKASI</td>
                <td width="1%">:</td>
                <td><input type="text" id="spesifikasi" style="width:360px;"/></td>  
            </tr>
            <tr>
            <td colspan="3">&nbsp;</td>
            </tr>            
            <tr>
                <td colspan="3" align="center"><a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:simpan_subsubkel();">Simpan</a>
		        <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Kembali</a>
                </td>                
            </tr>
        </table>  
            
    </fieldset> 
</div>

</div>
</div>

