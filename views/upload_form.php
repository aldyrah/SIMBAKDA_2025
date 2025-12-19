<html>
<head>
<title>Upload Form</title>

<script type="text/javascript">
    function ajaxFileUpload()
	{
	    
		var cfile = document.getElementById('fileToUpload').files[0];
		$("#filename1").attr("value",cfile.name);
		
		$("#loading")
		.ajaxStart(function(){
			$(this).show();
		})
		.ajaxComplete(function(){
			$(this).hide();
		});

		$.ajaxFileUpload
		(
			{
				url:'<?php echo base_url();?>index.php/transaksi/uploadfile',
				secureuri:false,
				fileElementId:'fileToUpload',
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
        
</script>

</head>
<body>


<div id="content1"> 
<h3 align="center"><u><b><a>UPLOAD</a></b></u></h3>
    <div align="center">
    <p>     
    <table style="width:600px;" border="1">
        <tr>
           <td><input type="text" id="filename1" name="filename1" style="width:200px;" disabled="disabled" />
                    <img id="loading" src="<?php echo base_url();?>public/images/loading.gif" style="display:none;">
                	<input type="file" id="fileToUpload" name="fileToUpload"/>
                    <input type="button" id="btnupload" value="Upload" onclick="return ajaxFileUpload();"  />
           </td>
            <!--
            <?php echo form_open_multipart('transaksi/do_upload');?>
            
            <input type="file" id="userfile" name="userfile" size="20" />
            
            <br /><br />
            <a class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="javascript:upload_data();">upload</a>
            
            <input type="submit" value="upload" />
            
            </form>--!>
      </tr>
    </table>    
 
    </p> 
    </div>   
</div>
</body>
</html>