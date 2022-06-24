<?php

function is_logged_in() {
    $ci = get_instance();
    if(!$ci->session->id_user) {
		redirect('auth');
    } else {
		$id_role = $ci->session->id_role;
        $menu = $ci->uri->segment(1);
		
        $queryMenu = $ci->db->get_where('tb_user_menu', ['uri' => $menu])->row_array();
        $userAccess = $ci->db->get_where('tb_user_akses', [
			'id_role' => $id_role,
            'id_menu' => $queryMenu['id_menu']
        ]);
		// var_dump($ci->session);
		
        if ($userAccess->num_rows() < 1) {
			redirect('auth/blocked');
        }
		
		
    }
}

function is_pegawai() {
	$ci = get_instance();
	$id_role = $ci->session->id_role;
	if($id_role == 2) {
		$id_faskes = $ci->session->id_faskes;
			
		$currentFaskes = $ci->uri->segment(4);
		// var_dump($id_faskes, $currentFaskes);
		if($currentFaskes && ($id_faskes != $currentFaskes)) {
			redirect('auth/blocked');
		}
	}
}
