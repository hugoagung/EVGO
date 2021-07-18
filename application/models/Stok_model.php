<?php
defined('BASEPATH') or exit('No direct script access allowed');

class stok_model extends CI_Model
{
    // Model ini FUNGSINYA buat segala aktivitas yang BERHUBUNGAN sama DATABASE
    // misalnya lau mau select * barang masuk

    public function ambil_semua_barang_masuk()
    {
        return $this->db->get('stok_barang')->result_array();
    }

    public function satu_barang($id)
    {
        return $this->db->get_where('stok_barang', ['id_stok' => $id])->result_array();
    }

    public function tambah_barang($data)
    {
        return $this->db->insert('stok_barang', $data);
    }

    public function update_barang($data, $id)
    {
        $this->db->set($data);
        $this->db->where('id_stok', $id);
        return $this->db->update('stok_barang');
    }

    public function hapus_barang($id)
    {
        return $this->db->delete('stok_barang', ['id_stok' => $id]);
    }
}
