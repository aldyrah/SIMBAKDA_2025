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
    <link href="<?php echo base_url(); ?>easyui/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo base_url(); ?>easyui/jquery-ui.min.js"></script>
    <script type="text/javascript">
  
					 
	var idx      = 0;
	var tidx     = 0;
    var detIndex = 0;
    var id       = 0;
    var status   = '0';
	var no_advise= '';
	var no_sp2d  = '';
	var nilai_rinci=0;
	var total=0;
	var cek =1;
    
    $(document).ready(function() {
            $("#accordion").accordion();            
           $( "#dialog-modal" ).dialog({
                height: 500,
                width: 980,
                modal: true,
                autoOpen:false                
            });
             $( "#dialog-cetak" ).dialog({
                height: 160,
                width: 400,
                modal: true,
                autoOpen:false                
            });
            
        });    
     
     $(function(){ 
		$('#dg').edatagrid({
			url: '<?php echo base_url(); ?>/index.php/tukd/load_advise',
			idField:'id',            
			rownumbers:"true", 
			fitColumns:"true",
			singleSelect:"true",
			autoRowHeight:"false",
			pagination:"true",
			nowrap:"true",                       
			columns:[[
				{field:'no_advise',title:'Nomor ADVIS',width:150,align:"justify"},
				{field:'tgl_advise',title:'Tanggal',width:30,align:"center"},
				{field:'total1',title:'Total',width:50, align:"right"}
			]],
			onSelect:function(rowIndex,rowData){
			  no_advise=rowData.no_advise;
			  tgl_advise=rowData.tgl_advise;
			  total1=rowData.total1;
			  total=rowData.total;
			  get(no_advise,tgl_advise,total,total1);
			},
			onDblClickRow:function(rowIndex,rowData){ 
				no_advise=rowData.no_advise;
				tgl_advise=rowData.tgl_advise;
				total1=rowData.total1;
				total=rowData.total;
				load_detail(no_advise);
				cek=0;
				section2();
			}
		});
    
        $('#tgl_advise').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });

		 $('#tgl_sp2d').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });

        
        $('#dg1').edatagrid({  
            toolbar:'#toolbar',
            rownumbers:"true",            
            singleSelect:"true",
            autoRowHeight:"false",
            nowrap:"true",
            onSelect:function(rowIndex,rowData){                    
                    idx = rowIndex;
					no_sp2d  =rowData.no_sp2d;
					nilai_rinci=rowData.nilai;
            },                                                     
            columns:[[                
        	    {field:'no_sp2d',title:'Nomor SP2D',width:250},                
				{field:'tgl_sp2d', title:'tgl_sp2d',width:80,align:"center"},
				{field:'kd_skpd',title:'Kode SKPD',	width:100,align:"center"},
				{field:'nm_skpd',title:'Nama SKPD',width:200, align:"left"},
				{field:'nospm',title:'No Spm',width:130, align:"right",hidden:"true"},
				{field:'nmrekan',title:'Nama Rekan',width:130, align:"right",hidden:"true"},
				{field:'nilai1',title:'Nilai',width:130, align:"right"}
				
            ]]
        }); 

		$('#ttd').combogrid({  
			panelWidth:500,  
			url: '<?php echo base_url(); ?>/index.php/rka/pilih_ttd',  
				idField:'nip',                    
				textField:'nama',
				mode:'remote',  
				fitColumns:true,  
				columns:[[  
					{field:'nip',title:'NIP',width:60},  
					{field:'nama',title:'NAMA',align:'left',width:100}  
				]],
				onSelect:function(rowIndex,rowData){
				nip = rowData.nip;
				
				}   
         });
            
    });        
    
   
    
    function load_detail(ww){
		$('#dg1').edatagrid({
			url: '<?php echo base_url(); ?>/index.php/tukd/load_dadvise',
            queryParams:({no:ww})
		});
     }
    
    function sp2d(){
		var no_advises=document.getElementById('no_advise').value;
		if(no_advises==''){
			alert('No Advis Tidak Boleh Kosong !!!!');
			document.getElementById("no_advise").focus();  
			exit();
		}else{
			$("#dialog-modal").dialog("open");
			$("#txt_std").searchbox("setValue",'');	
			$("#dg1").datagrid("unselectAll");
			$("#dg1").datagrid("selectAll");
			var rows   = $("#dg1").datagrid("getSelections");
			var jrows  = rows.length ;
			zfnosp  = '';
			zknosp = '';
				
			for (z=0;z<jrows;z++){
			   zknosp=rows[z].no_sp2d;  

			   if ( z == 0 ){
				   zfnosp  = zknosp ;
			   } else {
				   zfnosp  = zfnosp+"'"+','+"'"+zknosp ;
			   }
			}   
			$('#dg2').edatagrid({
			url: '<?php echo base_url(); ?>/index.php/tukd/ambil_sp2d_advis',
			queryParams: ({sp2d:zfnosp}),
			idField       : 'id',
			pagination	  : false,
			rownumbers    : true, 
			remoteSort	  : false,
			multiSort     : true,
			fitColumns    : false,
			singleSelect  : false,
			columns       : [[ {field:'no_sp2d',title:'Nomor SP2D',width:280},                
								{field:'tgl_sp2d', title:'Tgl SP2D',width:80,align:"center"},
								{field:'kd_skpd',title:'Kode SKPD',	width:100,align:"center"},
								{field:'nm_skpd',title:'Nama SKPD',width:280, align:"left"},
								{field:'nilai1',title:'Nilai',width:130, align:"right"},
								{field:'nospm',title:'No Spm',width:130, align:"right",hidden:"true"},
								{field:'nmrekan',title:'Nama Rekan',width:130, align:"right",hidden:"true"},
								{field:'ck',        title:'ck',           checkbox:true}
							 ]]
			});	 
			selectall_sp2d();
			}
     }   
	


    function kembali(){
         $(document).ready(function(){    
             $('#section1').click(); 
			 $('#dg').datagrid('reload');
         });

    }
     
     
     function section2(){
         $(document).ready(function(){                
             $('#section2').click(); 
             document.getElementById("no_advise").focus();  	  
         });    
     }
       
     
    function get(no_advise,tgl_advise,total){
        $("#no_advise").attr("value",no_advise);
		$("#no_advisex").attr("value",no_advise);
		$("#tgl_advise").datebox("setValue",tgl_advise);
		$("#total1").attr("value",total);
		$("#total").attr("value",total1);
    }
    
    function kosong(){
        cdate = '<?php echo date("Y-m-d"); ?>';        
        $("#no_advise").attr("value",'');
		$("#no_advisex").attr("value",'');
		$("#tgl_advise").datebox("setValue",cdate);
		$("#no_sp2d").combogrid("setValue",'');
        $("#tgl_sp2d").datebox("setValue",'');
		$("#no_sp2d").combogrid("setValue",'');
        $("#skpd").attr("setValue",'');
        $("#nmskpd").attr("value",'');
		$("#total").attr("value",0);
		cek=1;
		$('#dg1').datagrid('loadData', {"total":0,"rows":[]});
    }
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    $(function(){ 
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>/index.php/tukd/load_advise',
        queryParams:({cari:kriteria})
        });        
     });
    }
    
	
	var sell_sp2d = new Array();
	var max_sp2d  = 0;

	  function getcek_sp2d(){
    	var ids   = [];  
		var a     = null;
		var rows  = $('#dg2').edatagrid('getSelections');  
		for(var i=0; i<rows.length; i++){  
		    a       = rows[i].ck;
			max_sp2d = i;
			if (a!=null){
				sell_sp2d[i]=a-1;
			}else{
				sell_sp2d[i]=1000;			
			}
		}  
	  }
    
	function Unselectall_sp2d(){
		$('#dg2').edatagrid('unselectAll');
		$('#dg1').edatagrid('unselectAll');
	 }
     
     function selectRecord_sp2d(rec){
		$('#dg2').edatagrid('selectRecord',rec);
	 }

	 function setcek_sp2d(){
		for(var i=0; i<max+1; i++){ 
			if (sell_sp2d[i]!=1000){
				selectRecord_sp2d(sell_sp2d[i]);
			}
		} 		
	 }

	function selectall_sp2d(){
		max_sp2d = 0;
		$('#dg2').edatagrid('selectAll');
		getcek_sp2d();
		Unselectall_sp2d();
		setcek_sp2d();
	 }

    function append_save(){

		var ids  = [];  
		var total_detail=0;
		var rows = $('#dg2').edatagrid('getSelections'); 
		for(var i=0; i<rows.length; i++){  

		    var cno_sp2d  = rows[i].no_sp2d;
		    var ctgl_sp2d  = rows[i].tgl_sp2d;
		    var ckd_skpd = rows[i].kd_skpd;
			var cnm_skpd = rows[i].nm_skpd;
			var cspm = rows[i].nospm;
			var cnmrekan = rows[i].nmrekan;
			var cnilai = rows[i].nilai;
			var cnilai1 = number_format(rows[i].nilai,2,',','.');
            $("#dg1").datagrid("unselectAll");
            $('#dg1').datagrid('selectAll');
            var rows_2 = $('#dg1').datagrid('getSelections') ;
                jgrid  = rows_2.length ;
           
            var id     = jgrid  ;
            
            $('#dg1').edatagrid('appendRow',{no_sp2d:cno_sp2d,tgl_sp2d:ctgl_sp2d,kd_skpd:ckd_skpd,nm_skpd:cnm_skpd,nospm:cspm,nilai:cnilai,nilai1:cnilai1,nmrekan:cnmrekan});
			$("#dg1").datagrid("unselectAll");
			var f_total= angka(document.getElementById('total1').value);
			if(cek=='1'){
				var total_rinci = angka(cnilai);
				    total_detail = total_detail + total_rinci;
					$("#total").attr("value",number_format(total_detail,2,',','.'));
					$("#total1").attr("value",total_detail);
					
			}else{
				var total_rinci = angka(cnilai);
				total_rinci = total_rinci + f_total; 
				$("#total").attr("value",number_format(total_rinci,2,',','.'));
				$("#total1").attr("value",total_rinci);
			}
            $("#dialog-modal").dialog("close");
        } 
		
		
	}
    
    function keluar(){
        $("#dialog-modal").dialog('close');
        $("#dialog-cetak").dialog('close');
    }    
     
    function hapus_sp2d(){
		var cno_advise = document.getElementById('no_advise').value;
		var kim  = document.getElementById('total1').value;
        var urll = '<?php echo base_url(); ?>index.php/tukd/hapus_trdadvise';
       // var tny = confirm('Yakin Ingin Menghapus Data, Nomor SP2D : '+no_sp2d);
      //  if (tny==true){
        $(document).ready(function(){
			$.ajax({url:urll,
			 dataType:'json',
			 type: "POST",    
			 data:({no_ad:cno_advise,no_sp:no_sp2d}),
			 success:function(data){
				status = data.pesan;
				if (status=='1'){  
					$('#dg1').datagrid('deleteRow',idx); 
					$("#total1").attr("value",kim-nilai_rinci);
					$("#total").attr("value",number_format(kim-nilai_rinci,2,",","."));
					}       
				}
			 
			});           
        });
       // }   
    }
    
	 function hapus(){
		var cno_advise = document.getElementById('no_advise').value;
        var urll = '<?php echo base_url(); ?>index.php/tukd/hapus_advise';

        $(document).ready(function(){
			$.ajax({url:urll,
			 dataType:'json',
			 type: "POST",    
			 data:({no_ad:cno_advise}),
			 success:function(data){
					status = data.pesan;
					if (status=='1'){  
						alert('Data Berhasil dihapus ...!!');
						kosong();
						$('#dg').datagrid('reload');
					}else{
						alert('Data gagal dihapus ...!!');
					}     
				}
			 
			});           
        }); 
    }
   
    function simpan_advise(){
        var cno = document.getElementById('no_advise').value;
		var cnomor2 = document.getElementById('no_advisex').value;
        var ctgl = $('#tgl_advise').datebox('getValue');
		var cnilai= document.getElementById('total1').value;
        if (cno==''){
            alert('Nomor ADVIS Tidak Boleh Kosong');
            exit();
        } 
        if (ctgl==''){
            alert('Tanggal ADVIS Tidak Boleh Kosong');
            exit();
        }
        $(document).ready(function(){
            $.ajax({
                type: "POST",    
                dataType:'json',                            
                data: ({tabel:'trhadvise',no:cno,tgl:ctgl,nilaiz:cnilai,nomorx:cnomor2,ccek:cek}),
                url: '<?php echo base_url(); ?>/index.php/tukd/simpan_advise',
                success:function(data){
                    status = data.pesan; 
					if(status =='1'){
						alert('Data Berhasil Disimpan');
						save_detail(status);
						kembali();
						$('#dg').datagrid('reload');
					}else if(status =='0'){
						alert('Data Gagal Disimpan  ..!!');
					}else{
						alert('No Advis '+cno+' telah Terpakai  ..!!');
					}
                }
            });
        });
        
       
    }
  
  function save_detail(x){
	    var kim=x;
	    var cno = document.getElementById('no_advise').value;
		var cnomor2 = document.getElementById('no_advisex').value;
        var ctgl = $('#tgl_advise').datebox('getValue');
		if (kim =='1'){
            $('#dg1').datagrid('selectAll');
            var rows = $('#dg1').datagrid('getSelections');           
			for(var p=0;p<rows.length;p++){
				cnoadvise   = cno;
                cnosp2d		= rows[p].no_sp2d;
                ctglsp2d	= rows[p].tgl_sp2d;
                ckdskpd		= rows[p].kd_skpd;
                cnmskpd		= rows[p].nm_skpd;
				cspm		= rows[p].nospm;
				cnmrekan	= rows[p].nmrekan;
                cnilai		= rows[p].nilai;                 
                if (p>0) {
                    csql = csql+","+"('"+cnoadvise+"','"+cnosp2d+"','"+cspm+"','"+cnmrekan+"','"+ctglsp2d+"','"+ckdskpd+"','"+cnmskpd+"','"+cnilai+"')";
                } else {
                    csql = "values('"+cnoadvise+"','"+cnosp2d+"','"+cspm+"','"+cnmrekan+"','"+ctglsp2d+"','"+ckdskpd+"','"+cnmskpd+"','"+cnilai+"')";                                            
                } 
			}
			
			 $(document).ready(function(){
                $.ajax({
                    type: "POST",    
                    dataType:'json',                    
                    data: ({tabel:'trdadvise',no:cno,sql:csql,nomorx:cnomor2,ccek:cek}),
                    url: '<?php echo base_url(); ?>/index.php/tukd/simpan_advise',
                    success:function(data){
                          $('#dg1').datagrid('unselectAll');
                    }                                        
                });
            });                       
        } 
  
  }
    </script>

