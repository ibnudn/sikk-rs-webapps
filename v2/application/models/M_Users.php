<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Users extends CI_Model {

    public function getUser() {
        $this->db->select("u.*, r.nama_role");
        $this->db->from("tb_user u");
        $this->db->join("tb_role r", "u.id_role = r.id_role", "inner");

        return $this->db->get()->result_array();
    }

    public function getUserID($id_user) {
        $this->db->select("u.*, r.nama_role");
        $this->db->from("tb_user u");
        $this->db->join("tb_role r", "u.id_role = r.id_role", "inner");
        $this->db->where("u.id_user", $id_user);

        return $this->db->get()->row_array();
    }

	public function getPegawai() {
		$this->db->select("a.id_pegawai, b.id_user, b.username, c.id_faskes, c.nama_faskes");
		$this->db->from("tb_pegawai a");
		$this->db->join("tb_user b", "a.id_user = b.id_user", "inner");
		$this->db->join("tb_faskes c", "a.id_faskes = c.id_faskes", "inner");
		
		return $this->db->get()->row_array();
	}

	public function getPegawaiID($id_user) {
        $this->db->select("a.id_pegawai, b.id_user, b.username, c.id_faskes, c.nama_faskes");
        $this->db->from("tb_pegawai a");
        $this->db->join("tb_user b", "a.id_user = b.id_user", "inner");
        $this->db->join("tb_faskes c", "a.id_faskes = c.id_faskes", "inner");
        $this->db->where("a.id_user", $id_user);
        
        return $this->db->get()->row_array();
    }

    public function tambah_user() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $id_role = $this->input->post('id_role');
		
        $data = array(
			'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'id_role' => $id_role
        );
        
        $this->db->insert('tb_user', $data);
    }
	
	public function tambah_pegawai1() {
		$id_user = $this->input->post('id_user');
		$id_faskes = $this->input->post('id_faskes');

        $data = array(
            'id_user' => $id_user,
            'id_faskes' => $id_faskes
        );
        
        $this->db->insert('tb_pegawai', $data);
    }

	public function tambah_pegawai2($id_user, $id_faskes) {
        $data = array(
            'id_user' => $id_user,
            'id_faskes' => $id_faskes
        );
        
        $this->db->insert('tb_pegawai', $data);
    }

    public function edit_user($id) {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $id_role = $this->input->post('id_role');

        $data = array(
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'id_role' => $id_role
        );
        
        $this->db->where('id_user', $id);
        $this->db->update('tb_user', $data);
    }

    public function hapus_user($id) {
        $this->db->where('id_user', $id);
        $this->db->delete('tb_user');
    }

	public function jumlah_user() {
		return $this->db->count_all_results('tb_user');
	}
}
