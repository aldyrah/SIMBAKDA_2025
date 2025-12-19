    <script type="text/javascript">
    
    var kode= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
                    
     $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
            height: 820,
            width: 800,
            modal: true,
            autoOpen:false,
        });
        });    
     
     $(function(){
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/simpl/load_rekanan',
        idField:'kode',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'kode',title:'Kode Rekanan',width:15,align:"center"},
            {field:'nama',title:'Nama Rekanan',width:20},
            {field:'pimpinan',title:'Nama Pimpinan',width:20,align:"left"},
			{field:'kantor',title:'Alamat Kantor',width:30,align:"left"},
			{field:'hapus',width:5,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus();'' />";}}
        ]],
        onSelect:function(rowIndex,rowData){
        lcidx 	= rowIndex;
		kode 			= rowData.kode;
		kd_skpd 		= rowData.kd_skpd;
		pimpinan 		= rowData.pimpinan;
		jabatan 		= rowData.jabatan;
		bentuk 			= rowData.bentuk;
		nama 			= rowData.nama;
		bank 			= rowData.bank;
		rekening 		= rowData.rekening;
		npwp 			= rowData.npwp;
		kantor 			= rowData.kantor;
		rumah 			= rowData.rumah;
		kota 			= rowData.kota;
		kodepos 		= rowData.kodepos;
		nama_perantara 	= rowData.nama_perantara;
		pimpinan_perantara	= rowData.pimpinan_perantara;
		rek_perantara 	= rowData.rek_perantara;
		ppn 			= rowData.ppn;
		pph 			= rowData.pph;
		ktp 			= rowData.ktp;
		bank_perantara 	= rowData.bank_perantara;
		jabat_perantara = rowData.jabat_perantara;
		notaris 		= rowData.notaris;
		no_notaris 		= rowData.no_notaris;
		tgl_notaris 	= rowData.tgl_notaris;
          get(kode,kd_skpd,pimpinan,jabatan,bentuk,nama,bank,rekening,npwp,kantor,rumah,kota,kodepos,nama_perantara,pimpinan_perantara,rek_perantara,ppn,pph,ktp,bank_perantara,jabat_perantara,notaris,no_notaris,tgl_notaris);   
        },
        onDblClickRow:function(rowIndex,rowData){
          lcidx 	= rowIndex;
          judul 	= 'Edit Data Rekanan'; 
          lcstatus 	= 'edit';
		kode 			= rowData.kode;
		kd_skpd			= rowData.kd_skpd;
		pimpinan 		= rowData.pimpinan;
		jabatan 		= rowData.jabatan;
		bentuk 			= rowData.bentuk;
		nama 			= rowData.nama;
		bank 			= rowData.bank;
		rekening 		= rowData.rekening;
		npwp 			= rowData.npwp;
		kantor 			= rowData.kantor;
		rumah 			= rowData.rumah;
		kota 			= rowData.kota;
		kodepos 		= rowData.kodepos;
		nama_perantara 	= rowData.nama_perantara;
		pimpinan_perantara	= rowData.pimpinan_perantara;
		rek_perantara 	= rowData.rek_perantara;
		ppn 			= rowData.ppn;
		pph 			= rowData.pph;
		ktp 			= rowData.ktp;
		bank_perantara 	= rowData.bank_perantara;
		jabat_perantara = rowData.jabat_perantara;
		notaris 		= rowData.notaris;
		no_notaris 		= rowData.no_notaris;
		tgl_notaris 	= rowData.tgl_notaris;
          get(kode,kd_skpd,pimpinan,jabatan,bentuk,nama,bank,rekening,npwp,kantor,rumah,kota,kodepos,nama_perantara,pimpinan_perantara,rek_perantara,ppn,pph,ktp,bank_perantara,jabat_perantara,notaris,no_notaris,tgl_notaris);   
          edit_data();   
        }
        });
       
		 $('#tgl_akta').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            }
         });
	   
	   $('#bentuk_per').combobox({           
        valueField:'nama',  
        textField:'nama',
        width:150,
        data:[{kode:'1',nama:'PT/NV'},{kode:'2',nama:'CV'},{kode:'3',nama:'FIRMA'},{kode:'4',nama:'LAIN-LAIN'}]
	});
	
	 $('#mbank').combogrid({  
           panelWidth:500,  
           idField:'kode',  
           textField:'kode',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/simpl/load_bank',  
           columns:[[  
               {field:'kode',title:'KODE BAGIAN',width:100},  
               {field:'nama',title:'NAMA BAGIAN',width:400}    
           ]],  
           onSelect:function(rowIndex,rowData){
               lcskpd = rowData.kode;
               $("#nama_bank").attr("value",rowData.nama.toUpperCase());
           }  
         }); 
	 $('#mbank1').combogrid({  
            panelWidth:250,  
			width:250,
            idField:'nama',  
            textField:'nama',  
            mode:'remote',                      
            url:'<?php echo base_url(); ?>index.php/simpl/load_bank',  
            columns:[[  
               {field:'kode',title:'Kode Bank',width:50},  
               {field:'nama',title:'Nama Bank',width:180}    
            ]],  
            onSelect:function(rowIndex,rowData){
               ckdbank = rowData.kode;               
               $('#nmbank').attr('value',rowData.nama);                               
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
	   
    });  
	
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
	
    function nomer_akhir(){
        var i 		= 0; 
		var skpd    = '<?php echo ($this->session->userdata('skpd')); ?>';
		var table   = 'mrekanan';
		var kode    = 'kode';
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>index.php/simpl/load_idmax',
            data: ({table:table,kolom:kode,skpd:skpd}),
            dataType:"json",
            success:function(data){                                          
                $.each(data,function(i,n){                                    
                    kode      = n['kode'];
					nomorku	  = tambah_urut(kode,4);    
                    $("#kode").attr("value",nomorku);                              
                });
            }
        });         
		}      

      
    function get(kode,kd_skpd,pimpinan,jabatan,bentuk,nama,bank,rekening,npwp,kantor,rumah,kota,kodepos,nama_perantara,
	pimpinan_perantara,rek_perantara,ppn,pph,ktp,bank_perantara,jabat_perantara,notaris,no_notaris,tgl_notaris){       
        $('#bentuk_per').combobox('setValue',bentuk);
        $('#uskpd').combogrid('setValue',kd_skpd);
        $('#mbank').combogrid('setValue',bank);
		$('#tgl_akta').datebox('setValue',tgl_notaris); 
        $("#kode").attr("value",kode);
        $("#nm_perusahaan").attr("value",nama);
        $("#pimpinan").attr("value",pimpinan);  
		$("#jabatan").attr("value",jabatan);  
        $("#no_rek").attr("value",rekening);
        $("#npwp").attr("value",npwp);
        $("#no_id").attr("value",ktp);  
		$("#almt_kntr").attr("value",kantor);  
        $("#almt_rmh").attr("value",rumah);
        $("#kota").attr("value",kota);
        $("#kd_pos").attr("value",kodepos);  
		$("#nm_notaris").attr("value",notaris); 
		$("#no_akta").attr("value",no_notaris);
		
        $("#peru_perantara").attr("value",nama_perantara); 
        $("#pim_perantara").attr("value",pimpinan_perantara);  
        $("#jab_pim_perantara").attr("value",jabat_perantara);  
        $("#bank_perantara").attr("value",rek_perantara);  
        $("#rek_bank_sulsel").attr("value",bank_perantara);    	
    }
    
    function kosong(){
		var skpd  = '<?php echo ($this->session->userdata('skpd')); ?>';
        $('#uskpd').combogrid('setValue',skpd);
        $('#bentuk_per').combobox('setValue','');
        $('#mbank').combogrid('setValue','');
		$('#tgl_akta').datebox('setValue',''); 
        $("#kode").attr("value",'');
        $("#nm_perusahaan").attr("value",'');
        $("#pimpinan").attr("value",'');  
		$("#jabatan").attr("value",'');  
        $("#no_rek").attr("value",'');
        $("#npwp").attr("value",'');
        $("#no_id").attr("value",'');  
		$("#almt_kntr").attr("value",'');  
        $("#almt_rmh").attr("value",'');
        $("#kota").attr("value",'');
        $("#kd_pos").attr("value",'');  
		$("#nm_notaris").attr("value",''); 
		$("#no_akta").attr("value",''); 
        $("#peru_perantara").attr("value",''); 
        $("#pim_perantara").attr("value",'');  
        $("#jab_pim_perantara").attr("value",'');  
        $("#bank_perantara").attr("value",'');  
        $("#rek_bank_sulsel").attr("value",'');  
        $('#nmuskpd').attr("value",'');   
        $('#nama_bank').attr("value",''); 
    }
    
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    
    $(function(){
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/simpl/load_rekanan',
        queryParams:({cari:kriteria})
        });        
     });
    }
    
    function simpan(){
        var kode 			= document.getElementById('kode').value;
		var kd_skpd 		= $('#uskpd').combogrid('getValue'); 
        var nm_perusahaan 	= document.getElementById('nm_perusahaan').value;
        var bentuk_per 		= $('#bentuk_per').combobox('getValue');
        var pimpinan 		= document.getElementById('pimpinan').value;
        var jabatan 		= document.getElementById('jabatan').value;
        var mbank 			= $('#mbank').combogrid('getValue');
        var no_rek 			= document.getElementById('no_rek').value;
        var npwp 			= document.getElementById('npwp').value;
        var no_id 			= document.getElementById('no_id').value;
        var almt_kntr 		= document.getElementById('almt_kntr').value;
        var almt_rmh 		= document.getElementById('almt_rmh').value;
        var kota 			= document.getElementById('kota').value;
        var kd_pos 			= document.getElementById('kd_pos').value;
        var nm_notaris 		= document.getElementById('nm_notaris').value;
        var no_akta			= document.getElementById('no_akta').value;
		var tgl_akta 		= $('#tgl_akta').datebox('getValue'); 
        var peru_perantara 		= document.getElementById('peru_perantara').value;
        var pim_perantara 		= document.getElementById('pim_perantara').value;
        var jab_pim_perantara 	= document.getElementById('jab_pim_perantara').value;
        var bank_perantara 		= document.getElementById('bank_perantara').value;
        var rek_bank_sulsel		= document.getElementById('rek_bank_sulsel').value;
      /*
         if (ckode==''){
                    alert('Kode Rekanan Tidak Boleh Kosong');
                    exit();
                } 
                
                if (cnama==''){
                    alert('Nama Rekanan Tidak Boleh Kosong');
                    exit();
                } 
                
                if (cpimpinan==''){
                    alert('Nama Pimpinan Tidak Boleh Kosong');
                    exit();
                } 
				if (ckantor==''){
                    alert('Alamat Kantor Tidak Boleh Kosong');
                    exit();
                } */
                if(lcstatus=='tambah'){
                    lcinsert = "(kode,kd_skpd,nama,bentuk,pimpinan,jabatan,bank,rekening,npwp,ktp,kantor,rumah,kota,kodepos,nama_perantara,pimpinan_perantara,rek_perantara,bank_perantara,jabat_perantara,notaris,no_notaris,tgl_notaris)";
                    lcvalues = "('"+kode+"','"+kd_skpd+"','"+nm_perusahaan+"','"+bentuk_per+"','"+pimpinan+"','"+jabatan+"','"+mbank+"','"+no_rek+"','"+npwp+"','"+no_id+"','"+almt_kntr+"','"+almt_rmh+"','"+kota+"','"+kd_pos+"','"+peru_perantara+"','"+pim_perantara+"','"+bank_perantara+"','"+rek_bank_sulsel+"','"+jab_pim_perantara+"','"+nm_notaris+"','"+no_akta+"','"+tgl_akta+"')";
                    
					$(document).ready(function(){
                        $.ajax({
                            type: "POST",
                            url: '<?php echo base_url(); ?>index.php/simpl/simpan_master',
                            data: ({tabel:'mrekanan',kolom:lcinsert,nilai:lcvalues,cid:'kode',lcid:kode}),//,cidx:'kd_skpd',cidxx:kd_skpd
                          
								 success:function(data){
								   status = data.pesan;                    
								   if (status == '0'){
								   swal({
									title: "Error!",
									text: "GAGAL TERSUMPAN MOHON DICHECK KEMBALI.!!",
									type: "error",
									confirmButtonText: "OK"
									});
									exit();
								   } else {                                 
									swal({
									title: "Berhasil",
									text: "Data telah disimpan.!!",
									imageUrl:"<?php echo base_url();?>/lib/images/logo_makassar.png"
									});                               
									}                                                                                                         
								}
                        });
                    });    
                    
                $('#dg').datagrid('appendRow',{kode:kode,nama:nm_perusahaan,pimpinan:pimpinan,kantor:almt_kntr});
                }else {
				lcquery ="UPDATE mrekanan SET nama='"+nm_perusahaan+"',bentuk='"+bentuk_per+"',pimpinan='"+pimpinan+"',jabatan='"+jabatan+"',bank='"+mbank+"',rekening='"+no_rek+"',npwp='"+npwp+"',ktp='"+no_id+"',kantor='"+almt_kntr+"',rumah='"+almt_kntr+"',kota='"+kota+"',kodepos='"+kd_pos+"',nama_perantara='"+peru_perantara+"',pimpinan_perantara='"+pim_perantara+"',rek_perantara='"+bank_perantara+"',bank_perantara='"+rek_bank_sulsel+"',jabat_perantara='"+jab_pim_perantara+"',notaris='"+nm_notaris+"',no_notaris='"+no_akta+"',tgl_notaris='"+tgl_akta+"' where kode='"+kode+"' and kd_skpd='"+kd_skpd+"'"; 
               
                    $(document).ready(function(){
                    $.ajax({
                        type: "POST",
                        url: '<?php echo base_url(); ?>index.php/simpl/update_master',
                        data: ({st_query:lcquery}),
                         success:function(data){
								   status = data.pesan;                    
								   if (status == '0'){
								   swal({
									title: "Error!",
									text: "GAGAL TERSUMPAN MOHON DICHECK KEMBALI.!!",
									type: "error",
									confirmButtonText: "OK"
									});
									exit();
								   } else {                                 
									swal({
									title: "Berhasil",
									text: "Data telah disimpan.!!",
									imageUrl:"<?php echo base_url();?>/lib/images/logo_makassar.png"
									});                               
									}                                                                                                         
								}
                    });
                    });
                    
                        $('#dg').datagrid('updateRow',{
                    	index: lcidx,
                    	row: {
                    		kode: kode,
                    		nama: nm_perusahaan,
                            pimpinan: pimpinan,
							kantor: almt_kntr 							
                    	}
                    });
                }
                alert("Data Berhasil disimpan");
                $("#dialog-modal").dialog('close');
    } 
    
      function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data Rekanan';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        document.getElementById("kode").disabled=true;
        }    
        
    
     function tambah(){
        lcstatus = 'tambah';
        judul = 'Input Data Rekanan';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
        $("#dialog-modal").dialog('open');
        document.getElementById("kode").disabled=false;
        document.getElementById("nm_perusahaan").focus();
        } 
     function keluar(){
        $("#dialog-modal").dialog('close');
        $('#dg').edatagrid('reload'); 
     }    
    
     function hapus(){
        var ckode = document.getElementById('kode').value;
		var skpd  = '<?php echo ($this->session->userdata('skpd')); ?>';
        if (ckode != ''){
		lcquery = "delete from mrekanan where kode='"+ckode+"' and kd_skpd='"+skpd+"'";
		var del= confirm("Apakah Anda Yakin ingin menghapus kode "+ckode+"??");
		if (del=true){
        var urll = '<?php echo base_url(); ?>index.php/simpl/hapus_master2';
        $(document).ready(function(){
         $.post(urll,({tabel:'mrekanan',cnid:ckode,cid:'kode',st_query:lcquery}),function(data){
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
<h2 align="center"><b>DAFTAR REKANAN</b></h2>
    <div align="center">
    <p>     
    <table style="width:400px;" border="0">
        <tr>
        <td width="10%">
        <a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:nomer_akhir();tambah();kosong();">Tambah</a></td>               
        <td width="5%"><a class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="javascript:cari();">Cari</a></td>
        <td><input type="text" value="" id="txtcari" style="width:300px;"/></td>
        </tr>
        <tr>
        <td colspan="4">
        <table id="dg" align="center" title="LISTING DATA REKANAN" style="width:900px;height:365px;" >  
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
                <td><input type="text" id="kode" style="width:100px;"/></td>  
            </tr> 
            <tr>
                <td width="30%">SKPD</td>
                <td width="1%">:</td>
                <td><input type="text" id="uskpd" style="width:100px;"/> <input type="text" style= "width:350px; border:none;" id="nmuskpd" /></td>  
            </tr>
            <tr>
                <td width="30%">NAMA PERUSAHAAN</td>
                <td width="1%">:</td>
                <td><input type="text" id="nm_perusahaan" style="width:300px;"/></td>  
            </tr>
            <tr>
                <td width="30%">BENTUK PERUSAHAAN</td>
                <td width="1%">:</td>
                <td><input type="text" id="bentuk_per" style="width:100px;"/></td>  
            </tr>
            <tr>
                <td width="30%">NAMA PIMPINAN</td>
                <td width="1%">:</td>
                <td><input type="text" id="pimpinan" style="width:200px;"/></td>  
            </tr>
            <tr>
                <td width="30%">JABATAN</td>
                <td width="1%">:</td> 
                <td><input type="text" id="jabatan" style="width:200px;"/></td>  
            </tr>		
            <tr>
                <td width="20%">NAMA BANK</td>
                <td width="1%">:</td>
                <td><input type="text" id="mbank" name="mbank" style="width:190px;"/> 
				<input type="text" id="nama_bank" name="nama_bank" style="width:300px;"/></td>
            </tr>
            <tr>
                <td width="30%">NO. REKENING</td>
                <td width="1%">:</td>
                <td><input type="text" id="no_rek" style="width:200px;"/></td>  
            </tr>
            <tr>
                <td width="30%">NO. NPWP</td>
                <td width="1%">:</td>
                <td><input type="text" id="npwp" style="width:200px;"/></td>  
            </tr>
            <tr>
                <td width="30%">NO. IDENTITAS</td>
                <td width="1%">:</td>
                <td><input type="text" id="no_id" style="width:200px;"/></td>  
            </tr>
            <tr>
                <td width="30%">ALAMAT KANTOR</td>
                <td width="1%">:</td>
                <td><textarea type="text" id="almt_kntr" style="width:300px;"/></textarea></td>  
            </tr>
            <tr>
                <td width="30%">ALAMAT RUMAH</td>
                <td width="1%">:</td>
                <td><textarea type="text" id="almt_rmh" style="width:300px;"/></textarea></td>  
            </tr>
            <tr>
                <td width="30%">KOTA</td>
                <td width="1%">:</td>
                <td><input type="text" id="kota" style="width:200px;"/></td>  
            </tr>
            <tr>
                <td width="30%">KODE POS</td>
                <td width="1%">:</td>
                <td><input type="text" id="kd_pos" style="width:200px;"/></td>  
            </tr>
            <tr>
                <td width="30%">NAMA NOTARIS</td>
                <td width="1%">:</td>
                <td><input type="text" id="nm_notaris" style="width:200px;"/></td>  
            </tr>
            <tr>
				<td width="30%">NO. AKTA NOTARIS</td>
                <td width="1%">:</td>
                <td><input type="text" id="no_akta" style="width:200px;"/></td>  
            </tr>
            <tr>
                <td width="30%">TGL AKTA NOTARIS</td>
                <td width="1%">:</td>
                <td><input type="text" id="tgl_akta" style="width:100px;"/></td>  
            </tr>
			
            <tr>
				<td width="30%">Nama Perusahaan Rek. Perantara</td>
                <td width="1%">:</td>
                <td><input type="text" id="peru_perantara" style="width:200px;"/></td>  
            </tr>
            <tr>
                <td width="30%">Nama Pim. Perusahaan Rek. Perantara</td>
                <td width="1%">:</td>
                <td><input type="text" id="pim_perantara" style="width:200px;"/></td>  
            </tr>
            <tr>
				<td width="30%">Jabatan Pimpinan Rek. Perantara</td>
                <td width="1%">:</td>
                <td><input type="text" id="jab_pim_perantara" style="width:200px;"/></td>  
            </tr>
            <tr>
                <td width="30%">Nama Bank Perusahaan Rek. Perantara</td>
                <td width="1%">:</td>
                <td><input type="text" id="bank_perantara" style="width:200px;"/></td>  
            </tr>
            <tr>
                <td width="30%">NO. Rek Perantara Bank Sulsel</td>
                <td width="1%">:</td>
                <td><input type="text" id="rek_bank_sulsel" style="width:200px;"/></td>  
            </tr>
			<hr/>
            <tr>
            <td colspan="3">&nbsp;</td>
            </tr>            
            <tr>
                <td colspan="3" align="center"><a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:simpan();keluar()">Simpan</a>
		        <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Kembali</a>
                </td>                
            </tr>
        </table>  
            
    </fieldset> 
</div>

