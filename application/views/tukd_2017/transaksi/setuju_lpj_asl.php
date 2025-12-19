<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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
   
    var no_lpj   = '';
    var kode     = '';
    var spd      = '';
    var st_12    = 'edit';
    var nidx     = 0;
    var spd2     = '';
    var spd3     = '';
    var spd4     = '';
    var lcstatus = '';
	var otonom   ='';
    
    $(document).ready(function() {
            $("#accordion").accordion();
            $("#lockscreen").hide();                        
            $("#frm").hide();
            
        get_skpd();

			$('#tglstju').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });
   
    
         
	   
                
          $('#spp').edatagrid({
    		url: '<?php echo base_url(); ?>/index.php/tukd/load_lpj_verif',
            idField:'id',            
            rownumbers:"true", 
            fitColumns:"true",
            singleSelect:"true",
            autoRowHeight:"false",
            loadMsg:"Tunggu Sebentar....!!",
            pagination:"true",
            nowrap:"true",                       
            columns:[[
                {field:'nm_skpd',
        		title:'Nama SKPD',
        		width:160,
                align:"left"},			
        	    {field:'no_lpj',
        		title:'No. LPJ',
        		width:150},
				 {field:'no_setuju',
        		title:'No. Setuju',
        		width:50},
                {field:'tgl_lpj',
        		title:'Tanggal',
        		width:60},
				{field:'tgl_setuju',
        		title:'Tgl.Setuju',
        		width:60},
                {field:'status',
        		title:'Status',
        		width:80,
                align:"left",
				formatter: function(value,row,index){
					if (row.status==1){
						return 'DISETUJUI';
					}else{
						return 'BELUM DISETUJUI';
					}
				}}
            ]],
            onSelect:function(rowIndex,rowData){
              nomer     = rowData.no_lpj;         
              detail_trans_3();
              load_sum_lpj(); 
			 
			},
            onDblClickRow:function(rowIndex,rowData){
				nomer     = rowData.no_lpj;
				otonom    = rowData.nomor;
				no_setuju =rowData.no_setuju;
				tglstju   =rowData.tgl_setuju;
				rcek      =rowData.cek;
				get(nomer,no_setuju,tglstju,rcek,otonom);
                section1();
            }
        });
                
           
