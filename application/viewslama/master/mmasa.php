  <script type="text/javascript">
    
    var kode = '';
    var giat = '';
    var nomor= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
                    
     $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
            height: 250,
            width: 600,
            modal: true,
            autoOpen:false
        });
        });    
     
     $(function(){  

     $('#kdgol').combogrid({  
            panelWidth:500,  
            idField:'kelompok',  
            textField:'kelompok',  
            mode:'remote',
            url:'<?php echo base_url(); ?>index.php/master/ambil_kelompok_dh',  
            columns:[[  
                {field:'kelompok',title:'Kode Kelompok',width:150},  
                       {field:'nm_kelompok',title:'Nama Kelompok',width:350}  
            ]],
            onSelect:function(rowIndex,rowData){
                $('#nmgol').attr('value',rowData.nm_kelompok);
                document.getElementById("umur").focus();
            }  
            });      
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/master/load_masa',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'golongan',
    		title:'Kode Barang',
    		width:15,
            align:"center"},
            {field:'nm_golongan',
    		title:'Nama Barang',
    		width:50},
            {field:'jenis',
    		title:'Umur',
    		width:30,
            align:"center"},
			{field:'hapus',width:5,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus();'' />";}}
        ]],
        onSelect:function(rowIndex,rowData){
          kodegol = rowData.golongan;
          nmgol = rowData.nm_golongan;
          ketjns = rowData.jenis;
          get(kodegol,nmgol,ketjns); 
          lcidx = rowIndex;  
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
           lcidx = rowIndex;
           judul = 'Edit Data Golongan'; 
           $("#kdgol").combogrid("disable");
           $("#nmgol").attr("disabled",true);
           edit_data();   
        }
        
        });
       
    });        

 
    
    function get(kodegol,nmgol,ketjns) {
        
        $("#kdgol").combogrid("setValue",kodegol);
        $("#nmgol").attr("value",nmgol);
        $("#umur").attr("value",ketjns);       
                       
    }
       
    function kosong(){
        $("#kdgol").combogrid("setValue",'');
        $("#nmgol").attr("value",'');
        $("#umur").attr("value",'');
    }
    
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    $(function(){ 
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/master/load_golongan',
        queryParams:({cari:kriteria})
        });        
     });
    }
    
       function simpan_golongan(){
        var umur = document.getElementById('umur').value;
        
        /*if(cjns=='1'){
            var cnmjns = 'Aset';
        }else{
            var cnmjns = 'Non Aset';
        }*/
        
        var ckdgol = $('#kdgol').combogrid('getValue');
        var cnmgol = document.getElementById('nmgol').value;
                
        if (ckdgol==''){
            alert('Kode Golongan Tidak Boleh Kosong');
            exit();
        } 
        if (cnmgol==''){
            alert('Nama Golongan Tidak Boleh Kosong');
            exit();
        }

        
        if(lcstatus=='tambah'){ 
            
            lcinsert = "(kd_barang,nama,umur)";
            lcvalues = "('"+ckdgol+"','"+cnmgol+"','"+umur+"')";
            
            $(document).ready(function(){
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>index.php/master/simpan_master',
                    data: ({tabel:'mbarang_umur',kolom:lcinsert,nilai:lcvalues,cid:'kd_barang',lcid:ckdgol}),
                    dataType:"json"
                });
            });   
           
        $('#dg').datagrid('appendRow',{golongan:ckdgol,nm_golongan:cnmgol,umur:umur});
        $('#dg').datagrid('reload');
        } else{
            
            lcquery = "UPDATE mbarang_umur SET nama='"+cnmgol+"',umur="+umur+" where kd_barang='"+ckdgol+"'";

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
            		golongan: ckdgol,
            		nm_golongan: cnmgol,
                    umur: umur                    
            	}
            });
                $('#dg').datagrid('reload');
        }
        
        
        alert("Data Berhasil disimpan");
        $("#dialog-modal").dialog('close');

    } 
    
      function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data Golongan';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        document.getElementById("kdgol").disabled=true;
        }    
        
    
     function tambah(){
        lcstatus = 'tambah';
        judul = 'Input Data Golongan';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
        $("#kdgol").combogrid("enable");
           $("#nmgol").attr("disabled",false);
        $("#dialog-modal").dialog('open');
        document.getElementById("kdgol").disabled=false;
        document.getElementById("kdgol").focus();
        } 
     function keluar(){
        $("#dialog-modal").dialog('close');
     }    
    
     function hapus(){
        //var ckdgol = document.getElementById('kdgol').value;
        var rows = $('#dg').datagrid('getSelected');
        //id=rows.id;
        ckdgol=rows.golongan;
        //alert(id);
		if (ckdgol !=''){
		var del=confirm('Apakah Anda yakin ingin Menhapus data '+ckdgol+'?');
		if (del==true){
        var urll = '<?php echo base_url(); ?>index.php/master/hapus_master';
        $(document).ready(function(){
         $.post(urll,({tabel:'mbarang_umur',cnid:ckdgol,cid:'kd_barang'}),function(data){
            status = data;
            if (status=='0'){
                alert('Gagal Hapus..!!');
                exit();
            } else {
                $('#dg').datagrid('deleteRow',lcidx);   
                alert('Data Berhasil Dihapus..!!');
                $('#dg').datagrid('reload');
                exit();
            }
         });
        });    
		}}
    } 
    
       
    function addCommas(nStr)
    {
    	nStr += '';
    	x = nStr.split(',');
        x1 = x[0];
    	x2 = x.length > 1 ? ',' + x[1] : '';
    	var rgx = /(\d+)(\d{3})/;
    	while (rgx.test(x1)) {
    		x1 = x1.replace(rgx, '$1' + '.' + '$2');
    	}
    	return x1 + x2;
    }
    
     function delCommas(nStr)
    {
    	nStr += ' ';
    	x2 = nStr.length;
        var x=nStr;
        var i=0;
    	while (i<x2) {
    		x = x.replace(',','');
            i++;
    	}
    	return x;
    }

   /* function kode_barang(){

    $(function(){
    $('#kdgol').combogrid({  
                   panelWidth : 500,  
                   idField    : 'kelompok',  
                   textField  : 'kelompok',  
                   mode       : 'remote',
                   url        : '<?php echo base_url(); ?>index.php/master/ambil_kelompok_dh',
                   columns:[[  
                       {field:'kelompok',title:'Kode Kelompok',width:150},  
                       {field:'nm_kelompok',title:'Nama Kelompok',width:350}
                   ]],  
                   onSelect:function(rowIndex,rowData){
                    
                   
                    $('#nmgol').attr('value',rowData.nm_kelompok);
                    
                       
                   } 
            });
    
    });
    }*/
  

   </script>



