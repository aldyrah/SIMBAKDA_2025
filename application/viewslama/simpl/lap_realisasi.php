    <script type="text/javascript">
    
    var kdwil= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
                    

    function kosong(){
		var skpd  = '<?php echo ($this->session->userdata('skpd')); ?>';
        $("#kdmilik").attr("value",skpd);
        //$("#nmmilik").attr("value",''); 
    }
    
    function openWindow( url ){
        var cskpd = $('#kdubidskpd').combogrid('getValue');
        var cnmskpd = document.getElementById('nmskpd').value;
        var ctahu = document.getElementById('nip_tahu').value;
        var cbend = document.getElementById('nip_bend').value;
        var ctgl = $('#tgl_cetak').datebox('getValue');
        if(cskpd==''){
            alert('Belum Pilih SKPD');
        }else if(ctgl==''){
            alert('Belum pilih Tanggal Cetak')
        }else{
        lc = '?kd_skpd='+cskpd+'&nm_skpd='+cnmskpd+'&tahu='+ctahu+'&bend='+cbend+'&tgl='+ctgl;
        window.open(url+lc,'_blank');
        window.focus();
        }
    } 
    
    function keluar(){
    }
    
    $(function(){
        $('#kdubidskpd').combogrid({  
           panelWidth:500,  
           idField:'kd_skpd',  
           textField:'kd_skpd',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/master/ambil_ubidskpd2',  
           columns:[[  
               {field:'kd_skpd',title:'KODE UNIT BIDANG',width:100},  
               {field:'nm_skpd',title:'NAMA UNIT BIDANG',width:400}    
           ]],  
           onSelect:function(rowIndex,rowData){
               lcskpd = rowData.kd_skpd;
               $("#nmskpd").attr("value",rowData.nm_skpd.toUpperCase());
               $('#tahu').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_pa',queryParams:({kduskpd:lcskpd}) });
               $('#bend').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_pb',queryParams:({kduskpd:lcskpd}) });
                                
           }  
         });
         
         $('#tgl_cetak').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });
        
        $('#tahu').combogrid({  
           panelWidth:300,  
           idField:'nama',  
           textField:'nama',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/master/ambil_pa',
           queryParams:({kduskpd:''}),
           loadMsg:"Tunggu Sebentar....!!",  
           columns:[[  
               {field:'nama',title:'Nama Pengguna Anggaran',width:300}    
           ]],  
           onSelect:function(rowIndex,rowData){
               lcnip = rowData.nip;
               $("#nip_tahu").attr("value",lcnip);                              
           } 
         });
         
         $('#bend').combogrid({  
           panelWidth:300,  
           idField:'nama',  
           textField:'nama',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/master/ambil_bb',
           queryParams:({kduskpd:''}),
           loadMsg:"Tunggu Sebentar....!!",  
           columns:[[  
               {field:'nama',title:'Nama Bendahara',width:300}    
           ]],  
           onSelect:function(rowIndex,rowData){
               lcnip_bend = rowData.nip;
               $("#nip_bend").attr("value",lcnip_bend);                              
           } 
         });
        
    }); 
  
  
   </script>



<div id="content1"> 
    <h3 align="center"><b>CETAK REALISASI BELANJA MODAL</b></h3>
    <fieldset>
     <table align="center" style="width:100%;" border="0">
            <tr>
                <td>SKPD</td>
                <td>:</td>
                <td><input id="kdubidskpd" name="kdubidskpd" style="width: 100px;" />
                <input type="text" id="nmskpd" readonly="true" style="width: 500px;border:0" />
                </td>
            </tr>
            <tr>
                <td width="20%">MENGETAHUI</td>
                <td width="1%">:</td>
                <td><input id="tahu" name="tahu" style="width: 300px;" />
                <input type="hidden" id="nip_tahu"/> 
                </td> 
            </tr>
            <tr>
                <td width="20%">BENDAHARA</td>
                <td width="1%">:</td>
                <td><input id="bend" name="bend" style="width: 300px;" />
                <input type="hidden" id="nip_bend"/> 
                </td> 
            </tr>
            <tr>
                <td width="20%">TANGGAL CETAK</td>
                <td width="1%">:</td>
                <td><input type="text" id="tgl_cetak" style="width: 140px;" /></td>  
            </tr>
            
            <td colspan="3">&nbsp;</td>
            </tr>            
            <tr>
                <td colspan="3" align="center">
                <a  href="<?php echo base_url(); ?>index.php/lap_simpl/lap_realisasi" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:openWindow(this.href);return false">Cetak</a>
		        <a href="<?php echo base_url();?>" class="easyui-linkbutton" iconCls="icon-undo" plain="true">Keluar</a>
                </td>                
            </tr>
        </table>  
            
    </fieldset>  
</div>