//==grid view edit
              var nlpj      = document.getElementById('no_lpj').value;
			  
 			$('#dg1').edatagrid({
				url: '<?php echo base_url(); ?>/index.php/tukd/select_data1_lpj',
				 queryParams:({ lpj:nlpj }),
                 idField:'idx',
                 toolbar:"#toolbar",              
                 rownumbers:"true", 
                 fitColumns:false,
                 autoRowHeight:"false",
                 singleSelect:"true",
                 nowrap:"false",
                 columns:[[
                    {field:'idx',title:'idx',width:100,align:'left',hidden:'true'},               
                    {field:'no_bukti',title:'No Bukti',width:200,align:'left'},                                          
                    {field:'kdkegiatan',title:'Kegiatan',width:150,align:'left'},
					{field:'kdrek5',title:'Rekening',width:70,align:'left'},
					{field:'nmrek5',title:'Nama Rekening',width:280},
                    {field:'nilai1',title:'Nilai',width:140,align:'right'}
                   /* {field:'hapus',title:'',width:35,align:"center",
                    formatter:function(value,rec){ 
                    return '<img src="<?php echo base_url(); ?>/assets/images/icon/edit_remove.png" onclick="javascript:hapus_detail();" />';
                    }
                    }*/
				]]	
            }); 
			
   	});
        
           
   function get(nolpj,nostj,tglstj,cek,otonom){
		$('#no_lpj').attr("value",nolpj);
		$('#no_stj').attr("value",nostj);
		if(nostj == null || nostj ==''){
			$('#no_stj').attr("value",otonom);
		}
		$('#tglstju').datebox("setValue",tglstj);
		if (cek == 1){
			$('#batal').linkbutton('disable'); 
			$('#setuju').linkbutton('disable'); 
			 document.getElementById("p1").innerHTML="Sudah di Buat SPP...!!!";
		}else{
			$('#batal').linkbutton('enable'); 
			$('#setuju').linkbutton('enable');
			document.getElementById("p1").innerHTML="";
		}
   }     
    
    function get_skpd()
        {
        	$.ajax({
        		url:'<?php echo base_url(); ?>index.php/rka/config_skpd',
        		type: "POST",
        		dataType:"json",                         
        		success:function(data){
        								$("#dn").attr("value",data.kd_skpd);
        								$("#nmskpd").attr("value",data.nm_skpd);
                                            kode   = data.kd_skpd;
                                            validate_spd(kode);
        							  }                                     
        	});  
        }         
    
   

		
    function getRowIndex(target){  
			var tr = $(target).closest('tr.datagrid-row');  
			return parseInt(tr.attr('datagrid-row-index'));  
		} 
       
    
    function cetak(){
        var nom=document.getElementById("no_spp").value;
        $("#dialog-modal").dialog('open');
    } 
    
    
    function keluar(){
        $("#dialog-modal").dialog('close');
    } 
    
    
    function keluar_no(){
        $("#dialog-modal-tr").dialog('close');
    }
      
    
    function cari(){
     var kriteria = document.getElementById("txtcari").value; 
        $(function(){ 
            $('#spp').edatagrid({
	       url: '<?php echo base_url(); ?>/index.php/tukd/load_lpj_verif',
         queryParams:({cari:kriteria})
        });        
     });
    }
    
     
    function section1(){
         $(document).ready(function(){    
             $('#section1').click();
         });
     }
     
      
     
 
    function kembali(){
        $('#kem').click();
    }                
    
    
     function load_sum_lpj(){          
        
        $(function(){      
         $.ajax({
            type: 'POST',
            url:"<?php echo base_url(); ?>index.php/tukd/load_sum_lpj",
            data:({lpj:nomer}),
            dataType:"json",
            success:function(data){ 
                $.each(data, function(i,n){
                    $("#rektotal").attr('value',number_format(n['cjumlah'],2,'.',','));
                });
            }
         });
        });
    }
    
	function setuju(){

		var cnlpj   = document.getElementById('no_lpj').value;
		var cnlstj  = document.getElementById('no_stj').value;
		var ctgl    = $('#tglstju').datebox('getValue'); 
		
		if(cnlstj == "")
		{
			alert('No.Persetujuan tidak boleh Kosong')
			exit;
		}

		if(ctgl == "")
		{
			alert('Tanggal Persetujuan tidak boleh Kosong')
			exit;
		} 

		$.ajax({url: '<?php echo base_url(); ?>index.php/tukd/simpan_stjlpj',   
        type: "POST",
        dataType:'json',
		data     : ({nlpj:cnlpj,nlstj:cnlstj,tgl:ctgl}),
		success:function(data){
				status = data;	
				}
		});
		
		 if (status=='0'){
				alert('Gagal Update..!!');
				exit();
			} else {
		
			  alert('Data Terupdate...!!!');
			  section4();
			  exit();
			}

		

	}
	
	function batalsetuju(){

		var cnlpj   = document.getElementById('no_lpj').value;
		var cnlstj  = document.getElementById('no_stj').value;
		var ctgl    = $('#tglstju').datebox('getValue'); 
		
		$.ajax({url: '<?php echo base_url(); ?>index.php/tukd/simpan_btllpj',   
        type: "POST",
        dataType:'json',
		data     : ({nlpj:cnlpj,nlstj:cnlstj,tgl:ctgl}),
		success:function(data){
				status = data;	
				}
		});
		
		 if (status=='0'){
				alert('Gagal Update..!!');
				exit();
			} else {
		
			  alert('Data Terupdate...!!!');
			  section4();
			  exit();
			}
	}	
    

     function section4(){
         $(document).ready(function(){    
             $('#section4').click();                                               
         });
     }
     
        
    function openWindow(url)
    {
        var vnospp  =  $("#cspp").combogrid("getValue");
         
		        lc  =  "?nomerspp="+vnospp+"&kdskpd="+kode+"&jnsspp="+jns ;
        window.open(url+lc,'_blank');
        window.focus();
    }
    
        
    function detail_trans_3(){
        //alert(nomer);
        $(function(){
			$('#dg1').edatagrid({
				url: '<?php echo base_url(); ?>/index.php/tukd/select_data1_lpj',
                queryParams:({ lpj:nomer }),
                 idField:'idx',
                 toolbar:"#toolbar",              
                 rownumbers:"true", 
                 fitColumns:false,
                 autoRowHeight:"false",
                 singleSelect:"true",
                 nowrap:"true",
                 onLoadSuccess:function(data){ 
                 },	
                onSelect:function(rowIndex,rowData){
                kd  = rowIndex ;  
                idx =  rowData.idx ;                                           
                },
                 columns:[[
                     {field:'idx',
					 title:'idx',
					 width:100,
					 align:'left',
                     hidden:'true'
					 },               
                     {field:'no_bukti',
					 title:'No Bukti',
					 width:150,
					 align:'left'
					 },                                          
                     {field:'kdkegiatan',
					 title:'Kegiatan',
					 width:150,
					 align:'left'
					 },
					{field:'kdrek5',
					 title:'Rekening',
					 width:70,
					 align:'left'
					 },
					{field:'nmrek5',
					 title:'Nama Rekening',
					 width:280
					 },
                    {field:'nilai1',
					 title:'Nilai',
					 width:140,
                     align:'right'
                     }
				]]	
			});
		});
        }
  

    </script>
    
    <STYLE TYPE="text/css"> 
         input.right{ 
         text-align:right; 
         } 
    </STYLE> 

