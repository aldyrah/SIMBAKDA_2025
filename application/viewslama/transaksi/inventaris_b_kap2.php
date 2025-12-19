

   
    <script src="<?php echo base_url(); ?>easyui/sweetalert/lib/sweet-alert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/sweetalert/lib/sweet-alert.css">
    <script type="text/javascript">
  
					 
	var idx      = 0;
	var lcstatus ='';
	var cek      =1;
	var idus     ='';
    var tt		='';
	var st		='';
    $(document).ready(function() {
            $("#accordion").accordion();            
        });    
     
     $(function(){ 
		$('#dg').edatagrid({
			url: '<?php echo base_url(); ?>/index.php/transaksi/ambil_kib_b_kap',
			idField:'id',            
			rownumbers:"true", 
			fitColumns:"true",
			singleSelect:"true",
			autoRowHeight:"false",
			pagination:"true",
			nowrap:"true",                       
			columns:[[
				{field:'no_dokumen',title:'ID',width:10,align:"center"},
				{field:'keterangan',title:'User Name',width:60,align:"justify"},
				{field:'',title:'ap',width:10,align:"center",hidden:"true"},
				{field:'',title:'ap',width:10,align:"center",hidden:"true"},
				{field:'',title:'Nickname',width:80,align:"justify"},
				{field:'',title:'Kode SKPD',width:30, align:"right"},
				{field:'',title:'Nama SKPD',width:100, align:"left"}
			]],
			onSelect:function(rowIndex,rowData){
				
			},
			onDblClickRow:function(rowIndex,rowData){ 
				
			}
		});
    
       
        
        
		
		$('#skpd').combogrid({  
			panelWidth:700,  
			url: '<?php echo base_url(); ?>/index.php/master/ambil_msskpd2',  
				idField:'kd_skpd',                    
				textField:'kd_skpd',
				mode:'remote',  
				fitColumns:true,  
				columns:[[  
               {field:'kd_skpd',title:'Kode SKPD',width:100},  
               {field:'nm_skpd',title:'Nama SKPD',width:250},
               {field:'kd_lokasi',title:'Kode Unit',width:100},  
               {field:'nm_lokasi',title:'Nama Unit',width:250}    
            ]],
				onSelect:function(rowIndex,rowData){
				   kdskpd=rowData.kd_skpd;
				   nmskpd=rowData.nm_skpd;
				   kdlokasi=rowData.kd_lokasi;
				   nmlokasi=rowData.nm_lokasi;
				   $("#nmskpd").attr("value",nmskpd);
				   $("#lokasi").attr("value",kdlokasi);
				   $("#nmlokasi").attr("value",nmlokasi);
				
				}   
         });


	});	  
    
	

	 function kembali(){
         $(document).ready(function(){    
             $('#section1').click(); 
			 $('#dg').datagrid('reload');
         });
		 kosong();
    }

     function section2(){
         $(document).ready(function(){                
             $('#section2').click(); 
              	  
         });    
     }
    
    
    
	function cari(z){
		$(function(){ 
		 $('#dg').edatagrid({
			url: '<?php echo base_url(); ?>/index.php/master/load_new_user',
			queryParams:({cari:z})
			});        
		 });
    }
   
   
	
	function kosong(){
		$("#kib").combogrid("setValue",'');
        $("#nm_brg").attr("value",'');
        $("#dok").attr("value",'');
        $("#tanggal").datebox("setValue",'');
        $("#peroleh").attr("value",'');
        $("#tmbh_manfaat").attr("value",'');
        $("#tgl_kap").datebox("setValue",'');
        $("#nil_kap").attr("value",'');
        $("#keterangan").attr("value",'');
		lcstatus='tambah';
	}
	
	
	
	function simpan(){
		
	
	}

	

	function hapus(){                                               
	}
	
	

	
    </script>

<!-- //</head> -->
<body>



<div id="content">    
<div id="accordion">
<h3><a href="#" id="section1"><i>KAPITALISASI KIB B</i></a></h3>
    <div>
    <p align="right">         
        <a class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="javascript:kosong();section2();">Tambah</a>               
        <a plain="false">Cari</a>
        <input id="txtcari" class="easyui-searchbox" data-options="prompt:'Please Input Value',	searcher:function(value,name){cari(value)}" style="width:180px"/>
        <table id="dg" title="List USER" style="width:870px;height:470px;" >  
        </table>                          
    </p> 
    </div>   

