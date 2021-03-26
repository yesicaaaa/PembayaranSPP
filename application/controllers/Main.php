<?php 
defined ('BASEPATH') or exit ('No direct script access allowed');

class Main extends CI_Controller{
  public function index()
  {
    $data = [
      'title' => 'Pembayaran SPP | SMK BPI',
      'css'   => 'assets/css/landingpage.css',
      'js'    => ''
    ];

    $this->load->view('landingpage.php', $data);
  }
}