<?php  
defined ('BASEPATH') or exit ('No direct script access allowed');

class admin_model extends CI_Model{
  public function addPetugas()
  {
    $data = [
      'email' => htmlspecialchars($this->input->post('email')),
      'password'  => htmlspecialchars(password_hash($this->input->post('password1'), PASSWORD_DEFAULT)),
      'nama_petugas'  => htmlspecialchars($this->input->post('nama_petugas')),
      'gambar' => 'default.png',
      'no_telp' => htmlspecialchars($this->input->post('no_telp')),
      'alamat'  => htmlspecialchars($this->input->post('alamat')),
      'level' => htmlspecialchars($this->input->post('level'))
    ];

    return $this->db->insert('petugas', $data);
  }

  public function getPetugas($limit, $start, $keyword = null){
    if($keyword != null){
      $sql = "SELECT * FROM `petugas`
              WHERE `nama_petugas` LIKE '%$keyword%'
              LIMIT $start, $limit
            ";
    } else {
      $sql = "SELECT * FROM `petugas`
              LIMIT $start, $limit
              ";
    }

    return $this->db->query($sql)->result_array();
  }

  public function deletePetugas($id)
  {
    $this->db->delete('petugas', ['id_petugas' => $id]);
  }

  public function editPetugas()
  {
    $data = [
      'email' => htmlspecialchars($this->input->post('email')),
      'nama_petugas'  => htmlspecialchars($this->input->post('nama_petugas')),
      'no_telp' => htmlspecialchars($this->input->post('no_telp')),
      'alamat'  => htmlspecialchars($this->input->post('alamat')),
      'level' => htmlspecialchars($this->input->post('level'))
    ];

    $this->db->where('id_petugas', $this->input->post('id_petugas'));
    $this->db->update('petugas', $data);
  }
}