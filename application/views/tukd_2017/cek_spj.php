<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/demo/demo.css">
       <script type="text/javascript" src="<?php echo base_url(); ?>assets/autoCurrency.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/numberFormat.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.edatagrid.js"></script>
    <link href="<?php echo base_url(); ?>easyui/jquery-ui.css" rel="stylesheet" type="text/css"/>
    
    <script src="<?php echo base_url(); ?>assets/sweetalert/lib/sweet-alert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/sweetalert/lib/sweet-alert.css">
	
    
    
    <script src="<?php echo base_url(); ?>easyui/jquery-ui.min.js"></script>
    <script type="text/javascript"> 
	
    var nl =0;
	var tnl =0;
	var idx=0;
	var tidx=0;
	var oldRek=0;
    var rek=0;
	var nokas1='';
     $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
				height: 360,
				width: 900,
				modal: true,
				autoOpen:false,
			});
			$("#giat").hide();
			
			$("#div_skpd").hide();
			
			//$("#gaya").show();
			
        });
   
    $(function(){ 
     $('#sp2d').edatagrid({
		url: '<?php echo base_url(); ?>/index.php/tukd/cek_s',
 idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",

        columns:[[
			{field:'ck',
            title:'',
            checkbox:'true',
            width:40},
    	    {field:'kd',
    		title:'kode skpd',
    		width:15,sortable:"true"},
			{field:'nm',
    		title:'skpd',
    		width:90,sortable:"true"},
			{field:'c',
    		title:'TRANSAKSI TERAKHIR BULAN',
    		width:25,sortable:"true"},
		 {field:'detail',title:'CETAK SPJ',width:20,align:"center",
		 
                        formatter:function(value,rec){ 
                        return '<img src="<?php echo base_url(); ?>assets/images/icon/print_pdf.png" ondblclick="javascript:section3();" />';
                        }
                        },
        ]],
        onSelect:function(rowIndex,rowData){
          kd = rowData.kd;
          nm = rowData.nm;
		 c = rowData.c;
		                                                 
        },
        onDblClickRow:function(rowIndex,rowData){
          kd = rowData.kd;
          nm = rowData.nm;
		  		 c = rowData.c;
		  //section3();
        }
    });
    }); 
	
	 function cari(){
     var kriteria = document.getElementById("txtcari").value; 
        $(function(){ 
            $('#sp2d').edatagrid({
	       url: '<?php echo base_url(); ?>/index.php/tukd/cek_s',
          queryParams:({cari:kriteria})
        });        
     });
    }
	
	function section3(){
		//alert("bisa");
		url="<?php echo site_url(); ?>/akuntansi/cetak_spj_skpd/1";
		var apbd = 1;
        ctglttd         = "2016-12-31";
        var spasi       = 0;
        ckdskpd         = kd;
        ctgl1 =  12;
          
         lc = '?tgl1='+ctgl1+'&tgl_ttd='+ctglttd+'&skpd='+ckdskpd+'&spasi='+spasi+'&apbd='+apbd;	
	
	   window.open(url+lc,'_blank');
         window.focus();
		}
     
	 
	 
	 
	 
	 
	  function openWindow( url ){
      var apbd = document.getElementById('APBD').value;  
        ctglttd         = $('#tgl_ttd').datebox('getValue');
        var spasi       = document.getElementById('spasi').value;
        ckdskpd         = $('#skpd').combogrid('getValue');
        ctgl1 =  cbulan = $('#bulan').combogrid('getValue');
          
         lc = '?tgl1='+ctgl1+'&tgl_ttd='+ctglttd+'&skpd='+ckdskpd+'&spasi='+spasi+'&apbd='+apbd;
        
         window.open(url+lc,'_blank');
         window.focus();
         
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

<div id="accordion">

<h3><a href="#" id="section1" onclick="javascript:$('#sp2d').edatagrid('reload')">cek spj</a></h3>
    <div>
        <input type="text" value="" id="txtcari" onkeypress="javascript:cari();"/>
        <table id="sp2d" title="List SP2D" style="width:900px;height:500px;" >  
        </table>                      
    </p> 
    </div>


   
</div>
</div> 
<?php $this->load->view('inc/jr-set.php'); ?>
</body>
</html>