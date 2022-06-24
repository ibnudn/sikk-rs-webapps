<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Kapasitas extends CI_Model {

    public function get_kapasitas() {
        $this->db->select('a.id_kapasitas, a.id_faskes, b.nama_faskes, SUM(a.kapasitas) AS kapasitas');
        $this->db->from('tb_kapasitas a');
        $this->db->join('tb_faskes b', 'a.id_faskes = b.id_faskes', 'inner');
        $this->db->group_by('a.id_faskes');
        $this->db->order_by('a.id_faskes');
        
        return $this->db->get()->result_array();
    }

    public function get_kapasitasID($id) {
        $this->db->select('a.id_kapasitas, a.id_faskes, b.nama_faskes, a.id_kelas, c.nama_kelas, a.kapasitas');
        $this->db->from('tb_kapasitas a');
        $this->db->join('tb_faskes b', 'a.id_faskes = b.id_faskes', 'inner');
        $this->db->join('tb_kelas c', 'a.id_kelas = c.id_kelas', 'inner');
        $this->db->where("a.id_faskes", $id);
        $this->db->order_by('a.id_kelas');
        
        return $this->db->get()->result_array();
    }

    public function tambah_kapasitas() {
        $id_faskes = $this->input->post('id_faskes');
        $id_kelas = $this->input->post('id_kelas');
        $kapasitas = $this->input->post('kapasitas');
        
        for ($i=0; $i < count($id_kelas); $i++) {
            $data = array(
                'id_faskes' => $id_faskes,
                'id_kelas' => $id_kelas[$i],
                'kapasitas' => $kapasitas[$i],
            );
            $this->db->insert('tb_kapasitas', $data);
        }
    }
    
    public function update_kapasitas() {
        $id_faskes = $this->input->post('id_faskes');
        $id_kelas = $this->input->post('id_kelas');
        $kapasitas = $this->input->post('kapasitas');

        for ($i=0; $i < count($id_kelas); $i++) {
            $data = array(
                'kapasitas' => $kapasitas[$i],
            );
            $this->db->where('id_faskes', $id_faskes);
            $this->db->where('id_kelas', $id_kelas[$i]);
            $this->db->update('tb_kapasitas', $data);
        }
    }

	public function jumlah_kapasitas($id) {
		$this->db->select_sum('kapasitas');
        $this->db->where("id_faskes", $id);
        return $this->db->get('tb_kapasitas')->result();
	}

    // public function get_kapasitasKelas($id_faskes, $id_kelas) {
    //     $this->db->select('a.id_kapasitas, a.id_faskes, b.nama_faskes, a.id_kelas, c.id_kelas, SUM(a.kapasitas) AS kapasitas');
    //     $this->db->from('tb_kapasitas a');
    //     $this->db->join('tb_faskes b', 'a.id_faskes = b.id_faskes', 'inner');
    //     $this->db->join('tb_faskes c', 'a.id_kelas = c.id_kelas', 'inner');
    //     $this->db->where("a.id_faskes", $id_faskes);
    //     $this->db->where("a.id_kelas", $id_kelas);
    //     $this->db->order_by('a.id_kelas');
        
    //     return $this->db->get()->result_array();
    // }
    
    // public function get_kapasitasKelas($id_faskes, $id_kelas) {
    //     $this->db->select('kk.id_kapasitas, kk.id_faskes, f.nama_faskes, kk.id_kelas, kf.kelas_faskes, kk.kapasitas, kk.update_kapasitas');
    //     $this->db->from('tb_kapasitas kk');
    //     $this->db->join('tb_faskes f', 'kk.id_faskes = f.id_faskes', 'inner');
    //     $this->db->join('tb_kelas_faskes kf', 'kk.id_kelas = kf.id_kelas', 'inner');
        
    //     $this->db->where("kk.id_faskes", $id_faskes);
    //     $this->db->where("kk.id_kelas", $id_kelas);
        
    //     return $this->db->get()->result_array();
    // }

    // public function update_kapasitas() {
    //     $id_faskes = $this->input->post('id_faskes');
    //     $id_kelas = $this->input->post('id_kelas');
    //     $kapasitas = $this->input->post('kapasitas');

    //     $data = array(
    //         'id_faskes' => $id_faskes,
    //         'id_kelas' => $id_kelas,
    //         'kapasitas' => $kapasitas,
    //     );
    //     $this->db->insert('tb_kapasitas', $data);
    // }

    // public function tambah_kapasitas() {
    //     $id_faskes = $this->input->post('id_faskes');
    //     $id_kelas = $this->input->post('id_kelas');
    //     $kapasitas = $this->input->post('kapasitas');
        
    //     for ($i=0; $i < count($id_kelas); $i++) {
    
    //         $data = array(
    //             'id_faskes' => $id_faskes,
    //             'id_kelas' => $id_kelas[$i],
    //             'kapasitas' => $kapasitas[$i],
    //         );
    //         $this->db->insert('tb_kapasitas', $data);
    //     }
    // }
}
