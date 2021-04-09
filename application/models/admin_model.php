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
      'gambar' => $this->_uploadImagePetugas(),
      'no_telp' => htmlspecialchars($this->input->post('no_telp')),
      'alamat'  => htmlspecialchars($this->input->post('alamat')),
      'level' => htmlspecialchars($this->input->post('level'))
    ];

    return $this->db->insert('petugas', $data);
  }

  public function getPetugas($keyword = null)
  {
    $sql = "SELECT * FROM `petugas`
            WHERE `nama_petugas` LIKE '%$keyword%'
            OR `no_telp` LIKE '%$keyword%'
            OR `email` LIKE '%$keyword%'
            OR `level` LIKE '%$keyword%'
            OR `alamat` LIKE '%$keyword%'
            ORDER BY `nama_petugas` ASC
            ";

    return $this->db->query($sql)->result_array();
  }

  public function deletePetugas($id_petugas)
  {
    $this->_deleteImagePetugas($id_petugas);
    return $this->db->delete('petugas', ['id_petugas' => $id_petugas]);
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

  private function _uploadImagePetugas()
  {
    $config = [
      'upload_path' => './assets/userImage/',
      'allowed_types' => 'jpg|png',
      'file_name' => $this->input->post('nama_petugas'),
      'overwrite' => true,
      'max_size'  => 1024
    ];

    $this->upload->initialize($config);

    if ($this->upload->do_upload('gambar')) {
      return $this->upload->data('file_name');
    } else {
      return 'default.png';
    }
  }

  private function _deleteImagePetugas($id_petugas)
  {
    $userImage = $this->db->get_where('petugas', ['id_petugas' => $id_petugas])->row_array();
    if ($userImage['gambar'] != 'default.png') {
      $filename = explode('.', $userImage['gambar'])[0];
      return array_map('unlink', glob(FCPATH . "assets/userImage/$filename.*"));
    }
  }

  //MANAGEMENT DATA SISWA

  public function getDataSiswa($keyword = null)
  {
    $sql = "SELECT `siswa`.*, `kelas`.*, `spp`.*
            FROM `siswa` 
            JOIN `kelas` ON `siswa`.`id_kelas` = `kelas`.`id_kelas`
            JOIN `spp` ON `siswa`.`id_spp` = `spp`.`id_spp`
            WHERE `siswa`.`nama` LIKE '%$keyword%'
            OR `siswa`.`nisn` LIKE '%$keyword%'
            OR `siswa`.`nis` LIKE '%$keyword%'
            OR `siswa`.`email` LIKE '%$keyword%'
            OR `siswa`.`no_telp` LIKE '%$keyword%'
            OR `siswa`.`alamat` LIKE '%$keyword%'
            OR `kelas`.`kompetensi_keahlian` LIKE '%$keyword%'
            OR `kelas`.`nama_kelas` LIKE '%$keyword%'
            ORDER BY `siswa`.`nama` ASC
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
      'gambar'  => $this->_uploadImageSiswa(),
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
    $this->_deleteImageSiswa($nisn);
    return $this->db->delete('siswa', ['nisn' => $nisn]);
  }

  public function editDataSiswa()
  {
    $data = [
      'nis'   => htmlspecialchars($this->input->post('nis')),
      'nama'  => htmlspecialchars($this->input->post('nama')),
      'id_kelas'  => htmlspecialchars($this->input->post('id_kelas')),
      'alamat'  => htmlspecialchars($this->input->post('alamat')),
      'no_telp' => htmlspecialchars($this->input->post('no_telp'))
    ];

    $this->db->where('nisn', $this->input->post('nisn'));
    $this->db->update('siswa', $data);
  }

  private function _uploadImageSiswa()
  {
    $config = [
      'upload_path' => './assets/userImage/',
      'allowed_types' => 'jpg|png',
      'file_name' => $this->input->post('nama'),
      'overwrite' => true,
      'max_size'  => 1024
    ];

    $this->upload->initialize($config);

    if ($this->upload->do_upload('gambar')) {
      return $this->upload->data('file_name');
    } else {
      return 'default.png';
    }
  }

  private function _deleteImageSiswa($nisn)
  {
    $userImage = $this->db->get_where('siswa', ['nisn' => $nisn])->row_array();
    if ($userImage['gambar'] != 'default.png') {
      $filename = explode('.', $userImage['gambar'])[0];
      return array_map('unlink', glob(FCPATH . "assets/userImage/$filename.*"));
    }
  }



  //MANAGEMENT DATA KELAS
  public function getDataKelas($keyword = null)
  {
    $sql = "SELECT * FROM `kelas`
            WHERE `kompetensi_keahlian` LIKE '%$keyword%'
            OR `nama_kelas` LIKE '%$keyword%'
            ORDER BY `nama_kelas` ASC
            ";

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
  public function getDataSpp($keyword = null)
  {
    $sql = "SELECT * FROM `spp`
            WHERE `nominal` LIKE '%$keyword%'
            OR `tahun` LIKE '%$keyword%'
            ORDER BY `tahun` DESC
            ";

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

  //MANAGEMENY TRANSAKSI PEMBAYARAN
  public function getDataSiswaSpp($keyword = null)
  {
    $sql = "SELECT `siswa`.*, `kelas`.* 
            FROM `siswa`
            JOIN `kelas` ON `siswa`.`id_kelas` = `kelas`.`id_kelas`
            WHERE `siswa`.`nama` LIKE '%$keyword%'
            OR `siswa`.`nisn` LIKE '%$keyword%'
            OR `kelas`.`nama_kelas` LIKE '%$keyword%'
            OR `kelas`.`kompetensi_keahlian` LIKE '%$keyword%'
            ORDER BY `siswa`.`nama` ASC
            ";

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
      'jumlah_bayar'  => htmlspecialchars($this->input->post('jumlah_bayar')),
      'status'  => 'Lunas'
    ];

    return $this->db->insert('pembayaran', $data);
  }




  //MANAGEMENT HISTORY PEMBAYARAN
  public function getHistoryPembayaran($keyword = null)
  {
    $sql = "SELECT `pembayaran`.*, `siswa`.*, `petugas`.*
            FROM `pembayaran`
            JOIN `siswa` ON `pembayaran`.`nisn` = `siswa`.`nisn`
            JOIN `petugas` ON `pembayaran`.`id_petugas` = `petugas`.`id_petugas`
            WHERE `pembayaran`.`nisn` LIKE '%$keyword%'
            OR `siswa`.`nama` LIKE '%$keyword%'
            OR `pembayaran`.`bulan_dibayar` LIKE '%$keyword%'
            OR `pembayaran`.`tahun_dibayar` LIKE '%$keyword%'
            OR `pembayaran`.`jumlah_bayar` LIKE '%$keyword%'
            OR `petugas`.`nama_petugas` LIKE '%$keyword%'
            OR `pembayaran`.`tgl_bayar` LIKE '%$keyword%'
            ORDER BY  `pembayaran`.`tgl_bayar` DESC
            ";

    return $this->db->query($sql)->result_array();
  }


  //MANAGEMENT LAPORAN
  public function checkPembayaran($nisn, $month, $year)
  {
    $sql = "SELECT `siswa`.`nisn`, `pembayaran`.`bulan_dibayar`, `pembayaran`.`tahun_dibayar`
            FROM `siswa`
            JOIN `pembayaran` ON `siswa`.`nisn` = `pembayaran`.`nisn`
            WHERE `siswa`.`nisn` = '$nisn'
            AND `pembayaran`.`bulan_dibayar` = '$month'
            AND `pembayaran`.`tahun_dibayar` = '$year'
            ";

    return $this->db->query($sql)->num_rows();
  }


  //MANAGEMENT LOG PETUGAS
  public function getLogPetugas($keyword = null)
  {
    $sql = "SELECT * FROM `log_petugas`
            WHERE `nama_petugas_lama` LIKE '%$keyword%'
            OR `email_baru` LIKE '%$keyword%'
            OR `email_lama` LIKE '%$keyword%'
            OR `no_telp_baru` LIKE '%$keyword%'
            OR `no_telp_lama` LIKE '%$keyword%'
            OR `posisi_baru` LIKE '%$keyword%'
            OR `posisi_lama` LIKE '%$keyword%'
            OR `tgl_diubah` LIKE '%$keyword%'
            ORDER BY `tgl_diubah` DESC
            ";

    return $this->db->query($sql)->result_array();
  }
}
