    <script type="text/javascript">
    
    var kode= '';
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
		url: '<?php echo base_url(); ?>index.php/simpl/load_pajak',
        idField:'kode',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'kode',
    		title:'KODE PAJAK',
    		width:15,
            align:"center"},
            {field:'nama',
    		title:'NAMA PAJAK',
    		width:20},
            {field:'besar',
    		title:'BESAR',
    		width:20,
            align:"center"},
			{field:'ket',
    		title:'KETERANGAN',
    		width:30,
            align:"left"},
			{field:'hapus',width:5,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus();'' />";}}
        ]],
        onSelect:function(rowIndex,rowData){
          lcidx = rowIndex;
          kode = rowData.kode;
          nama = rowData.nama;
          besar = rowData.besar; 
		  ket = rowData.ket; 
          get(kode,nama,besar,ket);   
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
          lcidx = rowIndex;
          judul = 'Edit Data Pajak'; 
          lcstatus = 'edit';
          kode = rowData.kode;
          nama = rowData.nama;
          besar = rowData.besar; 
		  ket = rowData.ket;
          get(kode,nama,besar,ket);   
          edit_data();   
        }
        
        });
       
    });        

      
    function get(kode,nama,besar){
        $("#kode").attr("value",kode);
        $("#nama").attr("value",nama);
        $("#besar").attr("value",besar);  
		$("#ket").attr("value",ket); 		
    }
    
       
    function kosong(){
        $("#kode").attr("value",'');
        $("#nama").attr("value",'');
        $("#besar").attr("value",'');  
		$("#ket").attr("value",''); 
    }
    
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    
    $(function(){
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/simpl/load_Pajak',
        queryParams:({cari:kriteria})
        });        
     });
    }
    
    function simpan(){
        var ckode = document.getElementById('kode').value;
        var cnama = document.getElementById('nama').value;
        var cbesar = document.getElementById('besar').value;
        var cket = document.getElementById('ket').value;

         if (ckode==''){
                    alert('Kode Pajak Tidak Boleh Kosong');
                    exit();
                } 
                
                if (cnama==''){
                    alert('Nama Pajak Tidak Boleh Kosong');
                    exit();
                } 
                
                if (cbesar==''){
                    alert('besar Tidak Boleh Kosong');
                    exit();
                }
                if(lcstatus=='tambah'){
                    
                    lcinsert = "(kode,nama,besar,ket)";
                    lcvalues = "('"+ckode+"','"+cnama+"','"+cbesar+"','"+cket+"')";
                    
                    
                    $(document).ready(function(){
                        $.ajax({
                            type: "POST",
                            url: '<?php echo base_url(); ?>index.php/simpl/simpan_master',
                            data: ({tabel:'mpajak',kolom:lcinsert,nilai:lcvalues,cid:'kode',lcid:ckode}),
                            dataType:"json"
                        });
                    });    
                    
                    
                $('#dg').datagrid('appendRow',{kode:ckode,nama:cnama,besar:cbesar,ket:cket});
                }else {
                    
                    lcquery = "UPDATE mpajak SET nama='"+cnama+"',besar='"+cbesar+"',ket='"+cket+"' where kode='"+ckode+"'";
                    
        
                    $(document).ready(function(){
                    $.ajax({
                        type: "POST",
                        url: '<?php echo base_url(); ?>index.php/simpl/update_master',
                        data: ({st_query:lcquery}),
                        dataType:"json"
                    });
                    });
                    
                        $('#dg').datagrid('updateRow',{
                    	index: lcidx,
                    	row: {
                    		kode: ckode,
                    		nama: cnama,
                            besar: cbesar,
							ket: cket 							
                    	}
                    });
                }
               
                
                alert("Data Berhasil disimpan");
                $("#dialog-modal").dialog('close');
                    
       

    } 
    
      function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data Pajak';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        document.getElementById("kode").disabled=true;
        }    
        
     function nomer_akhir(){
        var i 		= 0; 
		//var skpd    = '<?php echo ($this->session->userdata('skpd')); ?>';
		var skpd	= '';
		var table   = 'mpajak';
		var kode    = 'kode';
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>index.php/simpl/load_idmax',
            data: ({table:table,kolom:kode}),
            dataType:"json",
            success:function(data){                                          
                $.each(data,function(i,n){                                    
                    kode      = n['kode'];   
                    $("#kode").attr("value",kode);                              
                });
            }
        });         
		}       

     function tambah(){
        lcstatus = 'tambah';
        judul = 'Input Data Pajak';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
        $("#dialog-modal").dialog('open');
        document.getElementById("kode").disabled=false;
        document.getElementById("besar").focus();
        } 
     function keluar(){
        $("#dialog-modal").dialog('close');
     }    
    
     function hapus(){
        var ckode = document.getElementById('kode').value; alert("asas");
        if (ckode != ''){
		var del= confirm("Apakah Anda Yakin ingin menghapus kode "+ckode+"??");
		if (del=true){
        var urll = '<?php echo base_url(); ?>index.php/simpl/hapus_master';
        $(document).ready(function(){
         $.post(urll,({tabel:'mpajak',cnid:ckode,cid:'kode'}),function(data){
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
   
   function isNumberKey(evt)
	{
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))

	return false;
	return true;
	}     
   
       
  
   </script>



<div id="content1"> 
<h2 align="center"><b>DAFTAR PAJAK</b></h2>
    <div align="center">
    <p>     
    <table style="width:400px;" border="0">
        <tr>
        <td width="10%">
        <a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:nomer_akhir();tambah()">Tambah</a></td>               
        <td width="5%"><a class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="javascript:cari();">Cari</a></td>
        <td><input type="text" value="" id="txtcari" style="width:300px;"/></td>
        </tr>
        <tr>
        <td colspan="4">
        <table id="dg" align="center" title="LISTING DATA PAJAK" style="width:900px;height:365px;" >  
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
                <td width="30%">KODE PAJAK</td>
                <td width="1%">:</td>
                <td><input type="text" id="kode" style="width:100px;" onkeypress="return isNumberKey(event)"/></td>  
            </tr>   
            <tr>
                <td width="30%">BESARAN</td>
                <td width="1%">:</td>
                <td><input type="text" id="besar" style="width:100px;"/></td>  
            </tr>         
            <tr>
                <td width="30%">PAJAK</td>
                <td width="1%">:</td>
                <td><input type="text" id="nama" style="width:360px;"/></td>  
            </tr>
			<tr>
                <td width="30%">KETERANGAN</td>
                <td width="1%">:</td>
                <td><textarea type="text" id="ket" style="width:360px; height: 30px;"></textarea></td>  
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

