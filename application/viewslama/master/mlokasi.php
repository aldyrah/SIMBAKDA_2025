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
     
     $('#kduker').combogrid({  
       panelWidth:500,  
       idField:'kd_uker',  
       textField:'kd_uker',  
       //mode:'remote',
       //url:'<?php echo base_url(); ?>index.php/master/ambil_uker_dh',  
       columns:[[  
           {field:'kd_uker',title:'KODE UNIT KERJA',width:100},  
           {field:'nm_uker',title:'NAMA UNIT KERJA',width:400}    
       ]],  
       onSelect:function(rowIndex,rowData){
           if (lcstatus == 'tambah'){
           $("#kdlokasi").attr("value",rowData.kd_uker.toUpperCase()+'.');
           }                 
       }  
     });   
    
   $('#kdskpd').combogrid({  
       panelWidth:500,  
       idField:'kd_skpd',  
       textField:'kd_skpd',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_msskpd',  
       columns:[[  
           {field:'kd_skpd',title:'KODE OPD',width:100},  
           {field:'nm_skpd',title:'NAMA OPD',width:400}    
       ]],
       onSelect:function(rowIndex,rowData){
        kd_skpd=rowData.kd_skpd;
        if(lcstatus == 'tambah'){
        $('#kduker').combogrid('clear');
        $('#kdlokasi').attr('value','');
        $('#kduker').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_uker_dh',
            queryParams:({skpd:kd_skpd})
        });
        } else{
          $('#kduker').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_uker_dh',
            queryParams:({skpd:kd_skpd})
        });
        }
       }
     });       
		
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/master/load_lokasi',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'kd_lokasi',title:'Kode Lokasi',width:15,align:"left"},
            {field:'kd_uker',title:'Kode Unit Kerja',width:15,align:"left"},
            {field:'nm_lokasi',title:'Nama Lokasi',width:30,align:"left"},
			{field:'kd_skpd',title:'Kode OPD',width:10,align:"left"},
			{field:'hapus',width:5,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus();'' />";}}
        ]],
        onSelect:function(rowIndex,rowData){
          lcidx = rowIndex;
          kdlok = rowData.kd_lokasi;
          nmlok = rowData.nm_lokasi;
          kduker  = rowData.kd_uker;
		      kdskpd  = rowData.kd_skpd;
      //alert(kdskpd);
          get(kdlok,nmlok,kduker,kdskpd);   
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
          lcidx = rowIndex;
          judul = 'Edit Data Lokasi'; 
          lcstatus = 'edit';
          kdlok = rowData.kd_lokasi;
          nmlok = rowData.nm_lokasi;
          kduker  = rowData.kd_uker; 
		      kdskpd  = rowData.kd_skpd;
          get(kdlok,nmlok,kduker,kdskpd); 
          edit_data();   
        }
        
        });
       
    });        

      
    function get(kdlok,nmlok,kduker,kdskpd){
        $("#kdlokasi").attr("value",kdlok);
        $("#nmlokasi").attr("value",nmlok);
        $("#kduker").combogrid("setValue",kduker);
        $("#kdskpd").combogrid("setValue",kdskpd);                
    }
    
    function kosong(){
        $("#kdlokasi").attr("value",'');
        $("#nmlokasi").attr("value",'');
        $("#kduker").combogrid("setValue",'');
		    $("#kdskpd").combogrid("setValue",''); 
    }
    
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    
    $(function(){
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/master/load_lokasi',
        queryParams:({cari:kriteria})
        });        
     });
    }
    
    function simpan(){
        
        var ckdlok = document.getElementById('kdlokasi').value;
        var cnmlok = document.getElementById('nmlokasi').value;
        var ckduker = $('#kduker').combogrid('getValue');
		var ckdskpd = $('#kdskpd').combogrid('getValue');
                        
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
	if (ckdskpd==''){
            alert('Kode Unit Kerja Tidak Boleh Kosong');
            exit();
        } 
		
        if(lcstatus=='tambah'){
            
            lcinsert = "(kd_lokasi,nm_lokasi,kd_uker,kd_skpd)";
            lcvalues = "('"+ckdlok+"','"+cnmlok+"','"+ckduker+"','"+ckdskpd+"')";
            
            
            $(document).ready(function(){
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>index.php/master/simpan_lokasi',
                    data: ({tabel:'mlokasi',kolom:lcinsert,nilai:lcvalues,cid:'kd_lokasi',lcid:ckdlok,cid2:'kd_skpd',cid3:'kd_uker',skpd:ckdskpd,kd_uker:ckduker}),
                    dataType:"json"
                });
            });    
            
            
        $('#dg').datagrid('appendRow',{kd_lokasi:ckdlok,nm_lokasi:cnmlok,kd_uker:ckduker,kd_skpd:ckdskpd});
        }else {
            
            lcquery = "UPDATE mlokasi SET nm_lokasi='"+cnmlok+"' where kd_lokasi='"+ckdlok+"' and kd_skpd='"+ckdskpd+"' and kd_uker='"+ckduker+"'";
            
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
                    kd_uker: ckduker,
					kd_skpd: ckdskpd  					
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
        document.getElementById("kdlokasi").focus();
        } 
     function keluar(){
        $("#dialog-modal").dialog('close');
     }    
    
     function hapus(){
        //var ckdlok = document.getElementById('kdlokasi').value;
        var rows = $('#dg').datagrid('getSelected');
        skpd=rows.kd_skpd;
        kd_lokasi=rows.kd_lokasi;
        kd_uker=rows.kd_uker;
//alert(skpd);
        var idx = $('#dg').datagrid('getRowIndex',rows); 
         if (kd_lokasi !=''){
		var del=confirm('Apakah Anda yakin ingin Menhapus data '+kd_lokasi+' di SKPD '+skpd+' ?');
		if (del==true){         
        var urll = '<?php echo base_url(); ?>index.php/master/del_lokasi';
        $(document).ready(function(){
         $.post(urll,({tabel:'mlokasi',cnid:kd_lokasi,cid:'kd_lokasi',cnid2:kd_uker,cid2:'kd_uker',cnid3:skpd,cid3:'kd_skpd'}),function(data){
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

    function cek_mlokasi(){
    var skpd = $('#kdskpd').combogrid('getValue');
    var kduker = $('#kduker').combogrid('getValue');
    var kdlokasi = document.getElementById('kdlokasi').value; 
if(lcstatus=='tambah'){
    $.ajax({
      type:'post',
      data:({skpd:skpd,kduker:kduker,kdlokasi:kdlokasi}),
      url :"<?php echo base_url(); ?>/index.php/master/cek_mlokasi",
      dataType:"json",
      success:function(data){
        $.each(data,function(i,n){
            var xxx = n['jumlah'];
            
            if(xxx==1){
              alert('Kode Bidang '+kdlokasi+' telah Terpakai  ..!!');
              
              document.getElementById('kdlokasi').focus();
              exit();
            }else{
               simpan(); 
            }
        });
      }
    });
}else{
    simpan();
}
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
    <p class="validateTips">Semua Inputan Harus Di Isi.</p> 
    <fieldset>
     <table align="center" style="width:100%;" border="0">
			<tr>
                <td>OPD</td>
                <td>:</td>
                <td><input id="kdskpd" name="kdskpd" style="width: 200px;" /></td>
           </tr>
           <tr>
                <td>KODE UNIT KERJA</td>
                <td>:</td>
                <td><input id="kduker" name="kduker" style="width: 200px;" /></td>
           </tr>
           <tr>
                <td width="30%">KODE LOKASI/SUB UNIT KERJA</td>
                <td width="1%">:</td>
                <td><input type="text" id="kdlokasi" name="kdlokasi" style="width:200px;"/></td>  
            </tr>            
            <tr>
                <td width="30%">NAMA LOKASI/SUB UNIT KERJA</td>
                <td width="1%">:</td>
                <td><input type="text" id="nmlokasi" name="nmlokasi" style="width:450px;"/></td>  
            </tr>
            <tr>
             <td colspan="4">&nbsp;</td>
            </tr>            
            <tr>
                <td colspan="4" align="center"><a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:cek_mlokasi();">Simpan</a>
		        <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Kembali</a>
                </td>                
            </tr>
        </table>  
            
    </fieldset> 
</div>

