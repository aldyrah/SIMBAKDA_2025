<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/demo/demo.css">
	<script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.edatagrid.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/autoCurrency.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/numberFormat.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery.maskMoney.min.js"></script>
    
    <link href="<?php echo base_url(); ?>easyui/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo base_url(); ?>easyui/jquery-ui.min.js"></script>
    <script type="text/javascript">
    
    var kode = '';
	var nmskpd='';
    var giat = '';
    var nomor= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
                    
     $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
            height: 450,
            width: 900,
            modal: true,
            autoOpen:false,
        });
			get_skpd();
        });    
     
  	$(document).ready(function(){
      $('#nilai').maskMoney({thousands:',', decimal:'.', precision:0});
    });
    
     
     $(function(){ 
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>/index.php/tukd/load_jpanjar',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'no_kas',
    		title:'Nomor Kas',
    		width:50,
            align:"center"},
            {field:'tgl_panjar',
    		title:'Tanggal',
    		width:30},
            {field:'kd_skpd',
    		title:'S K P D',
    		width:30,
            align:"center"},
            {field:'pengguna',
    		title:'Pengguna',
    		width:50,
            align:"center"},
            {field:'nilai',
    		title:'Nilai',
    		width:50,
            align:"center"}
        ]],
        onSelect:function(rowIndex,rowData){
          nomor = rowData.no_panjar;
          tgl   = rowData.tgl_panjar;
          nokas = rowData.no_kas;
          tglkas   = rowData.tgl_kas;
          kode  = rowData.kd_skpd;
          lcket = rowData.keterangan;
          lcrek = rowData.pengguna;
          rek = rowData.pengguna;
          lcnilai = rowData.nilai;
          lcpay = rowData.pay;
          lcrekbank = rowData.rek_bank;
          lcidx = rowIndex;
          get(nokas,tglkas,nomor,tgl,kode,lcket,lcrek,rek,lcnilai,lcpay,lcrekbank);   
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
           lcidx = rowIndex;
           judul = 'Edit Data Penetapan'; 
           edit_data();   
        }
        
        });
        
         $('#tanggal').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
                //return d+'-'+m+'-'+y;
            },
            onSelect: function(date){
		      jaka = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
	       }
        });
        
        $('#tanggal_kas').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
                //return d+'-'+m+'-'+y;
            },
            onSelect: function(date){
		      jaka1 = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
	       }
        });
    
       
       $('#nomor').combogrid({  
                panelWidth : 500,  
                url        : '<?php echo base_url(); ?>/index.php/tukd/ambil_panjar',  
                idField    : 'no_panjar',                    
                textField  : 'no_panjar',
                mode       : 'remote',  
                fitColumns : true,  
                columns:[[  
                        {field:'no_panjar',title:'No',width:60},  
                        {field:'nilai',title:'Nilai',align:'right',width:80} 
                    ]],
                     onSelect:function(rowIndex,rowData){
                        no_panjar = rowData.no_panjar;         
                        tgl   = rowData.tgl_panjar;
                        skpd     = rowData.kd_skpd;          
                        pengguna     = rowData.pengguna;
                        nilai     = number_format(rowData.nilai,2,'.',',');
                        ket    = rowData.keterangan;
                        rek    = rowData.rek_bank;
                        $("#skpd").attr("Value",skpd); 
                        $("#rek1").attr("Value",pengguna); 
                        $("#nilai").attr("value",nilai); 
                        $("#tanggal").datebox("setValue",tgl);
                        $("#ket").attr("value",ket);
                        $("#rek_bank").attr("value",rek);   
                        //loadpanjar(no_panjar,tgl,skpd,penguna,nilai,ket,rek);                                                           
                    }  
                });   
              
    });        

	function get_skpd()
        {
        
        	$.ajax({
        		url:'<?php echo base_url(); ?>index.php/rka/config_skpd',
        		type: "POST",
        		dataType:"json",                         
        		success:function(data){
        								$("#skpd").attr("value",data.kd_skpd);
        								$("#nmskpd").attr("value",data.nm_skpd);
        								kode = data.kd_skpd;
										nmskpd=data.nm_skpd;
                                        
        							  }                                     
        	});
             
        } 

     function section2(){
         $(document).ready(function(){    
             $('#section2').click();                                               
         });   
     }


    
    function section1(){
         $(document).ready(function(){    
             $('#section1').click();   
             $('#dg').edatagrid('reload');                                              
         });
     }
    
       
    function get(nokas,tglkas,nomor,tgl,kode,lcket,lcrek,rek,lcnilai,lcpay,lcrekbank){
        $("#no_kas").attr("value",nokas);
        $("#tanggal_kas").datebox("setValue",tglkas);
        $("#nomor").combogrid("setValue",nomor);
        $("#tanggal").datebox("setValue",tgl);
        $("#skpd").attr("value",kode);
        $("#rek1").attr("Value",lcrek);
        $("#nilai").attr("value",lcnilai);
        $("#ket").attr("value",lcket);
        //$("#jns_tunai").attr("value",lcpay);
        $("#rek_bank").attr("value",lcrekbank);
                
    }
    
    function kosong(){
		cdate = '<?php echo date("Y-m-d"); ?>';
        $("#no_kas").attr("value",'');
        $("#tanggal_kas").datebox("setValue",cdate);
        $("#nomor").combogrid("setValue",'');
        $("#tanggal").datebox("setValue",cdate);
        $("#skpd").attr("value",'');
        $("#rek1").attr("Value",'');
        $("#nmskpd").attr("value",'');
        $("#nmrek").attr("value",'');
        $("#nilai").attr("value",'');        
        $("#ket").attr("value",''); 
       // $("#jns_tunai").attr("value",'');
        $("#rek_bank").attr("value",'');               

    }
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    $(function(){ 
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>/index.php/tukd/load_tetap',
        queryParams:({cari:kriteria})
        });        
     });
    }
    
    
    
       function simpan_tetap(){
        var cno_kas = document.getElementById('no_kas').value;
        var ctgl_kas = $('#tanggal_kas').datebox('getValue');
        var cno = $('#nomor').combogrid('getValue');
        var ctgl = $('#tanggal').datebox('getValue');
        var cskpd = document.getElementById('skpd').value;//$('#skpd').combogrid('getValue');
        var rek = document.getElementById('rek1').value;
        var lcket = document.getElementById('ket').value;
        //var lctunai = document.getElementById('jns_tunai').value;
        var lcrek_bank = document.getElementById('rek_bank').value;
        var lntotal = angka(document.getElementById('nilai').value);
            lctotal = number_format(lntotal,0,'.',',');
			
        if (cno==''){
            alert('Nomor  Tidak Boleh Kosong');
            exit();
        } 
        if (ctgl==''){
            alert('Tanggal  Tidak Boleh Kosong');
            exit();
        }
        if (cskpd==''){
            alert('Kode SKPD Tidak Boleh Kosong');
            exit();
        }
		
         if(lcstatus=='tambah'){ 
                    
                    lcinsert = "(no_kas,tgl_kas,no_panjar,tgl_panjar,kd_skpd,pengguna,nilai,keterangan,rek_bank)";
                    lcvalues = "('"+cno_kas+"','"+ctgl_kas+"','"+cno+"','"+ctgl+"','"+cskpd+"','"+rek+"','"+lntotal+"','"+lcket+"','"+lcrek_bank+"')";
                    $(document).ready(function(){
                        $.ajax({
                            type: "POST",
                            url: '<?php echo base_url(); ?>/index.php/master/simpan_master3',
                            data: ({tabel:'tr_jpanjar',kolom:lcinsert,nilai:lcvalues,cid:'no_kas',lcid:cno_kas}),
                            dataType:"json",
                            success:function(data){
                                status = data;
                                if (status=='0'){
                                    alert('Gagal Simpan..!!');
                                    exit();
                                }else if(status=='1'){
                                    alert('Data Sudah Ada..!!');
                                    exit();
                                }else{
                                    alert('Data Tersimpan..!!');
                                    exit();
                                }
                            }
                        });
                    });    
                 
                  }else{
                    lcquery = "UPDATE tr_jpanjar SET no_kas='"+cno_kas+"',tgl_kas='"+ctgl_kas+"',tgl_panjar='"+ctgl+"',pengguna='"+rek+"',keterangan='"+lcket+"',nilai='"+lntotal+"',rek_bank='"+lcrek_bank+"' where no_panjar='"+cno+"'";
                    $(document).ready(function(){
                    $.ajax({
                        type: "POST",
                        url: '<?php echo base_url(); ?>/index.php/master/update_master',
                        data: ({st_query:lcquery}),
                        dataType:"json",
                        success:function(data){
                                status = data;
                                if (status=='0'){
                                    alert('Gagal Simpan..!!');
                                    exit();
                                }else{
                                    alert('Data Tersimpan..!!');
                                    exit();
                                }
                            }
                    });
                    });
                    
                    
                }   
                
        
        $("#dialog-modal").dialog('close');
        $('#dg').edatagrid('reload');
    } 
    
      function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data Panjar';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        document.getElementById("nomor").disabled=true;
        }    
        
    
     function tambah(){
        lcstatus = 'tambah';
        judul = 'Input Data Pertanggungjawaban Panjar';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
        $("#dialog-modal").dialog('open');
        document.getElementById("no_kas").disabled=false;
        document.getElementById("no_kas").focus();
		//ambil_nomor();
        } 

  function ambil_nomor(){
		$.ajax({
			type: "POST",
			url: '<?php echo base_url(); ?>/index.php/tukd/max_nomor',
			data: ({ckode:kode}),
			dataType:"json",
				success: function(data){
				$("#no_kas").attr("value",data.nomor);
				//$("#nomor").attr("value",data.bukti);
				$("#skpd").attr("value",kode);
				$("#nmskpd").attr("value",nmskpd);
			}
		});
	}
	

     function keluar(){
        $("#dialog-modal").dialog('close');
     }    
    
     function hapus(){
        var urll = '<?php echo base_url(); ?>index.php/tukd/hapus_jpanjar';
        $(document).ready(function(){
         $.post(urll,({no:nomor,skpd:kode}),function(data){
            status = data;
            if (status=='0'){
                alert('Gagal Hapus..!!');
                exit();
            } else {
                $('#dg').datagrid('deleteRow',lcidx);   
                alert('Data Berhasil Dihapus..!!');
                exit();
            }
         });
        });    
    } 
    
       
    function addCommas(nStr)
    {
    	nStr += '';
    	x = nStr.split(',');
        x1 = x[0];
    	x2 = x.length > 1 ? ',' + x[1] : '';
    	var rgx = /(\d+)(\d{3})/;
    	while (rgx.test(x1)) {
    		x1 = x1.replace(rgx, '$1' + '.' + '$2');
    	}
    	return x1 + x2;
    }
    
     function delCommas(nStr)
    {
    	nStr += ' ';
    	x2 = nStr.length;
        var x=nStr;
        var i=0;
    	while (i<x2) {
    		x = x.replace(',','');
            i++;
    	}
    	return x;
    }
  
    
  
   </script>

