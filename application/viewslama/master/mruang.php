<script type="text/javascript">
    
    var kdkel= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
                    
     $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
            height: 700,
            width: 950,
            modal: true,
            autoOpen:false,
        });
            $( "#dialog-modal-edit" ).dialog({
            height: 350,
            width: 950,
            modal: true,
            autoOpen:false,
        });
      });    
     
     $(function(){
     
     /*$('#kduker').combogrid({  
       panelWidth:500,  
       idField:'kd_uskpd',  
       textField:'kd_uskpd',  
       mode:'remote',
       //url:'<?php echo base_url(); ?>index.php/master/ambil_uker',  
       columns:[[  
           {field:'kd_uskpd',title:'KODE UNIT KERJA',width:100},  
           {field:'nm_uskpd',title:'NAMA UNIT KERJA',width:400}    
       ]],  
       onSelect:function(rowIndex,rowData){
           //if (lcstatus == 'tambah'){
		   lcstatus = 'tambah';
		   kd_lokasi=rowData.kd_uskpd; 
		   nm_lokasi=rowData.nm_uskpd;
           //$("#kdlokasi").attr("value",kd_lokasi.toUpperCase()+'.');
           $("#nmlokasi").attr("value",nm_lokasi.toUpperCase());   
		   nomer_akhir()            
		   $('#iz').edatagrid({url:'<?php echo base_url(); ?>index.php/master/ambil_ruang',queryParams:({kdlokasi:kd_lokasi}) });

           //}                 
       }  
     });   
	 
   $('#kdskpd').combogrid({  
       panelWidth:500,  
       idField:'kd_skpd',  
       textField:'kd_skpd',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_msskpd2',  
       columns:[[  
           {field:'kd_skpd',title:'KODE SKPD',width:100},  
           {field:'nm_skpd',title:'NAMA SKPD',width:400}    
       ]]  ,
	   onSelect:function(rowIndex,rowData){
               lcskpd = rowData.kd_lokasi;
               $('#kduker').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_uskpd',queryParams:({kduskpd:lcskpd}) });
               $("#nmskpd").attr("value",rowData.nm_skpd.toUpperCase());
                                
           }
     });*/       
		
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/master/load_lokasi_dh',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'kd_lokasi',title:'Kode Lokasi',width:15,align:"center"},
            {field:'kd_uker',title:'Kode Unit Kerja',width:15,align:"center"},
            {field:'nm_lokasi',title:'Nama Lokasi',width:30,align:"left"},
			{field:'kd_skpd',title:'Kode OPD',width:10,align:"center"},			
			{field:'home',title:'Add Room',width:7,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/home.png' onclick='javascript:edit_data();'' />";}},
			//{field:'hapus',title:'Del',width:4,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus();'' />";}}

        ]],
        onSelect:function(rowIndex,rowData){
          lcidx = rowIndex;
          kdlok = rowData.kd_lokasi;
          nmlok = rowData.nm_lokasi;
          kduker  = rowData.kd_uker;
          nmuker  = rowData.nm_uker;
		      kdskpd  = rowData.kd_skpd;
          nmskpd = rowData.nm_skpd
          get(kdlok,nmlok,kduker,nmuker,kdskpd,nmskpd); 		   
		  //nomer_akhir()  
      $('#iz').edatagrid({url:'<?php echo base_url(); ?>index.php/master/ambil_ruang',queryParams:({kdlokasi:kdlok}) });          
           
        },
        onDblClickRow:function(rowIndex,rowData){
          lcidx = rowIndex;
          judul = 'Edit Data Lokasi'; 
		      lcstatus = 'tambah';
          kdlok = rowData.kd_lokasi;
          nmlok = rowData.nm_lokasi;
          kduker  = rowData.kd_uker;
          nmuker  = rowData.nm_uker;
          kdskpd  = rowData.kd_skpd;
          nmskpd = rowData.nm_skpd
          get(kdlok,nmlok,kduker,nmuker,kdskpd,nmskpd); 
          //edit_data();
          tambah(); 
		      $('#iz').edatagrid({url:'<?php echo base_url(); ?>index.php/master/ambil_ruang',queryParams:({kdlokasi:kdlok}) });	  
        }
        
        });
       
	   $('#iz').edatagrid({
		//url: '<?php echo base_url(); ?>index.php/master/ambil_ruang',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'kd_ruang',title:'Kode Ruang',width:3,align:"left"},
            {field:'kd_lokasi',title:'Kode Lokasi',width:2,align:"left"},
            {field:'nm_ruang',title:'Nama Ruang',width:4,align:"left"},
            {field:'keterangan',title:'Keterangan',width:3,align:"left"},
			{field:'hapus',width:2,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus();'' />";}}
	   ]],
        onSelect:function(rowIndex,rowData){
          lcidx = rowIndex;
          kd_ruang = rowData.kd_ruang;
		      kd_unit = rowData.kd_unit;
          nm_ruang = rowData.nm_ruang;
          keterangan = rowData.keterangan;
          //get_edit(kd_ruang,kd_unit,nm_ruang,keterangan);    
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
          lcidx = rowIndex;
          kd_ruang = rowData.kd_ruang;
          kd_unit = rowData.kd_unit;
          nm_ruang = rowData.nm_ruang;
          keterangan = rowData.keterangan;
          get_edit(kd_ruang,kd_unit,nm_ruang,keterangan);
          //edit_data();    
        }
        
        });
	   
    });        

       	function nomer_akhir(){
        var i 		  = 0; 
		var kd_lokasi = document.getElementById('lokasi').value;  //$('#kduker').combogrid('getValue');
		//alert(kd_lokasi);
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>index.php/master/ambil_maxkode_ruang',
            data: ({kdlokasi:kd_lokasi}),
            dataType:"json",
            success:function(data){                                          
                $.each(data,function(i,n){                                    
                    max_kode      = n['max_kode']; 
					kode_ruangan  = kd_lokasi+"."+max_kode; 
                    $("#kdlokasi").attr("value",kode_ruangan ); 
                    $("#no_urut").attr("value",max_kode );                              
                });
            }
        });         
    }
	
    function get(kdlok,nmlok,kduker,nmuker,kdskpd,nmskpd){
        $("#kduker").attr("value",kduker);
        $("#nmuker").attr("value",nmuker);
        $("#lokasi").attr("value",kdlok);
        $("#nmlokasi").attr("value",nmlok);
        $("#kdskpd").attr("value",kdskpd);
        $("#nmskpd").attr("value",nmskpd);
        //$("#kdlokasi").attr("value",kdlok); 
        nomer_akhir();               
    }

    function get_edit(kd_ruang,kd_unit,nm_ruang,keterangan){
      $("#kdlokasi_edit").attr("value",kd_ruang);
      $("#nmruang_edit").attr("value",nm_ruang);
      $("#keterangan_edit").attr("value",keterangan);
      $("#lokasi_edit").attr("value",kd_unit);
      $("#dialog-modal-edit").dialog('open');
    }
    
    function kosong(){
        //$("#kdlokasi").attr("value",'');
        $("#nmruang").attr("value",'');
        $("#keterangan").attr("value",'');
        $("#dialog-modal-edit").dialog('close');
        //$("#nmlokasi").attr("value",'');
        //$("#kduker").combogrid("setValue",'');
		//$("#kdskpd").combogrid("setValue",''); 
    }
    
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    $(function(){
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/master/load_lokasi',
        queryParams:({cari:kriteria})
        });        
     });
    }

    function update(){
      var kd_lokasi = document.getElementById('lokasi').value;
      var kd_ruang = document.getElementById('kdlokasi_edit').value;
      var nmruang = document.getElementById('nmruang_edit').value;
      var ket = document.getElementById('keterangan_edit').value;

      lcquery = "UPDATE mruang set nm_ruang='"+nmruang+"',keterangan='"+ket+"' where kd_ruang='"+kd_ruang+"' and kd_lokasi='"+kd_lokasi+"'";
            $(document).ready(function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>index.php/master/update_master',
                data: ({st_query:lcquery}),
                dataType:"json"
            });
            });
            
                $('#iz').datagrid('updateRow',{index: lcidx,row: {kd_ruang:kd_ruang,kd_unit:kd_lokasi,nm_ruang:nmruang,keterangan:ket} });
                alert('Data Telah Di-Update');
                $("#dialog-modal-edit").dialog('close');
    }


    
    function simpan(){
        var no_urut = document.getElementById('no_urut').value;
        var kd_ruang = document.getElementById('kdlokasi').value;
        var nm_ruang = document.getElementById('nmruang').value;
        var keterangan = document.getElementById('keterangan').value;
        var ckduker = document.getElementById('kduker').value; //$('#kduker').combogrid('getValue');
		    var ckdskpd = document.getElementById('kdskpd').value; //$('#kdskpd').combogrid('getValue');
        var kd_lokasi = document.getElementById('lokasi').value;
        if (kd_ruang==''){
            alert('Kode Lokasi Tidak Boleh Kosong');
            exit();
        } 
		
        if (nm_ruang==''){
            alert('Nama Lokasi Tidak Boleh Kosong');
            exit();
        } 
        
        if (ckduker==''){
            alert('Kode Unit Kerja Tidak Boleh Kosong');
            exit();
        } 
	     if (ckdskpd==''){
            alert('Kode Unit Kerja Tidak Boleh Kosong');
            exit();
        } 
		
        //if(lcstatus=='tambah'){
            lcinsert = "(kd_ruang,        nm_ruang,     kd_skpd,     kd_unit,       kd_lokasi,    no_urut,keterangan)";  //"(kd_ruang,nm_ruang,kd_skpd,kd_unit,no_urut,keterangan)";
            lcvalues = "('"+kd_ruang+"','"+nm_ruang+"','"+ckdskpd+"','"+ckduker+"','"+kd_lokasi+"','"+no_urut+"','"+keterangan+"')";
            
            
            $(document).ready(function(){
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>index.php/master/simpan_master',
                    data: ({tabel:'mruang',kolom:lcinsert,nilai:lcvalues,cid:'kd_ruang',lcid:kd_ruang}),
                    dataType:"json"
                }); 
            });
            alert('Data Sudah Disimpan....'); 
            nomer_akhir();
            $('#iz').edatagrid({url:'<?php echo base_url(); ?>index.php/master/ambil_ruang',queryParams:({kdlokasi:kd_lokasi}) });   
            kosong();
			     
       // $('#dg').datagrid('appendRow',{kd_lokasi:ckdlok,nm_lokasi:cnmlok,kd_uker:ckduker,kd_skpd:ckdskpd,keterangan:keterangan});
        /*}else {
            //lcquery = "UPDATE mruang SET nm_ruang='"+cnmlok+"',kd_unit='"+ckduker+"',kd_skpd='"+ckdskpd+"' where kd_ruang='"+ckdlok+"'";
            lcquery = "insert into mruang values ('"+ckdlok+"','"+cnmlok+"','"+ckdskpd+"','"+ckduker+"','"+no_urut+"','"+keterangan+"')";
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
            		nm_lokasi: cnmlok,
                    kd_uker: ckduker,
                    keterangan: keterangan,
					kd_skpd: ckdskpd  					
            	}
            });
        }*/
       
        
        $("#iz").edatagrid("reload");
        //alert("Data Berhasil disimpan");
        //section1();
    } 
    
      function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data Lokasi';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        $("#iz").edatagrid("reload");
        document.getElementById("kdlokasi").disabled=false;
        }    
        
    
     function tambah(){
        lcstatus = 'tambah';
        judul = 'Input Data Unit Kerja';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
        $("#dialog-modal").dialog('open');
        $("#dialog-modal-edit").dialog('close');
        document.getElementById("kdlokasi").disabled=false;
        document.getElementById("kdlokasi").focus();
        } 
     function keluar(){
        $("#dialog-modal").dialog('close');
     }  
     function keluar2(){
        $("#dialog-modal-edit").dialog('close');
     }    
    
     function hapus(){
         if (kd_ruang !=''){
		var del=confirm('Apakah Anda yakin ingin Menhapus data '+kd_ruang+'?');
		if (del==true){         
        var urll = '<?php echo base_url(); ?>index.php/master/hapus_master';
        $(document).ready(function(){
         $.post(urll,({tabel:'mruang',cnid:kd_ruang,cid:'kd_ruang'}),function(data){
            status = data;
            if (status=='0'){
                alert('Gagal Hapus..!!');
                exit();
            } else {
                //$('#dg').datagrid('deleteRow',lcidx); 
				$("#iz").edatagrid("reload");  
                exit();
            }
         });
        });    }}
    } 
    
    
  
   </script>



