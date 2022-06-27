<?php
use GuzzleHttp\Client;

class Ketersediaan_Model extends CI_Model {
    private $_client;
    private $key = "mainappkey";

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => 'http://m3118039.mhs.d3tiuns.com/v2/api/',
        ]);    
    }

    public function getFaskes()
    {
        $response = $this->_client->request('GET', 'faskes', [
            'query' => [
                'api-key' => $this->key,
            ]
        ]);
        
        $result = json_decode($response->getBody()->getContents(), 'true');
        return $result;
    }

    public function getFaskesById($id)
    {
        $response = $this->_client->request('GET', 'faskes', [
            'query' => [
                'api-key' => $this->key,
                'id' => $id
            ]
        ]);
        
        $result = json_decode($response->getBody()->getContents(), 'true');
        return $result;
    }

    public function getFaskesByNama($nama)
    {
        $response = $this->_client->request('GET', 'faskes', [
            'query' => [
                'api-key' => $this->key,
                'nama' => $nama
            ]
        ]);
        
        $result = json_decode($response->getBody()->getContents(), 'true');
        return $result;
    }

    public function getKelas()
    {
        $response = $this->_client->request('GET', 'kelas', [
            'query' => [
                'api-key' => $this->key,
            ]
        ]);
        
        $result = json_decode($response->getBody()->getContents(), 'true');
        return $result;
    }

    public function getKelasById($id)
    {
        $response = $this->_client->request('GET', 'kelas', [
            'query' => [
                'api-key' => $this->key,
                'id' => $id
            ]
        ]);
        
        $result = json_decode($response->getBody()->getContents(), 'true');
        return $result;
    }

    public function getFaskesByKelas($nama)
    {
        $response = $this->_client->request('GET', 'kelas', [
            'query' => [
                'api-key' => $this->key,
                'kelas' => $nama
            ]
        ]);
        
        $result = json_decode($response->getBody()->getContents(), 'true');
        return $result;
    }

    // public function GetAllKetersediaan()
    // {
    //     $response = $this->_client->request('GET', 'allRS', [
    //         'query' => [
    //             'api-key' => $this->key,
    //         ]
    //     ]);
        
    //     $result = json_decode($response->getBody()->getContents(), 'true');
    //     return $result;
    // }

    // public function getKetersediaanById($id)
    // {
    //     // return $this->db->get_where('mahasiswa', ['id' => $id])->row_array();
    //     $response = $this->_client->request('GET', 'allRS', [
    //         'query' => [
    //             'api-key' => $this->key,
    //             'id' => $id
    //         ]
    //     ]);
        
    //     $result = json_decode($response->getBody()->getContents(), 'true');
    //     return $result[0];
    // }

    // public function getRSByNama($nama)
    // {
    //     // return $this->db->get_where('mahasiswa', ['id' => $id])->row_array();
    //     $response = $this->_client->request('GET', 'allRS', [
    //         'query' => [
    //             'api-key' => $this->key,
    //             'nama' => $nama
    //         ]
    //     ]);
        
    //     $result = json_decode($response->getBody()->getContents(), 'true');
    //     return $result;
    // }

    // public function getRSByKelas($kelas)
    // {
    //     // return $this->db->get_where('mahasiswa', ['id' => $id])->row_array();
    //     $response = $this->_client->request('GET', 'allRS', [
    //         'query' => [
    //             'api-key' => $this->key,
    //             'kelas' => $kelas
    //         ]
    //     ]);
        
    //     $result = json_decode($response->getBody()->getContents(), 'true');
    //     return $result;
    // }

    // public function getRS()
    // {
    //     $response = $this->_client->request('GET', 'rs', [
    //         'query' => [
    //             'api-key' => $this->key
    //         ]
    //     ]);
        
    //     $result = json_decode($response->getBody()->getContents(), 'true');
    //     return $result;
    // }
    
    // public function getKelas()
    // {
    //     $response = $this->_client->request('GET', 'kelas', [
    //         'query' => [
    //             'api-key' => $this->key,
    //         ]
    //     ]);
        
    //     $result = json_decode($response->getBody()->getContents(), 'true');
    //     return $result;
    // }

    // public function getPuskesmas()
    // {
    //     $response = $this->_client->request('GET', 'puskesmas', [
    //         'query' => [
    //             'api-key' => $this->key,
    //         ]
    //     ]);
        
    //     $result = json_decode($response->getBody()->getContents(), 'true');
    //     return $result;
    // }

    // public function getJumlahPuskesmas()
    // {
    //     $response = $this->_client->request('GET', 'jumlah_puskesmas', [
    //         'query' => [
    //             'api-key' => $this->key,
    //         ]
    //     ]);
        
    //     $result = json_decode($response->getBody()->getContents(), 'true');
    //     return $result;
    // }

    // public function nyoba()
    // {
    //     $response = $this->_client->request('GET', 'nyoba', [
    //         'query' => [
    //             'api-key' => $this->key,
    //         ]
    //     ]);
        
    //     $result = json_decode($response->getBody()->getContents(), 'true');
    //     return $result;
    // }
}