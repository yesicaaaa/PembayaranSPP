<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('siswa_model', 'sm');
    is_logged_in_siswa();
  }

  public function index()
  {
    $data = [
      'user'  => $this->db->get_where('siswa', ['email' => $this->session->userdata('email')])->row_array(),
      'kelas' => $this->db->get_where('kelas', ['id_kelas' => $this->session->userdata('id_kelas')])->row_array(),
      'spp'   => $this->db->get_where('spp', ['id_spp' => $this->session->userdata('id_spp')])->row_array(),
      'title' => 'Profile Saya | SMK BPI',
      'css'   => 'assets/css/side-navbar.css'
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates_siswa/side-navbar', $data);
    $this->load->view('siswa/profile-saya', $data);
    $this->load->view('templates/footer');
  }

  public function history_pembayaran()
  {
    $data = [
      'user'  => $this->db->get_where('siswa', ['email' => $this->session->userdata('email')])->row_array(),
      'title' => 'History Pembayaran | SMK BPI',
      'css'   => 'assets/css/side-navbar.css'
    ];

    //pagination
    $config['base_url'] = 'http://localhost/pembayaranSPP/siswa/history_pembayaran';
    $config['total_rows'] = $this->sm->getHistoryRows();
    $config['per_page'] = 5;

    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);
    $start = ($data['start'] > 0) ? $data['start'] : 0;
    $data['history'] = $this->sm->getHistoryPembayaran($config['per_page'], $start);

    $this->load->view('templates/header', $data);
    $this->load->view('templates_siswa/side-navbar', $data);
    $this->load->view('siswa/history-pembayaran', $data);
    $this->load->view('templates/footer');
  }

  public function refresh()
  {
    $this->session->unset_userdata('keyword');
    redirect('siswa/history_pembayaran');
  }
}
