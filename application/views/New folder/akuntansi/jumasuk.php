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
    
    <link href="<?php echo base_url(); ?>easyui/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo base_url(); ?>easyui/jquery-ui.min.js"></script>
   
    <script type="text/javascript"> 
    var nip='';
	var kdskpd='';
	var kdrek5='';
	$(function(){
	$('#sskpd').combogrid({  
		panelWidth:630,  
		idField:'kd_skpd',  
		textField:'kd_skpd',  
		mode:'remote',
		url:'<?php echo base_url(); ?>index.php/akuntansi/skpd',  
		columns:[[  
			{field:'kd_skpd',title:'Kode SKPD',width:100},  
			{field:'nm_skpd',title:'Nama SKPD',width:500}    
		]],
		onSelect:function(rowIndex,rowData){
			kdskpd = rowData.kd_skpd;
			$("#nmskpd").attr("value",rowData.nm_skpd);
			$("#skpd").attr("value",rowData.kd_skpd);
			//validate_giat();
		}  
		}); 
	});
	

    $(function(){
   	     $('#dcetak').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });
   	});

    $(function(){
   	     $('#dcetak2').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });
   	});
	

   $(function(){
	$('#ttd').combogrid({  
		panelWidth:500,  
		url: '<?php echo base_url(); ?>/index.php/tukd/list_ttd',  
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


		function cetakjumasuk()
        {
			var dcetak = $('#dcetak').datebox('getValue');      
			var dcetak2 = $('#dcetak2').datebox('getValue');      
			var ttd    = nip; 
			var skpd   = kdskpd; 

			var url    = "<?php echo site_url(); ?>/akuntansi/ctk_jumasuk";  
			window.open(url+'/'+dcetak+'/'+ttd+'/'+skpd+'/'+dcetak2, '_blank');
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

<h3>JURNAL PENERIMAAN KAS</h3>
    <div>
    <p align="right">         
        <table id="sp2d" title="Cetak Buku Besar" style="width:870px;height:300px;" >  
		<tr >
			<td width="20%" height="40" ><B>SKPD</B></td>
			<td width="80%"><input id="sskpd" name="sskpd" style="width: 150px;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="nmskpd" name="nmskpd" style="width: 500px; border:0;" /></td>
		</tr>

		<tr >
			<td width="20%" height="40" ><B>PERIODE</B></td>
			<td width="80%"><input id="dcetak" name="dcetak" type="text"  style="width:155px" />&nbsp;&nbsp;s/d&nbsp;&nbsp;<input id="dcetak2" name="dcetak2" type="text"  style="width:155px" /></td>
		</tr>
		<tr >
			<td width="20%" height="40" ><B>PENANDA TANGAN</B></td>
			<td wid˜­U‘¢¼[˜#žki7i`\+è¿áP©©+¬m5ËÐ‚ÞVET¸Ô<ˆ`Å¹ò®_êjº&“Àb“å"ÚI²Ó&î¹'ùÒqbMY¾Ot‚vH’‰¤C<åÉM¹cÝÈdÇøÔêÍå8f—÷Hã`#±95÷½ó
nÒM—vµ˜f´gŸi1KÈ;‘Ú¬	{i!E;ófWRÛªŽžõ´)Ù¶ÎÝ¶-›U¹™Òêã0
²§;›° ôŠÙ²µŽÞ‚wc-µ£"·<m=Z¥J4¡ærIKµ¹nkV24N±G')	R’w­Í¶æ‘›÷­ …!ˆíuôzçsöŠÌéåI¹nlCköfmî³3ão”åÉÈþ!]ï†æ–ÚG‚!PävÀZ¥x¦Ž¤¢©Fç¥Gs×CÍ3¢;Î$*z„†³§¿[Y®$p¾Iù"—gíjç ÜggÔ*Eò¸ž¿á=RG±]´_i¸„<qÌ«ž„Æ»¶™BIlþZ¼Pƒ+à$ŽŠ+ÐåösægÎM^m#Ê|W$r0·¡g
Hš$ù†z†úW†ø‹G„F