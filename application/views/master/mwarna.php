  	
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
    
        
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/master/load_warna',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'kd_warna',
    		title:'Kode warna',
    		width:15,
            align:"left"},
            {field:'nm_warna',
    		title:'Nama warna',
    		width:40,
            align:"left"},
			{field:'hapus',width:5,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus();'' />";}}
        ]],
        onSelect:function(rowIndex,rowData){
          lcidx = rowIndex;
          kdwarna = rowData.kd_warna;
          nmwarna = rowData.nm_warna;
          get(kdwarna,nmwarna);   
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
          lcidx = rowIndex;
          judul = 'Edit Data warna'; 
          lcstatus = 'edit';
          kdwarna = rowData.kd_warna;
          nmwarna = rowData.nm_warna;
          get(kdwarna,nmwarna);  
          edit_data();   
        }
        
        });
       
    });        

      
    function  get(kdwarna,nmwarna){
        $("#kdwarna").attr("value",kdwarna);
        $("#nmwarna").attr("value",nmwarna);                       
    }
    
    function kosong(){
        $("#kdwarna").attr("value",'');
        $("#nmwarna").attr("value",'');
		max_rinci();
    }
    
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    
    $(function(){
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/master/load_warna',
        queryParams:({cari:kriteria})
        });        
     });
    }
    
    function simpan(){
        
        var ckdwarna = document.getElementById('kdwarna').value;
        var cnmwarna = document.getElementById('nmwarna').value;
                        
        if (ckdwarna==''){
            alert('Kode warna Tidak Boleh Kosong');
            exit();
        } 
        
        if (cnmwarna==''){
            alert('Nama warna Tidak Boleh Kosong');
            exit();
        } 
        

        if(lcstatus=='tambah'){
            
            lcinsert = "(kd_warna,nm_warna)";
            lcvalues = "('"+ckdwarna+"','"+cnmwarna+"')";
            
            
            $(document).ready(function(){
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>index.php/master/simpan_master',
                    data: ({tabel:'mwarna',kolom:lcinsert,nilai:lcvalues,cid:'kd_warna',lcid:ckdwarna}),
                    dataType:"json"
                });
            });    
            
            
        $('#dg').datagrid('appendRow',{kd_warna:ckdwarna,nm_warna:cnmwarna});
        }else {
            
            lcquery = "UPDATE mwarna SET nm_warna='"+cnmwarna+"' where kd_warna='"+ckdwarna+"'";
            
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
            		nm_warna: cnmwarna    
            	}
            });
        }
       
        
        alert("Data Berhasil disimpan");
        $("#dialog-modal").dialog('close');
    } 
    
      function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data warna';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        document.getElementById("kdwarna").disabled=true;
        }    
        
    
     function tambah(){
        lcstatus = 'tambah';
        judul = 'Input Data warna';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
        $("#dialog-modal").dialog('open');
        document.getElementById("kdwarna").disabled=false;
        document.getElementById("nmwarna").focus();
        } 
     function keluar(){
        $("#dialog-modal").dialog('close');
     }    
    
     function hapus(){
        var ckdwarna = document.getElementById('kdwarna').value;
               if (ckdwarna !=''){
		var del=confirm('Apakah Anda yakin ingin Menhapus data '+ckdwarna+'?');
		if (del==true){
        $(document).ready(function(){
        var urll = '<?php echo base_url(); ?>index.php/master/hapus_master';
         $.post(urll,({tabel:'mwarna',cnid:ckdwarna,cid:'kd_warna'}),function(data){
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
    
    function tambah_urut(angka,panjang){
        no=((angka)*1);
        a=no.toString();
        jnol=panjang-a.length;
        nol='';
        for(i=1;i<=jnol;i++){
        nol=nol+'0';
        }
        b= nol+a;
        return b;
    }
		 
	function max_rinci(){ 
		$.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>index.php/master/master_max',
            data: ({table:'mwarna',kolom:'kd_warna'}),
            dataType:"json",
            success:function(data){                                          
                $.each(data,function(i,n){                                    
                    no_urut       = n['no_urut']; 
					nomorku		  = tambah_urut(no_urut,3); 	
					$("#kdwarna").attr("value",nomorku);
                });
            }
        }); 
	 }
   </script>



<div id="content1"> 
<h2 align="center"><b>INPUTAN MASTER DATA WARNA</b></h2>
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
        <table id="dg" align="center" title="LISTING DATA WARNA" style="width:900px;height:365px;" >  
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
                <td width="30%">KODE WARNA</td>
                <td width="1%">:</td>
                <td><input type="text" id="kdwarna" style="width:100px;"/></td>  
            </tr>            
            <tr>
                <td width="30%">NAMA WARNA</td>
                <td width="1%">:</td>
                <td><input type="text" id="nmwarna" style="width:450px;"/></td>  
            </tr>
            <tr>
             <td colspan="4">&nbsp;</td>
            </tr>            
            <tr>
                <td colspan="4" align="center"><a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:simpan();">Simpan</a>
		        <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Kembali</a>
                </td>                
            </tr>
        </table>  
            
    </fieldset> 
</div>

