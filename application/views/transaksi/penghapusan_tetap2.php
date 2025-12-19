<script src="<?php echo base_url(); ?>lib/sweet-alert.min.js"></script>
<link   rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>lib/sweet-alert.css">
<script type="text/javascript" src="<?php echo base_url(); ?>easyui/autoCurrency.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>easyui/currencyFields.js"></script>
  	
<script type="text/javascript">
    var updt = 'f';
    var idx2 = '';
    var total2 = 0;
    
     $(document).ready(function() {
          $("#accordion").accordion(); 
          $("#dialog-modal").dialog({
            height: 470,
            width: 600,
            modal: true, 
            background:'#2da305',           
            autoOpen:false                
          });  
		  $( "#dialog-foto" ).dialog({
            height: 500,
            width: 450,
            modal: true,
            autoOpen:false
        });                      
     });    
     
    $(function(){
	  $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>index.php/transaksi/ambil_listhapus',
        idField:'kode',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:false,
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
        	    {field:'id_barang',title:'Nomor Dokumen',width:40,hidden:true},
                {field:'no_reg',title:'Register',width:7},
				{field:'kd_brg',title:'Kode',width:9},
        	    {field:'nm_brg',title:'Nama Barang',width:20},
				{field:'keterangan',title:'Alasan',width:20,align:"left"},  
                {field:'no',title:'ck',width:30,checkbox:true}   
					]]
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
            panelWidth:800,  
            idField:'kd_uskpd',  
            textField:'kd_uskpd',  
            mode:'remote',                      
            url:'<?php echo base_url(); ?>index.php/master/ambil_ubidskpd',  
            columns:[[  
               {field:'kd_uskpd',title:'Kode Unit',width:100},  
               {field:'nm_uskpd',title:'Nama Unit',width:690}    
            ]],  
            onSelect:function(rowIndex,rowData){
               cuskpd = rowData.kd_uskpd;               
               $('#nmuskpd').attr('value',rowData.nm_uskpd);    
            } 
         });  
         
    });
	
 function load_save(){ 
    var lctgl  = $('#tanggal').datebox('getValue');
    var skpd   = $('#uskpd').combogrid('getValue');
	if (lctgl == ''){
         alert('Tanggal Hapus Tidak Boleh Kosong');
         exit();              
     }
		var ids  = []; 
		var idfa = [];  
        var idsa = [];
        var idsb = [];
        var idsc = [];
        var idsd = [];
        var idse = [];
        var idsf = [];
        var idsg = [];
        var idsh = [];
		var rows = $('#dg').edatagrid('getSelections'); 
		for( i=0; i < rows.length; i++){ 
		    ids.push(rows[i].no);
            idfa.push(rows[i].id_barang);
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
     cidbar   =(idfa.join('||'));     
     cnodoc   =(idsa.join('||'));
	 cnoreg   =(idsb.join('||'));
     ckdbrg   =(idsc.join('||'));
     cnmbrg   =(idsd.join('||'));
     ctglreg  =(idse.join('||'));
     ckds     =(idsf.join('||'));
     cthn     =(idsg.join('||'));
     chrg     =(idsh.join('||'));
    var jns_brg = ckdbrg.slice(0,2); 
    var r = confirm("Yakin ingin menghapus: "+ckdbrg+" ?");
	
    if(r==true){
         
         $.ajax({
            type: 'POST',
            data: ({id_barang:cidbar,kd_brg:jns_brg}),
            dataType:"json",
            url:"<?php echo base_url(); ?>index.php/transaksi/hapus_kib_tetap",
			success:function(data){ 
			swal({
				title: "Terhapus!",
				text: "Data Telah ditetapkan!",
				type: "warning",
				confirmButtonText: "OK"
				});
			$('#dg').edatagrid('reload');
			}
         });
    }
    //cgol = $('#kib').combogrid('getValue');                              
   // load_kib(cgol);   
    
}
    
</script>


<div id="content1">
<p><h3 align="center">.:PENETAPAN PENGHAPUSAN BARANG:.</h3></p>
    <div align="center">
    <p>     
        <table>
            <tr hidden="true">
                <td height="30px"><b>Unit Kerja</b></td>
                <td>:</td>
                <td><input id="uskpd" name="uskpd" style="width: 160px;" /></td>
                <td></td>
				<td><b>Nama Unit Kerja</b></td> 
                <td>:</td>
                <td><input type="text" id="nmuskpd" style="border:0;width: 400px;" readonly="true"/></td>   
            </tr>
            <tr>                               
                <td><b>Tanggal Penetapan Penghapusan</b></td>
                <td>:</td>
                <td><input type="text" id="tanggal" style="width: 140px;" /></td>   
				<td colspan="3"></td>
			</tr>
        <br />
        <table  id="dg" title="PILIH BARANG PENETAPAN DIHAPUS" style="width:940px;height:300px;" >  
        </table>       
        <div align="right"><input type="text" id="total" style="text-align: right;border:0;width: 200px;font-size: large;" readonly="true"/></div>        
        <div align="center" style="width: 1600px;"> <a class="easyui-linkbutton" iconCls="icon-ok" plain="true" onclick="javascript:load_save()">TETAPKAN PENGHAPUSAN</a></div>
        </table>  
		</p>		
    </div> 
</div>
