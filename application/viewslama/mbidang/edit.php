<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$row = $mbid->row();
?>
<div id="content">
	<div id="title">Data Master Golongan</div>
    <div id="isi">
    	<div id="formbox">
        	<div id="formtitle">Update Data Golongan</div>
            <div id="formisi">
            	<?php echo form_open('master/edit_bid/'.$row->bidang); ?> 
            	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                	<tr>
                    	<td colspan="4" align="center"><?php
                        	if(isset($errinput)) {
								echo '<span style="font-size:9; color:red;">'.$errinput.'</span>';
							}
						?>
                        </td>
                    </tr>
                	<tr>
                    	<td width="10%"><?php echo form_label('Kode Bidang');?></td>
                        <td width="2%">:</td>
                        <td width="20%"><?php echo form_input('bid',$row->bidang,'size="10" disabled="disabled"');?></td>
                        <td width="20%"><?php echo form_error('bid');?></td>
                    </tr>
                    <tr>
                    	<td><?php echo form_label('Nama Bidang');?></td>
                        <td>:</td>
                        <td><?php echo form_input('nama',$row->nm_bidang,'size="100"');?></td>
                        <td><?php echo form_error('nama');?></td>
                    </tr>
                    <tr>
                    	<td><?php echo form_label('Golongan');?></td>
                        <td>:</td>
                        <td><?php echo form_dropdown('jns_gol', $option, $row->golongan,'class="select"');?></td>
                        <td><?php echo form_error('jns_gol');?></td>
                    </tr>
                    <tr>
                    	<td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><?php 
		 					echo form_submit('submit','Update','class="button silver"');
							echo anchor(site_url().'/master/bidang','Batal','class="button silver"');
						?>
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                        
                </table>
            </div>
        </div>
    
    </div>
</div>
