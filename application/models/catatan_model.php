<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Catatan_Model extends CI_Model
{
    public function ambil_semua_catatan()
    {
        return $this->db->get('catatan')->result_array();
    }
    public function hapus_catatan($id)
    {
        return $this->db->delete('catatan', ['id_catatan' => $id]);
    }
    public function tambah_catatan($data)
    {
        return $this->db->insert('catatan', $data);
    }
    public function update_catatan($data, $id)
    {
        $this->db->set($data);
        $this->db->where('id_catatan', $id);
        return $this->db->update('catatan');
    }
}
