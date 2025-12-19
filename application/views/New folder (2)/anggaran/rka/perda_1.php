<script>

    $(document).ready(function(){
        $(".link").click(function (){
            var cetakan  = $(this).attr("name");
			var cetakan1 = "<?php echo site_url(); ?>/rka/preview_perda1pdf";
			var cetakan2 = "<?php echo site_url(); ?>/rka/preview_perda1pdf";
			var cetakan3 = "<?php echo site_url(); ?>/rka/preview_perda1pdf_rinci";
			var cetakan4 = "<?php echo site_url(); ?>/rka/preview_perda1pdf_rinci";
							
            var halaman  = $("#hal").val();
            var cek = "";
            if($("#ttd").is(":checked")){
                cek = "y";
            }else{
                cek = "n";
            }
			if(cetakan=="1"){
				$(this).attr("href", cetakan1 + "/" + halaman + "/" + 1);
			}else if(cetakan=="2"){
				$(this).attr("href", cetakan2 + "/" + halaman + "/" + 2);
			}else if(cetakan=="3"){
				$(this).attr("href", cetakan3 + "/" + halaman + "/" + 1);
			}else if(cetakan=="4"){
				$(this).attr("href", cetakan4 + "/" + halaman + "/" + 2);
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
                    <a class="link" name ="3" href="" target='_blank'>
                        <img src="<?php echo base_url(); ?>assets/images/icon/print_pdf.png" width="25" height="23" title="cetak"/></a>
					 <a class="link" name ="4" href="" target='_blank'>
                        <img src="<?php echo base_url(); ?>assets/images/icon/excel.jpg" width="25" height="23" title="cetak"/></a>
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
                    <a name="" href="<?php echo site_url(); ?>/rka/preview_perda1_skpd/<?php echo $skpd->kd_skpd;?>/<?php echo '0';?>" ><img src="<?php echo base_url(); ?>assets/images/icon/print.png" width="25" height="23" title="cetak" /></a>
                    <a class="link" name="<?php echo site_url(); ?>/rka/preview_perda1_skpd/<?php echo $skpd->kd_skpd; ?>/<?php echo '1';?>" href="" target='_blank'><img src="<?php echo base_url(); ?>assets/images/icon/print_pdf.png" width="25" height="23" title="cetak"/></a>
                    <a href="<?php echo site_url(); ?>/rka/preview_perda1_skpd/<?php echo $skpd->kd_skpd; ?>/<?php echo '2';?>"><img src="<?php echo base_url(); ?>assets/images/icon/excel.jpg" width="25" height="23" title="cetak"/></a>
                </td>
                <td>                     
                    <a name="" href="<?php echo site_url(); ?>/rka/preview_perda1_skpd_rinci/<?php echo $skpd->kd_skpd;?>/<?php echo '0';?>" ><img src="<?php echo base_url(); ?>assets/images/icon/print.png" width="25" height="23" title="cetak" /></a>
                    <a class="link" name="<?php echo site_url(); ?>/rka/preview_perda1_skpd_rinci/<?php echo $skpd->kd_skpd; ?>/<?php echo '1';?>" href="" target='_blank'><img src="<?php echo base_url(); ?>assets/images/icon/print_pdf.png" width="25" height="23" title="cetak"/></a>
                    <a href="<?php echo site_url(); ?>/rka/preview_perda1_skpd_rinci/<?php echo $skpd->kd_skpd; ?>/<?php echo '2';?>"><img src="<?php echo base_url(); ?>assets/images/icon/excel.jpg" width="25" height="23" title="cetak"/></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        
        <?php echo $this->pagination->create_links(); ?> <span class="totalitem">Total Item <?php echo $total_rows ; ?></span>
        <div class="clear"></div>
</div>