</head>
<body>

<div id="content"> 
<div id="accordion">
<h3 align="center"><u><b><a href="#" id="section1">INPUTAN PERTANGGUNGJAWABAN PANJAR</a></b></u></h3>
    <div>
    <p align="right">         
        <a class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="javascript:tambah()">Tambah</a>               
        <a class="easyui-linkbutton" iconCls="icon-cancel" plain="false" onclick="javascript:hapus();">Hapus</a>
        <a class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="javascript:cari();">Cari</a>
        <input type="text" value="" id="txtcari"/>
        <table id="dg" title="Daftar Pertanggungjawaban Panjar" style="width:870px;height:450px;" >  
        </table>
 
    </p> 
    </div>   

</div>

</div>

<div id="dialog-modal" title="">
    <p class="validateTips">Semua Inputan Harus Di Isi.</p> 
    <fieldset>
     <table align="center" style="width:100%;" border="0">
            <tr>
                <td>No. Kas</td>
                <td></td>
                <td><input type="text" id="no_kas" style="width: 60px;" maxlength="5"/></td>  
            </tr>
            <tr>
                <td>Tanggal Kas </td>
                <td></td>
                <td><input type="text" id="tanggal_kas" style="width: 140px;" /></td>
            </tr>
             <tr>
                <td>No. panjar</td>
                <td></td>
                <td><input type="text" id="nomor" style="width: 200px;"/></td>  
            </tr>             
            <tr>
                <td>Tanggal </td>
                <td></td>
                <td><input type="text" id="tanggal" style="width: 140px;" readonly="true" disabled/></td>
            </tr>
            <tr>
                <td>S K P D</td>
                <td></td>
                <td><input id="skpd" name="skpd" style="width: 140px;" readonly/>  <input type="text" id="nmskpd" style="border:0;width: 600px;" readonly="true"/></td>                            
            </tr>
            <tr>
                <td>Pengguna</td>
                <td></td>
                <td><input type="text" id="rek1" style="width: 140px;" readonly="true"/>Rek.Bank   :<input type="text" id="rek_bank" style="width: 170px;" readonly="true"/></td>                
            </tr>            
            <tr>
                <td>Nilai</td>
                <td></td>
                <td><input type="text" id="nilai" style="width: 150px; text-align: right;" readonly="true"/></td> 
            </tr>
             <!--<tr>
                <td>Pembayaran</td>
                <td></td>
                 <td>
                     <select name="jns_tunai" id="jns_tunai">
                         <option value="">......</option>     
                         <option value="TUNAI">TUNAI</option>
                         <option value="BANK">BANK</option>
                     </select>
                 </td>
            </tr>-->
            <tr>
                <td>Keterangan</td>
				<td></td>
                <td colspan="2"><textarea rows="2" cols="50" id="ket" style="width: 740px;" readonly="true"></textarea>
                </td> 
            </tr>
           
            <tr>
                <td colspan="3" align="center"><a class="easyui-linkbutton" iconCls="icon-save" plain="false" onclick="javascript:simpan_tetap();">Simpan</a>
		        <a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:keluar();">Kembali</a>
                </td>                
            </tr>
        </table>       
    </fieldset>
</div>


  	
</body>

</html>