</head>
<body>



<div id="content">    
<div id="accordion">
<h3><a href="#" id="section1">List ADVIS</a></h3>
    <div>
    <p align="right">         
        <a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:kosong();section2();">Tambah</a>               
        <a class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="javascript:cari();">Cari</a>
        <input type="text" value="" id="txtcari"/>
        <table id="dg" title="List SPD" style="width:870px;height:470px;" >  
        </table>                          
    </p> 
    </div>   

<h3><a href="#" id="section2">A D V I S </a></h3>
   <div  style="height: 350px;">
   <p id="p1" style="font-size: x-large;color: red;"></p>
   <p>       
		<fieldset>
        <table align="center" border='0' style="width:850px;">
        
            <tr style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;">
                <td colspan="5" style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">&nbsp;</td>
            </tr>                        

            <tr style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;">
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">No. A D V I S </td>
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">&nbsp;<input type="text" id="no_advise"  style="width: 200px;" onclick="javascript:select();"/></td>
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">&nbsp;<input type="hidden" id="no_advisex" style="width: 180px;"/></td>
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">Tanggal ADVIS</td>
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;">&nbsp;&nbsp;<input type="text" id="tgl_advise" style="width: 140px;" /></td>    
            </tr>                     
        </table>      
		</fieldset>
         <table align="right">
			 <tr style="padding:3px;border-spacing:5px 5px 5px 5px;">
                <td style="padding:3px;border-spacing:5px 5px 5px 5px;border-bottom-style:hidden;" colspan="5" align="right"><a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:kosong();">Tambah</a>
                    <a class="easyui-linkbutton" id="save" iconCls="icon-save" plain="true" onclick="javascript:simpan_advise();">Simpan</a>
		            <a class="easyui-linkbutton" id="hapus_advise" iconCls="icon-remove" plain="true" onclick="javascript:hapus();kembali();">Hapus</a>
                    <a class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:cetak();">Cetak</a>
  		            <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:kembali();">Kembali</a>                                   
                </td>
            </tr>
		 </table>
        <table id="dg1" title="S P 2 D" style="width:870px;height:350px;" >  
        </table>  
        
        <div id="toolbar" align="right">
    		<a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:sp2d();">Tambah SP2D</a>
            <a class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:hapus_sp2d();">Hapus SP2D</a> 		
        </div>

        <table align="center" style="width:100%;">
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td > <input type="text" id="total1" name="total1" style="font-size: large;border:0;width: 200px;text-align: right;" hidden/></td>
            <td align="right">Total : <input type="text" id="total" name="total" style="font-size: large;border:0;width: 200px;text-align: right;" readonly="true"/></td>
        </tr>
        </table>
                
   </p>
   </div>
   
