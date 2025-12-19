    <script src="<?php echo base_url(); ?>lib/sweet-alert.min.js"></script>
    <link   rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>lib/sweet-alert.css">
    <script type="text/javascript">
    
    var knip= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
                    
     $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
            height: 350,
            width: 600,
            modal: true,
            autoOpen:false,
        });
        });    


     $(function(){     	 
     $('#oto').combogrid({  
       panelWidth:150,  
       panelHeight:160,  
       idField:'oto',  
       textField:'ket',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/load_oto',  
       columns:[[  
           {field:'oto',title:'KODE ',width:40},  
           {field:'ket',title:'KETERANGAN',width:90}    
       ]] 
     })   
	 });
			
   $(function(){     	 
     $('#skpd').combogrid({  
       panelWidth:400,  
       panelHeight:260,  
       idField:'kd_skpd',  
       textField:'kd_skpd',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_msskpd',  
       columns:[[  
           {field:'kd_skpd',title:'KODE ',width:80},  
           {field:'nm_skpd',title:'NAMA',width:350}    
       ]],
		onSelect:function(rowIndex,rowData){
          lcidx = rowIndex;
          kd_skpd 	 = rowData.kd_skpd;  
          nm_bidskpd = rowData.nm_skpd; 
		  $("#nmskpd").attr("value",nm_bidskpd.toUpperCase());
                                       
        }
     })   
	 });
     
	$(function(){     	 
     $('#unit_skpd').combogrid({  
       panelWidth:400,  
       panelHeight:260,  
       idField:'kd_lokasi',  
       textField:'kd_lokasi',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/master/ambil_lokasi',  
       columns:[[  
           {field:'kd_lokasi',title:'KODE ',width:80},  
           {field:'nm_lokasi',title:'NAMA',width:350}    
       ]],
		onSelect:function(rowIndex,rowData){
          lcidx = rowIndex;
          kd_lokasi 	 = rowData.kd_lokasi;  
          nm_lokasi 	 = rowData.nm_lokasi; 
          $("#nmunit_skpd").attr("value",nm_lokasi.toUpperCase());
                                       
        } 
     })   
	 });
	 
     $(function(){
     
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>/index.php/master/load_user',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",
			
        columns:[[
    	    {field:'nmuser',
    		title:'USER',
    		width:10,
            align:"left"},
            {field:'nmoto',
    		title:'OTORISASI',
    		width:10},
            {field:'ket',
    		title:'KETERANGAN',
    		width:40}
        ]],
        onSelect:function(rowIndex,rowData){
          lcidx = rowIndex;
          kd    = rowData.kode;
          nm    = rowData.nmuser;
          ket   = rowData.ket;
          pass  = rowData.pass;
		      oto   = rowData.oto;	
		      get(kd,nm,ket,oto,pass);
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
          lcidx = rowIndex;
          judul = 'Edit Data User'; 
          lcstatus = 'edit';
          nm 	  = rowData.nmuser;
          ket 	= rowData.ket;
          pass  = rowData.pass;
		      oto 	= rowData.oto;
          skpd 	= rowData.skpd;
		      uskpd = rowData.uskpd;	
		      gete(nm,ket,oto,skpd,uskpd,pass);   
          edit_data();   
        }
        
        });
       
    });        

      
    function get(kd,nm,ket,oto,pass){
        $("#kode").attr("value",kd);
        $("#user").attr("value",nm);
        $("#ket").attr("value",ket);
        $("#pass").attr("value",pass);
        $("#oto").combogrid("setValue",oto);
    }
	
     function gete(nm,ket,oto,skpd,uskpd,pass){
        $("#user").attr("value",nm);
        $("#ket").attr("value",ket);
        $("#pass").attr("value",pass);
        $("#oto").combogrid("setValue",oto).disabled=true;
        $("#skpd").combogrid("setValue",skpd);
        $("#unit_skpd").combogrid("setValue",uskpd);
		
    }
       
    function kosong(){
        $("#user").attr("value",'');
        $("#ket").attr("value",'');
        $("#pass").attr("value",'');
        $("#pass").attr("disabled",false);
        $("#nmskpd").attr("value",'');
        $("#nmunit_skpd").attr("value",'');
        $("#skpd").combogrid("clear");
        $("#unit_skpd").combogrid("clear");
        $("#oto").combogrid("setValue",'');
    }
    
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    
    $(function(){
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>/index.php/master/load_user',
        queryParams:({cari:kriteria})
        });        
     });

	}
    
    function simpan(){
        var kode = document.getElementById('kode').value;
        var cuser = document.getElementById('user').value; 
        var cpass = document.getElementById('pass').value;
        var cket  = document.getElementById('ket').value;
        var cnmskpd  = document.getElementById('nmskpd').value;
        var coto  = $('#oto').combogrid('getValue');
        var cskpd  = $('#skpd').combogrid('getValue');
        var cunit_skpd  = $('#unit_skpd').combogrid('getValue');
		if (cpass=='')
		{
			alert('Password Tidak Boleh Kosong');
			exit();
		}		
		if (cket==''){
            alert('INPUTAN KETERANGAN TIDAK BOLEH KOSONG.!!');
            exit();
        }
		if(lcstatus=='tambah'){
		$(document).ready(function(){
			$.ajax({
				type: "POST",
				url: '<?php echo base_url(); ?>/index.php/master/simpan_user',
				data: ({user:cuser,pass:cpass,ket:cket,skpd:cskpd,unit_skpd:cunit_skpd,oto:coto,cnmskpd:cnmskpd,del:'0'}),
				dataType:"json"
			});
		});                                            
	
		alert("Data Berhasil disimpan.!");
		$("#dialog-modal").dialog('close');
		$('#dg').datagrid('reload');        
      }else{
        var urlx = '<?php echo base_url(); ?>index.php/master/update_user_dh';
      $(document).ready(function(){
        $.ajax({url:urlx,
           dataType:'json',
           type: "POST",    
           data:({kode:kode,user:cuser,pass:cpass,ket:cket,skpd:cskpd,unit_skpd:cunit_skpd,oto:coto,cnmskpd:cnmskpd,del:'0'}),
           success:function(data){
            status = data.pesan;
            if (status=='1'){
              swal({
                  title: "Berhasil",
                  text: "Data Berhasil di Update....!!",
                  imageUrl:"<?php echo base_url();?>/lib/images/biak.jpg"
              });
              $("#dialog-modal").dialog('close');
              $('#dg').datagrid('reload'); 
            } else {
              swal({
                  title: "Ooopppsssssss......!!!!!!",
                  text: "Data Gagal Update.!!",
                  imageUrl:"<?php echo base_url();?>/lib/images/biak.jpg"
              });
            }        
           }
           
        });           
      });
	  
	  }

    } 
    
      function edit_data(){
        lcstatus = 'edit';
        judul = 'USER TIDAK DIPERKENANKAN MENGEDIT, SILAHKAN HAPUS DAHULU JIKA INGIN MERUBAH.!';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        document.getElementById("user").disabled=true;
        document.getElementById("pass").disabled=false;
        //$("#pass").attr("value",'');

		}    
        
    
     function tambah(){
        lcstatus = 'tambah';
        judul = 'Input Data user';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
        $("#dialog-modal").dialog('open');
        document.getElementById("user").disabled=false;
        document.getElementById("user").focus();
        } 
     function keluar(){
        $("#dialog-modal").dialog('close');
     }    
    
     function hapus(){
        var cuser  = document.getElementById('user').value;
        var ckode  = document.getElementById('kode').value;
		var r = confirm("Apakah Anda Yakin Ingin Menghapus User : "+cuser+" ?");
        
		if(r==true){
			$(document).ready(function(){
				$.ajax({
					type: "POST",
					url: '<?php echo base_url(); ?>/index.php/master/hapus_master',
					//data: ({user:cuser,del:'1'}),
					data: ({tabel:'muser',cid:'kode',cnid:kd}),
					dataType:"json"
				});
			});                                            
			alert("Data Berhasil Dihapus");
		}
		
		$('#dg').datagrid('reload');        

	} 
    
       
  
   </script>



