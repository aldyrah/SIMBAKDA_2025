<script>
 $(document).ready(function(){
        $(".link").click(function (){
            var cetakan  = $(this).attr("name");
            var halaman  = $("#hal").val();
            $(this).attr("href", cetakan + "/" + halaman);
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
		<hr><center>
    <a class="link" name="<?php echo site_url(); ?>/rka/cek_kimpet" href="" target='_blank'><img src="<?php echo base_url(); ?>assets/images/icon/print_pdf.png" width="25" height="23" title="1. cek nilai po != trdrka || 2.cek no_trdrka strlen <=39 || 3.cek no_trdpo strlen <=39 || 4. cek no_trdrka di po not in di trdrka || 5.cek no_trdrka yang tidak ada di rekening"/></a></center>
</div>