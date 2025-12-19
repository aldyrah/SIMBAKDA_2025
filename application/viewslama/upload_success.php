<html>
<head>
<title>Upload Form</title>
</head>
<body>

<div id="content1"> 
<h3 align="center"><u><b><a>UPLOAD FOTO Berhasil !!!!</a></b></u></h3>
    <div align="center">
    <p>     
    <table style="width:400px;" border="0">
        <tr>

    <?php
    //echo $upload_data['file_name'];
    ?>
    
    
    <?php foreach ($upload_data as $item => $value):?>
     
    <?php endforeach; ?>

        <?php echo "(".$value['file_name'].")";?>
    <p><?php echo anchor(base_url().'index.php/transaksi/do_upload', 'Upload FOTO Lagi !!!!'); ?></p>
    </tr>
    </table>    
 
    </p> 
    </div>   
</div>
</body>
</html>