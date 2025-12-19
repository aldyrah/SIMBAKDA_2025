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
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/master/load_golongan',
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
    		title:'Kode Golongan',
    		width:15,
            align:"center"},
            {field:'nm_golongan',
    		title:'Nama Golongan',
    		width:50},
            {field:'ketjenis',
    		title:'Jenis',
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
           edit_data();   
        }
        
        });
       
    });        

 
    
    function get(kodegol,nmgol,ketjns) {
        
        $("#kdgol").attr("value",kodegol);
        $("#nmgol").attr("value",nmgol);
        $("#jns_aset").combobox("select",ketjns);       
                       
    }
       
    function kosong(){
        $("#kdgol").attr("value",'');
        $("#nmgol").attr("value",'');
        $("#jns_aset").combobox("setValue",'');
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
        var cjns = $('#jns_aset').combobox('getValue');
        
        if(cjns=='1'){
            var cnmjns = 'Aset';
        }else{
            var cnmjns = 'Non Aset';
        }
        
        var ckdgol = document.getElementById('kdgol').value;
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
            
            lcinsert = "(golongan,nm_golongan,jenis)";
            lcvalues = "('"+ckdgol+"','"+cnmgol+"','"+cjns+"')";
            
            $(document).ready(function(){
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>index.php/master/simpan_master',
                    data: ({tabel:'mgolongan',kolom:lcinsert,nilai:lcvalues,cid:'golongan',lcid:ckdgol}),
                    dataType:"json"
                });
            });   
           
        $('#dg').datagrid('appendRow',{golongan:ckdgol,nm_golongan:cnmgol,ketjenis:cnmjns});
        } else{
            
            lcquery = "UPDATE mgolongan SET nm_golongan='"+cnmgol+"',jenis="+cjns+" where golongan='"+ckdgol+"'";

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
                    ketjenis: cnmjns                    
            	}
            });
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
        $("#dialog-modal").dialog('open');
        document.getElementById("kdgol").disabled=false;
        document.getElementById("kdgol").focus();
        } 
     function keluar(){
        $("#dialog-modal").dialog('close');
     }    
    
     function hapus(){
        var ckdgol = document.getElementById('kdgol').value;
		if (ckdgol !=''){
		var del=confirm('Apakah Anda yakin ingin Menhapus data '+ckdgol+'?');
		if (del==true){
        var urll = '<?php echo base_url(); ?>index.php/master/hapus_master';
        $(document).ready(function(){
         $.post(urll,({tabel:'mgolongan',cnid:ckdgol,cid:'golongan'}),function(data){
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
  
    
  
   </script>



<div id="content1"> 
<h3 align="center"><u><b><a>INPUTAN MGOLONGAN</a></b></u></h3>
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
        <table id="dg" title="LISTING DATA MGOLONGAN" style="width:900px;height:365px;" >  
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
                <td width="30%">KODE GOLONGAN</td>
                <td width="1%">:</td>
                <td><input type="text" id="kdgol" style="width:100px;"/></td>  
            </tr>            
            <tr>
                <td width="30%">NAMA GOLONGAN</td>
                <td width="1%">:</td>
                <td><input type="text" id="nmgol" style="width:360px;"/></td>  
            </tr>
            <tr>
                <td width="30%">JENIS</td>
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
                
            </tr>
            
            
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

