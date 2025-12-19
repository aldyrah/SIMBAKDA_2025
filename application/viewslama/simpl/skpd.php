<script type="text/javascript" src="<?php echo base_url(); ?>easyui/autoCurrency.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>easyui/currencyFields.js"></script>
<script type="text/javascript">
    
    var kode= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
	
     $(document).ready(function() {
          $("#tabs").tabs();                     
     });    
     
    $(function(){  
	$('#tgl_sk').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            }
         });
    $('#kdskpd').combogrid({  
           panelWidth:500,  
           idField:'kd_skpd',  
           textField:'kd_skpd',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/simpl/load_skpd',  
           columns:[[  
               {field:'kd_skpd',title:'KODE SKPD',width:100},  
               {field:'nm_skpd',title:'NAMA SKPD',width:400}    
           ]],  
           onSelect:function(rowIndex,rowData){
               lcskpd = rowData.kd_skpd;
               aa = rowData.nama_ppb;
               $("#nama").attr("value",rowData.nm_skpd.toUpperCase());
			   $("#nama_skpd").attr("value",rowData.nama_skpd.toUpperCase());
			   $("#jabatan_skpd").attr("value",rowData.jabatan_skpd.toUpperCase());
			   $("#pangkat_skpd").attr("value",rowData.pangkat_skpd.toUpperCase());
			   $("#nip_skpd").attr("value",rowData.nip_skpd); 
			   $("#nama_bendout").attr("value",rowData.nama_bendout.toUpperCase());
			   $("#jabatan_bendout").attr("value",rowData.jabatan_bendout.toUpperCase());
			   $("#pangkat_bendout").attr("value",rowData.pangkat_bendout.toUpperCase());
			   $("#nip_bendout").attr("value",rowData.nip_bendout);
			   $("#nama_ppb").attr("value",rowData.nama_ppb);
			   $("#jabatan_ppb").attr("value",rowData.jabatan_ppb);
			   $("#pangkat_ppb").attr("value",rowData.pangkat_ppb);
			   $("#nip_ppb").attr("value",rowData.nip_ppb);
			   $("#no_sk").attr("value",rowData.no_sk);
				//-- $('#tanggal').datebox('setValue',tgl);
			   $('#tgl_sk').datebox('setValue',rowData.tgl_sk);
			   $("#bagian").combogrid("setValue",rowData.bagian);
			   $("#alamat").attr("value",rowData.alamat);
			   $("#bank").combogrid("setValue",rowData.bank);
			   $("#rekening").attr("value",rowData.rekening);
			   $("#npwp").attr("value",rowData.npwp);
           }  
         });  
		 
		 $('#bagian').combogrid({  
           panelWidth:500,  
           idField:'kode',  
           textField:'kode',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/simpl/load_bagian',  
           columns:[[  
               {field:'kode',title:'KODE BAGIAN',width:100},  
               {field:'nama',title:'NAMA BAGIAN',width:400}    
           ]],  
           onSelect:function(rowIndex,rowData){
               lcskpd = rowData.kode;
               $("#nama_bagian").attr("value",rowData.nama.toUpperCase());
           }  
         }); 
		 
	 $('#bank').combogrid({  
           panelWidth:500,  
           idField:'kode',  
           textField:'kode',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/simpl/load_bank',  
           columns:[[  
               {field:'kode',title:'KODE BAGIAN',width:100},  
               {field:'nama',title:'NAMA BAGIAN',width:400}    
           ]],  
           onSelect:function(rowIndex,rowData){
               lcskpd = rowData.kode;
               $("#nama_bank").attr("value",rowData.nama.toUpperCase());
           }  
         }); 
    });
	
	
	
	function simpan(){
        var  kode 				= $('#kdskpd').combogrid('getValue');
        var  nama 				= document.getElementById('nama').value;
		var  nama_skpd 			= document.getElementById('nama_skpd').value;
        var  jabatan_skpd 		= document.getElementById('jabatan_skpd').value;
        var  pangkat_skpd 		= document.getElementById('pangkat_skpd').value;
		var  nip_skpd 			= document.getElementById('nip_skpd').value;
        var  nama_bendout 		= document.getElementById('nama_bendout').value;
		var  jabatan_bendout 	= document.getElementById('jabatan_bendout').value;
		var  pangkat_bendout 	= document.getElementById('pangkat_bendout').value;
        var  nip_bendout 		= document.getElementById('nip_bendout').value;
		var  nama_ppb 			= document.getElementById('nama_ppb').value;
		var  jabatan_ppb 		= document.getElementById('jabatan_ppb').value;
		var  pangkat_ppb 		= document.getElementById('pangkat_ppb').value;
        var  nip_ppb 			= document.getElementById('nip_ppb').value;
		var  no_sk		 		= document.getElementById('no_sk').value;
        var  tgl_sk 			= $('#tgl_sk').datebox('getValue');
		var  bagian 			= $('#bagian').combogrid('getValue');
		var  alamat 			= document.getElementById('alamat').value;
		var  bank 				= $('#bank').combogrid('getValue');
		var  rekening 			= document.getElementById('rekening').value;
        var  npwp 				= document.getElementById('npwp').value; 
		
                if(lcstatus=='tambah'){
                    
                    lcinsert = "(kode,nama,nama_skpd,jabatan_skpd,pangkat_skpd,nip_skpd,nama_bendout,jabatan_bendout,pangkat_bendout,nip_bendout,nama_ppb,jabatan_ppb,pangkat_ppb,nip_ppb,no_sk,tgl_sk,bagian,alamat,bank,rekening,npwp)";
                    lcvalues = "('"+kode+"','"+nama+"','"+nama_skpd+"','"+jabatan_skpd+"','"+pangkat_skpd+"','"+nip_skpd+"','"+nama_bendout+"','"+jabatan_bendout+"','"+pangkat_bendout+"','"+nip_bendout+"','"+nama_ppb+"','"+jabatan_ppb+"','"+pangkat_ppb+"','"+nip_ppb+"','"+no_sk+"','"+tgl_sk+"','"+bagian+"','"+alamat+"','"+bank+"','"+rekening+"','"+npwp+"')";
                    
                    $(document).ready(function(){
                        $.ajax({
                            type: "POST",
                            url: '<?php echo base_url(); ?>index.php/simpl/simpan_master',
                            data: ({tabel:'mhorganisasi',kolom:lcinsert,nilai:lcvalues,cid:'kode',lcid:kode}),
                            dataType:"json"
                        });
                    });
					}else { 
                    lcquery = "UPDATE mhorganisasi SET nama='"+nama+"',nama_skpd='"+nama_skpd+"',jabatan_skpd='"+jabatan_skpd+"',pangkat_skpd='"+pangkat_skpd+"',nip_skpd='"+nip_skpd+"',nama_bendout='"+nama_bendout+"',jabatan_bendout='"+jabatan_bendout+"',pangkat_bendout='"+pangkat_bendout+"',nip_bendout='"+nip_bendout+"',nama_ppb='"+nama_ppb+"',jabatan_ppb='"+jabatan_ppb+"',pangkat_ppb='"+pangkat_ppb+"',nip_ppb='"+nip_ppb+"',no_sk='"+no_sk+"',tgl_sk='"+tgl_sk+"',bagian='"+bagian+"',alamat='"+alamat+"',bank='"+bank+"',rekening='"+rekening+"',npwp='"+npwp+"' where kode='"+kode+"'";
                    
                    $(document).ready(function(){
                    $.ajax({
                        type: "POST",
                        url: '<?php echo base_url(); ?>index.php/simpl/update_master',
                        data: ({st_query:lcquery}),
                        dataType:"json"
                    });
                    });
                }
               
                
                alert("Data Berhasil disimpan");
                $("#dialog-modal").dialog('close');
    } 
    
   </script>

