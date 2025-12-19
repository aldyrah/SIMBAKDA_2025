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
    <script src="<?php echo base_url(); ?>easyui/jquery-ui.min.js"></script>
    <script type="text/javascript">
    
    var kode = '';
    var giat = '';
    var nomor= '';
    var judul= '';
	var parentx='';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';	
                    
     $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
            height: 360,
            width: 900,
            modal: true,
            autoOpen:false,
        });
		document.getElementById('load').style.visibility='hidden';
        });    
     
     $(function(){ 
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>/index.php/master/load_lak_awal',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        nowrap:"true",                       
        columns:[[
    	    {field:'kode',
    		title:'KODE',
    		width:10,
            align:"center"},
            {field:'seq',
    		title:'SEQ',
    		width:10,
            align:"center"},
            {field:'aset',
    		title:'URAIAN',
    		width:100,
            align:"left"},
            {field:'nilai_lalu',
    		title:'Nilai',
    		width:20,
            align:"right"}
        ]],
        onSelect:function(rowIndex,rowData){
          nomor = rowData.kode;
          seq   = rowData.seq;
          lcket = rowData.aset;
          lcnilai = rowData.nilai_lalu;		  
          lcidx = rowIndex;
          get(nomor,seq,lcket,lcnilai);   
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
           lcidx = rowIndex;
           judul = 'Edit Data LAK Lalu';
		   parentx = rowData.parent;		   			
           edit_data();   
        }
        
        });
      
    });        
       
    function get(nomor,seq,lcket,lcnilai){
        $("#nomor").attr("value",nomor);
        $("#seq").attr("value",seq);
        $("#uraian").attr("value",lcket);
        $("#nilai").attr("value",lcnilai);                        
    }
    
    function kosong(){
        $("#nomor").attr("value",'');
        $("#seq").attr("value",'');
        $("#uraian").attr("value",'');
        $("#nilai").attr("value",'');                

    }
    
    function simpan(){
        //alert(lcstatus);
        var cno = document.getElementById('nomor').value;
        var cseq = document.getElementById('seq').value;
        var curaian = document.getElementById('uraian').value;
        var lntotal = angka(document.getElementById('nilai').value);
            lctotal = number_format(lntotal,0,'.',',');
        if (cno==''){
            alert('Nomor Tidak Boleh Kosong');
            exit();
        } 
        if (cseq==''){
            alert('seq  Tidak Boleh Kosong');
            exit();
        }
        if (curaian==''){
            alert(' uraian Tidak Boleh Kosong');
            exit();
        }
        
        if(lcstatus=='tambah'){ 
            
            lcinsert = "(kode,aset,seq,nilai_lalu)";
            lcvalues = "('"+cno+"','"+curaian+"','"+cseq+"','"+lntotal+"')";

            $(document).ready(function(){
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>/index.php/master/simpan_master',
                    data: ({tabel:'rg_lak',kolom:lcinsert,nilai:lcvalues,cid:'kode',lcid:cno}),
                    dataType:"json",
                    success:function(data){
                        status = data;
                        if (status=='0'){
                            alert('Gagal Simpan..!!');
                            exit();
                        }else if(status=='1'){
                            alert('Data Sudah Ada..!!');
							$('#dg').edatagrid('reload');
                            exit();
                        }else{
                            alert('Data Tersimpan..!!');
							$('#dg').edatagrid('reload');
                            exit();
                        }
                    }
                });
            });    
         
          } else{            
            lcquery = "UPDATE rg_lak SET uraian='"+curaian+"',seq='"+cseq+"',nilai_lalu='"+lntotal+"' where nor='"+cno+"'";
            var pren = parentx;						
            $(document).ready(function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>/index.php/master/update_master',
                //data: ({st_query:lcquery,tabel:'lak'}),
				data: ({st_query:lcquery,tabel:'lak',paren:pren}),
                dataType:"json",
                success:function(data){
                        status = data;
                        if (status=='0'){
                            alert('Gagal Simpan..!!');
							$('#dg').edatagrid('reload');
                            exit();
                        }else{
                            alert('Data Tersimpan..!!');
							$('#dg').edatagrid('reload');
                            exit();
                        }
                    }
            });
            });
            
            
        }   
        
        //alert("Data Berhasil disimpan");
		//$('#dg').edatagrid('reload');
        $("#dialog-modal").dialog('close');        
        //section1();
		} 
    
      function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data LAK Lalu';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');        
		
		var cek = document.getElementById("nomor").value;
		var cek2 = document.getElementById("seq").value;
		
		if(cek=='1' || cek=='2' || cek=='17' || cek=='18' || cek=='30' || cek=='31' || cek=='32' || cek=='33' || cek=='43' || cek=='44' || cek=='54' || cek=='55' || cek=='56' || cek=='57' || cek=='67' || cek=='68' || cek=='78' || cek=='79' || cek=='80' || cek=='81' || cek=='83' || cek=='84' || cek=='86' || cek=='87' || cek=='89' || cek=='93'){
			document.getElementById("nomor").disabled=true;
			document.getElementById("seq").disabled=true;
			document.getElementById("uraian").disabled=true;
			document.getElementById("nilai").disabled=true;
			$("#simpan_nilai").linkbutton('disable');				
		}else{
			document.getElementById("nomor").disabled=true;
			document.getElementById("seq").disabled=true;
			document.getElementById("uraian").disabled=false;
			document.getElementById("nilai").disabled=false;
			$("#simpan_nilai").linkbutton('enable');							
		}
		
        }    
        
    
     function tambah(){
        lcstatus = 'tambah';
        judul = 'Input Data Neraca Lalu';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
        $("#dialog-modal").dialog('open');
        document.getElementById("nomor").disabled=false;
        document.getElementById("nomor").focus();
        } 
		
	function hitung(){
		document.getElementById('load').style.visibility='visible';
		$(document).ready(function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>/index.php/akuntansi/hitung_lak_pemda',
                //data: ({st_query:lcquery}),
                dataType:"json",
                success:function(data){
                        status = data;
                        if (status=='0'){
                            alert('Perhitungan Gagal..!!');
                            exit();
                        }else{
                            alert('Perhitungan Berhasil..!!');
							document.getElementById('load').style.visibility='hidden';
                            exit();
                        }
                    }
            });
            });
	}	
		
     function keluar(){
        $("#dialog-modal").dialog('close');
     }    
    
     function hapus(){
      //  var cnomor = document.getElementById('nomor').value;
//        var curaian = $('#uraian').combogrid('getValue');
        
        
        //alert(cnomor+curaian);
        var urll = '<?php echo base_url(); ?>index.php/tukd/hapus_tetap';
        $(document).ready(function(){
         $.post(urll,({no:nomor,uraian:kode}),function(data){
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

    <style type="text/css">
<!--
.style1 {font-family: Arial, Helvetica, sans-serif}
-->
    </style>
</head>
<body>

<div id="content"> 
<div id="accordion">
<h3 align="center"><u><b><a href="#" id="section1">LAK TAHUN LALU</a></b></u></h3>
    <div>
    <p align="right">         
        <!--<a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:tambah()">Tambah</a>-->               
        <!--<a class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:hapus();">Hapus</a>
        <a class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="javascript:cari();">Cari</a>
        <input type="text" value="" id="txtcari"/>-->
      <table id="dg" title="Listing LAK TAHUN LALU" style="width:870px;height:350px;" >  
      </table>
		<table style="width:870px;" >  
			<tr align="center">				
				<td><a class="easyui-linkbutton" iconCls="icon-ok" plain="true" onclick="javascript:hitung()">Proses Perhitungan LAK Tahun Berjalan</a>
				<DIV id="load" ><IMG src="<?php echo base_url(); ?>assets/images/loading14.gif" WIDTH="800" HEIGHT="12" BORDER="0" ALT=""></DIV></td>
			</tr>
        </table>		
    </p> 
    </div> 
	<div>
	<span class="style1"></span><code>*)Double Klik pada item untuk melakukan edit data</code>
	</br>
	<span class="style1"></span><code>**)Jika sudah edit data, mohon untuk proses perhitungan ulang agar mendapatkan data terupdate</code>
	</div>

</div>

<div id="dialog-modal" title="">
    <p class="validateTips">Semua Inputan Harus Di Isi.</p> 
    <fieldset>
     <table align="center" style="width:100%;" border="0">
            <tr>
                <td>KODE</td>
                <td></td>
                <td><input type="text" id="nomor" style="width: 200px;"/></td>  
            </tr>            
            <tr>
                <td>SEQ </td>
                <td></td>
                <td><input type="text" id="seq" style="width: 140px;" /></td>
            </tr>
            <tr>
                <td>URAIAN</td>
                <td></td>
                <td><input type="text" id="uraian" name="uraian" style="width: 500px;" /> </td>                            
            </tr>
                       
            <tr>
                <td>Nilai</td>
                <td></td>
                <td><input type="text" id="nilai" style="width: 140px; text-align: right;" onkeypress="return(currencyFormat(this,',','.',event))"/></td> 
            </tr>
           
            <tr>
                <td colspan="3" align="center"><a class="easyui-linkbutton"  id="simpan_nilai" iconCls="icon-save" plain="true" onclick="javascript:simpan();">Simpan</a>
		        <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Kembali</a>
                </td>                
            </tr>
        </table>       
    </fieldset>
</div>

</body>
</html>