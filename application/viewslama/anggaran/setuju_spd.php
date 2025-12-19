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
            get_skpd();
        });    
     
	 
	    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    $(function(){ 
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>/index.php/rka/ambil_spd_oke',
        queryParams:({cari:kriteria})
        });        
     });
    } 
	
	
		function setuju(){
var rows = $('#dg').edatagrid('getSelections');
var ntot=rows.length;
//alert(ntot);

		  	swal({
title: "Proses penyimpanan.....",
text: "Tunggu Sebentar. . . . . . . . .",
timer: 1500000000,
showConfirmButton: false
});
							
		for(var i=0; i<rows.length; i++){  

		    var no_spd  = rows[i].no_spd;
		 	 $(document).ready(function(){
                $.ajax({
                    type: "POST",    
                    dataType:'json',                    
                    data: ({no:no_spd,ntot:ntot,i:i}),
                    url: '<?php echo base_url(); ?>/index.php/rka/update_setuju_Spd',
                    success:function(data){
						
						 status = data;
						 if(status==1){
                      swal({
  title: 'Tersimpan..!!',
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
			
			
		  
		  
		  
//		  alert(no_spd+"    "+i);
		}
		     $("#dg").datagrid("reload"); 
		 	$('#dg').datagrid('clearSelections');
	}
	
	
     $(function(){ 
     $('#dg').edatagrid({
		
		url: '<?php echo base_url(); ?>/index.php/rka/ambil_spd_oke',
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
			{field:'ck',        title:'ck',           checkbox:true},
    	    {field:'no_spd',
    		title:'Nomor SPD',
    		width:300},
            {field:'tgl_spd',
    		title:'Tanggal SPD',
    		width:90},            
            {field:'nm_skpd',
    		title:'SKPD',
    		width:180,
            align:"left"},
			{field:'nilai1',
    		title:'nilai',
    		width:150,
            align:"right"},
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

	 function get_skpd()
        {
        
        	$.ajax({
        	url: '<?php echo base_url(); ?>/index.php/rka/ambil_spd_oke',
        		type: "POST",
        		dataType:"json",                         
        		success:function(data){
        								$("#skpd").attr("value",data.kd_skpd);
        								$("#nmskpd").attr("value",data.nm_skpd);
										$("#npwp").attr("value",data.npwp);
        							  }                                     
        	});  
        }

    
 

    </script>

</head>
<body>



<div id="content">    
<div id="accordion">
<h3><a href="#" id="section1" >Daftar SPD Yang Belum Disetujui</a></h3>
    <div>
    

<table>
<tr>
<td> 
      <a class="easyui-linkbutton" iconCls="icon-ok" id="setuju" plain="false" onclick="javascript:setuju();">Disetujui</a>  
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
        <input type="text" value="" id="txtcari"/>       
            <a class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="javascript:cari();">Cari</a>
</td>


</tr>
    
     
       
        <table id="dg" title="List Terima Potongan" style="width:870px;height:500px;" >  
        </table>                          
    </p> 
    </div>   



   
</div>
</div>




<?php $this->load->view('inc/jr-set.php'); ?>
</body>

</html>