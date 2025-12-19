  	
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
		url: '<?php echo base_url(); ?>index.php/master/load_satuan',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'kd_satuan',
    		title:'Kode Satuan',
    		width:15,
            align:"left"},
            {field:'nm_satuan',
    		title:'Nama Satuan',
    		width:40,
            align:"left"},
			{field:'hapus',width:5,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus();'' />";}}
        ]],
        onSelect:function(rowIndex,rowData){
          lcidx = rowIndex;
          kdsatuan = rowData.kd_satuan;
          nmsatuan = rowData.nm_satuan;
          get(kdsatuan,nmsatuan);   
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
          lcidx = rowIndex;
          judul = 'Edit Data Satuan'; 
          lcstatus = 'edit';
          kdsatuan = rowData.kd_satuan;
          nmsatuan = rowData.nm_satuan;
          get(kdsatuan,nmsatuan);  
          edit_data();   
        }
        
        });
       
    });        

      
    function  get(kdsatuan,nmsatuan){
        $("#kdsatuan").attr("value",kdsatuan);
        $("#nmsatuan").attr("value",nmsatuan);                       
    }
    
    function kosong(){
        $("#kdsatuan").attr("value",'');
        $("#nmsatuan").attr("value",'');
		max_rinci();
    }
    
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    
    $(function(){
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/master/load_satuan',
        queryParams:({cari:kriteria})
        });        
     });
    }
    
    function simpan(){
        
        var ckdsatuan = document.getElementById('kdsatuan').value;
        var cnmsatuan = document.getElementById('nmsatuan').value;
                        
        if (ckdsatuan==''){
            alert('Kode Satuan Tidak Boleh Kosong');
            exit();
        } 
        
        if (cnmsatuan==''){
            alert('Nama Satuan Tidak Boleh Kosong');
            exit();
        } 
        

        if(lcstatus=='tambah'){
            
            lcinsert = "(kd_satuan,nm_satuan)";
            lcvalues = "('"+ckdsatuan+"','"+cnmsatuan+"')";
            
            
            $(document).ready(function(){
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>index.php/master/simpan_master',
                    data: ({tabel:'msatuan',kolom:lcinsert,nilai:lcvalues,cid:'kd_satuan',lcid:ckdsatuan}),
                    dataType:"json"
                });
            });    
            
            
        $('#dg').datagrid('appendRow',{kd_satuan:ckdsatuan,nm_satuan:cnmsatuan});
        }else {
            
            lcquery = "UPDATE msatuan SET nm_satuan='"+cnmsatuan+"' where kd_satuan='"+ckdsatuan+"'";
            
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
            		nm_satuan: cnmsatuan    
            	}
            });
        }
       
        
        alert("Data Berhasil disimpan");
        $("#dialog-modal").dialog('close');
    } 
    
      function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data Satuan';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        document.getElementById("kdsatuan").disabled=true;
        }    
        
    
     function tambah(){
        lcstatus = 'tambah';
        judul = 'Input Data Satuan';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
        $("#dialog-modal").dialog('open');
        document.getElementById("kdsatuan").disabled=true;
        document.getElementById("nmsatuan").focus();
        } 
     function keluar(){
        $("#dialog-modal").dialog('close');
     }    
    
     function hapus(){
        var ckdsatuan = document.getElementById('kdsatuan').value;
        if (ckdsatuan !=''){
		var del=confirm('Apakah Anda yakin ingin Menhapus data '+ckdsatuan+'?');
		if (del==true){
        var urll = '<?php echo base_url(); ?>index.php/master/hapus_master';
        $(document).ready(function(){
         $.post(urll,({tabel:'msatuan',cnid:ckdsatuan,cid:'kd_satuan'}),function(data){
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
            url: '<?php echo base_url(); ?>index.php/master/max_satuan',
            data: ({table:'msatuan',kolom:'kd_satuan'}),
            dataType:"json",
            success:function(data){                                          
                $.each(data,function(i,n){                                    
                    no_urut       = n['no_urut']; 
					nomorku		  = tambah_urut(no_urut,3); 	
					$("#kdsatuan").attr("value",no_urut);
                });
            }
        }); 
	 }
  
   </script>



<div id="content1"> 
<h2 align="center"><b>INPUTAN MASTER DATA SATUAN</b></h2>
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
        <table id="dg" align="center" title="LISTING DATA SATUAN" style="width:900px;height:365px;" >  
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
                <td width="30%">KODE SATUAN</td>
                <td width="1%">:</td>
                <td><input type="text" id="kdsatuan" style="width:100px;"/></td>  
            </tr>            
            <tr>
                <td width="30%">NAMA SATUAN</td>
                <td width="1%">:</td>
                <td><input type="text" id="nmsatuan" style="width:450px;"/></td>  
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

