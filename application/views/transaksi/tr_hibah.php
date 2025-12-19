<script type="text/javascript" src="<?php echo base_url(); ?>easyui/autoCurrency.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>easyui/currencyFields.js"></script>
  	
    <script type="text/javascript">
    
    var updt = 'f';
    var idx2 = '';
    var total2 = 0;
    
     $(document).ready(function() {
          $("#tabs").tabs();
          $("#dialog-modal").dialog({
            height: 470,
            width: 600,
            modal: true, 
            background:'#2da305',           
            autoOpen:false                
          });                       
     });    
     
    $(function(){         
         $('#dg').datagrid({
    		url: "<?php echo base_url(); ?>index.php/transaksi/ambil_trhapus",
            idField:"no_dokumen",            
            rownumbers:"true", 
            fitColumns:"true",
            singleSelect:"true",
            autoRowHeight:"false",
            loadMsg:"Tunggu Sebentar....!!",
            pagination:"true",
            nowrap:"true",                       
            columns:[[
        	    {field:'no_dokumen',title:'Nomor Dokumen',width:40},
                {field:'tgl_dokumen',title:'Tanggal',width:20},
                {field:'nm_uskpd',title:'Unit SKPD',width:100},
                {field:'tahun',title:'Tahun',width:20,align:"center"}
            ]],
            onSelect:function(rowIndex,rowData){ 
                nomor   = rowData.no_dokumen;
                tgl     = rowData.tgl_dokumen;
                kode    = rowData.kd_uskpd;
                nmkode  = rowData.nm_uskpd;
                tahun   = rowData.tahun;
                total   = rowData.total;
                get(nomor,tgl,kode,nmkode,tahun,total);
                load_detail();
            },
            onDblClickRow:function(rowIndex,rowData){         
                section2();                                  
            }
        });
        
        $('#trd').edatagrid({    		   
            rownumbers:"true",           
            toolbar:'#toolbar',
            loadMsg:"Tunggu Sebentar....!!",            
            nowrap:"true"
        });   
        
                
        $('#tanggal').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            }
         });
        
         $('#uskpd').combogrid({  
            panelWidth:700,  
            idField:'kd_uskpd',  
            textField:'kd_uskpd',  
            mode:'remote',                      
            url:'<?php echo base_url(); ?>index.php/master/ambil_ubidskpd',  
            columns:[[  
               {field:'kd_uskpd',title:'Kode Unit',width:100},  
               {field:'nm_uskpd',title:'Nama Unit',width:700}    
            ]],  
            onSelect:function(rowIndex,rowData){
               cuskpd = rowData.kd_uskpd;               
               $('#nmuskpd').attr('value',rowData.nm_uskpd);    
               
                                          
            } 
         });  
        
        $('#kib').combogrid({  
            panelWidth:400,  
            width:160,
            idField:'golongan',  
            textField:'nm_golongan',  
            mode:'remote',                                  
            url:'<?php echo base_url(); ?>index.php/master/ambil_gol',  
            columns:[[  
               {field:'golongan',title:'Kode Golongan',width:100},  
               {field:'nm_golongan',title:'Nama Golongan',width:300}    
            ]],  
            onSelect:function(rowIndex,rowData){ 
              cgol = rowData.golongan;                                
                load_kib(cgol);  
            } 
        }); 
         
    });
    
    function section1(){        
        $('#tabs1').click();   
        set_grid();                                                     
    }
    
    function section2(){            
        $('#tabs2').click();
        set_grid();                                                        
    }  
    
    function load_kib(cgol){
        var i = 0;
        var ngol = cgol;
        var cuskpd = $('#uskpd').combogrid('getValue');
         
        $('#trd').edatagrid({
            url: '<?php echo base_url(); ?>index.php/transaksi/ambil_kib',
            queryParams:({kdskpd:cuskpd,gol:ngol}),
            rownumbers:true, 
            fitColumns:false,
            singleSelect:false,
		    columns:[[
 		            {field:'no_dokumen',title:'Nomor Dokumen',width:100,hidden:true},
                    {field:'no_reg',title:'Registrasi ',width:140},
                    {field:'kd_brg',title:'Kode Barang',width:80},
                    {field:'nm_brg',title:'Nama Barang',width:270},
                    {field:'tgl_reg',title:'Tanggal',width:100},
                    {field:'kondisi',title:'Kondisi',width:100,align:"right",hidden:true},
                    {field:'tahun',title:'Tahun',width:100,align:"center"},
                    {field:'nilai',title:'Harga',width:180,align:"right"},   
                    {field:'no',title:'ck',width:30,checkbox:true}   
				]]	
			});
         
    }
   
  
 function load_save(){ 
    var lctgl  = $('#tanggal').datebox('getValue');
    var nohps  = document.getElementById('nomor').value;
    var skpd   = $('#uskpd').combogrid('getValue');
      
    if (nohps == ''){
         alert('No Hibah Tidak Boleh Kosong');
         exit();              
     } 
    if (lctgl == ''){
         alert('Tanggal Hibah Tidak Boleh Kosong');
         exit();              
     }
    
		var ids = [];  
        var idsa = [];
        var idsb = [];
        var idsc = [];
        var idsd = [];
        var idse = [];
        var idsf = [];
        var idsg = [];
        var idsh = [];
        
		var rows = $('#trd').edatagrid('getSelections');  
		for( i=0; i < rows.length; i++){ 
		    ids.push(rows[i].no);
            idsa.push(rows[i].no_dokumen);
            idsb.push(rows[i].no_reg);
            idsc.push(rows[i].kd_brg);
            idsd.push(rows[i].nm_brg);            
            idse.push(rows[i].tgl_reg);
            idsf.push(rows[i].kondisi);
            idsg.push(rows[i].tahun);
            idsh.push(rows[i].nilai);
		}
        
     cno      =(ids.join('||'));     
     cnodoc   =(idsa.join('||'));
	 cnoreg   =(idsb.join('||'));
     ckdbrg   =(idsc.join('||'));
     cnmbrg   =(idsd.join('||'));
     ctglreg  =(idse.join('||'));
     ckds     =(idsf.join('||'));
     cthn     =(idsg.join('||'));
     chrg     =(idsh.join('||'));
    
    if (cno == ''){
         alert('Barang Yang Akan diHibah Belum Dipilih');
         exit();              
     }
    var r = confirm("Hibah Kode Banrang: "+ckdbrg+" ");
     
    if(r==true){
         
         $.ajax({
            type: 'POST',
            data: ({uskpd:skpd,tgl:lctgl,no:cno,uskpd:skpd,no:cno,no_dokumen:cnodoc,no_reg:cnoreg,kd_brg:ckdbrg,nm_brg:cnmbrg,tgl_reg:ctglreg,kondisi:ckds,tahun:cthn,harga:chrg}),
            dataType:"json",
            url:"<?php echo base_url(); ?>index.php/transaksi/update_hibah",
			success:function(data){ 
			     alert('selesai');
			}
         });
    }
    cgol = $('#kib').combogrid('getValue');                              
    load_kib(cgol);   
    
}
    
