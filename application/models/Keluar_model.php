<?php
defined('BASEPATH') or exit('No direct script access allowed');

class keluar_Model extends CI_Model
{
    public function barang_keluar()
    {
        $this->db->select(['barang_keluar.tanggal_keluar', 'barang_keluar.jumlah_keluar', 'barang_keluar.keterangan_keluar', 'barang_keluar.id_barang_keluar', 'barang_keluar.id_keluar', 'stok_barang.nama_barang_stok', 'stok_barang.kategori_stok', 'stok_barang.harga_stok']);
        $this->db->join('stok_barang', 'stok_barang.id = barang_keluar.id_barang');
        return $this->db->get('barang_keluar')->result_array();
    }
    public function hapus_barang_keluar($id)
    {
        return $this->db->delete('barang_keluar', ['id_keluar' => $id]);
    }
}