<div id="tabs" > 
    <p align="center"><b>INPUTAN SKPD</b></p> 
    <fieldset>
     <table align="center" style="width:100%;" border="0">
			<tr>
                <td height="30px">SKPD</td>
                <td>:</td>
                <td><input type="text" id="kdskpd" name="kdskpd" style="width: 200px;" onclick="javascript:select();" /></td>
            </tr>
			<tr>
                <td width="20%">NAMA SKPD</td>
                <td width="1%">:</td>
                <td><input type="text" id="nama" name="nama" style="width:500px;"/></td>  
            </tr> 
			<tr><td bgcolor="#fcbe02" align="center" colspan="3"><b>KEPALA SKPD</b></td></tr>			
            <tr>
                <td width="20%">NAMA</td>
                <td width="1%">:</td>
                <td><input type="text" id="nama_skpd" style="width:500px;"/></td>  
            </tr>
			<tr>
                <td width="20%">JABATAN</td>
                <td width="1%">:</td>
                <td><input type="text" id="jabatan_skpd" style="width:500px;"/></td>  
            </tr>
			  <tr>
                <td width="20%">PANGKAT</td>
                <td width="1%">:</td>
                <td><input type="text" id="pangkat_skpd" style="width:500px;"/></td>  
            </tr>
			<tr>
                <td width="20%">NIP</td>
                <td width="1%">:</td>
                <td><input type="text" id="nip_skpd" style="width:500px;"/></td>  
            </tr>
			<tr><td bgcolor="#fcbe02" align="center" colspan="3"><b>BENDAHARA PENGELUARAN</b></td></tr>			
            <tr>
                <td width="20%">NAMA</td>
                <td width="1%">:</td>
                <td><input type="text" id="nama_bendout" style="width:500px;"/></td>  
            </tr>
			<tr>
                <td width="20%">JABATAN</td>
                <td width="1%">:</td>
                <td><input type="text" id="jabatan_bendout" style="width:500px;"/></td>  
            </tr>
			  <tr>
                <td width="20%">PANGKAT</td>
                <td width="1%">:</td>
                <td><input type="text" id="pangkat_bendout" style="width:500px;"/></td>  
            </tr>
			<tr>
                <td width="20%">NIP</td>
                <td width="1%">:</td>
                <td><input type="text" id="nip_bendout" style="width:500px;"/></td>  
            </tr>
			<tr><td bgcolor="#fcbe02" align="center" colspan="3"><b>PEJABAT PENGADAAN BARANG DAN JASA</b></td></tr>			
            <tr>
                <td width="20%">NAMA</td>
                <td width="1%">:</td>
                <td><input type="text" id="nama_ppb" style="width:500px;"/></td>  
            </tr>
			<tr>
                <td width="20%">JABATAN</td>
                <td width="1%">:</td>
                <td><input type="text" id="jabatan_ppb" style="width:500px;"/></td>  
            </tr>
			<tr>
                <td width="20%">PANGKAT</td>
                <td width="1%">:</td>
                <td><input type="text" id="pangkat_ppb" style="width:500px;"/></td>  
            </tr>
			<tr>
                <td width="20%">NIP</td>
                <td width="1%">:</td>
                <td><input type="text" id="nip_ppb" style="width:500px;"/></td>  
            </tr>
			<tr>
                <td width="20%">No.SK</td>
                <td width="1%">:</td>
                <td><input type="text" id="no_sk" style="width:500px;"/></td>  
            </tr>
			<tr>
                <td width="20%">Tgl.SK</td>
                <td width="1%">:</td>
                <td><input type="text" id="tgl_sk" style="width:100px;"/></td>  
            </tr>
			<tr><td bgcolor="#fcbe02" align="center" colspan="3"><b>DATA SKPD</b></td></tr>			
            <tr>
                <td width="20%">KODE BAGIAN</td>
                <td width="1%">:</td>
                <td><input type="text" id="bagian" name="bagian" style="width:190px;"/> <input type="text" id="nama_bagian" name="nama_bagian" style="width:300px;"/></td>
            </tr>
			<tr>
                <td width="20%">ALAMAT</td>
                <td width="1%">:</td>
                <td><textarea type="text" id="alamat" style="width:500px; height:30px" ></textarea></td>  
            </tr>		
            <tr>
                <td width="20%">NAMA BANK</td>
                <td width="1%">:</td>
                <td><input type="text" id="bank" name="bank" style="width:190px;"/> <input type="text" id="nama_bank" name="nama_bank" style="width:300px;"/></td>
            </tr>
			<tr>
                <td width="20%">NO.REKENING</td>
                <td width="1%">:</td>
                <td><input type="text" id="rekening" style="width:500px;"/></td>  
            </tr>
			<tr>
                <td width="20%">No.NPWP</td>
                <td width="1%">:</td>
                <td><input type="text" id="npwp" style="width:500px;"/></td>  
            </tr>
            <tr>
            <td colspan="3">&nbsp;</td>
            </tr>            
            <tr>
                <td colspan="3" align="center"><a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:simpan();">Simpan</a>
		        </td>                
            </tr>
        </table>  
    </fieldset>         
</div>

