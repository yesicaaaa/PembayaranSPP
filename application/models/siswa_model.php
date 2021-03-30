<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa_model extends CI_Model
{
  public function getHistoryPembayaran($limit, $start, $keyword = null)
  {
    $nisn = $this->session->userdata('nisn');
    if ($keyword != null) {
      $sql = "SELECT `pembayaran`.*, `petugas`.`nama_petugas`
            FROM `pembayaran`
            JOIN `petugas` ON `pembayaran`.`id_petugas` = `petugas`.`id_petugas`
            WHERE `pembayaran`.`bulan_dibayar` LIKE '%$keyword%'
            WHERE `pembayaran`.`nisn` = '$nisn'
            LIMIT $start, $limit
            ";
    } else {
      $sql = "SELECT `pembayaran`.*, `petugas`.`nama_petugas`
              FROM `pembayaran`
              JOIN `petugas` ON `pembayaran`.`id_petugas` = `petugas`.`id_petugas`
              WHERE `pembayaran`.`nisn` = '$nisn'
              LIMIT $start, $limit
              ";
    }

    return $this->db->query($sql)->result_array();
  }
}
