<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa_model extends CI_Model
{
  public function getHistoryPembayaran()
  {
    $nisn = $this->session->userdata('nisn');

    $sql = "SELECT `pembayaran`.*, `petugas`.`nama_petugas`
            FROM `pembayaran`
            JOIN `petugas` ON `pembayaran`.`id_petugas` = `petugas`.`id_petugas`
            WHERE `pembayaran`.`nisn` = '$nisn'
            ORDER BY `pembayaran`.`tahun_dibayar` DESC
            ";

    return $this->db->query($sql)->result_array();
  }
}
