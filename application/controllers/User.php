<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    private $loggedUser;

    public function __construct()
    {
        parent::__construct();
        $this->loggedUser = $this->db->get_where('admin', ['email_admin' => $this->session->userdata('email')])->row_array();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Halaman Utama';
        $data['user'] = $this->loggedUser;
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('template/footer');
    }

    public function stok_barang()
    {
        $this->load->model('stok_model');
        $data['title'] = 'Stok Barang ';
        $data['user'] = $this->loggedUser;
        $data['Stok_barang'] = $this->stok_model->ambil_semua_barang_masuk();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('barang/stokbarang2');
        $this->load->view('template/footer');
    }



    public function barang_masuk()
    {
        $this->load->model('transaksi_model');
        $this->load->model('stok_model');
        $data['title'] = 'Barang masuk ';
        $data['user'] = $this->loggedUser;
        // MISALNYA lu masu ngambil db barang masuk di model tadi
        $data['Barang_masuk'] = $this->transaksi_model->barang_masuk(); // kok eror asu mana gw tau asw 
        $data['barang'] = $this->stok_model->ambil_semua_barang_masuk();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('barang/barang_masuk');
        $this->load->view('template/footer');
    }

    public function tambah_barang_masuk()
    {
        // Form Validation
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim|min_length[1]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('eror', validation_errors());
            redirect('/user/barang_masuk');
        } else {

            $this->load->model('transaksi_model');
            $this->load->model('stok_model');

            $id_barang = $this->input->post('id_barang');
            $barang = $this->stok_model->satu_barang($id_barang);
            $data = [
                'tanggal_masuk' => date('Y-m-d'),
                'jumlah_masuk' => abs($this->input->post('jumlah')),
                'keterangan_masuk' => $this->input->post('keterangan'),
                'id_barang_masuk' => $id_barang,
            ];

            // kasih kondisi brego
            $hitungStok = $barang[0]['stok'] + abs($this->input->post('jumlah'));

            if ($hitungStok < 0) {
                $this->session->set_flashdata('eror', 'Stoknya kurang cok.');
                redirect('/user/barang_masuk');
            }

            $update = [
                'stok' => $hitungStok
            ];

            $updateStokBarang = $this->stok_model->update_barang($update, $id_barang);

            if ($updateStokBarang) {
                $proses = $this->transaksi_model->tambah_barang_masuk($data);

                if ($proses) {
                    $this->session->set_flashdata('sukses', 'Berhasil tambah barang masuk.');
                    redirect('/user/barang_masuk');
                } else {
                    $this->session->set_flashdata('eror', 'Gagal ');
                    redirect('/user/barang_masuk');
                }
            } else {
                $this->session->set_flashdata('eror', 'Gagal update stok barang.');
                redirect('/user/barang_masuk');
            }
        }
    }

    public function update_barang_masuk()
    {
        // Form Validation
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim|min_length[1]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('eror', validation_errors());
            redirect('/user/barang_masuk');
        } else {
            $this->load->model('transaksi_model');
            $this->load->model('stok_model');

            $id_barang = $this->input->post('id_barang');
            $id = $this->input->post('id');

            $barang = $this->stok_model->satu_barang($id_barang);
            $barangMasuk = $this->transaksi_model->satu_barang_masuk($id);

            $data = [
                'tanggal_masuk' => date('Y-m-d'),
                'jumlah_masuk' => abs($this->input->post('jumlah')),
                'keterangan_masuk' => $this->input->post('keterangan'),
                'id_barang_masuk' => $id_barang,
            ];

            $stokSaatIni = $barang[0]['stok'];
            $normalisasiStok = $stokSaatIni - $barangMasuk[0]['jumlah'];

            $hitungStok = $normalisasiStok + $this->input->post('jumlah');
            $update = [
                'stok' => $hitungStok
            ];

            $updateStokBarang = $this->stok_model->update_barang($update, $id_barang);

            if ($updateStokBarang) {
                $proses = $this->transaksi_model->update_barang_masuk($data, $id);

                if ($proses) {
                    $this->session->set_flashdata('sukses', 'Berhasil update barang masuk.');
                    redirect('/user/barang_masuk');
                } else {
                    $this->session->set_flashdata('eror', 'Gagal ');
                    redirect('/user/barang_masuk');
                }
            } else {
                $this->session->set_flashdata('eror', 'Gagal update stok barang.');
                redirect('/user/barang_masuk');
            }
        }
    }

    public function hapus_Barang_masuk($id)
    {
        $this->load->model('transaksi_model');
        $proses = $this->transaksi_model->hapus_barang_masuk($id);

        if ($proses) {
            $this->session->set_flashdata('sukses', 'Berhasil hapus barang masuk.');
            redirect('/user/barang_masuk');
        } else {
            $this->session->set_flashdata('eror', 'Gagal bjir');
            redirect('/user/barang_masuk');
        }
    }

    public function barang_keluar()
    {
        $this->load->model('transaksi_model');
        $this->load->model('stok_model');
        $data['title'] = 'barang keluar ';
        $data['user'] = $this->loggedUser;
        // MISALNYA lu masu ngambil db barang masuk di model tadi
        $data['Barang_keluar'] = $this->transaksi_model->barang_keluar();
        $data['barang'] = $this->stok_model->ambil_semua_barang_masuk();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('barang/barang_keluar');
        $this->load->view('template/footer');
    }

    public function tambah_barang_keluar()
    {
        // Form Validation
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim|min_length[1]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('eror', validation_errors());
            redirect('/user/barang_keluar');
        } else {
            $this->load->model('transaksi_model');
            $this->load->model('stok_model');

            $id_barang = $this->input->post('id_barang');

            $barang = $this->stok_model->satu_barang($id_barang);

            $data = [
                'tanggal_keluar' => date('Y-m-d'),
                'jumlah_keluar' => $this->input->post('jumlah'),
                'keterangan_keluar' => $this->input->post('keterangan'),
                'id_barang_keluar' => $id_barang,
            ];

            $hitungStok = $barang[0]['stok'] - $this->input->post('jumlah');
            $update = [
                'stok' => $hitungStok
            ];

            if ($hitungStok < 0) {
                $this->session->set_flashdata('eror', "Stoknya kurang bejir.");
                redirect('/user/barang_keluar');
            } else {
                $updateStokBarang = $this->stok_model->update_barang($update, $id_barang);

                if ($updateStokBarang) {
                    $proses = $this->transaksi_model->tambah_barang_keluar($data);

                    if ($proses) {
                        $this->session->set_flashdata('sukses', 'Berhasil tambah barang keluar.');
                        redirect('/user/barang_keluar');
                    } else {
                        $this->session->set_flashdata('eror', 'Gagal');
                        redirect('/user/barang_keluar');
                    }
                } else {
                    $this->session->set_flashdata('eror', 'Gagal update barang keluar.');
                    redirect('/user/barang_keluar');
                }
            }
        }
    }

    public function update_barang_keluar()
    {
        // Form Validation
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim|min_length[1]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('eror', validation_errors());
            redirect('/user/barang_keluar');
        } else {

            $this->load->model('transaksi_model');
            $this->load->model('stok_model');

            $id_barang = $this->input->post('id_barang');
            $id = $this->input->post('id');

            $barang = $this->stok_model->satu_barang($id_barang);
            $barangMasuk = $this->transaksi_model->satu_barang_keluar($id);

            $data = [
                'tanggal_keluar' => date('Y-m-d'),
                'jumlah_keluar' => abs($this->input->post('jumlah')),
                'keterangan_keluar' => $this->input->post('keterangan'),
                'id_barang_keluar' => $id_barang,
            ];

            $stokSaatIni = $barang[0]['stok'];
            $normalisasiStok = $stokSaatIni - $barangMasuk[0]['jumlah_keluar'];

            $hitungStok = $normalisasiStok - $this->input->post('jumlah');
            $update = [
                'stok' => $hitungStok
            ];

            if ($hitungStok < 0) {
                $this->session->set_flashdata('eror', "Stoknya kurang bejir.");
                redirect('/user/barang_keluar');
            } else {

                $updateStokBarang = $this->stok_model->update_barang($update, $id_barang);

                if ($updateStokBarang) {
                    $proses = $this->transaksi_model->update_barang_keluar($data, $id);

                    if ($proses) {
                        $this->session->set_flashdata('sukses', 'Berhasil update barang keluar.');
                        redirect('/user/barang_keluar');
                    } else {
                        $this->session->set_flashdata('eror', 'Gagal ');
                        redirect('/user/barang_keluar');
                    }
                } else {
                    $this->session->set_flashdata('eror', 'Gagal update stok barang.');
                    redirect('/user/barang_keluar');
                }
            }
        }
    }



    public function hapus_Barang_keluar($id)
    {
        $this->load->model('transaksi_model');
        $proses = $this->transaksi_model->hapus_barang_keluar($id);

        if ($proses) {
            $this->session->set_flashdata('sukses', 'Berhasil hapus barang Keluar .');
            redirect('/user/barang_keluar');
        } else {
            $this->session->set_flashdata('eror', 'Gagal bjir');
            redirect('/user/barang_keluar');
        }
    }

    public function catatan()
    {
        $this->load->model('catatan_model');
        $data['title'] = 'catatan';
        $data['user'] = $this->loggedUser;
        // MISALNYA lu masu ngambil db barang masuk di model tadi
        $data['ambil_catatan'] = $this->catatan_model->ambil_semua_catatan(); // kok eror asu mana gw tau asw 

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('barang/catatan', $data);
        $this->load->view('template/footer');
    }

    public function hapus_catatan()
    {
        $this->load->model('catatan_model');
        $id = $this->input->post('id');

        $proses = $this->catatan_model->hapus_Catatan($id);

        if ($proses) {
            $this->session->set_flashdata('sukses', 'Berhasil hapus catatan.');
            redirect('/user/catatan');
        } else {
            $this->session->set_flashdata('eror', 'Gagal');
            redirect('/user/catatan');
        }
    }
    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->loggedUser;

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('template/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image_admin', $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Bukan gambar asw</div>');
                    redirect('user/edit');
                }
            }

            $this->db->set('name_admin', $name);
            $this->db->where('email_admin', $email);
            $this->db->update('admin');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
            redirect('user/edit');
        }
    }
    public function tambah_catatan()
    {
        $this->load->model('catatan_model');
        $data = [
            'nama_catatan' => $this->input->post('nama'),
            'kategori_catatan' => $this->input->post('kategori'),
            'keterangan_catatan' => $this->input->post('keterangan'),
        ];

        $proses = $this->catatan_model->tambah_catatan($data);

        if ($proses) {
            $this->session->set_flashdata('sukses', 'Berhasil tambahin catatan.');
            redirect('/user/catatan');
        } else {
            $this->session->set_flashdata('eror', 'Gagal');
            redirect('/user/catatan');
        }
    }
    public function update_catatan()
    {
        $this->load->model('catatan_model');
        $data = [
            'nama_catatan' => $this->input->post('nama'),
            'kategori_catatan' => $this->input->post('kategori'),
            'keterangan_catatan' => $this->input->post('keterangan'),

        ];

        $id = $this->input->post('id');

        $proses = $this->catatan_model->update_catatan($data, $id);

        if ($proses) {
            $this->session->set_flashdata('sukses', 'Berhasil update catatan.');
            redirect('/user/catatan');
        } else {
            $this->session->set_flashdata('eror', 'Gagal ');
            redirect('/user/catatan');
        }
    }
}
