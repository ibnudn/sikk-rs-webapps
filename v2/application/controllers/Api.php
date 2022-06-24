<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('M_Api', 'api');
        header('Access-Control-Allow-Origin: *');
    }

    public function faskes_get() {
        $id = $this->input->get('id');
        $nama = $this->input->get('nama');
        
        if (!$id && !$nama) {
            $api = $this->api->get_joinKapasitas();
        } else if (!$id) {
            $api = $this->api->get_joinKapasitasNama($nama);
        } else {
            $api = $this->api->get_joinKapasitasID($id);
        }

        if ($api) {
            $this->response($api, 200 );
        } else {
            $this->response( [
                'status' => false,
                'message' => 'No such data found'
            ], 404 );
        }
    }

    public function kelas_get() {
        $id = $this->input->get('id');
        $kelas = $this->input->get('kelas');
        
        if (!$id && !$kelas) {
            $api = $this->api->get_byKelas();
        } else if (!$id) {
            $api = $this->api->get_byKelasNama($kelas);
        } else {
            $api = $this->api->get_byKelasID($id);
        }

        if ($api) {
            $this->response($api, 200 );
        } else {
            $this->response( [
                'status' => false,
                'message' => 'No such data found'
            ], 404 );
        }
    }

    // public function allRS_get() {
    //     $id = $this->input->get('id');
    //     $nama = $this->input->get('nama');
    //     $kelas = $this->input->get('kelas');
    //     $search = $this->input->get('search');
    //     if (!!$search) {
    //         $ketersediaan = $this->ketersediaan->search($search);
    //         // print_r($this->db->last_query());
    //     } else if (!$id && !$nama&& !$kelas) {
    //         $ketersediaan = $this->ketersediaan->getAll();
    //     } else if ($nama === null && $kelas === null) {
    //         $ketersediaan = $this->ketersediaan->getAll($id);
    //     } else if ($kelas === null){
    //         $ketersediaan = $this->ketersediaan->getAllByNama($nama);
    //     } else if ($nama === null) {
    //         $ketersediaan = $this->ketersediaan->getAllByKelas($kelas);
    //     } else {
    //         $ketersediaan = $this->ketersediaan->getAllByNamaKelas($nama, $kelas);
    //     }

    //     if ($ketersediaan) {
    //         $this->response($ketersediaan, 200 );
    //     } else {
    //         $this->response( [
    //             'status' => false,
    //             'message' => 'No such data found'
    //         ], 404 );
    //     }
    // }

    // public function rs_get() {
    //     $nama = $this->input->get('nama');

    //     if ($nama === null) {
    //         $ketersediaan = $this->ketersediaan->getRS();
    //         // print_r($this->db->last_query());
    //     } else {
    //         $ketersediaan = $this->ketersediaan->getRS($nama);
    //     }

    //     if ($ketersediaan) {
    //         $this->response($ketersediaan, 200 );
    //     } else {
    //         $this->response( [
    //             'status' => false,
    //             'message' => 'No such data found'
    //         ], 404 );
    //     }
    // }
    
    // public function kelas_get() {
    //     $kelas = $this->input->get('kelas');
        
    //     if ($kelas === null) {
    //         $ketersediaan = $this->ketersediaan->getKelas();
    //     } else {
    //         $ketersediaan = $this->ketersediaan->getKelas($kelas);
    //     }
        
    //     if ($ketersediaan) {
    //         $this->response($ketersediaan, 200 );
    //     } else {
    //         $this->response( [
    //             'status' => false,
    //             'message' => 'No such data found'
    //         ], 404 );
    //     }
    // }
    
    // public function puskesmas_get() {
    //     $nama = $this->input->get('nama');

    //     if ($nama === null) {
    //         $ketersediaan = $this->ketersediaan->getPuskesmas();
    //         // print_r($this->db->last_query());
    //     } else {
    //         $ketersediaan = $this->ketersediaan->getPuskesmas($nama);
    //     }

    //     if ($ketersediaan) {
    //         $this->response($ketersediaan, 200 );
    //     } else {
    //         $this->response( [
    //             'status' => false,
    //             'message' => 'No such data found'
    //         ], 404 );
    //     }
    // }
    
    // public function jumlah_puskesmas_get() {
    //     $ketersediaan = $this->ketersediaan->getPuskesmasJumlah();
        
    //     if ($ketersediaan) {
    //         $this->response($ketersediaan, 200 );
    //     } else {
    //         $this->response( [
    //             'status' => false,
    //             'message' => 'No such data found'
    //         ], 404 );
    //     }
    // }
    
    // public function allRS_post() {
    //     $id = $this->input->post('id');
    //     $ketersediaan = $this->ketersediaan->postRS($id);

    //     if ($ketersediaan) {
    //         $this->response($ketersediaan, 201 );
    //     } else {
    //         $this->response( [
    //             'status' => false,
    //             'message' => 'Fail inserting data'
    //         ], 304 );
    //     }
    // }
    
    // public function puskesmas_post() {
    //     $id = $this->input->post('id');
    //     $ketersediaan = $this->ketersediaan->postPuskesmas($id);

    //     if ($ketersediaan) {
    //         $this->response($ketersediaan, 201 );
    //     } else {
    //         $this->response( [
    //             'status' => false,
    //             'message' => 'Fail inserting data'
    //         ], 304 );
    //     }
    // }

    // public function nyoba_get() {
    //     $ketersediaan = $this->ketersediaan->nyoba();
        
    //     foreach ($ketersediaan as $row) {
    //         $_new[] = json_decode($row['data']);
    //     }
        
    //     if ($_new) {
    //         $this->response($_new, 200 );
    //     } else {
    //         $this->response( [
    //             'status' => false,
    //             'message' => 'No such data found'
    //         ], 404 );
    //     }
    // }
}