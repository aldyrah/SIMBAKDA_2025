<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/demo/demo.css">
	<script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.edatagrid.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/autoCurrency.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/numberFormat.js"></script>
    <link href="<?php echo base_url(); ?>easyui/jquery-ui.css" rel="stylesheet" type="text/css"/>
      <script src="<?php echo base_url(); ?>assets/sweetalert/lib/sweet-alert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/sweetalert/lib/sweet-alert.css">

    <script src="<?php echo base_url(); ?>easyui/jquery-ui.min.js"></script>
    <style>    
    #tagih {
        position: relative;
        width: 500px;
        height: 70px;
        padding: 0.4em;
    }  
    </style>

    <script type="text/javascript">    
    var kode = '1.20.05.01';
    var giat = '';
    var nomor= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
	var cekit=0;
	var cekidot=0;

    $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
            height: 450,
            width: 900,
            modal: true,
            autoOpen:false,
        });
        $("#tagih").hide();
    });    

    $(function(){ 
		$('#dg').edatagrid({
			url: '<?php echo base_url(); ?>/index.php/tukd/load_terima',
			idField:'id',            
			rownumbers:"true", 
			fitColumns:"true",
			singleSelect:"true",
			autoRowHeight:"false",
			loadMsg:"Tunggu Sebentar....!!",
			pagination:"true",
			nowrap:"true",                       
			columns:[[
				{field:'no_terima',
				title:'Nomor Terima',
				width:50,
				align:"center"},
				{field:'tgl_terima',
				title:'Tanggal',
				width:30},
				{field:'kd_skpd',
				title:'S K P D',
				width:30,
				align:"center"},
				{field:'kd_rek5',
				title:'Rekening',
				width:50,
				align:"center"},
				{field:'nilai1',
				title:'Nilai',
				width:50,
				align:"right"}
			]],
			onSelect:function(rowIndex,rowData){
			  nomor 	= rowData.no_terima;
			  no_tetap  = rowData.no_tetap;
			  tgl   	= rowData.tgl_terima;
			  kode  	= rowData.kd_skpd;
			  lcket 	= rowData.keterangan;
			  lcrek 	= rowData.kd_rek5;
			  rek 		= rowData.kd_rek;
			  lcnilai 	= rowData.nilai;
			  sts		= rowData.sts_tetap;
			  cekit		= 0;
			  cekidot   =0;
			  lcidx 	= rowIndex;
			  get(nomor,no_tetap,tgl,kode,lcket,lcrek,rek,lcnilai,sts);   
			},
			onDblClickRow:function(rowIndex,rowData){
			   cekit=0;
			   cekidot=0;
			   lcidx = rowIndex;
			   judul = 'Edit Data Penerimaan'; 
			   edit_data();   
			}
		});
        
        $('#tanggal').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });
        
        $('#notetap').combogrid({  
           panelWidth:420,  
           idField:'no_tetap',  
           textField:'no_tetap',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/tukd/load_no_tetap_ppkd',
           queryParams:({kd:kode}),             
           columns:[[  
               {field:'no_tetap',title:'No Penetapan',width:140},  
               {field:'tgl_tetap',title:'Tanggal',width:140},
               {field:'kd_skpd',title:'SKPD',width:140}]],  
           onSelect:function(rowIndex,rowData){
            var ststagih='1';
            $("#tgltetap").attr("value",rowData.tgl_tetap);
            $("#rek").combogrid("setValue",rowData.kd_rek5);
            $("#keterangan").attr("value",rowData.ket);
            $("#nilai").attr("value",number_format(rowData.nilai,2,',','.'));  
		    }  
		});

        $('#skpd').combogrid({  
			panelWidth:700,  
			idField:'kd_skpd',  
			textField:'kd_skpd',  
			mode:'remote',
			url:'<?php echo base_url(); ?>index.php/rka/skpd',  
			columns:[[  
			   {field:'kd_skpd',title:'Kode SKPD',width:100},  
			   {field:'nm_skpd',title:'Nama SKPD',width:700}    
			]],  
			onSelect:function(rowIndex,rowData){
			   kode = rowData.kd_skpd;               
			   $("#nmskpd").attr("value",rowData.nm_skpd.toUpperCase());
			   $('#rek').combogrid({url:'<?php echo base_url(); ?>index.php/tukd/ambil_rek_tetap/'+kode});                 
			}  
		});

		$('#rek').combogrid({  
			panelWidth:700,  
			idField:'kd_rek5',  
			textField:'kd_rek5',  
			mode:'remote',
			url:'<?php echo base_url(); ?>index.php/tukd/ambil_rek_tetap/'+kode,             
			columns:[[  
			   {field:'kd_rek5',title:'Kode Rekening',width:140},  
			   {field:'nm_rek',title:'Uraian',width:700},
			]],
			onSelect:function(rowIndex,rowData){
			   $("#nmrek").attr("value",rowData.nm_rek.toUpperCase());
			   $("#rek1").attr("value",rowData.kd_rek);
			   $("#giat").attr("value",rowData.kd_kegiatan);
			}    
		});
    });      
 
	function section2(){
		$(document).ready(function(){    
			$('#section2').click();                                               
		});   
	}