</script>


<div id="tabs" >
		<p><h3 align="center">FORMULIR HIBAH</h3></p>
    <ul style="background-color:#2da305;">
        <li><a href="#tabs-1" style="width: 452px;" id="tabs1">Form Hibah Barang</a></li>
        <li><a href="#tabs-2" style="width: 452px;" id="tabs2">List View</a></li>        
    </ul>
    <div id="tabs-2">
        <div>
            <p align="right">
                <a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:kosong();section2();"></a>               
                <a class="easyui-linkbutton" iconCls="icon-search" plain="true" >Cari</a>
                <input type="text" value="" id="txtcari"/>              
                <table  id="dg" title="List Dokumen" style="width:940px;height:400px;" >  
                </table>                
            </p>
        </div>
    </div>
    <div id="tabs-1">  
        <br /><br />
        <table>
            <tr>
                <td height="30px">No. Hibah</td>
                <td>:</td>
                <td><input type="text" id="nomor" style="width: 200px;" onclick="javascript:select();" /></td>
                <td width="70px"></td>
                <td>Tanggal Hibah</td>
                <td>:</td>
                <td><input type="text" id="tanggal" style="width: 140px;" /></td>     
            </tr>
            <tr>
                <td height="30px">Unit Kerja</td>
                <td>:</td>
                <td><input id="uskpd" name="uskpd" style="width: 140px;" /></td>
                <td></td>
                <td>Nama Unit Kerja</td> 
                <td>:</td>
                <td><input type="text" id="nmuskpd" style="border:0;width: 400px;" readonly="true"/></td>                                
            </tr>
            <tr>
                <td height="30px">Pilih Kib</td>
                <td>:</td>
                <td><input id="kib" name="kib" style="width: 250px;" /></td>
            </tr>                          
        </table>  
        <br />
        <table  id="trd" title="Detail Barang" style="width:940px;height:300px;" >  
        </table>       
        <div align="right"><input type="text" id="total" style="text-align: right;border:0;width: 200px;font-size: large;" readonly="true"/></div>        
        <div align="center" style="width: 1600px;"> <a class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="javascript:load_save()">HIBAH KIB</a></div>
        </table>
        <div id="toolbar" align="center" >
    		<a><b>PILIH KIB DIHIBAH</b></a>   		                            		
        
        </div>
    </div>  
</div>