<div id="content1"> 
<h3 align="center"><u><b><a>INPUTAN BARANG MASA MANFAAT</a></b></u></h3>
    <div align="center">
    <p align="center">     
    <table style="width:400px;" border="0">
        <tr>
        <td width="10%">
        <a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:tambah()">Tambah</a></td>               
        <td width="5%"><a class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="javascript:cari();">Cari</a></td>
        <td><input type="text" value="" id="txtcari" style="width:300px;"/></td>
        </tr>
        <tr>
        <td colspan="4">
        <table id="dg" title="LISTING DATA BARANG MASA MANFAAT" style="width:900px;height:365px;" >  
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
                <td width="30%">KODE KELOMPOK</td>
                <td width="1%">:</td>
                <td><input type="text" id="kdgol" style="width:150px;"/></td>  
            </tr>            
            <tr>
                <td width="30%">NAMA KELOMPOK</td>
                <td width="1%">:</td>
                <td><input type="text" id="nmgol" style="width:360px;" readonly="true"/></td>  
            </tr>
            <tr>
                <td width="30%">UMUR KELOMPOK</td>
                <td width="1%">:</td>
                <td><input type="text" id="umur" style="width:100px;"/></td>  
            </tr>
            <!-- <tr>
                <td width="30%">UMUR BARANG</td>
                <td width="1%">:</td>
                <td><input id="jns_aset" class="easyui-combobox" data-options="
            		valueField: 'value',
            		textField: 'label',
            		data: [{
            			label: '',
            			value: ''
            		},{
            			label: 'Aset',
            			value: '1'
            		},{
            			label: 'Non Aset',
            			value: '2'
            		}]"/>
                </td>  
                
            </tr> -->
            
            
            <tr>
            <td colspan="3">&nbsp;</td>
            </tr>            
            <tr>
                <td colspan="3" align="center"><a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:simpan_golongan();">Simpan</a>
		        <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Kembali</a>
                </td>                
            </tr>
        </table>       
    </fieldset>
</div>

