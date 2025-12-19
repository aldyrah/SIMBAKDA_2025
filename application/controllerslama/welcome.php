<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
     
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
   public function __construct()
   {
      parent::__construct();

   }
	public function index()
	{
		if($this->auth->is_logged_in() == false) {
        	$this->login();
      	}else{
         	$this->template->set('title','.::SIMBAKDA::.');
         	$this->template->load('index','home');
		}
	}
	public function login() {
	  	$this->load->library('form_validation');
      	$this->form_validation->set_rules('username', 'Nama User', 'trim|required');
      	$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('ta', 'Tahun Anggaran', 'trim|required');
      	$this->form_validation->set_error_delimiters(' <span style="color:#FF0000"; font-size:9px;>', '</span>');
 
      	if ($this->form_validation->run() == FALSE){
         	$this->template->set('title','.::SIMBAKDA - Login User::.');
         	$this->template->load('home','login');
      	}
      	else{
         	$username = $this->input->post('username');
         	$password = $this->input->post('password');
			   $thnangg  = $this->input->post('ta');
         //	echo "$username $password $thnangg";
             $success = $this->auth->do_login($username,$password,$thnangg);
         	//echo $success;
             if($success){
            	// lemparkan ke halaman index user
            	redirect(site_url().'/welcome/index');
         	}
         	else
         	{
            	$this->template->set('title','.::SIMBAKDA - Login User::.');
            	$data['login_info'] = "Maaf, username dan password salah!";
            	$this->template->load('home','login',$data);
         	}
      	}
	}
   	function logout()
	{
   		if($this->auth->is_logged_in() == true)
   		{
      	// jika dia memang sudah login, destroy session
      		$this->auth->do_logout();
   		}
   		// larikan ke halaman utama
   		redirect(site_url().'/welcome/index');
	}
    
    public function ceklogin(){
		$user=$this->session->userdata('iduser_simbakda');
		if ($user==''){
			echo '1';
		}else{
			echo '0';
		}
	}
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */