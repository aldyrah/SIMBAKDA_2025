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
	
	$(document).ready(function(){
      $('#nilai').maskMoney({thousands:',', decimal:'.', precision:0});
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
                width:100,
                align:"left"},
                {field:'tgl_terima',
                title:'Tanggal',
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
              nomor     = rowData.no_terima;
              no_tetap  = rowData.no_tetap;
              tgl       = rowData.tgl_terima;
              kode      = rowData.kd_skpd;
              lcket     = rowData.keterangan;
              lcrek     = rowData.kd_rek5;
              rek       = rowData.kd_rek;
              lcnilai   = rowData.nilai;
              sts       = rowData.sts_tetap;
              nil_tetap = number_format(rowData.nil_tetap,0,'.',',');
              cekit     = 0;
              cekidot   = 0;
              lcidx     = rowIndex;
              get(nomor,no_tetap,tgl,kode,lcket,lcrek,rek,lcnilai,sts,nil_tetap);   
            },
            onDblClickRow:function(rowIndex,rowData){
              nomor     = rowData.no_terima;
              no_tetap  = rowData.no_tetap;
              tgl       = rowData.tgl_terima;
              kode      = rowData.kd_skpd;
              lcket     = rowData.keterangan;
              lcrek     = rowData.kd_rek5;
              rek       = rowData.kd_rek;
              lcnilai   = number_format(rowData.nilai,0,'.',',');
              sts       = rowData.sts_tetap;
              nil_tetap = number_format(rowData.nil_tetap,0,'.',',');
              cekit     = 0;
              cekidot   = 0;
              lcidx     = rowIndex;
              get(nomor,no_tetap,tgl,kode,lcket,lcrek,rek,lcnilai,sts,nil_tetap);
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
           panelWidth:520,  
           idField:'no_tetap',  
           textField:'no_tetap',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/tukd/load_no_tetap_ppkd',
           queryParams:({kd:kode}),             
           columns:[[  
               {field:'no_tetap',title:'No Penetapan',width:170},  
               {field:'tgl_tetap',title:'Tanggal',width:80},
               {field:'nilai1',title:'Nilai',width:120,align:'right'},
               {field:'sisa_byr2',title:'Sisa',width:120,align:'right'}]],  
           onSelect:function(rowIndex,rowData){
            var ststagih='1';
            $("#tgltetap").attr("value",rowData.tgl_tetap);
            $("#rek").combogrid("setValue",rowData.kd_rek5);
            $("#keterangan").attr("value",rowData.ket);
            $("#nilai_tetap").attr("value",number_format(rowData.nilai,0,'.',','));
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
//            title: "No STS Sudah Ada, Yakin Mau Simpan ?",
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

    function get(nomor,no_tetap,tgl,kode,lcket,lcrek,rek,lcnilai,sts,nil_tetap){
        $("#notetap").combogrid("setValue",no_tetap);
        $("#nomor").attr("value",nomor);
        $("#tanggal").datebox("setValue",tgl);
        $("#rek").combogrid("setValue",lcrek);
        $("#rek1").attr("Value",rek);
        $("#nilai").attr("value",lcnilai);
        $("#ket").attr("value",lcket);
        $("#nilai_tetap").attr("value",nil_tetap);
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
        $("#rek").combogrid("clear");
        $("#rek").combogrid('grid').datagrid('reload');
        $("#rek1").attr("Value",'');
        $("#nmskpd").attr("value",'');
        $("#nmrek").attr("value",'');
        $("#nilai").attr("value",'');
        $("#nilai_tetap").attr("value",'');        
        $("#ket").attr("value",'');
        $("#notetap").combogrid("clear");
        $("#notetap").combogrid('grid').datagrid('reload');        
        $("#tgltetap").attr("value",'');
        $("#status").attr("checked",false);      
        $("#tagih").hide();
        $('#sa').linkbutton('enable');
        $('#ha').linkbutton('enable');
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
        var cno             = document.getElementById('nomor').value;
        var ctgl            = $('#tanggal').datebox('getValue');
        var cskpd           = '1.20.05.01';
        var lckdrek         = $('#rek').combogrid('getValue');
        var rek             = document.getElementById('rek1').value;
        var kdgiat          = document.getElementById('giat').value;
        var lcket           = document.getElementById('ket').value;
        var lntotal         = angka(document.getElementById('nilai').value);
var a=      document.getElementById('nilai').value;
        var cstatus         = document.getElementById('status').checked;
        var lntotal_tetap   = angka(document.getElementById('nilai_tetap').value);
        
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
           if (rek==''){
            alert('Rekening Tidak Boleh Kosong');
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
                url: '<?php echo base_url(); ?>/index.php/tukd/simpan_terima_ppkd',
                data: ({tabel:'tr_terima_ppkd',no:cno,tgl:ctgl,skpd:cskpd,ket:lcket,kdrek:lckdrek,nilai:lntotal,rek:rek,nottp:ctetap,tglttp:ctgltetap,sts:cstatus,giat:kdgiat,ccek:cekit,lntotal_tetap:lntotal_tetap}),
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
           panelWidth:520,  
           idField:'no_tetap',  
           textField:'no_tetap',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/tukd/load_no_tetap_ppkd',
           queryParams:({kd:kode}),             
           columns:[[  
               {field:'no_tetap',title:'No Penetapan',width:170},  
               {field:'tgl_tetap',title:'Tanggal',width:80},
               {field:'nilai1',title:'Nilai',width:120,align:'right'},
               {field:'sisa_byr2',title:'Sisa',width:120,align:'right'}
           ]], 
           onSelect:function(rowIndex,rowData){
            var ststagih='1';
            $("#tgltetap").attr("value",rowData.tgl_tetap); 
            $("#rek").combogrid("setValue",rowData.kd_rek5);
            $("#rek1").attr("Value",rowData.kd_rek_lo);
            $("#ket").attr("value",rowData.keterangan);
            $("#nilai").attr("value",number_format(rowData.sisa_byr,0,'.',','));
            $("#nilai_tetap").attr("value",number_format(rowData.nilai,0,'.',','));
           }
        });
        $("#notetap").combogrid("clear");
        $("#notetap").combogrid('grid').datagrid('reload');
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
        var rows  = $("#dg").edatagrid("getSelected") ;
        var nobkt = rows.no_terima; 
        var sts_t = rows.sts_tetap; 
        var notet = rows.no_tetap; 
swal({
          title:"<a style='font-size:large;'>Hapus Penerimaan No </a> <a style='color:red;font-size:large;'>"+nobkt+"</a> <a style='font-size:large;'>?</a>" ,
          text:"Apakah anda yakin akan Menghapus ??",
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
         $.post(urll,({no:nobkt,skpd:kode,sts_t:sts_t,notet:notet}),function(data){
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

    function cek_sisa(){
     var cstatus        = document.getElementById('status').checked;
     var nomor      = document.getElementById('nomor').value;
     if (cstatus==false){
           cek_simpan_terima();
        }else if(cstatus==true){
          var nil = angka(document.getElementById('nilai').value); 
          var nil_t = angka(document.getElementById('nilai_tetap').value); 
          var cno = $('#notetap').combogrid('getValue'); 
          $.ajax({
            type:'post',
            data:({no:cno,ntrm:nomor}),
            url :"<?php echo base_url(); ?>/index.php/tukd/ceksisa",
            dataType:"json",
            success:function(data){
              $.each(data,function(i,n){
                  var bayar = angka(n['bayar']); 
                  var byr = number_format(bayar,0,',','.');
                  var hasil= bayar+nil; 
                  var sel2 = nil_t-bayar;
                  var s = number_format(sel2,0,',','.');
                  if(hasil>nil_t){
                    alert('Pembayaran Atas Penetapan  '+cno+' yang Sudah Dibayarkan Sebesar  '+byr+' , Sisa yang Harus Dibayar Sebesar '+s);
                    exit();
                  }else if(hasil<=nil_t){
                    cek_simpan_terima();
                  }
              });
            }
          });
      }
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
            <a class="easyui-linkbutton" iconCls="icon-cancel" plain="false" onclick="javascript:hapus();">Hapus</a>
            <a class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="javascript:cari();">Cari</a>
            <input type="text" value="" id="txtcari"/>
            <table id="dg" title="Daftar data penerimaan PPKD" style="width:870px;height:450px;" >  
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
            <td><input type="text" id="nomor" style="width: 300px;" /></td>  
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
            <td><input id="rek" name="rek" style="width: 100px;" /> <input id="rek1" style="width: 100px;" readonly="true"/><input type="hidden" id="giat" style="width: 140px;" readonly="true"/>
             <input type="text" id="nmrek" style="border:0;width: 600px;" readonly="true"/></td>                
        </tr>            
        <tr>
            <td>Nilai</td>
            <td></td>
            <td><input type="text" id="nilai" style="width: 150px; text-align: right;" />
               &nbsp;&nbsp; Nilai Penetapan &nbsp;&nbsp; <input type="text" id="nilai_tetap" style="width: 150px; text-align: right;" disabled readonly="true"/></td> 
        </tr>
        <tr>
            <td>Keterangan</td>
            <td colspan="2"><textarea rows="2" cols="50" id="ket" style="width: 600px;"></textarea>
            </td> 
        </tr>
        <tr>
            <td colspan="3" align="center"><a class="easyui-linkbutton" iconCls="icon-save" plain="false" onclick="javascript:cek_sisa();">Simpan</a>
            <a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:keluar();">Kembali</a>
            </td>                
        </tr>
    </table>       
    </fieldset>
</div>
</body>
</html>