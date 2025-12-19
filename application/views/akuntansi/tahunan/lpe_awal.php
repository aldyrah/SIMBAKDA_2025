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
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery.maskMoney.min.js"></script>

    
    <link href="<?php echo base_url(); ?>easyui/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo base_url(); ?>easyui/jquery-ui.min.js"></script>
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
            height: 360,
            width: 900,
            modal: true,
            autoOpen:false,
        });
		//document.getElementById('load').style.visibility='hidden';
        });    
     
     $(function(){ 
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>/index.php/master/load_lpe_awal_tamp',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
		  rowStyler: function(index,row){
                		if (row.seq=='50'){
                			return 'background-color:skyblue;';
                		}
                	},   
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
            {field:'uraian',
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
          lcket = rowData.uraian;
          lcnilai = rowData.nilai;
          lcidx = rowIndex;
          get(nomor,seq,lcket,lcnilai);   
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
           lcidx = rowIndex;
           judul = 'Edit Data LPE Lalu'; 
           edit_data();   
		   lcstatus='update';
        }
        
        });
              
		$('#bulan').combogrid({  
			panelWidth:120,
			panelHeight:300,  
			idField:'bln',  
			textField:'nm_bulan',  
			mode:'remote',
			url:'<?php echo base_url(); ?>index.php/rka/bulan',  
			columns:[[ 
			   {field:'nm_bulan',title:'Nama Bulan',width:700}    
			]] 
		});	  
			  
    });    

	  	 $(document).ready(function(){
       $('#nilai').maskMoney({thousands:',', decimal:'.', precision:2,allowNegative:true});

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
                    data: ({tabel:'map_lpe',kolom:lcinsert,nilai:lcvalues,cid:'kode',lcid:cno}),
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
                            exit();
                        }
                    }
                });
            });    
         
          } else{
            //alert(lcstatus)
            lcquery = "UPDATE map_lpe SET uraian='"+curaian+"',seq='"+cseq+"',nilai_tamp='"+lntotal+"' where seq='"+cseq+"'";
            //alert(lcquery);
			
            $(document).ready(function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>/index.php/master/update_master_lalu_lpe',
                data: ({st_query:lcquery,tabel:'lpe'}),
                dataType:"json",
                success:function(data){
                        status = data;
                        if (status=='0'){
                            alert('Gagal Simpan..!!');
							 $('#dg').edatagrid('reload');
                            exit();
                        }else{
                            alert('Data Tersimpan..!!');
							//alert(status);
							 $('#dg').edatagrid('reload');
                            exit();
                        }
                    }
            });
            });
            
            
        }   
        
       // alert("Data Berhasil disimpan");
        $("#dialog-modal").dialog('close');
        //$('#dg').edatagrid('reload');
        //section1();
    } 
    
      function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data LPE Lalu';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        
		var cek = document.getElementById("nomor").value;		
		if (cek == '3'){
			document.getElementById("nomor").disabled=true;
			document.getElementById("seq").disabled=true;
			document.getElementById("uraian").disabled=true;
			document.getElementById("nilai").disabled=true;
			$("#simpan_nilai").linkbutton('disable');
		}else if (cek== '7'){
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
        judul = 'Input Data LPE Lalu';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
        $("#dialog-modal").dialog('open');
        document.getElementById("nomor").disabled=false;
        document.getElementById("nomor").focus();
        } 
     
	 function keluar(){
        $("#dialog-modal").dialog('close');
     }       

	 /*function hitung(){
		document.getElementById('load').style.visibility='visible';
		$(document).ready(function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>/index.php/akuntansi/hitung_lpe_pemda',
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
	}	*/
  
   </script>

</head>
<body>

<div id="content"> 
<div id="accordion">
<h3 align="center"><u><b><a href="#" id="section1">LPE TAHUN LALU</a></b></u></h3>
    <div>
    <p align="right">         
        <!--<a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:tambah()">Tambah</a>-->               
        <!--<a class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:hapus();">Hapus</a>
        <a class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="javascript:cari();">Cari</a>
        <input type="text" value="" id="txtcari"/>-->
        <table id="dg" title="Listing LPE TAHUN LALU" style="width:870px;height:400px;" >  
        </table>
		<!--<table style="width:870px;" >  
			<tr align="center">					
				<td>Bulan : <input type="text" id="bulan" style="width: 100px;" /> <a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:hitung()">Proses Perhitungan</a></td>
			</tr>
			<tr align="center">
				<td><DIV id="load" ><IMG src="<?php echo base_url(); ?>assets/images/loading14.gif" WIDTH="800" HEIGHT="25" BORDER="0" ALT=""></DIV></td>
			</tr>
        </table>-->
 
    </p> 
    </div>
		<code>*) Double Klik pada item untuk melakukan edit data</code>

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
                <td><input type="text" id="nilai" style="width: 140px; text-align: right;"/></td> 
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