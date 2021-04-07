<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
  public function index()
  {
    $data = [
      'title' => 'Pembayaran SPP | SMK BPI',
      'css'   => 'assets/css/landingpage.css'
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('landingpage.php');
    $this->load->view('templates/footer');
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

  public function blocked_petugas()
  {
    $this->load->view('blocked_petugas');
  }

  public function blocked_siswa()
  {
    $this->load->view('blocked_siswa');
  }

  public function blocked_admin()
  {
    $this->load->view('blocked_admin');
  }
}
