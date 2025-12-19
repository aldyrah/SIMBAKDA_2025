
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/demo/demo.css">
    <script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery-1.8.0.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.edatagrid.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/autoCurrency.js"></script>    
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/numberFormat.js"></script>    
    <link href="<?php echo base_url(); ?>easyui/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo base_url(); ?>easyui/jquery-ui.min.js"></script>
<script>
 $(document).ready(function(){
        $(".link").click(function (){
            var cetakan  = $(this).attr("name");
            var halaman  = $("#hal").val();
            $(this).attr("href", cetakan + "/" + halaman);
            //return false;
        });
    });
    
      function tes(){
       //alert("aaaaaaaa")
       var url    = "<?php echo site_url(); ?>/rka/prog_giat_ubah";  
       window.open(url);
            window.focus();
    }
    
</script>

    <div id="content">      
        <center><h1><?php echo $page_title; ?>&nbsp;&nbsp;&nbsp;&nbsp; </h1></center>
       <hr>
        <div style="font-size: 12px"><center>
               <a class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="javascript:tes();">BUKA FORM UBAH</a>   <BR /><BR />
               
               <form>
                <b>Halaman dimulai Dari :</b>
                <input style="background-color: yellow" type="text" name="hal" id="hal" value="1"/>
            </form></center>    
        </div><hr>
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
                    
                    <a class="link" name="<?php echo site_url(); ?>/rka/preview_proggiat/1/<?php echo $skpd->kd_skpd; ?>" href="" target='_blank'><img src="<?php echo base_url(); ?>assets/images/icon/print_pdf.png" width="25" height="23" title="cetak pdf"/></a>
                                        <a class="link" name="<?php echo site_url(); ?>/rka/preview_proggiat/2/<?php echo $skpd->kd_skpd; ?>" href="" target='_blank'><img src="<?php echo base_url(); ?>assets/images/icon/excel.jpg" width="25" height="23" title="cetak excel"/></a></td>
                    </tr>
            <?php endforeach; ?>
        </table>
        <?php echo $this->pagination->create_links(); ?> <span class="totalitem">Total Item <?php echo $total_rows ; ?></span>
        <div class="clear"></div>
    </div>