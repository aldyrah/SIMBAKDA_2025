  <script type="text/javascript">
    
    var kdusaha= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
                    
     $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
            height: 450,
            width: 800,
            modal: true,
            autoOpen:false
        });
        });    
     
     $(function(){
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
     });       
		
     $('#kduker').combogrid({  
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
		   lcstatus = 'tambah';
		   kd_lokasi=rowData.kd_uskpd; 
		   nm_lokasi=rowData.nm_uskpd;
           $("#nmlokasi").attr("value",nm_lokasi.toUpperCase());              
       }  
     });
     $('#jns_usaha').combobox({
		valueField: 'value',
		textField: 'label',
		data: [{
			label: '',
			value: ''
		},{
			label: 'PT',
			value: '1'
		},{
			label: 'CV',
			value: '2'
		},{
		  	label: 'FIRMA',
			value: '3'
		},{	
            label: 'Lain-lain',
			value: '4'            		  
		}]
     });
     
     $('#kdbank').combogrid({  
       panelWidth:500,  
       idField:'kd_bank',  
       textField:'kd_bank',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_bank',  
       columns:[[  
           {field:'kd_bank',title:'KODE BANK',width:100},  
           {field:'nm_bank',title:'NAMA BANK',width:400}    
       ]],  
       onSelect:function(rowIndex,rowData){
		   lcstatus = 'tambah';
		   nm_bank	= rowData.nm_bank;
           $("#nmbank").attr("value",nm_bank.toUpperCase());              
       }  
     });   
        
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/master/load_usaha',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'kd_comp',
    		title:'ID PERUSAHAAN',
    		width:15,
            align:"left"},
            {field:'nm_comp',
    		title:'NAMA PERUSAHAAN',
    		width:40,
            align:"left"},
            {field:'nmbentuk',
    		title:'BENTUK USAHA',
    		width:15,
            align:"left"},
            {field:'pimpinan',
        title:'PIMPINAN',
        width:15,
            align:"left"}
        ]],
        onSelect:function(rowIndex,rowData){
          lcidx = rowIndex;
          kdusaha = rowData.kd_comp;
          nmusaha = rowData.nm_comp;
          kd_skpd = rowData.kd_skpd;
          kd_unit = rowData.kd_unit;
          jnsusaha = rowData.bentuk;
          calamat = rowData.alamat;
          cnmpimpin = rowData.pimpinan;
          kdbank = rowData.kd_bank;
          kdrek = rowData.rekening;
          get(kdusaha,nmusaha,kd_skpd,kd_unit,jnsusaha,calamat,cnmpimpin,kdbank,kdrek);   
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
          lcidx = rowIndex;
          judul = 'Edit Data Perusahaan'; 
          lcstatus = 'edit';
          kdusaha = rowData.kd_comp;
          nmusaha = rowData.nm_comp;
          jnsusaha = rowData.bentuk;
          calamat = rowData.alamat;
          cnmpimpin = rowData.pimpinan;
          kdbank = rowData.kd_bank;
          kdrek = rowData.rekening;
          //get(kdusaha,nmusaha,jnsusaha,calamat,cnmpimpin,kdbank,kdrek); 
          edit_data();   
        }
        
        });
       
    });        

      
    function  get(kdusaha,nmusaha,kd_skpd,kd_unit,jnsusaha,calamat,cnmpimpin,kdbank,kdrek){
        $("#kdusaha").attr("value",kdusaha);
        $("#nmusaha").attr("value",nmusaha);
        $("#kdskpd").combogrid("setValue",kd_skpd);
        $("#kduker").combogrid("setValue",kd_unit);
        $("#jns_usaha").combobox("setValue",jnsusaha);
        $("#alamat").attr("value",calamat);
        $("#nmpimpin").attr("value",cnmpimpin);
        $("#kdbank").combogrid("setValue",kdbank);
        $("#kdrek").attr("value",kdrek);                       
    }
    
    function kosong(){
        $("#kdusaha").attr("value",'');
        $("#nmusaha").attr("value",'');
        $("#kdskpd").combogrid("setValue",'');
        $("#nmskpd").attr("value",'');
        $("#kduker").combogrid("setValue",'');
        $("#nmlokasi").attr("value",'');
        $("#jns_usaha").combobox("setValue",'');
        $("#alamat").attr("value",'');
        $("#nmpimpin").attr("value",'');
        $("#kdbank").combogrid("setValue",'');
        $("#kdrek").attr("value",''); 
        $("#nmbank").attr("value",'');
		max_rinci();
    }
    
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    
    $(function(){
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/master/load_usaha',
        queryParams:({cari:kriteria})
        });        
     });
    }
    
    function simpan(){
        
        var ckdusaha = document.getElementById('kdusaha').value;
        var cnmusaha = document.getElementById('nmusaha').value;
        var ckdskpd = '';//$('#kdskpd').combogrid('getValue');
        var ckduker = '';//$('#kduker').combogrid('getValue');
        var cjnsusaha = $('#jns_usaha').combobox('getValue');
        var calamat = document.getElementById('alamat').value;
        var cpimpin = document.getElementById('nmpimpin').value;
        var ckdbank = $('#kdbank').combogrid('getValue');
        var ckdrek = document.getElementById('kdrek').value;
        
        //alert(ckdrek);
       
        switch (cjnsusaha)
        {
            case '1':
              lcjnsusaha="PT/NV";
              break;
            case '2':
              lcjnsusaha="CV";
              break;
            case '3':
              lcjnsusaha="FIRMA";
              break;
            case '4':
              lcjnsusaha="Lain-lain";
              break;
        } 
        
        if (ckdusaha==''){
            alert('ID Usaha Tidak Boleh Kosong');
            exit();
        } 
        
        if (cnmusaha==''){
            alert('Nama Usaha Tidak Boleh Kosong');
            exit();
        } 
        
        if(lcstatus=='tambah'){

            lcinsert = "(kd_comp,nm_comp,kd_skpd,kd_unit,bentuk,alamat,pimpinan,kd_bank,rekening)";
            lcvalues = "('"+ckdusaha+"','"+cnmusaha+"','"+ckdskpd+"','"+ckduker+"','"+cjnsusaha+"','"+calamat+"','"+cpimpin+"','"+ckdbank+"','"+ckdrek+"')";
            
            
            $(document).ready(function(){
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>index.php/master/simpan_usaha',
                    data: ({ckdusaha:ckdusaha,cnmusaha:cnmusaha,cjnsusaha:cjnsusaha,calamat:calamat,cpimpin:cpimpin,ckdbank:ckdbank,ckdrek:ckdrek}),
                    dataType:"json"
                });
            });    
            
            
        $('#dg').datagrid('appendRow',{kd_comp:ckdusaha,nm_comp:cnmusaha,bentuk:cjnsusaha});
        }else {
            
            
            
            lcquery = "UPDATE mcompany SET nm_comp='"+cnmusaha+"',bentuk='"+cjnsusaha+"',alamat = '"+calamat+
                      "', pimpinan='"+cpimpin+"',kd_bank='"+ckdbank+"',rekening ='"+ckdrek+
                      "' where kd_comp='"+ckdusaha+"' and kd_skpd='"+ckdskpd+"' and kd_unit='"+ckduker+"' ";
            
            
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
            		nm_comp: cnmusaha,
                    nmbentuk: lcjnsusaha,
                    bentuk: cjnsusaha,
                    alamat: calamat,
                    pimpinan: cpimpin,
                    kd_bank: ckdbank,
                    rekening: ckdrek                           
            	}
            });
        }
       
        
        alert("Data Berhasil disimpan");
        $("#dialog-modal").dialog('close');
        //section1();
    } 
    
      function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data Lokasi';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        document.getElementById("kdusaha").disabled=false;
        }    
        
    
     function tambah(){
        lcstatus = 'tambah';
        judul = 'Input Data Perusahaan';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
        $("#dialog-modal").dialog('open');
        document.getElementById("kdusaha").disabled=false;
        document.getElementById("nmusaha").focus();
        } 
        
     function keluar(){
        $("#dialog-modal").dialog('close');
     }    
    
     function hapus(){
        var ckdusaha = document.getElementById('kdusaha').value;
        var unit	 = '';//$('#kduker').combogrid('getValue');  
		var del=confirm('Apakah Anda yakin ingin Menhapus data '+ckdusaha+'?');
		if (del==true){
        var urll = '<?php echo base_url(); ?>index.php/master/hapus_master';
        $(document).ready(function(){
         $.post(urll,({tabel:'mcompany',cnid:ckdusaha,cid:'kd_comp'}),function(data){
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
    } 
	
     function tambah_urut(angka,panjang){
        no=((angka)*1);
        a=no.toString();
        jnol=panjang-a.length;
        nol='';
        for(i=1;i<=jnol;i++){
        nol=nol+'0';
        }
        b= nol+a;
        return b;
    }
		 
	function max_rinci(){ 
	//var organisasi = $('#kdskpd').combogrid('getValue');
	//var organisasi = '<?php echo $this->session->userdata('skpd');?>';
		$.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>index.php/simpl/loadmax',
            data: ({table:'mcompany',kolom:'kd_comp'}),
            dataType:"json",
            success:function(data){                                          
                $.each(data,function(i,n){                                    
                    no_urut       = n['kode']; 
					nomorku		  = tambah_urut(no_urut,4); 	
					$("#kdusaha").attr("value",nomorku);
                });
            }
        }); 
	 }

   </script>



<div id="content1"> 
<h3 align="center"><u><b><a>INPUTAN MASTER DATA PERUSAHAAN REKANAN</a></b></u></h3>
    <div align="center">
    <p>     
    <table style="width:400px;" border="0">
        <tr>
        <td width="10%">
        <a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:tambah()">Tambah</a></td>               
        <td width="10%"><a class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:hapus();">Hapus</a></td>
        <td width="5%"><a class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="javascript:cari();">Cari</a></td>
        <td><input type="text" value="" id="txtcari" style="width:300px;"/></td>
        </tr>
        <tr>
        <td colspan="4">
        <table id="dg" align="center" title="LISTING DATA PERUSAHAAN" style="width:900px;height:365px;" >  
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
                <td width="30%">ID PERUSAHAAN</td>
                <td width="1%">:</td>
                <td><input type="text" id="kdusaha" style="width:100px;" readonly="true"/></td>  
            </tr>
           <tr>
                <td width="30%">NAMA PERUSAHAAN</td>
                <td width="1%">:</td>
                <td><input type="text" id="nmusaha" style="width:450px;"/></td>  
            </tr>  
            <!-- <tr>
                <td width="30%">SKPD</td>
                <td width="1%">:</td>
                <td><input id="kdskpd" style="width:200px;"/><input id="nmskpd" style="width:300px; border:0;" readonly="true"/></td>
            </tr>    
            <tr>
                <td width="30%">UNIT</td>
                <td width="1%">:</td>
                <td><input id="kduker" style="width:200px;"/><input id="nmlokasi" style="width:300px; border:0;" readonly="true"/></td>
            </tr>   -->
            <tr>
                <td width="30%">BENTUK USAHA</td>
                <td width="1%">:</td>
                <td><input id="jns_usaha" class="easyui-combobox"/>
                </td>
            </tr>        
            <tr>
                <td width="30%" valign="top">ALAMAT</td>
                <td width="1%" valign="top">:</td>
                <td><textarea rows="2" cols="50" id="alamat" style="width: 450px;"></textarea>
                </td>  
            </tr>
            <tr>
                <td width="30%">PIMPINAN</td>
                <td width="1%">:</td>
                <td><input type="text" id="nmpimpin" style="width:200px;"/></td>  
            </tr> 
            <tr>
                <td>KODE BANK</td>
                <td>:</td>
                <td><input id="kdbank" name="kdbank" style="width: 100px;" /><input id="nmbank" style="width:300px; border:0;" readonly="true"/></td>
            </tr>
             <tr>
                <td width="30%">REKENING</td>
                <td width="1%">:</td>
                <td><input type="text" id="kdrek" style="width:200px;"/></td>  
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

