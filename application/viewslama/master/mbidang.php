
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
            height: 300,
            width: 800,
            modal: true,
            autoOpen:false,
        });
        });    
     
     $(function(){
     
     $('#gol').combogrid({  
       panelWidth:500,  
       idField:'golongan',  
       textField:'golongan',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_gol',  
       columns:[[  
           {field:'golongan',title:'golongan',width:100},  
           {field:'nm_golongan',title:'Nama Golongan',width:400}    
       ]],  
       onSelect:function(rowIndex,rowData){
           kode = rowData.kd_skpd;               
           $("#nmgol").attr("value",rowData.nm_golongan.toUpperCase());
           if(lcstatus=='tambah'){ 
           $("#kdbid").attr("value",rowData.golongan);
           }                 
       }  
     });   
        
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/master/load_bidang',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'bidang',
    		title:'Kode Bidang',
    		width:15,
            align:"center"},
            {field:'nm_bidang',
    		title:'Nama Bidang',
    		width:50},
            {field:'nmgol',
    		title:'Golongan',
    		width:30,
            align:"left"},
			{field:'hapus',width:5,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus();'' />";}}
        ]],
        onSelect:function(rowIndex,rowData){
          lcidx = rowIndex;
          kodebid = rowData.bidang;
          nmbid = rowData.nm_bidang;
          gol   = rowData.golongan
          get(kodebid,nmbid,gol);   
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
           lcidx = rowIndex;
           judul = 'Edit Data Bidang'; 
           lcstatus = 'edit';
           edit_data();   
        }
        
        });
       
    });        

      
    function get(kodebid,nmbid,gol) {
        $("#kdbid").attr("value",kodebid);
        $("#nmbid").attr("value",nmbid);
        $("#gol").combogrid("setValue",gol);               
    }
       
    function kosong(){
        $("#kdbid").attr("value",'');
        $("#nmbid").attr("value",'');
        $("#nmgol").attr("value",'');
        $("#gol").combogrid("setValue",'');
    }
    
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    
    $(function(){
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/master/load_bidang',
        queryParams:({cari:kriteria})
        });        
     });
    }
    
       function simpan_bidang(){
        
        var ckdbid = document.getElementById('kdbid').value;
        var cnmbid = document.getElementById('nmbid').value;
        var cgol = $('#gol').combogrid('getValue');
        var cnmgol = document.getElementById('nmgol').value;
                
        if (ckdbid==''){
            alert('Kode Bidang Tidak Boleh Kosong');
            exit();
        } 
        
        if (cnmbid==''){
            alert('Nama Bidang Tidak Boleh Kosong');
            exit();
        } 
        
        if (cgol==''){
            alert('Golongan Tidak Boleh Kosong');
            exit();
        } 

        
        if(lcstatus=='tambah'){
            lcinsert = "(bidang,nm_bidang,golongan)";
            lcvalues = "('"+ckdbid+"','"+cnmbid+"','"+cgol+"')";
            
            $(document).ready(function(){
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>index.php/master/simpan_master',
                    data: ({tabel:'mbidang',kolom:lcinsert,nilai:lcvalues,cid:'bidang',lcid:ckdbid}),
                    dataType:"json"
                });
            });   
           
            
            
        $('#dg').datagrid('appendRow',{bidang:ckdbid,nm_bidang:cnmbid,nmgol:cnmgol,golongan:cgol});
        } else {
            
            lcquery = "UPDATE mbidang SET nm_bidang='"+cnmbid+"',golongan='"+cgol+"' where bidang='"+ckdbid+"'";

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
            		bidang: ckdbid,
            		nm_bidang: cnmbid,
                    nmgol: cnmgol                    
            	}
            });
        }
        
        
        alert("Data Berhasil disimpan");
        $("#dialog-modal").dialog('close');
        //section1();
    } 
    
      function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data Bidang';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        document.getElementById("kdbid").disabled=true;
        }    
        
    
     function tambah(){
        lcstatus = 'tambah';
        judul = 'Input Data Bidang';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
        $("#dialog-modal").dialog('open');
        document.getElementById("kdbid").disabled=false;
        document.getElementById("kdgol").focus();
        } 
     function keluar(){
        $("#dialog-modal").dialog('close');
     }    
    
     function hapus(){
        var ckdbidang = document.getElementById('kdbid').value;
		if (ckdbidang !=''){
		var del=confirm('Apakah Anda yakin ingin Menhapus data '+ckdbidang+'?');
		if (del==true){       
        var urll = '<?php echo base_url(); ?>index.php/master/hapus_master';
        $(document).ready(function(){
         $.post(urll,({tabel:'mbidang',cnid:ckdbidang,cid:'bidang'}),function(data){
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
        });   }} 
    } 
    
    
  
   </script>



<div id="content1"> 
<h3 align="center"><u><b><a>INPUTAN MBIDANG</a></b></u></h3>
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
        <table id="dg" align="center" title="LISTING DATA BIDANG" style="width:900px;height:365px;" >  
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
                <td>GOLONGAN</td>
                <td>:</td>
                <td><input id="gol" name="gol" style="width: 50px;" /> <input type="text" id="nmgol" style="border:0;width: 430px;" readonly="true"/></td>
            </tr>
           <tr>
                <td width="30%">KODE BIDANG</td>
                <td width="1%">:</td>
                <td><input type="text" id="kdbid" style="width:100px;"/></td>  
            </tr>            
            <tr>
                <td width="30%">NAMA BIDANG</td>
                <td width="1%">:</td>
                <td><input type="text" id="nmbid" style="width:360px;"/></td>  
            </tr>
            <tr>
            <td colspan="3">&nbsp;</td>
            </tr>            
            <tr>
                <td colspan="3" align="center"><a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:simpan_bidang();">Simpan</a>
		        <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Kembali</a>
                </td>                
            </tr>
        </table>  
            
    </fieldset> 
</div>