<h3><a href="#" id="section2"><i>USER & OTORI</i></a></h3>
   <div  style="height: 350px;">
   <p id="p1" style="font-size: x-large;color: red;"></p>
   <p>       
		<fieldset>
        <table align="center" border='0' style="width:850px;">
        
            			<tr>
            				<td width="20%">SKPD</td>
                            <td>: <input id="skpd" name="skpd" style="width: 150px;" /> <input readonly="true" id="nmskpd" name="nmskpd" style="width: 200px;border:0;width: 400px;" /></td>
                            <td width="10%"></td>
            			</tr>
            			<tr>
                            <td width="20%">Jenis Aset</td>
                            <td>: <input id="jenis_kib" name="jenis_kib" style="width: 150px;" /> <input readonly="true" id="nmjenis" name="nmjenis" style="width: 200px;border:0;width: 400px;" /></td>
                            <td width="10%"></td>
                       </tr>
						<tr>
                            <td width="20%">Nama Barang</td>
                            <td>: <input id="kib" name="kib" style="width: 150px;" /> <input readonly="true" id="nm_brg" name="nm_brg" style="width: 200px;border:0;width: 400px;" /></td>
                            <td width="10%"></td>
                       </tr>
                       <tr hidden="true">
                            <td>No Dokumen</td>
                            <td>: <input id="dok" name="dok" style="width: 200px;" /></td>
                            <td></td>
                       </tr>
                       <tr width="10%">
                            <td>Tanggal Perolehan</td>
                            <td>: <input disabled="true" type="text" id="tanggal" style="width: 140px;" /></td>
                            <td></td>
                       </tr>
                       <tr>
                            <td>Nilai Perolehan</td>
                            <td>: <input disabled="true" id="peroleh" name="peroleh"  onkeyup="return(currencyFormat(this,',','.',event));" style="width: 150px;text-align: right;"/></td>
                            <td></td>
                       </tr>
                       <tr width="10%">
                            <td>Tanggal Kapitalisasi</td>
                            <td>: <input type="text" id="tgl_kap" style="width: 140px;" /></td>
                            <td></td>
                       </tr>
                       <tr>
                            <td>Nilai Kapitalisasi</td>
                            <td>: <input id="nil_kap" name="nil_kap" onkeypress="return(currencyFormat(this,',','.',event));" onkeyup="hitung();" style="text-align: right;" /></td>
                            <td></td>
                       </tr>
                       <tr>
                            <td>Persentase Kapitalisasi</td>
                            <td>: <input id="per_kap" name="per_kap"  style="text-align: right; border:0;" /> (%)</td>
                            <td></td>
                       </tr>
                       <tr>
                            <td>Kapitalisasi Umur</td>
                            <td>: <input id="umur_kap" name="umur_kap" style="text-align: right;border:0;" /> (Thn)</td>
                            <td></td>
                       </tr>
					   <!--ini disengaja-->
                       <tr hidden="true">
                            <td>id_barang</td>
                            <td>: <input id="id_barang" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>no_reg</td>
                            <td>: <input id="no_reg" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>no</td>
                            <td>: <input id="no" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>tgl_reg</td>
                            <td>: <input id="tgl_reg" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>kd_bahan</td>
                            <td>: <input id="kd_bahan" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>kd_satuan</td>
                            <td>: <input id="kd_satuan" /></td>
                            <td></td>
                       </tr>
					   								
                       <tr hidden="true">
                            <td>no_dokumen</td>
                            <td>: <input id="no_dokumen" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>kd_brg</td>
                            <td>: <input id="kd_brg" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>nilai</td>
                            <td>: <input id="nilai" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>jumlah</td>
                            <td>: <input id="jumlah" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>total</td>
                            <td>: <input id="total" /></td>
                            <td></td>
                       </tr>				
                       <tr hidden="true">
                            <td>merek</td>
                            <td>: <input id="merek" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>tipe</td>
                            <td>: <input id="tipe" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>pabrik</td>
                            <td>: <input id="pabrik" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>kd_warna</td>
                            <td>: <input id="kd_warna" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>no_rangka</td>
                            <td>: <input id="no_rangka" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>no_mesin</td>
                            <td>: <input id="no_mesin" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>no_polisi</td>
                            <td>: <input id="no_polisi" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>silinder</td>
                            <td>: <input id="silinder" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>no_stnk</td>
                            <td>: <input id="no_stnk" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>tgl_stnk</td>
                            <td>: <input id="tgl_stnk" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>no_bpkb</td>
                            <td>: <input id="no_bpkb" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>tgl_bpkb</td>
                            <td>: <input id="tgl_bpkb" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>kondisi</td>
                            <td>: <input id="kondisi" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>tahun_produksi</td>
                            <td>: <input id="tahun_produksi" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>nip</td>
                            <td>: <input id="nip" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>dasar</td>
                            <td>: <input id="dasar" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>no_sk</td>
                            <td>: <input id="no_sk" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>tgl_sk</td>
                            <td>: <input id="tgl_sk" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>keterangan</td>
                            <td>: <input id="keterangan" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>kd_ruang</td>
                            <td>: <input id="kd_ruang" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>kd_lokasi2</td>
                            <td>: <input id="kd_lokasi2" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>metode</td>
                            <td>: <input id="metode" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>kd_unit</td>
                            <td>: <input id="kd_unit" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>tahun</td>
                            <td>: <input id="tahun" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>nilai_sisa</td>
                            <td>: <input id="nilai_sisa" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>tgl_sp2d</td>
                            <td>: <input id="tgl_sp2d" /></td>
                            <td></td>
                       </tr>
                       <tr hidden="true">
                            <td>foto</td>
                            <td>: <input id="foto" /></td>
                            <td></td>
                       </tr>
        </table>      
		</fieldset>
         <table align="right">
			 <tr style="padding:3px;border-spacing:5px 5px 5px 5px;">
                <td style="padding:3px;border-spacing:5px 5px 5px 5px;border-bottom-style:hidden;" colspan="5" align="right"><a class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="javascript:kosong();">Tambah</a>
                    <a class="easyui-linkbutton" id="save" iconCls="icon-save" plain="false" onclick="javascript:simpan();">Simpan</a>
		            <a class="easyui-linkbutton" id="hapus_advise" iconCls="icon-remove" plain="false" onclick="javascript:hapus();">Hapus</a>
  		            <a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:kembali();">Kembali</a>                                   
                </td>
            </tr>
		 </table>
        <table id="dg1" title="List Otori" style="width:870px;height:475px;" >  
        </table>  
        
        <div id="toolbar" align="right">
			<tr>
				<td align="left" width="100px">Cari&nbsp;&nbsp
					<input id="txt_std" class="easyui-searchbox" data-options="prompt:'Please Input Value',	searcher:function(value,name){cari_otori(value)}" style="width:180px"/>
				</td>
			</tr>
        </div>
                
   </p>
   </div>
   
</div>
</div>

</body>

<!-- </html> -->