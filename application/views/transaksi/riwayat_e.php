<script src="<?php echo base_url(); ?>lib/sweet-alert.min.js"></script>
<link   rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>lib/sweet-alert.css">
<script type="text/javascript">
    var kdkel= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
    var lcskpd = '';
    var lpdok = '';
    var no_urut=0;
                    
     $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
            height: 350,
            width: 1000,
            modal: true,
            autoOpen:false,
        });
        });    
     
     $(function(){
      $('#tgl_riwayat').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
                //ctgl = y+'-'+m+'-'+d;
            	return y+'-'+m+'-'+d;
            }
        });
		
       $('#kd_skpd').combogrid({  
           panelWidth:500,  
           idField:'kd_skpd',  
           textField:'kd_skpd',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/master/ambil_msskpd',  
           columns:[[  
               {field:'kd_skpd',title:'KODE SKPD',width:100},  
               {field:'nm_skpd',title:'NAMA SKPD',width:400}    
           ]],  
           onSelect:function(rowIndex,rowData){
               lcskpd = rowData.kd_skpd; 
			   $("#nm_skpd").attr("value",rowData.nm_skpd.toUpperCase());
           }  
         });  
		
     $('#kd_riwayat').combogrid({  
       panelWidth:220,  
       idField:'kode',  
       textField:'riwayat',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/mriwayat',
       loadMsg:"Tunggu Sebentar....!!",  
       columns:[[  
           {field:'kode',title:'Kode',width:40},
           {field:'riwayat',title:'Riwayat',width:150}
       ]],
        onSelect:function(rowIndex,rowData){
           lckondisi = rowData.kode;
           $("#kon").attr("value",rowData.riwayat.toUpperCase());
       }  
     });
	 	
     $('#dg').edatagrid({
		url: '<?php echo base_url();?>index.php/transaksi/riwayat_kib_e',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Sedang mengambil Barang...!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
            {field:'nm_skpd',title:'SKPD',width:30,align:"left"},
            {field:'nm_brg',title:'NAMA BARANG',width:30,align:"left"},
            {field:'tahun',title:'TAHUN',width:10,align:"center"},
            {field:'nilai',title:'HARGA',width:20,align:"right"},
    	    {field:'riwayat',title:'RIWAYAT',width:20,align:"left"},
            {field:'detail_riwayat',title:'DETAIL',width:35,align:"left"},
			{field:'hapus',width:5,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/edit.png' onclick='javascript:edit_data();'' />";}}
        ]],
        onSelect:function(rowIndex,rowData){
          lcidx = rowIndex;
          noreg = rowData.no_reg;
          no 	= rowData.no;
          nodok = rowData.no_dokumen;
          kdbrg = rowData.kd_brg;
          id_barang		= rowData.id_barang;
          no_furut		= rowData.no_urut;
        },
        onDblClickRow:function(rowIndex,rowData){
          lcidx 		= rowIndex;
          judul 		= 'Edit Data Lokasi'; 
          lcstatus 		= 'edit';
          id_barang		= rowData.id_barang;
          tgl_riwayat	= rowData.tgl_riwayat;
          kd_riwayat	= rowData.kd_riwayat;
          detail_riwayat= rowData.detail_riwayat;
          kd_skpd		= rowData.kd_skpd;
          nilai			= rowData.nilai;
		  
		  tahun			= rowData.tahun;
		  kd_unit		= rowData.kd_unit;
		  no_urut		= rowData.no_urut;
		  kd_brg		= rowData.kd_brg;
          get1(id_barang,tgl_riwayat,kd_riwayat,detail_riwayat,kd_skpd,nilai,tahun,kd_unit,no_urut,kd_brg);
          edit_data();   
        }
        });
    });        
        
   function get1(id_barang,tgl_riwayat,kd_riwayat,detail_riwayat,kd_skpd,nilai,tahun,kd_unit,no_urut,kd_brg){
		   $("#id_barang").attr("value",id_barang);
           $("#tgl_riwayat").datebox("setValue",tgl_riwayat);
           $("#kd_riwayat").combogrid("setValue",kd_riwayat);
		   $("#detail_riwayat").attr("value",detail_riwayat);
           $("#kd_skpd").combogrid("setValue",kd_skpd);
		   $("#nilai").attr("value",nilai);
		   $("#tahun").attr("value",tahun);
		   $("#kd_unit").attr("value",kd_unit);
		   $("#no_urut").attr("value",no_urut);
		   $("#kd_brg").attr("value",kd_brg);
		   
		   
    }
    
    function kosong(){
	var tgl_update		= '<?php echo date('y-m-d H:i:s'); ?>';
	   $("#id_barang").attr("value",'');
	   $("#tgl_riwayat").datebox("setValue",tgl_update);
	   $("#kd_riwayat").combogrid("setValue",'');
	   $("#detail_riwayat").attr("value",'');
       document.getElementById("p1").innerHTML="";
    }
    
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    $(function(){
     $('#dg').edatagrid({
		url: '<?php echo base_url();?>index.php/transaksi/ambil_kib_e',
        queryParams:({cari:kriteria})
        });        
     });
    }
    
    function simpan(){
        var id_barang 		= document.getElementById('id_barang').value;
		var tgl_riwayat		= $('#tgl_riwayat').datebox('getValue');
        var kd_riwayat 		= $('#kd_riwayat').combogrid('getValue'); 
        var detail_riwayat	= document.getElementById('detail_riwayat').value;
		
        var tahun	= document.getElementById('tahun').value;
        var kd_unit	= document.getElementById('kd_unit').value;
        var no_urut	= document.getElementById('no_urut').value;
        var kd_brg	= document.getElementById('kd_brg').value;

        if (kd_riwayat==''){
            alert('Riwayat Barang Tidak Boleh Kosong');
            exit();
        } 
		
        lcinsert = "(kd_riwayat,tgl_riwayat,detail_riwayat)";
        
        if(lcstatus=='tambah'){ 
		lcvalues = "('"+kd_riwayat+"','"+tgl_riwayat+"','"+detail_riwayat+"')";

            $(document).ready(function(){
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>index.php/transaksi/simpan_trkib_e',
                    data: ({tabel:'trkib_a',no:id_barang,kolom:lcinsert,lcvalues:lcvalues}),
                    dataType:"json"
                });
            });    
        } else {
            lcquery = "update trkib_e set kd_riwayat='"+kd_riwayat+"',tgl_riwayat='"+tgl_riwayat+"',detail_riwayat='"+detail_riwayat+"' where id_barang ='"+id_barang+"' and tahun ='"+tahun+"' and no_urut ='"+no_urut+"' and kd_unit ='"+kd_unit+"' and kd_brg ='"+kd_brg+"'";
			$(document).ready(function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>index.php/transaksi/update_trkib_e',
                data: ({st_query:lcquery}),
                dataType:"json"
            });
            });
        }                            
		swal({
		title: "Berhasil",
		text: "Data telah disimpan.!!",
		imageUrl:"<?php echo base_url();?>/lib/images/biak.jpg"
		});
        $("#dialog-modal").dialog('close');
        $('#dg').edatagrid('reload');       
    } 
	
      function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Riwayat Kib D';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        document.getElementById("noreg").disabled=true;
         
        }          
    
     function tambah(){ 
        lcstatus = 'tambah';
        judul = 'Input Riwayat Kib D';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
        $("#dialog-modal").dialog('open');
        } 
		
     function keluar(){
        $("#dialog-modal").dialog('close');
        $("#dialog-modal_gambar").dialog('close');
     }
   </script>
    
