<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Faskes extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        
        $this->load->model('M_Menu', 'menu');
        $this->load->model('M_Faskes', 'faskes');
        // $this->load->model('M_Ketersediaan', 'ketersediaan');
    }
    
    public function index() {
        $data['title'] = "Data Faskes - SIKK RS";
        $data['menu'] = $this->menu->menu();
        $data['faskes'] = $this->faskes->get_faskes();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('admin/faskes/v_faskes', $data);
        $this->load->view('templates/content_footer');
        $this->load->view('templates/footer');
    }

    public function detail_faskes($id) {
        $data['title'] = "Detail Faskes - SIKK Faskes";
        $data['menu'] = $this->menu->menu();
        $data['faskes'] = $this->faskes->get_faskesID($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('admin/faskes/v_detailfaskes', $data);
        $this->load->view('templates/content_footer');
        $this->load->view('templates/footer');
    }

    public function tambah_faskes() {
        $data['title'] = "Tambah Faskes - SIKK RS";
        $data['menu'] = $this->menu->menu();
        $data['kategori'] = $this->db->get('tb_kategori_faskes')->result_array();
        $data['tipe'] = $this->db->get('tb_tipe_faskes')->result_array();
        
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => '%s perlu diisi',
        ]);
        $this->form_validation->set_rules('tipe', 'Tipe', 'required|trim', [
            'required' => '%s perlu diisi',
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
            'required' => '%s perlu diisi',
        ]);
        $this->form_validation->set_rules('koordinat', 'Koordinat', 'required|trim', [
            'required' => '%s perlu diisi',
        ]);
        
        if ($this->form_validation->run() == false) {
			$data['token_name'] = $this->security->get_csrf_token_name();
			$data['token_hash'] = $this->security->get_csrf_hash();

			$data['oldVal'] = json_encode($this->input->post());

			$err = array();
			$err['nama'] = form_error('nama');
			$err['tipe'] = form_error('tipe');
			$err['alamat'] = form_error('alamat');
			$err['koordinat'] = form_error('koordinat');
			$data['err'] = json_encode($err);

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar');
            $this->load->view('admin/faskes/v_tambahfaskes', $data);
            $this->load->view('templates/content_footer');
            $this->load->view('templates/footer');
        } else {
            $this->faskes->tambah_faskes();
            $this->session->set_flashdata('pesan', 
            '<div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
                Data Fasilitas Kesehatan berhasil ditambahkan!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');
                redirect('admin/c_faskes');
        }
    }
        
    public function edit_faskes($id) {
        $data['title'] = "Edit Faskes - SIKK RS";
        $data['menu'] = $this->menu->menu();
        $data['faskes'] = $this->faskes->get_faskesID($id);
        $data['kategori'] = $this->db->get('tb_kategori_faskes')->result_array();
        $data['tipe'] = $this->db->get('tb_tipe_faskes')->result_array();
        
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => '%s perlu diisi',
        ]);
        $this->form_validation->set_rules('tipe', 'Tipe', 'required|trim', [
            'required' => '%s perlu diisi',
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
            'required' => '%s perlu diisi',
        ]);
        $this->form_validation->set_rules('koordinat', 'Koordinat', 'required|trim', [
            'required' => '%s perlu diisi',
        ]);

        if ($this->form_validation->run() == false) {
			$data['token_name'] = $this->security->get_csrf_token_name();
			$data['token_hash'] = $this->security->get_csrf_hash();

			$data['oldVal'] = json_encode($this->input->post());

			$err = array();
			$err['nama'] = form_error('nama');
			$err['tipe'] = form_error('tipe');
			$err['alamat'] = form_error('alamat');
			$err['koordinat'] = form_error('koordinat');
			$data['err'] = json_encode($err);
			
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar');
            $this->load->view('admin/faskes/v_editfaskes', $data);
            $this->load->view('templates/content_footer');
            $this->load->view('templates/footer');
        } else {
            $this->faskes->edit_faskes($id);
            $this->session->set_flashdata('pesan', 
            '<div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
                Data Rumah Sakit berhasil diubah!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('admin/c_faskes');
        }
    }

    public function hapus_faskes($id) {
        $this->faskes->hapus_faskes($id);
        $this->session->set_flashdata('pesan', 
        '<div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
            Data Rumah Sakit berhasil dihapus!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
        redirect('admin/c_faskes');
    }

    // public function ketersediaan() {
    //     $data['title'] = "Ketersediaan RS - SIKK RS";
    //     $data['ketersediaan'] = $this->ketersediaan->getRS();

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar');
    //     $this->load->view('templates/topbar');
    //     $this->load->view('admin/rs/v_ketersediaan', $data);
    //     $this->load->view('templates/content_footer');
    //     $this->load->view('templates/footer');
    // }

    // public function detail_ketersediaan($id) {
    //     $data['title'] = "Detail Ketersediaan RS - SIKK RS";
    //     $data['ketersediaan'] = $this->ketersediaan->getAll($id);

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar');
    //     $this->load->view('templates/topbar');
    //     $this->load->view('admin/rs/v_detailketersediaan', $data);
    //     $this->load->view('templates/content_footer');
    //     $this->load->view('templates/footer');
    // }

    // public function update_ketersediaan($id) {
    //     $data['title'] = "Update Ketersediaan RS - SIKK RS";
    //     $data['ketersediaan'] = $this->ketersediaan->getAll($id);
    
    //     $this->form_validation->set_rules('id_kelas[]', 'ID Kelas', 'required|trim');
    //     $this->form_validation->set_rules('kapasitas[]', 'Kapasitas', 'required|trim');
    //     $this->form_validation->set_rules('tersedia[]', 'Tersedia', 'required|trim');
    
    //     if ($this->form_validation->run() == false) {
    //         $this->load->view('templates/header', $data);
    //         $this->load->view('templates/sidebar');
    //         $this->load->view('templates/topbar');
    //         $this->load->view('admin/rs/v_updateketersediaan', $data);
    //         $this->load->view('templates/content_footer');
    //         $this->load->view('templates/footer');
    //     } else {
    //         $this->ketersediaan->postRS($id);
    //         $this->session->set_flashdata('pesan', 
    //         '<div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
    //             Ketersediaan Rumah Sakit berhasil diperbarui!
    //             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //         </div>');
    //         redirect('admin/c_rs/detail_ketersediaan/'. $id);
    //     }
    // }

    // public function tambah_ketersediaan() {
    //     $data['title'] = "Tambah Ketersediaan RS - SIKK RS";
    //     $data['rs'] = $this->rs->getRS();
    //     $data['ketersediaan'] = $this->ketersediaan->getAll();
    //     $data['kelas'] = $this->db->get('data_kelas')->result_array();

    //     $id_rs = $this->input->post('id_rs');
    
    //     $this->form_validation->set_rules('id_kelas[]', 'ID Kelas', 'required|trim');
    //     $this->form_validation->set_rules('kapasitas[]', 'Kapasitas', 'required|trim');
    //     $this->form_validation->set_rules('tersedia[]', 'Tersedia', 'required|trim');
    
    //     if ($this->form_validation->run() == false) {
    //         $this->load->view('templates/header', $data);
    //         $this->load->view('templates/sidebar');
    //         $this->load->view('templates/topbar');
    //         $this->load->view('admin/rs/v_tambahketersediaan', $data);
    //         $this->load->view('templates/content_footer');
    //         $this->load->view('templates/footer');
    //     } else {
    //         $this->ketersediaan->postRS($id_rs);
    //         $this->session->set_flashdata('pesan', 
    //         '<div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
    //             Ketersediaan Rumah Sakit berhasil diperbarui!
    //             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //         </div>');
    //         redirect('admin/c_rs/detail_ketersediaan/'. $id_rs);
    //     }
    // }

    // public function ketersediaan__() {
    //     header('Access-Control-Allow-Origin: *');
    //     $id_rs = $this->input->get('id_rs');
    //     $data = $this->ketersediaan->getAll($id_rs);
        
    //     echo json_encode($data);
    // }
}
