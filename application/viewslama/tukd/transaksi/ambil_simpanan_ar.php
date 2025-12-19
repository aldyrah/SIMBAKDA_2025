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
    
    
    var kode     = '';
    var giat     = '';
    var nomor    = '';
    var judul    = '';
    var cid      = 0 ;
    var lcidx    = 0 ;
    var lcstatus = '';
    var ccek     = 0 ;
  
    
    $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
        height: 500,
        width: 900,
        modal: true,
        autoOpen:false,
      });
      });  
    


     $(function(){ 
     $('#dg').edatagrid({
    url: '<?php echo base_url(); ?>/index.php/tukd/load_ambilsimpanan',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
          {field:'no_kas',
        title:'Nomor Kas',
        width:50,
            align:"center"},
          {field:'no_bukti',
        title:'Nomor Bukti',
        width:40,
            align:"left"},
            {field:'tgl_kas',
        title:'Tanggal Kas',
        width:30,
            align:"center"}, 
            {field:'kd_skpd',
        title:'S K P D',
        width:30,
            align:"center"},
            {field:'nilai',
        title:'N I L A I',
        width:50,
            align:"center"}
        ]],
        onSelect:function(rowIndex,rowData){
          nomor   = rowData.no_kas;
          tgl     = rowData.tgl_kas;
          no_bukti   = rowData.no_bukti;
          tgl_bukti  = rowData.tgl_bukti;
          kode    = rowData.kd_skpd;
          lnnilai = rowData.nilai;
          lcbank  = rowData.bank;
          //lcnmrek = rowData.nm_rekening;
          lcket   = rowData.keterangan;
          lcsp2d   = rowData.no_sp2d;
          lcidx   = rowIndex;
          get(nomor,tgl,no_bukti,tgl_bukti,kode,lnnilai,lcbank,lcket,lcsp2d);   
        },
        onDblClickRow:function(rowIndex,rowData){
           lcidx = rowIndex;
           nomor   = rowData.no_kas;
           tgl     = rowData.tgl_kas;
           no_bukti   = rowData.no_bukti;
           tgl_bukti  = rowData.tgl_bukti;
           kode    = rowData.kd_skpd;
           lnnilai = rowData.nilai;
           lcbank  = rowData.bank;
           //lcnmrek = rowData.nm_rekening;
           lcket   = rowData.keterangan;
           lcsp2d   = rowData.no_sp2d;
           lcidx   = rowIndex;
           get(nomor,tgl,no_bukti,tgl_bukti,kode,lnnilai,lcbank,lcket,lcsp2d);
           judul = 'Edit Data Penetapan'; 
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
            },
            onSelect: function(date){
          jaka = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
         }
        });

        $('#tgl_bukti').datebox({  
            required:true,
            formatter :function(date){
              var y = date.getFullYear();
              var m = date.getMonth()+1;
              var d = date.getDate();
              return y+'-'+m+'-'+d;
            },
            onSelect: function(date){
          jaka1 = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
         }
        });
    
        
        $('#dinas').combogrid({  
           panelWidth:700,  
           idField:'kd_skpd',  
           textField:'kd_skpd',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/tukd/skpd',  
           columns:[[  
               {field:'kd_skpd',title:'Kode SKPD',width:100},  
               {field:'nm_skpd',title:'Nama SKPD',width:700}    
           ]],  
           onSelect:function(rowIndex,rowData){
               kode = rowData.kd_skpd;               
               $("#nmskpd").attr("value",rowData.nm_skpd.toUpperCase());
           }  
        });
   
        
        $('#bank').combogrid({  
           panelWidth:700,  
           idField:'kode',  
           textField:'kode',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/tukd/config_bank_simpanan',  
           columns:[[  
               {field:'kode',title:'Kode Bank',width:100},  
               {field:'nama',title:'Nama Bank',width:700}    
           ]],  
           onSelect:function(rowIndex,rowData){
               kode_bank = rowData.kode;               
               $("#nmbank").attr("value",rowData.nama.toUpperCase());
           }  
        });
    
    $('#sp2d').combogrid({  
      panelWidth:500,  
      url: '<?php echo base_url(); ?>/index.php/tukd/load_sp2d_simpanan',  
        idField:'no_sp2d',  
        textField:'no_sp2d',
        mode:'remote',  
        fitColumns:true,                       
        columns:[[  
          {field:'no_sp2d',title:'No SP2D',width:150},  
          {field:'tgl_kas',title:'Tgl Cair',align:'left',width:50},
          {field:'nilai',title:'Nilai SP2D',align:'right',width:50}                          
        ]],
        onClickRow:function(rowIndex, rowData){
        sp2d   = rowData.no_sp2d;
        tgl_kas = rowData.tgl_kas;
        $('#sp2d').combogrid('setValue',rowData.no_sp2d);
        $("#tanggal_sp2d").attr("Value",tgl_kas);
        salbank();                                                                         
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
     
     
       
    function get(nomor,tgl,no_bukti,tgl_bukti,kode,lnnilai,lcbank,lcket,lcsp2d){
        $("#nomor").attr("value",nomor);
        $("#tanggal").datebox("setValue",tgl);
        $("#no_bukti").attr("value",no_bukti);
        $("#tgl_bukti").datebox("setValue",tgl_bukti);
        $("#dinas").combogrid("setValue",kode); 
        $("#nilai").attr("value",lnnilai);
        $("#bank").combogrid("setValue",lcbank);
        //$("#nmrek").attr("value",lcnmrek);
        $("#ket").attr("value",lcket);
        $("#dinas").combogrid('disable');
        $("#sp2d").combogrid("setValue",lcsp2d);
        $("#sp2d").combogrid('disable');
        //$("#skpd").combogrid('disable');
    }
    
    function kosong(){
        //$("#nomor").attr("value",'');
        cdate = '<?php echo date("Y-m-d"); ?>';
        $("#tanggal").datebox("setValue",cdate);
        $("#no_bukti").attr("value",'');
        $("#tgl_bukti").datebox("setValue",cdate);
        $("#nilai").attr("value",'');
        $("#bank").combogrid("setValue",'');
        $("#nmbank").attr("value",'');
        //$("#nmrek").attr("value",'');
        $("#ket").attr("value",'');
    var skpd     ='<?php echo $this->session->userdata('kdskpd'); ?>';
    $("#dinas").combogrid("setValue",skpd);
    ambil_nomor();
        $("#dinas").combogrid('disable');
        $("#salbank1").attr("value",'');
        $("#sp2d").combogrid("setValue",'');
        ccek=1;
    }
    
    
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    $(function(){ 
     $('#dg').edatagrid({
    url: '<?php echo base_url(); ?>/index.php/tukd/cari_ambilsimpanan',
        queryParams:({cari:kriteria})
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
        $("#nomor").attr("value",data.nomor);
      }
    });
  }
    
    
     function simpan_ambilsmp(){
        
        var cno     = document.getElementById('nomor').value;
        var ctgl    = $('#tanggal').datebox('getValue');
        var cno_bukti  = document.getElementById('no_bukti').value;
        var ctgl_bukti = $('#tgl_bukti').datebox('getValue');
        var cskpd   = $('#dinas').combogrid('getValue');
        var lnnilai = angka(document.getElementById('nilai').value);
        var cbank   = $('#bank').combogrid('getValue');
        //var cnmrek  = document.getElementById('nmrek').value;
        var lcket   = document.getElementById('ket').value;
        var salbank    = document.getElementById('salbank').value;
        var csp2d      = $('#sp2d').combogrid('getValue');
        
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
        if (salbank<lnnilai){
            alert('Saldo Bank Tidak Boleh Lebih Kecil Dari Nilai');
            exit();
        }
        
        
        if (lcstatus=='tambah'){ 
                    
                    lcinsert = "(no_kas,tgl_kas,no_bukti,tgl_bukti,kd_skpd,nilai,bank,keterangan,no_sp2d)";
                    lcvalues = "('"+cno+"','"+ctgl+"','"+cno_bukti+"','"+ctgl_bukti+"','"+cskpd+"','"+lnnilai+"','"+cbank+"','"+lcket+"','"+csp2d+"')";
        
                    $(document).ready(function(){
                        $.ajax({
                            type: "POST",
                            url: '<?php echo base_url(); ?>/index.php/master/simpan_master2',
                            data: ({tabel:'tr_ambilsimpanan',kolom:lcinsert,nilai:lcvalues,cid:'no_kas',lcid:cno}),
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
                 
                  } else {
                    
                    /*lcquery = "UPDATE tr_ambilsimpanan SET tgl_kas='"+ctgl+"', no_bukti='"+cno_bukti+"', tgl_bukti='"+ctgl_bukti+"', kd_skpd='"+cskpd+"', nilai='"+lnnilai+"', bank='"+cbank+"', nm_rekening='"+cnmrek+"', keterangan='"+lcket+"' where no_kas='"+cno+"' and kd_skpd='"+cskpd+"'";*/

           lcquery2 = "UPDATE tr_ambilsimpanan_ppkd SET tgl_kas='"+ctgl+"', no_bukti='"+cno_bukti+"', tgl_bukti='"+ctgl_bukti+"', kd_skpd='"+cskpd+"', nilai='"+lnnilai+"', bank='"+cbank+"', keterangan='"+lcket+"', no_sp2d=,'"+csp2d+"' where no_kas='"+cno+"' and kd_skpd='"+cskpd+"'";
                   
                    $(document).ready(function(){
                    $.ajax({
                        type: "POST",
                        url: '<?php echo base_url(); ?>/index.php/tukd/update_ambilsimpanan',
                        data: ({st_query:lcquery,st_query1:lcquery2}),
                        dataType:"json",
                        success:function(data){
                                status = data;
                                if (status=='0'){
                                    alert('Gagal Simpan..!!');
                                    exit();
                                }else{
                                    alert('Data Tersimpan..!!');
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
        judul = 'Edit Data Ambil Simpanan';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        document.getElementById("nomor").disabled=true;
        }    
        
    
    function tambah(){
        lcstatus = 'tambah';
        judul = 'Input Data Ambil Simpanan';
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
        var urll = '<?php echo base_url(); ?>index.php/tukd/hapus_ambilsimpanan';
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

    function salbank(){
    var nosp2d = $('#sp2d').combobox('getValue');
    $.ajax({
      type: "POST",
      url: '<?php echo base_url(); ?>/index.php/tukd/salbank',
      data: ({ckode:kode,cnosp2d:nosp2d}),
      dataType:"json",
        success: function(data){
        $("#salbank").attr("value",data.salbank);
        $('#salbank1').attr('value',number_format(data.salbank,0,'.',','));

      }
    });
  } 
    
   
  
    
  
   </script>

</head>
<body>

<div id="content"> 
<div id="accordion">
<h3 align="center"><u><b><a href="#" id="section1">INPUTAN AMBIL SIMPANAN</a></b></u></h3>
    <div>
    <p align="right">         
        <a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:tambah()">Tambah</a>               
        <a class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:hapus();">Hapus</a>
        <a class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="javascript:cari();">Cari</a>
        <input type="text" value="" id="txtcari"/>
        <table id="dg" title="Listing data ambil simpanan" style="width:870px;height:450px;" >  
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
                <td>S K P D</td>
                <td></td>
                <td><input id="dinas" name="dinas" style="width: 140px;" />  <input type="text" id="nmskpd" style="border:0;width: 600px;" /></td>                            
            </tr>
      <tr>
      <td>No SP2D</td>
      <td>:</td>
      <td><input id="sp2d" name="sp2d" style="width:300px; border: 0; " /><input id="tanggal_sp2d" name="tanggal_sp2d" type="text" readonly="true" style="width:100px" disabled/></td>
      </tr>

            <tr>
                <td>No. Kas</td>
                <td></td>
                <td><input type="text" id="nomor" style="width: 100px;"/></td>  
            </tr>            
            <tr>
                <td>Tgl Kas </td>
                <td></td>
                <td><input type="text" id="tanggal" style="width: 140px;" /></td>
            </tr>
            <tr>
                <td>No. Bukti</td>
                <td>:</td>
                <td><input type="text" id="no_bukti" style="width: 300px;" /></td>  
            </tr>
            <tr>
                <td>Tgl Bukti </td>
                <td>:</td>
                <td><input type="text" id="tgl_bukti" style="width: 140px;" /></td>
            </tr>
            <tr>
            <td>Saldo Bank</td>
            <td>:</td>
            <td><input type="text" id="salbank1" readonly="true" style="text-align:right;border:0;width: 150px;" disabled/>
        <input type="text" id="salbank" hidden /></td>            
        </tr>


            <tr>
                <td>Nilai</td>
                <td></td>
                <td><input type="text" id="nilai" style="width: 200px; text-align: right;" /></td> 
            </tr>
            
            <tr>
                <td>Bank</td>
                <td></td>
                <td><input type="text" id="bank" style="width: 140px;" /> <input type="text" id="nmbank" style="border:0;width: 600px;" readonly="true"/> </td>                
            </tr> 
            
            
            
           
            
            <tr>
                <td>Keterangan</td>
                <td colspan="2"><textarea rows="2" cols="50" id="ket" style="width: 740px;"></textarea>
                </td> 
            </tr>
            
            <tr>
                <td colspan="3" align="center"><a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:simpan_ambilsmp();">Simpan</a>
            <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Kembali</a>
                </td>                
            </tr>
        </table>       
    </fieldset>
</div>
    
</body>

</html>