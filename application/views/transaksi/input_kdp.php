
  	
    <script type="text/javascript">
    
    var kdkel= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
    var lckontrak = '';
                    
     $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
            height: 610,
            width: 810,
            modal: true,
            autoOpen:false,
        });
        });
            
      $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal_d" ).dialog({
            height: 500,
            width: 800,
            modal: true,
            autoOpen:false,
        });
        });
     
     $(function(){
        
     $('#gol').combogrid({  
       panelWidth:500,  
       idField:'golongan',  
       textField:'golongan',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_gol',  
       columns:[[  
           {field:'golongan',title:'golongan',width:100},  
           {field:'nm_golongan',title:'Nama Golongan',width:400}    
       ]],  
       onSelect:function(rowIndex,rowData){       
           $('#kd_brg').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_brg1',queryParams:({kdleft:rowData.golongan}) });
           $("#nmgol").attr("value",rowData.nm_golongan.toUpperCase());                
       }  
     });    
     
     $('#kd_brg').combogrid({  
       panelWidth:500,  
       idField:'kd_brg',  
       textField:'kd_brg',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_brg1',  
       columns:[[  
           {field:'kd_brg',title:'Kode Barang',width:100},  
           {field:'nm_brg',title:'Nama Barang',width:400}    
       ]],  
       onSelect:function(rowIndex,rowData){
           //kode = rowData.kd_skpd;               
           $("#nm_brg").attr("value",rowData.nm_brg.toUpperCase());                
       }  
     }); 
     
     $('#s_dana').combogrid({  
       panelWidth:500,  
       idField:'kd_sumberdana',  
       textField:'kd_sumberdana',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_s_dana',  
       columns:[[  
           {field:'kd_sumberdana',title:'Kode Sumber Dana',width:100},  
           {field:'nm_sumberdana',title:'Nama Sumber Dana',width:400}    
       ]],  
       onSelect:function(rowIndex,rowData){
           //kode = rowData.kd_skpd;               
           $("#nmdana").attr("value",rowData.nm_sumberdana.toUpperCase());                
       }  
     }); 
     
     $('#rek').combogrid({  
       panelWidth:500,  
       idField:'kd_rek5',  
       textField:'kd_rek5',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_rek5',  
       columns:[[  
           {field:'kd_rek5',title:'Kode Rekening',width:100},  
           {field:'nm_rek5',title:'Nama Rekening',width:400}    
       ]],  
       onSelect:function(rowIndex,rowData){
           //kode = rowData.kd_skpd;               
           $("#nmrek").attr("value",rowData.nm_rek5.toUpperCase());                
       }  
     }); 
     
     
     
     $('#keg').combogrid({  
       panelWidth:500,  
       idField:'kd_kegiatan',  
       textField:'kd_kegiatan',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_keg',  
       columns:[[  
           {field:'kd_kegiatan',title:'Kode Kegiatan',width:100},  
           {field:'nm_kegiatan',title:'Nama Kegiatan',width:400}    
       ]],  
       onSelect:function(rowIndex,rowData){
           kode = rowData.kd_skpd;               
           $("#nmkeg").attr("value",rowData.nm_kegiatan.toUpperCase());                
       }  
     });
     
     
      $('#uker').combogrid({  
       panelWidth:500,  
       idField:'kd_uskpd',  
       textField:'kd_uskpd',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_ubidskpd',  
       columns:[[  
           {field:'kd_uskpd',title:'Unit',width:100},  
           {field:'nm_uskpd',title:'Unit Bidang',width:400}    
       ]],  
       onSelect:function(rowIndex,rowData){
           kode = rowData.kd_skpd;               
           $("#nm_unit").attr("value",rowData.nm_uskpd.toUpperCase());                
       }  
     }); 
     
     
     $('#tgl_kontrak').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
                //ctgl = y+'-'+m+'-'+d;
            	return y+'-'+m+'-'+d;
            }
        }); 
     
     $('#tgl_sp2d').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });   
            
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/transaksi/load_kdp',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'no_kontrak',
    		title:'No Kontrak',
    		width:15,
            align:"center"},
            {field:'nm_uskpd',
    		title:'Nama Unit SKPD',
    		width:40},
            {field:'nilai_kontrak',
    		title:'Nilai',
    		width:15,
            align:"right"},
            {field:'tahun',
    		title:'Tahun',
    		width:15,
            align:"right"}
        ]],
        onSelect:function(rowIndex,rowData){
          lcidx = rowIndex;
          kduker = rowData.kd_uskpd;
          nmuker = rowData.nm_uskpd;
          nilai = rowData.nilai_kontrak; 
          no_kon = rowData.no_kontrak;
          tgl_kon = rowData.tgl_kontrak;
          lctahun = rowData.tahun;
          get(kduker,nmuker,nilai,no_kon,tgl_kon,lctahun); 
          load_detail(no_kon);  
          lckontrak = rowData.no_kontrak;
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
          lcidx = rowIndex;
          kduker = rowData.kd_uskpd;
          nmuker = rowData.nm_uskpd;
          nilai = rowData.nilai_kontrak; 
          no_kon = rowData.no_kontrak;
          tgl_kon = rowData.tgl_kontrak;
          lctahun = rowData.tahun;
          get(kduker,nmuker,nilai,no_kon,tgl_kon,lctahun); 
          lckontrak = rowData.no_kontrak;
          edit_data();  
        }
        
        });
        
        $('#dg1').edatagrid({  
            toolbar:'#toolbar',
            rownumbers:"true", 
            fitColumns:false,
            singleSelect:"true",
            autoRowHeight:"false",
            loadMsg:"Tunggu Sebentar....!!",            
            nowrap:"true",                                                     
            columns:[[
                {field:'id',
        		title:'ID',    		
                hidden:"true"},
                {field:'no_kontrak',
        		title:'No Kontrak',    		
                hidden:"true"},
                {field:'kd_kegiatan',
        		title:'KODE KEGIATAN',    		
                hidden:"true"},
                {field:'kd_rek5',
        		title:'REKENING',    		
                hidden:"true"},
                {field:'no_sp2d',
        		title:'NO SP2D',    		
                hidden:"true"},
                {field:'tg_sp2d',
        		title:'TGL SP2D',    		
                hidden:"true"},
                {field:'s_dana',
        		title:'DANA',    		
                hidden:"true"},    
                {field:'kd_brg',
        		title:'KODE BARANG',    		
                width:150,
                align:"center"},                
        	    {field:'nm_brg',
        		title:'URAIAN',
                width:380,
                align:"left"},
                {field:'nilai_sp2d',
        		title:'NILAI',
                width:150,
                align:"center"}                
            ]],
            onSelect:function(rowIndex,rowData){
              idx_d = rowIndex; 
            },          
           onDblClickRow:function(rowIndex,rowData){
           idx_d = rowIndex; 
           lcrekedt = rowData.kd_rek5;
           lcnmrekedt = rowData.nm_rek;
           lcnilaiedt = rowData.rupiah; 
           get_edt(lcrekedt,lcnmrekedt,lcnilaiedt); 
           
        }
            
            
        });
       
    });        
    
    function load_detail(lcnokon){        
           
            $(document).ready(function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>index.php/transaksi/load_dkdp',
                data: ({nokon:lcnokon}),
                dataType:"json",
                success:function(data){                                   
                                $.each(data,function(i,n){
                                id = n['id'];    
                                lckd_brg = n['kd_brg'];                                                                    
                                lcnm_brg = n['nm_brg'];    
                                lnnilai_sp2d = n['nilai_sp2d'];
                                lctgl = n['tgl_sp2d'];
                                lcnokon = n['no_kontrak'];
                                lckeg = n['kd_kegiatan'];
                                lcrek = n['kd_rek5'];
                                lcnosp2d = n['no_sp2d'];
                                lcdana = n['s_dana'];
                                $('#dg1').datagrid('appendRow',{id:id,kd_brg:lckd_brg,nm_brg:lcnm_brg,
                                nilai_sp2d:lnnilai_sp2d,tgl_sp2d:lctgl,no_sp2d:lcnosp2d,kd_kegiatan:lckeg,
                                kd_rek5:lcrek,s_dana:lcdana,no_kontrak:lcnokon});                         
                                });   
                                 
                }
            });
           });  
         set_grid();
                           
    }
    
    function get(kduker,nmuker,nilai,no_kon,tgl_kon,lctahun) {
        $("#no_kontrak").attr("value",no_kon);
        $("#tgl_kontrak").datebox("setValue",tgl_kon);
        $("#nilai_kontrak").attr("value",nilai);
        $("#nm_unit").attr("value",nmuker);
        $("#tahun").attr("value",lctahun);
        $("#uker").combogrid("setValue",kduker);             
    }
    
     function get_detail(kduker,nmuker,nilai,no_kon,tgl_kon,lctahun) {
        $("#no_kontrak").attr("value",no_kon);
        $("#tgl_kontrak").datebox("setValue",tgl_kon);
        $("#nilai_kontrak").attr("value",nilai);
        $("#nm_unit").attr("value",nmuker);
        $("#tahun").attr("value",lctahun);
        $("#uker").combogrid("setValue",kduker);             
    }
       
    function kosong(){
        $("#uker").combogrid("setValue",'');
        $("#no_kontrak").attr("value",'');
        $("#nilai_kontrak").attr("value",'');
        $("#nm_unit").attr("value",'');
        $("#tahun").attr("value",'');
        $("#tgl_kontrak").datebox("setValue",'');
        set_grid();
        
    }
    
    function set_grid(){
        $('#dg1').edatagrid({
            toolbar:'#toolbar',
            rownumbers:"true", 
            fitColumns:false,
            singleSelect:"true",
            autoRowHeight:"false",
            loadMsg:"Tunggu Sebentar....!!",            
            nowrap:"true",
            columns:[[
                {field:'id',
        		title:'ID',    		
                hidden:"true"},
                {field:'no_kontrak',
        		title:'No Kontrak',    		
                hidden:"true"},
                {field:'kd_kegiatan',
        		title:'KODE KEGIATAN',    		
                hidden:"true"},
                {field:'kd_rek5',
        		title:'REKENING',    		
                hidden:"true"},
                {field:'no_sp2d',
        		title:'NO SP2D',    		
                hidden:"true"},
                {field:'tg_sp2d',
        		title:'TGL SP2D',    		
                hidden:"true"},
                {field:'s_dana',
        		title:'DANA',    		
                hidden:"true"},    
                {field:'kd_brg',
        		title:'KODE BARANG',    		
                width:150,
                align:"center"},                
        	    {field:'nm_brg',
        		title:'URAIAN',
                width:380,
                align:"left"},
                {field:'nilai_sp2d',
        		title:'NILAI',
                width:150,
                align:"center"}                
            ]]
        });    
    }
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    
    $(function(){
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/transaksi/input_neraca',
        queryParams:({cari:kriteria})
        });        
     });
    }
    
    function simpan(){
       
        var lcnokontrak = document.getElementById('no_kontrak').value;
        var lctglkontrak = $('#tgl_kontrak').datebox('getValue');
        var lnnilaikontrak = document.getElementById('nilai_kontrak').value;
        var lcuker = $('#uker').combogrid('getValue');
        var lctahun = document.getElementById('tahun').value;
        
            
        if (lcnokontrak==''){
            alert('Kode SKPD Tidak Boleh Kosong');
            exit();
        } 
        
               
        //if(lcstatus=='tambah'){
            //simpan ke trh_kdp
            
            lcinsert = "(no_kontrak,tgl_kontrak,nilai_kontrak,kd_uskpd,tahun)";
            lcvalues = "('"+lcnokontrak+"','"+lctglkontrak+"','"+lnnilaikontrak+"','"+lcuker+"','"+lctahun+"')";
            alert(lcinsert+lcvalues);
            $(document).ready(function(){
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>index.php/master/simpan_master',
                    data: ({tabel:'trh_kdp',kolom:lcinsert,nilai:lcvalues,cid:'no_kontrak',lcid:lcnokontrak}),
                    dataType:"json"
                });
            });    
            
            //simpan ke trd_kdp
            
            $('#dg1').datagrid('selectAll');
            var rows = $('#dg1').datagrid('getSelections');   
             
    		lcval_det = '';
            for(var i=0;i<rows.length;i++){
                
            	lckdbrg    = rows[i].kd_brg;
                lck_giat   = rows[i].kd_kegiatan;
               
                lcrek      = rows[i].kd_rek5; 
                lcnosp2d   = rows[i].no_sp2d;
                lctglsp2d  = rows[i].tgl_sp2d;
                lnnilai_sp2d = rows[i].nilai_sp2d;
                lcdana = rows[i].s_dana;
                //alert(lcnokontrak+'-'+lckdbrg+'-'+lck_giat+'-'+lcrek+'-'+lcnosp2d+'-'+lctglsp2d+'-'+lnnilai_sp2d);
                //alert(cnosts+'/'+ckdrek+'/'+cnilai); 
                if(i>0){
    				lcval_det = lcval_det+",('"+lcnokontrak+"','"+lckdbrg+"','"+lck_giat+"','"+lcrek+"','"+lcnosp2d+"','"+lctglsp2d+"','"+lnnilai_sp2d+"','"+lcdana+"')";
    			}else{
    			    lcval_det = lcval_det+"('"+lcnokontrak+"','"+lckdbrg+"','"+lck_giat+"','"+lcrek+"','"+lcnosp2d+"','"+lctglsp2d+"','"+lnnilai_sp2d+"','"+lcdana+"')";
    			}              
                   
    		}
            lcinsert_d = "(no_kontrak,kd_brg,kd_kegiatan,kd_rek5,no_sp2d,tgl_sp2d,nilai_sp2d,s_dana)";
            $(document).ready(function(){
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>index.php/master/simpan_master',
                    data: ({tabel:'trd_kdp',kolom:lcinsert_d,nilai:lcval_det,cid:'no_kontrak',lcid:lcnokontrak}),
                    dataType:"json"
                });
            });  
            
            
            //alert(lcinsert_d+lcval_det);
            
      
        //}
         
    }
    
      function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data Neraca';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        document.getElementById("kdskpd").disabled=true;
        }    
        
    
     function tambah(){
        //alert('sdsdsd');
        lcstatus = 'tambah';
        judul = 'Inputan Neraca';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
        $("#dialog-modal").dialog('open');
//        document.getElementById("kdskpd").focus();
        } 
    
      
      function tambah_detail(){
       
        judul = 'Inputan Detai KDP';
        $("#dialog-modal_d").dialog({ title: judul });
        $("#dialog-modal_d").dialog('open');
        $("#kd_brg").combogrid("setValue",'');
        $("#no_sp2d").attr("value",'');
        //alert('sdsdsdsd');
        $("#tgl_sp2d").datebox("setValue",'');
        $("#nilai_sp2d").attr("value",'');
        $("#keg").combogrid("setValue",'');
        $("#rek").combogrid("setValue",'');
        $("#s_dana").combogrid("setValue",'');
        $("#keterangan").attr("value",'');
        
        } 
    
     function keluar(){
        $("#dialog-modal").dialog('close');
     }
     
     function keluar_detail(){
        $("#dialog-modal_d").dialog('close');
     }      
    
     function hapus_detail(){
        $('#dg1').datagrid('deleteRow',idx_d);     
    }
    
     function hapus(){
        var ckdbrg = document.getElementById('kdbrg').value;
               
        var urll = '<?php echo base_url(); ?>index.php/master/hapus_master';
        $(document).ready(function(){
         $.post(urll,({tabel:'mbarang',cnid:ckdbrg,cid:'kd_brg'}),function(data){
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
    
      function plus_detail(){
        var lckd_brg = $('#kd_brg').combogrid('getValue');
        var lcnm_brg = document.getElementById('nm_brg').value;
        var lcnosp2d = document.getElementById('no_sp2d').value;
        var lnnilai_sp2d = document.getElementById('nilai_sp2d').value;
        var lctgl = $('#tgl_sp2d').datebox('getValue');
        var lcgiat = $('#keg').combogrid('getValue'); 
        var lcrek =  $('#rek').combogrid('getValue'); 
        var lcdana = $('#s_dana').combogrid('getValue'); 
        var lcket = document.getElementById('keterangan').value;
        
           
        $('#dg1').datagrid('appendRow',{no_kontrak:lckontrak,kd_brg:lckd_brg,nm_brg:lcnm_brg,
        nilai_sp2d:lnnilai_sp2d,tgl_sp2d:lctgl,s_dana:lcdana,keterangan:lcket,kd_rek5:lcrek,
        kd_kegiatan:lcgiat,no_sp2d:lcnosp2d});
        keluar_detail();
      }
    
  
   </script>

<div id="content1"> 
<h3 align="center"><u><b><a>INPUTAN KONTRUKSI DALAM PENGERJAAN</a></b></u></h3>
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
        <table id="dg" align="center" title="LISTING KDP" style="width:900px;height:365px;" >  
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
                <td>No Kontrak</td>
                <td>:</td>
                <td colspan="2"><input type="text" id="no_kontrak" style="width:100px;"/></td>
           </tr>
            <tr>
                <td width="20%">Tanggal Kontrak</td>
                <td width="1%">:</td>
                <td colspan="2"><input type="text" id="tgl_kontrak" style="width: 140px;" /></td>  
            </tr>            
            <tr>
                <td width="20%" valign="top">Nilai Kontrak</td>
                <td width="1%" valign="top">:</td>
                <td colspan="2"><input name="nilai_kontrak" type="text" id="nilai_kontrak" style="width:150px;"/>
                <input name="nkontrak" type="hidden" id="nkontrak" style="width:150px;" readonly="true"/></td>  
            </tr>
            <tr>
                <td>Unit Kerja</td>
                <td>:</td>
                <td><input type="text" id="uker" style="width:60px;"/> <input type="text" id="nm_unit" style="border:0;width: 450px;" readonly="true"/>                
                </td>
           </tr>
           <tr>
                <td>Tahun</td>
                <td>:</td>
                <td colspan="2"><input type="text" id="tahun" style="width:100px;"/></td>                
                </td>
           </tr>
           <tr>
                <td colspan="3">
                <table id="dg1" align="center" title="LISTING KDP" style="width:720px;height:300px;" >  
                </table>
                </td>
                <td><table>
                    <tr><td><a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:tambah_detail()"></a></td></tr>
                    <tr><td><a class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:hapus_detail();"></a></td></tr>
                    <tr><td><a class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="javascript:edit_detail();"></a></td></tr>
                </table>
                </td>
           </tr>
            
            <tr>
            <td colspan="3">&nbsp;</td>
            </tr>            
            <tr>
                <td colspan="4" align="center"><a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:simpan();">Simpan</a>
		        <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Kembali</a>
                </td>                
            </tr>
        </table>  
            
    </fieldset> 
</div>

<div id="dialog-modal_d" title="">
    <p class="validateTips">&nbsp;<b>KETERANGAN BARANG</b></p> 
    <fieldset>
     <table align="center" style="width:100%;" border="0">
       <tr>
            <td>GOL BARANG</td>
            <td>:</td>
            <td><input id="gol" name="gol" style="width: 50px;" /> <input type="text" id="nmgol" style="border:0;width: 430px;" readonly="true"/></td>
       </tr> 
       <tr>
            <td width="20%">Barang</td>
            <td width="1%">:</td>
            <td><input type="text" id="kd_brg" style="width:100px;"/>
            <input type="text" id="nm_brg" style="border:0;width: 430px;" readonly="true"/>
            </td>
       </tr>
      </table>  
    </fieldset> 
    <p class="validateTips">&nbsp;<b>BUKTI SP2D</b></p> 
    <fieldset>
     <table align="center" style="width:100%;" border="0">
       <tr>
            <td>NO SP2D</td>
            <td>:</td>
            <td><input type="text" id="no_sp2d" style="width:100px;"/></td>
       </tr>
       <tr>
            <td width="20%">Tanggal SP2D</td>
            <td width="1%">:</td>
            <td><input type="text" id="tgl_sp2d" style="width: 140px;" /></td>  
       </tr>            
       <tr>
            <td width="20%" valign="top">Nilai SP2D</td>
            <td width="1%" valign="top">:</td>
            <td><input name="nilai_sp2d" type="text" id="nilai_sp2d" style="width:150px;"/>
            <input name="nsp2d" type="hidden" id="nsp2d" style="width:150px;" readonly="true"/></td>  
       </tr>
       <tr>
            <td>Kegiatan</td>
            <td>:</td>
            <td><input id="keg" name="keg" style="width:120px;"/><input type="text" id="nmkeg" style="border:0;width: 410px;" readonly="true"/></td>
       </tr>
       <tr>
            <td>Rekening</td>
            <td>:</td>
            <td><input type="text" id="rek" name="rek" style="width:120px;"/>
            <input type="text" id="nmrek" style="border:0;width: 410px;" readonly="true"/>
            </td>
       </tr>
       <tr>
            <td>Sumber Dana</td>
            <td>:</td>
            <td><input type="text" id="s_dana" name="s_dana" style="width:120px;"/>
            <input type="text" id="nmdana" style="border:0;width: 410px;" readonly="true"/>
            </td>
       </tr>
       
       <tr>
            <td valign="top">Keterangan</td>
            <td valign="top">:</td>
            <td><textarea rows="2" cols="50" id="keterangan" name="keterangan" style="width: 450px;"></textarea></td>
       </tr>
       
       <tr>
        <td colspan="3">&nbsp;</td>
       </tr>            
       <tr>
            <td colspan="3" align="center"><a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:plus_detail();">Simpan</a>
	        <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar_detail();">Kembali</a>
            </td>                
       </tr>
     </table>  
            
    </fieldset> 
</div>