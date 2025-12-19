
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
     
     $('#bid').combogrid({  
       panelWidth:500,  
       idField:'bidang',  
       textField:'bidang',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_bid',  
       columns:[[  
           {field:'bidang',title:'Bidang',width:100},  
           {field:'nm_bidang',title:'Nama Bidang',width:400}    
       ]],  
       onSelect:function(rowIndex,rowData){
           $("#nmbid").attr("value",rowData.nm_bidang.toUpperCase());
           if(lcstatus=='tambah'){ 
           $("#kdkel").attr("value",rowData.bidang);
           }                 
       }  
     });   
        
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/master/load_kelompok',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'kelompok',
    		title:'Kode Kelompok',
    		width:15,
            align:"center"},
            {field:'nm_kelompok',
    		title:'Nama Kelompok',
    		width:40},
            {field:'nmbid',
    		title:'Bidang',
    		width:40,
            align:"left"},
			{field:'hapus',width:5,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus();'' />";}}
        ]],
        onSelect:function(rowIndex,rowData){
          lcidx = rowIndex;
          kdkel = rowData.kelompok;
          nmkel = rowData.nm_kelompok;
          kdbid   = rowData.bidang
          get(kdkel,nmkel,kdbid);   
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
           lcidx = rowIndex;
           judul = 'Edit Data Kelompok'; 
           lcstatus = 'edit';
           kdkel = rowData.kelompok;
           nmkel = rowData.nm_kelompok;
           kdbid   = rowData.bidang
           get(kdkel,nmkel,kdbid);
           edit_data();   
        }
        
        });
       
    });        

      
    function get(kdkel,nmkel,kdbid) {
        $("#kdkel").attr("value",kdkel);
        $("#nmkel").attr("value",nmkel);
        $("#bid").combogrid("setValue",kdbid);
                   
    }
    
       
    function kosong(){
        $("#kdkel").attr("value",'');
        $("#nmkel").attr("value",'');
        $("#nmbid").attr("value",'');
        $("#bid").combogrid("setValue",'');
    }
    
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    
    $(function(){
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/master/load_kelompok',
        queryParams:({cari:kriteria})
        });        
     });
    }
    
       function simpan_kelompok(){
        
        var ckdkel = document.getElementById('kdkel').value;
        var cnmkel = document.getElementById('nmkel').value;
        var cbid = $('#bid').combogrid('getValue');
        var cnmbid = document.getElementById('nmbid').value;
                
        if (ckdkel==''){
            alert('Kode Kelompok Tidak Boleh Kosong');
            exit();
        } 
        
        if (cnmkel==''){
            alert('Nama Kelompok Tidak Boleh Kosong');
            exit();
        } 
        
        if (cbid==''){
            alert('Bidang Tidak Boleh Kosong');
            exit();
        } 

        
        if(lcstatus=='tambah'){
            
            lcinsert = "(kelompok,nm_kelompok,bidang)";
            lcvalues = "('"+ckdkel+"','"+cnmkel+"','"+cbid+"')";
            
            $(document).ready(function(){
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>index.php/master/simpan_master',
                    data: ({tabel:'mkelompok',kolom:lcinsert,nilai:lcvalues,cid:'kelompok',lcid:ckdkel}),
                    dataType:"json"
                });
            });    
            
            
        $('#dg').datagrid('appendRow',{kelompok:ckdkel,nm_kelompok:cnmkel,nmbid:cnmbid,bidang:cbid});
        } else {
            
            lcquery = "UPDATE mkelompok SET nm_kelompok='"+cnmkel+"',bidang='"+cbid+"' where kelompok='"+ckdkel+"'";
            
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
            		kelompok: ckdkel,
            		nm_kelompok: cnmkel,
                    nmbid: cnmbid,
                    bidang: cbid                    
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
        document.getElementById("kdkel").disabled=true;
        }    
        
    
     function tambah(){
        lcstatus = 'tambah';
        judul = 'Input Data Kelompok';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
        $("#dialog-modal").dialog('open');
        document.getElementById("kdkel").disabled=false;
        document.getElementById("kdbid").focus();
        } 
     function keluar(){
        $("#dialog-modal").dialog('close');
     }    
    
     function hapus(){
        var ckdkel = document.getElementById('kdkel').value;
        if (ckdkel !=''){
		var del=confirm('Apakah Anda yakin ingin Menhapus data '+ckdkel+'?');
		if (del==true){          
        var urll = '<?php echo base_url(); ?>index.php/master/hapus_master';
        $(document).ready(function(){
         $.post(urll,({tabel:'mkelompok',cnid:ckdkel,cid:'kelompok'}),function(data){
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
<h3 align="center"><u><b><a>INPUTAN KELOMPOK</a></b></u></h3>
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
        <table id="dg" align="center" title="LISTING DATA KELOMPOK" style="width:900px;height:365px;" >  
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
                <td>BIDANG</td>
                <td>:</td>
                <td><input id="bid" name="bid" style="width: 75px;" /> <input type="text" id="nmbid" style="border:0;width: 430px;" readonly="true"/></td>
            </tr>
           <tr>
                <td width="30%">KODE KELOMPOK</td>
                <td width="1%">:</td>
                <td><input type="text" id="kdkel" style="width:100px;"/></td>  
            </tr>            
            <tr>
                <td width="30%">NAMA KELOMPOK</td>
                <td width="1%">:</td>
                <td><input type="text" id="nmkel" style="width:360px;"/></td>  
            </tr>
            <tr>
            <td colspan="3">&nbsp;</td>
            </tr>            
            <tr>
                <td colspan="3" align="center"><a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:simpan_kelompok();">Simpan</a>
		        <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Kembali</a>
                </td>                
            </tr>
        </table>  
            
    </fieldset> 
</div>

