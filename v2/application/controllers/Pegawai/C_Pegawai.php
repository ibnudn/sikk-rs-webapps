<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Pegawai extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Menu', 'menu');
        $this->load->model('M_Faskes', 'faskes');
        $this->load->model('M_Kapasitas', 'kapasitas');
        $this->load->model('M_Ketersediaan', 'ketersediaan');
        is_logged_in();
		is_pegawai();
    }

    public function index() {
		$id_faskes = $this->session->id_faskes;

        $data['title'] = "Dashboard Pegawai - SIKK RS";
        $data['menu'] = $this->menu->menu();
		$data['faskes'] = $this->faskes->get_faskesID($id_faskes);
        $data['kapasitas'] = $this->kapasitas->get_kapasitasID($id_faskes);
        $data['ketersediaan'] = $this->ketersediaan->get_joinKapasitasID($id_faskes);
		$data['jumlah_kapasitas'] = $this->kapasitas->jumlah_kapasitas($id_faskes);
		$data['jumlah_ketersediaan'] = $this->ketersediaan->jumlah_ketersediaan($id_faskes);

		if(!$id_faskes) {
			$this->session->set_flashdata('mssg', 
				'<div class="alert alert-danger alert-dismissible fade show mx-3" role="alert">
					<strong>Data Faskes tidak ditemukan!</strong> Isi data faskes <a href="c_faskes/tambah_faskes" class="alert-link">di sini</a>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>'
			);
		} else if(!$data['jumlah_kapasitas'][0]->kapasitas) {
			$this->session->set_flashdata('mssg', 
				'<div class="alert alert-danger alert-dismissible fade show mx-3" role="alert">
					<strong>Data kapasitas belum diisi!</strong> Segera isi <a href="c_kapasitas/tambah_kapasitas/'.$id_faskes.'" class="alert-link">di sini</a>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>'
			);
		}
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar');
		$this->load->view('pegawai/index', $data);
		$this->load->view('templates/content_footer');
		$this->load->view('templates/footer');
    }
}
