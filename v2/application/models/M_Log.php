<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Log extends CI_Model {

    public function get_logKapasitas($id_faskes, $id_kelas) {
        $this->db->select('a.id_log_kapasitas, a.id_faskes, b.nama_faskes, a.id_kelas, c.nama_kelas, a.data_kapasitas, a.created_at AS waktu');
        $this->db->from('log_kapasitas a');
        $this->db->join('tb_faskes b', 'a.id_faskes = b.id_faskes', 'inner');
        $this->db->join('tb_kelas c', 'a.id_kelas = c.id_kelas', 'inner');
        $this->db->where("a.id_faskes", $id_faskes);
        $this->db->where("a.id_kelas", $id_kelas);
        $this->db->order_by('a.id_kelas');
        
        return $this->db->get()->result_array();
    }

    public function get_logKetersediaan($id_faskes, $id_kelas) {
        $this->db->select('a.id_log_ketersediaan, a.id_faskes, b.nama_faskes, a.id_kelas, c.nama_kelas, a.data_ketersediaan, a.created_at AS waktu');
        $this->db->from('log_ketersediaan a');
        $this->db->join('tb_faskes b', 'a.id_faskes = b.id_faskes', 'inner');
        $this->db->join('tb_kelas c', 'a.id_kelas = c.id_kelas', 'inner');
        $this->db->where("a.id_faskes", $id_faskes);
        $this->db->where("a.id_kelas", $id_kelas);
        $this->db->order_by('a.id_kelas');
        
        return $this->db->get()->result_array();
    }

    public function tambah_logKapasitas() {
        $id_faskes = $this->input->post('id_faskes');
        $id_kelas = $this->input->post('id_kelas');
        $kapasitas = $this->input->post('kapasitas');
        
        for ($i=0; $i < count($id_kelas); $i++) {
    
            $data = array(
                'id_faskes' => $id_faskes,
                'id_kelas' => $id_kelas[$i],
                'data_kapasitas' => $kapasitas[$i],
            );
            $this->db->insert('log_kapasitas', $data);
        }
    }

    public function tambah_logKetersediaan() {
        $id_faskes = $this->input->post('id_faskes');
        $id_kelas = $this->input->post('id_kelas');
        $ketersediaan = $this->input->post('ketersediaan');
        
        for ($i=0; $i < count($id_kelas); $i++) {
    
            $data = array(
                'id_faskes' => $id_faskes,
                'id_kelas' => $id_kelas[$i],
                'data_ketersediaan' => $ketersediaan[$i],
            );
            $this->db->insert('log_ketersediaan', $data);
        }
    }
}