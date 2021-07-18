<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Evgo login';
            $this->load->view('template/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('template/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()

    {

        $email = $this->input->post('email'); //pemngambilan inputan di login dan kemudian di bungkus dengan $email
        $password = $this->input->post('password'); //pemngambilan inputan di login dan kemudian di bungkus dengan $password
        $user = $this->db->get_where('admin', ['email_admin' => $email])->row_array();
        if ($user) {
            // jika usernya aktif
            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password_admin'])) { //pengecekan password antara nilai input di login dan di database
                    // kalo sudah verify, simpan data2 di session 
                    $data = [
                        'email' => $user['email_admin'],
                        'role_id' => $user['role_id'] // untuk membedakan antara user dan admin 
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Password salah</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                email ini blom di activasi</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        tidak ada akun yang di kenali!</div>');
            redirect('auth');
        }
    }
    public function register()
    {

        $this->form_validation->set_rules('name', 'Name', 'required|trim', [
            'required' => 'Tidak Boleh Kosong Harap Di Isi!'
        ]);

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'required' => 'Tidak Boleh Kosong Harap Di Isi!',
            'is_unique' => 'Email Sudah Ada Tholol '
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'required' => 'Tidak Boleh Kosong Harap Di Isi!',
            'matches' => 'Password Harus Sama Tholol, Mau Gelud? ',
            'min_length' => 'password terlalu sedikit'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        //isi dari parameter set rule 1. nama atribut dari kolom full name,2.nama lain dari name(bebas)3.rules untuk tidka boleh kosong,4 untuk membuat spasi tidak masuk database
        //valid_email = mengindentifikasi suatu text yang di mana text itu harus berfomat email|| is unique 
        if ($this->form_validation->run() == false) {
            // <- untuk mevalidasi form yang ada di register
            // <- pastika metod form yang ada di registr sudah benar 
            $data['title'] = 'Evgo user Registration';
            $this->load->view('template/auth_header', $data); //masukan $data  untuk bisa memanggil isi dari $data 
            $this->load->view('auth/register');
            $this->load->view('template/auth_footer');
        } else {
            //jika validasinya sudah berjalan/lolos  akan langsung di jalankan ke table data_id
            // dibawah ini untuk mememudah kan memsukan ke database
            $data = [
                'name_admin' => htmlspecialchars($this->input->post('name', true)),
                'email_admin' => htmlspecialchars($this->input->post('email', true)),
                'image_admin' => 'default.jpg',
                'password_admin' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'date_created_admin' => time()
            ];
            $this->db->insert('admin', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            emailnya sudah ke create bogeng ,silahkan login bogeng</div>');
            redirect('auth');
        }
    }
    public function logout()
    {

        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            berhasil logout</div>');
        redirect('auth');
    }
    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}