function cek_simpan_terima(){
       //  alert("tessssssssssssss");
		 
		var cno = document.getElementById('nomor').value;
        var cskpd = '1.20.05.01';
       
		 
		 
        if (cno==''){
            alert('Nomor  Tidak Boleh Kosong');
            exit();
        } 
        if (cskpd==''){
            alert('Kode SKPD Tidak Boleh Kosong');
            exit();
        }



	 $(document).ready(function(){
            	
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>/index.php/tukd/cek_simpan_terima_ppkd',
				
                data: ({no:cno,skpd:cskpd}),
                dataType:"json",
                success:function(data){
if(data == '0'){
	//awallllllllllllllllllll
	if(cekidot==1){
		swal({
			  title: 'No  Sudah Dipakai..!!',
			  text: "Cek Ulang No  <a style='color:red;font-size:large;'>"+cno+"</a>!!!",
			  html:true,
			  confirmButtonColor:"#ff0000",
			  type: "error",
			  confirmButtonText: "Ya",
			  showConfirmButton: true
			});	
	}else{
swal({
title:"<a style='font-size:large;'>Ubah Data No</a> <a style='color:red;font-size:large;'>"+cno+"</a> <a style='font-size:large;'>?</a>" ,
html:true,
//			  title: "No STS Sudah Ada, Yakin Mau Simpan ?",
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
					
						simpan_terima();
			}
	});
	
}//akhirrrrrrrrrrrrrrrr
					                        
	    }else{
			simpan_terima();
					}
                }
                
            });
        });
        
	}









    function section1(){
		$(document).ready(function(){    
			$('#section1').click();   
			$('#dg').edatagrid('reload');                                              
		});
    }

    function get(nomor,no_tetap,tgl,kode,lcket,lcrek,rek,lcnilai,sts){
        $("#notetap").combogrid("setValue",no_tetap);
        $("#nomor").attr("value",nomor);
        $("#tanggal").datebox("setValue",tgl);
        $("#rek").combogrid("setValue",lcrek);
        $("#rek1").attr("Value",rek);
        $("#nilai").attr("value",lcnilai);
        $("#ket").attr("value",lcket);
        if (sts==1){            
            $("#status").attr("checked",true);
            $("#tagih").show();
        } else {
            $("#status").attr("checked",false);
            $("#tagih").hide();
        } 
    }
    
    function kosong(){
        $("#nomor").attr("value",'');
        $("#tanggal").datebox("setValue",'');
        $("#rek").combogrid("setValue",'');
        $("#rek1").attr("Value",'');
        $("#nmskpd").attr("value",'');
        $("#nmrek").attr("value",'');
        $("#nilai").attr("value",'');        
        $("#ket").attr("value",'');
        $("#notetap").combogrid("setValue",'');        
        $("#tgltetap").attr("value",'');
        $("#status").attr("checked",false);      
        $("#tagih").hide();
        document.getElementById("nomor").focus();
		ambil_nomor();
		cekit=1;
		cekidot=1;
    }
    
	function ambil_nomor(){
		$.ajax({
			type: "POST",
			url: '<?php echo base_url(); ?>/index.php/tukd/max_nomor',
			data: ({ckode:kode}),
			dataType:"json",
				success: function(data){
				$("#nomor").attr("value",data.terima)
			}
		});
	}  

    function cari(){
		var kriteria = document.getElementById("txtcari").value; 
		$(function(){ 
			$('#dg').edatagrid({
				url: '<?php echo base_url(); ?>/index.php/tukd/load_terima',
				queryParams:({cari:kriteria})
			});        
		});
    }
    
    function simpan_terima(){
        var cno = document.getElementById('nomor').value;
        var ctgl = $('#tanggal').datebox('getValue');
        var cskpd = '1.20.05.01';
        var lckdrek = $('#rek').combogrid('getValue');
        var rek = document.getElementById('rek1').value;
        var kdgiat = document.getElementById('giat').value;
        var lcket = document.getElementById('ket').value;
        var lntotal = angka(document.getElementById('nilai').value);
        var cstatus = document.getElementById('status').checked;
        
		if (cstatus==false){
           cstatus=0;
        }else{
            cstatus=1;
        }
        
        var ctetap = $('#notetap').combogrid('getValue');
        var ctgltetap = document.getElementById('tgltetap').value;
      
        if (cno==''){
            alert('Nomor  Tidak Boleh Kosong');
            exit();
        } 
        if (ctgl==''){
            alert('Tanggal  Tidak Boleh Kosong');
            exit();
        }
        if (cskpd==''){
            alert('Kode SKPD Tidak Boleh Kosong');
            exit();
        }

		$(document).ready(function(){
			$.ajax({
				type: "POST",
				url: '<?php echo base_url(); ?>/index.php/tukd/simpan_terima_ppkd',
				data: ({tabel:'tr_terima_ppkd',no:cno,tgl:ctgl,skpd:cskpd,ket:lcket,kdrek:lckdrek,nilai:lntotal,rek:rek,nottp:ctetap,tglttp:ctgltetap,sts:cstatus,giat:kdgiat,ccek:cekit}),
				dataType:"json",
				success  : function(data){
					   status=data ;
					   cekit=0;
					   cekidot=0;
				}
			});
		});    

        //alert("Data Berhasil disimpan");
		
		
		swal({
			  title: 'Data Tersimpan..!!',
			  text: "Akan Menutup Dalam 2 Detik!!!",
			  confirmButtonColor: "#80C8FE",
			  type: "success",
			  timer: 3500,
			  confirmButtonText: "Ya",
			  showConfirmButton: true
			});


        $("#dialog-modal").dialog('close');
        $('#dg').edatagrid('reload');
    } 
    
    function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data Penerimaan PPKD';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        document.getElementById("nomor").disabled=true;
    }
	
    function tambah(){
        $('#notetap').combogrid({  
           panelWidth:420,  
           idField:'no_tetap',  
           textField:'no_tetap',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/tukd/load_no_tetap_ppkd',
           queryParams:({kd:kode}),             
           columns:[[  
               {field:'no_tetap',title:'No Penetapan',width:150},  
               {field:'tgl_tetap',title:'Tanggal',width:120},
               {field:'nilai1',title:'NILAI',width:150}
           ]], 
           onSelect:function(rowIndex,rowData){
            var ststagih='1';
            $("#tgltetap").attr("value",rowData.tgl_tetap);	
			$("#rek").combogrid("setValue",rowData.kd_rek5);
            $("#rek1").attr("Value",rowData.kd_rek_lo);
			$("#ket").attr("value",rowData.keterangan);
            $("#nilai").attr("value",number_format(rowData.nilai,2,'.',','));  
		   }
		});

		lcstatus = 'tambah';
        judul = 'Input Data Penerimaan PPKD';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
		$("#dialog-modal").dialog('open');
		document.getElementById("nomor").disabled=false;
        document.getElementById("nomor").focus();
    } 


    function keluar(){
        $("#dialog-modal").dialog('close');
    }    
    
    function hapus(){

swal({
		  title:"<a style='font-size:large;'>No </a> <a style='color:red;font-size:large;'>"+nomor+"</a> <a style='font-size:large;'>?</a>" ,
		  text:"Apakah anda yakin akan Menghapus nospp ??",
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

        var urll = '<?php echo base_url(); ?>index.php/tukd/hapus_terima_ppkd';
        $(document).ready(function(){
         $.post(urll,({no:nomor,skpd:kode}),function(data){
            status = data;
            if (status=='0'){
                alert('Gagal Hapus..!!');
                exit();
            } else {
                $('#dg').datagrid('deleteRow',lcidx);   
                //alert('Data Berhasil Dihapus..!!');
				
				swal({
			  title: 'Data terhapus..!!',
			  text: "Akan Menutup Dalam 2 Detik!!!",
			  confirmButtonColor: "#80C8FE",
			  type: "success",
			  timer: 3500,
			  confirmButtonText: "Ya",
			  showConfirmButton: true
			});

                exit();
            }
         });
        });    
		
		
			}
			}

	);
		
		
		
		
    } 
    
    function runEffect() {
        var selectedEffect = 'blind';            
        var options = {};                      
        $( "#tagih" ).toggle( selectedEffect, options, 500 );
        $("#notetap").combogrid("setValue",'');
        $("#tgltetap").attr("value",'');
        $("#nilai").attr("value",'');
        $("#rek").combogrid("setValue",'');
    };     

    function addCommas(nStr){
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
    
    function delCommas(nStr){
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
<div id="accordion">
<h3 align="center"><u><b><a href="#" id="section1">INPUTAN PENERIMAAN PPKD</a></b></u></h3>
    <div>
		<p align="right">         
			<a class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="javascript:tambah()">Tambah</a>               
			<a class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="javascript:hapus();">Hapus</a>
			<a class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="javascript:cari();">Cari</a>
			<input type="text" value="" id="txtcari"/>
			<table id="dg" title="Listing data penerimaan PPKD" style="width:870px;height:450px;" >  
			</table>
		</p> 
    </div>   
    
</div>
</div>
<div id="dialog-modal" title="">
    <p class="validateTips">Semua Inputan Harus Di Isi.</p> 
    <fieldset>
    <table align="center" style="width:100%;" border="0">
            <tr>
                <td colspan="5"><b>Dengan Penetapan</b><input type="checkbox" id="status"  onclick="javascript:runEffect();"/>
                    <div id="tagih">
                        <table>
                            <tr>
                                <td>No Penetapan&nbsp;</td>
                                <td><input type="text" id="notetap" style="width: 200px;" /></td>
                                <td>&nbsp;Tgl&nbsp;&nbsp;</td>
                                <td><input type="text" id="tgltetap" style="width: 100px;" /></td>   
                            </tr>
                        </table> 
                    </div>
                
                </td>                
            </tr>
		<tr>
			<td>No. Terima</td>
			<td></td>
			<td><input type="text" id="nomor" style="width: 200px;" /></td>  
		</tr>            
		<tr>
			<td>Tanggal </td>
			<td></td>
			<td><input type="text" id="tanggal" style="width: 140px;" /></td>
		</tr>
		<!--<tr>
			<td>S K P D</td>
			<td></td>
			<td><input id="skpd" name="skpd" style="width: 140px;" />  <input type="text" id="nmskpd" style="border:0;width: 600px;" readonly="true"/></td>                            
		</tr>-->
		<tr>
			<td>Rekening</td>
			<td></td>
			<td><input id="rek" name="rek" style="width: 140px;" /> <input type="hidden" id="rek1" style="width: 140px;" readonly="true"/><input type="hidden" id="giat" style="width: 140px;" readonly="true"/>
			 <input type="text" id="nmrek" style="border:0;width: 600px;" readonly="true"/></td>                
		</tr>            
		<tr>
			<td>Nilai</td>
			<td></td>
			<td><input type="text" id="nilai" style="width: 200px; text-align: right;" onkeypress="return(currencyFormat(this,',','.',event))"/></td> 
		</tr>
		<tr>
			<td>Keterangan</td>
			<td colspan="2"><textarea rows="2" cols="50" id="ket" style="width: 740px;"></textarea>
			</td> 
		</tr>
		<tr>
			<td colspan="3" align="center"><a class="easyui-linkbutton" iconCls="icon-save" plain="false" onclick="javascript:cek_simpan_terima();">Simpan</a>
			<a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:keluar();">Kembali</a>
			</td>                
		</tr>
    </table>       
    </fieldset>
</div>
</body>
</html>