<div id="content1"> 
<h3 align="center"><u><b><a>INPUTAN MASTER RUANGAN</a></b></u></h3>
    <div align="center">
    <p>     
    <table style="width:400px;" border="0">
        <tr>
        <td width="10%">
        <!--a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:tambah()">Tambah</a--></td>               
        <td width="5%"><a class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="javascript:cari();">Cari</a></td>
        <td><input type="text" value="" id="txtcari" style="width:300px;"/></td>
        </tr>
        <tr>
        <td colspan="4">
        <table id="dg" align="center" title="LISTING DATA RUANGAN" style="width:900px;height:365px;" >  
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
                <td>S K P D</td>
                <td>:</td>
                <td><input id="kdskpd" name="kdskpd" style="width: 150px;border:0;" readonly="true" />&nbsp;<input readonly="true" id="nmskpd" name="nmskpd" style="width: 350px;border:0;" /></td>
           </tr>
           <tr>
                <td>U N I T</td>
                <td>:</td>
                <td><input id="kduker" name="kduker" style="width: 150px;border:0;" readonly="true" />&nbsp;<input readonly="true" id="nmuker" name="nmuker" style="width: 350px;border:0;" /></td>
           </tr>
           <tr>
                <td>SUB U N I T</td>
                <td>:</td>
                <td><input id="lokasi" name="lokasi" style="width: 150px;border:0;" readonly="true" />&nbsp;<input readonly="true" id="nmlokasi" name="nmlokasi" style="width: 350px;border:0;" /></td>
           </tr>
           <tr>
                <td width="30%">KODE RUANG</td>
                <td width="1%">:</td>
                <td><input type="text" id="kdlokasi" style="width:200px;"/><input type="text" id="no_urut" style="width:20px;" hidden="true"/></td>  
            </tr>            
            <tr>
                <td width="30%">NAMA RUANG</td>
                <td width="1%">:</td>
                <td><input type="text" id="nmruang" style="width:450px;" placeholder="*isi nama ruangan"/></td>  
            </tr>          
            <tr>
                <td width="30%">KETERANGAN</td>
                <td width="1%">:</td>
                <td><textarea type="text" id="keterangan" name="keterangan" style="width:450px;" placeholder="*isi jika ada keterangan ruangan"></textarea></td>  
            </tr>
            <tr>
             <td colspan="4">&nbsp;</td>
            </tr> 
            <tr>
                <td colspan="4" align="center">
				<a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:kosong();nomer_akhir();">Tambah</a>
				<a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:simpan();">Simpan</a>
		        <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Kembali</a>
                </td>                
            </tr>
        </table>  
        <table id="iz" align="center" title="LISTING DATA LOKASI" style="width:900px;height:365px;" >  
        </table>      
    </fieldset> 
