<script>
   $(document).ready(function(){
		<?php foreach($list_ubah->result() as $kegiatan) : ?>
		var a="<?php echo $kegiatan->kd_skpd; ?>";
		<?php endforeach; ?>
	$(".link").click(function (){
			var cetakan  = $(this).attr("name");
			var skpd = a;
			var cetak ="1";
			var cetakan1 = "<?php echo site_url(); ?>/rka/preview_rka221_ubaha";
			
			if(cetakan=="1"){
				$(this).attr("href", cetakan1+ "/" + skpd+ "/" + cetak);
			}else{
				 $(this).attr("href", cetakan1+ "/" + skpd+ "/" + 2);
			}			
        });
		 });
</script>
	<div id="content">        
    	<h1><?php echo $page_title; ?><span><a href="<?php echo site_url(); ?>/rka/rka221_ubah">Kembali</a></span>
           <table style="width: 100%">
            <tr>
                <td>
                    cetak keseluruhan
                    <a class="link" name ="1" href=""target='_blank'>
                        <img src="<?php echo base_url(); ?>assets/images/icon/print_pdf.png" width="25" height="23" title="cetak"/></a>
                    <a class="link" name ="2" href=""target='_blank'>
                        <img src="<?php echo base_url(); ?>assets/images/icon/excel.jpg" width="25" height="23" title="export"/></a>
                </td>
            </tr>
        </table>
        
        </h1>

		
	 
        <table class="narrow">
        	<tr>
            	<th>Kode skpd</th>
                <th>Urusan</th>
                <th>Kegiatan</th>
                <th>Nama Kegiatan</th>
				<th>Penyusunan</th>
				<th>Perubahan</th>
                <th colspan="2" align="center">Aksi</th>
            </tr>
            <?php foreach($list_ubah->result() as $kegiatan) : ?>
            <tr>
            	<td><?php echo $kegiatan->kd_skpd; ?></td>
                <td><?php echo $kegiatan->kd_urusan; ?></td>
                <td><?php echo $kegiatan->giat; ?></td>
                <td><?php echo $kegiatan->nm_kegiatan; ?></td>
				<td align="right"><?php echo number_format($kegiatan->nilai,2,',','.'); ?></td>
				<td align="right"><?php echo number_format($kegiatan->nilai_ubah,2,',','.'); ?></td>
                <td><a href="<?php echo site_url(); ?>/rka/preview_rka221_ubah/<?php echo $kegiatan->kd_skpd; ?>/<?php echo $kegiatan->giat; ?>/1"target='_blank'><img src="<?php echo base_url(); ?>assets/images/icon/print_pdf.png" width="25" height="23" title="cetak"/></a></td>
				<td><a href="<?php echo site_url(); ?>/rka/preview_rka221_ubah/<?php echo $kegiatan->kd_skpd; ?>/<?php echo $kegiatan->giat; ?>/2"target='_blank'><img src="<?php echo base_url(); ?>assets/images/icon/excel.jpg" width="25" height="23" title="cetak"/></a></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php echo $this->pagination->create_links(); ?> <span class="totalitem">Total Item <?php echo $total_rows; ?></span>
        <div class="clear"></div>
	</div>