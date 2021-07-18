<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_Model extends CI_Model
{
    public function barang_masuk()
    {
        $this->db->select(['barang_masuk.tanggal_masuk', 'barang_masuk.jumlah_masuk', 'barang_masuk.keterangan_masuk', 'barang_masuk.id_barang_masuk', 'barang_masuk.id_masuk', 'stok_barang.nama_barang_stok', 'stok_barang.kategori_stok', 'stok_barang.harga_stok']);
        $this->db->join('stok_barang', 'stok_barang.id_stok = barang_masuk.id_barang_masuk');
        return $this->db->get('barang_masuk')->result_array();
    }

    public function satu_barang_masuk($id)
    {
        return $this->db->get_where('barang_masuk', ['id_masuk' => $id])->result_array();
    }

    public function update_barang_masuk($data, $id)
    {
        $this->db->set($data);
        $this->db->where('id_masuk', $id);
        return $this->db->update('barang_masuk');
    }

    public function tambah_barang_masuk($data)
    {
        return $this->db->insert('barang_masuk', $data);
    }

    public function hapus_barang_masuk($id)
    {
        return $this->db->delete('barang_masuk', ['id_masuk' => $id]);
    }

    // Barang keluar
    public function barang_keluar()
    {
        $this->db->select(
            [
                'barang_keluar.tanggal_keluar',
                'barang_keluar.jumlah_keluar',
                'barang_keluar.keterangan_keluar',
                'barang_keluar.id_barang_keluar',
                'barang_keluar.id_keluar',
                'stok_barang.nama_barang_stok',
                'stok_barang.kategori_stok',
                'stok_barang.harga_stok'
            ]
        );
        $this->db->join('stok_barang', 'stok_barang.id_stok = barang_keluar.id_barang_keluar');
        return $this->db->get('barang_keluar')->result_array();
    }
    public function satu_barang_keluar($id)
    {
        return $this->db->get_where('barang_keluar', ['id_keluar' => $id])->result_array();
    }

    public function tambah_barang_keluar($data)
    {
        return $this->db->insert('barang_keluar', $data);
    }

    public function update_barang_keluar($data, $id)
    {
        $this->db->set($data);
        $this->db->where('id_keluar', $id);
        return $this->db->update('barang_keluar');
    }


    public function hapus_barang_keluar($id)
    {
        return $this->db->delete('barang_keluar', ['id_keluar' => $id]);
    }
}
