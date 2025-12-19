<script>

    $(document).ready(function(){
        $(".link").click(function (){
            var cetakan  = $(this).attr("name");
			var cetakan1 = "<?php echo site_url(); ?>/rka/preview_perkada1pdf_ubah";
			var cetakan2 = "<?php echo site_url(); ?>/rka/preview_perkada1pdf_ubah";
							
            var halaman  = $("#hal").val();
			if(cetakan=="1"){
				$(this).attr("href", cetakan1 + "/" +'keseluruhan'+ "/" + halaman + "/" + 1);
			}else if(cetakan=="2"){
				$(this).attr("href", cetakan2 + "/" +'keseluruhan'+ "/" + "/" + halaman + "/" + 2);
			}else{
				 $(this).attr("href", cetakan + "/" + halaman);
			}
            //return false;
        });
    });
	
	$(document).ready(function(){
        $(".link1").click(function (){
            var cetakan  = $(this).attr("name");
			var cetakan1 = "<?php echo site_url(); ?>/rka/preview_perkada1pdf_ubah_rinci";
			var cetakan2 = "<?php echo site_url(); ?>/rka/preview_perkada1pdf_ubah_rinci";
							
            var halaman  = $("#hal").val();
			if(cetakan=="1"){
				$(this).attr("href", cetakan1 + "/" +'keseluruhan'+ "/" + halaman + "/" + 1);
			}else if(cetakan=="2"){
				$(this).attr("href", cetakan2 + "/" +'keseluruhan'+ "/" + "/" + halaman + "/" + 2);
			}else{
				 $(this).attr("href", cetakan + "/" + halaman);
			}
            //return false;
        });
    });

</script>
<div id="content">      
   <h1>
     <center>   <?php echo $page_title; ?></center><hr>
        <div style="font-size: 12px">
			<center>
				<form>
					<b>Halaman dimulai Dari :</b>
					<input style="background-color: yellow" type="text" name="hal" id="hal" value="1"/>
				</form>
			</center>	
        </div><hr>
        <table style="width: 100%">
            <tr>
                <td>
                    cetak keseluruhan - Non Rincian
                    <a class="link" name ="1" href=""target='_blank'>
                        <img src="<?php echo base_url(); ?>assets/images/icon/print_pdf.png" width="25" height="23" title="cetak"/></a>
					<a class="link" name ="2" href=""target='_blank'>
                        <img src="<?php echo base_url(); ?>assets/images/icon/excel.jpg" width="25" height="23" title="cetak"/></a>

                </td>
				<td>
                    cetak keseluruhan - Rincian
                    <a class="link1" name ="1" href=""target='_blank'>
                        <img src="<?php echo base_url(); ?>assets/images/icon/print_pdf.png" width="25" height="23" title="cetak1"/></a>
					<a class="link1" name ="2" href=""target='_blank'>
                        <img src="<?php echo base_url(); ?>assets/images/icon/excel.jpg" width="25" height="23" title="cetak1"/></a>

                </td>
            </tr>
        </table>
   </h1>
       <?php echo form_open('rka/cari_perda1', array('class' => 'basic')); ?>
            Karakter yang di cari :&nbsp;&nbsp;&nbsp;
                <input type="text" name="nm_skpd" id="nm_skpd" value="<?php echo set_value('text'); ?>" />
                <input type='submit' name='cari' value='cari' class='btn' />  
        <?php echo form_close(); ?>   
                
        <?php if (  $this->session->flashdata('notify') <> "" ) : ?>
        <div class="success"><?php echo $this->session->flashdata('notify'); ?></div>
        <?php endif; ?>
    
        <table class="narrow">
        	<tr>
 	            <th>Kode SKPD </th>            	
                    <th>Nama SKPD</th>                
                    <th>Non Rincian</th>
                    <th>Rincian</th>
                </tr>
            <?php foreach($list->result() as $skpd) : ?>
            <tr>                
                <td><?php echo $skpd->kd_skpd; ?></td>            	
                <td><?php echo $skpd->nm_skpd; ?></td>  
                <td>                     
                    <a name="" href="<?php echo site_url(); ?>/rka/preview_perkada1pdf_ubah/<?php echo $skpd->kd_skpd;?>/<?php echo '1';?>/<?php echo '0';?>" ><img src="<?php echo base_url(); ?>assets/images/icon/print.png" width="25" height="23" title="cetak" /></a>
                    <a class="link" name="<?php echo site_url(); ?>/rka/preview_perkada1pdf_ubah/<?php echo $skpd->kd_skpd; ?>/<?php echo '1';?>/<?php echo '1';?>" href="" target='_blank'><img src="<?php echo base_url(); ?>assets/images/icon/print_pdf.png" width="25" height="23" title="cetak"/></a>
                    <a href="<?php echo site_url(); ?>/rka/preview_perkada1pdf_ubah/<?php echo $skpd->kd_skpd; ?>/<?php echo '1';?>/<?php echo '2';?>"><img src="<?php echo base_url(); ?>assets/images/icon/excel.jpg" width="25" height="23" title="cetak"/></a>
                </td>
				<td>                     
                    <a name="" href="<?php echo site_url(); ?>/rka/preview_perkada1pdf_ubah_rinci/<?php echo $skpd->kd_skpd;?>/<?php echo '1';?>/<?php echo '0';?>" ><img src="<?php echo base_url(); ?>assets/images/icon/print.png" width="25" height="23" title="cetak" /></a>
                    <a class="link1" name="<?php echo site_url(); ?>/rka/preview_perkada1pdf_ubah_rinci/<?php echo $skpd->kd_skpd; ?>/<?php echo '1';?>/<?php echo '1';?>" href="" target='_blank'><img src="<?php echo base_url(); ?>assets/images/icon/print_pdf.png" width="25" height="23" title="cetak"/></a>
                    <a href="<?php echo site_url(); ?>/rka/preview_perkada1pdf_ubah_rinci/<?php echo $skpd->kd_skpd; ?>/<?php echo '1';?>/<?php echo '2';?>"><img src="<?php echo base_url(); ?>assets/images/icon/excel.jpg" width="25" height="23" title="cetak"/></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        
        <?php echo $this->pagination->create_links(); ?> <span class="totalitem">Total Item <?php echo $total_rows ; ?></span>
        <div class="clear"></div>
</div>