</div>
</div>
<script>
	function cari_sp2d(x){
		$(function(){
		 $('#dg2').edatagrid({
			loadMsg:"Tunggu Sebentar....!!",
			url: '<?php echo base_url(); ?>/index.php/tukd/ambil_sp2d_advis',
			queryParams:({cari:x})
			});        
		 });
	
	}

	function cetak(){
		$('#dialog-cetak').dialog("open");	
		$('#ctk_advise').attr("value",no_advise);
	}

	function print(){
		var cttd= $('#ttd').combogrid("getValue");
		var ttd =cttd.split(" ").join("123456789");
		lc = '?code='+no_advise+'&ttd='+ttd;
		url    = "<?php echo site_url(); ?>/tukd/cetak_advise";  	
		window.open(url+lc,'_blank');
		window.focus();
	}
</script>

<div id="dialog-modal" title="Pilih SP2D">

    <p class="validateTips"></p> 
    <fieldset>  
		<tr>
			<td align="left" width="100px">Cari&nbsp;&nbsp
				<input id="txt_std" class="easyui-searchbox" data-options="prompt:'Please Input Value',	searcher:function(value,name){cari_sp2d(value)}" style="width:180px"/>
			</td>
			
		</tr>
    <table id="dg2" title="Pilih SP2D" style="width:930px;height:350px;">  
    </table>  
    
    <table style="width:930px;height:20px;" border="0">
        <tr>
        <td align="center" colspan='2'>&nbsp;</td>
        </tr>

        <tr>
			<td align="center" >
				<button class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:append_save();">Pilih</button>
				<button class="easyui-linkbutton" iconCls="icon-back" plain="true" onclick="javascript:keluar();">Kembali</button>
			</td>
        </tr>
    </table>
    
    </fieldset>  
</div>


<div id="dialog-cetak" title="Cetak ADVISE">     
    <fieldset>
   	<form target="_blank" method="POST" id="frm_ctk" >
    <table border="0">
        <tr>
            <td width="30%">Nomor Advis</td>
            <td width="1%">:</td>
            <td><input type="text" id="ctk_advise" style="border:0;width: 225px;" name="nomor1" readonly="true" /></td>
        </tr>
		<tr>
            <td width="30%">Penandatangan:
			 <td width="1%">:</td>
            <td><input id="ttd" name="ttd" style="width: 225px;" /></td>
        </tr>
    </table>
    </fieldset>
    <fieldset>
    <table align="center">
        <tr>
            <td><a class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="print();" >Print</a>               
                <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Keluar</a>
            </td>
        </tr>
    </table>
    </form>
    </fieldset>
   
</div>

</body>

</html>