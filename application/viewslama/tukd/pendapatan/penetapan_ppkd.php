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
    
    var kode = '1.20.05.01';
    var giat = '';
    var nomor= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
    var cekit=0;

    $(document).ready(function(){
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
            height: 360,
            width: 900,
            modal: true,
            autoOpen:false,
        });
    });
	
	$(document).ready(function(){
      $('#nilai').maskMoney({thousands:',', decimal:'.', precision:0});
    });
    
    $(function(){ 
    $('#dg').edatagrid({
        url: '<?php echo base_url(); ?>/index.php/tukd/load_tetap',
        idField       : 'id',            
        rownumbers    : "true", 
        fitColumns    : "true",
        singleSelect  : "true",
        rowStyler: function(index,row){
                if (row.cek =='1'){
                    return 'background-color:#FFFF00;';
                }else if(row.cek =='2'){
                    return 'background-color:#CCFF33;';
                }
            },
        autoRowHeight : "false",
        loadMsg       : "Tunggu Sebentar....!!",
        pagination    : "true",
        nowrap        : "true",          
        columns:[[
            {field:'no_tetap',
            title:'Nomor Tetap',
            width:100,
            align:"left"},
            {field:'tgl_tetap',
            title:'Tanggal',
            width:30},
            {field:'kd_rek',
            title:'Rekening',
            width:50,
            align:"center"},
            {field:'nilai',
            title:'Nilai',
            width:50,
            align:"right"}
        ]],
        onSelect:function(rowIndex,rowData){
          nomor   = rowData.no_tetap;
          tgl     = rowData.tgl_tetap;
          kode    = rowData.kd_skpd;
          lcket   = rowData.keterangan;
          lcrek   = rowData.kd_rek5;
          rek     = rowData.kd_rek;
          lcnilai = rowData.nilai;
          lcidx   = rowIndex;
          cekit   = 0;
          cek     =rowData.cek;
          get(nomor,tgl,kode,lcket,lcrek,rek,lcnilai);
          tombol(cek);   
        },
        onDblClickRow:function(rowIndex,rowData){
           lcidx = rowIndex;
           cekit = 0;
           judul = 'Edit Data Penetapan'; 
           edit_data();
           tombol(cek);   
        }
    });

	function tombol(st){ 
        if (st==1 || st==2){
            $('#sa').linkbutton('disable');
            $('#ha').linkbutton('disable');             
        }else{
            $('#sa').linkbutton('enable');
            $('#ha').linkbutton('enable');            
        }
    }
    
    $('#tanggal').datebox({  
        required:true,
        formatter :function(date){
            var y = date.getFullYear();
            var m = date.getMonth()+1;
            var d = date.getDate();
            return y+'-'+m+'-'+d;
        },
        onSelect: function(date){
          jaka = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
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
        idField:'kd_rek',  
        textField:'kd_rek',  
        mode:'remote',
        url:'<?php echo base_url(); ?>index.php/tukd/ambil_rek_tetap/'+kode,             
        columns:[[  
           {field:'kd_rek',title:'Kode Rekening',width:140},  
           {field:'nm_rek',title:'Uraian',width:700},
        ]],
        onSelect:function(rowIndex,rowData){
           $("#nmrek").attr("value",rowData.nm_rek.toUpperCase());
           $("#rek1").attr("value",rowData.kd_rek5);
           $("#giat").attr("value",rowData.kd_kegiatan);
        }    
    });
    });        

    function section2(){
        $(document).ready(function(){    
            $('#section2').click();                                               
        });   
    }

    
    function section1(){
        $(document).ready(function(){    
            $('#section1').click();   
            $('#dg').edatagrid('reload');                                              
        });
    }
  
    function get(nomor,tgl,kode,lcket,lcrek,rek,lcnilai){
        $("#nomor").attr("value",nomor);
        $("#tanggal").datebox("setValue",tgl);
        $("#rek").combogrid("setValue",rek);
        $("#rek1").attr("Value",lcrek);
        $("#nilai").attr("value",lcnilai);
        $("#ket").attr("value",lcket);
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
        cekit = 1;
        ambil_nomor();
        $('#sa').linkbutton('enable');
        $('#ha').linkbutton('enable');
    }
    
    function cari(){
        var kriteria = document.getElementById("txtcari").value; 
        $(function(){ 
         $('#dg').edatagrid({
            url: '<?php echo base_url(); ?>/index.php/tukd/load_tetap',
            queryParams:({cari:kriteria})
            });        
        });
    }
    
    function simpan_tetap(){
        var cno = document.getElementById('nomor').value;
        var ctgl = $('#tanggal').datebox('getValue');
        var cskpd = '1.20.05.01';
        var lckdrek = $('#rek').combogrid('getValue');
        var rek = document.getElementById('rek1').value;
        var kegi = document.getElementById('giat').value;
        var lcket = document.getElementById('ket').value;
        var lntotal = angka(document.getElementById('nilai').value);
        var a=document.getElementById('nilai').value;
            lctotal = number_format(lntotal,0,'.',',');
        if (cno==''){
            alert('Nomor STS Tidak Boleh Kosong');
            exit();
        } 
        if (ctgl==''){
            alert('Tanggal STS Tidak Boleh Kosong');
            exit();
        }
        if (cskpd==''){
            alert('Kode SKPD Tidak Boleh Kosong');
            exit();
        }
        
           if (rek==''){
            alert('rekening Tidak Boleh Kosong');
            exit();
        }
               if (a==''||a==0){
            alert('Nilai Tidak Boleh Nol');
            exit();
        }
           if (lcket==''){
            alert('Keterangan Tidak Boleh Kosong');
            exit();
        }
        
        
        $(document).ready(function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>/index.php/tukd/simpan_tetap_ppkd',
                data: ({tabel:'tr_tetap_ppkd',no:cno,tgl:ctgl,skpd:cskpd,ket:lcket,kdrek:lckdrek,nilai:lntotal,rek:rek,giat:kegi,ccek:cekit}),
                dataType:"json",
                success  : function(data){
                       status=data ;
                       cekit=0;
                }
            });
        });    

        alert("Data Berhasil disimpan");
        $("#dialog-modal").dialog('close');
        $('#dg').edatagrid('reload');
    } 
    
    function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data Penetapan PPKD';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        document.getElementById("nomor").disabled=true;
    }    
        
    
    function tambah(){
        lcstatus = 'tambah';
        judul = 'Input Data Penetapan PPKD';
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
	var nomor = document.getElementById('nomor').value;
	var kode = '1.20.05.01';
    var urll = '<?php echo base_url(); ?>index.php/tukd/hapus_tetap_ppkd';
        $(document).ready(function(){
            $.post(urll,({no:nomor,skpd:kode}),function(data){
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
    
    function ambil_nomor(){
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>/index.php/tukd/max_nomor',
            data: ({ckode:kode}),
            dataType:"json",
                success: function(data){
                $("#nomor").attr("value",data.tetap)
            }
        });
    }

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
<h3 align="center"><u><b><a href="#" id="section1">INPUTAN PENETAPAN PPKD</a></b></u></h3>
    <div>
    <p align="left">
            <input style="background-color:#FFFF00;width:20px;border:solid 1px #000000;" disabled/>
            <b>#Sudah di buat Penerimaan & Lunas</b>&nbsp;
            <input style="background-color:#CCFF33;width:20px;border:solid 1px #000000;" disabled/>
            <b>#Sudah di buat Penerimaan & Belum Lunas</b>&nbsp;
            <input style="background-color:#FFF;width:20px;border:solid 1px #000000;" disabled/>
            <b>#Belum di Buat Penerimaan </b> 
    </p>
    <p align="right">         
        <a class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="javascript:tambah()">Tambah</a>               
        <a class="easyui-linkbutton" id="ha" iconCls="icon-cancel" plain="false" onclick="javascript:hapus();">Hapus</a>
        <a class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="javascript:cari();">Cari</a>
        <input type="text" value="" id="txtcari"/>
        <table id="dg" title="Daftar data penetapan PPKD" style="width:870px;height:450px;" >  
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
                <td>No. TETAP</td>
                <td></td>
                <td><input type="text" id="nomor" style="width: 300px;" /></td>  
            </tr>            
            <tr>
                <td>Tanggal</td>
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
                 <input type="text" id="nmrek" style="border:0;width: 500px;" readonly="true"/></td>                
            </tr>            
            <tr>
                <td>Nilai</td>
                <td></td>
                <td><input type="text" id="nilai" style="width: 150px; text-align: right;" /></td> 
            </tr>
            <tr>
                <td>Keterangan</td>
                <td colspan="2"><textarea rows="2" cols="50" id="ket" style="width: 740px;"></textarea>
                </td> 
            </tr>
            <tr>
                <td colspan="3" align="center"><a id="sa" class="easyui-linkbutton" iconCls="icon-save" plain="false" onclick="javascript:simpan_tetap();">Simpan</a>
                <a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:keluar();">Kembali</a>
                </td>                
            </tr>
        </table>       
    </fieldset>
</div>      
</body>
</html>