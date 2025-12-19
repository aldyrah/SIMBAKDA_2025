<script src="<?php echo base_url(); ?>lib/sweet-alert.min.js"></script>
<link   rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>lib/sweet-alert.css">
<script type="text/javascript">
    
    var kdwil= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
    var ctk = '';
                         
    function opt(val){        
        ctk = val; 
        if (ctk=='1'){
            $("#per_tahun").show();
        } else if (ctk=='2'){
            $("#per_tahun").hide();
        }else {
            exit();
        }                 
    }
           
	function openWindow($cek){
		var cpilih	= $cek;
		var tahun	 = document.getElementById("tahun").value; 
		var tahun2	 = document.getElementById("tahun2").value; 
		var lctgl2 	= $('#tgl_cetak').datebox('getValue');
		var cjenis	= ''; 
		var cnmjenis = ''; 
		if (lctgl2 ==''){
			swal({
			title: "Error!",
			text: "MOHON DILENGKAPI TGL CETAK.!!",
			type: "error",
			confirmButtonText: "OK"
			});
			exit();
		}
		var url		= "<?php echo site_url(); ?>/laporan_inventaris/lap_rekap_kib";
		iz = '?tahun='+tahun+'&tahun2='+tahun2+'&lctgl2='+lctgl2+'&fa='+cpilih;
		window.open(url+iz,'_blank');
		window.focus();
	
	} 
 
       
    $(function(){  
         $('#tgl_cetak').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });
		$('#tgl_cetak').datebox('setValue','<?php echo date('Y-m-d')?>');
    }); 
  
  
   </script>



<div id="content1"> 
    <h3 align="center"><b>CETAK LAPORAN<br>
    REKAPITULASI KARTU INVENTARIS BARANG (KOMPILASI)</b></h3>
    <fieldset>
     <table align="center" style="width:100%;" border="0">
           <tr>
                <td><input type="radio" name="cetak" value="1" onclick="opt(this.value)" />PER TAHUN &ensp;</td>
                <td><input type="radio" name="cetak" value="2" id="status" onclick="opt(this.value)" />SEMUA&ensp;</td>
            </tr>
            <tr>
                <td colspan="3">
                <div id="per_tahun">
                        <table style="width:50%;" border="0">
                            <td align="right">Tahun Awal <select id="tahun" class="select" style="width:80px;">
							<option value='' selected></option>					
							<?php
							$th=date("Y");
							for($i=$th;$i>=$th-100;$i--){
							echo "<option value='$i'>$i</option>";					
							}					
							?>
							</select>
							</td> 
                            <td width="1%"><b>&ensp;S/D&ensp;</b></td>
                            <td>Tahun Akhir <select id="tahun2" class="select" style="width:80px;">
								<option value='' selected></option>					
								<?php
									$th=date("Y");
									for($i=$th;$i>=$th-100;$i--){
										echo "<option value='$i'>$i</option>";					
									}					
								?>
							</select>
							</td> 
                        </table>
                </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                <div id="div_tgl">
                    <table style="width:100%;" border="0">
                        <td width="15%">TANGGAL CETAK</td>
                        <td width="1%">:</td>
                        <td><input type="text" id="tgl_cetak" style="width: 140px;" /></td>  
                    </table>
                </div>
                </td> 
                
            </tr>
            
            <td colspan="3">&nbsp;</td> 
            <tr>
                <td colspan="3" align="center">
                <a  class="easyui-linkbutton" iconCls="icon-pdf" plain="true"  onclick="javascript:openWindow(1);">Cetak Pdf</a>
                <a  class="easyui-linkbutton" iconCls="icon-excel" plain="true" onclick="javascript:openWindow(2);">Cetak Excel</a>
                <a  class="easyui-linkbutton" iconCls="icon-word" plain="true" onclick="javascript:openWindow(3);">Cetak Word</a>
		        <a href="<?php echo base_url();?>" class="easyui-linkbutton" iconCls="icon-undo" plain="true">Keluar</a>
                </td>                
            </tr>
        </table>  
            
    </fieldset>  
</div>