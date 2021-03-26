<?php 
defined ('BASEPATH') or exit ('No direct script access allowed');

class Petugas extends CI_Controller{
  public function index()
  {
    $this->load->view('petugas/transaksi-pembayaran');
  }
}