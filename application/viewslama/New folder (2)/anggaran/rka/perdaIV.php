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
 $(document).ready(function(){
        $(".link").click(function (){
			var cetak1  = "<?php echo site_url(); ?>/rka/preview_perdaIVpdf"; //cetak keseluruhan pdf
			var cetak2  = "<?php echo site_url(); ?>/rka/preview_perdaIVIpdf"; //cetak per skpd pdf
			var cetak3	= "<?php echo site_url(); ?>/rka/preview_perdaIVIIpdf"; // cetak sumberdana pdf	
			var cskpd   = $("#skpd").combogrid("getValue");		
			var cdana   = $("#dana").combogrid("getValue");
            var cetakan  = $(this).attr("name");
            var halaman  = $("#hal").val();
			
			if (cetakan==1){
				$(this).attr("href", cetak1 + "/" + halaman + "/" + 1); //keseluruhan pdf
			}else if (cetakan==11){
				$(this).attr("href", cetak1 + "/" + halaman + "/" + 2); //keseluruhan excel
			}else if(cetakan==2){
				if(cskpd==''){
					alert('Silahkan Pilih SKPD Terlebih Dahulu..!');
				}else{
					$(this).attr("href", cetak2 + "/" + halaman + "/" + cskpd + "/" + 1); //Per-SKPD pdf
				}
			}else if(cetakan==22){
				if(cskpd==''){
					alert('Silahkan Pilih SKPD Terlebih Dahulu..!');
				}else{
					$(this).attr("href", cetak2 + "/" + halaman + "/" + cskpd + "/" + 2); //Per-SKPD excel	
				}
			}else if (cetakan==3){
				if(cdana !=''){
					//$(this).attr("href", cetak3 + "/" + halaman + "/" + cskpd + "/" + cdana + "/" + 1); //Per-SumberDana pdf
					
					
					lc= '?halaman='+halaman+'&cskpd='+cskpd+'&cdana='+cdana+'&ctk=1'; 
					window.open(cetak3+lc, '_blank');
			window.focus();
					
					
					
					
				}else{						
					alert('Silahkan Pilih SKPD & Sumber Dana Terlebih Dahulu..!');
				}
			}else if(cetakan==33){
				if(cdana !=''){
					//$(this).attr("href", cetak3 + "/" + halaman + "/" + cskpd + "/" + cdana + "/" + 2); //Per-SumberDana excel
					
						lc= '?halaman='+halaman+'&cskpd='+cskpd+'&cdana='+cdana+'&ctk=2'; 
					window.open(cetak3+lc, '_blank');
			window.focus();
				}else{
					alert('Silahkan Pilih SKPD & Sumber Dana Terlebih Dahulu..!');
				}
			}
				
           
            //return false;
        });
    });

	
	
$(function(){
	$('#skpd').combogrid({  
       panelWidth:500,  
       idField:'kd_skpd',  
       textField:'kd_skpd',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/rka/skpd_l4',  
       columns:[[  
           {field:'kd_skpd',title:'Kode SKPD',width:100},  
           {field:'nm_skpd',title:'Nama SKPD',width:400}    
       ]]
	 });
}); 

$(function(){
	$('#dana').combogrid({  
       panelWidth:500,  
       idField:'nm_sdana',  
       textField:'nm_sdana',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/rka/dana_l4',  
       columns:[[  
           {field:'kd_sdana',title:'Kode Dana',width:100},  
           {field:'nm_sdana',title:'Nama Dana',width:400}    
       ]]
	 });
}); 

</script>

<div id="content">
	<center><h1>CETAK PERDA APBD LAMPIRAN IV</h1></center>
	<hr>
        <div style="font-size: 12px">
		<center>
            <form>
                <b>Halaman dimulai Dari :</b>
					<input style="background-color: yellow" type="text" name="hal" id="hal" value="1"/>
            </form>
		</center>
		</div>
	<hr>
		<table border="0" width="100%">
			<tr>
				<td align="left" width="20%">
					<b>CETAK KESELURUHAN</b>&nbsp;<br>
					<a class="link" name="1" target='_blank'>
						<img src="<?php echo base_url(); ?>assets/images/icon/print_pdf.png" width="25" height="23" title="cetak keseluruhan pdf"/>
					</a>
					<a class="link" name="11" target='_blank'>
						<img src="<?php echo base_url(); ?>assets/images/icon/excel.jpg" width="25" height="23" title="cetak keseluruhan excel"/>
					</a>
				<td>
				<td align="right" width="40%">
					<b>CETAK PER-SKPD</b>&nbsp;<br>				
					<b>Pilih SKPD : </b>&nbsp;&nbsp;<input id="skpd" name="skpd" style="width: 100px;" />&nbsp;<br>
					<a class="link" name="2" target='_blank'>
						<img src="<?php echo base_url(); ?>assets/images/icon/print_pdf.png" width="25" height="23" title="cetak per skpd"/>
					</a>
					<a class="link" name="22" target='_blank'>
						<img src="<?php echo base_url(); ?>assets/images/icon/excel.jpg" width="25" height="23" title="cetak per-skpd excel"/>
					</a>					
				<td>
				<td align="right" width="40%">
					<b>CETAK PER SUMBER DANA</b>&nbsp;<br>				
					<b>Pilih Sumber Dana : </b>&nbsp;&nbsp;<input id="dana" name="skpd" style="width: 200px;" />&nbsp;<br>					
					<a class="link" name="3" target='_blank'>
						<img src="<?php echo base_url(); ?>assets/images/icon/print_pdf.png" width="25" height="23" title="cetak per-sumber dana pdf"/>
					</a>
					<a class="link" name="33" target='_blank'>
						<img src="<?php echo base_url(); ?>assets/images/icon/excel.jpg" width="25" height="23" title="cetak per-sumber dana excel"/>
					</a>					
				</td>
			</tr>
		</table>
        
    <!--<div class="scroll">
    <?php
        echo $prev;
    ?>
    </div>-->
</div>
</head>