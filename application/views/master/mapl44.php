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
       
        
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/master/load_mapl44',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'no_urut',
    		title:'NO URUT',
    		width:10,
            align:"left"},
            {field:'seq',
    		title:'SEQ NUMBER',
    		width:10,
            align:"left"},
            {field:'nama',
    		title:'NAMA',
    		width:40,
            align:"left"},
            {field:'jml_brg',
    		title:'Jumlah Barang',
    		width:10,
            align:"left"},
            {field:'nilai_ini',
            title:'NILAI',
            width:20,
            align:"left"}
        ]],
        onSelect:function(rowIndex,rowData){
          lcidx = rowIndex;
          no_urut = rowData.no_urut;
          seq = rowData.seq;
          nama = rowData.nama;
          nilai_ini = rowData.nilai_ini;
          jml_brg = rowData.jml_brg;
          unit_skpd = rowData.unit_skpd;
          
          get(no_urut,seq,nama,nilai_ini,jml_brg,unit_skpd);   
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
          lcidx = rowIndex;
          judul = 'Edit Data MAP'; 
          lcstatus = 'edit';
          no_urut = rowData.no_urut;
          seq = rowData.seq;
          nama = rowData.nama;
          nilai_ini = rowData.nilai_ini;
          jml_brg = rowData.jml_brg;
          unit_skpd = rowData.unit_skpd;
          get(no_urut,seq,nama,nilai_ini,jml_brg,unit_skpd);
          
          //get(kdusaha,nmusaha,jnsusaha,calamat,cnmpimpin,kdbank,kdrek); 
          edit_data();   
        }
        
        });
       
    });        

      
    function  get(no_urut,seq,nama,nilai_ini,jml_brg,unit_skpd){
        $("#no_urut").attr("value",no_urut);
        $("#seq").attr("value",seq);
        $("#nama").attr("Value",nama);
        $("#nilai_ini").attr("Value",nilai_ini);
        $("#jml_brg").attr("Value",jml_brg);                     
    }
    
    function kosong(){
        $("#no_urut").attr("value",'');
        $("#seq").attr("value",'');
        $("#nama").combogrid("setValue",'');
        $("#jml_brg").attr("value",0);
        $("#nilai_ini").attr("value",0);
        $("#unit_skpd").combogrid("setValue",'');
       
		//max_rinci();
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
        
        var no_urut = document.getElementById('no_urut').value;
        var seq = document.getElementById('seq').value;
       
        var nama = document.getElementById('nama').value;
        var nilai_ini = document.getElementById('nilai_ini').value;
        var jml_brg = document.getElementById('jml_brg').value;
        
        
        //alert(ckdrek);
       
        
        
        
        
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
            
            
            
            lcquery = "UPDATE mrekap_format_ivl44 SET nama='"+nama+"',nilai_ini='"+nilai_ini+"',jml_brg='"+jml_brg+"' where no_urut='"+no_urut+"' and unit_skpd='"+unit_skpd+"' ";
            
            
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
            		no_urut: no_urut,
                    seq: seq,
                    nama: nama,
                    nilai_ini: nilai_ini
                                             
            	}
            });
        }
       
        
        alert("Data Berhasil disimpan");
        $("#dialog-modal").dialog('close');
        //section1();
    } 
    
      function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data Map ';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        document.getElementById("no_urut").disabled=false;

        

        }    
        
    
     function tambah(){
        lcstatus = 'tambah';
        judul = 'Input Data MAP';
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
<h3 align="center"><u><b><a>INPUTAN MAP LAPORAN L44</a></b></u></h3>
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
        <table id="dg" align="center" title="LISTING DATA MAPING" style="width:900px;height:365px;" >  
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
                <td width="30%">No urut</td>
                <td width="1%">:</td>
                <td><input type="text" id="no_urut" style="width:100px;" readonly="true"/></td>  
            </tr>
           <tr>
                <td width="30%">Seq</td>
                <td width="1%">:</td>
                <td><input type="text" id="seq" style="width:100px;" readonly="true"/></td> 
            </tr>  
         
            <tr>
                <td width="30%">Nama</td>
                <td width="1%">:</td>
                <td><textarea rows="2" cols="50" id="nama" style="width: 450px;"></textarea>
            </tr> 
            <tr>
                <td width="30%" valign="top">Jumlah Barang</td>
                <td width="1%" valign="top">:</td>
                <td><input type="text" id="jml_brg" style="width:200px;"/></td> 
                </td>  
            </tr>       
            <tr>
                <td width="30%" valign="top">Nilai</td>
                <td width="1%" valign="top">:</td>
                <td><input type="text" id="nilai_ini" style="width:200px;"/></td> 
                </td>  
            </tr>
           
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

