<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Kapasitas extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        
        $this->load->model('M_Menu', 'menu');
        $this->load->model('M_Kapasitas', 'kapasitas');
        $this->load->model('M_Faskes', 'faskes');
        $this->load->model('M_Log', 'dataLog');
    }

    public function index() {
        $data['title'] = "Kapasitas Faskes - SIKK RS";
        $data['menu'] = $this->menu->menu();
        $data['kapasitas'] = $this->kapasitas->get_kapasitas();
        // print_r($this->db->last_query());

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('admin/kapasitas/v_kapasitas', $data);
        $this->load->view('templates/content_footer');
        $this->load->view('templates/footer');
    }

    public function detail_kapasitas($id_faskes) {
        $data['title'] = "Detail Kapasitas Faskes - SIKK RS";
        $data['menu'] = $this->menu->menu();
        $data['kapasitas'] = $this->kapasitas->get_kapasitasID($id_faskes);
        $data['faskes'] = $this->faskes->get_faskesID($id_faskes);
        // print_r($this->db->last_query());

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('admin/kapasitas/v_detailkapasitas', $data);
        $this->load->view('templates/content_footer');
        $this->load->view('templates/footer');
    }
    
    public function riwayat_kapasitas() {
        $id_faskes = $this->input->get('id_faskes');
        $id_kelas = $this->input->get('id_kelas');
        $data = $this->dataLog->get_logKapasitas($id_faskes, $id_kelas);
        echo json_encode($data);
    }

    public function update_kapasitas($id_faskes) {
        $data['title'] = "Detail Kapasitas Faskes - SIKK RS";
        $data['menu'] = $this->menu->menu();
        $data['kapasitas'] = $this->kapasitas->get_kapasitasID($id_faskes);
        
        $this->form_validation->set_rules('id_faskes', 'ID Faskes', 'required|trim', [
            'required' => '%s perlu diisi',
        ]);
        $this->form_validation->set_rules('id_kelas[]', 'ID Kelas', 'required|trim', [
            'required' => '%s perlu diisi',
        ]);
        $this->form_validation->set_rules('kapasitas[]', 'Kapasitas', 'required|trim', [
            'required' => '%s perlu diisi',
        ]);
        
        if ($this->form_validation->run() == false) {
            redirect('admin/kapasitas/detail_kapasitas/'.$id_faskes);
        } else {
            $this->kapasitas->update_kapasitas();
            $this->dataLog->tambah_logKapasitas();
            print_r($this->input->post('ketersediaan'));
            $this->session->set_flashdata('pesan', 
            '<div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
                Data Kapasitas berhasil diperbarui!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');
                redirect('admin/kapasitas/detail_kapasitas/'.$id_faskes);
        }
    }

    public function tambah_kapasitas($id_faskes) {
        $data['title'] = "Tambah Kapasitas Faskes - SIKK RS";
        $data['menu'] = $this->menu->menu();
        $data['kapasitas'] = $this->kapasitas->get_kapasitasID($id_faskes);
		$data['faskes'] = $this->faskes->get_faskesID($id_faskes);
        $data['kelas'] = $this->db->get('tb_kelas')->result_array();

        $this->form_validation->set_rules('id_faskes', 'ID Faskes', 'required|trim', [
			'required' => '%s perlu diisi',
		]);
		
		$_id_kelas = $this->input->post('id_kelas');
		// print_r($_id_kelas); echo "<br>";
		// print_r($this->input->post());
		if ($_id_kelas) {
			for ($i=0; $i < count($_id_kelas); $i++) { 
				$this->form_validation->set_rules('id_kelas['.$i.']', 'Kelas', 'required|trim', [
					'required' => '%s belum dipilih',
				]);
			}
		}

		$_kapasitas = $this->input->post('kapasitas');
		// print_r($_kapasitas);
		if($_kapasitas) {
			for ($i=0; $i < count($_kapasitas) ; $i++) {
				$this->form_validation->set_rules('kapasitas['.$i.']', 'Kapasitas', 'required|trim|is_natural', [
					'required' => '%s perlu diisi',
					'is_natural' => '%s tidak valid (Angka harus lebih atau sama dengan 0)',
				]);
			}
		}
        
        if ($this->form_validation->run() == false) {
			$data['token_name'] = $this->security->get_csrf_token_name();
			$data['token_hash'] = $this->security->get_csrf_hash();

			$err = array();
			// $err['kelas'][$i] = form_error('id_kelas[]');
			if ($_kapasitas) {
				for ($i=0; $i < count($_kapasitas) ; $i++) {
					$err['kelas'][$i] = form_error('id_kelas['.$i.']');
					$err['kapasitas'][$i] = form_error('kapasitas['.$i.']');
				}
			}
			$data['err'] = json_encode($err);
			$data['inputKelas'] = json_encode($_id_kelas);
			$data['inputKapasitas'] = json_encode($_kapasitas);

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar');
            $this->load->view('admin/kapasitas/v_tambahkapasitas', $data);
            $this->load->view('templates/content_footer');
            $this->load->view('templates/footer');
        } else {
            $this->kapasitas->tambah_kapasitas();
            $this->dataLog->tambah_logKapasitas();
            $this->session->set_flashdata('pesan', 
            '<div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
                Data Kapasitas berhasil ditambahkan!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');
                redirect('admin/kapasitas/detail_kapasitas/'.$id_faskes);
        }
    }

    public function tambah_kapasitas_faskes() {
        $data['title'] = "Tambah Kapasitas Faskes - SIKK RS";
        $data['menu'] = $this->menu->menu();
        $data['faskes'] = $this->faskes->get_faskes();
        $data['kapasitas'] = $this->kapasitas->get_kapasitas();
        $data['kelas'] = $this->db->get('tb_kelas')->result_array();        
        
		/* 
        * ----------------------------------------------
        * Membandingkan faskes yang kapasitasnya sudah ada
        * -----------------------------------------------
        */ 
        $faskes_ada = array();
        foreach($data['kapasitas'] as $row) {
            // array_push($kapasitas_ada, $row['id_faskes']);
            $faskes_ada[] = array(
                'id_faskes'  => $row['id_faskes'],
                'nama_faskes' => $row['nama_faskes']
            );
        }
        $faskes_kosong = array();
        foreach($data['faskes'] as $row) {
            // array_push($faskes, $row['id_faskes']);
            $faskes_kosong[] = array(
                'id_faskes'  => $row['id_faskes'],
                'id_tipe_faskes' => $row['id_tipe_faskes'],
                'nama_faskes' => $row['nama_faskes']
            );
        }
        function perbandingan_faskes($a, $b) {
            foreach ($a as $data) {
                $aVal = is_array($data) ? $data['id_faskes'] : $data;
            }
            foreach ($b as $data) {
                $bVal = is_array($data) ? $data['id_faskes'] : $data;
            }
            return strcasecmp($aVal, $bVal);
        }
        $data['faskes_kosong'] = array_udiff($faskes_kosong, $faskes_ada, 'perbandingan_faskes');
        /* ------------------------------------------------------------------------ */

		/* 
		* Form Validation
		*/ 
		$_id_faskes = $this->input->post('id_faskes');
		$this->form_validation->set_rules('id_faskes', 'ID Faskes', 'required|trim', [
			'required' => '%s perlu diisi',
		]);
		$_id_kelas = $this->input->post('id_kelas');
		// print_r($_id_kelas); echo "<br>";
		// print_r($this->input->post());
		if ($_id_kelas) {
			for ($i=0; $i < count($_id_kelas); $i++) { 
				$this->form_validation->set_rules('id_kelas['.$i.']', 'Kelas', 'required|trim', [
					'required' => '%s belum dipilih',
				]);
			}
		}

		$_kapasitas = $this->input->post('kapasitas');
		// print_r($_kapasitas);
		if($_kapasitas) {
			for ($i=0; $i < count($_kapasitas) ; $i++) {
				$this->form_validation->set_rules('kapasitas['.$i.']', 'Kapasitas', 'required|trim|is_natural', [
					'required' => '%s perlu diisi',
					'is_natural' => '%s tidak valid (Angka harus lebih atau sama dengan 0)',
				]);
			}
		}
		// validation--------------------------------------------------------

        // $this->form_validation->set_rules('id_faskes', 'ID Faskes', 'required|trim', [
        //     'required' => '%s perlu diisi',
        // ]);
        // $this->form_validation->set_rules('id_kelas[]', 'ID Kelas', 'required|trim', [
        //     'required' => '%s perlu diisi',
        // ]);
        // $this->form_validation->set_rules('kapasitas[]', 'Kapasitas', 'required|trim', [
        //     'required' => '%s perlu diisi',
        // ]);
        
        if ($this->form_validation->run() == false) {
			$data['token_name'] = $this->security->get_csrf_token_name();
			$data['token_hash'] = $this->security->get_csrf_hash();

			$err = array();
			// $err['kelas'][$i] = form_error('id_kelas[]');
			$err['faskes'] = form_error('id_faskes');
			if ($_kapasitas) {
				for ($i=0; $i < count($_kapasitas) ; $i++) {
					$err['kelas'][$i] = form_error('id_kelas['.$i.']');
					$err['kapasitas'][$i] = form_error('kapasitas['.$i.']');
				}
			}
			$data['err'] = json_encode($err);
			$data['inputFaskes'] = json_encode($_id_faskes);
			$data['inputKelas'] = json_encode($_id_kelas);
			$data['inputKapasitas'] = json_encode($_kapasitas);

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar');
            $this->load->view('admin/kapasitas/v_tambahkapasitasfaskes', $data);
            $this->load->view('templates/content_footer');
            $this->load->view('templates/footer');
        } else {
            $this->kapasitas->tambah_kapasitas();
            $this->dataLog->tambah_logKapasitas();
            $this->session->set_flashdata('pesan', 
            '<div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
                Data Kapasitas berhasil ditambahkan!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');
                redirect('admin/kapasitas');
        }
    }

	public function kapasitas__() {
		$id_faskes = $this->input->get('id_faskes');
		$kapasitas = $this->kapasitas->get_kapasitasID($id_faskes);
		$kelas = $this->db->get('tb_kelas')->result_array();

		/* 
        * ----------------------------------------------
        * Membandingkan kelas yang kapasitasnya sudah ada
        * -----------------------------------------------
        */ 
        $kapasitas_ada = array();
        foreach($kapasitas as $row) {
            // array_push($kapasitas_ada, $row['id_kelas']);
            $kapasitas_ada[] = array(
                'id_kelas'  => $row['id_kelas'],
                'nama_kelas' => $row['nama_kelas']
            );
        }
        $kelas_kosong = array();
        foreach($kelas as $row) {
            // array_push($kelas, $row['id_kelas']);
            $kelas_kosong[] = array(
                'id_kelas'  => $row['id_kelas'],
                'nama_kelas' => $row['nama_kelas']
            );
        }
        function perbandingan_kelas1($a, $b) {
            foreach ($a as $data) {
                $aVal = is_array($data) ? $data['id_kelas'] : $data;
            }
            foreach ($b as $data) {
                $bVal = is_array($data) ? $data['id_kelas'] : $data;
            }
            return strcasecmp($aVal, $bVal);
        }
        $data = array_udiff($kelas_kosong, $kapasitas_ada, 'perbandingan_kelas1');
        /* ------------------------------------------------------------------------ */

		echo json_encode($data);
	}

	public function kapasitas_faskes__() {
		$faskes = $this->faskes->get_faskes();
        $kapasitas = $this->kapasitas->get_kapasitas();
		
		/* 
        * ----------------------------------------------
        * Membandingkan faskes yang kapasitasnya sudah ada
        * -----------------------------------------------
        */ 
        $faskes_ada = array();
        foreach($kapasitas as $row) {
            // array_push($kapasitas_ada, $row['id_faskes']);
            $faskes_ada[] = array(
                'id_faskes'  => $row['id_faskes'],
                'nama_faskes' => $row['nama_faskes']
            );
        }
        $faskes_kosong = array();
        foreach($faskes as $row) {
            // array_push($faskes, $row['id_faskes']);
            $faskes_kosong[] = array(
                'id_faskes'  => $row['id_faskes'],
                'id_tipe_faskes' => $row['id_tipe_faskes'],
                'nama_faskes' => $row['nama_faskes']
            );
        }
        function perbandingan_faskes1($a, $b) {
            foreach ($a as $data) {
                $aVal = is_array($data) ? $data['id_faskes'] : $data;
            }
            foreach ($b as $data) {
                $bVal = is_array($data) ? $data['id_faskes'] : $data;
            }
            return strcasecmp($aVal, $bVal);
        }
        $data = array_udiff($faskes_kosong, $faskes_ada, 'perbandingan_faskes1');
        /* ------------------------------------------------------------------------ */

		echo json_encode($data);
	}
}
