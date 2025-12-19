<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>   
   
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/default/easyui.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/icon.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/demo/demo.css"/>
  <script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery-1.8.0.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.easyui.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.edatagrid.js"></script>
    
    <link href="<?php echo base_url(); ?>easyui/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo base_url(); ?>easyui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/sweetalert/lib/sweet-alert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/sweetalert/lib/sweet-alert.css">

  <script type="text/javascript">
    
    var kode = '';
    var giat = '';
    var nomor= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
                    
     $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
            height: 350,
            width: 650,
            modal: true,
            autoOpen:false
        });
        });    
     
     $(function(){ 
        
     $('#dinas').combogrid({  
       panelWidth:500,  
       idField:'kd_skpd',  
       textField:'kd_skpd',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_skpd',  
       columns:[[  
           {field:'kd_skpd',title:'Kode SKPD',width:100},  
           {field:'nm_skpd',title:'Nama SKPD',width:400}    
       ]],  
       onSelect:function(rowIndex,rowData){
           $("#nm_u").attr("value",rowData.nm_skpd.toUpperCase());            
       }  
     });   
     
     $('#dg').edatagrid({
    url: '<?php echo base_url(); ?>/index.php/master/load_rekan',
		panelWidth:500, 
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
          {field:'rekanan',
        title:'Rekanan',
        width:150,
            align:"left"},
            {field:'pemilik',
        title:'Pemilik',
        width:100},
            {field:'alamat',
        title:'Alamat',
        width:100},
            {field:'npwp',
        title:'NPWP',
        width:75,
            align:"left"},
            {field:'rekening',
        title:'Rekening',
        width:75,
            align:"left"}
        ]],
        onSelect:function(rowIndex,rowData){
          id_p = rowData.id_p;
          rekanan = rowData.rekanan;
          npwp = rowData.npwp;
          rekening = rowData.rekening;
          pemilik = rowData.pemilik;
          alamat = rowData.alamat;
      jns_p=rowData.jns_p;
          get(id_p,rekanan,npwp,rekening,pemilik,alamat,jns_p); 
          lcidx = rowIndex;  
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
           lcidx = rowIndex;
           judul = 'Edit Data Penandatangan'; 
           edit_data();   
        }
        
        });
       
    });        

 
    
    function get(id_p,rekanan,npwp,rekening,pemilik,alamat,jns_p){
        
    
          
 
        $("#id_p").attr("value",id_p);
        $("#nama_r").attr("value",rekanan); 
        $("#alamat").attr("value",alamat);
        $("#npwp").attr("value",npwp);
        $("#rekening").attr("value",rekening);    
    $("#bos").attr("value",pemilik);    
        $("#jns_pp").attr("value",jns_p);    
               
  
                 
    }
       
    function kosong(){
        $("#id_p").attr("value",'');
        $("#rekanan").attr("value",''); 
        $("#alamat").attr("value",'');
        $("#npwp").attr("value",'');
        $("#rekening").attr("value",'');    
    $("#bos").attr("value",'');   
          $("#jns_pp").attr("value",'');  
          $("#nama_r").attr("value",'');    
               
        
    }
    
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    $(function(){ 
     $('#dg').edatagrid({
    url: '<?php echo base_url(); ?>/index.php/master/load_rekan',
        queryParams:({cari:kriteria})
        });        
     });
    }
	
       function simpan_ttd(){
			var cid_p = document.getElementById('id_p').value;
			var alm = document.getElementById('alamat').value;
			var jnspp = document.getElementById('jns_pp').value;
			var npwp = document.getElementById('npwp').value;
			var rekening = document.getElementById('rekening').value;
			var bos = document.getElementById('bos').value;
			var cnama_r = document.getElementById('nama_r').value;

  		if (cnama_r=='' || alm=='' || jnspp=='' || npwp==''|| rekening==''|| bos==''){
            alert('Tidak Boleh Kosong');
            exit();
        }

        if(lcstatus=='tambah'){            
            lcinsert = "(rekanan,jns_p,alamat,npwp,rekening,pemilik)";
            lcvalues = "('"+cnama_r+"','"+jnspp+"','"+alm+"','"+npwp+"','"+rekening+"','"+bos+"')";
      
            $(document).ready(function(){
                $.ajax({
                    type: "POST",
                     url: '<?php echo base_url(); ?>/index.php/master/simpan_rekan',
					data: ({tabel:'ms_rekanan',kolom:lcinsert,nilai:lcvalues,cid:'rekanan',lcid:cnama_r}),
                    dataType:"json",
                    success:function(data){
                        status = data;
                        if (status=='0'){
                            alert('Gagal Simpan..!!');
                            exit();
                        }else if(status=='1'){
                            alert('Data Sudah Ada..!!');
                            exit();
                        }else if(status=='2'){
							swal({
							title: 'Data Tersimpan..!!',
							text: "Akan Menutup Dalam 2 Detik!!!",
							confirmButtonColor: "#80C8FE",
							type: "success",
							timer: 3500,
							confirmButtonText: "Ya",
							showConfirmButton: true});
                            exit();
                        }
                    }
                });
            });
        }else{      
            lcquery = "UPDATE ms_rekanan SET rekanan='"+cnama_r+"',jns_p='"+jnspp+"',alamat='"+alm+"',rekening='"+rekening+"',pemilik='"+bos+"',npwp='"+npwp+"' where id_p='"+id_p+"'";
            $(document).ready(function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>/index.php/master/update_master_rekanan',
                data: ({st_query:lcquery}),
                dataType:"json",
                success:function(data){
					status = data;
					if (status=='0'){
						alert('Gagal Simpan..!!');
						exit();
					}else{
					   swal({
						title: 'Data Tersimpan..!!',
						text: "Akan Menutup Dalam 2 Detik!!!",
						confirmButtonColor: "#80C8FE",
						type: "success",
						timer: 3500,
						confirmButtonText: "Ya",
						showConfirmButton: true
					  });
						exit();
					}
                }
            });
            });            
        }        
        $("#dialog-modal").dialog('close');
        $('#dg').edatagrid('reload');
    } 
    
    function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data Penandatangan';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        document.getElementById("nip").disabled=true;
     }   
    
     function tambah(){
        lcstatus = 'tambah';
        judul = 'Input Data Perusahaan';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
        $("#dialog-modal").dialog('open');
        document.getElementById("nip").disabled=false;
        document.getElementById("nip").focus();
     }
		 
     function keluar(){
        $("#dialog-modal").dialog('close');
     }    
    
     function hapus(){
        var id_p = document.getElementById('id_p').value;    
			swal({
			title:"<a style='font-size:large;'>id </a> <a style='color:red;font-size:large;'>"+id_p+"</a> <a style='font-size:large;'>?</a>" ,
			text:"Apakah anda yakin menghapus??",
			type: "warning",
			html:true,
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Ya",
			cancelButtonText: "Tidak",
			closeOnConfirm: false,
			closeOnCancel: true
			},    
    
    function(isConfirm){
      if (isConfirm) {    
    	var urll = '<?php echo base_url(); ?>index.php/master/hapus_rekan';
         $(document).ready(function(){
         $.post(urll,({tabel:'ms_rekanan',cnid:id_p,cid:'id_p'}),function(data){
         status = data;
            if (status=='0'){
                alert('Gagal Hapus..!!');
                exit();
            } else {
                $('#dg').datagrid('deleteRow',lcidx);          
				swal("Deleted!", "Data Terhapus", "success");
				keluar();
                exit();
            }
         });
        }); 
      }
    });
    } 
           
    function addCommas(nStr)
    {
      nStr += '';
      x = nStr.split(',');
        x1 = x[0];
      x2 = x.length > 1 ? ',' + x[1] : '';
      var rgx = /(\d+)(\d{3})/;
      while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
      }
      return x1 + x2;
    }
    
     function delCommas(nStr)
    {
      nStr += ' ';
      x2 = nStr.length;
        var x=nStr;
        var i=0;
      while (i<x2) {
        x = x.replace(',','');
            i++;
      }
      return x;
    }
    
  
   </script>

