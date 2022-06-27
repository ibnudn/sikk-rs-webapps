<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Menu', 'menu');
        $this->load->model('M_Faskes', 'faskes');
        $this->load->model('M_Users', 'user');
        is_logged_in();
    }

    public function index() {
        $data['title'] = "Dashboard Admin - SIKK RS";
        $data['menu'] = $this->menu->menu();
		$data['jumlah_faskes'] = $this->faskes->jumlah_faskes();
		$data['jumlah_user'] = $this->user->jumlah_user();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('admin/index', $data);
        $this->load->view('templates/content_footer');
        $this->load->view('templates/footer');
    }
}
