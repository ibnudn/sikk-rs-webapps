<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Auth extends CI_Model {

    public function getLogin($username) {
        $this->db->select("*, r.nama_role");
        $this->db->from("tb_user u");
        $this->db->join("tb_role r", "r.id_role = u.id_role", "inner");
        $this->db->where("u.username", $username);
        
        return $this->db->get()->row_array();
    }

    public function getPegawaiID($id) {
        $this->db->select("a.id_pegawai, b.id_user, b.username, c.id_faskes, c.nama_faskes");
        $this->db->from("tb_pegawai a");
        $this->db->join("tb_user b", "a.id_user = b.id_user", "inner");
        $this->db->join("tb_faskes c", "a.id_faskes = c.id_faskes", "inner");
        $this->db->where("a.id_user", $id);
        
        return $this->db->get()->row_array();
    }

    // public function getRS($id) {
    //     $this->db->select("r.id_user_rs, r.id_user, u.username, r.id_rs, d.nama_rs");
    //     $this->db->from("user_rs r");
    //     $this->db->join("tb_user u", "u.id_user = r.id_user", "inner");
    //     $this->db->join("data_rs d", "d.id_rs = r.id_rs", "inner");
    //     $this->db->where("r.id_user", $id);
        
    //     return $this->db->get()->row_array();
    // }

    // public function getPus($id) {
    //     $this->db->select("r.id_user_pus, r.id_user, u.username, r.id_puskesmas, d.nama_pus");
    //     $this->db->from("user_puskesmas r");
    //     $this->db->join("tb_user u", "u.id_user = r.id_user", "inner");
    //     $this->db->join("data_puskesmas d", "d.id_pus = r.id_puskesmas", "inner");
    //     $this->db->where("r.id_user", $id);
        
    //     return $this->db->get()->row_array();
    // }
}
