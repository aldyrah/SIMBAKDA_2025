    <script type="text/javascript">
    
                    
    
    function ajaxFileUpload(lc)
	{
	    
        var lcno = 'gambar'+lc;
        var lcupload = 'fileToUpload'+lc;
		var cfile = document.getElementById(lcupload).files[0];
		document.getElementById(lcno).value = cfile.name;
        
        
        cokot(cfile.name,lc);
		/*$("#loading")
		.ajaxStart(function(){
			$(this).show();
		})
		.ajaxComplete(function(){
			$(this).hide();
		});*/

		$.ajaxFileUpload
		(
			{
				url:'<?php echo base_url();?>index.php/transaksi/uploadfile',
				secureuri:false,
				fileElementId:lcupload,
				dataType: 'json',
				data:{name:'logan', id:'id'},
				success: function (data, status)
				{
					if(typeof(data.error) != 'undefined')
					{
						if(data.error != '')
						{
							alert(data.error);
						}else
						{
							alert(data.msg);
						}
					}
				},
				error: function (data, status, e)
				{
					alert(e);
				}
			}
		)
		
		return false;

	}
    
    function  cokot(foto,lc){
         document.getElementById("picture").src = "<?php echo base_url(); ?>data/"+foto;
    }
            
    function simpan(){
        var lc_client = document.getElementById('pemakai').value;
        var lcpimp = document.getElementById('pimpinan').value;
        var lcnip_pimp = document.getElementById('nip_pimp').value;
        var lcpkt_pimp = document.getElementById('pkt_pimp').value;
        var lckota = document.getElementById('kota').value;
        var file_gbr1 = document.getElementById('gambar1').value;
        var file_gbr2 = document.getElementById('gambar2').value;
        
       //alert(lc_client+'.'+lcpimp+'.'+lcnip_pimp+'.'+lcpkt_pimp+'.'+lckota+'.'+file_gbr1);
        
        $(document).ready(function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>index.php/master/simpan_konfigurasi',
                data: ({client:lc_client,pimpinan:lcpimp,nip_pimp:lcnip_pimp,pkt_pimp:lcpkt_pimp,kota:lckota,logo:file_gbr1,logo2:file_gbr2}),
                dataType:"json"
            });
        });  
        //alert('berhasil');
    }
    
  
  
   </script>



<div id="content1"> 
    <h3 align="center"><b>SETTING KONFIGURASI SISTEM DAN LAPORAN</b></h3>
    <fieldset>
     <table align="center" style="width:100%;" border="0">
            
            <tr>
                <td colspan="3">
                <div id="div_skpd">
                        <table style="width:100%;" border="0">
                            <tr>
                                <td width="20%">Pemakai</td>
                                <td width="1%">:</td>
                                <td width="59%"><input id="pemakai" name="pemakai" value="<?php echo $nm_client;?>" style="width: 400px;" />
                                </td>
                                <td rowspan="6" width="20%" align="center" valign="center"><img style="width: 100px; height:100px;" id="picture" alt="" src="<?php echo base_url();?>data/<?php echo $logo?>"  /></td>
                            </tr>
                            <tr>
                                <td width="20%">Pimpinan</td>
                                <td width="1%">:</td>
                                <td width="59%"><input id="pimpinan" name="pimpinan"  value="<?php echo $kepala;?>" style="width: 400px;" />
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">Nip Pimpinan</td>
                                <td width="1%">:</td>
                                <td width="59%"><input id="nip_pimp" name="nip_pimp" value="<?php echo $nip_kepala;?>" style="width: 400px;" />
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">Pangkat Pimpinan</td>
                                <td width="1%">:</td>
                                <td width="59%"><input id="pkt_pimp" name="pkt_pimp" value="<?php echo $pkt_kepala;?>" style="width: 400px;" />
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">Kota</td>
                                <td width="1%">:</td>
                                <td width="59%"><input id="kota" name="kota" value="<?php echo $kota;?>" style="width: 400px;" />
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">Logo Laporan</td>
                                <td width="1%">:</td>
                                <td width="59%">
                                <input type="text" id="gambar1" name="gambar1" value="<?php echo $logo?>"  style="width:200px;" disabled="disabled" />
                                <img id="loading" src="<?php echo base_url();?>public/images/loading.gif" style="display:none;">
                            	<input type="file" id="fileToUpload1" name="fileToUpload"/>
                                <input type="button" id="btnupload" value="Upload" onclick="return ajaxFileUpload('1');"  />
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">Logo Smart</td>
                                <td width="1%">:</td>
                                <td width="59%">
                                <input type="text" id="gambar2" name="gambar2" value="<?php echo $logo?>"  style="width:200px;" disabled="disabled" />
                                <img id="loading" src="<?php echo base_url();?>public/images/loading.gif" style="display:none;">
                            	<input type="file" id="fileToUpload1" name="fileToUpload"/>
                                <input type="button" id="btnupload" value="Upload" onclick="return ajaxFileUpload('2');"  />
                                </td>
                            </tr>
                        </table>
                </div>
                
                </td>
            </tr>
            
            <td colspan="3">&nbsp;</td>
            </tr>            
            <tr>
                <td colspan="3" align="center">
                <a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:simpan()">Simpan</a>
		        <a href="<?php echo base_url();?>" class="easyui-linkbutton" iconCls="icon-undo" plain="true">Keluar</a>
                </td>                
            </tr>
        </table>  
            
    </fieldset>  
</div>



