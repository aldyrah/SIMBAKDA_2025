<script type="text/javascript" src="<?php echo base_url(); ?>easyui/autoCurrency.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>easyui/currencyFields.js"></script>
	<script type="text/javascript">
    
    var kode= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
    $(document).ready(function() {
          $("#tabs").tabs();                     
     });    
     
	 
     $(function(){
     /*$('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/simpl/load_skpd',
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
    		title:'Kode Rekanan',
    		width:15,
            align:"center"},
            {field:'nama',
    		title:'Nama Rekanan',
    		width:20},
            {field:'jabatan_skpd',
    		title:'Nama jabatan_skpd',
    		width:20,
            align:"left"},
			{field:'pangkat_skpd',
    		title:'Alamat pangkat_skpd',
    		width:30,
            align:"left"}
        ]],
        onSelect:function(rowIndex,rowData){
          lcidx 			= rowIndex;
          kode 				= rowData.kode;
          nama 				= rowData.nama;
		  jabatan_skpd 		= rowData.jabatan_skpd;
          pangkat_skpd 		= rowData.pangkat_skpd;
		  nip_skpd 			= rowData.nip_skpd;
          nama_bendout 		= rowData.nama_bendout;
		  jabatan_bendout 	= rowData.jabatan_bendout;
		  pangkat_bendout 	= rowData.pangkat_bendout;
          nip_bendout 		= rowData.nip_bendout;
		  nama_ppb 			= rowData.nama_ppb;
		  jabatan_ppb 		= rowData.jabatan_ppb;
		  pangkat_ppb 		= rowData.pangkat_ppb;
          nip_ppb 			= rowData.nip_ppb;
		  bagian 			= rowData.bagian;
		  alamat 			= rowData.alamat;
		  bank 				= rowData.bank;
		  rekening 			= rowData.rekening;
          npwp 				= rowData.npwp; 
        get(kode,nama,jabatan_skpd,pangkat_skpd,nip_skpd,nama_bendout,jabatan_bendout,pangkat_bendout,nip_bendout,nama_ppb,jabatan_ppb,pangkat_ppb,nip_ppb,bagian,alamat,bank,rekening,npwp);          
        },
        onDblClickRow:function(rowIndex,rowData){
          lcidx = rowIndex;
          judul = 'Edit Data Rekanan'; 
          lcstatus = 'edit';
          kode = rowData.kode;
          nama = rowData.nama;
          jabatan_skpd = rowData.jabatan_skpd; 
		  pangkat_skpd = rowData.pangkat_skpd;
          get(kode,nama,jabatan_skpd,pangkat_skpd);   
          edit_data();   
        }
        }); */
		
		   $('#uskpd').combogrid({  
            panelWidth:600,  
            idField:'kd_uskpd',  
            textField:'kd_uskpd',  
            mode:'remote',                      
            url:'<?php echo base_url(); ?>index.php/master/ambil_ubidskpd',  
            columns:[[  
               {field:'kd_uskpd',title:'Kode Skpd',width:100},  
               {field:'nm_uskpd',title:'Nama Skpd',width:700}    
            ]],  
            onSelect:function(rowIndex,rowData){
               cuskpd = rowData.kd_uskpd;               
               $('#nmuskpd').attr('value',rowData.nm_uskpd);                               
            } 
         }); 
		 
	$('#tgl_sk').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            }
         });
       $('#kdskpd').combogrid({  
           panelWidth:500,  
           idField:'kode',  
           textField:'kode',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/simpl/load_skpd',  
           columns:[[  
               {field:'kode',title:'KODE SKPD',width:100},  
               {field:'nama',title:'NAMA SKPD',width:400}    
           ]],  
           onSelect:function(rowIndex,rowData){
               lcskpd = rowData.kode;
               $("#nama").attr("value",rowData.nama.toUpperCase());
			   $("#jabatan_skpd").attr("value",rowData.jabatan_skpd.toUpperCase());
			   $("#pangkat_skpd").attr("value",rowData.pangkat_skpd.toUpperCase());
			   $("#nip_skpd").attr("value",rowData.nip_skpd.toUpperCase());
			   $("#nama_bendout").attr("value",rowData.nama_bendout.toUpperCase());
			   $("#jabatan_bendout").attr("value",rowData.jabatan_bendout.toUpperCase());
			   $("#pangkat_bendout").attr("value",rowData.pangkat_bendout.toUpperCase());
			   $("#nip_bendout").attr("value",rowData.nip_bendout.toUpperCase());
			   $("#nama_ppb").attr("value",rowData.nama_ppb.toUpperCase());
			   $("#jabatan_ppb").attr("value",rowData.jabatan_ppb.toUpperCase());
			   $("#pangkat_ppb").attr("value",rowData.pangkat_ppb.toUpperCase());
			   $("#nip_ppb").attr("value",rowData.nip_ppb.toUpperCase());
			   $("#bagian").attr("value",rowData.bagian.toUpperCase());
			   $("#alamat").attr("value",rowData.alamat.toUpperCase());
			   $("#bank").attr("value",rowData.bank.toUpperCase());
			   $("#rekening").attr("value",rowData.rekening.toUpperCase());
			   $("#npwp").attr("value",rowData.npwp.toUpperCase());
           }  
         });
    }); 

	 
	  
	
  /* $('#uskpd').combogrid({  
            panelWidth:600,  
            idField:'kode',  
            textField:'kode',  
            mode:'remote',                      
            url:'<?php echo base_url(); ?>index.php/simpl/load_skpd',  
            columns:[[  
               {field:'kode',title:'Kode Skpd',width:100},  
               {field:'nama',title:'Nama Skpd',width:700}    
            ]],  
            onSelect:function(rowIndex,rowData){
               cuskpd = rowData.kode;               
               $('#nmuskpd').attr('value',rowData.nama);                               
            } 
         }); */	

      
    function get(kode,nama,jabatan_skpd,pangkat_skpd,nip_skpd,nama_bendout,jabatan_bendout,pangkat_bendout,nip_bendout,nama_ppb,jabatan_ppb,pangkat_ppb,nip_ppb,bagian,alamat,bank,rekening,npwp);{
        $("#uskpd").combogrid("setValue",kode);
        $("#nmuskpd").attr("value",nama);
        $("#jabatan_skpd").attr("value",jabatan_skpd);  
		$("#pangkat_skpd").attr("value",pangkat_skpd); 	
		$("#nip_skpd").attr("value",nip_skpd); 
		$("#nama_bendout").attr("value",nama_bendout);
		$("#jabatan_bendout").attr("value",jabatan_bendout); 
		$("#pangkat_bendout").attr("value",pangkat_bendout);
		$("#nip_bendout").attr("value",nip_bendout); 	
		$("#nama_ppb").attr("value",nama_ppb); 
		$("#jabatan_ppb").attr("value",jabatan_ppb);
		$("#pangkat_ppb").attr("value",pangkat_ppb); 
		$("#nip_ppb").attr("value",nip_ppb);	
		$("#bagian").attr("value",bagian); 	
		$("#alamat").attr("value",alamat); 
		$("#bank").attr("value",bank);
		$("#rekening").attr("value",rekening); 
		$("#npwp").attr("value",npwp);			
    }
    
    function kosong(){
        $("#uskpd").combogrid("setValue",'');
        $("#nmuskpd").attr("value",'');
        $("#jabatan_skpd").attr("value",'');  
		$("#pangkat_skpd").attr("value",''); 	
		$("#nip_skpd").attr("value",''); 
		$("#nama_bendout").attr("value",'');
		$("#jabatan_bendout").attr("value",''); 
		$("#pangkat_bendout").attr("value",'');
		$("#nip_bendout").attr("value",''); 	
		$("#nama_ppb").attr("value",''); 
		$("#jabatan_ppb").attr("value",'');
		$("#pangkat_ppb").attr("value",''); 
		$("#nip_ppb").attr("value",'');	
		$("#bagian").attr("value",''); 	
		$("#alamat").attr("value",''); 
		$("#bank").attr("value",'');
		$("#rekening").attr("value",''); 
		$("#npwp").attr("value",'');
    }
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    
    $(function(){
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/simpl/load_skpd',
        queryParams:({cari:kriteria})
        });        
     });
    }
    
    function simpan(){
        var  kode 				= $('#uskpd').combogrid('getValue');
        var  nama 				= document.getElementById('nama').value;
        var  jabatan_skpd 		= document.getElementById('jabatan_skpd').value;
        var  pangkat_skpd 		= document.getElementById('pangkat_skpd').value;
		var  nip_skpd 			= document.getElementById('nip_skpd').value;
        var  nama_bendout 		= document.getElementById('nama_bendout').value;
		var  jabatan_bendout 	= document.getElementById('jabatan_bendout').value;
		var  pangkat_bendout 	= document.getElementById('pangkat_bendout').value;
        var  nip_bendout 		= document.getElementById('nip_bendout').value;
		var  nama_ppb 			= document.getElementById('nama_ppb').value;
		var  jabatan_ppb 		= document.getElementById('jabatan_ppb').value;
		var  pangkat_ppb 		= document.getElementById('pangkat_ppb').value;
        var  nip_ppb 			= document.getElementById('nip_ppb').value;
		var  bagian 			= document.getElementById('bagian').value;
		var  alamat 			= document.getElementById('alamat').value;
		var  bank 				= document.getElementById('bank').value;
		var  rekening 			= document.getElementById('rekening').value;
        var  npwp 				= document.getElementById('npwp').value; 
		

         if (ckode==''){
                    alert('Kode Rekanan Tidak Boleh Kosong');
                    exit();
                } 
                
                if (cnama==''){
                    alert('Nama Rekanan Tidak Boleh Kosong');
                    exit();
                } 
                
                if (cjabatan_skpd==''){
                    alert('Nama jabatan_skpd Tidak Boleh Kosong');
                    exit();
                } 
				if (cpangkat_skpd==''){
                    alert('Alamat pangkat_skpd Tidak Boleh Kosong');
                    exit();
                } 
                if(lcstatus=='tambah'){
                    
                    lcinsert = "(kode,nama,jabatan_skpd,pangkat_skpd,nip_skpd,nama_bendout,jabatan_bendout,pangkat_bendout,nip_bendout,nama_ppb,jabatan_ppb,pangkat_ppb,nip_ppb,bagian,alamat,bank,rekening,npwp)";
                    lcvalues = "('"+kode+"','"+nama+"','"+jabatan_skpd+"','"+pangkat_skpd+"','"+nip_skpd+"','"+nama_bendout+"','"+jabatan_bendout+"','"+pangkat_bendout+"','"+nip_bendout+"','"+nama_ppb+"','"+jabatan_ppb+"','"+pangkat_ppb+"','"+nip_ppb+"','"+bagian+"','"+alamat+"','"+bank+"','"+rekening+"','"+npwp+"')";
                    
                    $(document).ready(function(){
                        $.ajax({
                            type: "POST",
                            url: '<?php echo base_url(); ?>index.php/simpl/simpan_master',
                            data: ({tabel:'mhorganisasi',kolom:lcinsert,nilai:lcvalues,cid:'kode',lcid:kode}),
                            dataType:"json"
                        });
                    });    
                    
                    
                $('#dg').datagrid('appendRow',{kode:kode,nama:nama,jabatan_skpd:jabatan_skpd,pangkat_skpd:pangkat_skpd,nip_skpd:nip_skpd,nama_bendout:nama_bendout,jabatan_bendout:jabatan_bendout,pangkat_bendout:pangkat_bendout,nip_bendout:nip_bendout,nama_ppb:nama_ppb,jabatan_ppb:jabatan_ppb,pangkat_ppb:pangkat_ppb,nip_ppb:nip_ppb,bagian:bagian,alamat:alamat,bank:bank,rekening:rekening,npwp:npwp});
                }else { //{kode:ckode,nama:cnama,jabatan_skpd:cjabatan_skpd,pangkat_skpd:cpangkat_skpd}
                    
                    lcquery = "UPDATE mhorganisasi SET nama='"+nama+"',jabatan_skpd='"+jabatan_skpd+"',pangkat_skpd='"+pangkat_skpd+"',nip_skpd='"+nip_skpd+"',nama_bendout='"+nama_bendout+"',jabatan_bendout='"+jabatan_bendout+"',pangkat_bendout='"+pangkat_bendout+"',nip_bendout='"+nip_bendout+"',nama_ppb='"+nama_ppb+"',jabatan_ppb='"+jabatan_ppb+"',pangkat_ppb='"+pangkat_ppb+"',nip_ppb='"+nip_ppb+"',bagian='"+bagian+"',alamat='"+alamat+"',bank='"+bank+"',rekening='"+rekening+"',npwp='"+npwp+"' where kode='"+kode+"'";
                    
        
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
                            jabatan_skpd: jabatan_skpd,
							pangkat_skpd: pangkat_skpd,
							nip_skpd 	: nip_skpd,
							nama_bendout 		: nama_bendout,
							jabatan_bendout 	: jabatan_bendout,
							pangkat_bendout 	: pangkat_bendout,
							nip_bendout 		: nip_bendout,
							nama_ppb 			: nama_ppb,
							jabatan_ppb 		: jabatan_ppb,
							pangkat_ppb 		: pangkat_ppb,
							nip_ppb 			: nip_ppb,
							bagian 			: bagian,
							alamat 			: alamat,
							bank 				: bank,
							rekening 			: rekening,
							npwp 				: npwp
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
        document.getElementById("kode").focus();
        } 
     function keluar(){
        $("#dialog-modal").dialog('close');
     }    
    
     function hapus(){
        var ckode = document.getElementById('kode').value;
               
        var urll = '<?php echo base_url(); ?>index.php/simpl/hapus_master';
        $(document).ready(function(){
         $.post(urll,({tabel:'mhorganisasi',cnid:ckode,cid:'kode'}),function(data){
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
        });    
    } 
    
       
   </script>

<div id="tabs"> 
    <p align="center"><b>INPUTAN SKPD</b></p> 
    <fieldset>
     <table align="center" style="width:100%;" border="0">
			<tr>
                <td height="30px">SKPD</td>
                <td>:</td>
                <td><input type="text" id="kdskpd" name="kdskpd" style="width: 200px;" onclick="javascript:select();" /></td>
            </tr>
                <td width="20%">NAMA SKPD</td>
                <td width="1%">:</td>
                <td><input type="text" id="nama" name="nama" style="width:500px;"/></td>  
            </tr> 
			<tr><td bgcolor="#fcbe02" align="center" colspan="3"><b>KEPALA SKPD</b></td></tr>			
            <tr>
                <td width="20%">NAMA</td>
                <td width="1%">:</td>
                <td><input type="text" id="nama_skpd" style="width:500px;"/></td>  
            </tr>
			<tr>
                <td width="20%">JABATAN</td>
                <td width="1%">:</td>
                <td><input type="text" id="jabatan_skpd" style="width:500px;"/></td>  
            </tr>
			  <tr>
                <td width="20%">PANGKAT</td>
                <td width="1%">:</td>
                <td><input type="text" id="pangkat_skpd" style="width:500px;"/></td>  
            </tr>
			<tr>
                <td width="20%">NIP</td>
                <td width="1%">:</td>
                <td><input type="text" id="nip_skpd" style="width:500px;"/></td>  
            </tr>
			<tr><td bgcolor="#fcbe02" align="center" colspan="3"><b>BENDAHARA PENGELUARAN</b></td></tr>			
            <tr>
                <td width="20%">NAMA</td>
                <td width="1%">:</td>
                <td><input type="text" id="nama_hendout" style="width:500px;"/></td>  
            </tr>
			<tr>
                <td width="20%">JABATAN</td>
                <td width="1%">:</td>
                <td><input type="text" id="jabatan_hendout" style="width:500px;"/></td>  
            </tr>
			  <tr>
                <td width="20%">PANGKAT</td>
                <td width="1%">:</td>
                <td><input type="text" id="pangkat_hendout" style="width:500px;"/></td>  
            </tr>
			<tr>
                <td width="20%">NIP</td>
                <td width="1%">:</td>
                <td><input type="text" id="nip_hendout" style="width:500px;"/></td>  
            </tr>
			<tr><td bgcolor="#fcbe02" align="center" colspan="3"><b>PEJABAT PENGADAAN BARANG DAN JASA</b></td></tr>			
            <tr>
                <td width="20%">NAMA</td>
                <td width="1%">:</td>
                <td><input type="text" id="nama_ppb" style="width:500px;"/></td>  
            </tr>
			<tr>
                <td width="20%">JABATAN</td>
                <td width="1%">:</td>
                <td><input type="text" id="jabatan_ppb" style="width:500px;"/></td>  
            </tr>
			<tr>
                <td width="20%">PANGKAT</td>
                <td width="1%">:</td>
                <td><input type="text" id="pangkat_ppb" style="width:500px;"/></td>  
            </tr>
			<tr>
                <td width="20%">NIP</td>
                <td width="1%">:</td>
                <td><input type="text" id="nip_ppb" style="width:500px;"/></td>  
            </tr>
			<tr>
                <td width="20%">No.SK</td>
                <td width="1%">:</td>
                <td><input type="text" id="" style="width:500px;"/></td>  
            </tr>
			<tr>
                <td width="20%">Tgl.SK</td>
                <td width="1%">:</td>
                <td><input type="text" id="tgl_sk" style="width:100px;"/></td>  
            </tr>
			<tr><td bgcolor="#fcbe02" align="center" colspan="3"><b>DATA SKPD</b></td></tr>			
            <tr>
                <td width="20%">KODE BAGIAN</td>
                <td width="1%">:</td>
                <td><input type="text" id="bagian" style="width:190px;"/> <input type="text" id="nama" style="width:300px;"/></td>
            </tr>
			<tr>
                <td width="20%">ALAMAT</td>
                <td width="1%">:</td>
                <td><textarea type="text" id="alamat" style="width:500px; height:30px" ></textarea></td>  
            </tr>
			<tr>
                <td width="20%">NAMA BANK</td>
                <td width="1%">:</td>
                <td><input type="text" id="bank" style="width:500px;"/></td>  
            </tr>
			<tr>
                <td width="20%">NO.REKENING</td>
                <td width="1%">:</td>
                <td><input type="text" id="rekening" style="width:500px;"/></td>  
            </tr>
			<tr>
                <td width="20%">No.NPWP</td>
                <td width="1%">:</td>
                <td><input type="text" id="npwp" style="width:500px;"/></td>  
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
