<!--  <script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery-1.8.0.min.js"></script> -->
<!--   <script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.easyui.min.js"></script> -->
<!--   <script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.edatagrid.js"></script> -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/autoCurrency.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/numberFormat.js"></script>
<!--  <script src="<?php echo base_url(); ?>easyui/jquery-ui.min.js"></script> -->
<!--   <script src="<?php echo base_url(); ?>assets/sweetalert/lib/sweet-alert.min.js"></script> -->
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery.maskMoney.min.js"></script>    
    <script type="text/javascript">
    
    var kdkel= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
    var nilai = 0;
    
                    
     $(document).ready(function() {
            $("#accordion").accordion();                  
            $( "#dialog-modal" ).dialog({
            height: 300,
            width: 800,
            modal: true,
            autoOpen:false,
        });
        });
 

      
     $(function(){
        $('#kdskpd').combogrid({  
            panelWidth:500,  
            idField:'kd_distrik',  
            textField:'kd_distrik',  
            mode:'remote',                      
            url:'<?php echo base_url(); ?>index.php/master/ambil_distrik',  
            columns:[[  
               {field:'kd_distrik',title:'Kode Distrik',width:100},  
               {field:'nm_distrik',title:'Nama Distrik',width:300}
            ]],  
            onSelect:function(rowIndex,rowData){
               cuskpd     = rowData.kd_distrik;    
               nmskpd     = rowData.nm_distrik; 
               $("#nmskpd").attr("value",nmskpd);

            } 
         });

    
    $(document).ready(function(){
      $('#nilai').maskMoney({thousands:',', decimal:'.', precision:0});
    });  
          
     $('#dg').edatagrid({
        url: '<?php echo base_url(); ?>index.php/master/load_unit',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
            {field:'kd_unit',
            title:'Kode Sub Alamat',
            width:15,
            align:"left"},
            {field:'nm_unit',
            title:'Nama Sub Alamat',
            width:30,
            align:"left"},
            {field:'nm_distrik',
            title:'Nama Distrik',
            width:20,
            align:"left"},
            {field:'hapus',width:5,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus();'' />";}}


        ]],
        onSelect:function(rowIndex,rowData){
          lcidx = rowIndex;
          kdpaket = rowData.kd_unit;
          kdskpd = rowData.kd_distrik;
          nmpaket = rowData.nm_unit;
          get(kdpaket,kdskpd,nmpaket);    
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
          lcidx = rowIndex;
          judul = 'Edit Data Sub Alamat'; 
          lcstatus = 'edit';
          kdpaket = rowData.kd_unit;
          kdskpd = rowData.kd_distrik;
          nmpaket = rowData.nm_unit;
          get(kdpaket,kdskpd,nmpaket);  
          edit_data();   
        } 
        });
    });        

      
    function get(kdpaket,kdskpd,nmpaket){
        $("#kdpaket").attr("value",kdpaket);
        $("#kdskpd").combogrid("setValue",kdskpd);
        $("#nmpaket").attr("value",nmpaket);
        // $("#nilai").attr("value",nilai);                       
    }
    
    function kosong(){
        $("#kdpaket").attr("value",'');
        $("#kdskpd").combogrid("setValue",'');
        $("#nmpaket").attr("value",'');
        // $("#nilai").attr("value",0);
        // max_rinci();
    }
    
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    
    $(function(){
     $('#dg').edatagrid({
        url: '<?php echo base_url(); ?>index.php/master/load_unit',
        queryParams:({cari:kriteria})
        });        
     });
    }
    
    function simpan(){
        
        var ckdpaket = document.getElementById('kdpaket').value;
        // var nilai = document.getElementById('nilai').value;
        // var nilai = angka(document.getElementById('nilai').value);
        // alert(nilai);
        //var ckdskpd = document.getElementById('kdskpd').value;
        var ckdskpd = $('#kdskpd').combogrid('getValue');
        var cnmpaket = document.getElementById('nmpaket').value;
        var cnmskpd = document.getElementById('nmskpd').value;
        //alert(ckdskpd);
                        
        if (ckdpaket==''){
            alert('Kode Sub Alamat Tidak Boleh Kosong');
            exit();
        } 
        
        if (ckdskpd==''){
            alert('Kode Distrik Tidak Boleh Kosong');
            exit();
        } 
        if (cnmpaket==''){
            alert('Nama Sub Alamat Tidak Boleh Kosong');
            exit();
        } 
        

        if(lcstatus=='tambah'){
            
            lcinsert = "(kd_unit,kd_distrik,nm_unit)";
            lcvalues = "('"+ckdpaket+"','"+ckdskpd+"','"+cnmpaket+"')";
            // alert(lcvalues);
            
            
            $(document).ready(function(){
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>index.php/master/simpan_master',
                    data: ({tabel:'m_unit',kolom:lcinsert,nilai:lcvalues,cid:'kd_unit',lcid:ckdpaket}),
                    dataType:"json"
                });
            });    
            
            
        $('#dg').datagrid('appendRow',{kd_paket:ckdpaket,kd_skpd:ckdskpd,nm_paket:cnmpaket,nilai:nilai});
        $('#dg').edatagrid('reload');
        }else {
            
            lcquery = "UPDATE m_unit SET kd_distrik='"+ckdskpd+"',nm_unit='"+cnmpaket+"' where kd_unit='"+ckdpaket+"'";
            
            $(document).ready(function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>/index.php/master/update_master',
                data: ({st_query:lcquery}),
                dataType:"json"
            });
            });
            
            
            
                $('#dg').datagrid('updateRow',{
                index: lcidx,
                row: {
                    nm_unit: cnmpaket,
                    kd_distrik: ckdskpd  
                }
            });
        }
       
        
        alert("Data Berhasil disimpan");
        //$("#dialog-modal").dialog('close');
    } 
    
      function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data Sub Alamat';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        document.getElementById("kdpaket").disabled=true;
        }    
        
    
     function tambah(){
        lcstatus = 'tambah';
        judul = 'Input Data Sub Alamat';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
        $("#dialog-modal").dialog('open');
        // document.getElementById("kdpaket").disabled=true;
        document.getElementById("kdpaket").focus();
        } 
     function keluar(){
        $("#dialog-modal").dialog('close');
     }    
    
     function hapus(){
        var ckdpaket = document.getElementById('kdpaket').value;
        if (ckdpaket !=''){
        var del=confirm('Apakah Anda yakin ingin Menhapus data '+ckdpaket+'?');
        if (del==true){
        var urll = '<?php echo base_url(); ?>index.php/master/hapus_master';
        $(document).ready(function(){
         $.post(urll,({tabel:'m_unit',cnid:ckdpaket,cid:'kd_unit'}),function(data){
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
        });    }}
    } 
  
   </script>



<div id="content1"> 
<h2 align="center"><b>INPUTAN MASTER DATA SUB ALAMAT</b></h2>
    <div align="center">
    <p>     
    <table style="width:400px;" border="0">
        <tr>
        <td width="10%">
        <a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:tambah()">Tambah</a></td>               
        <td width="5%"><a class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="javascript:cari();">Cari</a></td>
        <td><input type="text" value="" id="txtcari" style="width:300px;"/></td>
        </tr>
        <tr>
        <td colspan="4">
        <table id="dg" align="center" title="LISTING DATA SUB ALAMAT" style="width:900px;height:365px;" >  
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
                <td width="30%">KODE SUB ALAMAT</td>
                <td width="1%">:</td>
                <td><input type="text" id="kdpaket" style="width:80px;"/></td>  
            </tr>   
             <tr>
                <td width="30%">KODE DISTRIK</td>
                <td width="1%">:</td>
                <td><input type="text" id="kdskpd" style="width:50px;"/>
                <input type="text" id="nmskpd" style="width:250px;"/></td>   
            </tr>          
            <tr>
                <td width="30%">NAMA SUB ALAMAT</td>
                <td width="1%">:</td>
                <td><input type="text" id="nmpaket" style="width:450px;"/></td>  
            </tr>
            <tr>
             <td colspan="4">&nbsp;</td>
            </tr>            
            <tr>
                <td colspan="4" align="center"><a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:simpan();">Simpan</a>
                <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Kembali</a>
                </td>                
            </tr>
        </table>  
            
    </fieldset> 
</div>