<div id="content1"> 
<div><h3 align="center"><b>.:INPUTAN RIWAYAT INVENTARIS ASET TETAP LAINNYA:.</b></h3></div>
    <div align="center">
    <p>     
    <table style="width:400px;" border="0">
        <tr>
        <td width="10%">
        <!--td width="10%"><a class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:hapus();">Hapus</a></td-->
        <td width="5%"><a class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="javascript:cari();">Cari</a></td>
        <td><input type="text" value="" id="txtcari" style="width:300px;"/></td>
        </tr>
        <tr>
        <td colspan="4">
        <table id="dg" align="center" title="LISTING INVENTARIS ASET TETAP LAINNYA" style="width:900px;height:365px;">  
        </table>
        </td>
        </tr>
    </table>    
 
    </p> 
    </div>   
</div>

<div id="dialog-modal" title="">
    <p class="validateTips">.:Tambah Riwayat Aset Tetap Lainnya</p>
    <fieldset>
		<p id="p1" style="font-size: x-large;color: red;"></p>
     <table align="center" style="width:100%;" border="0">
               <td width="50%" valign="top">
                    <table align="left" style="width:100%;" border="0">
                       <tr hidden="true">
                            <td>ID Barang</td>
                            <td>:</td>
                            <td><input type="text" id="id_barang" name="id_barang" style="width: 250px;" /></td>
                       </tr>
					   <tr hidden="true">
                            <td>ID tahun</td>
                            <td>:</td>
                            <td><input type="text" id="tahun" name="tahun" style="width: 250px;" /></td>
                       </tr> <tr hidden="true">
                            <td>ID kd_unit</td>
                            <td>:</td>
                            <td><input type="text" id="kd_unit" name="kd_unit" style="width: 250px;" /></td>
                       </tr> <tr hidden="true">
                            <td>ID no_urut</td>
                            <td>:</td>
                            <td><input type="text" id="no_urut" name="no_urut" style="width: 250px;" /></td>
                       </tr>
					    <tr hidden="true">
                            <td>ID kd_brg</td>
                            <td>:</td>
                            <td><input type="text" id="kd_brg" name="kd_brg" style="width: 250px;" /></td>
                       </tr>
                       <tr disabled="true">
                            <td>SKPD</td>
                            <td>:</td>
                            <td><input disabled="true" type="text" id="kd_skpd" name="kd_skpd" style="width: 100px;" />
							<input readonly="true" border="0" type="text" id="nm_skpd" name="nm_skpd" style="width: 350px;" /></td>
                       </tr>
                       <tr disabled="true">
                            <td>Nilai</td>
                            <td>:</td>
                            <td><input disabled="true" type="text" id="nilai" name="nilai" style="width: 150px;" /></td>
                       </tr>
                       <tr>
                            <td>Tanggal Riwayat</td>
                            <td>:</td>
                            <td><input type="text" id="tgl_riwayat" name="tgl_riwayat" style="width: 100px;" /></td>
                       </tr>
                       <tr>
                            <td>Riwayat</td>
                            <td>:</td>
                            <td><input type="text" id="kd_riwayat" name="kd_riwayat" style="width: 250px;" /></td>
                       </tr>
                       <tr>
                            <td>Detail Riwayat</td>
                            <td>:</td>
                            <td><textarea placeholder="*silahkan input detail riwayat barang" type="text" id="detail_riwayat" name="detail_riwayat" style="width: 400px; height:50px;"></textarea></td>
                       </tr>
                    </table> 
               </td>
		   <tr>
                <td colspan="2" align="center">
				<a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:simpan();">Simpan</a>                
		        <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Kembali</a>
				</td>                
           </tr>
        </table>  
    </fieldset> 
</div>

