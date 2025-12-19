     
<style type="text/css"> 

input[type=submit] {
    background: linear-gradient(to bottom, #0088CC, #0044CC);
    border: 1px solid #0088CC;
    color: #FFF;
    margin: 4px 10px;
    padding: 5px;
    width: 100px;
}

input[type=submit]:hover {
    cursor: pointer;
}

input[type=submit]:active {
    background: #0044CC;
}

input[type=file] {
    background: linear-gradient(to bottom, #0088CC, #0044CC);
    border: 1px solid #0088CC;
    color: #FFF;
    margin: 4px 10px;
    padding: 3px;
    width: 200px;
}

input[type=file]:hover {
    cursor: pointer;
}

input[type=submit]:active {
    background: #0044CC;
}

</style>
    
<script type="text/javascript">
 $(function(){
    $("#retribusi").show();
	 $('#kib').combogrid({  
            panelWidth:400,  
            width:200,
            idField:'golongan',  
            textField:'nm_golongan',  
            mode:'remote',                                  
            url:'<?php echo base_url(); ?>index.php/master/ambil_gol',  
            columns:[[  
               {field:'golongan',title:'Kode Golongan',width:100},  
               {field:'nm_golongan',title:'Nama Golongan',width:300}    
            ]],  
            onSelect:function(rowIndex,rowData){ 
              nm_golongan = rowData.nm_golongan;  
               $("#nm_golongan").attr("value",rowData.nm_golongan.toUpperCase());
            } 
        });
    });
</script>
<div id="content1"> 
    <h3 align="center"><b>TRANSFER DATA KIB EXCEL</b></h3>
    <fieldset>                                   
<div id="retribusi" align="center" >
 <br/><br/> 
        <table  border="0" style="height:40px; width:300px;" >
            <tr>
                <td colspan="3" align="center" style="font-size: 12px; color:red;"><strong>Transfer Data KIB</strong></td>
            </tr>
            <tr>
                <td colspan="3">
                        <table style="width:100%;" border="0">
                            <td width="50%">PILIH KIB</td>
                            <td width="1%">:</td>
                            <td width="20%"><input id="kib" name="kib" style="width: 30px;" />
                            <input type="text" id="nm_golongan" readonly="true" style="width: 40px;border:0" />
                            </td>
                        </table>
				</td>
            </tr> 
            <tr>
                <td >
                    <?php echo form_open_multipart('master/import_data_kib');?>
                    <input type="file" id="file_upload" name="userfile" size="10" /> 
                </td>
                <td>   
                    <input type="submit" value="Upload" id="btnsubmit" />
                    <?php echo form_close();?>
                </td>
            </tr>
        </table>
</div>
 <br/><br/> 
 <br/><br/>
 </fieldset>  
</div>

