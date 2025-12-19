
  	
    <script type="text/javascript">
    
    var kdkel= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
    var lcskpd = '';
    var lpdok = '';
                    
     $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
            height: 600,
            width: 1000,
            modal: true,
            autoOpen:false,
        });
        });    
     
     $(function(){
        
      $('#nodok').combogrid({  
       panelWidth:500,  
       idField:'no_dokumen',  
       textField:'no_dokumen',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_dok',  
       columns:[[  
           {field:'no_dokumen',title:'NOMOR DOKUMEN',width:100},  
           {field:'nilai_kontrak',title:'NILAI KONTRAK',width:400}    
       ]],  
       onSelect:function(rowIndex,rowData){
          // if (lcstatus == 'tambah'){
           lpdok = rowData.no_dokumen;
           //$('#uker').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_uker2',queryParams:({kduskpd:lcskpd}) });
          // }                 
       }  
     });
        
        
     
     $('#milik').combogrid({  
       panelWidth:500,  
       idField:'kd_milik',  
       textField:'nm_milik',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_milik',  
       columns:[[  
           {field:'kd_milik',title:'KODE MILIK',width:100},  
           {field:'nm_milik',title:'KEPEMILIKAN',width:400}    
       ]] 
     });
     
     $('#wilayah').combogrid({  
       panelWidth:500,  
       idField:'kd_wilayah',  
       textField:'nm_wilayah',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_wilayah',  
       columns:[[  
           {field:'kd_wilayah',title:'KODE WILAYAH',width:100},  
           {field:'nm_wilayah',title:'WILAYAH',width:400}    
       ]] 
     });
     
     $('#skpd').combogrid({  
       panelWidth:500,  
       idField:'kd_uskpd',  
       textField:'kd_uskpd',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_ubidskpd',  
       columns:[[  
           {field:'kd_uskpd',title:'KODE SKPD',width:100},  
           {field:'nm_uskpd',title:'Nama SKPD',width:400}    
       ]],  
       onSelect:function(rowIndex,rowData){
          // if (lcstatus == 'tambah'){
           lcskpd = rowData.kd_uskpd;
           $("#nmskpd").attr("value",rowData.nm_uskpd.toUpperCase());
           $('#uker').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_uker2',queryParams:({kduskpd:lcskpd}) });
          // }                 
       }  
     });
     
     $('#uker').combogrid({  
       panelWidth:500,  
       idField:'kd_uker',  
       textField:'kd_uker',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_uker2',
       queryParams:({kduskpd:''}),
       loadMsg:"Tunggu Sebentar....!!",  
       columns:[[  
           {field:'kd_uker',title:'KODE UNIT KERJA',width:100},  
           {field:'nm_uker',title:'NAMA UNIT KERJA',width:400}    
       ]]
     });
     
        
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>/index.php/master/load_lokasi',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'kd_lokasi',
    		title:'Kode Lokasi',
    		width:15,
            align:"left"},
            {field:'kd_uker',
    		title:'Kode Unit Kerja',
    		width:15,
            align:"left"},
            {field:'nm_lokasi',
    		title:'Nama Lokasi',
    		width:40,
            align:"left"}
        ]],
        onSelect:function(rowIndex,rowData){
          lcidx = rowIndex;
          kdlok = rowData.kd_lokasi;
          nmlok = rowData.nm_lokasi;
          kduker  = rowData.kd_uker;
          get(kdlok,nmlok,kduker);   
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
          lcidx = rowIndex;
          judul = 'Edit Data Lokasi'; 
          lcstatus = 'edit';
          kdlok = rowData.kd_lokasi;
          nmlok = rowData.nm_lokasi;
          kduker  = rowData.kd_uker;
          get(kdlok,nmlok,kduker); 
          edit_data();   
        }
        
        });
       
    });        

      
    function  get(kdlok,nmlok,kduker){
        $("#kdlokasi").attr("value",kdlok);
        $("#nmlokasi").attr("value",nmlok);
        $("#kduker").combogrid("setValue",kduker);
                       
    }
    
    function kosong(){
        $("#kdlokasi").attr("value",'');
        $("#nmlokasi").attr("value",'');
        $("#kduker").combogrid("setValue",'');
    }
    
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    
    $(function(){
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>/index.php/master/load_lokasi',
        queryParams:({cari:kriteria})
        });        
     });
    }
    
    function simpan(){
        
        var ckdlok = document.getElementById('kdlokasi').value;
        var cnmlok = document.getElementById('nmlokasi').value;
        var ckduker = $('#kduker').combogrid('getValue');
                        
        if (ckdlok==''){
            alert('Kode Lokasi Tidak Boleh Kosong');
            exit();
        } 
        
        if (cnmlok==''){
            alert('Nama Lokasi Tidak Boleh Kosong');
            exit();
        } 
        
        if (ckduker==''){
            alert('Kode Unit Kerja Tidak Boleh Kosong');
            exit();
        } 

        if(lcstatus=='tambah'){
            
            lcinsert = "(kd_lokasi,nm_lokasi,kd_uker)";
            lcvalues = "('"+ckdlok+"','"+cnmlok+"','"+ckduker+"')";
            
            
            $(document).ready(function(){
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>index.php/master/simpan_master',
                    data: ({tabel:'mlokasi',kolom:lcinsert,nilai:lcvalues,cid:'kd_lokasi',lcid:ckdlok}),
                    dataType:"json"
                });
            });    
            
            
        $('#dg').datagrid('appendRow',{kd_lokasi:ckdlok,nm_lokasi:cnmlok,kd_uker:ckduker});
        }else {
            
            lcquery = "UPDATE mlokasi SET nm_lokasi='"+cnmlok+"',kd_uker='"+ckduker+"' where kd_lokasi='"+ckdlok+"'";
            
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
            		nm_lokasi: cnmlok,
                    kd_uker: ckduker        
            	}
            });
        }
       
        
        alert("Data Berhasil disimpan");
        $("#dialog-modal").dialog('close');
        //section1();
    } 
    
      function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data Lokasi';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        document.getElementById("kdlokasi").disabled=true;
        }    
        
    
     function tambah(){
        lcstatus = 'tambah';
        judul = 'Input Data Unit Kerja';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
        $("#dialog-modal").dialog('open');
        document.getElementById("kdlokasi").disabled=false;
        document.getElementById("kduker").focus();
        } 
     function keluar(){
        $("#dialog-modal").dialog('close');
     }    
    
     function hapus(){
        var ckdlok = document.getElementById('kdlokasi').value;
               
        var urll = '<?php echo base_url(); ?>index.php/master/hapus_master';
        $(document).ready(function(){
         $.post(urll,({tabel:'mlokasi',cnid:ckdlok,cid:'kd_lokasi'}),function(data){
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
<h3 align="center"><u><b><a>INPUTAN MASTER LOKASI</a></b></u></h3>
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
        <table id="dg" align="center" title="LISTING DATA LOKASI" style="width:900px;height:365px;" >  
        </table>
        </td>
        </tr>
    </table>    
        
 
    </p> 
    </div>   
</div>

<div id="dialog-modal" title="">
    <p class="validateTips">Inventarisasi Tanah</p> 
    <fieldset>
     <table align="center" style="width:100%;" border="0">
           <tr>
               <td width="50%" valign="top">
                    <table align="left" style="width:100%;" border="0">
                       <tr>
                            <td width="25%">No Register</td>
                            <td width="5%">:</td>
                            <td width="70%"><input type="text" id="noreg" style="width:150px;"/></td>
                       </tr>
                       <tr>
                            <td>No Dokumen</td>
                            <td>:</td>
                            <td><input id="jns_aset" name="nodok" style="width: 300px;" /></td>
                       </tr>
                       <tr>
                            <td>Jenis Asset</td>
                            <td>:</td>
                            <td><input id="jns_aset" name="jns_aset" style="width: 300px;" /></td>
                       </tr>
                       <tr>
                            <td>Rekening</td>
                            <td>:</td>
                            <td><input type="text" id="norek" style="width:300px;"/></td>
                       </tr>
                       <tr>
                            <td colspan="3" align="left"><u><b>Pengurus Barang</b></u></td>
                       </tr>
                       <tr>
                            <td>Kepemilikan</td>
                            <td>:</td>
                            <td><input id="milik" name="milik" style="width: 250px;" /></td>
                       </tr>
                       <tr>
                            <td>Wilayah</td>
                            <td>:</td>
                            <td><input id="wilayah" name="wilayah" style="width: 250px;" /></td>
                       </tr>
                       <tr>
                            <td>SKPD</td>
                            <td>:</td>
                            <td><input type="text" id="skpd" style="width:75px;"/></td>
                       </tr>
                       <tr>
                            <td colspan="2">&nbsp;</td>
                            <td style="font-size:9px;"><input type="text" id="nmskpd" style="width:300px; border:none;"/></td>
                       </tr>
                       <tr>
                            <td>Unit Kerja</td>
                            <td>:</td>
                            <td><input type="text" id="uker" style="width:150px;"/></td>
                       </tr>
                       <tr>
                            <td colspan="3" align="left"><u><b>Asal Usul Barang</b></u></td>
                       </tr>
                       <tr>
                            <td>Cara Perolehan</td>
                            <td>:</td>
                            <td><input type="text" id="cr_oleh" style="width:150px;"/></td>
                       </tr>
                       <tr>
                            <td>Dasar Perolehan</td>
                            <td>:</td>
                            <td><input type="text" id="dsr_oleh" style="width:150px;"/></td>
                       </tr>
                       <tr>
                            <td>&ensp;&ensp;a)&nbsp;Nomor</td>
                            <td>:</td>
                            <td><input type="text" id="no_oleh" style="width:300px;"/></td>
                       </tr>
                       <tr>
                            <td>&ensp;&ensp;b)&nbsp;Tanggal</td>
                            <td>:</td>
                            <td><input type="text" id="tgl_oleh" style="width:150px;"/></td>
                       </tr>
                       <tr>
                            <td>Tahun Perolehan</td>
                            <td>:</td>
                            <td><input type="text" id="th_oleh" style="width:150px;"/></td>
                       </tr>
                       <tr>
                            <td>Harga Perolehan</td>
                            <td>:</td>
                            <td><input type="text" id="hrg_oleh" style="width:150px;"/></td>
                       </tr>
                    </table> 
               </td>
               <td width="50%" valign="top">
                    <table  align="left" style="width:100%;" border="0">
                       <tr>
                            <td colspan="3" align="left"><u><b>Sumber Pembiayaan</b></u></td>
                       </tr>
                       <tr>
                            <td width="30%">Jenis Dana</td>
                            <td width="5%">:</td>
                            <td width="65%"><input type="text" id="jns_dana" style="width:150px;"/></td>
                       </tr>
                       <tr>
                            <td>Tahun Anggaran</td>
                            <td>:</td>
                            <td><input type="text" id="thn_anggar" style="width:150px;"/></td>
                       </tr>
                       <tr>
                            <td>Bukti Pembayaran</td>
                            <td>:</td>
                            <td><input type="text" id="bkt_bayar" style="width:150px;"/></td>
                       </tr>
                       <tr>
                            <td>Kegiatan</td>
                            <td>:</td>
                            <td><input type="text" id="giat" style="width:150px;"/></td>
                       </tr>
                       <tr>
                            <td colspan="3" align="left"><u><b>Spesifikasi Barang</b></u></td>
                       </tr>
                       <tr>
                            <td>Lokasi</td>
                            <td>:</td>
                            <td><input type="text" id="lokasi" style="width:150px;"/></td>
                       </tr>
                       <tr>
                            <td>Status Tanah</td>
                            <td>:</td>
                            <td><input type="text" id="st_tanah" style="width:150px;"/></td>
                       </tr>
                       <tr>
                            <td>Nomor Sertifikat</td>
                            <td>:</td>
                            <td><input type="text" id="no_sertif" style="width:300px;"/></td>
                       </tr>
                       <tr>
                            <td>Tanggal Sertifikat</td>
                            <td>:</td>
                            <td><input type="text" id="tgl_sertif" style="width:150px;"/></td>
                       </tr>
                       <tr>
                            <td>Luas Tanah</td>
                            <td>:</td>
                            <td><input type="text" id="ls_tanah" style="width:150px;"/></td>
                       </tr>
                       <tr>
                            <td>Penggunaan</td>
                            <td>:</td>
                            <td><input type="text" id="guna" style="width:150px;"/></td>
                       </tr>
                       <tr>
                            <td rowspan="3" valign="top">Letak/Alamat</td>
                            <td>:</td>
                            <td><input type="text" id="alamat1" style="width:300px;"/></td>
                       </tr>
                       <tr>
                            <td>:</td>
                            <td><input type="text" id="alamat2" style="width:300px;"/></td>
                       </tr>
                       <tr>
                            <td>:</td>
                            <td><input type="text" id="alamat3" style="width:300px;"/></td>
                       </tr>
                       <tr>
                            <td valign="top">Keterangan</td>
                            <td valign="top">:</td>
                            <td><textarea rows="2" cols="50" id="keterangan" style="width: 300px;"></textarea></td>
                       </tr>
                    </table>
               
               </td>
           </tr>
           <tr>
                <td colspan="2" align="center"><a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:simpan();">Simpan</a>
		        <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Kembali</a>
                </td>                
            </tr>
        </table>  
            
    </fieldset> 
</div>

