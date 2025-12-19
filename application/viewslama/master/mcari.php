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
            height: 400,
            width: 700,
            modal: true,
            autoOpen:false
        });
        });    
     
     $(function(){        
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/master/load_cari',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Sedang Mencari..!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'golongan',
    		title:'KODE',
    		width:15,
            align:"center"},
    	    {field:'kd_skpd',
    		title:'SKPD',
    		width:15,
            align:"center"},
            {field:'nm_golongan',
    		title:'NAMA BARANG',
    		width:40},
            {field:'jenis',
    		title:'MEREK',
    		width:25,
            align:"center"},
    	    {field:'tahun',
    		title:'TAHUN',
    		width:15,
            align:"center"},
    	    {field:'nilai',
    		title:'HARGA',
    		width:25,
            align:"right"}/*,
			{field:'hapus',width:5,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus();'' />";}}*/
        ]],
        onSelect:function(rowIndex,rowData){
          kodegol = rowData.golongan;
          nmgol = rowData.nm_golongan;
          ketjns = rowData.jenis;
          get(kodegol,nmgol,ketjns); 
          lcidx = rowIndex;  
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
          // lcidx = rowIndex;
           //udul = 'Edit Data Golongan'; 
          // edit_data();   
        }
        
        });
		
		$('#gol').combogrid({  
           panelWidth:300,  
           idField:'gol',  
           textField:'gol',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/master/ambil_mrekap',  
           columns:[[  
               {field:'gol',title:'KODE SKPD',width:90},  
               {field:'nama',title:'NAMA SKPD',width:200}    
           ]],  
           onSelect:function(rowIndex,rowData){
               lcgol = rowData.gol;
               $("#nmgol").attr("value",rowData.nama.toUpperCase());
           }  
         });
		
		    $('#skpd').combogrid({  
           panelWidth:300,  
           idField:'kd_skpd',  
           textField:'kd_skpd',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/master/ambil_msskpd',  
           columns:[[  
               {field:'kd_skpd',title:'KODE SKPD',width:90},  
               {field:'nm_skpd',title:'NAMA SKPD',width:200}    
           ]],  
           onSelect:function(rowIndex,rowData){
               lcskpd = rowData.kd_skpd;
               $("#nmskpd").attr("value",rowData.nm_skpd.toUpperCase());
               //lckd_lokasi = rowData.kd_lokasi;
               $('#tahu').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_pa',queryParams:({kduskpd:lcskpd}) });
               $('#bend').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_pb',queryParams:({kduskpd:lcskpd}) });
                          
           }  
         });
          
         $('#tgl_ctk').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });
       
    });        

 
    
    function get(kodegol,nmgol,ketjns) {
        
        $("#kdgol").attr("value",kodegol);
        $("#nmgol").attr("value",nmgol);
        $("#jns_aset").combobox("select",ketjns);       
                       
    }
       
    function kosong(){
		var date = '<?php echo date('y-m-d'); ?>';
        $("#judul").attr("value",'');
        $("#nmpenggu").attr("value",'');
        $("#nippenggu").attr("value",'');
        $("#nmpengu").attr("value",'');
        $("#nippengu").attr("value",'');
        $('#tgl_ctk').datebox("setValue",date);
    }
    
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
	var skpd     = $('#skpd').combogrid('getValue');
	var gol      = $('#gol').combogrid('getValue');
    var tahun	 = document.getElementById("tahun").value; 
    var tahun2	 = document.getElementById("tahun2").value; 
	if(gol==''){
	alert("KODE GOLONGAN SILAHKAN DIISI TERLEBIH DAHULU.!!");
	exit();
	}
    $(function(){ 
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/master/load_cari',
        queryParams:({cari:kriteria,skpd:skpd,tahun:tahun,tahun2:tahun2,gol:gol})
        });        
     });
    }
	
	function openWindow(){
		//var cpilih	= $cek;
		var kriteria 	= document.getElementById("txtcari").value;
		var gol			= $('#gol').combogrid('getValue');
		var skpd		= $('#skpd').combogrid('getValue');
		var jabatan1	= document.getElementById('jabatan1').value;
		var jabatan2	= document.getElementById('jabatan2').value;
		var tahun		= document.getElementById('tahun').value;
		var tahun2		= document.getElementById('tahun2').value;
		var judul 		= document.getElementById('judul').value;
		var nmpenggu 	= document.getElementById('nmpenggu').value;
		var nippenggu 	= document.getElementById('nippenggu').value;
		var nmpengu 	= document.getElementById('nmpengu').value;
		var nippengu 	= document.getElementById('nippengu').value;
		var lctgl 		= $('#tgl_ctk').datebox('getValue');
		var url			= "<?php echo site_url(); ?>/laporan/lap_kib_cari";
		iz = '?cari='+kriteria+'&gol='+gol+'&skpd='+skpd+'&tahun='+tahun+'&tahun2='+tahun2+'&judul='+judul+'&jabatan1='+jabatan1+'&jabatan2='+jabatan2+'&nmpenggu='+nmpenggu+'&nippenggu='+nippenggu+'&nmpengu='+nmpengu+'&nippengu='+nippengu+'&lctgl='+lctgl; 
		window.open(url+iz,'_blank');
		window.focus();
	
	} 
    
       function simpan_golongan(){
        var cjns = $('#jns_aset').combobox('getValue');
        
        if(cjns=='1'){
            var cnmjns = 'Aset';
        }else{
            var cnmjns = 'Non Aset';
        }
        
        var ckdgol = document.getElementById('kdgol').value;
        var cnmgol = document.getElementById('nmgol').value;
                
        if (ckdgol==''){
            alert('Kode Golongan Tidak Boleh Kosong');
            exit();
        } 
        if (cnmgol==''){
            alert('Nama Golongan Tidak Boleh Kosong');
            exit();
        }

        
        if(lcstatus=='tambah'){ 
            
            lcinsert = "(golongan,nm_golongan,jenis)";
            lcvalues = "('"+ckdgol+"','"+cnmgol+"','"+cjns+"')";
            
            $(document).ready(function(){
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>index.php/master/simpan_master',
                    data: ({tabel:'mgolongan',kolom:lcinsert,nilai:lcvalues,cid:'golongan',lcid:ckdgol}),
                    dataType:"json"
                });
            });   
           
        $('#dg').datagrid('appendRow',{golongan:ckdgol,nm_golongan:cnmgol,ketjenis:cnmjns});
        } else{
            
            lcquery = "UPDATE mgolongan SET nm_golongan='"+cnmgol+"',jenis="+cjns+" where golongan='"+ckdgol+"'";

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
            		golongan: ckdgol,
            		nm_golongan: cnmgol,
                    ketjenis: cnmjns                    
            	}
            });
        }
        
        
        alert("Data Berhasil disimpan");
        $("#dialog-modal").dialog('close');

    } 
    
      function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data Golongan';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        document.getElementById("kdgol").disabled=true;
        }    
        
    
     function tambah(){
        lcstatus = 'tambah';
        judul = 'EDIT LAPORAN';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
        $("#dialog-modal").dialog('open');
        document.getElementById("kdgol").disabled=false;
        document.getElementById("kdgol").focus();
        } 
     function keluar(){
        $("#dialog-modal").dialog('close');
     }    
    
     function hapus(){
        var ckdgol = document.getElementById('kdgol').value;
		if (ckdgol !=''){
		var del=confirm('Apakah Anda yakin ingin Menhapus data '+ckdgol+'?');
		if (del==true){
        var urll = '<?php echo base_url(); ?>index.php/master/hapus_master';
        $(document).ready(function(){
         $.post(urll,({tabel:'mgolongan',cnid:ckdgol,cid:'golongan'}),function(data){
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

<div id="content1"> 
<h3 align="center"><b>.: CARI BARANG :.</b></h3>
    <div align="center">
    <p align="center">     
    <table style="width:500px;" border="0">
        <tr>
			<td>GOLONGAN:<input type="text" id="gol" style="width:50px;"/></td>
            <td>SKPD:<input type="text" id="skpd" style="width:90px;"/></td>
			<td><select id="tahun" class="select" style="width:80px;">
				<option value='' selected></option>					
				<?php
					$th=date("Y");
					for($i=$th;$i>=$th-100;$i--){
						echo "<option value='$i'>$i</option>";					
					}					
				?>
			</select>
            </td> <td>S/D</td> 
			<td><select id="tahun2" class="select" style="width:80px;">
				<option value='' selected></option>					
				<?php
					$th=date("Y");
					for($i=$th;$i>=$th-100;$i--){
						echo "<option value='$i'>$i</option>";					
					}					
				?>
			</select>
            </td>        
			<td><input placeholder="*kata kunci sesuai di inputan kib" type="text" value="" id="txtcari" style="width:400px; height:25px;" /></td>
			<td height="50%" ><a align="left" class="easyui-linkbutton" iconCls="icon-file_search" plain="true" onclick="javascript:cari();" ></a></td>
		</tr>
        <tr>
        <td colspan="6">
        <table id="dg" style="width:900px;height:365px;" >  
        </table>
        </td>
        </tr>
        <tr>
		<td align="right">
		<a class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="javascript:tambah();kosong();"><b>EDIT LAPORAN</b></a>
		</td>
        <td colspan="5" align="right">
		<a class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:openWindow();"><b>CETAK HASIL PENCARIAN</b></a>
        </td>
        </tr>
    </table>    
     
    </p> 
    </div>   
</div>

<div id="dialog-modal" title="">
    <p class="validateTips" align="center">.:FORM EDIT LAPORAN PENCARIAN:.</p> 
    <fieldset>
     <table align="center" style="width:100%;" border="0">
           <tr>
                <td width="30%">HEADER (JUDUL)</td> 
                <td width="1%">:</td>
                <td colspan="4"><textarea type="text" id="judul" style="width:400px;"/></textarea></td>  
           </tr>             
            <tr>
                <td width="30%">JABATAN 1</td>
                <td width="1%">:</td>
                <td><input type="text" id="jabatan1" style="width:200px;"/></td>
                <td align="right" width="30%">JABATAN 2</td>
                <td width="1%">:</td>
                <td><input type="text" id="jabatan2" style="width:200px;"/></td>  
            </tr>          
            <tr>
                <td width="30%">PENANDA TANGAN 1</td>
                <td width="1%">:</td>
                <td><input type="text" id="nmpenggu" style="width:200px;"/></td>
                <td align="right" width="30%">PENANDA TANGAN 2</td>
                <td width="1%">:</td>
                <td><input type="text" id="nmpengu" style="width:200px;"/></td> 
            </tr>
            <tr>
                <td width="30%">NIP 1</td>
                <td width="1%">:</td>
                <td><input type="text" id="nippenggu" style="width:200px;"/></td>   
                <td align="right" width="30%">NIP 2</td>
                <td width="1%">:</td>
                <td><input type="text" id="nippengu" style="width:200px;"/></td>
            </tr>
           <tr>
                <td width="30%">TANGGAL CETAK</td>
                <td width="1%">:</td>
                <td colspan="4"><input type="text" id="tgl_ctk" style="width:100px;"/></td>  
           </tr> 
            <!--tr>
                <td width="30%">NAMA PENGURUS</td>
                <td width="1%">:</td>
                <td><input id="jns_aset" class="easyui-combobox" data-options="
            		valueField: 'value',
            		textField: 'label',
            		data: [{
            			label: '',
            			value: ''
            		},{
            			label: 'Aset',
            			value: '1'
            		},{
            			label: 'Non Aset',
            			value: '2'
            		}]"/>
                </td>  
                
            </tr-->
            
            
            <tr>
            <td colspan="6">&nbsp;</td>
            </tr>            
            <tr>
                <td colspan="6" align="center"><a class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:openWindow();">CETAK</a>
		        <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Kembali</a>
                </td>                
            </tr>
        </table>       
    </fieldset>
</div>

