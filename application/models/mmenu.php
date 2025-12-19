<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mmenu extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	//has been modify by demansyah MSM Biak
    public function get_menu(){
        $oto="m".$this->session->userdata('otori_simbakda');
        $id = $this->session->userdata('iduser');
		$html = '';
		if($this->auth->is_logged_in()==true){
		$html .= '<ul class="active">
					<li><a href="'.base_url().'">HOME</a></li>';
		//Menu berdasarkan group user
		//$query = "select idmenu,judul from ms_menu where parent='0' and $oto ='1' order by idmenu";
		$query ="SELECT  a.id, a.title,  a.link_type,  a.page_id,  a.module_name,  a.url,  a.uri,  a.dyn_group_id,  a.position,  a.target,  a.parent_id,  a.is_parent,  
				 b.akses AS show_menu FROM dyn_menu a JOIN otori b ON a.id=b.menu_id WHERE b.user_id='$id' AND b.akses='1' AND a.show_menu='1' ORDER BY a.id";
		$res = $this->db->query($query);
		foreach($res->result() as $mntop){
		  $id = $mntop->id;//idmenu;
		  $idmenu= $mntop->parent_id;
		  $nm = $mntop->title;//judul;
			if($this->cek_submenu($id)==true){
				$html .= '<li class="has-sub"><a href="'.base_url().'">'.$nm.'</a>';
				$html .= $this->get_submenu($id);
				$html .='</li>';
			}
		}			
		$html .= '<li><a href="'.base_url().'index.php/welcome/logout">LOG OUT</a></li></ul>';
		}
		return $html;
	}
    
    function cek_submenu($parent){
		$nstr = strlen($parent);
		$iduser = $this->session->userdata('iduser');
		$where = 'where a.parent_id = "'.$parent.'"';
		//$query = "select idmenu from ms_menu $where";
		$query ="SELECT  a.id, a.title,  a.link_type,  a.page_id,  a.module_name,  a.url,  a.uri,  a.dyn_group_id,  a.position,  a.target,  a.parent_id,  a.is_parent,  
				 b.akses AS show_menu FROM dyn_menu a JOIN otori b ON a.id=b.menu_id $where AND b.user_id='$iduser' AND b.akses='1' ORDER BY a.id";
		$res = $this->db->query($query);
		$nrow = $res->num_rows();
		if($nrow > 0){
			$lret = true;
		}else{
			$lret = false;
		}
		return $lret;
	}
    
    //function get_submenu($parent){
    function get_submenu($id){
        $oto="m".$this->session->userdata('otori_simbakda');
        $iduser = $this->session->userdata('iduser');
        $where = $id;
		$html = '<ul>';
		//$query = "select idmenu,judul,link from ms_menu where parent='".$parent."' and $oto='1' order by idmenu";
		$query ="SELECT  a.id, a.title,  a.link_type,  a.page_id,  a.module_name,  a.url,  a.uri,  a.dyn_group_id,  a.position,  a.target,  a.parent_id,  a.is_parent,  
				 b.akses AS show_menu FROM dyn_menu a JOIN otori b ON a.id=b.menu_id where a.parent_id = '$where' AND b.user_id='$iduser' AND b.akses='1' ORDER BY a.id";
		$res = $this->db->query($query);
		foreach($res->result() as $submn){
			$id = $submn->id;//idmenu;
			$nm = $submn->title;//judul;
			$lk = $submn->url;//link;
			if($lk<>''){
				$html .= '<li><a href="'.base_url().$lk.'">'.$nm.'</a></li>'; 
			}else{
				if($this->cek_submenu($id)==true){
					$html .= '<li class="has-sub"><a href="'.base_url().'">'.$nm.'</a>';
					$html .= $this->get_submenu1($id);
					$html .= '</li>';
				}
			}
			/*if($this->cek_submenu($id)==true){
				$html .= '<li class="has-sub"><a href="'.base_url().'">'.$nm.'</a>';
				$html .= $this->get_submenu1($id);
				$html .='</li>';
			}*/
		} 
		$html .= '</ul>';
		return $html;
	}
    
	function get_submenu1($id){
	    $oto="m".$this->session->userdata('otori_simbakda');
       	$iduser = $this->session->userdata('iduser');
       	$where = $id;
		$html = '<ul>';
		/*$query = "select idmenu,judul,link from ms_menu where parent='".$parent."' and $oto='1' order by idmenu";
		$res = $this->db->query($query);
		foreach($res->result() as $submn){
			$id = $submn->idmenu;
			$nm = $submn->judul;
			$lk = $submn->link;*/
		$query ="SELECT  a.id, a.title,  a.link_type,  a.page_id,  a.module_name,  a.url,  a.uri,  a.dyn_group_id,  a.position,  a.target,  a.parent_id,  a.is_parent,  
				 b.akses AS show_menu FROM dyn_menu a JOIN otori b ON a.id=b.menu_id where a.parent_id = '$where'  AND b.user_id='$iduser' AND b.akses='1' ORDER BY a.id";
		$res = $this->db->query($query);
		foreach($res->result() as $submn){
			$id = $submn->id;//idmenu;
			$nm = $submn->title;//judul;
			$lk = $submn->url;//link;
			if($lk<>''){
				$html .= '<li><a href="'.base_url().$lk.'">'.$nm.'</a></li>'; 
			}else{
				if($this->cek_submenu($id)==true){
					$html .= '<li class="last"><a href="'.base_url().'">'.$nm.'</a>';
					$html .= $this->get_submenu2($id);
					$html .= '</li>';
				}
			}
			/*if($this->cek_submenu($id)==true){
				$html .= '<li class="has-sub"><a href="'.base_url().'">'.$nm.'</a>';
				$html .= $this->get_submenu2($id);
				$html .='</li>';
			}*/
		} 
		$html .= '</ul>';
		return $html;
	}

    
    function get_submenu2($id){
	    $oto="m".$this->session->userdata('otori_simbakda');
       	$iduser = $this->session->userdata('iduser');
       	$where = $id;
		$html = '<ul>';
		/*$query = "select idmenu,judul,link from ms_menu where parent='".$parent."' and $oto='1' order by idmenu";
		$res = $this->db->query($query);
		foreach($res->result() as $submn){
			$id = $submn->idmenu;
			$nm = $submn->judul;
			$lk = $submn->link;*/
		$query ="SELECT  a.id, a.title,  a.link_type,  a.page_id,  a.module_name,  a.url,  a.uri,  a.dyn_group_id,  a.position,  a.target,  a.parent_id,  a.is_parent,  
				 b.akses AS show_menu FROM dyn_menu a JOIN otori b ON a.id=b.menu_id where a.parent_id = '$where'  AND b.user_id='$iduser' AND b.akses='1' ORDER BY a.id";
		$res = $this->db->query($query);
		foreach($res->result() as $submn){
			$id = $submn->id;//idmenu;
			$nm = $submn->title;//judul;
			$lk = $submn->url;//link;
			if($lk<>''){
				$html .= '<li><a href="'.base_url().$lk.'">'.$nm.'</a></li>'; 
			}else{
				if($this->cek_submenu($id)==true){
					$html .= '<li class="last"><a href="'.base_url().'">'.$nm.'</a>';
					$html .= $this->get_submenu($id);
					$html .= '</li>';
				}
			}
		} 
		$html .= '</ul>';
		return $html;
	}
    
    
    
    
    
    
    
    
    /*
	public function get_head()
	{
		$this->db->select('*');
		$this->db->from('ms_menu');
		$this->db->where('parent',0);
		$this->db->order_by('idmenu','ASC');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_menu_top() {
		$headmenu = '';
		$topmenu = $this->get_head();
		$headmenu = '<div id="ddtopmenubar" class="mattblackmenu">
            			<ul>
            				<li><a href="'.base_url().'">Home</a></li>';
        foreach($topmenu as $data)
        {
        	if (empty($data->rel) or $data->rel==0) {
            	$headmenu .= '<li><a href="'.base_url().$data->link.'">'.$data->judul.'</a></li>';
            }else{
                $headmenu .= '<li><a href="'.base_url().$data->link.'" rel="ddsubmenu'.$data->idmenu.'">'.$data->judul.'</a></li>';
            }
        }
        $headmenu .= '</ul></div>';
		return $headmenu;
	}
	
    public function get_menu_structure(){
        //$this->db->where('parent',$parent);
		$menu = '';
        $oto="m".$this->session->userdata('otori_simbakda');
        $q=$this->db->query("select * from ms_menu where parent=0 and $oto='1' order by idmenu asc");
        foreach($q->result() as $r){
            $head = $r->idmenu;
			$x=$this->db->query("select * from ms_menu where parent=$head and $oto='1' order by idmenu asc");
			foreach($x->result() as $r1) {
				$data[$r1->parent][] = $r1;
			}
			$menu.=$this->build_menu($data,$head);	
        }
        return $menu;
    } 
    
    
    public function build_menu($menus,$parent){
        static $i = 1;
        $path = base_url();
        $oto="m".$this->session->userdata('otori_simbakda');
        
        if (array_key_exists($parent,$menus)) {
			$menu = '<ul id="ddsubmenu'.$parent.'" class="ddsubmenustyle">';
            $i++;
            foreach ($menus[$parent] as $r) {
				$head = $r->idmenu;
				$res=$this->db->query("select * from ms_menu where parent=$head and $oto='1' order by idmenu asc");
				$nrow = $res->num_rows();
				if($nrow > 0) {
					foreach($res->result() as $r1) {
						$data[$r1->parent][] = $r1;
					}
					$child = $this->build_menu($data, $head);
				}
                //$path .= $r->link_menu;
				$menu .= '<li>';
				$menu .= '<a href="'.$path.$r->link.'">'.$r->judul.'</a>';
                if($nrow > 0) {
					if ($child) {
						$i--;
						$menu .= $child;
					}
				}
                $menu .= '</li>';
				
            }
            $menu .= '</ul>';
	
            return $menu;
        } else {
            return false;
        }
    } 
	public function get_sidemenu() {
		echo '<div id="divBox">
			<div class="title">Shortcut
			</div>
			<div class="box">
				<div id="ddsidemenubar" class="markermenu">
					<ul>
						<li><a href="'.base_url().'home/kategori">Kategori Berita</a></li>
						<li><a href="'.base_url().'berita/input" >Input Berita</a></li>
						<li><a href="'.base_url().'pengumuman/input" >Input Pengumuman</a></li>
						<li><a href="'.base_url().'agenda/input">Input Agenda</a></li>
						<li><a href="'.base_url().'peraturan/input" >Input Peraturan</a></li>
						<li><a href="'.base_url().'galeri/input" style="border-bottom-width: 0">Input Galeri</a></li>		
					</ul>
				</div>
		
			</div>
		</div>';
	}
    */
}
?>