<div id="content1"> 

    <div align="center">
    <p>     
    <table style="width:400px;" border="0">
        <tr>
		<td><h3 align="center"><b> DATA USER</b></h3></td>
        <td width="10%">
        <a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:tambah()">Tambah</a></td>               
        <td width="10%"><a class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:hapus();">Hapus</a></td>
        <td width="5%"><a class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="javascript:cari();">Cari</a></td>
        <td><input type="text" value="" id="txtcari" style="width:300px;"/></td>
        </tr>
        <tr>
        <td colspan="5">
        <table id="dg" align="center" title="LISTING DATA USER" style="width:900px;height:320px;" >  
        </table>
        </td>
        </tr>
    </table>    
        
 
    </p> 
    </div>   
</div>

<div id="dialog-modal" title="" style="width:100%;height:100px" >
    <fieldset>
     <table align="center" style="width:100%;"  border="0">
            <tr>
                <td width="20%">ID</td>
                <td width="1%">:</td>
                <td><input type="text" id="kode" style="width:100px;" size="20" disabled="true"/></td>  
            </tr>   
            <tr>
                <td width="20%">USER</td>
                <td width="1%">:</td>
                <td><input type="text" id="user" style="width:200px;" size="20" maxlength="18"/></td>  
            </tr>            
            <tr>
                <td width="20%">PASSWORD</td>
                <td width="1%">:</td>
                <td><input type="text" id="pass" name="pass" style="width:200px;"/></td>  
            </tr>
            <tr>
                <td width="20%">SKPD</td>
                <td width="1%">:</td>
                <td><input type="text" id="skpd" style="width:220px;"/><input type="text" id="nmskpd" style="border:0;width: 220px;"/></td>  
            </tr>
            <tr>
                <td width="20%">UNIT SKPD</td>
                <td width="1%">:</td>
                <td><input type="text" id="unit_skpd" style="width:220px;"/><input type="text" id="nmunit_skpd" style="border:0;width: 220px;"/></td>  
            </tr>
            <tr>
                <td width="20%">OTORISASI</td>
                <td width="1%">:</td>
                <td><input type="text" id="oto" style="width:103px;"/></td>  
            </tr>
            <tr>
                <td width="20%">KETERANGAN</td>
                <td width="1%">:</td>
                <td><input type="text" id="ket" style="width:360px;" placeholder="*silahkan isi nama bagian/keterangan lain"/></td>  
            </tr>
            <tr>
            <td colspan="3">&nbsp;</td>
            </tr>            
            <tr>
                <td colspan="3" align="center"><a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:simpan();">Simpan</a>
		        <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Kembali</a>
                </td>                
            </tr>
        </table>  
            
    </fieldset> 
</div>

