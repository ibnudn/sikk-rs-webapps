<?php

use phpDocumentor\Reflection\PseudoTypes\True_;

defined('BASEPATH') OR exit('No direct script access allowed');

class C_Ketersediaan extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
		is_pegawai();

        $this->load->model('M_Menu', 'menu');
        $this->load->model('M_Ketersediaan', 'ketersediaan');
        $this->load->model('M_Kapasitas', 'kapasitas');
        $this->load->model('M_Faskes', 'faskes');
        $this->load->model('M_Log', 'dataLog');
    }

    public function index() {
		$id_faskes = $this->session->id_faskes;
		$data['token_name'] = $this->security->get_csrf_token_name();
		$data['token_hash'] = $this->security->get_csrf_hash();

        $data['title'] = "Ketersediaan Faskes - SIKK RS";
        $data['menu'] = $this->menu->menu();
        $data['ketersediaan'] = $this->ketersediaan->get_joinKapasitasID($id_faskes);
        $data['faskes'] = $this->faskes->get_faskesID($id_faskes);
		$data['cookies'] = $this->input->cookie(); 
		
        // print_r($this->db->last_query());
        
		if(!$data['ketersediaan']) {
			if(!$id_faskes) {
				$this->session->set_flashdata('pesan', 
            		'<div class="alert alert-danger alert-dismissible fade show mx-3" role="alert">
                		Data Faskes belum terisi!
                		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                	</div>'
				);
				redirect('pegawai/c_faskes/tambah_faskes');
			} else {
				redirect('pegawai/c_ketersediaan/tambah_ketersediaan/'.$id_faskes);
			}
		} else {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar');
			$this->load->view('pegawai/ketersediaan/v_ketersediaan', $data);
			$this->load->view('templates/content_footer');
			$this->load->view('templates/footer');
		}
    }
    
    public function riwayat_ketersediaan() {
        $id_faskes = $this->input->get('id_faskes');
        $id_kelas = $this->input->get('id_kelas');
        $data = $this->dataLog->get_logKetersediaan($id_faskes, $id_kelas);
        echo json_encode($data);
    }

    public function update_ketersediaan($id_faskes) {
		$data['title'] = "Detail Ketersediaan Faskes - SIKK RS";
        $data['menu'] = $this->menu->menu();
        $data['ketersediaan'] = $this->ketersediaan->get_ketersediaanID($id_faskes);
		$data['cookies'] = $this->input->cookie(); 
		
        
        $this->form_validation->set_rules('id_faskes', 'Faskes', 'required|trim', [
            'required' => '%s perlu diisi',
        ]);
        $this->form_validation->set_rules('id_kelas[]', 'Kelas', 'required|trim', [
            'required' => '%s perlu diisi',
        ]);
        $this->form_validation->set_rules('ketersediaan[]', 'Ketersediaan', 'required|trim|less_than_equal_to['.$this->input->post('kapasitas').']', [
            'required' => '%s perlu diisi',
            'less_than_equal_to' => '%s melebihi kapasitas'
        ]);
        
        if ($this->form_validation->run() == false) {
            $data['error_message'] = form_error('ketersediaan[]');
			$data['token_name'] = $this->security->get_csrf_token_name();
			$data['token_hash'] = $this->security->get_csrf_hash();
            echo json_encode($data);
        } else {
            $this->ketersediaan->update_ketersediaan();
            $this->dataLog->tambah_logKetersediaan();
            $this->session->set_flashdata('pesan', 
            '<div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
                Data ketersediaan berhasil diperbarui!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');
                // redirect('pegawai/c_ketersediaan/');
        }
    }

    public function tambah_ketersediaan($id_faskes) {
        $data['title'] = "Tambah Ketersediaan Faskes - SIKK RS";
        $data['menu'] = $this->menu->menu();
        $data['kelas'] = $this->db->get('tb_kelas')->result_array();
        $data['ketersediaan'] = $this->ketersediaan->get_ketersediaanID($id_faskes);
		$data['faskes'] = $this->faskes->get_faskesID($id_faskes);
		
		/* 
		* -------- FORM VALIDATION --------
		*/
        $this->form_validation->set_rules('id_faskes', 'Faskes', 'required|trim', [
            'required' => '%s perlu diisi',
        ]);
        $this->form_validation->set_rules('id_kelas[]', 'Kelas', 'required|trim', [
            'required' => '%s perlu diisi',
        ]);
		$_kapasitas = $this->input->post('kapasitas');
		$_ketersediaan = $this->input->post('ketersediaan');
		if ($_ketersediaan) {
			$y=0;
			for ($i=0; $i < count($_ketersediaan) ; $i++) {
				$this->form_validation->set_rules('ketersediaan['.$i.']', 'Ketersediaan', 
					array(
						'required', 'trim', 'is_natural',
						'callback_checkKapasitas1['.$_kapasitas[$y].']'
					),
					array(
						'required' => '%s perlu diisi',
						'is_natural' => '%s tidak valid (Angka harus lebih atau sama dengan 0)',
						'checkKapasitas1' => '%s melebihi kapasitas'
					)
				);
				$y++;
			}
		}
		// ---------------------------
        
        if ($this->form_validation->run() == false) {
			$data['token_name'] = $this->security->get_csrf_token_name();
			$data['token_hash'] = $this->security->get_csrf_hash();

			$err = array();
			if ($_ketersediaan) {
				for ($i=0; $i < count($_ketersediaan) ; $i++) {
					$err[$i] = form_error('ketersediaan['.$i.']');
				}
			}
			$data['err'] = json_encode($err);
			$data['inputKetersediaan'] = json_encode($_ketersediaan);

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar');
            $this->load->view('pegawai/ketersediaan/v_tambahketersediaan', $data);
            $this->load->view('templates/content_footer');
            $this->load->view('templates/footer');
        } else {
            $this->ketersediaan->tambah_ketersediaan();
            $this->dataLog->tambah_logKetersediaan();
            $this->session->set_flashdata('pesan', 
            '<div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
                Data ketersediaan berhasil ditambahkan!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');
                redirect('pegawai/c_ketersediaan/');
        }
    }

	public function checkKapasitas() {
		$kapasitas = $this->input->post('kapasitas');
		$ketersediaan = $this->input->post('ketersediaan');
		if ($ketersediaan > $kapasitas) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function checkKapasitas1($ketersediaan, $kapasitas) {
		// echo'<br>';
		// var_dump($ketersediaan, $kapasitas);
		if ($ketersediaan > $kapasitas) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

    public function kapasitas_faskes__() {
        $id_faskes = $this->input->get('id_faskes');
        $data = $this->kapasitas->get_kapasitasID($id_faskes);
        
        echo json_encode($data);
    }

    public function kapasitas__() {
        $id_faskes = $this->input->get('id_faskes');
        $kapasitas = $this->kapasitas->get_kapasitasID($id_faskes);
        $ketersediaan = $this->ketersediaan->get_ketersediaanID($id_faskes);

        /* 
        * ----------------------------------------------
        * Membandingkan kelas yang ketersediaannya sudah ada
        * -----------------------------------------------
        */ 
        $kapasitas_ada = array();
        foreach($kapasitas as $row) {
            $kapasitas_ada[] = array(
                'id_kelas'  => $row['id_kelas'],
                'nama_kelas' => $row['nama_kelas'],
                'kapasitas' => $row['kapasitas']
            );
        }
        $ketersediaan_ada = array();
        foreach($ketersediaan as $row) {
            $ketersediaan_ada[] = array(
                'id_kelas'  => $row['id_kelas'],
                'nama_kelas' => $row['nama_kelas']
            );
        }
        function perbandingan_kelas($a, $b) {
            // foreach ($a as $data) {
            //     $aVal = is_array($data) ? $data['id_kelas'] : $data;
            // }
            // foreach ($b as $data) {
            //     $bVal = is_array($data) ? $data['id_kelas'] : $data;
            // }
            // return strcasecmp($aVal, $bVal);
            $kelasA = $a['id_kelas'];
            $kelasB = $b['id_kelas'];
            if ($kelasA < $kelasB) {
                return -1;
            } elseif ($kelasA > $kelasB) {
                return 1;
            } else {
                return 0;
            }
        }
        $data = array_udiff($kapasitas_ada, $ketersediaan_ada, 'perbandingan_kelas');
        /* ------------------------------------------------------------------------ */
        echo json_encode($data);
    }
}
