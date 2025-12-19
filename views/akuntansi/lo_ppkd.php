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
	var kode_rek ='';
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
        });    
               
     $(function(){ 
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>/index.php/master/load_lo_ppkd_awal',
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
            {field:'nilai',
    		title:'Nilai',
    		width:20,
            align:"right"}
        ]],
        onSelect:function(rowIndex,rowData){
          nomor = rowData.kode;
          seq   = rowData.seq;
          lcket = rowData.aset;
          lcnilai = rowData.nilai;
		  kd_rek = rowData.kd_rk1;
          lcidx = rowIndex;
          get(nomor,seq,lcket,lcnilai,kd_rek);   
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
           lcidx = rowIndex;
           judul = 'Edit Data LO PPKD'; 
           edit_data();   
        }
        
        });
        
         
              
       

      
    });        

       
    function get(nomor,seq,lcket,lcnilai,kd_rek){
        $("#nomor").attr("value",nomor);
        $("#seq").attr("value",seq);
        $("#uraian").attr("value",lcket);
        $("#nilai").attr("value",lcnilai);
		kd_rek = kd_rek;                        
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
        if (curaian==''){
            alert(' uraian Tidak Boleh Kosong');
            exit();
        }
        
        if(lcstatus=='tambah'){ 
            
            lcinsert = "(kode,aset,seq,nilai)";
            lcvalues = "('"+cno+"','"+curaian+"','"+cseq+"','"+lntotal+"')";

            $(document).ready(function(){
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>/index.php/master/simpan_master',
                    data: ({tabel:'map_lo_ppkd_kab',kolom:lcinsert,nilai:lcvalues,cid:'kode',lcid:cno}),
                    dataType:"json",
                    success:function(data){
                        status = data;
                        if (status=='0'){
                            alert('Gagal Simpan..!!');
                            exit();
                        }else if(status=='1'){
                            alert('Data Sudah Ada..!!');
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
			var cek_kd = kd_rek;		
            lcquery = "UPDATE map_lo_ppkd_kab SET uraian='"+curaian+"',thn_m1='"+lntotal+"' where nor='"+cno+"'";
            //alert(lcquery);
            $(document).ready(function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>/index.php/master/update_master_ppkd',
                data: ({st_query:lcquery,tabel:'lo_ppkd_kab',kdrek:cek_kd}),
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
		$('#dg').edatagrid('reload');
        $("#dialog-modal").dialog('close');
        
        //section1();
    } 
    
      function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data LO PPKD';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        			
		var cek_nor = document.getElementById("nomor").value
		//var cek_seq = document.getElementById("seq").value
		
		if (cek_nor=='1' || cek_nor==='2' || cek_nor==='7' || cek_nor==='9' || cek_nor==='10' || cek_nor==='15' || cek_nor==='17' || cek_nor==='20' || cek_nor==='22' || cek_nor==='25' || cek_nor==='26' || cek_nor==='28' || cek_nor==='31' || cek_nor==='32' || cek_nor==='34' || cek_nor==='35' || cek_nor==='44' || cek_nor==='46' || cek_nor==='52' || cek_nor==='53' || cek_nor==='55' || cek_nor==='57' || cek_nor==='58' || cek_nor==='62' || cek_nor==='64' || cek_nor==='68' || cek_nor==='69' || cek_nor==='71' || cek_nor==='73' || cek_nor==='74' || cek_nor==='76' || cek_nor==='78' || cek_nor==='80' || cek_nor==='81' || cek_nor==='83' ){
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
        judul = 'Input Data LO PPKD';
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

</head>
<body>

<div id="content"> 
<div id="accordion">
<h3 align="center"><u><b><a href="#" id="section1">SALDO AWAL LO PPKD</a></b></u></h3>
    <div>
    <p align="right">         
        <!--<a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="">Tambah</a>-->               
        <!--<a class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:hapus();">Hapus</a>
        <a class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="javascript:cari();">Cari</a>
        <input type="text" value="" id="txtcari"/>-->
        <table id="dg" title="Listing Data" style="width:870px;height:410px;" >  
        </table>		
    </p> 
    </div>   
	<code>Double klik pada item untuk melakukan edit data</code>

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
                <td colspan="3" align="center"><a class="easyui-linkbutton" id="simpan_nilai" iconCls="icon-save" plain="true" onclick="javascript:simpan();">Simpan</a>
		        <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Kembali</a>
                </td>                
            </tr>
        </table>       
    </fieldset>
</div>


  	
</body>

</html>