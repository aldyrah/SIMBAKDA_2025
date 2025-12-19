    <script type="text/javascript">
    
    var kode= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
                    
     $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
            height: 400,
            width: 800,
            modal: true,
            autoOpen:false,
        });
        });    
     
     $(function(){
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/simpl/load_pejabat',
        idField:'kode',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'kode',title:'KODE',width:5,align:"center"},
            {field:'nama',title:'NAMA',width:30,align:"left"},
            {field:'nip',title:'NIP',width:20,align:"center"},
            {field:'singkat',title:'SELAKU',width:15,align:"center"},
            {field:'jabatan',title:'JABATAN',width:30,align:"left"},
            {field:'pangkat',title:'PANGKAT',width:20,align:"left"},
			{field:'hapus',width:5,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus();'' />";}}
        ]],
        onSelect:function(rowIndex,rowData){
          lcidx   		= rowIndex;
          kode 	  		= rowData.kode;
          kd_skpd 		= rowData.kd_skpd;
          nama 	  		= rowData.nama;
          nip 	  		= rowData.nip;
          jabatan 		= rowData.jabatan;
          pangkat 		= rowData.pangkat;
          singkat 		= rowData.singkat;
          nama_singkat 	= rowData.nama_singkat; 
          bagian	 	= rowData.bagian;
          get(kode,kd_skpd,nama,nip,jabatan,pangkat,singkat,nama_singkat,bagian);   
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
          lcidx = rowIndex;
          judul = 'Edit Data Singkatan'; 
          lcstatus = 'edit';
          kode 	  		= rowData.kode;
          kd_skpd 		= rowData.kd_skpd;
          nama 	  		= rowData.nama;
          nip 	  		= rowData.nip;
          jabatan 		= rowData.jabatan;
          pangkat 		= rowData.pangkat;
          singkat 		= rowData.singkat;
          nama_singkat 	= rowData.nama_singkat;  
          bagian	 	= rowData.bagian;
          get(kode,kd_skpd,nama,nip,jabatan,pangkat,singkat,nama_singkat,bagian);   
          edit_data();   
        }
        
        });
       
	    $('#uskpd').combogrid({  
            panelWidth:500,  
			width:100, 
            idField:'kd_skpd',  
            textField:'kd_skpd',  
            mode:'remote',                      
            url:'<?php echo base_url(); ?>index.php/simpl/load_skpd',  
            columns:[[  
               {field:'kd_skpd',title:'KODE SKPD',width:100},  
               {field:'nm_skpd',title:'NAMA SKPD',width:400}    
            ]],  
            onSelect:function(rowIndex,rowData){
               cuskpd = rowData.kd_skpd;   
				$('#kd').combogrid({url:'<?php echo base_url(); ?>index.php/simpl/load_kegiatan',queryParams:({skpd:cuskpd}) });
                $('#nmuskpd').attr('value',rowData.nm_skpd);   
				
            } 	   
         }); 
		 
	    $('#singkat').combogrid({  
            panelWidth:500,  
			width:100, 
            idField:'singkatan',  
            textField:'singkatan',  
            mode:'remote',                      
            url:'<?php echo base_url(); ?>index.php/simpl/load_jabatan',  
            columns:[[  
               {field:'singkatan',title:'SINGKATAN',width:100},  
               {field:'nama',title:'NAMA SINGKATAN',width:400}    
            ]],  
            onSelect:function(rowIndex,rowData){
               csingkatan = rowData.singkatan;   
                $('#nama_singkat').attr('value',rowData.nama);   
				
            } 	   
         }); 
		 
	   $('#bagian').combogrid({  
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

      
    function get(kode,kd_skpd,nama,nip,jabatan,pangkat,singkat,nama_singkat,bagian){
		$('#uskpd').combogrid('setValue',kd_skpd);
        $("#kode").attr("value",kode);
        $("#nama").attr("value",nama);
        $("#nip").attr("value",nip);
        $("#jabatan").attr("value",jabatan);
        $("#pangkat").attr("value",pangkat);
		$('#singkat').combogrid('setValue',singkat);
        $("#nama_singkat").attr("value",nama_singkat); 
		$('#bagian').combogrid('setValue',bagian);                  
    }
    
       
    function kosong(){
		var skpd  = '<?php echo ($this->session->userdata('skpd')); ?>';
		$('#uskpd').combogrid('setValue',skpd);
        //$("#nmuskpd").attr("value",'');
        $("#nama").attr("value",'');
        $("#nip").attr("value",'');
        $("#jabatan").attr("value",'');
        $("#kode").attr("value",'');
        $("#pangkat").attr("value",'');
		$('#singkat').combogrid('setValue','');
        $("#nama_singkat").attr("value",''); 
		$('#bagian').combogrid('setValue',''); 
        $("#nmsingkatan").attr("value",''); 
    }
    
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    
    $(function(){
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/simpl/load_pejabat',
        queryParams:({cari:kriteria})
        });        
     });
    }
    //nama,nip,jabatan,pangkat,singkat,nama_singkat,kode,kd_skpd,
    function simpan(){		
		var thn   			= '<?php echo ($this->session->userdata('ta_simbakda')); ?>';
        var ckode 			= document.getElementById('kode').value;
		var csingkat 		= $('#singkat').combogrid('getValue');
        var cnama_singkat 	= document.getElementById('nama_singkat').value;
		var ckd_skpd 		= $('#uskpd').combogrid('getValue');
        var cnama 			= document.getElementById('nama').value;
        var cnip 			= document.getElementById('nip').value;
        var cjabatan		= document.getElementById('jabatan').value;
        var cpangkat 		= document.getElementById('pangkat').value;
		var cbagian 		= $('#bagian').combogrid('getValue');

				if (ckode==''){
                    alert('Kode Wilayah Tidak Boleh Kosong');
                    exit();
                } 
                
                if (csingkat==''){
                    alert('singkat Wilayah Tidak Boleh Kosong');
                    exit();
                } 
                
                if (cnama_singkat==''){
                    alert('Kode Provinsi Tidak Boleh Kosong');
                    exit();
                } 
                if (ckd_skpd==''){
                    alert('Kode SKPD Tidak Boleh Kosong');
                    exit();
                }
                if (cnama==''){
                    alert('Nama Tidak Boleh Kosong');
                    exit();
                }
                if (cnip==''){
                    alert('NIP Tidak Boleh Kosong');
                    exit();
                }
                if (cjabatan==''){
                    alert('Jabatan Tidak Boleh Kosong');
                    exit();
                }
                if (cpangkat==''){
                    alert('Pangkat Tidak Boleh Kosong');
                    exit();
                }
        
                if(lcstatus=='tambah'){
                    
                    lcinsert = "(kode,kd_skpd,tahun,singkat,nama_singkat,nama,jabatan,pangkat,nip,bagian)";
                    lcvalues = "('"+ckode+"','"+ckd_skpd+"','"+thn+"','"+csingkat+"','"+cnama_singkat+"','"+cnama+"','"+cjabatan+"','"+cpangkat+"','"+cnip+"','"+cbagian+"')";
                    
                    
                    $(document).ready(function(){
                        $.ajax({
                            type: "POST",
                            url: '<?php echo base_url(); ?>index.php/simpl/simpan_master',
                            data: ({tabel:'mpejabat',kolom:lcinsert,nilai:lcvalues,cid:'kode',lcid:ckode}),
                            dataType:"json"
                        });
                    });    
                    
                $('#dg').datagrid('appendRow',{kode:ckode,singkat:csingkat,nama_singkat:cnama_singkat});
                }else {
                    
                    lcquery = "UPDATE mpejabat SET tahun='"+thn+"',singkat='"+csingkat+"',nama_singkat='"+cnama_singkat+"',nama='"+cnama+"',jabatan='"+cjabatan+"',pangkat='"+cpangkat+"',nip='"+cnip+"',bagian='"+cbagian+"' where kode='"+ckode+"' and kd_skpd='"+ckd_skpd+"'";
                    
        
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
                    		singkat: csingkat,
                            nama_singkat: cnama_singkat                
                    	}
                    });
                }
               
                alert("Data Berhasil disimpan");
                $("#dg").edatagrid('reload');
                $("#dialog-modal").dialog('close');
                    
       

    } 
    
      function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data Pejabat';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        document.getElementById("kode").disabled=false;
        }    
        
       function nomer_akhir(){
        var i 		= 0; 
		var skpd    = '<?php echo ($this->session->userdata('skpd')); ?>';
		var table   = 'mpejabat';
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
        judul = 'Input Data Pejabat';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
        $("#dialog-modal").dialog('open');
        document.getElementById("kode").disabled=false;
        document.getElementById("nama").focus();
        } 
     function keluar(){
        $("#dialog-modal").dialog('close');
     }    
    
     function hapus(){		
		var thn   = '<?php echo ($this->session->userdata('ta_simbakda')); ?>';
		var skpd  = '<?php echo ($this->session->userdata('skpd')); ?>';
        var ckode = document.getElementById('kode').value; 
		if (ckode != ''){
		var del= confirm("apakah anda ingin menghapus kode "+ckode+"??");
		if (del=true){
		lcquery = "delete from mpejabat where kode='"+ckode+"' and kd_skpd='"+skpd+"'";
        var urll = '<?php echo base_url(); ?>index.php/simpl/hapus_master2';
        $(document).ready(function(){
         $.post(urll,({tabel:'mpejabat',cnid:ckode,cid:'kode',st_query:lcquery}),function(data){
            status = data;
            if (status=='0'){
                alert('Gagal Hapus..!!');
                exit();
            } else {
                $('#dg').datagrid('deleteRow',lcidx);  
                $('#dg').datagrid('reload');  
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
<h2 align="center"><b>DAFTAR PEJABAT</b></h2>
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
        <table id="dg" align="center" title="LISTING DATA WILAYAH" style="width:900px;height:365px;" >  
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
                <td width="30%">KODE</td>
                <td width="1%">:</td>
                <td><input type="text" id="kode" style="width:100px;" onkeypress="return isNumberKey(event)"/></td>  
            </tr>       
            <tr>
                <td width="30%">SKPD</td>
                <td width="1%">:</td>
                <td><input type="text" id="uskpd" style="width:100px;"/> <input type="text" style= "width:350px; border:none;" id="nmuskpd" /></td>  
            </tr>
            <tr>
                <td width="30%">NAMA</td>
                <td width="1%">:</td>
                <td><input type="text" id="nama" style="width:360px;" /></td>  
            </tr> 
            <tr>
                <td width="30%">NIP</td>
                <td width="1%">:</td>
                <td><input type="text" id="nip" style="width:100px;"/></td>  
            </tr> 
            <tr>
                <td width="30%">PANGKAT</td>
                <td width="1%">:</td>
                <td><input type="text" id="pangkat" style="width:360px;"/></td>  
            </tr>     
            <tr>
                <td width="30%">JABATAN</td>
                <td width="1%">:</td>
                <td><input type="text" id="jabatan" style="width:360px;"/></td>  
            </tr>  
            <tr>
                <td width="30%">SINGKATAN</td>
                <td width="1%">:</td>
                <td><input type="text" id="singkat" style="width:100px;" onKeyPress="return angkadanhuruf(event,'abcdefghijklmnopqrstuvwxyz',this)"/></td>  
            </tr>          
            <tr>
                <td width="30%">NAMA SINGKATAN</td>
                <td width="1%">:</td>
                <td><input type="text" id="nama_singkat" style="width:360px;"/></td>  
            </tr>           
            <tr>
                <td width="30%">KODE BAGIAN</td>
                <td width="1%">:</td>
                <td><input type="text" id="bagian" style="width:100px;"/><input type="text" id="nmsingkatan" style="border:0; width:100px;"/></td>  
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

