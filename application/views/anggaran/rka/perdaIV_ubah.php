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



    $(document).ready(function(){
        $(".link2").click(function (){
            var cdana   = $("#dana").combogrid("getValue");
            var cetakan  = $(this).attr("name");
            var halaman  = $("#hal").val();
            var cskpd='';
           // $(this).attr("href", cetakan + "/" + halaman);
    var cetak3  = "<?php echo site_url(); ?>/rka/preview_perdaIVIIpdfubah"; // cetak sumberdana pdf 



if(cdana !=''){


                    if(cetakan==3){
                    lc= '?halaman='+halaman+'&cskpd='+cskpd+'&cdana='+cdana+'&ctk=1'; 
                    }else{
                        lc= '?halaman='+halaman+'&cskpd='+cskpd+'&cdana='+cdana+'&ctk=2';   
                    }


                    window.open(cetak3+lc, '_blank');
            window.focus();
                    
                    
                    
                    
                }else{                      
                    alert('Silahkan Pilih Sumber Dana Terlebih Dahulu..!');
                }

        });
    });



$(function(){
    $('#dana').combogrid({  
       panelWidth:500,  
       idField:'nm_sdana',  
       textField:'nm_sdana',  
       mode:'remote',
       url:'<?php echo base_url(); ?>index.php/rka/dana_l4',  
       columns:[[  
           {field:'kd_sdana',title:'Kode Dana',width:100},  
           {field:'nm_sdana',title:'Nama Dana',width:400}    
       ]]
     });
}); 

</script>

<div id="content">

<div style="font-size: 12px"><center>
            <form>
                <b>Halaman dimulai Dari :</b>
                <input style="background-color: yellow" type="text" name="hal" id="hal" value="1"/>
            </form></center>    
        </div>
<table>
<tr>
<td><b>CETAK KESELURUHAN </b><br>

<a class="link" name ="<?php echo site_url(); ?>/rka/preview_perdaIV_ubah/1" target='_blank'><img src="<?php echo base_url(); ?>assets/images/icon/print_pdf.png" width="25" height="23" title="cetak"/></a>
<a href="<?php echo site_url(); ?>/rka/preview_perdaIV_ubah/2"><img src="<?php echo base_url(); ?>assets/images/icon/excel.jpg" width="25" height="23" title="cetak"/></a>                    
    <a href="<?php echo site_url(); ?>/rka/preview_perdaIV_ubah/3"><img src="<?php echo base_url(); ?>assets/images/icon/word.jpg" width="25" height="23" title="cetak"/></a>
    </td>
    
    
    
    
    
    <td align="right" width="40%">
                    <b>CETAK PER SUMBER DANA</b>&nbsp;<br>              
                    <b>Pilih Sumber Dana : </b>&nbsp;&nbsp;<input id="dana" name="skpd" style="width: 200px;" />&nbsp;<br>                  


<a class="link2" name="3" target='_blank'><img src="<?php echo base_url(); ?>assets/images/icon/print_pdf.png" width="25" height="23" title="cetak per-sumber dana pdf"/></a>
<a class="link2" name="33" target='_blank'><img src="<?php echo base_url(); ?>assets/images/icon/excel.jpg" width="25" height="23" title="cetak per-sumber dana excel"/></a>                    
                </td>
    
    
    
    
    
    
    </tr>
    
    </table>
    
    <div class="scroll">
    <?php
   
        echo $prev;
    ?>
    </div>
</div>

</head>