</head>
<body>

<div id="content">
<div id="accordion" style="width:970px;height=970px;" >
<h3><a href="#" id="section4" onclick="javascript:$('#spp').edatagrid('reload')">List Persetujuan LPJ </a></h3>
<div>
    <p align="right">  
                   
        <a class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="javascript:cari();">Cari</a>
        <input type="text" value="" id="txtcari"/>
        <table id="spp" title="List LPJ" style="width:910px;height:470px;" >  
        </table>
    </p> 
</div>

<h3><a href="#" id="section1">Persetujuan LPJ</a></h3>

   <div  style="height: 350px;">
   <p id="p1" style="font-size: x-large;color: red;"></p>
   <p>
 <fieldset style="width:850px;height:650px;border-color:white;border-style:hidden;border-spacing:0;padding:0;">  
 <table border='0' style="font-size:11px" >
  <tr>
    <td align="center">
		<div align="left">
			<a class="easyui-linkbutton" iconCls="icon-ok" id="setuju" plain="true" onclick="javascript:setuju();">Disetujui</a>
		</div>
	 </td>   
    <td align="center">
		<div align="center">
			<a class="easyui-linkbutton" iconCls="icon-cancel" id="batal" plain="true" onclick="javascript:batalsetuju();">Batal Persetujuan</a>
		</div>
	 </td>  	 
    <td colspan="2" align="center">
		<div align="right">
			<a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:section4();">Kembali</a>
		</div>
	 </td>    	 
  </tr>
  <tr >
		<td colspan="4" style="border-right-style:hidden;border-bottom-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;">&nbsp;</td>
  </tr>
  <tr>
	   <td width='20%'>No Persetujuan</td>
	   <td width='80%'><input type="text" name="no_stj" id="no_stj" readonly="true"/>	<input type="text" name="no_lpj" id="no_lpj" hidden="true"/></td>
	   <td width='20%'>Tanggal</td>
	   <td><input id="tglstju" name="tglstju" type="text" style="width:95px"/></td>   
  </tr>
 
 </table>
   
        <table id="dg1" title="Input Detail LPJ" style="width:900%;height:500%;" >  
        </table>
        
        <!--
        <div id="toolbar" align="right">
            <a class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:hapus_detail();">Hapus Detail</a>               		
        </div>
        -->
        
        <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;-->
         
        <table border='0' style="width:100%;height:5%;"> 
             <td width='34%'></td>
             <td width='35%'><input class="right" type="hidden" name="rektotal1" id="rektotal1"  style="width:140px" align="right" readonly="true" ></td>
             <td width='6%'><B>Total</B></td>
             <td width='25%'><input class="right" type="text" name="rektotal" id="rektotal"  style="width:140px" align="right" readonly="true" ></td>
        </table>

   </p>

</fieldset>     
</div>
</div>
</div> 



</body>
</html>