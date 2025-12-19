
  	
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
     
     $('#kdskpd').combogrid({  
       panelWidth:500,  
       idField:'kd_skpd',  
       textField:'kd_skpd',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_skpd',  
       columns:[[  
           {field:'kd_skpd',title:'KODE SKPD',width:100},  
           {field:'nm_skpd',title:'NAMA SKPD',width:400}    
       ]],
       onSelect:function(rowIndex,rowData){
            $("#nmskpd").attr("value",rowData.nm_skpd.toUpperCase());
       }
     });
            
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/transaksi/load_neraca',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'kd_skpd',
    		title:'Kode SKPD',
    		width:15,
            align:"center"},
            {field:'nm_skpd',
    		title:'Nama SKPD',
    		width:40},
            {field:'n_nrc',
    		title:'Nilai',
    		width:15,
            align:"right"}
        ]],
        onSelect:function(rowIndex,rowData){
          lcidx = rowIndex;
          kdskpd = rowData.kd_skpd;
          nmskpd = rowData.nm_skpd;
          nilai = rowData.n_nrc; 
          ket = rowData.keterangan;
          get(kdskpd,nmskpd,nilai,ket);   
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
          lcidx = rowIndex;
          judul = 'Edit Data Barang'; 
          lcstatus = 'edit';
          lcidx = rowIndex;
          kdskpd = rowData.kd_skpd;
          nmskpd = rowData.nm_skpd;
          nilai = rowData.n_nrc; 
          ket = rowData.keterangan;
          get(kdskpd,nmskpd,nilai,ket);   
          edit_data();   
        }
        
        });
       
    });        

    
    function get(kdskpd,nmskpd,nilai,ket) {
        $("#nilai").attr("value",nilai);
        $("#nmskpd").attr("value",nmskpd);
        $("#keterangan").attr("value",ket);
        $("#kdskpd").combogrid("setValue",kdskpd);                  
    }
       
    function kosong(){
        $("#kdskpd").combogrid("setValue",'');
        $("#nmskpd").attr("value",'');
        $("#nilai").attr("value",'');
        $("#keterangan").attr("value",'');
    }
    
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    
    $(function(){
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/transaksi/input_neraca',
        queryParams:({cari:kriteria})
        });        
     });
    }
    
    function simpan(){
        
        var nnilai = document.getElementById('nilai').value;
        var cnmskpd  = document.getElementById('nmskpd').value;
        var cket  = document.getElementById('keterangan').value;
        var ckdskpd = $('#kdskpd').combogrid('getValue');
            
        if (ckdskpd==''){
            alert('Kode SKPD Tidak Boleh Kosong');
            exit();
        } 
        
        if (nnilai==''){
            alert('Nilai Tidak Boleh Kosong');
            exit();
        } 

        if(lcstatus=='tambah'){
            
            lcinsert = "(kd_skpd,n_nrc,keterangan)";
            lcvalues = "('"+ckdskpd+"','"+nnilai+"','"+cket+"')";
            
            
            $(document).ready(function(){
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>index.php/master/simpan_master',
                    data: ({tabel:'nrc_aset',kolom:lcinsert,nilai:lcvalues,cid:'kd_skpd',lcid:ckdskpd}),
                    dataType:"json"
                });
            });    
            
            
        $('#dg').datagrid('appendRow',{kd_skpd:ckdskpd,nm_skpd:cnmskpd,nilai:nnilai,keterangan:cket});
        }else {
            
            lcquery = "UPDATE nrc_aset SET ket='"+cket+"',nilai='"+nnilai+"' where kd_skpd='"+ckdskpd+"'";
            
            //alert(lcquery);
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
            		kd_skpd: ckdskpd,
            		nm_skpd: cnmskpd,
                    nilai: nnilai,
                    ket: cket                    
            	}
            });
        }
       
        
        alert("Data Berhasil disimpan");
        $("#dialog-modal").dialog('close');
        //section1();
    } 
    
      function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data Neraca';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        document.getElementById("kdskpd").disabled=true;
        }    
        
    
     function tambah(){
        //alert('sdsdsd');
        lcstatus = 'tambah';
        judul = 'Inputan Neraca';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
        $("#dialog-modal").dialog('open');
//        document.getElementById("kdskpd").focus();
        } 
        
     function keluar(){
        $("#dialog-modal").dialog('close');
     }    
    
     function hapus(){
        var ckdbrg = document.getElementById('kdbrg').value;
               
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
        });    
    } 
    
    
  
   </script>

<div id="content1"> 
<h3 align="center"><u><b><a>INPUTAN NERACA</a></b></u></h3>
    <div align="center">
    <p>     
    <table style="width:400px;" border="0">
        <tr>
        <td width="10%">
        <a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:tambah()">Tambah</a></td>               
        <td width="10%"><a class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:hapus();">Hapus</a></td>
        <td width="5%"><a class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="javascript:cari();">Cari</a></td>
        <td><input type="text" value="" id="txtcari" style="width:300px;"/></td>
        </tr>
        <tr>
        <td colspan="4">
        <table id="dg" align="center" title="LISTING NERACA" style="width:900px;height:365px;" >  
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
                <td>SKPD</td>
                <td>:</td>
                <td><input id="kdskpd" name="kdskpd" style="width: 100px;" /> <input type="text" id="nmskpd" style="border:0;width: 400px;" readonly="true"/></td>
           </tr>
            <tr>
                <td width="30%">NILAI NERACA</td>
                <td width="1%">:</td>
                <td><input type="text" id="nilai" style="width:100px;"/></td>  
            </tr>            
            <tr>
                <td width="30%" valign="top">URAIAN</td>
                <td width="1%" valign="top">:</td>
                <td><textarea rows="2" cols="50" id="keterangan" name="keterangan" style="width: 450px;"></textarea></td>  
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

