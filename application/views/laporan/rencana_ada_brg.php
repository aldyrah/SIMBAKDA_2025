   <script type="text/javascript">

      
    var kdwil= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
                    

    function kosong(){
        alert('dadadas');
		var skpd  = '<?php echo ($this->session->userdata('skpd')); ?>';
        //$("#kdmilik").attr("value",skpd);
        //$("#nmmilik").attr("value",''); 
    }
    
    function openWindow( url ){
        var cskpd 		= $('#kdubidskpd').combogrid('getValue');
        var ckd_lokasi 	= document.getElementById('kd_lokasi').value;
        //var cnmskpd 	= document.getElementById('nmskpd').value;
        var ctahu 		= document.getElementById('nip_tahu').value;
        var cbend 		= document.getElementById('nip_bend').value;
        var ctahun 		= $('#tahun').combobox('getValue'); 
        var ctgl 		= $('#tgl_cetak').datebox('getValue');
        if(cskpd==''){
            alert('Belum Pilih SKPD');
        }else if(ctgl==''){
            alert('Belum pilih Tanggal Cetak')
        }else if(ctahun==''){
            alert('Belum pilih Tahun Perencanaan')
        }else{
        lc = '?kd_skpd='+cskpd+'&ckd_lokasi='+ckd_lokasi+'&ctahun='+ctahun+'&tahu='+ctahu+'&bend='+cbend+'&tgl='+ctgl;
		//alert(lc);
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
           url:'<?php echo base_url(); ?>index.php/master/ambil_skpd_dh',  
           columns:[[  
               {field:'kd_skpd',title:'KODE SKPD',width:100},  
               {field:'nm_skpd',title:'NAMA SKPD',width:400}    
           ]],  
           onSelect:function(rowIndex,rowData){
               lcskpd = rowData.kd_skpd;
               kd_lokasi = rowData.kd_lokasi;
               $("#kd_lokasi").attr("value",rowData.kd_lokasi);
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
           //url:'<?php echo base_url(); ?>index.php/master/ambil_pa',
           //queryParams:({kduskpd:''}),
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
           //url:'<?php echo base_url(); ?>index.php/master/ambil_bb',
           //queryParams:({kduskpd:''}),
           loadMsg:"Tunggu Sebentar....!!",  
           columns:[[  
               {field:'nama',title:'Nama Pengurus Barang',width:300}    
           ]],  
           onSelect:function(rowIndex,rowData){
               lcnip_bend = rowData.nip;
               $("#nip_bend").attr("value",lcnip_bend);                              
           } 
         });
        $('#tahun').combobox({           
        valueField:'nama',  
        textField:'nama',
        width:50,
        data:[{kode:'0',nama:'2015'},{kode:'1',nama:'2016'},{kode:'2',nama:'2017'},{kode:'3',nama:'2018'},{kode:'4',nama:'2019'},
        {kode:'5',nama:'2020'}]
    });
    }); 
  
  
   </script>


<div id="content1" > 
    <h3 align="center"><b>CETAK DAFTAR KEBUTUHAN BARANG UNIT</b></h3>
    <fieldset>
     <table align="center" style="width:100%;" border="0">
            <tr>
                <td>SKPD</td>
                <td>:</td>
                <td><input id="kdubidskpd" name="kdubidskpd" style="width: 150px;"/>
                <input type="text" id="nmskpd" readonly="true" style="width: 500px;border:0" />
				<input type="text" id="kd_lokasi" hidden="true" style="width: 500px;border:0" />
                </td>
            </tr>
            <tr>
                <td width="20%">MENGETAHUI</td>
                <td width="1%">:</td>
                <td><input id="tahu" name="tahu" style="width: 300px;" />
                <input type="hidden" id="nip_tahu"/> 
                </td> 
            </tr>
            <tr hidden="true">
                <td width="20%">BENDAHARA</td>
                <td width="1%">:</td>
                <td><input id="bend" name="bend" style="width: 300px;" />
                <input type="hidden" id="nip_bend"/> 
                </td> 
            </tr>
            <tr>
                <td width="20%">TAHUN</td>
                <td width="1%">:</td>
                <td><input type="text" id="tahun" style="width: 150px;" /></td>  
            </tr>
            <tr>
                <td width="20%">TANGGAL CETAK</td>
                <td width="1%">:</td>
                <td><input type="text" id="tgl_cetak" style="width: 150px;" /></td>  
            </tr>
            
            <td colspan="3">&nbsp;</td>
            </tr>            
            <tr>
                <td colspan="3" align="center">
                <a  href="<?php echo base_url(); ?>index.php/laporan/lap_rkbu/1" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:openWindow(this.href);return false">Cetak</a>
                <a  href="<?php echo base_url(); ?>index.php/laporan/lap_rkbu/2" class="easyui-linkbutton" iconCls="icon-excel" plain="true" onclick="javascript:openWindow(this.href);return false">Cetak</a>
		        <a href="<?php echo base_url();?>" class="easyui-linkbutton" iconCls="icon-undo" plain="true">Keluar</a>
                </td>                
            </tr>
        </table>  
            
    </fieldset>  
</div>


