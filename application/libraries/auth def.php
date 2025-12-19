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
      
             
      $this->CI->db->from('muser');
      $this->CI->db->where('iduser',md5($username));
      $this->CI->db->where('password=MD5("'.$password.'")','',false);
      $result = $this->CI->db->get();
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
            'iduser'    		 => $userdata->kode,
            'iduser_simbakda'    => $userdata->iduser,
            'nmuser'    		 => $userdata->nmuser,
            'nama_simbakda'      => $userdata->ket,
            'otori_simbakda'     => $userdata->oto,
            'otori'              => $userdata->oto,
			'ta_simbakda'	     => $thnangg,
            'skpd'               => $userdata->skpd,
            'unit_skpd'          => $userdata->unit_skpd
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