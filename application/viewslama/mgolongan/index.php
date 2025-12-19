<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div id="content">
	<div id="title">Data Master Golongan</div>
    <div id="isi">
    	<div id="topbar">
            <table border="0" cellpadding="0" cellspacing="5">
                <tr>
                    <td>
                        <?php echo anchor(site_url().'/master/input_gol','Add Data','class="button silver"');?>
                    </td>
                    <?php
                        echo form_open('master/cari_gol');?>
                    <td>
                        <?php echo form_label('Pencarian Data');?>
                    </td>
                    <td>
                        <?php echo form_input('cari',set_value('cari')); ?>
                    </td>
                    <td>
                        <?php echo form_submit('submit','Cari');?>
                    </td>
                    <?php echo form_close();?>
                </tr>
            </table>
        </div>
   		<table class='data' width='100%'>
      		<tr>
         		<th width='5%' align='left'>No</th>
         		<th width='20%' align='left'>Kode Golongan</th>
         		<th width='55%' align='left'>Golongan</th>
         		<th width='10%' align='left'>Jenis Golongan</th>
         		<th width='5%' align='center'>Edit</th>
         		<th width='5%' align='center'>Hapus</th>
      		</tr>
   			<?php
   			$i = 1;
   			foreach($query->result() as $row)
   			{ ?>
      		<tr>
         		<td><?php echo $i;?></td>
         		<td><?php echo $row->golongan;?></td>
         		<td><?php echo $row->nm_golongan;?></td>
         		<td><?php 
					if ($row->jenis == 1){
						echo 'Aset';
					}else{
						echo 'Non Aset';
					}
					?>
                </td>
         		<td align='center'>
            	<?php
                    
            		echo anchor(site_url().'/master/edit_gol/'.$row->golongan,'<img src="'.base_url().'public/images/edit.png" />','class="editdata"');?>
         		</td>
         		<td align='center'>
            		<?php echo anchor(site_url().'/master/del_gol/'.$row->golongan,'<img src="'.base_url().'public/images/close.png" />','class="editdata"');
            ?>
         		</td>
      		</tr>
      
      		<?php
	  		$i++;
   			}
   			?>
   		</table>
        <div id="pagination">
   		<?php 
        //$config['base_url'] = site_url().'/master/golongan/';
        //$this->pagination->initialize($config); 
   		echo $this->pagination->create_links(); 
 		?>
        </div>
    </div>
</div>
