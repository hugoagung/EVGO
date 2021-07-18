<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Controller ini FUNGSINYA buat segala aktivitas yang BERHUBUNGAN sama VIEWS trus nyambungkin ke database
// JADI KALO LU mau ngubungin views ke database, lewat sini, disambungin ke MODEL

class Masuk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $this->load->model('Masuk_model');

        $data['user'] = $this->db->get_where('admin', ['email_admin' => $this->session->userdata('email')])->row_array();
        // MISALNYA lu masu ngambil db barang masuk di model tadi
        $data['Barang_masuk'] = $this->Masuk_model->barang_masuk(); // kok eror asu mana gw tau asw 

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('barang/barang_masuk');
        $this->load->view('template/footer');
    }
}
