<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mlink extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	public function get_header()
	{
		$this->db->select('*');
		$this->db->from('ms_menus');
		$this->db->where('parent',0);
		$this->db->order_by('idmenu','ASC');
		$query = $this->db->get();
		return $query->result();
	}

    public function get_menu_structure(){
        //$this->db->where('parent',$parent);
		$menu = '';
        $q=$this->db->query('select * from ms_menus where parent=0 order by idmenu asc');
        foreach($q->result() as $r){
            $head = $r->idmenu;
			$x=$this->db->query("select * from ms_menus where parent=$head order by idmenu asc");
			foreach($x->result() as $r1) {
				$data[$r1->parent][] = $r1;
			}
			$menu.=$this->build_menu($data,$head);	
        }
         // From Parent ID 1
        return $menu;
    } 
    public function build_menu($menus,$parent){
        static $i = 1;
        $path = base_url();
        if (array_key_exists($parent,$menus)) {
			$menu = '<ul id="ddsubmenu'.$parent.'" class="ddsubmenustyle">';
            $i++;
            foreach ($menus[$parent] as $r) {
				$head = $r->idmenu;
				$res=$this->db->query("select * from ms_menus where parent=$head order by idmenu asc");
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

}
?>