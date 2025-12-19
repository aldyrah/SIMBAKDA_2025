<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

  
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <form class="login100-form validate-form" action="<?php echo base_url();?>index.php?welcome/login" method="post">
          <span class="login100-form-title p-b-43">
          <img src="<?php echo base_url();?>assets/images/icon.png" width="50px" height="50px" /><br>
            LOGIN SIMBAKDA 2024
          </span>
          <div class="wrap-input100 validate-input" data-validate = "Isi Username Terlebih Dahulu">
            <input class="input100" type="text" name="username" placeholder="Username">
            <span class="focus-input100"></span>
          </div>
          
          <div class="wrap-input100 validate-input" data-validate="Isi Password Terlebih Dahulu">
            <input class="input100" type="password" name="password" placeholder="Password">
            <span class="focus-input100"></span>
          </div>

          <br>
          <?php 
          $options = array(
                      '2005'  => '2005',
                      '2006'  => '2006',
                      '2007'  => '2007',
                      '2008'  => '2008',
                      '2009'  => '2009',
                      '2010'  => '2010',
                      '2011'  => '2011',
                      '2012'  => '2012',
                      '2013'  => '2013',
                      '2014'  => '2014',
                      '2015'  => '2015',
                      '2016'  => '2016',
                      '2017'  => '2017',
                      '2018'  => '2018',
                      '2019'  => '2019',
                      '2020'  => '2020',
                      '2021'  => '2021',
                      '2022'  => '2022',
                      '2023'  => '2023',
                      '2024'  => '2024'
                  );
          echo form_dropdown('ta',$options,'2024','class="input100"'); ?>
          <br>
          <div class="container-login100-form-btn">
            <button class="login100-form-btn">
            <input class="input100" type="submit" style="color:white;" value="LOGIN">
            </button>
          </div>    
          <br><marquee scrolldelay="80" ><p style="color:#000000" align="center"><h2>.:: Selamat Datang di Portal Sistem Informasi Manajemen Barang dan Kekayaan Daerah Pemerintah Kabupaten MAPPI ::.</h2></p></marquee>
<br>
        </form>
        <div class="login100-more" style="background-image: url('<?php echo base_url();?>assets/images/bt5.png');">
        </div>
      </div>
    </div>
  </div>