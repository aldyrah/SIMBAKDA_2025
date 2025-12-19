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
          // $("#kode").attr("value",rowData.kd_urusan.toUpperCase()+'.');                
       }  
     });   
     
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>/index.php/master/load_ttd',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'nip',
    		title:'NIP',
    		width:10,
            align:"center"},
            {field:'nama',
    		title:'Nama',
    		width:10},
            {field:'jabatan',
    		title:'Jabatan',
    		width:15},
            {field:'kd_skpd',
    		title:'SKPD',
    		width:5,
            align:"center"},
            {field:'kode',
    		title:'Kode',
    		width:5,
            align:"center"}
        ]],
        onSelect:function(rowIndex,rowData){
          nip = rowData.nip;
          nm = rowData.nama;
          jab = rowData.jabatan;
          pang = rowData.pangkat;
          dns = rowData.kd_skpd;
          kd = rowData.kode;
          get(nip,nm,jab,pang,dns,kd); 
          lcidx = rowIndex;  
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
           lcidx = rowIndex;
           judul = 'Edit Data Penandatangan'; 
           edit_data();   
        }
        
        });
       
    });        

 
    
    function get(nip,nm,jab,pang,dns,kd) {
        
        $("#nip").attr("value",nip);
        $("#nama").attr("value",nm); 
        $("#dinas").combogrid("setValue",dns);
        $("#jabat").attr("value",jab);
        $("#pang").attr("value",pang);
        $("#kd").combobox("setValue",kd);    
                       
    }
       
    function kosong(){
        $("#nip").attr("value",'');
        $("#nama").attr("value",''); 
        $("#dinas").combogrid("setValue",'');
        $("#jabat").attr("value",'');
        $("#pang").attr("value",'');
        $("#nm_u").attr("value",'');
        $("#kd").combobox("setValue",'');
    }
    
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    $(function(){ 
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>/index.php/master/load_ttd',
        queryParams:({cari:kriteria})
        });        
     });
    }
    
	function cek_simpan_t(){
         var cnip = document.getElementById('nip').value;
        var cnama = document.getElementById('nama').value;
        var cdinas =  $('#dinas').combogrid('getValue');
        var cjabat = document.getElementById('jabat').value;
        var cpang = document.getElementById('pang').value;
        var ckode = $('#kd').combobox('getValue');
		 
        if (cnip==''){
            alert('NIP Tidak Boleh Kosong');
            exit();
        } 
        if (ckode==''){
            alert('Kode SKPD Tidak Boleh Kosong');
            exit();
        }
		
		 if (cnama=='0'){
           alert('Nama SKPD Tidak Boleh Kosong');
            exit();
        }
 

 
	 $(document).ready(function(){
            	
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>/index.php/master/cek_ttd',
                data: ({no:cnip,skpd:ckode,cnama:cnama}),
                dataType:"json",
                success:function(data){
if(data == '7'){

	if(lcstatus=='tambah'){
		swal({
			  title: 'NIP Sudah Dipakai..!!',
			  text: "Cek Ulang NIP <a style='color:red;font-size:large;'>"+cnip+"</a>!!!",
			  html:true,
			  confirmButtonColor:"#ff0000",
			  type: "error",
			  confirmButtonText: "Ya",
			  showConfirmButton: true
			});	
	}else{
		
swal({
title:"<a style='font-size:large;'>Ubah Data </a> <a style='color:red;font-size:large;'>"+cnip+"</a> <a style='font-size:large;'>?</a>" ,
html:true,

			  text: "Anda Yakin Akan Merubah Data!!!",
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonColor: "#DD6B55",
			  confirmButtonText: "Yakin",
			  cancelButtonText: "Batal",
			  closeOnConfirm: true
			},
	function(isConfirm){
			if (isConfirm) {
						simpan_ttd();
			}
	});
	
}//akhirrrrrrrrrrrrrrrr
					                        
	    }else{
			simpan_ttd();
					}
                }
                
            });
        });
        
	}

       function simpan_ttd(){
         //alert(jaka);
        var cnip = document.getElementById('nip').value;
        var cnama = document.getElementById('nama').value;
        var cdinas =  $('#dinas').combogrid('getValue');
        var cjabat = document.getElementById('jabat').value;
        var cpang = document.getElementById('pang').value;
        var ckode = $('#kd').combobox('getValue');
       // alert(cnip+'/'+cnama+'/'+cdinas+'/'+cjabat+'/'+cpang+'/'+ckode);
                
        if (cnip==''){
            alert('NIP  Tidak Boleh Kosong');
            exit();
        } 
        if (cnama==''){
            alert('Nama  Tidak Boleh Kosong');
            exit();
        }
        if (ckode==''){
            alert('Kode  Tidak Boleh Kosong');
            exit();
        }

        
        if(lcstatus=='tambah'){ 
            
            lcinsert = "(nip,nama,jabatan,pangkat,kd_skpd,kode)";
            lcvalues = "('"+cnip+"','"+cnama+"','"+cjabat+"','"+cpang+"','"+cdinas+"','"+ckode+"')";
            
            $(document).ready(function(){
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>/index.php/master/simpan_master',
                    data: ({tabel:'ms_ttd',kolom:lcinsert,nilai:lcvalues,cid:'nip',lcid:ckode}),
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
                            //alert('Data Tersimpan..!!');
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
           
        } else{
            
            lcquery = "UPDATE ms_ttd SET nama='"+cnama+"',jabatan='"+cjabat+"',pangkat='"+cpang+"',kd_skpd='"+cdinas+"',kode='"+ckode+"' where nip='"+cnip+"'";

            $(document).ready(function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>/index.php/master/update_master',
                data: ({st_query:lcquery}),
                dataType:"json",
                success:function(data){
                        status = data;
                        if (status=='0'){
                            alert('Gagal Simpan..!!');
                            exit();
                        }else{
                           // alert('Data Tersimpan..!!');
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
        judul = 'Input Data Penandatangan';
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
        var cnip = document.getElementById('nip').value;
        
		
		swal({
title:"<a style='font-size:large;'>NIP </a> <a style='color:red;font-size:large;'>"+cnip+"</a> <a style='font-size:large;'>?</a>" ,
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
		
		var urll = '<?php echo base_url(); ?>index.php/master/hapus_master';
         $(document).ready(function(){
         $.post(urll,({tabel:'ms_ttd',cnid:cnip,cid:'nip'}),function(data){
           status = data;
            if (status=='0'){
                alert('Gagal Hapus..!!');
                exit();
            } else {
                $('#dg').datagrid('deleteRow',lcidx);   
                //alert('Data Berhasil Dihapus..!!');
				
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
<h3 align="center"><u><b><a>INPUTAN MASTER PENANDATANGAN</a></b></u></h3>
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
        <table id="dg" title="LISTING DATA PENANDATANGAN" style="width:900px;height:365px;" >  
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
                <td width="30%">NIP</td>
                <td width="1%">:</td>
                <td><input type="text" id="nip" style="width:200px;"/></td>  
            </tr>            
            <tr>
                <td width="30%">NAMA </td>
                <td width="1%">:</td>
                <td><input type="text" id="nama" style="width:360px;"/></td>  
            </tr>
            <tr>
                <td width="30%">Jabatan </td>
                <td width="1%">:</td>
                <td><input type="text" id="jabat" style="width:360px;"/></td>  
            </tr>
            <tr>
                <td width="30%">Pangkat </td>
                <td width="1%">:</td>
                <td><input type="text" id="pang" style="width:360px;"/></td>  
            </tr>
            <tr>
                <td width="30%">SKPD</td>
                <td width="1%">:</td>
                <td><input type="text" id="dinas" style="width:100px;"/></td>  
            </tr> 
            <tr>
                <td width="30%"></td>
                <td width="1%"></td>
                <td><input type="text" id="nm_u" style="width:400px;"/></td>  
            </tr> 
            <tr>
                <td width="30%">KODE</td>
                <td width="1%">:</td>
                <td><input id="kd" style="width:250px;" class="easyui-combobox" data-options="
            		valueField: 'value',
            		textField: 'label',
            		data: [{
            			label: '',
            			value: ''
            		},{
            			label: 'Pengguna Anggaran',
            			value: 'PA'
            		},{
            			label: 'Bendahara Pengeluaran',
            			value: 'BK'
            		},{
            			label: 'Bendahara Penerimaan',
            			value: 'BP'
            		},{
            			label: 'PPTK',
            			value: 'PT'
            		},{
            			label: 'BENDAHARA UMUM DAERAH',
            			value: 'BUD'
            		},{
            			label: 'PPKD',
            			value: 'PPKD'
            		},{
            			label: 'SEKRETARIS DAERAH',
            			value: 'SETDA'
            		},
					{
            			label: 'Bendahara Gaji',
            			value: 'BG'
            		}]"/>
                </td>  
                
            </tr>
            
            <tr>
            <td colspan="3">&nbsp;</td>
            </tr>            
            <tr>
                <td colspan="3" align="center"><a class="easyui-linkbutton" iconCls="icon-save" plain="false" onclick="javascript:cek_simpan_t();">Simpan</a>
		        <a class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="javascript:hapus();">Hapus</a>
                <a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:keluar();">Kembali</a>
                </td>                
            </tr>
        </table>       
    </fieldset>
</div>

</body>

</html>