<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Users extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
		is_logged_in();
        
        $this->load->model('M_Menu', 'menu');
        $this->load->model('M_Users', 'user');
        $this->load->model('M_Faskes', 'faskes');
    }

    public function index() {
        $data['title'] = "Data User - SIKK RS";
        $data['menu'] = $this->menu->menu();
        $data['user'] = $this->user->getUser();
        $data['faskes'] = json_encode($this->faskes->get_faskesTanpaPegawai());
		// print_r($this->db->last_query());

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('admin/user/v_users', $data);
        $this->load->view('templates/content_footer');
        $this->load->view('templates/footer');
    }

    public function tambah_user() {
		$data['title'] = "Tambah User - SIKK RS";
        $data['menu'] = $this->menu->menu();
        $data['user'] = $this->user->getUser();
        $data['role'] = $this->db->get('tb_role')->result_array();
		
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[tb_user.username]', [
			'required' => '%s perlu diisi',
			'is_unique' => 'Username sudah ada',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
			'required' => '%s perlu diisi',
		]);
		$this->form_validation->set_rules('id_role', 'Role', 'required|trim', [
            'required' => '%s perlu diisi',
        ]);
		
        if ($this->form_validation->run() == false) {
			$data['token_name'] = $this->security->get_csrf_token_name();
			$data['token_hash'] = $this->security->get_csrf_hash();

			$data['oldVal'] = json_encode($this->input->post());

			$err = array();
			$err['username'] = form_error('username');
			$err['password'] = form_error('password');
			$err['id_role'] = form_error('id_role');
			$data['err'] = json_encode($err);

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar');
            $this->load->view('admin/user/V_TambahUser', $data);
            $this->load->view('templates/content_footer');
            $this->load->view('templates/footer');
        } else {
            $this->user->tambah_user();
            $this->session->set_flashdata('pesan', 
            '<div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
                Data User berhasil ditambahkan!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('admin/users');
        }
    }
    
    public function edit_user($id) {
        $data['title'] = "Edit User - SIKK RS";
        $data['menu'] = $this->menu->menu();
        $data['user'] = $this->user->getUserID($id);
        $data['role'] = $this->db->get('tb_role')->result_array();

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
    
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar');
            $this->load->view('admin/user/V_EditUser', $data);
            $this->load->view('templates/content_footer');
            $this->load->view('templates/footer');
        } else {
            $this->user->edit_user($id);
            $this->session->set_flashdata('pesan', 
            '<div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
                Data User berhasil diubah!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('admin/users');
        }
    }
    
    public function hapus_user($id) {
        $this->user->hapus_user($id);
        $this->session->set_flashdata('pesan', 
        '<div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
            Data User berhasil dihapus!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
        redirect('admin/users');
    }

	public function tambah_pegawai() {
		$this->user->tambah_pegawai1();
		$this->session->set_flashdata('pesan', 
		'<div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
			Data Pegawai berhasil ditambahkan!
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>');
		redirect('admin/users');
	}
	
	public function pegawai() {
		$id_user = $this->input->get('id_user');
		$data = $this->user->getPegawaiID($id_user);
		// print_r($this->db->last_query());
        echo json_encode($data);
	}
}
