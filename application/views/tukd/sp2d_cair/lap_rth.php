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
		/* $('#gskpd').hide(); */
		/* $('#gperiode').show(); */
        $('#gbulan').hide(); 
        $('#gtanggal').hide(); 
    });
	
	
    
    $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
                height: 400,
                width: 800            
            });  
    });   
    
	$(function(){
   	     $('#tanggal1').datebox({  
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
   	     $('#tanggal2').datebox({  
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


	function opt(val){
        if (val=='tgl'){
           $("#gtanggal").show();
           $("#gbulan").hide();
        } else if (val=='bln'){
           $("#gtanggal").hide();
           $("#gbulan").show();
        }else{
           $("#gtanggal").hide();
           $("#gbulan").hide();
        }
	}	

	//function openWindow( url ){

	//		var ctglctk  = $('#dcetak').datebox('getValue');
	//		var ctgl1	 = $('#tanggal1').datebox('getValue');
	//		var periode  = $('#periode').val();
    //    	var bulan    = $('#bulan').val();
	//		//var ttdd = $('#ttd').combogrid("getValue")

	//  		lc = '?periode='+periode+'&nilai1='+nilai1+'&tgl_ttd='+ctglctk;

	//		window.open(url+lc,'_blank');
	//		window.focus();
    // } 

 	function cek(nilai){
            
            var ctgl1	 = $('#tanggal1').datebox('getValue');
			var periode  = $('#periode').val();
			var bulan    = $('#bulan').val();
			var nilai1;

            
		    if (periode==''){
		      	alert('Pilih Periode Terlebih Dahulu');
                exit();
		        }else{
		            if(periode=='tgl'){
		                if (ctgl1==''){
		                   alert('Pilih Tanggal Terlebih Dahulu');
               			   return false;
		                } 
		                nilai1 = ctgl1;
		            }else if(periode=='bln'){
		                if (bulan==''){
		                    alert('Pilih Bulan Terlebih Dahulu');
               			    return false;
		                }
		                nilai1 = bulan;
		            }

		            cetak(nilai1,nilai);
		        }
		    }


    function cetak(nilai1,nilai)
        {
			//alert(nilai1);
            var ctglctk  = $('#dcetak').datebox('getValue');
            //alert(nilai);
			var ctgl1	 = $('#tanggal1').datebox('getValue');
			var periode  = $('#periode').val();
			var bulan    = $('#bulan').val();
			var spasi    = $('#spasi').val();
			var url    = "<?php echo site_url(); ?>/tukd/cetak_lap_rth";	  
			window.open(url+'/'+periode+'/'+ctglctk+'/'+nilai1+'/'+spasi+'/'+nilai, '_blank');
			window.focus();
        }

</script>
</head>

<body>
	<div id="content">
		<h3 align="center">CETAK REKAPITULASI TRANSAKSI HARIAN BELANJA (RTH)</h3>
			<div id="accordion">
				<p align="right">         
					<table id="sp2d" title="Cetak" style="width:922px;height:200px;">
						<tr>
							<td><b>Periode</td>
							<td ><select id='periode' style="width:110px;">
									<option value="">--Pilih--</option>
									<option onclick="opt(this.value)" value="tgl">Pertanggal</option>
									<option onclick="opt(this.value)"  value="bln">Perbulan</option>
								</select>
							</td>
						</tr>
							<tr id='gtanggal'>
								<td ><b>Tanggal</td>
								<td ><input type="text" name="" id="tanggal1" style="height:30px;width:110px;" value=""/></td>
							</tr>
							<tr id='gbulan'>
								<td ><b>Bulan</td>
								<td ><select id='bulan' style="width:110px;">
										<option value="">--Pilih--</option>
										<option value="1">Januari</option>
										<option value="2">Februari</option>
										<option value="3">Maret</option>
										<option value="4">April</option>
										<option value="5">Mei</option>
										<option value="6">Juni</option>
										<option value="7">Juli</option>
										<option value="8">Agustus</option>
										<option value="9">September</option>
										<option value="10">Oktober</option>
										<option value="11">November</option>
										<option value="12">Desember</option>
									</select>
								</td>
							</tr>
						<tr>
							<td ><b>Tanggal Cetak</td>
							<td ><input type="text" name="" id="dcetak" style="height:30px;width:110px;" value=""/></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="3" align="center">
                                <a class="easyui-linkbutton" iconCls="icon-print" plain="false" onclick="javascript:cek(nilai='1');" width="15" height="15" title="cetak"/>&nbsp;PREVIEW</a>
								<a class="easyui-linkbutton" iconCls="icon-pdf" plain="false" onclick="javascript:cek(nilai='2');" width="15" height="15" title="cetak"/>&nbsp;PDF</a>   								
                               <a class="easyui-linkbutton" iconCls="icon-excel" plain="false" onclick="javascript:cek(nilai='3');" width="15" height="15" title="cetak"/>&nbsp;EXCEL</a>
							</td>                
						</tr>
					</table>                      
				</p> 
			</div>
			<!--PENGATURAN CETAKAN-->  
        	<hr />  
        	*) Jika tanda tangan tidak pas, isi jumlah kolom untuk mengatur posisi tanda tangan.
        		<div id="accordion">
            		<input type="number" name="" id="spasi" style="width:50px;" value="0" onclick="javascript:select();" style="text-align: right;"/>&nbsp;&nbsp;Kolom
        		</div>
        	<hr />
	</div>
</body>
</html>