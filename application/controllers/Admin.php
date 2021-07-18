<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('admin', ['email_admin' => $this->session->userdata('email')])->row_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('template/footer');
    }

    // USERS Functions
    public function users()
    {
        $this->load->model('users_model');
        $user = $this->db->get_where('admin', ['email_admin' => $this->session->userdata('email')])->row_array();
        $users = $this->users_model->ambil_semua_data_user();

        $data = [
            'title' => 'Users',
            'user' => $user,
            'users' => $users,
        ];

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/users/index', $data);
        $this->load->view('template/footer');
    }

    public function ganti_role()
    {
        $this->load->model('users_model');
        $data = [
            'role_id' => $this->input->post('role_id')
        ];

        $id = $this->input->post('id');
        $proses = $this->users_model->ganti_role($data, $id);

        if ($proses) {
            $this->session->set_flashdata('sukses', 'Berhasil ganti role user .');
            redirect('/admin/users');
        } else {
            $this->session->set_flashdata('eror', 'Gagal ');
            redirect('/admin/users');
        }
    }
    public function hapus_users($id)
    {
        $this->load->model('users_model');
        $proses = $this->users_model->hapus_data_admin($id);

        if ($proses) {
            $this->session->set_flashdata('sukses', 'Berhasil hapus user');
            redirect('/admin/users');
        } else {
            $this->session->set_flashdata('eror', 'Gagal ');
            redirect('/admin/users');
        }
    }

    public function tambah_user()
    {
        $user = $this->db->get_where('admin', ['email_admin' => $this->session->userdata('email')])->row_array();
        $data = [
            'title_admin' => 'Tambah User',
            'user' => $user,
        ];

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/users/tambah', $data);
        $this->load->view('template/footer');
    }

    public function tambah_data_user()
    {

        $this->load->model('users_model');

        $passwordHash = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

        $foto     = $_FILES['image']['name'];
        $file     = $_FILES['image']['tmp_name'];
        $size     = $_FILES['image']['size'];
        $folder   = "assets/img/profile/";
        $saring   = array('gif', 'png', 'jpg');
        $ext      = pathinfo($foto, PATHINFO_EXTENSION);

        if (strlen($foto)) {
            // Cek format foto.
            $ext = pathinfo($foto, PATHINFO_EXTENSION);
            if (in_array($ext, $saring)) {
                // Cek ukurannya.
                // 5242880 = 5MB.
                if ($size < 5242880) {
                    $img     = sha1($foto);
                    if (move_uploaded_file($file, $folder . $img)) {
                        $data = [
                            'email_admin' => $this->input->post('email'),
                            'name_admin' => $this->input->post('name'),
                            'password_admin' => $passwordHash,
                            'is_active' => $this->input->post('is_active'),
                            'image_admin' => $img,
                            'date_created_admin' => time()
                        ];
                        $proses = $this->users_model->tambah_data_admin($data);

                        if ($proses) {
                            $this->session->set_flashdata('sukses', 'Berhasil tambahin user .');
                            redirect('/admin/users');
                        } else {
                            $this->session->set_flashdata('eror', 'Gagal ');
                            redirect('/admin/users');
                        }
                    } else {
                        $this->session->set_flashdata('eror', 'tidak bisa di upload');
                        redirect('/admin/tambah_user');
                    }
                } else {
                    $this->session->set_flashdata('eror', 'Fotonya terlalu besar');
                    redirect('/admin/tambah_user');
                }
            } else {
                $this->session->set_flashdata('eror', 'Ekstensinya bukan foto ');
                redirect('/admin/tambah_user');
            }
        } else {
            $data = [
                'email_admin' => $this->input->post('email'),
                'name_admin' => $this->input->post('name'),
                'password_admin' => $passwordHash,
                'is_active' => $this->input->post('is_active'),
                'image_admin' => 'default.jpg',
                'date_created_admin' => time()
            ];
            $proses = $this->users_model->tambah_data_user($data);

            if ($proses) {
                $this->session->set_flashdata('sukses', 'Berhasil user su.');
                redirect('/admin/users');
            } else {
                $this->session->set_flashdata('eror', 'Gagal ');
                redirect('/admin/users');
            }
        }
    }

    public function update_user($id_user)
    {
        $this->load->model('users_model');

        $user = $this->db->get_where('admin', ['email_admin' => $this->session->userdata('email')])->row_array();
        $dataUser = $this->users_model->ambil_satu_user($id_user);
        $data = [
            'title' => 'Update User',
            'user' => $user,
            'data' => $dataUser[0]
        ];

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/users/update', $data);
        $this->load->view('template/footer');
    }

    public function update_data_user()
    {
        $this->load->model('users_model');

        if ($this->input->post('password')) {
            $passwordHash = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        }

        $id = $this->input->post('id');

        $foto     = $_FILES['image']['name'];
        $file     = $_FILES['image']['tmp_name'];
        $size     = $_FILES['image']['size'];
        $folder   = "assets/img/profile/";
        $saring   = array('gif', 'png', 'jpg');
        $ext      = pathinfo($foto, PATHINFO_EXTENSION);

        if (strlen($foto)) {
            // Cek format foto.
            $ext = pathinfo($foto, PATHINFO_EXTENSION);
            if (in_array($ext, $saring)) {
                // Cek ukurannya.
                // 5242880 = 5MB.
                if ($size < 5242880) {
                    $img     = sha1($foto);
                    if (move_uploaded_file($file, $folder . $img)) {
                        // Ubah yg $data2 ini lho
                        // yang dikirim ke mode
                        $data = [
                            'email_admin' => $this->input->post('email'),
                            'name_admin' => $this->input->post('name'),
                            'is_active' => $this->input->post('is_active'),
                            'image_admin' => $img,
                            'date_created_admin' => time()
                        ];
                        if ($this->input->post('password')) {
                            $data['password'] = $passwordHash;
                        }
                        $proses = $this->users_model->update_data_user($data, $id);

                        if ($proses) {
                            $this->session->set_flashdata('sukses', 'Berhasil Update.');
                            redirect('/admin/users');
                        } else {
                            $this->session->set_flashdata('eror', 'Gagal ');
                            redirect('/admin/users');
                        }
                    } else {
                        $this->session->set_flashdata('eror', 'tidak bisa di upload');
                        redirect('/admin/update_user');
                    }
                } else {
                    $this->session->set_flashdata('eror', 'fotonya telalu besar');
                    redirect('/admin/update_user');
                }
            } else {
                $this->session->set_flashdata('eror', 'Ekstensinya bukan foto ');
                redirect('/admin/update_user');
            }
        } else {
            $data = [
                'email_admin' => $this->input->post('email'),
                'name_admin' => $this->input->post('name'),
                'is_active' => $this->input->post('is_active'),
                'date_created_admin' => time()
            ];
            if ($this->input->post('password')) {
                $data['password'] = $passwordHash;
            }
            $proses = $this->users_model->update_data_user($data, $id);

            if ($proses) {
                $this->session->set_flashdata('sukses', 'Berhasil user su.');
                redirect('/admin/users');
            } else {
                $this->session->set_flashdata('eror', 'Gagal ');
                redirect('/admin/users');
            }
        }
    }


    public function stok_barang()
    {
        $this->load->model('stok_model');
        $data['title'] = 'Stok Barang ';
        $data['user'] = $this->db->get_where('admin', ['email_admin' => $this->session->userdata('email')])->row_array();
        $data['Stok_barang'] = $this->stok_model->ambil_semua_barang_masuk();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('barang/stokbarang');
        $this->load->view('template/footer');
    }

    public function tambah_stok_barang()
    {
        $this->load->model('stok_model');
        $data = [
            'nama_barang_stok' => $this->input->post('nama_barang'),
            'kategori_stok' => $this->input->post('kategori'),
            'stok' => abs($this->input->post('stok')),
            'harga_stok' => abs($this->input->post('harga')),
        ];

        $proses = $this->stok_model->tambah_barang($data);

        if ($proses) {
            $this->session->set_flashdata('sukses', 'Berhasil tambahin stok barang su.');
            redirect('/admin/stok_barang');
        } else {
            $this->session->set_flashdata('eror', 'Gagal ');
            redirect('/admin/stok_barang');
        }
    }

    public function update_stok_barang()
    {
        $this->load->model('stok_model');
        $data = [
            'nama_barang_stok' => $this->input->post('nama_barang'),
            'kategori_stok' => $this->input->post('kategori'),
            'stok' => abs($this->input->post('stok')),
            'harga_stok' => abs($this->input->post('harga')),
        ];

        $id = $this->input->post('id');

        $proses = $this->stok_model->update_barang($data, $id);

        if ($proses) {
            $this->session->set_flashdata('sukses', 'Berhasil update stok barang ');
            redirect('/admin/stok_barang');
        } else {
            $this->session->set_flashdata('eror', 'Gagal ');
            redirect('/admin/stok_barang');
        }
    }

    public function hapus_stok_barang($id)
    {
        $this->load->model('stok_model');
        $proses = $this->stok_model->hapus_barang($id);

        if ($proses) {
            $this->session->set_flashdata('sukses', 'Berhasil hapus stok barang ');
            redirect('/admin/stok_barang');
        } else {
            $this->session->set_flashdata('eror', 'Gagal ');
            redirect('/admin/stok_barang');
        }
    }
}
