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
	<script src="<?php echo base_url(); ?>assets/sweetalert/lib/sweet-alert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/sweetalert/lib/sweet-alert.css">
     <style>    
    #tagih {
        position: relative;
        width: 500px;
        height: 70px;
        padding: 0.4em;
    }  
    </style>
    <script type="text/javascript">
    
    var kode  = '';
    var giat  = '';
    var jenis = '';
    var nomor = '';
	var nokas = '';
    var cid   = 0;
    var cekit = 0;    
	var sp2d  ='';
	var status_simpan='';
	var st=0;
	
    $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
                height: 650,
                width: 1000,
                modal: true,
                autoOpen:false                
            });           
        });    
     
	 
	function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    	$(function(){ 
		 $('#dg').edatagrid({
			url: '<?php echo base_url(); ?>/index.php/tukd/ambil_spm_oke',
			queryParams:({cari:kriteria})
			});        
     	});
    } 
	
	
	function setuju(){
		var rows = $('#dg').edatagrid('getSelections');
		var ntot=rows.length;

		 swal({
			title: "Proses Penyimpanan.....",
			text: "Tunggu Sebentar. . . . . . . . .",
			timer: 1500000000,
			showConfirmButton: false
		});
							
		for(var i=0; i<rows.length; i++){  

		    var no_spm  = rows[i].no_spm;
		 	 $(document).ready(function(){
                $.ajax({
                    type: "POST",    
                    dataType:'json',                    
                    data: ({no:no_spm,ntot:ntot,i:i}),
                    url: '<?php echo base_url(); ?>/index.php/tukd/update_setuju_Spd',
                    success:function(data){
						
						 status = data;
						 if(status==1){
							swal({
							  title: 'Berhasil Di Setujui..!!',
							  text: "Akan Menutup Dalam 2 Detik!!!",
							  confirmButtonColor: "#80C8FE",
							  type: "success",
							  timer: 3500,
							  confirmButtonText: "Ya",
							  showConfirmButton: true
							});
							$("#dg").datagrid("reload"); 
							$('#dg').datagrid('clearSelections');
						 }
                    }                                        
                });
            });
			
		}
		     $("#dg").datagrid("reload"); 
		 	$('#dg').datagrid('clearSelections');
	}
	
	
     $(function(){ 
     $('#dg').edatagrid({		
		url: '<?php echo base_url(); ?>/index.php/tukd/ambil_spm_oke',
		panelWidth:850, 
        idField:'id',            
        rownumbers:"true", 
  		autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
      	nowrap:"true",
		pagination	  : true,
		rownumbers    : true, 
		remoteSort	  : false,
		multiSort     : true,
		fitColumns    : false,
		singleSelect  : false,                    
        
		columns:[[
			{field:'ck',title:'ck',width:50,checkbox:true},
    	    {field:'no_spm',title:'Nomor SPM',width:200},
            {field:'tgl_spm',title:'Tanggal SPM',width:100},
			{field:'keperluan',title:'Uraian',width:220},       
			{field:'nilai1',title:'nilai',width:180,align:"right"},
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

     }); 

    </script>

</head>
<body>



<div id="content">    
<div id="accordion">
<h3><a href="#" id="section1" >Daftar SPM Yang Belum Disetujui</a></h3>
    <div>
    

<table>
<tr>
<td> 
      <a class="easyui-linkbutton" iconCls="icon-ok" id="setuju" plain="false" onclick="javascript:setuju();">Disetujui</a>  


&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <input type="text" value="" id="txtcari"/>       
            <a class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="javascript:cari();">Cari</a>
	</td>
</tr>
       
        <table id="dg" title="Daftar Nomor SPM Yang Belum Disetujui" style="width:870px;height:500px;" >  
        </table>                          
    </p> 
    </div>  
</div>
</div>

<?php $this->load->view('inc/jr-set.php'); ?>
</body>

</html>