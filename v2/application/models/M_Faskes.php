<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Faskes extends CI_Model {

    public function join_kategori() {
        $this->db->select("a.id_tipe_faskes, a.tipe_faskes, a.id_kategori_faskes, b.kategori_faskes");
        $this->db->from("tb_tipe_faskes a");
        $this->db->join("tb_kategori_faskes b", "a.id_kategori_faskes = b.id_kategori_faskes", "inner");

        return $this->db->get_compiled_select();
    }

    public function get_faskes() {
        $subquery = $this->join_kategori();

        $this->db->select("a.id_faskes, a.nama_faskes, b.id_kategori_faskes, b.kategori_faskes, b.id_tipe_faskes, b.tipe_faskes, a.alamat_faskes, a.website_faskes, a.koordinat_faskes");
        $this->db->from("tb_faskes a");
        $this->db->join("($subquery) b", "a.id_tipe_faskes = b.id_tipe_faskes", "inner");
        
        return $this->db->get()->result_array();
    }
    
    public function get_faskesID($id) {
        $subquery = $this->join_kategori();

        $this->db->select("a.id_faskes, a.nama_faskes, b.id_kategori_faskes, b.kategori_faskes, b.id_tipe_faskes, b.tipe_faskes, a.alamat_faskes, a.website_faskes, a.koordinat_faskes");
        $this->db->from("tb_faskes a");
        $this->db->join("($subquery) b", "a.id_tipe_faskes = b.id_tipe_faskes", "inner");
        $this->db->where("a.id_faskes", $id);
        
        return $this->db->get()->row_array();
    }
	
	public function get_faskesTanpaPegawai() {
		$subquery1 = $this->join_kategori();
		$subquery2 = $this->db->select('id_faskes')->from('tb_pegawai')->get();
		$subquery2_result = $subquery2->result_array();
		$pegawai = array();
		foreach ($subquery2_result as $key) {
			$pegawai[] = $key['id_faskes'];
		}

        $this->db->select("a.id_faskes, a.nama_faskes, b.id_kategori_faskes, b.kategori_faskes, b.id_tipe_faskes, b.tipe_faskes, a.alamat_faskes, a.website_faskes, a.koordinat_faskes");
        $this->db->from("tb_faskes a");
        $this->db->join("($subquery1) b", "a.id_tipe_faskes = b.id_tipe_faskes", "inner");
		$this->db->where_not_in("a.id_faskes", $pegawai);
        
        return $this->db->get()->result_array();
	}
    
    public function join_kapasitas() {
        $this->db->select("id_kapasitas, id_faskes, SUM(kapasitas) AS kapasitas");
        $this->db->from("tb_kapasitas");
        $this->db->group_by('id_faskes');
        $subquery = $this->db->get_compiled_select();
        
        $this->db->select("a.*, b.kapasitas");
        $this->db->from("tb_faskes a");
        $this->db->join("($subquery) b", "a.id_faskes=b.id_faskes", "inner");
        
        return $this->db->get()->result_array();
    }

    public function tambah_faskes() {
        $nama = $this->input->post('nama');
        $tipe = $this->input->post('tipe');
        $alamat = $this->input->post('alamat');
		$website = $this->input->post('website');
        $koordinat = $this->input->post('koordinat');
        
        $data = array(
            'nama_faskes' => $nama,
            'id_tipe_faskes' => $tipe,
            'alamat_faskes' => $alamat,
            'website_faskes' => $website,
            'koordinat_faskes' => $koordinat
        );
        
        $this->db->insert('tb_faskes', $data);
        return $this->db->insert_id();
    }
    
    public function edit_faskes($id) {
        $nama = $this->input->post('nama');
        $tipe = $this->input->post('tipe');
        $alamat = $this->input->post('alamat');
		$website = $this->input->post('website');
        $koordinat = $this->input->post('koordinat');

        $data = array(
            'nama_faskes' => $nama,
            'id_tipe_faskes' => $tipe,
            'alamat_faskes' => $alamat,
            'website_faskes' => $website,
            'koordinat_faskes' => $koordinat
        );
        
        $this->db->where('id_faskes', $id);
        $this->db->update('tb_faskes', $data);
    }

    public function hapus_faskes($id) {
        $this->db->where('id_faskes', $id);
        $this->db->delete('tb_faskes');
    }

	public function jumlah_faskes() {
		return $this->db->count_all_results('tb_faskes');
	}

}
