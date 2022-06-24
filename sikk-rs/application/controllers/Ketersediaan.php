<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Ketersediaan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ketersediaan_Model');
    }

    public function index()
    {
        // $data['all'] = $this->Ketersediaan_Model->getAllKetersediaan();
        $data['faskes'] = $this->Ketersediaan_Model->getFaskes();
        $data['kelas'] = $this->Ketersediaan_Model->getKelas();
        // $data['puskesmas'] = $this->Ketersediaan_Model->getPuskesmas();
        // $data['jumlah_puskesmas'] = $this->Ketersediaan_Model->getJumlahPuskesmas();
        
        $this->load->view('templates/header');
        $this->load->view('ketersediaan/index', $data);
        $this->load->view('templates/footer');
    }

    public function detailFaskes()
    {
        header('Access-Control-Allow-Origin: *');
        $nama = $this->input->get('nama');
        $data = $this->Ketersediaan_Model->getFaskesByNama($nama);
        echo json_encode($data);
    }

    public function detailKelas()
    {
        header('Access-Control-Allow-Origin: *');
        $kelas = $this->input->get('kelas');
        $data = $this->Ketersediaan_Model->getFaskesByKelas($kelas);
        echo json_encode($data);
    }
}