<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div id="content">
	<div id="title">Data Master Golongan</div>
    <div id="isi">
    	<div id="formbox">
        	<div id="formtitle">Input Data Golongan</div>
            <div id="formisi">
            	<?php echo form_open('master/input_gol'); ?>
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
                    	<td width="10%"><?php echo form_label('Kode Golongan');?></td>
                        <td width="2%">:</td>
                        <td width="20%"><?php echo form_input('gol',set_value('gol'),'size="10"');?></td>
                        <td width="20%"><?php echo form_error('gol');?></td>
                    </tr>
                    <tr>
                    	<td><?php echo form_label('Nama Golongan');?></td>
                        <td>:</td>
                        <td><?php echo form_input('nama',set_value('nama'),'size="100"');?></td>
                        <td><?php echo form_error('nama');?></td>
                    </tr>
                    <tr>
                    	<td><?php echo form_label('Jenis');?></td>
                        <td>:</td>
                        <td><?php echo form_dropdown('jns', $option, '1','class="select"');?></td>
                        <td><?php echo form_error('jns');?></td>
                    </tr>
                    <tr>
                    	<td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><?php 
		 					echo form_submit('submit','Simpan','class="button silver"');
							echo anchor(site_url().'/master/golongan','Batal','class="button silver"');
						?>
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                        
                </table>
            </div>
        </div>
    
    </div>
</div>