</div>

<div id="dialog-modal-edit" title="">
    <p class="validateTips">Semua Inputan Harus Di Isi.</p> 
    <fieldset>
     <table align="center" style="width:100%;" border="0">
     <!--  <tr>
                <td>S K P D</td>
                <td>:</td>
                <td><input id="kdskpd" name="kdskpd" style="width: 150px;border:0;" readonly="true" />&nbsp;<input readonly="true" id="nmskpd" name="nmskpd" style="width: 350px;border:0;" /></td>
           </tr>
           <tr>
                <td>U N I T</td>
                <td>:</td>
                <td><input id="kduker" name="kduker" style="width: 150px;border:0;" readonly="true" />&nbsp;<input readonly="true" id="nmuker" name="nmuker" style="width: 350px;border:0;" /></td>
           </tr>
           <tr> -->
                <td>SUB U N I T</td>
                <td>:</td>
                <td><input id="lokasi_edit" name="lokasi_edit" style="width: 150px;border:0;" readonly="true" />&nbsp;</td>
           </tr>
           <tr>
                <td width="30%">KODE RUANG</td>
                <td width="1%">:</td>
                <td><input type="text" id="kdlokasi_edit" style="width:200px;border:0;" readonly="true"/></td>  
            </tr>            
            <tr>
                <td width="30%">NAMA RUANG</td>
                <td width="1%">:</td>
                <td><input type="text" id="nmruang_edit" style="width:450px;" /></td>  
            </tr>          
            <tr>
                <td width="30%">KETERANGAN</td>
                <td width="1%">:</td>
                <td><textarea type="text" id="keterangan_edit" name="keterangan" style="width:450px;" ></textarea></td>  
            </tr>
            <tr>
             <td colspan="4">&nbsp;</td>
            </tr> 
            <tr>
                <td colspan="4" align="center">
        <!-- <a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:kosong();nomer_akhir();">Tambah</a> -->
        <a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:update();">Update</a>
            <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar2();">Kembali</a>
                </td>                
            </tr>
        </table>  
             
    </fieldset> 
</div>