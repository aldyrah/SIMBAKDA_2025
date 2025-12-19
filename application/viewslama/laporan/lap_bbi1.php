    <script type="text/javascript">
    
    var kdwil= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
    var ctk = '';
                    
    
    function kosong(){
        $("#kdmilik").attr("value",'');
        $("#nmmilik").attr("value",''); 
    }
    
    function opt(val){        
        ctk = val; 
        if (ctk=='1'){
            $("#div_skpd").show();
            $("#div_bidang").hide();
        } else if (ctk=='2'){
            $("#div_skpd").hide();
            $("#div_bidang").show();
            } else if (ctk=='3'){
            $("#div_skpd").hide();
            $("#div_bidang").hide();
            } else {
            exit();
        }                 
    }   
    
            
    function openWindow( url ){
        switch(ctk)
            {
            case '1':
                var cskpd = $('#kdskpd').combogrid('getValue');
                var cnmskpd = document.getElementById('nmskpd').value;
                var cbidang = '';
                var cnmbid = '';
                var ctahu = document.getElementById('nip_tahu').value;
                var cbend = document.getElementById('nip_bend').value;
                var ctgl = $('#tgl_cetak').datebox('getValue');
                lc = '?kd_skpd='+cskpd+'&kd_bid='+cbidang+'&nm_skpd='+cnmskpd+'&nm_bid='+cnmbid+'&tahu='+ctahu+'&bend='+cbend+'&tgl='+ctgl+'&cpilih=1';
                window.open(url+lc,'_blank');
                window.focus();
                break;
            case '2':
                var cskpd = '';
                var cnmskpd = '';
                var cbidang = $('#kdubidskpd').combogrid('getValue');
                var cnmbid = document.getElementById('nmbidskpd').value;
                var ctahu = document.getElementById('nip_tahu').value;
                var cbend = document.getElementById('nip_bend').value;
                var ctgl = $('#tgl_cetak').datebox('getValue');
                lc = '?kd_skpd='+cskpd+'&kd_bid='+cbidang+'&nm_skpd='+cnmskpd+'&nm_bid='+cnmbid+'&tahu='+ctahu+'&bend='+cbend+'&tgl='+ctgl+'&cpilih=2';
                window.open(url+lc,'_blank');
                window.focus();
                break;
            default:
                var cskpd = '';
                var cnmskpd = '';
                var cbidang = '';
                var cnmbid = '';
                var ctahu = document.getElementById('nip_tahu').value;
                var cbend = document.getElementById('nip_bend').value;
                var ctgl = $('#tgl_cetak').datebox('getValue');
                lc = '?kd_skpd='+cskpd+'&kd_bid='+cbidang+'&nm_skpd='+cnmskpd+'&nm_bid='+cnmbid+'&tahu='+ctahu+'&bend='+cbend+'&tgl='+ctgl+'&cpilih=3';
                window.open(url+lc,'_blank');
                window.focus();
            }

    } 
    
    $(function(){
        $("#div_skpd").hide();
        $("#div_bidang").hide();
   	});  
    
    $(function(){
        $('#kdubidskpd').combogrid({  
           panelWidth:500,  
           idField:'kd_uskpd',  
           textField:'kd_uskpd',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/master/ambil_ubidskpd',  
           columns:[[  
               {field:'kd_uskpd',title:'KODE UNIT BIDANG',width:100},  
               {field:'nm_uskpd',title:'NAMA UNIT BIDANG',width:400}    
           ]],  
           onSelect:function(rowIndex,rowData){
               lcskpd = rowData.kd_uskpd;
               
               $("#nmbidskpd").attr("value",rowData.nm_uskpd.toUpperCase());
               $('#tahu').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_pa',queryParams:({kduskpd:lcskpd}) });
               $('#bend').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_bb',queryParams:({kduskpd:lcskpd}) });
                                
           }  
         });
         
         $('#kdskpd').combogrid({  
           panelWidth:500,  
           idField:'kd_skpd',  
           textField:'kd_skpd',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/master/ambil_skpd',  
           columns:[[  
               {field:'kd_skpd',title:'KODE SKPD',width:100},  
               {field:'nm_skpd',title:'NAMA SKPD',width:400}    
           ]],  
           onSelect:function(rowIndex,rowData){
               lcskpd = rowData.kd_uskpd;
               
               $("#nmskpd").attr("value",rowData.nm_skpd.toUpperCase());
               $('#tahu').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_pa',queryParams:({kduskpd:''}) });
               $('#bend').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_bb',queryParams:({kduskpd:''}) });
                                
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
    <h3 align="center"><b>BUKU BARANG INVENTARIS<br>
    TAHUN ANGGARAN</b></h3>
    <fieldset>
     <table align="center" style="width:100%;" border="0">
            <tr>
                <td><input type="radio" name="cetak" value="1" onclick="opt(this.value)" />SKPD &ensp;</td>
                <td><input type="radio" name="cetak" value="2" id="status" onclick="opt(this.value)" />Per BIDANG &ensp;</td>
                <td><input type="radio" name="cetak" value="3" id="status1" onclick="opt(this.value)" checked="true" />Keseluruhan</td>
                
            </tr>
            <tr>
                <td colspan="3">
                <div id="div_skpd">
                        <table style="width:100%;" border="0">
                    
                            <td width="20%">SKPD</td>
                            <td width="1%">:</td>
                            <td width="79%"><input id="kdskpd" name="kdskpd" style="width: 100px;" />
                            <input type="text" id="nmskpd" readonly="true" style="width: 500px;border:0" />
                            </td>
                        </table>
                </div>
                <div id="div_bidang">
                        <table style="width:100%;" border="0">
                    
                            <td width="20%">BIDANG</td>
                            <td width="1%">:</td>
                            <td width="79%"><input id="kdubidskpd" name="kdubidskpd" style="width: 100px;" />
                            <input type="text" id="nmbidskpd" readonly="true" style="width: 500px;border:0" />
                            </td>
                        </table>
                </div>
                </td>
            </tr>
			<tr>
                <td colspan="3">
                <div id="div_bend">
                        <table style="width:100%;" border="0">
                            <td width="20%">KEPALA SKPD</td>
                            <td width="1%">:</td>
                            <td><input id="bend" name="bend" style="width: 300px;" />
                            <input type="hidden" id="nip_bend"/> 
                            </td> 
                        </table>
                </div>
                </td> 
            </tr>
            <tr>
                <td colspan="3">
                <div id="div_bend">
                        <table style="width:100%;" border="0">
                            <td width="20%">PENYIMPAN</td>
                            <td width="1%">:</td>
                            <td><input id="bend" name="bend" style="width: 300px;" />
                            <input type="hidden" id="nip_bend"/> 
                            </td> 
                        </table>
                </div>
                </td> 
            </tr>
            <tr>
                <td colspan="3">
                <div id="div_tgl">
                    <table style="width:100%;" border="0">
                        <td width="20%">TANGGAL CETAK</td>
                        <td width="1%">:</td>
                        <td><input type="text" id="tgl_cetak" style="width: 140px;" /></td>  
                    </table>
                </div>
                </td> 
                
            </tr>
            
            <td colspan="3">&nbsp;</td>
            </tr>            
            <tr>
                <td colspan="3" align="center">
                <a  href="<?php echo base_url(); ?>index.php/laporan/lap_bbi" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:openWindow(this.href);return false">Cetak</a>
		        <a href="<?php echo base_url();?>" class="easyui-linkbutton" iconCls="icon-undo" plain="true">Keluar</a>
                </td>                
            </tr>
        </table>  
            
    </fieldset>  
</div>



