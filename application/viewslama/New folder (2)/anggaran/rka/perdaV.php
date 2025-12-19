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
	<hr>
        <div style="font-size: 12px"><center>
            <form>
                <b>Halaman dimulai Dari :</b>
                <input style="background-color: yellow" type="text" name="hal" id="hal" value="1"/>
            </form></center>	
        </div>
	<hr>

    <a class="link" name="<?php echo site_url(); ?>/rka/preview_perdaVpdf" href="" target='_blank'><img src="<?php echo base_url(); ?>assets/images/icon/print_pdf.png" width="25" height="23" title="cetak"/></a>
    <div class="scroll">
    <?php
   
        echo $prev;
    ?>
    </div>
</div>