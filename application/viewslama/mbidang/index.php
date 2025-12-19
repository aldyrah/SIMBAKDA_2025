<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div id="content">
	<div id="title">Data Master Bidang</div>
    <div id="isi">
    	<div id="topbar">
            <table border="0" cellpadding="0" cellspacing="5">
                <tr>
                    <td>
                        <?php echo anchor(site_url().'/master/input_bid','Add Data','class="button silver"');?>
                    </td>
                    <?php
                        echo form_open('master/cari_bid');?>
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
         		<th width='10%' align='left'>Kode Bidang</th>
         		<th width='45%' align='left'>Nama Bidang</th>
         		<th width='30%' align='left'>Golongan</th>
         		<th width='5%' align='center'>Edit</th>
         		<th width='5%' align='center'>Hapus</th>
      		</tr>
   			<?php
   			$i = 1;
   			foreach($query->result() as $row)
   			{ ?>
      		<tr>
         		<td><?php echo $i;?></td>
         		<td><?php echo $row->bidang;?></td>
         		<td><?php echo $row->nm_bidang;?></td>
         		<td><?php echo $row->golongan;?></td>
         		<td align='center'>
            	<?php
                    
            		echo anchor(site_url().'/master/edit_bid/'.$row->bidang,'<img src="'.base_url().'public/images/edit.png" />','class="editdata"');?>
         		</td>
         		<td align='center'>
            		<?php echo anchor(site_url().'/master/del_bid/'.$row->bidang,'<img src="'.base_url().'public/images/close.png" />','class="editdata"');
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
