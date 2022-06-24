<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Menu extends CI_Model {

    public function menu() {
        $role = $this->session->id_role;
        $this->db->select("*");
        $this->db->from("tb_user_menu a");
        $this->db->join("tb_user_akses b", "a.id_menu = b.id_menu");
        $this->db->where("b.id_role", $role);
        $this->db->order_by("b.id_menu");
        
        return $this->db->get()->result_array();
    }
}