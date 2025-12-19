<script>
 $(document).ready(function(){
        $(".link").click(function (){
            var cetakan  = $(this).attr("name");
            var halaman  = $("#hal").val();
            $(this).attr("href", cetakan + "/" + halaman);
            //return false;
        });
        
         $(".link1").click(function (){
            var cetakan  = $(this).attr("name");
            var halaman  = $("#hal").val();
            $(this).attr("href", cetakan + "/" + halaman);
            //return false;
        });

           $(".link2").click(function (){
            var cetakan  = $(this).attr("name");
            var halaman  = $("#hal").val();
            $(this).attr("href", cetakan + "/" + halaman);
            //return false;
        });
        
        
        
    });
</script>

    <div id="content">   
  
       
        <center><h1><?php echo $page_title; ?>&nbsp;&nbsp;&nbsp;&nbsp; </h1></center>
      
        <div style="font-size: 12px"><center>
            <form>
                <b>Halaman dimulai Dari :</b>
                <input style="background-color: yellow" type="text" name="hal" id="hal" value="1"/>
            </form></center>    
        </div><hr>
        
        
           <table  align="center" style="width: 100%">
            <tr>
                <td align="center">
                    <B>CETAK KESELURUHAN PENYUSUNAN</B>
                     <a class="link" name="<?php echo site_url(); ?>/rka/preview_proggiat_ubaha/2/" href="" target='_blank'>
                        <img src="<?php echo base_url(); ?>assets/images/icon/excel.jpg" width="25" height="23" title="cetak"/></a>
                  <a class="link" name="<?php echo site_url(); ?>/rka/preview_proggiat_ubaha/3/" href="" target='_blank'>
                        <img src="<?php echo base_url(); ?>assets/images/icon/word.jpg" width="25" height="23" title="cetak"/></a>
                </td>
            </tr>
        </table>
         <hr>
            <table  align="center" style="width: 100%">
            <tr>
                <td align="center">
                    <B>CETAK KESELURUHAN PERUBAHAN</B>
                     <a class="link1" name="<?php echo site_url(); ?>/rka/preview_proggiat_ubahB/2/" href="" target='_blank'>
                        <img src="<?php echo base_url(); ?>assets/images/icon/excel.jpg" width="25" height="23" title="cetak"/></a>
                  <a class="link1" name="<?php echo site_url(); ?>/rka/preview_proggiat_ubahB/3/" href="" target='_blank'>
                        <img src="<?php echo base_url(); ?>assets/images/icon/word.jpg" width="25" height="23" title="cetak"/></a>
                </td>
            </tr>
        </table><hr>

 <hr>
            <table  align="center" style="width: 100%">
            <tr>
                <td align="center">
                    <B>HANYA YANG BERUBAH</B>
                     <a class="link1" name="<?php echo site_url(); ?>/rka/preview_proggiat_ubahC/2/" href="" target='_blank'>
                        <img src="<?php echo base_url(); ?>assets/images/icon/excel.jpg" width="25" height="23" title="cetak"/></a>
                  <a class="link1" name="<?php echo site_url(); ?>/rka/preview_proggiat_ubahC/3/" href="" target='_blank'>
                        <img src="<?php echo base_url(); ?>assets/images/icon/word.jpg" width="25" height="23" title="cetak"/></a>
                </td>
            </tr>
        </table><hr>

        <?php echo form_open('rka/cari_prioritas', array('class' => 'basic')); ?>
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
                    
                    <a class="link" name="<?php echo site_url(); ?>/rka/preview_proggiat_ubah/1/<?php echo $skpd->kd_skpd; ?>" href="" target='_blank'><img src="<?php echo base_url(); ?>assets/images/icon/print_pdf.png" width="25" height="23" title="cetak pdf"/></a>
                    <a class="link" name="<?php echo site_url(); ?>/rka/preview_proggiat_ubah/2/<?php echo $skpd->kd_skpd; ?>" href="" target='_blank'><img src="<?php echo base_url(); ?>assets/images/icon/excel.jpg" width="25" height="23" title="cetak excel"/></a>
<a class="link" name="<?php echo site_url(); ?>/rka/preview_proggiat_ubah/3/<?php echo $skpd->kd_skpd; ?>" href="" target='_blank'><img src="<?php echo base_url(); ?>assets/images/icon/word.jpg" width="25" height="23" title="cetak WORD"/></a>
                </td>
                    </tr>
            <?php endforeach; ?>
        </table>
        <?php echo $this->pagination->create_links(); ?> <span class="totalitem">Total Item <?php echo $total_rows ; ?></span>
        <div class="clear"></div>
    </div>