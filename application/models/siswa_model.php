<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa_model extends CI_Model
{
  public function getHistoryPembayaran($limit, $start)
  {
    $nisn = $this->session->userdata('nisn');

    $sql = "SELECT `pembayaran`.*, `petugas`.`nama_petugas`
            FROM `pembayaran`
            JOIN `petugas` ON `pembayaran`.`id_petugas` = `petugas`.`id_petugas`
            WHERE `pembayaran`.`nisn` = '$nisn'
            ORDER BY `pembayaran`.`tahun_dibayar` DESC 
            LIMIT $start, $limit 
            ";

    return $this->db->query($sql)->result_array();
  }

  public function getHistoryRows()
  {
    $nisn = $this->session->userdata('nisn');

    $sql = "SELECT `pembayaran`.*, `petugas`.`nama_petugas`
            FROM `pembayaran`
            JOIN `petugas` ON `pembayaran`.`id_petugas` = `petugas`.`id_petugas`
            WHERE `pembayaran`.`nisn` = '$nisn'
            ORDER BY `pembayaran`.`tgl_bayar` DESC
            ";

    return $this->db->query($sql)->num_rows();
  }
}
