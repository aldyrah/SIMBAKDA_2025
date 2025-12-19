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
    <div id="content" > 
    	<h1><center><?php echo $page_title; ?></center> </h1>
		<hr>
        <div style="font-size: 12px"><center>
            <form>
                <b>Halaman dimulai Dari :</b>
                <input style="background-color: yellow" type="text" name="hal" id="hal" value="1"/>
            </form></center>	
        </div><hr>
        <?php echo form_open('rka/cari_perkada_ubaha', array('class' => 'basic')); ?>
		Karakter yang di cari :&nbsp;&nbsp;&nbsp;<input type="text" name="nm_skpd" id="nm_skpd" value="<?php echo set_value('text'); ?>" />
        <input type='submit' name='cari' value='cari' class='btn' />
        <?php echo form_close(); ?>   
		
		<?php if (  $this->session->flashdata('notify') <> "" ) : ?>
        <div class="success"><?php echo $this->session->flashdata('notify'); ?></div>
        <?php endif; ?>
    
        <table class="narrow">
        	<tr>
 	            <th>Kode SKPD </th>            	
                <th>Nama SKPD</th>                
                <th>Aksi</th>
            </tr>
            <?php foreach($list->result() as $skpd) : ?>
            <tr>                
                <td><?php echo $skpd->kd_skpd; ?></td>            	
                <td><?php echo $skpd->nm_skpd; ?></td>  
                <td>                     
                    <a href="<?php echo site_url(); ?>/rka/preview_perkada_ubahaa/<?php echo $skpd->kd_skpd;?>/<?php echo '0';?>" ><img src="<?php echo base_url(); ?>assets/images/icon/print.png" width="25" height="23" title="cetak" /></a>
                    <a class="link" name ="<?php echo site_url(); ?>/rka/preview_perkada_ubahaa/<?php echo $skpd->kd_skpd; ?>/<?php echo '1';?>" target='_blank'><img src="<?php echo base_url(); ?>assets/images/icon/print_pdf.png" width="25" height="23" title="cetak"/></a>
                    <a href="<?php echo site_url(); ?>/rka/preview_perkada_ubahaa/<?php echo $skpd->kd_skpd; ?>/<?php echo '2';?>"><img src="<?php echo base_url(); ?>assets/images/icon/excel.jpg" width="25" height="23" title="cetak"/></a></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php echo $this->pagination->create_links(); ?> <span class="totalitem">Total Item <?php echo $total_rows ; ?></span>
        <div class="clear"></div>
	</div>