  	
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
		url: '<?php echo base_url(); ?>index.php/master/load_pangkat',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'kd_pangkat',
    		title:'Kode Jabatan',
    		width:15,
            align:"left"},
            {field:'nm_pangkat',
    		title:'Nama Jabatan',
    		width:40,
            align:"left"},
			{field:'hapus',width:5,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus();'' />";}}
        ]],
        onSelect:function(rowIndex,rowData){
          lcidx = rowIndex;
          kdpangkat = rowData.kd_pangkat;
          nmpangkat = rowData.nm_pangkat;
          get(kdpangkat,nmpangkat);   
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
          lcidx = rowIndex;
          judul = 'Edit Data Jabatan'; 
          lcstatus = 'edit';
          kdpangkat = rowData.kd_pangkat;
          nmpangkat = rowData.nm_pangkat;
          get(kdpangkat,nmpangkat);  
          edit_data();   
        }
        
        });
       
    });        

      
    function  get(kdpangkat,nmpangkat){
        $("#kdpangkat").attr("value",kdpangkat);
        $("#nmpangkat").attr("value",nmpangkat);                       
    }
    
    function kosong(){
        $("#kdpangkat").attr("value",'');
        $("#nmpangkat").attr("value",'');
		max_rinci();
    }
    
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    
    $(function(){
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/master/load_pangkat',
        queryParams:({cari:kriteria})
        });        
     });
    }
    
    function simpan(){
        
        var ckdpangkat = document.getElementById('kdpangkat').value;
        var cnmpangkat = document.getElementById('nmpangkat').value;
                        
        if (ckdpangkat==''){
            alert('Kode pangkat Tidak Boleh Kosong');
            exit();
        } 
        
        if (cnmpangkat==''){
            alert('Nama pangkat Tidak Boleh Kosong');
            exit();
        } 
        

        if(lcstatus=='tambah'){
            
            lcinsert = "(kd_pangkat,nm_pangkat)";
            lcvalues = "('"+ckdpangkat+"','"+cnmpangkat+"')";
            
            
            $(document).ready(function(){
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>index.php/master/simpan_master',
                    data: ({tabel:'mpangkat',kolom:lcinsert,nilai:lcvalues,cid:'kd_pangkat',lcid:ckdpangkat}),
                    dataType:"json"
                });
            });    
            
            
        $('#dg').datagrid('appendRow',{kd_pangkat:ckdpangkat,nm_pangkat:cnmpangkat});
        }else {
            
            lcquery = "UPDATE mpangkat SET nm_pangkat='"+cnmpangkat+"' where kd_pangkat='"+ckdpangkat+"'";
            
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
            		nm_pangkat: cnmpangkat    
            	}
            });
        }
       
        
        alert("Data Berhasil disimpan");
        $("#dialog-modal").dialog('close');
    } 
    
      function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data pangkat';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        document.getElementById("kdpangkat").disabled=true;
        }    
        
    
     function tambah(){
        lcstatus = 'tambah';
        judul = 'Input Data pangkat';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
        $("#dialog-modal").dialog('open');
        document.getElementById("kdpangkat").disabled=false;
        document.getElementById("nmpangkat").focus();
        } 
     function keluar(){
        $("#dialog-modal").dialog('close');
     }    
    
     function hapus(){
        var ckdpangkat = document.getElementById('kdpangkat').value;
        if (ckdpangkat !=''){
		var del=confirm('Apakah Anda yakin ingin Menhapus data '+ckdpangkat+'?');
		if (del==true){
        var urll = '<?php echo base_url(); ?>index.php/master/hapus_master';
        $(document).ready(function(){
         $.post(urll,({tabel:'mpangkat',cnid:ckdpangkat,cid:'kd_pangkat'}),function(data){
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
            data: ({table:'mpangkat',kolom:'kd_pangkat'}),
            dataType:"json",
            success:function(data){                                          
                $.each(data,function(i,n){                                    
                    no_urut       = n['no_urut']; 
					nomorku		  = tambah_urut(no_urut,3); 
					$("#kdpangkat").attr("value",nomorku);
                });
            }
        }); 
	 }
  
   </script>



<div id="content1"> 
<h2 align="center"><b>INPUTAN MASTER DATA JABATAN</b></h2>
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
        <table id="dg" align="center" title="LISTING DATA JABATAN" style="width:900px;height:365px;" >  
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
                <td width="30%">KODE JABATAN</td>
                <td width="1%">:</td>
                <td><input type="text" id="kdpangkat" style="width:100px;"/></td>  
            </tr>            
            <tr>
                <td width="30%">NAMA JABATAN</td>
                <td width="1%">:</td>
                <td><input type="text" id="nmpangkat" style="width:450px;"/></td>  
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

