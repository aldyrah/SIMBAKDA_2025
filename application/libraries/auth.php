<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
/**
 * Auth library
 *
 * @author  Anggy Trisnawan
 */
class Auth{
   var $CI = NULL;
   function __construct()
   {
      // get CI's object
      $this->CI =& get_instance();
   }
   // untuk validasi login
   function do_login($username,$password,$thnangg)
   {
      // cek di database, ada ga?
      
      //echo $username.$password.$thnangg;
      
             
      $this->CI->db->from('user');
      //$this->CI->db->where('iduser',md5($username));
      $this->CI->db->where('user_name',$username);
      $this->CI->db->where('password=MD5("'.$password.'")','',false);
      $result = $this->CI->db->get();
      $csql ="select plonline from config ";
      $hasil = $this->CI->db->query($csql)->row();

      if($result->num_rows() == 0)
      {
     
         // username dan password tsb tidak ada
         return false;
      }
      else
      {
         // ada, maka ambil informasi dari database
         $userdata = $result->row();
         $session_data = array(
            'iduser'          => $userdata->id_user,
            'iduser_simbakda' => $userdata->user_name,
            'nmuser'          => $userdata->user_name,
            'nama_simbakda'   => $userdata->nama,
            'otori_simbakda'  => $userdata->type,
            'otori'           => $userdata->type,
            'ta_simbakda'     => $thnangg,
            'skpd'            => $userdata->kd_skpd,
            'unit_skpd'       => $userdata->unit_skpd,
            'plonline'        => $hasil->plonline
         );
         // buat session
         $this->CI->session->set_userdata($session_data);
         return true;
      }
   }
   // untuk mengecek apakah user sudah login/belum
   function is_logged_in()
   {
      if($this->CI->session->userdata('iduser_simbakda') == '')
      {
         return false;
      }
      return true;
   }
   // untuk validasi di setiap halaman yang mengharuskan authentikasi
   function restrict()
   {
      if($this->is_logged_in() == false)
      {
         redirect(site_url().'/welcome/login');
      }
   }
   function do_logout()
	{
	   //$this->CI->session->unset_userdata('iduser_simbakda');
   		$this->CI->session->sess_destroy();
	}
}