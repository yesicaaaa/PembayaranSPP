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

  public function signout_petugas()
  {
    // $this->session->sess_destroy();
    $this->session->unset_userdata('email');
    $this->session->unset_userdata('level');
    $this->session->unset_userdata('nama');
    $this->session->unset_userdata('gambar');
    $this->session->set_flashdata('message', '<div class="alert alert-success" 
    role="alert">Kamu berhasil signout!</div>');
    redirect('signin/signin_petugas');
  }
}