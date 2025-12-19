<script type="text/javascript">
    
    var kdwil= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
                    
    
    function kosong(){
        $("#kdmilik").attr("value",'');
        $("#nmmilik").attr("value",''); 
    }
    
	function openWindow($cek){
		var cpilih		= $cek; 
        var ctgl 	= $('#tgl_cetak').datebox('getValue');
        var ctahun 	= $('#tahun').combobox('getValue'); 
		var url	  		= "<?php echo site_url(); ?>/laporan_kebijakan/rekap_kib_akumulasi";
        lc = '?ctahun='+ctahun+'&tgl='+ctgl+'&fa='+cpilih;
        window.open(url+lc,'_blank');
        window.focus();
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
        
		$('#tgl_cetak1').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });
		$('#tgl_cetak2').datebox({  
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
		 
		 $('#kib').combogrid({  
           panelWidth:500,  
           idField:'gol',  
           textField:'gol',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/master/ambil_mrekap_penyusutan',
           columns:[[  
               {field:'gol',title:'KODE',width:100},  
               {field:'nama',title:'GOLONGAN',width:400}    
           ]],  
           onSelect:function(rowIndex,rowData){
               jenis = rowData.nama;
               gol 	 = rowData.gol;
               $("#nmkib").attr("value",rowData.nama.toUpperCase()); 
			   $('#jenis').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_jenis_kib',queryParams:({kode:gol}) });
           }  
         });
        
		$('#jenis').combogrid({  
           panelWidth:500,  
           idField:'kode',  
           textField:'kode',  
           mode:'remote',
           //url:'<?php echo base_url(); ?>index.php/master/ambil_jenis_kib',queryParams:({kode:'02'}), 
           columns:[[  
               {field:'kode',title:'KODE',width:100},  
               {field:'jenis',title:'JENIS',width:300}, 
               {field:'umur',title:'UMUR(th)',width:100,align:'center'}    
           ]],  
           onSelect:function(rowIndex,rowData){
               jenis = rowData.jenis;
               $("#nmjenis").attr("value",rowData.jenis.toUpperCase()); 
			   
           }  
         });
        $('#tahun').combobox({           
        valueField:'nama',  
        textField:'nama',
        width:50,
        data:[{kode:'0',nama:'2012'},{kode:'1',nama:'2013'},{kode:'2',nama:'2014'},{kode:'3',nama:'2015'},{kode:'4',nama:'2016'},
        {kode:'5',nama:'2017'}]
    });
		 
    }); 
   </script>



<div id="content1"> 
    <h3 align="center"><b>CETAK REKAP PENYUSUTAN AKUMULASI ASET TETAP ALL SKPD</b></h3>
    <fieldset>
     <table align="center" style="width:100%;" border="0">
	 
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
            <tr>
                <td width="20%">TAHUN</td>
                <td width="1%">:</td>
                <td><input type="text" id="tahun" style="width: 150px;" /></td>  
            </tr>    
            <td colspan="3">&nbsp;</td>			
            <tr>
                <td colspan="3" align="center">
                <a class="easyui-linkbutton" iconCls="icon-pdf" plain="true" onclick="javascript:openWindow(1);">PDF</a>
                <a class="easyui-linkbutton" iconCls="icon-excel" plain="true" onclick="javascript:openWindow(2);">EXCEL</a>
			    <a href="<?php echo base_url();?>" class="easyui-linkbutton" iconCls="icon-undo" plain="true">Keluar</a>
				</td>                
            </tr>
        </table>  
            
    </fieldset>  
</div>



