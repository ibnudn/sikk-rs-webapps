<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Ketersediaan extends CI_Model {

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
        
        $this->db->select("a.*, SUM(a.ketersediaan) AS ketersediaan, b.nama_faskes, c.kapasitas");
        $this->db->from("tb_ketersediaan a");
        $this->db->join("tb_faskes b", "a.id_faskes=b.id_faskes", "inner");
        $this->db->join("($subquery) c", "a.id_faskes=c.id_faskes", "inner");
        $this->db->group_by('id_faskes');
        
        return $this->db->get()->result_array();
    }

    public function get_joinKapasitasID($id) {
        $this->db->select("id_kapasitas, id_kelas, id_faskes, kapasitas");
        $this->db->from("tb_kapasitas");
        $this->db->where("id_faskes", $id);
        $subquery = $this->db->get_compiled_select();
        
        $this->db->select("a.*, b.nama_faskes, c.nama_kelas, d.kapasitas");
        $this->db->from("tb_ketersediaan a");
        $this->db->join("tb_faskes b", "a.id_faskes = b.id_faskes", "inner");
        $this->db->join('tb_kelas c', 'a.id_kelas = c.id_kelas', 'inner');
        $this->db->join("($subquery) d", "a.id_faskes = d.id_faskes AND a.id_kelas = d.id_kelas", "inner");
        $this->db->where("a.id_faskes", $id);
        $this->db->group_by('id_kelas');
        
        return $this->db->get()->result_array();
    }

    public function get_joinKapasitasNama($nama) {
        $this->db->select("id_kapasitas, id_kelas, id_faskes, kapasitas");
        $this->db->from("tb_kapasitas");
        $subquery = $this->db->get_compiled_select();
        
        $this->db->select("a.*, b.nama_faskes, c.nama_kelas, d.kapasitas");
        $this->db->from("tb_ketersediaan a");
        $this->db->join("tb_faskes b", "a.id_faskes = b.id_faskes", "inner");
        $this->db->join('tb_kelas c', 'a.id_kelas = c.id_kelas', 'inner');
        $this->db->join("($subquery) d", "a.id_faskes = d.id_faskes AND a.id_kelas = d.id_kelas", "inner");
        $this->db->where("b.nama_faskes", $nama);
        $this->db->group_by('id_kelas');
        
        return $this->db->get()->result_array();
    }

    public function tambah_ketersediaan() {
        $id_faskes = $this->input->post('id_faskes');
        $id_kelas = $this->input->post('id_kelas');
        $ketersediaan = $this->input->post('ketersediaan');
        
        for ($i=0; $i < count($id_kelas); $i++) {
            $data = array(
                'id_faskes' => $id_faskes,
                'id_kelas' => $id_kelas[$i],
                'ketersediaan' => $ketersediaan[$i],
            );
            $this->db->insert('tb_ketersediaan', $data);
        }
    }
    
    public function update_ketersediaan() {
        $id_faskes = $this->input->post('id_faskes');
        $id_kelas = $this->input->post('id_kelas');
        $ketersediaan = $this->input->post('ketersediaan');

        for ($i=0; $i < count($id_kelas); $i++) {
            $data = array(
                'ketersediaan' => $ketersediaan[$i],
            );
            $this->db->where('id_faskes', $id_faskes);
            $this->db->where('id_kelas', $id_kelas[$i]);
            $this->db->update('tb_ketersediaan', $data);
        }
    }

	public function hapus_ketersediaan($id_faskes, $id_kelas) {
        $this->db->where('id_faskes', $id_faskes);
        $this->db->where('id_kelas', $id_kelas);
        $this->db->delete('tb_ketersediaan');
    }

	public function jumlah_ketersediaan($id) {
		$this->db->select_sum('ketersediaan');
        $this->db->where("id_faskes", $id);
        return $this->db->get('tb_ketersediaan')->result();
	}

    // public function get_ketersediaan() {
    //     $this->db->select('kk.id_ketersediaan, kk.id_faskes, f.nama_faskes, SUM(kk.ketersediaan) AS ketersediaan');
    //     $this->db->from('tb_ketersediaan kk');
    //     $this->db->join('tb_faskes f', 'kk.id_faskes = f.id_faskes', 'inner');
    //     $this->db->join('tb_ketersediaan temp', '`kk`.`id_faskes` = `temp`.`id_faskes` AND kk.id_kelas = temp.id_kelas AND kk.update_ketersediaan < temp.update_ketersediaan', 'left');
    //     $this->db->where('temp.update_ketersediaan IS NULL');
    //     $this->db->group_by('kk.id_faskes');
    //     $this->db->order_by('kk.id_faskes');
        
    //     return $this->db->get()->result_array();
    // }
    
    // public function get_ketersediaanID($id) {
    //     $this->db->select('kk.id_ketersediaan, kk.id_faskes, f.nama_faskes, kk.id_kelas, kf.kelas_faskes, kk.ketersediaan');
    //     $this->db->from('tb_ketersediaan kk');
    //     $this->db->join('tb_faskes f', 'kk.id_faskes = f.id_faskes', 'inner');
    //     $this->db->join('tb_kelas_faskes kf', 'kk.id_kelas = kf.id_kelas', 'inner');
    //     $this->db->join('tb_ketersediaan temp', '`kk`.`id_faskes` = `temp`.`id_faskes` AND kk.id_kelas = temp.id_kelas AND kk.update_ketersediaan < temp.update_ketersediaan', 'left');
    //     $this->db->where("kk.id_faskes", $id);
    //     $this->db->where('temp.update_ketersediaan IS NULL');
    //     $this->db->order_by('kk.id_kelas');
        
    //     return $this->db->get()->result_array();
    // }
    
    // public function get_ketersediaanKelas($id_faskes, $id_kelas) {
    //     $this->db->select('kk.id_ketersediaan, kk.id_faskes, f.nama_faskes, kk.id_kelas, kf.kelas_faskes, kk.ketersediaan, kk.update_ketersediaan');
    //     $this->db->from('tb_ketersediaan kk');
    //     $this->db->join('tb_faskes f', 'kk.id_faskes = f.id_faskes', 'inner');
    //     $this->db->join('tb_kelas_faskes kf', 'kk.id_kelas = kf.id_kelas', 'inner');
        
    //     $this->db->where("kk.id_faskes", $id_faskes);
    //     $this->db->where("kk.id_kelas", $id_kelas);
        
    //     return $this->db->get()->result_array();
    // }

    // public function get_joinKapasitas() {
    //     $this->db->select('kk.id_ketersediaan, kk.id_faskes, f.nama_faskes, kk.id_kelas, kf.kelas_faskes, kk.ketersediaan');
    //     $this->db->from('tb_ketersediaan kk');
    //     $this->db->join('tb_faskes f', 'kk.id_faskes = f.id_faskes', 'inner');
    //     $this->db->join('tb_kelas_faskes kf', 'kk.id_kelas = kf.id_kelas', 'inner');
    //     $this->db->join('tb_ketersediaan temp', '`kk`.`id_faskes` = `temp`.`id_faskes` AND kk.id_kelas = temp.id_kelas AND kk.update_ketersediaan < temp.update_ketersediaan', 'left');
    //     $this->db->where('temp.update_ketersediaan IS NULL');
    //     $this->db->order_by('kk.id_kelas');
    //     $subquery1 = $this->db->get_compiled_select();
        
    //     $this->db->select('kk.id_kapasitas, kk.id_faskes, f.nama_faskes, kk.id_kelas, kf.kelas_faskes, kk.kapasitas');
    //     $this->db->from('tb_kapasitas kk');
    //     $this->db->join('tb_faskes f', 'kk.id_faskes = f.id_faskes', 'inner');
    //     $this->db->join('tb_kelas_faskes kf', 'kk.id_kelas = kf.id_kelas', 'inner');
    //     $this->db->join('tb_kapasitas temp', '`kk`.`id_faskes` = `temp`.`id_faskes` AND kk.id_kelas = temp.id_kelas AND kk.update_kapasitas < temp.update_kapasitas', 'left');
    //     $this->db->where('temp.update_kapasitas IS NULL');
    //     $this->db->order_by('kk.id_kelas');
    //     $subquery2 = $this->db->get_compiled_select();
        
    //     $this->db->select('x.id_ketersediaan, x.id_faskes, x.nama_faskes, SUM(y.kapasitas) AS kapasitas, SUM(x.ketersediaan) AS ketersediaan');
    //     $this->db->from("($subquery1) x");
    //     $this->db->join("($subquery2) y", 'x.id_faskes=y.id_faskes AND x.id_kelas=y.id_kelas', 'inner');
    //     $this->db->group_by('x.id_faskes');
    //     return $this->db->get()->result_array();
    // }

    // public function update_ketersediaan() {
    //     $id_faskes = $this->input->post('id_faskes');
    //     $id_kelas = $this->input->post('id_kelas');
    //     $ketersediaan = $this->input->post('ketersediaan');

    //     $data = array(
    //         'id_faskes' => $id_faskes,
    //         'id_kelas' => $id_kelas,
    //         'ketersediaan' => $ketersediaan,
    //     );
    //     $this->db->insert('tb_ketersediaan', $data);
    // }

    // public function tambah_ketersediaan() {
    //     $id_faskes = $this->input->post('id_faskes');
    //     $id_kelas = $this->input->post('id_kelas');
    //     $ketersediaan = $this->input->post('ketersediaan');
        
    //     for ($i=0; $i < count($id_kelas); $i++) {
    
    //         $data = array(
    //             'id_faskes' => $id_faskes,
    //             'id_kelas' => $id_kelas[$i],
    //             'ketersediaan' => $ketersediaan[$i],
    //         );
    //         $this->db->insert('tb_ketersediaan', $data);
    //     }
    // }
}
