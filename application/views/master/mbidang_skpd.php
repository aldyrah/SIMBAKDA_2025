
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
       url:'<?php echo base_url(); ?>index.php/master/ambil_msskpd',  
       columns:[[  
           {field:'kd_skpd',title:'KODE OPD',width:100},  
           {field:'nm_skpd',title:'NAMA OPD',width:400}    
       ]],
       onSelect:function(rowIndex,rowData){
            $('#nmskpd').attr('value',rowData.nm_skpd);
       }
     });   
        
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/master/load_bidang_skpd',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'kd_bidskpd',
    		title:'Kode Bidang',
    		width:15,
            align:"center"},
            {field:'nm_bidskpd',
    		title:'Nama Bidang',
    		width:40,
            align:"left"},
            {field:'kd_skpd',
    		title:'Kode OPD',
    		width:15,
            align:"center"},
			{field:'hapus',width:5,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus();'' />";}}
        ]],
        onSelect:function(rowIndex,rowData){
          lcidx = rowIndex;
          kdbid = rowData.kd_bidskpd;
          nmbid = rowData.nm_bidskpd;
          kdskpd  = rowData.kd_skpd
          get(kdbid,nmbid,kdskpd);   
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
          lcidx = rowIndex;
          judul = 'Edit Data Bidang'; 
          lcstatus = 'edit';
          kdbid = rowData.kd_bidskpd;
          nmbid = rowData.nm_bidskpd;
          kdskpd  = rowData.kd_skpd
          get(kdbid,nmbid,kdskpd); 
          edit_data();   
        }
        
        });
       
    });        

      
    function get(kdbid,nmbid,kdskpd){
        $("#kdbid").attr("value",kdbid);
        $("#nmbid").attr("value",nmbid);
        $("#kdskpd").combogrid("setValue",kdskpd);               
    }
    
    function kosong(){
        $("#kdbid").attr("value",'');
        $("#nmbid").attr("value",'');
        $("#kdskpd").combogrid("setValue",'');
    }
    
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    
    $(function(){
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/master/load_bidang_skpd',
        queryParams:({cari:kriteria})
        });        
     });
    }
    
    function simpan(){
        
        var ckdbid = document.getElementById('kdbid').value;
        var cnmbid = document.getElementById('nmbid').value;
        var ckdskpd = $('#kdskpd').combogrid('getValue');
                        
        if (ckdbid==''){
            alert('Kode Bidang Tidak Boleh Kosong');
            exit();
        } 
        
        if (cnmbid==''){
            alert('Nama Bidang Tidak Boleh Kosong');
            exit();
        } 
        
        if (ckdskpd==''){
            alert('Kelompok Tidak Boleh Kosong');
            exit();
        } 

        if(lcstatus=='tambah'){
            
            lcinsert = "(kd_bidskpd,nm_bidskpd,kd_skpd)";
            lcvalues = "('"+ckdbid+"','"+cnmbid+"','"+ckdskpd+"')";
            
            
            $(document).ready(function(){
                $.ajax({
                    type: "POST",
                    //url: '<?php echo base_url(); ?>index.php/master/simpan_master',
                    //data: ({tabel:'mbidskpd',kolom:lcinsert,nilai:lcvalues,cid:'kd_bidskpd',lcid:ckdbid}),
                    url: '<?php echo base_url(); ?>index.php/master/simpan_mbidang',
                    data: ({tabel:'mbidskpd',kolom:lcinsert,nilai:lcvalues,cid:'kd_bidskpd',lcid:ckdbid,skpd:ckdskpd}),
                    dataType:"json"
                });
            });    
            
            
        $('#dg').datagrid('appendRow',{kd_bidskpd:ckdbid,nm_bidskpd:cnmbid,kd_skpd:ckdskpd});
        }else{
            
            lcquery = "UPDATE mbidskpd SET nm_bidskpd='"+cnmbid+"',kd_skpd='"+ckdskpd+"' where kd_bidskpd='"+ckdbid+"'";
            
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
            		kd_bidskpd: ckdbid,
            		nm_bidskpd: cnmbid,
                    kd_skpd: ckdskpd             
            	}
            });
        }
       
        
        alert("Data Berhasil disimpan");
        $("#dialog-modal").dialog('close');
        //section1();
    }

    function cek_kd_bidang(){
    var kdbid = document.getElementById('kdbid').value;
    var skpd = $('#kdskpd').combogrid('getValue'); 

if(lcstatus=='tambah'){
    $.ajax({
      type:'post',
      data:({kd_bid:kdbid,kd_skpd:skpd}),
      url :"<?php echo base_url(); ?>/index.php/master/cek_kd_bidang",
      dataType:"json",
      success:function(data){
        $.each(data,function(i,n){
            var xxx = n['jumlah'];
            
            if(xxx==1){
              alert('Kode Bidang '+kdbid+' telah Terpakai  ..!!');
              
              document.getElementById('kdbid').focus();
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
        document.getElementById("kdskpd").focus();
        $('#nmskpd').attr('value','');
        } 
     function keluar(){
        $("#dialog-modal").dialog('close');
     }    
    
     function hapus(){
        var ckdbid = document.getElementById('kdbid').value;
        var skpd = $('#kdskpd').combogrid('getValue');
        
         if (ckdbid !=''){
		var del=confirm('Apakah Anda yakin ingin Menhapus data '+ckdbid+' di SKPD '+skpd+' ?');
		if (del==true){          
        var urll = '<?php echo base_url(); ?>index.php/master/del_bid';
        $(document).ready(function(){
         $.post(urll,({tabel:'mbidskpd',cnid:ckdbid,cid:'kd_bidskpd',cid2:'kd_skpd',skpd:skpd}),function(data){
            status = data;
            if (status=='0'){
                alert('Gagal Hapus..!!');
                exit();
            } else {
                $('#dg').datagrid('deleteRow',lcidx);   
                alert('Data Berhasil Dihapus..!!');
                exit();
                $('#dg').edatagrid('reload');

            }
         });
        });    }}
    } 
    
    
  
   </script>



<div id="content1"> 
<h3 align="center"><u><b><a>INPUTAN BIDANG OPD</a></b></u></h3>
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
        <table id="dg" align="center" title="LISTING DATA BIDANG OPD" style="width:900px;height:365px;" >  
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
                <td><input id="kdskpd" name="kdskpd" style="width: 100px;" />&nbsp;&nbsp;&nbsp;<input id="nmskpd" name="nmskpd" style="width: 300px;border:0;" /></td>
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
                <td colspan="3" align="center"><a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:cek_kd_bidang();">Simpan</a>
		        <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Kembali</a>
                </td>                
            </tr>
        </table>  
            
    </fieldset> 
</div>

