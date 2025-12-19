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
    var giat = '';
    var nomor= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
                    
     $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
            height: 360,
            width: 900,
            modal: true,
            autoOpen:false,
        });
        });    
     
  
    
     
     $(function(){ 
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>/index.php/master/load_neraca_awal',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
		  rowStyler: function(index,row){
                		if (row.kode=='22'||row.kode=='30'||row.kode=='34'
							||row.kode=='35' ||row.kode=='45' ||row.kode=='49'
							||row.kode=='57' ||row.kode=='59' ||row.kode=='70'
							||row.kode=='78' ||row.kode=='81' ||row.kode=='80'
							||row.kode=='77'){
                			return 'background-color:skyblue;';
                		}
                	},   
        loadMsg:"Tunggu Sebentar....!!",
        nowrap:"true",                       
        columns:[[
    	    {field:'kode',
    		title:'KODE',
    		width:10,
            align:"center"},
            {field:'seq',
    		title:'SEQ',
    		width:10,
            align:"center"},
            {field:'uraian',
    		title:'URAIAN',
    		width:100,
            align:"left"},
            {field:'nilai_lalu',
    		title:'Nilai',
    		width:20,
            align:"right"}
        ]],
        onSelect:function(rowIndex,rowData){
          nomor = rowData.kode;
          seq   = rowData.seq;
          lcket = rowData.uraian;
          lcnilai = rowData.nilai_lalu;
          lcidx = rowIndex;
          get(nomor,seq,lcket,lcnilai);   
                                       
        },
        onDblClickRow:function(rowIndex,rowData){
           lcidx = rowIndex;
           judul = 'Edit Data Neraca Lalu'; 
           edit_data();   
        }
        
        });
        
        //-----combo grid kode skpd---------
    /*$('#skpd').combogrid({  
		panelWidth:200,  
		url: '<?php echo base_url(); ?>/index.php/master/list_skpd',  
			idField:'kode',                    
			textField:'kode',
			mode:'remote',  
			fitColumns:true,  
			columns:[[  
				{field:'kode',title:'KODE SKPD',width:60},  
				{field:'nama',title:'NAMA SKPD',align:'left',width:100}								
			]],
			onSelect:function(rowIndex,rowData){
			kd_skpd = rowData.kode;
			
			}   
		});*/
     //---------  
                    

      
    });        

       
    function get(nomor,seq,lcket,lcnilai){
        $("#nomor").attr("value",nomor);
        $("#seq").attr("value",seq);
        $("#uraian").attr("value",lcket);
        $("#nilai").attr("value",lcnilai);
        
                
    }
    
    function kosong(){
        $("#nomor").attr("value",'');
        $("#seq").attr("value",'');
        $("#uraian").attr("value",'');
        $("#nilai").attr("value",'');                

    }
    
       function simpan(){
	   //var cskpd = $('#skpd').combogrid('getValue');
        //alert(lcstatus);
        var cno = document.getElementById('nomor').value;
        var cseq = document.getElementById('seq').value;
        var curaian = document.getElementById('uraian').value;
        var lnnilai = angka(document.getElementById('nilai').value);
            lcnilai = number_format(lnnilai,2,'.',',');
		//var lntotal = angka(document.getElementById('nilai').value);
         //   lctotal = number_format(lntotal,0,'.',',');
		//lcstatus='tambah';
        if (cno==''){
            alert('Nomor Tidak Boleh Kosong');
            exit();
        } 
        if (cseq==''){
            alert('seq  Tidak Boleh Kosong');
            exit();
        }
        if (curaian==''){
            alert(' uraian Tidak Boleh Kosong');
            exit();
        }
        
        if(lcstatus=='tambah'){ 
            lcinsert = "(kode,uraian,seq,nilai_lalu)";
            lcvalues = "('"+cno+"','"+curaian+"','"+cseq+"','"+lnnilai+"')";
			//lcinsert = "(kode,seq,uraian,nilai_lalu,kd_skpd)";
            //lcvalues = "('"+cno+"','"+cseq+"','"+curaian+"','"+lnnilai+"','"+cskpd+"')";
			
            $(document).ready(function(){
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>/index.php/master/simpan_master',
					//url: '<?php echo base_url(); ?>/index.php/master/simpan_master_lalu',
                    data: ({tabel:'map_neraca',kolom:lcinsert,nilai:lcvalues,cid:'kode',lcid:cno}),
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
          //lcquery = "UPDATE ms_neraca_kab_lalu SET uraian='"+curaian+"',seq='"+cseq+"',nilai_lalu='"+lnnilai+"',kd_skpd='"+cskpd+"' where kode='"+cno+"'";
		  lcquery = "UPDATE map_neraca SET uraian='"+curaian+"',seq='"+cseq+"',nilai_lalu='"+lnnilai+"' where kode='"+cno+"'";
            $(document).ready(function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>/index.php/master/update_master_lalu',
                data: ({st_query:lcquery}),
                dataType:"json",
                success:function(data){
                        status = data;
                        if (status=='0'){
                            alert('Gagal Simpan..!!');
							$('#dg').edatagrid('reload');
                            exit();
                        }else{
                            alert('Data Tersimpan..!!');
							$('#dg').edatagrid('reload');
                            exit();
                        }
                    }
            });
            });
            
            
        }   
            

        
        
       // alert("Data Berhasil disimpan");
        $("#dialog-modal").dialog('close');
        //$('#dg').edatagrid('reload');
        //section1();
    } 
    
	 $(document).ready(function(){
       $('#nilai').maskMoney({thousands:',', decimal:'.', precision:2,allowNegative:true});

});
	
      function edit_data(){
        lcstatus = 'edit';
        judul = 'Edit Data Neraca Lalu';
        $("#dialog-modal").dialog({ title: judul });
        $("#dialog-modal").dialog('open');
        document.getElementById("nomor").disabled=true;
		document.getElementById("seq").disabled=true;
        }    
        
    
     function tambah(){
        lcstatus = 'tambah';
        judul = 'Input Data Neraca Lalu';
        $("#dialog-modal").dialog({ title: judul });
        kosong();
        $("#dialog-modal").dialog('open');
        document.getElementById("nomor").disabled=false;
        document.getElementById("nomor").focus();
        } 
     function keluar(){
        $("#dialog-modal").dialog('close');
     }    
    
     /*function hapus(){
      //  var cnomor = document.getElementById('nomor').value;
//        var curaian = $('#uraian').combogrid('getValue');
        
        
        //alert(cnomor+curaian);
        var urll = '<?php echo base_url(); ?>index.php/tukd/hapus_tetap';
        $(document).ready(function(){
         $.post(urll,({no:nomor,uraian:kode}),function(data){
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
    } */
    
       
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
<h3 align="center"><u><b><a href="#" id="section1">Data Neraca Lalu</a></b></u></h3>
    <div>
    <p align="right">         
        <a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="">Tambah</a>               
        <table align="left" style="100%" border="0">
        <!--<tr >
			<td width="20%" height="40" ><B>S K P D</B></td>
			<td width="80%"><input id="skpd" name="skpd" type="text" class="easyui-combogrid" style="width:230px" /></td>
		</tr>-->		
        </table>
        <!--<a class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:hapus();">Hapus</a>
        <a class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="javascript:cari();">Cari</a>
        <input type="text" value="" id="txtcari"/>-->
        <table id="dg" title="Listing Data Neraca Lalu" style="width:870px;height:450px;" >  
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
                <td>KODE</td>
                <td></td>
                <td><input type="text" id="nomor" style="width: 200px;"/></td>  
            </tr>            
            <tr>
                <td>SEQ </td>
                <td></td>
                <td><input type="text" id="seq" style="width: 140px;" /></td>
            </tr>
            <tr>
                <td>URAIAN</td>
                <td></td>
                <td><input type="text" id="uraian" name="uraian" style="width: 500px;" /> </td>                            
            </tr>
                       
            <tr>
                <td>Nilai</td>
                <td></td>
                <td><input type="text" id="nilai" style="width: 140px; text-align: right;"/></td> 
            </tr>
           
            <tr>
                <td colspan="3" align="center"><a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:simpan();">Simpan</a>
		        <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Kembali</a>
                </td>                
            </tr>
        </table>       
    </fieldset>
</div>


  	
</body>

</html>