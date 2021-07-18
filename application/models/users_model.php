<?php

class Users_model extends CI_Model
{
    public function ambil_semua_data_user()
    {
        $this->db->from('admin');
        return $this->db->get()->result_array();
    }

    public function tambah_data_admin($data)
    {
        return $this->db->insert('admin', $data);
    }

    public function update_data_admin($data, $id)
    {
        $this->db->where('id_admin', $id);
        return $this->db->update('admin', $data);
    }

    public function ganti_role($data, $id)
    {
        $this->db->where('id_admin', $id);
        return $this->db->update('admin', $data);
    }
    public function hapus_data_admin($id)
    {
        return $this->db->delete('admin', ['id_admin' => $id]);
    }

    public function ambil_satu_user($id_user)
    {
        return $this->db->get_where('admin', ['id_admin' => $id_user])->result_array();
    }
}
