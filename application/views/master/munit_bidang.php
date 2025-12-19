
    <script type="text/javascript">
    
    var kdkel= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
                    
     $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
            height: 400,
            width: 800,
            modal: true,
            autoOpen:false,
        });
        });    
     
     $(function(){

      $('#kd_skpd').combogrid({  
       panelWidth:500,  
       idField:'kd_skpd',  
       textField:'kd_skpd',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_msskpd',  
       columns:[[  
           {field:'kd_skpd',title:'KODE OPD',width:100},  
           {field:'nm_skpd',title:'NAMA OPD',width:400}    
       ]],
       onSelect:function(rowIndex,rowData){
          skpd=rowData.kd_skpd;
            $('#nmskpd').attr('value',rowData.nm_skpd);
            if(lcstatus=='tambah'){
            $('#kdbidskpd').combogrid('clear');
            $('#kdunit').attr('value','');
            $('#nmbidang').attr('value','');
          }
            $('#kdbidskpd').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_bidskpd',
            queryParams:({skpd:skpd})
        }); 
       }
     });
     
     $('#kdbidskpd').combogrid({  
       panelWidth:400,  
       idField:'kd_bidskpd',  
       textField:'kd_bidskpd',  
       mode:'remote',
       //url:'<?php echo base_url(); ?>index.php/master/ambil_bidskpd',  
       columns:[[  
           {field:'kd_bidskpd',title:'KODE BIDANG',width:100},  
           {field:'nm_bidskpd',title:'NAMA BIDANG',width:300}
       ]],  
       onSelect:function(rowIndex,rowData){
           if (lcstatus == 'tambah'){
           $("#kdunit").attr("value",rowData.kd_bidskpd.toUpperCase()+'.');
           $('#nmbidang').attr('value',rowData.nm_bidskpd);
           }                 
       }  
     });   
        
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/master/load_unit_bidang',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'kd_uskpd',
    		title:'Kode Unit',
    		width:15,
            align:"center"},
            {field:'nm_uskpd',
    		title:'Nama Unit',
    		width:40,
            align:"left"},
            {field:'kd_bidskpd',
    		title:'Kode Bidang',
    		width:15,
            align:"center"},
            {field:'kd_skpd',
        title:'Kode OPD',
        width:15,
            align:"center"},
            {field:'nm_skpd',
        title:'Kode SKPD',
        width:15,
            align:"center",
            hidden:true},
			{field:'hapus',width:5,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus();'' />";}}
        ]],
        onSelect:function(rowIndex,rowData){
          lcidx = rowIndex;
          kdunit = rowData.kd_uskpd;
          nmunit = rowData.nm_uskpd;
          kdbidskpd  = rowData.kd_bidskpd;
          lcalamat = rowData.alamat;
          kd_skpd = rowData.kd_skpd;
          nm_skpd =rowData.nm_skpd;

          get(kdunit,nmunit,kdbidskpd,lcalamat,kd_skpd,nm_skpd);   
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
          lcidx = rowIndex;
          judul = 'Edit Data Bidang'; 
          lcstatus = 'edit';
          kdunit = rowData.kd_uskpd;
          nmunit = rowData.nm_uskpd;
          kdbidskpd  = rowData.kd_bidskpd;
          lcalamat = rowData.alamat;
          kd_skpd = rowData.kd_skpd;
          nm_skpd =rowData.nm_skpd;
          $("#kdbidskpd").combogrid("setValue",kdbidskpd);
          get(kdunit,nmunit,kdbidskpd,lcalamat,kd_skpd,nm_skpd);  
          edit_data();   
        }
        
        });
       
    });        

      
    function  get(kdunit,nmunit,kdbidskpd,lcalamat,kd_skpd,nm_skpd){
        $("#kdunit").attr("value",kdunit);
        $("#nmunit").attr("value",nmunit);
        $("#kdbidskpd").combogrid("setValue",kdbidskpd);
        $("#alamat").attr("value",lcalamat);
        $("#kd_skpd").combogrid("setValue",kd_skpd);
        $("#nmskpd").attr("value",nm_skpd);
                       
    }
    
    function kosong(){
        $("#kdunit").attr("value",'');
        $("#kd_skpd").combogrid("clear");
        $("#nmunit").attr("value",'');
        $("#kdbidskpd").combogrid("clear");
        $("#alamat").attr("value",'');
        $("#nmskpd").attr("value",'');
    }
    
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    //alert(kriteria);
    $(function(){
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/master/load_unit_bidang',
        queryParams:({cari:kriteria})
        });        
     });
    }

     function cek_kd_unit(){
    var kdunit = document.getElementById('kdunit').value;
    var skpd = $("#kd_skpd").combogrid("getValue"); 
    var kdbidskpd=$('#kdbidskpd').combogrid('getValue');
    if(lcstatus=='tambah'){
    $.ajax({
      type:'post',
      data:({kd_unit:kdunit,kd_skpd:skpd,kd_bid:kdbidskpd}),
      url :"<?php echo base_url(); ?>/index.php/master/cek_kd_unit",
      dataType:"json",
      success:function(data){
        $.each(data,function(i,n){
            var xxx = n['jumlah'];
            
            if(xxx==1){
              alert('Kode Unit '+kdunit+' telah Terpakai  ..!!');
              
              document.getElementById('kdunit').focus();
              exit();
            }else{
               simpan(); 
            }
        });
      }
    });
  }else{
    simpan();
  }
  }
    
    function simpan(){
        
        var ckdunit = document.getElementById('kdunit').value;
        var cnmunit = document.getElementById('nmunit').value;
        var ckdbidskpd = $('#kdbidskpd').combogrid('getValue');
        var calamat = document.getElementById('alamat').value;
        var kd_skpd = $("#kd_skpd").combogrid("getValue");
        var nmskpd = document.getElementById('nmskpd').value;
                        
        if (ckdunit==''){
            alert('Kode Unit Tidak Boleh Kosong');
            exit();
        } 
        
        if (cnmunit==''){
            alert('Nama Unit Tidak Boleh Kosong');
            exit();
        } 
        
        if (ckdbidskpd==''){
            alert('Bidang Tidak Boleh Kosong');
            exit();
        } 

        if(lcstatus=='tambah'){
            
            lcinsert = "(kd_uskpd,nm_uskpd,kd_bidskpd,alamat,kd_skpd,nm_skpd)";
            lcvalues = "('"+ckdunit+"','"+cnmunit+"','"+ckdbidskpd+"','"+calamat+"','"+kd_skpd+"','"+nmskpd+"')";
            
            
            $(document).ready(function(){
                $.ajax({
                    type: "POST",
                    //url: '<?php echo base_url(); ?>index.php/master/simpan_master',
                    //data: ({tabel:'unit_skpd',kolom:lcinsert,nilai:lcvalues,cid:'kd_uskpd',lcid:ckdunit}),
                    url: '<?php echo base_url(); ?>index.php/master/simpan_unitbidang',
                    data: ({tabel:'unit_skpd',kolom:lcinsert,nilai:lcvalues,cid:'kd_uskpd',lcid:ckdunit,cid2:'kd_skpd',skpd:kd_skpd}),
                    dataType:"json"
                });
            });    
            
            
        $('#dg').datagrid('appendRow',{kd_uskpd:ckdunit,nm_uskpd:cnmunit,kd_bidskpd:ckdbidskpd,alamat:calamat,kd_skpd:kd_skpd,nm_skpd:nmskpd});
        }else {
            
            lcquery = "UPDATE unit_skpd SET nm_uskpd='"+cnmunit+"',kd_bidskpd='"+ckdbidskpd+"', alamat='"+calamat+"' where kd_uskpd='"+ckdunit+"' and kd_skpd='"+kd_skpd+"'";
            
            $(document).ready(function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>index.php/master/update_master',
                data: ({st_query:lcquery}),
                dataType:"json"
            });
            });
            
            
            
                $('#dg').datagrid('updateRow',{
            	index: lcidx,
            	row: {
            		kd_uskpd: ckdunit,
            		nm_uskpd: cnmunit,
                    kd_bidskpd: ckdbidskpd,
                    alamat:calamat,
                    kd_skpd:kd_skpd,
                    nm_skpd:nmskpd             
            	}
            });
        }
       
        
        alert("Data Berhasil disimpan");
        $("#dialog-modal").dialog('close');
        //section1();
    } 
    
      function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data Bidang';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        document.getElementById("kdunit").disabled=true;
        }    
        
    
     function tambah(){
        lcstatus = 'tambah';
        judul = 'Input Data Unit Bidang';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
        $("#dialog-modal").dialog('open');
        document.getElementById("kdunit").disabled=false;
        document.getElementById("kdunit").focus();
        $('#nmskpd').attr('value','');
        $('#nmbidang').attr('value','');
        } 
     function keluar(){
        $("#dialog-modal").dialog('close');
     }    
    
     function hapus(){
        /*var ckdunit = document.getElementById('kdunit').value;
        var skpd = $('#kdskpd').combogrid('getValue');*/
        var rows = $('#dg').datagrid('getSelected');
        skpd=rows.kd_skpd;
        ckdunit=rows.kd_uskpd;
        var idx = $('#dg').datagrid('getRowIndex',rows);
        if (ckdunit !=''){
		var del=confirm('Apakah Anda yakin ingin Menhapus data '+ckdunit+' di SKPD '+skpd+'  ?');
		if (del==true){       
        var urll = '<?php echo base_url(); ?>index.php/master/del_ubid';
        $(document).ready(function(){
         $.post(urll,({tabel:'unit_skpd',cnid:ckdunit,cid:'kd_uskpd',cid2:'kd_skpd',skpd:skpd}),function(data){
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
<h3 align="center"><u><b><a>INPUTAN UNIT BIDANG OPD</a></b></u></h3>
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
        <table id="dg" align="center" title="LISTING DATA UNIT BIDANG OPD" style="width:900px;height:365px;" >  
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
            <td>OPD</td>
            <td>:</td>
            <td><input id="kd_skpd" name="kd_skpd" style="width:100px;"/>&nbsp;&nbsp;<input id="nmskpd" name="nmskpd" style="width:200px;border:0"></td>
          </tr>
           <tr>
                <td>BIDANG</td>
                <td>:</td>
                <td><input id="kdbidskpd" name="kdbidskpd" style="width: 100px;" /> <input id="nmbidang" name="nmbidang" style="width:200px;border:0"></td>
           </tr>
           <tr>
                <td width="30%">KODE UNIT BIDANG</td>
                <td width="1%">:</td>
                <td><input type="text" id="kdunit" style="width:200px;"/></td>  
            </tr>            
            <tr>
                <td width="30%">NAMA UNIT BIDANG</td>
                <td width="1%">:</td>
                <td><input type="text" id="nmunit" style="width:450px;"/></td>  
            </tr>
            <tr>
                <td>ALAMAT</td>
                <td width="1%">:</td>
                <td><textarea rows="2" cols="50" id="alamat" style="width: 450px;"></textarea>
                </td> 
            </tr>
            <tr>
             <td colspan="4">&nbsp;</td>
            </tr>            
            <tr>
                <td colspan="4" align="center"><a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:cek_kd_unit();">Simpan</a>
		        <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Kembali</a>
                </td>                
            </tr>
        </table>  
            
    </fieldset> 
</div>

