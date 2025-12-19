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
  <style>    
    #tagih {
        position: relative;
        width: 922px;
        height: 100px;
        padding: 0.4em;
    }  
    </style>
    <script type="text/javascript"> 
	var rec=0;
	var cek=0;
	var cek_tabel='';


	function AddItems(isi,pesan){
		var mySel = document.getElementById("isidata"); 
		var myOption; 

		myOption = document.createElement("Option"); 
		myOption.text = isi; 
		myOption.value = isi; 
		if(pesan =='0'){
			myOption.style = 'color:white;font-family:courier new;'; 
		}else if(pesan=='1'){
			myOption.style = 'color:red;font-family:courier new;'; 			
		}else if(pesan=='2'){
			myOption.style = 'color:#05E405;font-family:courier new;';
		}
		mySel.add(myOption);			
		bawah();
	}

	function bawah() {
		var objDiv = document.getElementById("isidata");
		objDiv.scrollTop = objDiv.scrollHeight;
		return false;
	}
	
	function record(ctabel){	
		
			$(document).ready(function(){
				$.ajax({
					type: "POST",
					url: '<?php echo base_url(); ?>/index.php/syncron/hitrecord_cleo',
					data: ({tabel:ctabel}),
					dataType:"json",
					success:function(data){
						rec=data.jumlah;
						isi_list(rec,ctabel);	
						//alert(rec);
					}
				});
			});  
		}

		function isi_list(rec,ctabel){
			if (rec>0){
				var a=0;
				for (var i=1;i<=rec ;i++ )
				{
					  setTimeout(function(){
							ambil_baris(a,ctabel,rec);
							a++;
					  },200*i);
				}
			}else if(rec=='out'){
				AddItems('Request Time Out...................................................................................................error 10060','1');
				lanjut('0',ctabel);
			}else{
				AddItems('Data tabel '+ctabel+' tidak ditemukan ','1');
				lanjut('0',ctabel);
			}
		}

	function ambil_baris(cbaris,ctabel,rec){
			var alamat='<?php echo base_url(); ?>/index.php/syncron/cek_syncron_cleo';
			$(document).ready(function(){
				$.ajax({
					type: "POST",
					url: alamat,
					data: ({baris:cbaris,tabel:ctabel}),
					dataType:"json",
					success:function(data){
							AddItems(data.isi,data.pesan);
							if (rec==data.baris){
								AddItems('Sinkronisasi tabel '+ctabel+' selesai ','2');
								lanjut(data.baris,ctabel);
							}
							 
					}
				});
			});        		
		
		}
     //tambahkan atau kurangi database yang akan ditransfer
	function lanjut(cek,cek_tabel){
		if(cek==rec)
		{
			if(cek_tabel=='trdspd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trhrka ke  Client (siadinda)','2');
				record('trhrka');	
			}else if(cek_tabel=='trhrka'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trhspd ke  Client (siadinda)','2');
				record('trhspd');	
			}else if(cek_tabel=='trhspd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trhspp ke  Client (siadinda)','2');
				record('trhspp');	
			}else if(cek_tabel=='trhspp'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trdspp ke  Client (siadinda)','2');
				record('trdspp');	
			}else if(cek_tabel=='trdspp'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trhspm ke   Client (siadinda)','2');
				record('trhspm');	
			}else if(cek_tabel=='trhspm'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trhsp2d ke  Client (siadinda)','2');
				record('trhsp2d');	
			}else if(cek_tabel=='trhsp2d'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trdju ke  Client (siadinda)','2');
				record('trdju');	
			}else if(cek_tabel=='trdju'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trdju_pkd ke  Client (siadinda)','2');
				record('trdju_pkd');	
			}else if(cek_tabel=='trdju_pkd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trhju_pkd ke  Client (siadinda)','2');
				record('trhju_pkd');	
			}else if(cek_tabel=='trhju_pkd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trdju_ppkd ke  Client (siadinda)','2');
				record('trdju_ppkd');	
			}else if(cek_tabel=='trdju_ppkd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trhju_ppkd ke  Client (siadinda)','2');
				record('trhju_ppkd');	
			}else if(cek_tabel=='trhju_ppkd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trhkasout_pkd ke  Client (siadinda)','2');
				record('trhkasout_pkd');	
			}else if(cek_tabel=='trhkasout_pkd'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trhtransout ke  Client (siadinda)','2');
				record('trhtransout');	
			}else if(cek_tabel=='trhtransout'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trdtransout ke  Client (siadinda)','2');
				record('trdtransout');	
			}else if(cek_tabel=='trdtransout'){
				document.getElementById('isidata').innerHTML = "";
				AddItems('Sinkronisasi Data trhju ke Client (siadinda)','2');
				record('trhju');	
			}
		}
	}
	function apbd(){
			document.getElementById('isidata').innerHTML = "";
			AddItems('Sinkronisasi Data trdspd ke Client (siadinda)','2');
			record('trdspd');
			
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

<h3 align="center">SYNCRONIZE DATA TO SIADINDA</h3>
	<select name="isidata" id="isidata" multiple="multiple" style="width:100%;height:300px;background-color:#000000;border:0px" disabled>
	</select>
	<table width="100%">
		<tr align="center">
			<td  > 
			<INPUT TYPE="button" VALUE="PROSES" style="height:30px;width:80px" onclick="javascript:apbd();" >
			</td>
		</tr>
	</table>
</div>
</body>
</html>
