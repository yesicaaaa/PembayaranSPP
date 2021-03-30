<?php
defined('BASEPATH') or exit('No direct script access allowed');

class admin_model extends CI_Model
{
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

  public function getPetugas($limit, $start, $keyword = null)
  {
    if ($keyword != null) {
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

  //MANAGEMENT DATA SISWA

  public function getDataSiswa($limit, $start, $keyword = null)
  {
    $sql = "SELECT `siswa`.*, `kelas`.*, `spp`.*
            FROM `siswa` 
            JOIN `kelas` ON `siswa`.`id_kelas` = `kelas`.`id_kelas`
            JOIN `spp` ON `siswa`.`id_spp` = `spp`.`id_spp`
            WHERE `siswa`.`nama` LIKE '%$keyword%'
            LIMIT $start, $limit
          ";

    return $this->db->query($sql)->result_array();
  }

  public function addDataSiswa()
  {
    $data = [
      'nisn'  => htmlspecialchars($this->input->post('nisn')),
      'nis'   => htmlspecialchars($this->input->post('nis')),
      'nama'  => htmlspecialchars($this->input->post('nama')),
      'email' => htmlspecialchars($this->input->post('email')),
      'gambar'  => 'default.png',
      'id_kelas'  => htmlspecialchars($this->input->post('id_kelas')),
      'alamat'  => htmlspecialchars($this->input->post('alamat')),
      'no_telp' => htmlspecialchars($this->input->post('no_telp')),
      'id_spp'  => htmlspecialchars($this->input->post('id_spp')),
      'password'  => htmlspecialchars(password_hash($this->input->post('password1'), PASSWORD_DEFAULT))
    ];

    return $this->db->insert('siswa', $data);
  }

  public function deleteSiswa($nisn)
  {
    return $this->db->delete('siswa', ['nisn' => $nisn]);
  }

  public function editDataSiswa()
  {
    $data = [
      'nisn'  => htmlspecialchars($this->input->post('nisn')),
      'nis'   => htmlspecialchars($this->input->post('nis')),
      'nama'  => htmlspecialchars($this->input->post('nama')),
      'email' => htmlspecialchars($this->input->post('email')),
      'id_kelas'  => htmlspecialchars($this->input->post('id_kelas')),
      'alamat'  => htmlspecialchars($this->input->post('alamat')),
      'no_telp' => htmlspecialchars($this->input->post('no_telp')),
      'id_spp'  => htmlspecialchars($this->input->post('id_spp'))
    ];

    $this->db->where('nisn', $this->input->post('nisn'));
    $this->db->update('siswa', $data);
  }


  //MANAGEMENT DATA KELAS
  public function getDataKelas($limit, $start, $keyword = null)
  {
    if ($keyword != null) {
      $sql = "SELECT * FROM `kelas`
              WHERE `kompetensi_keahlian` LIKE '%$keyword%'
              LIMIT $start, $limit
            ";
    } else {
      $sql = "SELECT * FROM `kelas`
              LIMIT $start, $limit
            ";
    }

    return $this->db->query($sql)->result_array();
  }

  public function addDataKelas()
  {
    $data = [
      'nama_kelas'  => htmlspecialchars($this->input->post('nama_kelas')),
      'kompetensi_keahlian'   => htmlspecialchars($this->input->post('kompetensi_keahlian'))
    ];

    return $this->db->insert('kelas', $data);
  }

  public function deleteDataKelas($id_kelas)
  {
    return $this->db->delete('kelas', ['id_kelas' => $id_kelas]);
  }

  public function editDataKelas()
  {
    $data = [
      'nama_kelas'  => htmlspecialchars($this->input->post('nama_kelas')),
      'kompetensi_keahlian'   => htmlspecialchars($this->input->post('kompetensi_keahlian'))
    ];

    $this->db->where('id_kelas', $this->input->post('id_kelas'));
    $this->db->update('kelas', $data);
  }


  //MANAGEMENT DATA SPP
  public function getDataSpp($limit, $start, $keyword = null)
  {
    if ($keyword != null) {
      $sql = "SELECT * FROM `spp`
              WHERE `nominal` LIKE '%$keyword%'
              LIMIT $start, $limit
              ";
    } else {
      $sql = "SELECT * FROM `spp`
              LIMIT $start, $limit
              ";
    }

    return $this->db->query($sql)->result_array();
  }

  public function addDataSpp()
  {
    $data = [
      'tahun' => htmlspecialchars($this->input->post('tahun')),
      'nominal' => htmlspecialchars($this->input->post('nominal'))
    ];

    return $this->db->insert('spp', $data);
  }

  public function deleteDataSpp($id_spp)
  {
    $this->db->delete('spp', ['id_spp' => $id_spp]);
  }

  public function editDataSpp()
  {
    $data = [
      'tahun' => htmlspecialchars($this->input->post('tahun')),
      'nominal' => htmlspecialchars($this->input->post('nominal'))
    ];

    $this->db->where('id_spp', $this->input->post('id_spp'));
    $this->db->update('spp', $data);
  }

  public function getSppSiswa()
  {
    $sql = "SELECT `id_spp` FROM `siswa` 
            UNION 
            SELECT `id_spp` FROM `spp`
            ";

    return $this->db->query($sql)->result_array();
  }

  //MANAGEMENY TRANSAKSI PEMBAYARAN
  public function getDataSiswaSpp($limit, $start, $keyword = null)
  {
    if ($keyword != null) {
      $sql = "SELECT `siswa`.*, `kelas`.* 
              FROM `siswa`
              JOIN `kelas` ON `siswa`.`id_kelas` = `kelas`.`id_kelas`
              WHERE `siswa`.`nama` LIKE '%$keyword%'
              LIMIT $start, $limit
              ";
    } else {
      $sql = "SELECT `siswa`.*, `kelas`.* 
              FROM `siswa`
              JOIN `kelas` ON `siswa`.`id_kelas` = `kelas`.`id_kelas`
              LIMIT $start, $limit
              ";
    }

    return $this->db->query($sql)->result_array();
  }

  public function getSiswaSppRow($nisn)
  {
    $sql = "SELECT `siswa`.*, `kelas`.*, `spp`.`nominal`
            FROM `siswa`
            JOIN `kelas` ON `siswa`.`id_kelas` = `kelas`.`id_kelas`
            JOIN `spp` ON `siswa`.`id_spp` = `spp`.`id_spp`
            WHERE `siswa`.`nisn` = $nisn
            ";

    return $this->db->query($sql)->row_array();
  }

  public function transaksiPembayaran()
  {
    $data = [
      'id_petugas'  => htmlspecialchars($this->input->post('id_petugas')),
      'nisn'        => htmlspecialchars($this->input->post('nisn')),
      'tgl_bayar'   => htmlspecialchars($this->input->post('tgl_bayar')),
      'bulan_dibayar' => htmlspecialchars($this->input->post('bulan_dibayar')),
      'tahun_dibayar' => htmlspecialchars($this->input->post('tahun_dibayar')),
      'id_spp'  => htmlspecialchars($this->input->post('id_spp')),
      'jumlah_bayar'  => htmlspecialchars($this->input->post('jumlah_bayar'))
    ];

    return $this->db->insert('pembayaran', $data);
  }

  public function getHistoryPembayaran($limit, $start, $keyword = null)
  {
    if ($keyword != null) {
      $sql = "SELECT `pembayaran`.*, `log_pembayaran`, `
              ";
    }
  }
}
