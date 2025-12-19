<script>
 $(document).ready(function(){
        $(".link").click(function (){
            var cetakan  = $(this).attr("name");
			var cetakan1 = "<?php echo site_url(); ?>/rka/preview_perdaIIpdf";
            var halaman  = $("#hal").val();
			if(cetakan=="1"){
				$(this).attr("href", cetakan1 + "/" + halaman + "/" + 1);
			}else if(cetakan=="2"){
				$(this).attr("href", cetakan1 + "/" + halaman + "/" + 2);
			}else{
				$(this).attr("href", cetakan + "/" + halaman);
			}
            //return false;
        });
    });
</script>

<div id="content">
<center><h1>CETAK PERDA APBD LAMPIRAN II</h1></center>
	   <hr>
        <div style="font-size: 12px"><center>
            <form>
                <b>Halaman dimulai Dari :</b>
                <input style="background-color: yellow" type="text" name="hal" id="hal" value="1"/>
            </form></center>	
        </div>
		<hr>
    <a class="link" name="1" href="" target='_blank'><img src="<?php echo base_url(); ?>assets/images/icon/print_pdf.png" width="25" height="23" title="cetak"/></a>
	 <a class="link" name="2" href="" target='_blank'><img src="<?php echo base_url(); ?>assets/images/icon/excel.jpg" width="25" height="23" title="cetak excel"/></a>
    <div class="scroll">
    <?php
    //header("Cache-Control: no-cache, no-store, must-revalidate");
    //header("Content-Type: application/vnd.ms-excel");
    //header("Content-Disposition: attachment; filename=laporan_rinci_skpd.xls");
        echo $prev;
    ?>
    </div>
</div>