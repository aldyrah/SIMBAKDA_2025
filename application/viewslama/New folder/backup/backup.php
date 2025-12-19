
<script type="text/javascript">
	var jumlahq=0;
	var secsx;
	var timerIDx = null;
	var timerRunningx = false;
	var delayx = 200;
	var idx = 0;
	var totx = 0;




	function backup(){
		var ckode=1;
		$(document).ready(function(){
			$.ajax({
				type: "POST",
				url: '<?php echo base_url(); ?>/index.php/utilitas/backup',
				data: ({kode:ckode}),
				dataType:"json",
				success:function(data){
					var url=data.hasil;
					window.open(url,'_blank');
				}
			});
		});                                            
	}	


	function uploadktp(){
		var imgfile = document.getElementById("fktp");  
		var namafile = 'res_data';  
		formdata = new FormData(); 
		formdata.append("fktp",imgfile.files[0]);
		var ckode=1;
		$.ajax({  
			url: "<?php echo base_url(); ?>index.php/utilitas/do_upload/"+namafile,  
			type: "POST",  
			data: formdata,  
			dataType: "json",
			processData: false,  
			contentType: false,  
			success: function (data){  
					//alert(data.file_name); 
					//alert('ok');
			}  
		});  
	}


	function jumquery(){
		var ckode=1;
		var jq=0;
		$(document).ready(function(){
			$.ajax({
				type: "POST",
				url: '<?php echo base_url(); ?>/index.php/utilitas/get_jumquery',
				data: ({kode:ckode}),
				dataType:"json",
				success:function(data){
					jumlahq=(data.hasil)-2;		
					//alert(jumlahq);
					if (jumlahq>0)
					{
						InitializeTimerx(jumlahq); 
						StartTheTimerx();
					}
				
				}
			});
		});           
	}


	function restore(j){


		$(document).ready(function(){
			$.ajax({
				type: "POST",
				url: '<?php echo base_url(); ?>/index.php/utilitas/proses_query',
				data: ({nomor:j}),
				dataType:"json",
				success:function(data){
					//document.getElementById('progres').value=idx;
					document.getElementById('progres').value='Proses Ke : '+(data.hasil)+' Dari :'+jumlahq;
					if (data.hasil==jumlahq)
					{
						alert('Proses Restore Selesai');
					}
				}
			});
		});           

	}





	function InitializeTimerx(total){
		secsx = 1;
		idx = 0;
		totx=total;

		StopTheClockx();
		StartTheTimerx();
	}

	function StopTheClockx(){
		if(timerRunningx)
		clearTimeout(timerIDx);
		timerRunningx = false;
	}

	function StartTheTimerx(){
		if (secsx==0){
			StopTheClockx();

			secsx = 1;
			timerIDx = self.setTimeout("StartTheTimerx()", delayx);

			//fungsi disini---------------------------------------

				restore(idx);
				idx=(idx*1)+1;
				//looping(idx-1,kons,persen,idx1);
			//----------------------------------------------------

			timerRunningx = true;
			if (idx>=totx){
				clearTimeout(timerIDx);
			}

		}else{
			self.status = secsx;
			secsx = secsx - 1;
			timerRunningx = true;
			timerIDx = self.setTimeout("StartTheTimerx()", delayx);
		}
	}


</script>



<div id="content">
<table  width="100%">
<tr>
	<td align="center">
		<h1><?php echo $status_upload ?>&nbsp;&nbsp;&nbsp;<input type="text" name="progres" id="progres" style="width:200px;text-align:center"></h1>
	</td>
</tr>
</table>
<table  width="100%">
<tr>
	<td align="left">
		BACKUP
	</td>
	<td align="left">
		<input type="button"  name="backup" value="Backup Database" onclick="backup()">
	</td>
</tr>
<tr>	
	<td align="left">
		RESTORE
	</td>
	<td align="left">

	<form method="post" action="<?php echo base_url(); ?>index.php/utilitas/do_upload"  enctype="multipart/form-data">
		<input type="file" name="datasql" size="100000"><br><input type="submit" value="Upload Data"> <input type="button" value="Restore" onclick="jumquery()">		
	</form>
	
	</td>
</tr>

</table>
</div>
