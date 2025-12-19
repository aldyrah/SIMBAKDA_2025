
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
     
     $('#kdubidskpd').combogrid({  
       panelWidth:550,  
       idField:'kd_uskpd',  
       textField:'kd_uskpd',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_skpd2',  
       columns:[[  
           {field:'kd_uskpd',title:'KODE UNIT BIDANG',width:100},  
           {field:'nm_uskpd',title:'NAMA UNIT BIDANG',width:350},
           {field:'kd_skpd',title:'OPD',width:100}    
       ]],  
       onSelect:function(rowIndex,rowData){
           if (lcstatus == 'tambah'){
           $("#kdunit").attr("value",rowData.kd_uskpd.toUpperCase()+'.');
           $('#kd_skpd').attr('value',rowData.kd_skpd);
           }                 
       }  
     });   
        
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/master/load_unit_kerja',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'kd_uker',
    		title:'Kode Unit Kerja',
    		width:15,
            align:"center"},
            {field:'nm_uker',
    		title:'Nama Unit Kerja',
    		width:40,
            align:"left"},
            {field:'kd_uskpd',
    		title:'Kode Unit Bidang',
    		width:15,
            align:"center"},
            {field:'kd_skpd',
        title:'Kode SKPD',
        width:15,hidden:true,
            align:"center"},
			{field:'hapus',width:5,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus();'' />";}}
        ]],
        onSelect:function(rowIndex,rowData){
          lcidx = rowIndex;
          kdunit = rowData.kd_uker;
          nmunit = rowData.nm_uker;
          kdubidskpd  = rowData.kd_uskpd;
          lcalamat = rowData.alamat;
          kd_skpd = rowData.kd_skpd;

          get(kdunit,nmunit,kdubidskpd,lcalamat,kd_skpd);   
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
          lcidx = rowIndex;
          judul = 'Edit Data Unit Kerja'; 
          lcstatus = 'edit';
          kdunit = rowData.kd_uker;
          nmunit = rowData.nm_uker;
          kdubidskpd  = rowData.kd_uskpd;
          lcalamat = rowData.alamat;
          kd_skpd = rowData.kd_skpd;
          get(kdunit,nmunit,kdubidskpd,lcalamat,kd_skpd);  
          edit_data();   
        }
        
        });
       
    });        

      
    function  get(kdunit,nmunit,kdubidskpd,lcalamat,kd_skpd){
        $("#kdunit").attr("value",kdunit);
        $("#nmunit").attr("value",nmunit);
        $("#kdubidskpd").combogrid("setValue",kdubidskpd);
        $("#alamat").attr("value",lcalamat);
        $('#kd_skpd').attr('value',kd_skpd);
                       
    }
    
    function kosong(){
        $("#kdunit").attr("value",'');
        $("#nmunit").attr("value",'');
        $("#kdubidskpd").combogrid("setValue",'');
        $("#alamat").attr("value",'');
        $('#kd_skpd').attr('value','');
    }
    
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    
    $(function(){
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/master/load_unit_kerja',
        queryParams:({cari:kriteria})
        });        
     });
    }
    
    function simpan(){
        
        var ckdunit = document.getElementById('kdunit').value;
        var cnmunit = document.getElementById('nmunit').value;
        var ckdbidskpd = $('#kdubidskpd').combogrid('getValue');
        var calamat = document.getElementById('alamat').value;
        var kd_skpd = document.getElementById('kd_skpd').value;
                        
        if (ckdunit==''){
            alert('Kode Unit Tidak Boleh Kosong');
            exit();
        } 
        
        if (cnmunit==''){
            alert('Nama Unit Tidak Boleh Kosong');
            exit();
        } 
        
        if (ckdbidskpd==''){
            alert('Bidang Tidak Boleh Kosong');
            exit();
        } 

        if(lcstatus=='tambah'){
            
            lcinsert = "(kd_uker,nm_uker,kd_uskpd,alamat,kd_skpd)";
            lcvalues = "('"+ckdunit+"','"+cnmunit+"','"+ckdbidskpd+"','"+calamat+"','"+kd_skpd+"')";
            
            
            $(document).ready(function(){
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>index.php/master/simpan_unitbidang',
                    data: ({tabel:'unit_kerja',kolom:lcinsert,nilai:lcvalues,cid:'kd_uker',lcid:ckdunit,cid2:'kd_skpd',skpd:kd_skpd}),
                    dataType:"json"
                });
            });    
            
            
        $('#dg').datagrid('appendRow',{kd_uker:ckdunit,nm_uker:cnmunit,kd_uskpd:ckdbidskpd,alamat:calamat,kd_skpd:kd_skpd});
        }else {
            
            lcquery = "UPDATE unit_kerja SET nm_uker='"+cnmunit+"',kd_uskpd='"+ckdbidskpd+"', alamat='"+calamat+"' where kd_uker='"+ckdunit+"' AND kd_skpd='"+kd_skpd+"'";
            
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
            		kd_uker: ckdunit,
            		nm_uker: cnmunit,
                    kd_uskpd: ckdbidskpd,
                    alamat:calamat,
                    kd_skpd:kd_skpd             
            	}
            });
        }
       
        
        alert("Data Berhasil disimpan");
        $("#dialog-modal").dialog('close');
        //section1();
    } 
    
      function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data Unit Kerja';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        document.getElementById("kdunit").disabled=true;
        }    
        
    
     function tambah(){
        lcstatus = 'tambah';
        judul = 'Input Data Unit Kerja';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
        $("#dialog-modal").dialog('open');
        document.getElementById("kdunit").disabled=false;
        document.getElementById("kdubidskpd").focus();
        } 
     function keluar(){
        $("#dialog-modal").dialog('close');
     }    
    
     function hapus(){
        //var ckdunit = document.getElementById('kdunit').value;
        //var kd_skpd= document.getElementById('kd_skpd').value;
        var rows = $('#dg').datagrid('getSelected');
        skpd=rows.kd_skpd;
        ckdunit=rows.kd_uker;
        var idx = $('#dg').datagrid('getRowIndex',rows); 
         if (ckdunit !=''){
		var del=confirm('Apakah Anda yakin ingin Menhapus data '+ckdunit+' di SKPD '+skpd+' ?');
		if (del==true){       
        var urll = '<?php echo base_url(); ?>index.php/master/del_ubid';
        $(document).ready(function(){
         $.post(urll,({tabel:'unit_kerja',cnid:ckdunit,cid:'kd_uker',cid2:'kd_skpd',skpd:skpd}),function(data){
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

    function cek_kd_unit_kerja(){
    var kdunit = document.getElementById('kdunit').value;
    var bidang = $('#kdubidskpd').combogrid('getValue');
    var kd_skpd= document.getElementById('kd_skpd').value; 
if(lcstatus=='tambah'){
    $.ajax({
      type:'post',
      data:({kdunit:kdunit,bidang:bidang,kd_skpd:kd_skpd}),
      url :"<?php echo base_url(); ?>/index.php/master/cek_kd_unit_kerja",
      dataType:"json",
      success:function(data){
        $.each(data,function(i,n){
            var xxx = n['jumlah'];
            
            if(xxx==1){
              alert('Kode Unit Kerja '+kdunit+' telah Terpakai  ..!!');
              
              document.getElementById('kdunit').focus();
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
<h3 align="center"><u><b><a>INPUTAN UNIT KERJA</a></b></u></h3>
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
        <table id="dg" align="center" title="LISTING DATA UNIT KERJA" style="width:900px;height:365px;" >  
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
                <td>UNIT BIDANG</td>
                <td>:</td>
                <td><input id="kdubidskpd" name="kdubidskpd" style="width: 150px;" />&nbsp;&nbsp;<input type="text" id="kd_skpd" name="kd_skpd" style="width: 150px;" disabled="true" /></td>
           </tr>
           <tr>
                <td width="20%">KODE UNIT KERJA</td>
                <td width="1%">:</td>
                <td><input type="text" id="kdunit" style="width:150px;"/></td>  
            </tr>            
            <tr>
                <td width="20%">NAMA UNIT KERJA</td>
                <td width="1%">:</td>
                <td><input type="text" id="nmunit" style="width:450px;"/></td>  
            </tr>
            <tr>
                <td>ALAMAT</td>
                <td width="1%">:</td>
                <td><textarea rows="2" cols="50" id="alamat" style="width: 450px;"></textarea>
                </td> 
            </tr>
            <tr>
             <td colspan="4">&nbsp;</td>
            </tr>            
            <tr>
                <td colspan="4" align="center"><a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:cek_kd_unit_kerja();">Simpan</a>
		        <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Kembali</a>
                </td>                
            </tr>
        </table>  
            
    </fieldset> 
</div>

