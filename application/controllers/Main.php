<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
  public function index()
  {
    $data = [
      'title' => 'Pembayaran SPP | SMK BPI',
      'css'   => 'assets/css/landingpage.css',
      'js'    => ''
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('landingpage.php');
    $this->load->view('templates/footer', $data);
  }

  public function signout_petugas()
  {
    $this->session->sess_destroy();
    redirect('signin/signin_petugas');
  }

  public function signout_siswa()
  {
    $this->session->sess_destroy();
    redirect('signin/signin_siswa');
  }
}
