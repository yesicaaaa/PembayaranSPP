<?php  
defined('BASEPATH') or exit ('No direct script access allowed');

class Siswa extends CI_Controller{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('siswa_model', 'sm');
  }

  public function index()
  {
    $data = [
      'user'  => $this->db->get_where('siswa', ['email' => $this->session->userdata('email')])->row_array(),
      'kelas' => $this->db->get_where('kelas', ['id_kelas' => $this->session->userdata('id_kelas')])->row_array(),
      'spp'   => $this->db->get_where('spp', ['id_spp' => $this->session->userdata('id_spp')])->row_array(),
      'title' => 'Profile Saya | SMK BPI',
      'css'   => 'assets/css/side-navbar.css',
      'js'    => ''
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates_siswa/side-navbar', $data);
    $this->load->view('siswa/profile-saya', $data);
    $this->load->view('templates/footer', $data);
  }
}