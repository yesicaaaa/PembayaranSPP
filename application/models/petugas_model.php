<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Petugas_model extends CI_Model
{
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

  public function getDataHistory($limit, $start, $keyword = null)
  {
    $sql = "SELECT `pembayaran`.*, `siswa`.*, `petugas`.*
            FROM `pembayaran` 
            JOIN `siswa` ON `pembayaran`.`nisn` = `siswa`.`nisn`
            JOIN `petugas` ON `pembayaran`.`id_petugas` = `petugas`.`id_petugas`
            WHERE `pembayaran`.`nisn` LIKE '%$keyword%'
            LIMIT $start, $limit
            ";

    return $this->db->query($sql)->result_array();
  }
}
