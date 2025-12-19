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
		url: '<?php echo base_url(); ?>index.php/simpl/load_kegiatan',
        idField:'kode',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'kd_kegiatan',title:'Kode Kegiatan',width:15,align:"center"},
            {field:'nm_kegiatan',title:'Nama Kegiatan',width:40},
            {field:'bagian',title:'Kode Bagian',width:15,align:"center"},
			{field:'hapus',width:5,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus();'' />";}}
        ]],
        onSelect:function(rowIndex,rowData){
          lcidx = rowIndex;
          kode = rowData.kd_kegiatan;
          nama = rowData.nm_kegiatan;
          singkatan = rowData.bagian; 
          get(kode,nama,singkatan);   
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
          lcidx = rowIndex;
          judul = 'Edit Data Bagian'; 
          lcstatus = 'edit';
          kode = rowData.kd_kegiatan;
          nama = rowData.nm_kegiatan;
          singkatan = rowData.bagian; 
          get(kode,nama,singkatan);   
          edit_data();   
        }
        
        });
       
	$('#singkatan').combogrid({  
       panelWidth:440,  
       panelHeight:260,  
       idField:'kode',  
       textField:'kode',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/simpl/load_bagian',  
       columns:[[  
           {field:'kode',title:'KODE ',width:80},  
           {field:'nama',title:'NAMA',width:280},
           {field:'singkatan',title:'SINGKATAN ',width:80}    
       ]],
		onSelect:function(rowIndex,rowData){
          lcidx  		 = rowIndex;
          kode 	 		 = rowData.kode;  
          nama 	 		 = rowData.nama;   
          singkatan 	 = rowData.singkatan;
          $("#nmsingkatan").attr("value",nama.toUpperCase());
                                       
        } 
     }); 
	   
    });        

      
    function get(kode,nama,singkatan){
        $("#kode").attr("value",kode);
        $("#nama").attr("value",nama);
        $("#singkatan").combogrid("setValue",singkatan);                  
    }
    
       
    function kosong(){
        $("#kode").attr("value",'');
        $("#nama").attr("value",'');
        $("#nmsingkatan").attr("value",'');
        $("#singkatan").combogrid("setValue",'');  
    }
    
    
   function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    $(function(){
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/simpl/load_bagian',
        queryParams:({cari:kriteria})
        });        
     });
    }
    
    function simpan(){
		var thn   = '<?php echo ($this->session->userdata('ta_simbakda')); ?>';
		var skpd  = '<?php echo ($this->session->userdata('skpd')); ?>';
        var ckode = document.getElementById('kode').value;
        var cnama = document.getElementById('nama').value;
        var csingkatan = $('#singkatan').combogrid('getValue');
				if (ckode==''){
                    alert('Kode Bagian Tidak Boleh Kosong');
                    exit();
                } 
                
                if (cnama==''){
                    alert('Nama Bagian Tidak Boleh Kosong');
                    exit();
                } 
                
                /* if (csingkatan==''){
                    alert('Kode Singkatan Tidak Boleh Kosong');
                    exit();
                }  */
        
                if(lcstatus=='tambah'){
                    lcinsert = "(kode,nama,organisasi,tahun,bagian)";
                    lcvalues = "('"+ckode+"','"+cnama+"','"+skpd+"','"+thn+"','"+csingkatan+"')";
                    
                    $(document).ready(function(){
                        $.ajax({
                            type: "POST",
                            url: '<?php echo base_url(); ?>index.php/simpl/simpan_master',
                            data: ({tabel:'m_kegiatan',kolom:lcinsert,nilai:lcvalues,cid:'kode',lcid:ckode}),
                            dataType:"json"
                        });
                    });    
                    
                $('#dg').datagrid('appendRow',{kode:ckode,nama:cnama,singkatan:csingkatan});
                }else {
                    
                    lcquery = "UPDATE m_kegiatan SET tahun='"+thn+"',nama='"+cnama+"',bagian='"+csingkatan+"' where kode='"+ckode+"' and organisasi='"+skpd+"'";
                    
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
                            singkatan: csingkatan                
                    	}
                    });
                }
               
                alert("Data Berhasil disimpan");
                $("#dg").edatagrid('reload');
                $("#dialog-modal").dialog('close');
                    
       

    } 
    
      function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data Kegiatan';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        document.getElementById("kode").disabled=true;
        }    
        
    function nomer_akhir(){
        var i 		= 0; 
		var skpd    = '<?php echo ($this->session->userdata('skpd')); ?>';
		var table   = 'mbagian_bidang';
		var kode    = 'kode';
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>index.php/simpl/load_idmax',
            data: ({table:table,kolom:kode,skpd:skpd}),
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
        judul = 'Input Data Kegiatan';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
        $("#dialog-modal").dialog('open');
        document.getElementById("kode").disabled=false;
        document.getElementById("kode").focus();
        } 
     function keluar(){
        $("#dialog-modal").dialog('close');
     }    
    
     function hapus(){
		var thn   	= '<?php echo ($this->session->userdata('ta_simbakda')); ?>';
		var skpd  	= '<?php echo ($this->session->userdata('skpd')); ?>'; 
        var ckode = document.getElementById('kode').value;
		if(ckode !=''){
		var del = confirm("apakah anda ingin menghapus data kode "+ckode+"?");
		if(del=true){
		lcquery = "delete from m_kegiatan where kode='"+ckode+"' and organisasi='"+skpd+"'";
        var urll = '<?php echo base_url(); ?>index.php/simpl/hapus_master2';
        $(document).ready(function(){
         $.post(urll,({tabel:'m_kegiatan',cnid:ckode,cid:'kode',st_query:lcquery}),function(data){
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
    
function getkey(e){
	if (window.event)
		return window.event.keyCode;
	else if (e)
		return e.which;
	else
    return null;
	}
function angkadanhuruf(e, goods, field){
	var angka, karakterangka;
	angka = getkey(e);
	if (angka == null) return true;
	karakterangka = String.fromCharCode(angka);
	karakterangka = karakterangka.toLowerCase();
	goods = goods.toLowerCase();
	// check goodkeys
	if (goods.indexOf(karakterangka) != -1)
    return true;
	// control angka
	if ( angka==null || angka==0 || angka==8 || angka==9 || angka==27 )
   return true;
	if (angka == 13) {
    var i;
    for (i = 0; i < field.form.elements.length; i++)
        if (field == field.form.elements[i])
            break;
    i = (i + 1) % field.form.elements.length;
    field.form.elements[i].focus();
    return false;
    };
	// else return false
	return false;
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
<h2 align="center"><b>DAFTAR KEGIATAN</b></h2>
    <div align="center">
    <p>     
    <table style="width:400px;" border="0">
        <tr>
        <td width="10%">
        <a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:tambah();">Tambah</a></td>               
        <td width="5%"><a class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="javascript:cari();">Cari</a></td>
        <td><input type="text" value="" id="txtcari" style="width:300px;"/></td>
        </tr>
        <tr>
        <td colspan="4">
        <table id="dg" align="center" title="LISTING DATA KEGIATAN" style="width:900px;height:365px;" >  
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
                <td width="30%">KODE KEGIATAN</td>
                <td width="1%">:</td>
				<td><input type="text" id="kode" name="kode" maxlength='10' style="width:100px;"/></td>  
            </tr> 
            <tr>
                <td width="30%">NAMA KEGIATAN</td>
                <td width="1%">:</td>
                <td><input type="text" id="nama" style="width:360px;" /></td>  
			</tr>           
            <tr>
                <td width="30%">KODE BAGIAN</td>
                <td width="1%">:</td>
                <td><input type="text" id="singkatan" style="width:100px;"/><input type="text" id="nmsingkatan" style="border:0; width:100px;"/></td>  
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

