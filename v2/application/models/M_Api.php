<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Api extends CI_Model {

    public function get_ketersediaan() {
        $this->db->select('a.id_ketersediaan, a.id_faskes, b.nama_faskes, SUM(a.ketersediaan) AS ketersediaan');
        $this->db->from('tb_ketersediaan a');
        $this->db->join('tb_faskes b', 'a.id_faskes = b.id_faskes', 'inner');
        $this->db->group_by('a.id_faskes');
        $this->db->order_by('a.id_faskes');
        
        return $this->db->get()->result_array();
    }

    public function get_ketersediaanID($id) {
        $this->db->select('a.id_ketersediaan, a.id_faskes, b.nama_faskes, a.id_kelas, c.nama_kelas, a.ketersediaan');
        $this->db->from('tb_ketersediaan a');
        $this->db->join('tb_faskes b', 'a.id_faskes = b.id_faskes', 'inner');
        $this->db->join('tb_kelas c', 'a.id_kelas = c.id_kelas', 'inner');
        $this->db->where("a.id_faskes", $id);
        $this->db->order_by('a.id_kelas');
        
        return $this->db->get()->result_array();
    }

    public function get_joinKapasitas() {
        $this->db->select("id_kapasitas, id_faskes, SUM(kapasitas) AS kapasitas");
        $this->db->from("tb_kapasitas");
        $this->db->group_by('id_faskes');
        $subquery = $this->db->get_compiled_select();
        
        $this->db->select("a.id_ketersediaan AS id, a.id_faskes, b.nama_faskes AS nama, b.alamat_faskes AS alamat, b.website_faskes AS website, b.koordinat_faskes AS koordinat, c.kapasitas, SUM(a.ketersediaan) AS tersedia, a.created_at, a.updated_at");
        $this->db->from("tb_ketersediaan a");
        $this->db->join("tb_faskes b", "a.id_faskes=b.id_faskes", "inner");
        $this->db->join("($subquery) c", "a.id_faskes=c.id_faskes", "inner");
        $this->db->group_by('a.id_faskes');
        $this->db->order_by('b.id_tipe_faskes');
        
        return $this->db->get()->result_array();
    }

    public function get_joinKapasitasID($id) {
        $this->db->select("id_kapasitas, id_kelas, id_faskes, kapasitas");
        $this->db->from("tb_kapasitas");
        $subquery = $this->db->get_compiled_select();
        
        $this->db->select("a.id_ketersediaan AS id, a.id_faskes, b.nama_faskes AS nama, b.alamat_faskes AS alamat, b.website_faskes AS website, b.koordinat_faskes AS koordinat, a.id_kelas, c.nama_kelas AS kelas, d.kapasitas, a.ketersediaan AS tersedia, a.created_at, a.updated_at");
        $this->db->from("tb_ketersediaan a");
        $this->db->join("tb_faskes b", "a.id_faskes = b.id_faskes", "inner");
        $this->db->join('tb_kelas c', 'a.id_kelas = c.id_kelas', 'inner');
        $this->db->join("($subquery) d", "a.id_faskes = d.id_faskes AND a.id_kelas = d.id_kelas", "inner");
        $this->db->where("a.id_faskes", $id);
        $this->db->order_by('id_kelas');
        
        return $this->db->get()->result_array();
    }

    public function get_joinKapasitasNama($nama) {
        $this->db->select("id_kapasitas, id_kelas, id_faskes, kapasitas");
        $this->db->from("tb_kapasitas");
        $subquery = $this->db->get_compiled_select();
        
        $this->db->select("a.id_ketersediaan AS id, a.id_faskes, b.nama_faskes AS nama, a.id_kelas, b.alamat_faskes AS alamat, b.website_faskes AS website, b.koordinat_faskes AS koordinat, c.nama_kelas AS kelas, d.kapasitas, a.ketersediaan AS tersedia, a.created_at, a.updated_at");
        $this->db->from("tb_ketersediaan a");
        $this->db->join("tb_faskes b", "a.id_faskes = b.id_faskes", "inner");
        $this->db->join('tb_kelas c', 'a.id_kelas = c.id_kelas', 'inner');
        $this->db->join("($subquery) d", "a.id_faskes = d.id_faskes AND a.id_kelas = d.id_kelas", "inner");
        $this->db->where("b.nama_faskes", $nama);
        $this->db->order_by('id_kelas');
        
        return $this->db->get()->result_array();
    }

    public function get_byKelas() {
        $this->db->select("id_kapasitas, id_kelas, SUM(kapasitas) AS kapasitas");
        $this->db->from("tb_kapasitas");
        $this->db->group_by('id_kelas');
        $subquery = $this->db->get_compiled_select();
        
        $this->db->select("a.id_ketersediaan AS id, a.id_kelas, b.nama_kelas AS kelas, c.kapasitas, SUM(a.ketersediaan) AS tersedia, a.created_at, a.updated_at");
        $this->db->from("tb_ketersediaan a");
        $this->db->join("tb_kelas b", " a.id_kelas = b.id_kelas", "inner");
        $this->db->join("($subquery) c", " a.id_kelas = c.id_kelas", "inner");
        $this->db->group_by('a.id_kelas');
        $this->db->order_by('a.id_kelas');
        
        return $this->db->get()->result_array();
    }

    public function get_byKelasID($id) {
        $this->db->select("id_kapasitas, id_kelas, id_faskes, kapasitas");
        $this->db->from("tb_kapasitas");
        $subquery = $this->db->get_compiled_select();
        
        $this->db->select("a.id_ketersediaan AS id, a.id_faskes, b.nama_faskes AS nama, a.id_kelas, c.nama_kelas AS kelas, d.kapasitas, a.ketersediaan AS tersedia, a.created_at, a.updated_at");
        $this->db->from("tb_ketersediaan a");
        $this->db->join("tb_faskes b", "a.id_faskes = b.id_faskes", "inner");
        $this->db->join('tb_kelas c', 'a.id_kelas = c.id_kelas', 'inner');
        $this->db->join("($subquery) d", "a.id_faskes = d.id_faskes AND a.id_kelas = d.id_kelas", "inner");
        $this->db->where("a.id_kelas", $id);
        $this->db->order_by('id_faskes');
        
        return $this->db->get()->result_array();
    }

    public function get_byKelasNama($nama) {
        $this->db->select("id_kapasitas, id_kelas, id_faskes, kapasitas");
        $this->db->from("tb_kapasitas");
        $subquery = $this->db->get_compiled_select();
        
        $this->db->select("a.id_ketersediaan AS id, a.id_faskes, b.nama_faskes AS nama, a.id_kelas, c.nama_kelas AS kelas, d.kapasitas, a.ketersediaan AS tersedia, a.created_at, a.updated_at");
        $this->db->from("tb_ketersediaan a");
        $this->db->join("tb_faskes b", "a.id_faskes = b.id_faskes", "inner");
        $this->db->join('tb_kelas c', 'a.id_kelas = c.id_kelas', 'inner');
        $this->db->join("($subquery) d", "a.id_faskes = d.id_faskes AND a.id_kelas = d.id_kelas", "inner");
        $this->db->where("c.nama_kelas", $nama);
        $this->db->order_by('id_faskes');
        
        return $this->db->get()->result_array();
    }
}
