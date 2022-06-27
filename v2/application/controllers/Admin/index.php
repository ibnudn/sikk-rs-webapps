<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Admin extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index() {
		redirect('Admin/C_Admin');
	}
}
