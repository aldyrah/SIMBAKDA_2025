    <script type="text/javascript">
    
  
    
    $(function(){
               
        $('#menu').combogrid({  
           panelWidth:300,  
           idField:'judul',  
           textField:'judul',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/master/ambil_lap',
           loadMsg:"Tunggu Sebentar....!!",  
           columns:[[  
               {field:'judul',title:'Laporan',width:300}    
           ]],
           onSelect:function(rowIndex,rowData)
				{
				    var $lcpro = rowData.link;
                 //alert($lcpro);
                    location.href = '<?php echo base_url(); ?>'+$lcpro ;      
  		            
				}
                                            
           
         });
                 
    }); 
  
  
   </script>



<div id="content1"> 
    <h3 align="center"><b>MENU LAPORANA<br>
    SIMBAKDA</b></h3>
    <fieldset>
     <table align="center" style="width:100%;" border="0">
            
            <tr>
                <td colspan="3">
                <div id="div_skpd">
                        <table style="width:65%;" border="0">
                    
                            <td width="20%"></td>
                            <td></td>
                             <td width="20%"><input id="menu" name="menu" style="width: 250px;" />
                            </td>
                        </table>
                </div>
            </tr>
			
            
        </table>  
            
    </fieldset>  
</div>



