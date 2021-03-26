<?php  
defined ('BASEPATH') or exit ('No direct script access allowed');

class signin_model extends CI_Model {
  // public function getUserRow($email)
  // {
  //   $sql = "SELECT `petugas`.*, `siswa`.*
  //           FROM `user` 
  //           JOIN `siswa` ON `user`.`nisn_siswa`  = `siswa`.`nisn`
  //           JOIN `petugas` ON `user`.`id_petugas` = `petugas`.`id_petugas`
  //           WHERE `email` = $email
  //         ";
    
  //   return $this->db->query($sql)->row_array();
  // }
}