<script src="<?php echo base_url(); ?>lib/sweet-alert.min.js"></script>
<link   rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>lib/sweet-alert.css">
<script type="text/javascript" src="<?php echo base_url(); ?>easyui/autoCurrency.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>easyui/currencyFields.js"></script>
<script type="text/javascript">
    
    var updt = 'f';
    var idx2 = '';
    var total2 = 0;
    
     $(document).ready(function() {
          $("#tabs").tabs();
          $("#dialog-modal").dialog({
            height: 600,
            width: 600,
            modal: true, 
            background:'#2da305',           
            autoOpen:false                
          });                       
     });    
     
    $(function(){  
         $('#trh').datagrid({
    		url: "<?php echo base_url(); ?>index.php/transaksi/load_mutasi",
            idField:"no_dokumen",            
            rownumbers:"true", 
            fitColumns:"true",
            singleSelect:"true",
            autoRowHeight:"false",
            loadMsg:"Tunggu Sebentar....!!",
            pagination:"true",
            nowrap:"true",                       
            columns:[[
        	    {field:'kd_brg',title:'KODE BARANG',width:20},
        	    {field:'nm_brg',title:'NAMA BARANG',width:30},
                {field:'tgl_mutasi',title:'TGL MUTASI',width:30},
                {field:'kd_unitb',title:'SKPD',width:100}
            ]],
            onSelect:function(rowIndex,rowData){ 
                nomor   = rowData.no_dokumen;
                tgl     = rowData.tgl_dokumen;
                kode    = rowData.kd_uskpd;
                nmkode  = rowData.nm_uskpd;
                tahun   = rowData.tahun;
                total   = rowData.total;
                get(nomor,tgl,kode,nmkode,tahun,total);
                load_detail();
            },
            onDblClickRow:function(rowIndex,rowData){         
                section2();                                  
            }
        });
                
         $('#trd2').edatagrid({    		
            idField:"no_dokumen",            
            rownumbers:"true",            
            singleSelect:"true",
            autoRowHeight:"false",             
            loadMsg:"Tunggu Sebentar....!!",            
            nowrap:"true",
            onSelect:function(rowIndex,rowData){
                idx2 = rowIndex;
                var b = rowData.kd_brg;
                var jns = b.slice(0,2);   
                updt = 't';                             
                get2(jns,rowData.kd_brg,rowData.nm_brg,rowData.merek,rowData.jumlah,rowData.harga,rowData.total,rowData.ket); 
            }          
        });
        
        $('#trd').edatagrid({    		   
            rownumbers:"true",           
            toolbar:'#toolbar',
            loadMsg:"Load Barang....!!",            
            nowrap:"true"
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
        
         $('#uskpd').combogrid({  
            panelWidth:700,  
            idField:'kd_uskpd',  
            textField:'kd_uskpd',  
            mode:'remote',                      
            url:'<?php echo base_url(); ?>index.php/master/ambil_ubidskpd',  
            columns:[[  
               {field:'kd_uskpd',title:'Kode Unit',width:100},  
               {field:'nm_uskpd',title:'Nama Unit',width:700}    
            ]],  
            onSelect:function(rowIndex,rowData){
               cuskpd = rowData.kd_uskpd;               
               $('#nmuskpd').attr('value',rowData.nm_uskpd);    
                nomer_akhir();
				
            } 
         });  
        
        $('#kib').combogrid({  
            panelWidth:400,  
            width:160,
            idField:'golongan',  
            textField:'nm_golongan',  
            mode:'remote',                                  
            url:'<?php echo base_url(); ?>index.php/master/ambil_gol',  
            columns:[[  
               {field:'golongan',title:'Kode Golongan',width:100},  
               {field:'nm_golongan',title:'Nama Golongan',width:300}    
            ]],  
            onSelect:function(rowIndex,rowData){ 
              cgol = rowData.golongan;                                
                load_kib(cgol);  
            } 
        }); 
		
          
                $('#tgl_reg').datebox({  
                    required:true,
                    formatter :function(date){
                  	var y = date.getFullYear();
                   	var m = date.getMonth()+1;
                   	var d = date.getDate();    
                   	return y+'-'+m+'-'+d;
                    }
                });
                
                $('#uskpdb').combogrid({  
                    panelWidth:500,  
                    idField:'kd_skpd',  
                    textField:'kd_skpd',  
                    mode:'remote',                      
                    url:'<?php echo base_url(); ?>index.php/master/ambil_skpd',  
                    columns:[[  
                       {field:'kd_skpd',title:'Kode Unit',width:80},  
                       {field:'nm_skpd',title:'Nama Unit',width:400}    
                    ]],  
                    onSelect:function(rowIndex,rowData){
                       cuskpd = rowData.kd_skpd;               
                       $('#nmuskpdb').attr('value',rowData.nm_skpd);
                       $('#skpdx').attr('value',rowData.skpd);    
                    } 
                 });   
				 
				 $('#tanggal').datebox('setValue','<?php echo date('y-m-d')?>');
    });
    
      function nomer_akhir(){
        var i 		= 0; 
        var tabel 	='mutasi_brg'
        var kd_unit	= cuskpd; 
        var tanggal	= '<?php echo date('y-m-d');?>';
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>index.php/transaksi/nomor',
            data: ({tabel:'mutasi_brg',kd_unit:kd_unit}),
            dataType:"json",
            success:function(data){                                          
                $.each(data,function(i,n){                                    
                    nom      = n['urut'];  
					nomorku	= tambah_urut(nom,4);
                    no_reg   = n['no_reg'];  
                    $("#no_urut").attr("value",nomorku);
                    $("#no_reg").attr("value",no_reg); 
                    $("#tanggal").datebox("setValue",tanggal);                         
                });
            }
        });        
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
	
    function section1(){        
        $('#tabs1').click();   
        set_grid();                                                     
    }
    function section2(){            
        $('#tabs2').click();
        set_grid();                                                        
    
    }
   
    function load_kib(cgol){
       var i 		= 0;
        var ngol 	= cgol;
        var cuskpd  = $('#uskpd').combogrid('getValue');
		var cari 	= document.getElementById('cari_brg');
        $('#trd').edatagrid({
            url: '<?php echo base_url(); ?>index.php/transaksi/ambil_mutasi',
            queryParams:({kdskpd:cuskpd,gol:ngol}),
            rownumbers:true, 
            fitColumns:false,
            singleSelect:false,
			pagination:"true",
			columns:[[
            	    {field:'no_dokumen',title:'Nomor Dokumen',width:50,hidden:true},
                    {field:'no_reg',title:'NO REG ',width:60,align:"center"},
                    {field:'kd_brg',title:'KODE BARANG',width:110},
                    {field:'nm_brg',title:'NAMA BARANG',width:320},
                    {field:'tgl_reg',title:'TANGGAL',width:100,align:"center"},
                    {field:'kondisi',title:'KONDISI',width:100,align:"right",hidden:true},
                    {field:'tahun',title:'TAHUN',width:70,align:"center"},
                    {field:'nilai',title:'HARGA',width:180,align:"right"},  
                    {field:'no',title:'ck',width:30,checkbox:true}         
                ]],
                
                onSelect:function(rowIndex,rowData){ 
                    nomor   = rowData.no_dokumen;
                    no_reg  = rowData.no_reg;
                    id_brg  = rowData.id_brg;
                    kode    = rowData.kd_brg;
                    nama    = rowData.nm_brg;
                    tgl     = rowData.tgl_reg;
                    kondisi = rowData.kondisi;
                    tahun   = rowData.tahun;
                    nilai   = rowData.nilai;
                    get2(no_reg,id_brg,nomor,kode,nama,tgl,kondisi,tahun,harga);
                //load_detail();
				//no_reg:reg,id_brg:id_brg,no_dokumen:no,kd_brg:kd,nm_brg:nm,tgl_reg:tgl,kondisi:kds,tahun:thn,harga:hrg,total:total
                },   
                onDblClickRow:function(rowIndex,rowData){ 
				/* reg,uskpdb,kd,id_brg,nmuskpdb,nm,merek,thn,kds,tgl_reg,hrg,ket */
				$('#reg').attr('value',rowData.no_reg);	
				$('#kd').attr('value',rowData.kd_brg);
				$('#nm').attr('value',rowData.nm_brg); 
				$('#id_brg').attr('value',rowData.id_barang);	
				$('#thn').attr('value',rowData.tahun);	
				$('#kds').attr('value',rowData.kondisi);
				$('#tgl_reg').datebox('setValue',rowData.tgl_reg);	
				$('#hrg').attr('value',number_format(rowData.nilai));
				$("#dialog-modal").dialog('open'); 
                 //tambah_detail()
                }
        }); 
    }


    /* function set_grid(){
         $('#trd').datagrid({    
              columns:[[
            	    {field:'no_dokumen',title:'Nomor Dokumen',width:50,hidden:true},
                    {field:'no_reg',title:'NO REG ',width:60,align:"center"},
                    {field:'kd_brg',title:'KODE BARANG',width:110},
                    {field:'nm_brg',title:'NAMA BARANG',width:320},
                    {field:'tgl_reg',title:'TANGGAL',width:100,align:"center"},
                    {field:'kondisi',title:'KONDISI',width:100,align:"right",hidden:true},
                    {field:'tahun',title:'TAHUN',width:70,align:"center"},
                    {field:'harga',title:'HARGA',width:180,align:"right"},   
                    {field:'no',title:'ck',width:30,checkbox:true}         
                ]],
                
                onSelect:function(rowIndex,rowData){ 
                    nomor   = rowData.no_dokumen;
                    no_reg  = rowData.no_reg;
                    id_brg  = rowData.id_brg;
                    kode    = rowData.kd_brg;
                    nama    = rowData.nm_brg;
                    tgl     = rowData.tgl_reg;
                    kondisi = rowData.kondisi;
                    tahun   = rowData.tahun;
                    harga   = rowData.harga;
                    get2(no_reg,id_brg,nomor,kode,nama,tgl,kondisi,tahun,harga);
                //load_detail();
				//no_reg:reg,id_brg:id_brg,no_dokumen:no,kd_brg:kd,nm_brg:nm,tgl_reg:tgl,kondisi:kds,tahun:thn,harga:hrg,total:total
                },   
                onDblClickRow:function(rowIndex,rowData){ 
                //id_brg   = rowData.id_brg; 
				//$('#id_brg').attr('value',id_brg);				
                 tambah_detail()
                }
        }); 
                 
    } */
  
    
    function tambah_detail(){
        var no = document.getElementById('no_urut').value;
        var tgl = $('#tanggal').datebox('getValue');
        var kd  = $('#uskpd').combogrid('getValue'); alert("msuk");
        $('#trd2').datagrid('reload');
        if (no!='' && tgl!='' && kd!=''){
            $("#dialog-modal").dialog('open');            
            kosong2();       
        } else {
            alert('Nomor/Tanggal/Unit Kerja masih kosong, harap isi terlebih dahulu');
        }        
    }
    
   function get2(no_reg,id_brg,nomor,kode,nama,tgl,kondisi,tahun,harga){ 
        $('#reg').attr('value',no_reg);
        $('#kd').attr('value',kode);
        $('#nm').attr('value',nama); 
        $('#tgl_reg').datebox('setValue',tgl);
        $('#kds').attr('value',kondisi);
        $('#thn').attr('value',tahun);
        $('#hrg').attr('value',harga); 
        $('#id_brg').attr('value',id_brg);      
    }
    
    function kosong2(){
		var skpd  = '<?php echo ($this->session->userdata('unit_skpd')); ?>';
		//alert(skpd);
        $('#uskpdb').combogrid('setValue','');
		$('#nmuskpdb').attr('value','');
    }
        
    function keluar(){
        $("#dialog-modal").dialog('close');
        $('#trd2').datagrid('reload');                            
    }   
   
    function simpan(){

		var id_brg     = document.getElementById('id_brg').value; 
		var cno_urut   = document.getElementById('no_urut').value;
        var	ctgl_muts  = $('#tanggal').datebox('getValue');
        var	cno_reg    = document.getElementById('reg').value;
        var	ckd_brg    = document.getElementById('kd').value; 
        var cuskpdb    = $('#uskpdb').combobox('getValue');
        var	ckondisi   = document.getElementById('kds').value;
        var	cuskpd     = $('#uskpd').combobox('getValue');
        var	skpdx      = document.getElementById('skpdx').value;
        var	cthn       = document.getElementById('thn').value;
        var	chrg       = angka(document.getElementById('hrg').value);
        var	cket       = document.getElementById('ket').value;
        var gol        = cgol;
        var cno_muts   = cuskpd+"."+cuskpdb+"."+cthn+"."+cno_reg+"."+cno_urut;
        if (cuskpdb == ''){
            alert('SKPD Tidak Boleh Kosong');
            exit();              
        } 
		
         $(document).ready(function(){
            $.ajax({
                type: "POST",       
                dataType : 'json',         
                data: ({tabel:'mutasi_brg',lcgol:gol,no:cno_muts,id_brg:id_brg,cno_urut:cno_urut,tgl:ctgl_muts,noreg:cno_reg,kdbrg:ckd_brg,uskpd:cuskpd,skpdx:skpdx,uskpdb:cuskpdb,kondisi:ckondisi,tahun:cthn,hrg:chrg,ket:cket}),
                url: '<?php echo base_url(); ?>index.php/transaksi/simpan_mts_skpd',
                success:function(data){
                status = data.pesan;   
                    if (status=='1'){               
                    swal({
					title: "Success!",
					text: "Data Diusulkan Mutasi.!!",
					type: "success",
					confirmButtonText: "OK"
					});
					exit();
                    } else{ 
					swal({
					title: "Error!",
					text: "Gagal Tersimpan.!!",
					type: "error",
					confirmButtonText: "OK"
					});
					exit();
                    }                                                                                                                                       
                }
            });
       }); 
        
        $("#dialog-modal").dialog('close');
    
        $('#kib').combogrid({  
            panelWidth:400,  
            width:160,
            idField:'golongan',  
            textField:'nm_golongan',  
            mode:'remote',                                  
            url:'<?php echo base_url(); ?>index.php/master/ambil_gol',  
            columns:[[  
               {field:'golongan',title:'Kode Golongan',width:100},  
               {field:'nm_golongan',title:'Nama Golongan',width:300}    
            ]],  
            onSelect:function(rowIndex,rowData){ 
              cgol = rowData.golongan;                                
                load_kib(cgol);  
            } 
        }); 
    
    
     }

function cari(){
    var kriteria = document.getElementById("cari_brg").value; 
    var ngol 	= $('#kib').combogrid('getValue');
    var cuskpd  = $('#uskpd').combogrid('getValue');
    $(function(){
     $('#trd').edatagrid({
		url: '<?php echo base_url(); ?>index.php/transaksi/ambil_mutasi',
        queryParams:({cari:kriteria,kdskpd:cuskpd,gol:ngol})
        });        
     });
    }
    
   </script>


<div id="tabs" >
		<p><h3 align="center">MUTASI BARANG</h3></p>
    <ul style="background-color:#2da305;">
        <li><a href="#tabs-1" style="width: 452px;" id="tabs1">Form Input</a></li>
        <li><a href="#tabs-2" style="width: 452px;" id="tabs2">List View</a></li>        
    </ul>
    <div id="tabs-2">
        <div>
            <p align="right">
                <!--a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:kosong();section2();">Tambah</a-->               
                <a class="easyui-linkbutton" iconCls="icon-search" plain="true" >Cari</a>
                <input type="text" value="" id="txtcari"/>              
                <table  id="trh" title="List Dokumen" style="width:940px;height:400px;" >  
                </table>                
            </p>
        </div>
    </div>
    <div id="tabs-1">  
        <br /><br />
        <table>
            <tr >
                <td height="30px">No. Mutasi</td>
                <td>:</td>
                <td><input readonly="true" placeholder="Auto Number" type="text" id="no_urut" style="width: 160px;" onclick="javascript:select();" /></td>
                <td width="70px"></td>
                <td>Tanggal Mutasi</td>
                <td>:</td>
                <td><input type="text" id="tanggal" style="width: 140px;" /></td>     
            </tr>
            <tr>
                <td height="30px">Unit Kerja</td>
                <td>:</td>
                <td><input id="uskpd" name="uskpd" style="width: 160px;" /></td>
                <td></td>
                <td>Nama Unit Kerja</td> 
                <td>:</td>
                <td><input type="text" id="nmuskpd" style="border:0;width: 400px;" readonly="true"/></td>                                
            </tr>
            <tr>
                <td height="30px">Pilih Kib</td>
                <td>:</td>
                <td><input id="kib" name="kib" style="width: 250px;" /></td>
            </tr> </table>
			<table><tr>
			<td colspan="2"><input placeholder="*cari nama aset" type="text" value="" id="cari_brg" style="width: 250px;" /></td>  
			<td > 
			<a class="easyui-linkbutton" iconCls="icon-file_search" plain="true" onclick="javascript:cari();" ></a>
			</td>
			</tr>
			<!--TOLONG PERBAIKI--tr>
			<td colspan="3"> 
			<a class="easyui-linkbutton" iconCls="icon-file_search" plain="true" onclick="javascript:cari();" >Cari Barang</a>
           <input type="text" value="" id="cari_brg" style="width: 300px;" />  
			</td>
			</tr-->                         
        </table>  
        <br />
        <table  id="trd" title="Detail Barang" style="width:940px;height:300px;" >  
        </table>       
        <!--div align="right">Total : <input type="text" id="total" style="text-align: right;border:0;width: 200px;font-size: large;" readonly="true"/></div-->        
        <div id="toolbar" align="center" >
    		<a><b>PILIH KIB MUTASI</b></a>  
        </div>
    </div>  
</div>

<div id="dialog-modal" title="Mutasi Barang" >
    <p class="validateTips" >Barang yang akan di mutasi</p> 
    <fieldset>      
        <table > 
            <tr>
                <td>No Registrasi</td>
                <td>:</td>
                <td><input id="reg" name="reg" disabled="true"/>  </td>  
                <td width="40px"></td>
                <td>SKPD BARU</td>
                <td>:</td>
                <td><input type="text" id="uskpdb" style="width: 140px;" /><input type="text" id="skpdx" style="width: 140px;" hidden="true"/></td>                               
            </tr>         
            <tr>
                <td>Kode barang</td>
                <td>:</td>
                <td><input id="kd" name="kd" disabled="true"/>  </td>  
                <td width="40px"></td>
                <td><input hidden="true" type="text" id="id_brg" style="border:0;width: 140px;" readonly="true"  /></td>
                <td></td>
                <td><input type="text" id="nmuskpdb" style="border:0;width: 140px;" readonly="true"  /></td>                                 
            </tr>      
            <tr>
                <td>Nama barang</td>
                <td>:</td>
                <td><input id="nm" name="nm" disabled="true">  </td>   
            </tr>        
            <tr>
                <td>Merek</td>
                <td>:</td>
                <td><input id="merek" name="merek" value="" disabled="true">  </td>            
            </tr> 
            <tr>
                <td>Tahun</td>
                <td>:</td>
                <td><input id="thn" name="thn" disabled="true">  </td>            
            </tr> 
            
            <tr>
                <td>Kondisi</td>
                <td>:</td>
                <td><input id="kds" name="kds" disabled="true">  </td>            
            </tr>      
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td><input id="tgl_reg" name="tgl_reg" value="" style="text-align: right;" disabled="true">  </td>            
            </tr> 
            <tr>
                <td>Harga</td>
                <td>:</td>
                <td><input id="hrg" name="hrg" value="" style="text-align: right;border:0;" readonly="true" />  </td>            
            </tr>  
            <tr>
                <td>Keterangan</td>
                <td>:</td>
                <td><textarea id="ket" style="width: 155px; height: 60px;"></textarea> </td>            
            </tr> 
        </table>            
    </fieldset>  
    <fieldset>
        <table align="center">
            <tr>
                <td>
                    <a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:simpan();">Simpan</a>
                    <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Keluar</a>                               
                </td>
            </tr>
        </table>   
    </fieldset>
</div>