</head>
<body>

<div id="content"> 
<h3 align="center"><u><b><a>INPUTAN MASTER PERUSAHAAN </a></b></u></h3>
    <div align="center">
    <p align="center">     
    <table style="width:400px;" border="0">
        <tr>
        <td width="10%">
        <a class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="javascript:tambah()">Tambah</a></td>
        <td width="5%"><a class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="javascript:cari();">Cari</a></td>
        <td><input type="text" value="" id="txtcari" style="width:300px;" onkeypress="javascript:cari();" /></td>
        </tr>
        <tr>
        <td colspan="4">
        <table id="dg" title="DAFTAR DATA PERUSAHAAN" style="width:900px;height:365px;" >  
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
                <td width="30%">NAMA PERUSAHAAN </td>
                <td width="1%">:</td>
                <td><input type="text" id="id_p" style="width:360px;" hidden="true"/>
                <input type="text" id="nama_r" style="width:360px;"/></td>  
            </tr>
  			<tr>
                <td width="30%">ALAMAT PERUSAHAAN </td>
                <td width="1%">:</td>
                <td><input type="text" id="alamat" style="width:360px;" /></td>  
            </tr>            
            <tr>
                <td width="30%">NPWP</td>
                <td width="1%">:</td>
                <td><input type="text" id="npwp" style="width:360px;" /></td>  
            </tr>
            <tr>
                <td width="30%">REKENING</td>
                <td width="1%">:</td>
                <td><input type="text" id="rekening" style="width:360px;" /></td>  
           	</tr>
            <tr>
                <td width="30%">DIREKTUR</td>
                <td width="1%">:</td>
                <td><input type="text" id="bos" style="width:360px;" /></td>  
            </tr>
           <tr>
           		<td width="30%">JENIS PERUSAHAAN </td>
                <td width="1%">:</td> 
           		<td>           
             		<select name="jns_pp" id="jns_pp" style="width:360px;">
                         <option value="">......</option>     
                         <option value="PO">1 || Perusahaan Perorangan (PO)</option>
                         <option value="FA">2 || FIRMA</option>
                         <option value="CV">3 || Perseroan Komanditer (CV)</option>
                         <option value="PT">4 || Perseroan Terbatas (PT)</option>
                         <option value="PERSERO">5 || Perseroan Terbatas Negara</option>
                         <option value="PD">6 || Perusahaan Daerah</option>
                         <option value="PERUM">7 || Perusahaan Negara Umum</option>
                         <option value="PERJAN">8 || Perusahaan Negara Jawatan</option>
                         <option value="KOPERASI">9 || KOPERASI</option>
                         <option value="Yayasan">10 || Yayasan</option>                         
						 <option value="Lain">11 || Lain-Lain</option>                          
                    </select>
           		</td>
			</tr>
            
            <tr>
            <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3" align="center">
					<a class="easyui-linkbutton" iconCls="icon-save" plain="false" onclick="javascript:simpan_ttd();">Simpan</a>
					<a class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="javascript:hapus();">Hapus</a>         
					<a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:keluar();">Kembali</a>
                </td>                
            </tr>
        </table>       
    </fieldset>
</div>

</body>

</html>