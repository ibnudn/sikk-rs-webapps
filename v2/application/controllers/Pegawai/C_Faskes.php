<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Faskes extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        
        $this->load->model('M_Menu', 'menu');
        $this->load->model('M_Faskes', 'faskes');
        $this->load->model('M_Users', 'users');
    }
    
    public function index() {
		$id_faskes = $this->session->id_faskes;

        $data['title'] = "Data Faskes - SIKK RS";
        $data['menu'] = $this->menu->menu();
        $data['faskes'] = $this->faskes->get_faskesID($id_faskes);

		if(!$data['faskes']) {
			redirect('pegawai/c_faskes/tambah_faskes');
		} else {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar');
			$this->load->view('pegawai/faskes/v_faskes', $data);
			$this->load->view('templates/content_footer');
			$this->load->view('templates/footer');

		}
    }

    public function tambah_faskes() {
		$_id_user = $this->session->id_user;
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
            $this->load->view('pegawai/faskes/v_tambahfaskes', $data);
            $this->load->view('templates/content_footer');
            $this->load->view('templates/footer');
        } else {
            $_id_faskes = $this->faskes->tambah_faskes();
			$this->users->tambah_pegawai2($_id_user, $_id_faskes);
			$this->session->set_userdata(['id_faskes' => $_id_faskes]);
            $this->session->set_flashdata('pesan', 
            '<div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
                Data Fasilitas Kesehatan berhasil ditambahkan!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');
                redirect('pegawai/c_faskes');
        }
    }
        
    public function edit_faskes($id) {
        $data['title'] = "Edit Faskes - SIKK RS";
        $data['menu'] = $this->menu->menu();
        $data['faskes'] = $this->faskes->get_faskesID($id);
        $data['kategori'] = $this->db->get('tb_kategori_faskes')->result_array();
        $data['tipe'] = $this->db->get('tb_tipe_faskes')->result_array();

		// var_dump($data['faskes']);
        
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
            $this->load->view('pegawai/faskes/v_editfaskes', $data);
            $this->load->view('templates/content_footer');
            $this->load->view('templates/footer');
        } else {
            $this->faskes->edit_faskes($id);
            $this->session->set_flashdata('pesan', 
            '<div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
                Data Rumah Sakit berhasil diubah!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('pegawai/c_faskes');
        }
    }

    public function hapus_faskes($id) {
        $this->faskes->hapus_faskes($id);
        $this->session->set_flashdata('pesan', 
        '<div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
            Data Rumah Sakit berhasil dihapus!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
        redirect('pegawai/c_faskes');
    }


}
