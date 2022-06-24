<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Auth', 'auth');
    }

    public function index() {
        $this->default();
        $data['title'] = "Login - SIKK RS";

        $this->load->view('templates/header', $data);
        $this->load->view('auth/login');
        $this->load->view('templates/footer');
    }

    public function login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $row = $this->auth->getLogin($username);
        
        if (!$row) {
            $this->session->set_flashdata('err_username', 
            'Username Anda Salah');
            // $this->session->set_flashdata('pesan', 
            // '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            // <strong>Perhatian!</strong> Username Anda Salah
            // <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            // </div>');
            redirect('auth');
        } else {
            if (password_verify($password, $row['password'])) {
                $this->session->set_flashdata('pesan', 
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sukses!</strong> Berhasil login
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');
                
                if ($row['id_role'] == 1) {
                    $data = array(
                        'log'       => TRUE,
                        'id_user'   => $row['id_user'],
                        'username'  => $row['username'],
                        'id_role'      => $row['id_role'],
                        'role'      => $row['nama_role']
                    );
                    
                    $this->session->set_userdata($data);
                    redirect('admin');
                } else if ($row['id_role'] == 2) {
                    $faskes = $this->auth->getPegawaiID($row['id_user']);
                    $data = array(
                        'log'       => TRUE,
                        'id_user'   => $row['id_user'],
                        'username'  => $row['username'],
                        'id_role'   => $row['id_role'],
                        'role'      => $row['nama_role'],
                        'id_faskes'     => $faskes['id_faskes']
                    );
                    
                    $this->session->set_userdata($data);
                    redirect('pegawai');
                }
            } else {
                $this->session->set_flashdata('uname_val', $username);
                $this->session->set_flashdata('err_password', 'Password Anda Salah');
                // $this->session->set_flashdata('pesan', 
                //     '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                //         <strong>Perhatian!</strong> Password Anda Salah
                //         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                //     </div>');
                redirect('auth');
            }
        }
    }

    public function logout() {
        $userdata = array(
            'log',
            'id_user',
            'username',
			'id_role',
            'role',
            'id_rs',
            'id_puskesmas'
        );
        $this->session->unset_userdata($userdata);
        $this->session->unset_userdata('id_rs');
        
        $this->session->set_flashdata('pesan', 
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Anda berhasil keluar!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
        redirect('auth');
    }

    public function default() {
        if ($this->session->id_role == 1) {
            redirect('admin');
        } else if ($this->session->id_role == 2) {
            redirect('pegawai');
        } else {
            // redirect('auth');
        }
    }
    
    public function blocked() {
        $data['title'] = "Halaman Diblokir - SIKK RS";
        // print_r($this->session->id_role);

        $this->load->view('templates/header', $data);
        $this->load->view('auth/blocked');
        $this->load->view('templates/footer');
    }
}
